<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property int $id
 * @property int|null $recipient_id
 * @property int|null $estate_id
 * @property string|null $sender_name
 * @property string|null $sender_email
 * @property string|null $sender_phone
 * @property int|null $message_type_id
 * @property int|null $feedback_type_id
 * @property int|null $service_id
 * @property int|null $overall_rating
 * @property float|null $offering_price
 * @property int|null $offering_currency_id
 * @property string|null $message_text
 * @property bool|null $is_read
 * @property bool|null $is_verified
 * @property Carbon|null $sent_on
 * @property string|null $ip_address
 *
 * @package App\Models
 */
class Message extends Model
{
    use CrudTrait;
	protected $table = 'message';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'recipient_id' => 'int',
		'estate_id' => 'int',
		'message_type_id' => 'int',
		'feedback_type_id' => 'int',
		'service_id' => 'int',
		'overall_rating' => 'int',
		'offering_price' => 'float',
		'offering_currency_id' => 'int',
		'is_read' => 'bool',
		'is_verified' => 'bool'
	];

	protected $dates = [
		'sent_on'
	];

	protected $fillable = [
		'recipient_id',
		'estate_id',
		'sender_name',
		'sender_email',
		'sender_phone',
		'message_type_id',
		'feedback_type_id',
		'service_id',
		'overall_rating',
		'offering_price',
		'offering_currency_id',
		'message_text',
		'is_read',
		'is_verified',
		'sent_on',
		'ip_address'
	];

    public function messageServiceName()
    {
        return $this->belongsTo(CServiceType::class, 'service_id');
    }

    public function recipient()
    {
        return $this->belongsTo(RealtorUser::class, 'recipient_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
}
