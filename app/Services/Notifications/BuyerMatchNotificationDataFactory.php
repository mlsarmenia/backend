<?php

namespace App\Services\Notifications;

use App\Models\Client;
use App\Models\Estate;
use App\Services\PotentialEstateMatcher;
use Illuminate\Database\Eloquent\Collection;

class BuyerMatchNotificationDataFactory
{
    public function __construct(
        private readonly PotentialEstateMatcher $matcher
    ) {}

    /**
     * @return array{
     *     buyer: array<string, int|string|null>,
     *     total_match_count: int,
     *     brokers: array<int, array{
     *         broker_id: int,
     *         name: string,
     *         email: string|null,
     *         match_count: int,
     *         estates: array<int, array<string, int|string|null>>
     *     }>
     * }
     */
    public function make(Client $buyer): array
    {
        $this->loadBuyerRelations($buyer);

        $estates = $this->matcher
            ->forClient($buyer)
            ->with([
                'agent.contact',
                'agent.user',
                'estate_type',
                'location_province',
                'location_city',
                'location_community',
            ])
            ->get([
                'id',
                'code',
                'agent_id',
                'estate_type_id',
                'location_province_id',
                'location_city_id',
                'location_community_id',
                'price_amd',
                'area_total',
            ]);

        return [
            'buyer' => $this->buyer($buyer),
            'total_match_count' => $estates->count(),
            'brokers' => $this->brokerSummaries($estates),
        ];
    }

    /**
     * @return array<string, int|string|null>
     */
    public function buyer(Client $buyer): array
    {
        $this->loadBuyerRelations($buyer);

        $contactId = $buyer->contact_id;
        $adminPrefix = trim((string) config('backpack.base.route_prefix', 'admin'), '/');
        $baseUrl = rtrim((string) config('app.url'), '/');

        return [
            'id' => (int) $buyer->getKey(),
            'contact_id' => $contactId === null ? null : (int) $contactId,
            'name' => $this->buyerName($buyer),
            'phone' => $buyer->contact?->phone_mobile_1,
            'email' => $this->email($buyer->contact?->email),
            'estate_type' => $buyer->estate_type?->name_arm,
            'contract_type' => $buyer->contract_type?->name_arm,
            'location' => $this->buyerLocation($buyer),
            'budget' => $this->range(
                $buyer->price_from,
                $buyer->price_to,
                $buyer->currency?->iso_code ?? 'AMD'
            ),
            'area' => $this->range($buyer->area_from, $buyer->area_to, 'քմ'),
            'rooms' => $this->range($buyer->room_count_from, $buyer->room_count_to),
            'show_url' => $contactId === null
                ? null
                : "{$baseUrl}/{$adminPrefix}/buyer/{$contactId}/show?type=viewOnly",
            'edit_url' => $contactId === null
                ? null
                : "{$baseUrl}/{$adminPrefix}/buyer/{$contactId}/edit",
        ];
    }

    /**
     * @param  Collection<int, Estate>  $estates
     * @return array<int, array{
     *     broker_id: int,
     *     name: string,
     *     email: string|null,
     *     match_count: int,
     *     estates: array<int, array<string, int|string|null>>
     * }>
     */
    private function brokerSummaries(Collection $estates): array
    {
        $summaryLimit = max(
            1,
            (int) config('notifications.buyer_matches.estate_summary_limit', 10)
        );

        return $estates
            ->filter(fn (Estate $estate): bool => $estate->agent_id !== null)
            ->groupBy('agent_id')
            ->map(function (Collection $matches, int|string $brokerId) use ($summaryLimit): array {
                $agent = $matches->first()?->agent;
                $contact = $agent?->contact;

                return [
                    'broker_id' => (int) $brokerId,
                    'name' => trim((string) $contact?->full_name) ?: "Գործակալ #{$brokerId}",
                    'email' => $this->email($contact?->email ?? $agent?->user?->email),
                    'match_count' => $matches->count(),
                    'estates' => $matches
                        ->take($summaryLimit)
                        ->map(fn (Estate $estate): array => $this->estate($estate))
                        ->values()
                        ->all(),
                ];
            })
            ->sortByDesc('match_count')
            ->values()
            ->all();
    }

    /**
     * @return array<string, int|string|null>
     */
    private function estate(Estate $estate): array
    {
        $location = collect([
            $estate->location_province?->name_arm,
            $estate->location_city?->name_arm,
            $estate->location_community?->name_arm,
        ])->filter()->unique()->implode(', ');

        return [
            'id' => (int) $estate->getKey(),
            'code' => $estate->code ?: "#{$estate->getKey()}",
            'estate_type' => $estate->estate_type?->name_arm,
            'location' => $location ?: null,
            'price' => $estate->price_amd === null
                ? null
                : $this->number($estate->price_amd).' AMD',
            'area' => $estate->area_total === null
                ? null
                : $this->number($estate->area_total).' քմ',
        ];
    }

    private function loadBuyerRelations(Client $buyer): void
    {
        $buyer->loadMissing([
            'contact',
            'estate_type',
            'contract_type',
            'location_province',
            'location_city',
            'communities',
            'currency',
            'client_repairing_types',
            'client_building_project__types',
            'client_building_types',
        ]);
    }

    private function buyerName(Client $buyer): string
    {
        $name = trim((string) $buyer->contact?->full_name);

        return $name !== '' ? $name : "Գնորդ #{$buyer->getKey()}";
    }

    private function buyerLocation(Client $buyer): ?string
    {
        $parts = collect([
            $buyer->location_province?->name_arm,
            $buyer->location_city?->name_arm,
        ])->merge($buyer->communities->pluck('name_arm'));

        $location = $parts->filter()->unique()->implode(', ');

        return $location !== '' ? $location : null;
    }

    private function range(
        int|float|null $from,
        int|float|null $to,
        ?string $unit = null
    ): ?string {
        if ($from === null && $to === null) {
            return null;
        }

        $value = match (true) {
            $from !== null && $to !== null => $this->number($from).' - '.$this->number($to),
            $from !== null => 'սկսած '.$this->number($from),
            default => 'մինչև '.$this->number($to),
        };

        return $unit === null || $unit === '' ? $value : "{$value} {$unit}";
    }

    private function number(int|float|string $value): string
    {
        $decimals = floor((float) $value) === (float) $value ? 0 : 2;

        return number_format((float) $value, $decimals, '.', ',');
    }

    private function email(?string $email): ?string
    {
        $email = strtolower(trim((string) $email));

        return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
    }
}
