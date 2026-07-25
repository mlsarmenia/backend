<?php

namespace App\Services\Notifications;

use App\Models\Estate;
use App\Notifications\Messages\TelegramChannelMessage;
use Illuminate\Support\Facades\Storage;

class EstateTelegramMessageFactory
{
    public function make(Estate $estate): TelegramChannelMessage
    {
        $estate->loadMissing([
            'estate_type',
            'contract_type',
            'location_province',
            'location_community',
            'location_street',
            'estateDocuments',
        ]);

        $url = rtrim((string) config('app.url'), '/')
            ."/admin/estate/{$estate->getKey()}/show?type=viewOnly";

        $lines = [
            '<b>Նոր գույք</b>',
            '<b>Կոդ՝</b> '.$this->escape($estate->code ?: '#'.$estate->getKey()),
            '<b>Տեսակ՝</b> '.$this->escape($this->type($estate)),
            '<b>Հասցե՝</b> '.$this->escape($estate->full_address ?: 'Նշված չէ'),
            '<b>Գին՝</b> '.$this->escape($this->price($estate)),
            '<b>Մակերես՝</b> '.$this->escape($this->area($estate)),
            '<a href="'.$this->escape($url).'">Դիտել MLS-ում</a>',
        ];

        return new TelegramChannelMessage(
            text: implode("\n", $lines),
            photoUrl: $this->photoUrl($estate),
            actionText: 'Դիտել գույքը',
            actionUrl: $url
        );
    }

    private function type(Estate $estate): string
    {
        $parts = array_filter([
            $estate->estate_type?->name_arm,
            $estate->contract_type?->name_arm,
        ]);

        return $parts === [] ? 'Նշված չէ' : implode(' / ', $parts);
    }

    private function price(Estate $estate): string
    {
        $prices = [];

        if ((float) $estate->price_amd > 0) {
            $prices[] = number_format((float) $estate->price_amd, 0, '.', ',').' AMD';
        }

        if ((float) $estate->price_usd > 0) {
            $prices[] = '$'.number_format((float) $estate->price_usd, 0, '.', ',');
        }

        return $prices === [] ? 'Նշված չէ' : implode(' / ', $prices);
    }

    private function area(Estate $estate): string
    {
        if ((float) $estate->area_total <= 0) {
            return 'Նշված չէ';
        }

        $area = rtrim(rtrim(number_format((float) $estate->area_total, 2, '.', ','), '0'), '.');

        return $area.' մ²';
    }

    private function photoUrl(Estate $estate): ?string
    {
        $path = $estate->main_image_file_path;

        if (empty($path)) {
            $document = $estate->estateDocuments->firstWhere('is_public', true)
                ?? $estate->estateDocuments->first();
            $path = $document?->path;

            if (! empty($path)) {
                $path = $estate->getKey().'/'.ltrim($path, '/');
            }
        }

        if (empty($path)) {
            return null;
        }

        $storagePath = 'estate/photos/'.ltrim($path, '/');
        $disk = Storage::disk('S3Public');

        return $disk->exists($storagePath) ? $disk->url($storagePath) : null;
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
