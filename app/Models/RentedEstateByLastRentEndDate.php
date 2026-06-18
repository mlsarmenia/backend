<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RentedEstateByLastRentEndDate
 *
 * @property int|null $estate_id
 * @property Carbon|null $lastEndDate
 *
 * @package App\Models
 */
class RentedEstateByLastRentEndDate extends Model
{
	protected $table = 'rented_estate_by_last_rent_end_date';

	public $timestamps = false;

	protected $casts = [
		'estate_id' => 'int'
	];

	protected $dates = [
		'lastEndDate'
	];

	protected $fillable = [
		'estate_id',
		'lastEndDate'
	];
}
