<?php

namespace App\Notifications;

use App\Contracts\Notifications\SendsTelegramChannelMessage;
use App\Models\Estate;
use App\Notifications\Messages\TelegramChannelMessage;
use App\Services\Notifications\EstateTelegramMessageFactory;

class EstateTelegramChangeNotification extends AuditableQueuedNotification implements SendsTelegramChannelMessage
{
    public const PRICE_CHANGED = 'price';

    public const REFUND_PERCENTAGE_CHANGED = 'refund_percentage';

    public array $backoff = [30, 120, 300];

    private function __construct(
        public Estate $estate,
        public string $change,
        public mixed $previousValue,
        public mixed $value
    ) {}

    public static function forPrice(
        Estate $estate,
        mixed $previousPriceAmd,
        mixed $priceAmd
    ): self {
        return new self($estate, self::PRICE_CHANGED, $previousPriceAmd, $priceAmd);
    }

    public static function forRefundPercentage(
        Estate $estate,
        mixed $previousRefundPercentage,
        mixed $refundPercentage
    ): self {
        return new self(
            $estate,
            self::REFUND_PERCENTAGE_CHANGED,
            $previousRefundPercentage,
            $refundPercentage
        );
    }

    public function toTelegramChannel(object $notifiable): TelegramChannelMessage
    {
        $factory = app(EstateTelegramMessageFactory::class);

        return $this->change === self::PRICE_CHANGED
            ? $factory->makePriceChanged($this->estate, $this->previousValue, $this->value)
            : $factory->makeRefundPercentageChanged($this->estate, $this->previousValue, $this->value);
    }

    public function auditContext(): array
    {
        return [
            'event_type' => 'estate.'.$this->change.'.changed.telegram-channel',
            'subject_type' => 'estate',
            'subject_id' => $this->estate->getKey(),
            'payload' => [
                'estate_id' => $this->estate->getKey(),
                'code' => $this->estate->code,
                'change' => $this->change,
                'previous_value' => $this->previousValue,
                'value' => $this->value,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->auditContext()['payload'];
    }

    /**
     * @return array<int, string>
     */
    protected function requestedChannels(): array
    {
        return ['telegram-channel'];
    }
}
