<?php

use App\Notifications\Channels\TelegramChannel;

return [
    'queue' => env('NOTIFICATION_QUEUE', 'notifications'),

    'buyer_matches' => [
        'admin_emails' => array_values(array_filter(array_map(
            static fn (string $email): string => trim($email),
            explode(',', env('NOTIFICATION_ADMIN_EMAILS', ''))
        ))),
        'estate_summary_limit' => (int) env(
            'NOTIFICATION_BUYER_MATCH_ESTATE_SUMMARY_LIMIT',
            10
        ),
        'broker_summary_limit' => (int) env(
            'NOTIFICATION_BUYER_MATCH_BROKER_SUMMARY_LIMIT',
            20
        ),
        'delay_seconds' => (int) env(
            'NOTIFICATION_BUYER_MATCH_DELAY_SECONDS',
            5
        ),
    ],

    'channels' => [
        'mail' => [
            'enabled' => env('NOTIFICATION_MAIL_ENABLED', true),
            'driver' => 'mail',
        ],

        'telegram-channel' => [
            'enabled' => env('TELEGRAM_CHANNEL_NOTIFICATIONS_ENABLED', false),
            'driver' => TelegramChannel::class,
            'bot_token' => env('TELEGRAM_CHANNEL_BOT_TOKEN'),
            'chat_id' => env('TELEGRAM_CHANNEL_CHAT_ID'),
            'estate_status_ids' => array_values(array_filter(array_map(
                static fn (string $status): int => (int) trim($status),
                explode(',', env('TELEGRAM_CHANNEL_ESTATE_STATUS_IDS', '3,4'))
            ))),
            'api_base_url' => env('TELEGRAM_API_BASE_URL', 'https://api.telegram.org'),
            'timeout' => (int) env('TELEGRAM_API_TIMEOUT', 10),
            'request_attempts' => (int) env('TELEGRAM_API_REQUEST_ATTEMPTS', 2),
            'retry_delay_ms' => (int) env('TELEGRAM_API_RETRY_DELAY_MS', 500),
        ],

        'telegram-bot' => [
            'enabled' => env('TELEGRAM_BOT_NOTIFICATIONS_ENABLED', false),
            'driver' => null,
            'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        ],
    ],
];
