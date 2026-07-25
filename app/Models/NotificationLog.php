<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $table = 'notification_log';

    protected $fillable = [
        'notification_id',
        'notification_type',
        'event_type',
        'notifiable_type',
        'notifiable_id',
        'recipient_key',
        'recipient',
        'subject_type',
        'subject_id',
        'channel',
        'status',
        'payload',
        'error',
        'sent_at',
        'failed_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
    ];
}
