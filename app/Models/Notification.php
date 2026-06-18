<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 *
 * @property int $id
 * @property string|null $title_arm
 * @property string|null $title_eng
 * @property string|null $title_ru
 * @property string|null $title_ar
 * @property string|null $description_arm
 * @property string|null $description_eng
 * @property string|null $description_ru
 * @property string|null $description_ar
 * @property string|null $url
 * @property int|null $user_id
 * @property Carbon|null $notified_date
 * @property bool|null $is_viewed
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notification';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'is_viewed' => 'bool'
	];

	protected $dates = [
		'notified_date'
	];

	protected $fillable = [
		'title_arm',
		'title_eng',
		'title_ru',
		'title_ar',
		'description_arm',
		'description_eng',
		'description_ru',
		'description_ar',
		'url',
		'user_id',
		'notified_date',
		'is_viewed'
	];
}
