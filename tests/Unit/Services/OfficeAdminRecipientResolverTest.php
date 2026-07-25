<?php

namespace Tests\Unit\Services;

use App\Models\Client;
use App\Models\Contact;
use App\Models\User;
use App\Services\Notifications\OfficeAdminRecipientResolver;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OfficeAdminRecipientResolverTest extends TestCase
{
    private string $previousConnection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->previousConnection = DB::getDefaultConnection();
        config()->set('database.connections.buyer_notification_testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);
        DB::setDefaultConnection('buyer_notification_testing');

        Schema::create('users', function (Blueprint $table): void {
            $table->id();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->boolean('is_organization_admin')->nullable();
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('users');
        DB::purge('buyer_notification_testing');
        DB::setDefaultConnection($this->previousConnection);

        parent::tearDown();
    }

    public function test_it_combines_configured_recipients_with_only_the_buyers_office_admins(): void
    {
        config()->set('notifications.buyer_matches.admin_emails', [
            'global@example.com',
            'OFFICE@example.com',
        ]);

        DB::table('users')->insert([
            [
                'email' => 'office@example.com',
                'organization_id' => 7,
                'is_organization_admin' => true,
            ],
            [
                'email' => 'other-office@example.com',
                'organization_id' => 8,
                'is_organization_admin' => true,
            ],
            [
                'email' => 'regular@example.com',
                'organization_id' => 7,
                'is_organization_admin' => false,
            ],
        ]);

        $creator = (new User)->forceFill(['organization_id' => 7]);
        $contact = new Contact;
        $contact->setRelation('createdBy', $creator);
        $buyer = new Client;
        $buyer->setRelation('contact', $contact);

        $recipients = (new OfficeAdminRecipientResolver)->forBuyer($buyer);

        $this->assertSame([
            'global@example.com',
            'office@example.com',
        ], $recipients);
    }
}
