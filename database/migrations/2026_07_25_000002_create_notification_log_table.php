<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_log', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id');
            $table->string('notification_type');
            $table->string('event_type')->nullable();
            $table->string('notifiable_type')->nullable();
            $table->string('notifiable_id')->nullable();
            $table->char('recipient_key', 64);
            $table->string('recipient')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('channel', 64);
            $table->string('status', 32);
            $table->json('payload')->nullable();
            $table->text('error')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->timestamps();

            $table->unique(
                ['notification_id', 'channel', 'recipient_key'],
                'notification_log_delivery_unique'
            );
            $table->index(['event_type', 'status']);
            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_log');
    }
};
