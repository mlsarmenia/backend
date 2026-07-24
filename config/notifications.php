<?php

return [
    'queue' => env('NOTIFICATION_QUEUE', 'notifications'),

    'channels' => [
        'mail' => [
            'enabled' => env('NOTIFICATION_MAIL_ENABLED', true),
            'driver' => 'mail',
        ],

        'telegram-channel' => [
            'enabled' => env('TELEGRAM_CHANNEL_NOTIFICATIONS_ENABLED', false),
            'driver' => null,
            'bot_token' => env('TELEGRAM_CHANNEL_BOT_TOKEN'),
            'chat_id' => env('TELEGRAM_CHANNEL_CHAT_ID'),
        ],

        'telegram-bot' => [
            'enabled' => env('TELEGRAM_BOT_NOTIFICATIONS_ENABLED', false),
            'driver' => null,
            'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        ],
    ],
];
