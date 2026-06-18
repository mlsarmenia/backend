<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateBrokerStatistic
 *
 * @property int $id
 * @property int|null $estate_id
 * @property int|null $user_id
 * @property int|null $screened
 * @property int|null $elected
 * @property int|null $changed
 * @property Carbon|null $created_date
 * @property int|null $location_community_id
 * @property int|null $location_city_id
 *
 * @package App\Models
 */
class EstateBrokerStatistic extends Model
{
	protected $table = 'estate_broker_statistics';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'user_id' => 'int',
		'screened' => 'int',
		'elected' => 'int',
		'changed' => 'int',
		'location_community_id' => 'int',
		'location_city_id' => 'int'
	];

	protected $dates = [
		'created_date'
	];

	protected $fillable = [
		'estate_id',
		'user_id',
		'screened',
		'elected',
		'changed',
		'created_date',
		'location_community_id',
		'location_city_id'
	];
}
