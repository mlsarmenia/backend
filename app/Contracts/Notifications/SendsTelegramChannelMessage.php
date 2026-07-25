<?php

namespace App\Contracts\Notifications;

use App\Notifications\Messages\TelegramChannelMessage;

interface SendsTelegramChannelMessage
{
    public function toTelegramChannel(object $notifiable): TelegramChannelMessage;
}
