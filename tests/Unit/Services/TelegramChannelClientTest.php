<?php

namespace Tests\Unit\Services;

use App\Notifications\Messages\TelegramChannelMessage;
use App\Services\Notifications\TelegramChannelClient;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Tests\TestCase;

class TelegramChannelClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('notifications.channels.telegram-channel.bot_token', 'test-token');
        config()->set(
            'notifications.channels.telegram-channel.api_base_url',
            'https://api.telegram.test'
        );
        config()->set('notifications.channels.telegram-channel.timeout', 2);
        config()->set('notifications.channels.telegram-channel.request_attempts', 1);
        config()->set('notifications.channels.telegram-channel.retry_delay_ms', 0);
    }

    public function test_it_sends_a_photo_caption_with_an_action_button(): void
    {
        Http::fake([
            'https://api.telegram.test/*' => Http::response([
                'ok' => true,
                'result' => ['message_id' => 91],
            ]),
        ]);

        $message = new TelegramChannelMessage(
            text: '<b>Նոր գույք</b>',
            photoUrl: 'https://mlsapp.am/storage/estate/photos/12/main.jpg',
            actionText: 'Դիտել',
            actionUrl: 'https://mlsapp.am/admin/estate/12/show'
        );

        $result = (new TelegramChannelClient)->send('-1001234567890', $message);

        $this->assertSame(91, $result['message_id']);
        Http::assertSent(function (Request $request): bool {
            $keyboard = json_decode($request['reply_markup'], true);

            return $request->url() === 'https://api.telegram.test/bottest-token/sendPhoto'
                && $request['chat_id'] === '-1001234567890'
                && $request['photo'] === 'https://mlsapp.am/storage/estate/photos/12/main.jpg'
                && $request['caption'] === '<b>Նոր գույք</b>'
                && $keyboard['inline_keyboard'][0][0]['text'] === 'Դիտել';
        });
    }

    public function test_it_uses_a_text_message_when_there_is_no_photo(): void
    {
        Http::fake([
            'https://api.telegram.test/*' => Http::response([
                'ok' => true,
                'result' => ['message_id' => 92],
            ]),
        ]);

        (new TelegramChannelClient)->send(
            '-1001234567890',
            new TelegramChannelMessage(text: '<b>Նոր գույք</b>')
        );

        Http::assertSent(fn (Request $request): bool => str_ends_with($request->url(), '/sendMessage')
            && $request['text'] === '<b>Նոր գույք</b>'
            && ! isset($request['photo']));
    }

    public function test_it_rejects_an_unsuccessful_telegram_response(): void
    {
        Http::fake([
            'https://api.telegram.test/*' => Http::response([
                'ok' => false,
                'description' => 'Bad Request: chat not found',
            ]),
        ]);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Bad Request: chat not found');

        (new TelegramChannelClient)->send(
            '-1001234567890',
            new TelegramChannelMessage(text: 'Estate')
        );
    }
}
