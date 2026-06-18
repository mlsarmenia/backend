<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateChangeInStatusStatistic
 *
 * @property int $id
 * @property int|null $estate_id
 * @property int|null $user_id
 * @property int|null $visit_count
 * @property Carbon|null $created_date
 *
 * @package App\Models
 */
class EstateChangeInStatusStatistic extends Model
{
	protected $table = 'estate_change_in_status_statistics';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'user_id' => 'int',
		'visit_count' => 'int'
	];

	protected $dates = [
		'created_date'
	];

	protected $fillable = [
		'estate_id',
		'user_id',
		'visit_count',
		'created_date'
	];
}
