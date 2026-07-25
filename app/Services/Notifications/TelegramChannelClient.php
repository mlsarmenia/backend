<?php

namespace App\Services\Notifications;

use App\Notifications\Messages\TelegramChannelMessage;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class TelegramChannelClient
{
    /**
     * @return array<string, mixed>
     */
    public function send(string $chatId, TelegramChannelMessage $message): array
    {
        $token = (string) config('notifications.channels.telegram-channel.bot_token');

        if ($token === '' || $chatId === '') {
            throw new RuntimeException('Telegram channel credentials are not configured.');
        }

        $method = $message->photoUrl === null ? 'sendMessage' : 'sendPhoto';
        $payload = $this->payload($chatId, $message);
        $baseUrl = rtrim(
            (string) config('notifications.channels.telegram-channel.api_base_url'),
            '/'
        );

        $response = Http::asForm()
            ->acceptJson()
            ->timeout((int) config('notifications.channels.telegram-channel.timeout', 10))
            ->retry(
                (int) config('notifications.channels.telegram-channel.request_attempts', 2),
                (int) config('notifications.channels.telegram-channel.retry_delay_ms', 500),
                throw: false
            )
            ->post("{$baseUrl}/bot{$token}/{$method}", $payload);

        $response->throw();
        $this->ensureSuccessfulTelegramResponse($response);

        return $response->json('result') ?? [];
    }

    /**
     * @return array<string, mixed>
     */
    private function payload(string $chatId, TelegramChannelMessage $message): array
    {
        $payload = [
            'chat_id' => $chatId,
            'parse_mode' => 'HTML',
        ];

        if ($message->photoUrl === null) {
            $payload['text'] = $message->text;
            $payload['disable_web_page_preview'] = true;
        } else {
            $payload['photo'] = $message->photoUrl;
            $payload['caption'] = $message->text;
        }

        if ($message->actionText !== null && $message->actionUrl !== null) {
            $payload['reply_markup'] = json_encode([
                'inline_keyboard' => [[[
                    'text' => $message->actionText,
                    'url' => $message->actionUrl,
                ]]],
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return $payload;
    }

    private function ensureSuccessfulTelegramResponse(Response $response): void
    {
        if ($response->json('ok') === true) {
            return;
        }

        $description = (string) ($response->json('description') ?? 'Unknown Telegram API error.');

        throw new RuntimeException($description);
    }
}
