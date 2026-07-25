<?php

namespace Tests\Unit\Notifications;

use App\Notifications\BuyerAssignedToBrokerNotification;
use App\Notifications\BuyerMatchesBrokerEstatesNotification;
use App\Notifications\NewBuyerAdminSummaryNotification;
use Illuminate\Notifications\AnonymousNotifiable;
use Tests\TestCase;

class BuyerNotificationsTest extends TestCase
{
    public function test_matching_broker_email_contains_the_buyer_and_estate_summary(): void
    {
        $notification = new BuyerMatchesBrokerEstatesNotification(
            $this->buyer(),
            $this->brokers()[0]
        );
        $mail = $notification->toMail($this->recipient('broker@example.com'));

        $this->assertSame('mail.armenian-notification', $mail->view);
        $this->assertStringContainsString('Լիլիթ Պետրոսյան', $mail->viewData['body']);
        $this->assertStringContainsString('012-101', $mail->viewData['body']);
        $this->assertSame($this->buyer()['show_url'], $mail->viewData['actionUrl']);
        $this->assertSame(11, $notification->auditContext()['payload']['broker_id']);
    }

    public function test_admin_email_lists_candidates_and_links_to_the_existing_assignment_form(): void
    {
        $notification = new NewBuyerAdminSummaryNotification(
            $this->buyer(),
            3,
            $this->brokers()
        );
        $mail = $notification->toMail($this->recipient('admin@example.com'));

        $this->assertStringContainsString('Անի Մկրտչյան', $mail->viewData['body']);
        $this->assertStringContainsString('Արամ Հակոբյան', $mail->viewData['body']);
        $this->assertSame($this->buyer()['edit_url'], $mail->viewData['actionUrl']);
        $this->assertSame(
            [11, 12],
            $notification->auditContext()['payload']['candidate_broker_ids']
        );
    }

    public function test_assignment_email_identifies_the_selected_broker_and_buyer(): void
    {
        $notification = new BuyerAssignedToBrokerNotification(
            $this->buyer(),
            [
                'broker_id' => 11,
                'name' => 'Անի Մկրտչյան',
                'email' => 'broker@example.com',
            ]
        );
        $mail = $notification->toMail($this->recipient('broker@example.com'));

        $this->assertStringContainsString('Լիլիթ Պետրոսյան', $mail->viewData['body']);
        $this->assertSame($this->buyer()['show_url'], $mail->viewData['actionUrl']);
        $this->assertSame(11, $notification->auditContext()['payload']['broker_id']);
    }

    private function recipient(string $email): AnonymousNotifiable
    {
        return (new AnonymousNotifiable)->route('mail', $email);
    }

    /**
     * @return array<string, int|string|null>
     */
    private function buyer(): array
    {
        return [
            'id' => 20,
            'contact_id' => 208,
            'name' => 'Լիլիթ Պետրոսյան',
            'phone' => '091000000',
            'email' => null,
            'estate_type' => 'Բնակարան',
            'contract_type' => 'Վաճառք',
            'location' => 'Երևան, Կենտրոն',
            'budget' => '30,000,000 - 40,000,000 AMD',
            'area' => '50 - 80 քմ',
            'rooms' => '2 - 3',
            'show_url' => 'https://mlsapp.am/admin/buyer/208/show?type=viewOnly',
            'edit_url' => 'https://mlsapp.am/admin/buyer/208/edit',
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function brokers(): array
    {
        return [
            [
                'broker_id' => 11,
                'name' => 'Անի Մկրտչյան',
                'email' => 'broker@example.com',
                'match_count' => 2,
                'estates' => [
                    [
                        'id' => 101,
                        'code' => '012-101',
                        'estate_type' => 'Բնակարան',
                        'location' => 'Երևան, Կենտրոն',
                        'price' => '35,000,000 AMD',
                        'area' => '65 քմ',
                    ],
                ],
            ],
            [
                'broker_id' => 12,
                'name' => 'Արամ Հակոբյան',
                'email' => null,
                'match_count' => 1,
                'estates' => [],
            ],
        ];
    }
}
