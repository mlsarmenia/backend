<?php

namespace App\Notifications\Messages;

class TelegramChannelMessage
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $photoUrl = null,
        public readonly ?string $actionText = null,
        public readonly ?string $actionUrl = null
    ) {}
}
