<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mail
 *
 * @property int $id
 * @property int|null $estate_id
 * @property int|null $sender_id
 * @property Carbon|null $sending_date
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $mail_to_contact_id
 * @property string|null $mail_to_email_address
 *
 * @package App\Models
 */
class Mail extends Model
{
	protected $table = 'mail';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'sender_id' => 'int',
		'mail_to_contact_id' => 'int'
	];

	protected $dates = [
		'sending_date'
	];

	protected $fillable = [
		'estate_id',
		'sender_id',
		'sending_date',
		'subject',
		'body',
		'mail_to_contact_id',
		'mail_to_email_address'
	];
}
