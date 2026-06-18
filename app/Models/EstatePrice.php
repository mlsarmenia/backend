<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstatePrice
 *
 * @property int $id
 * @property int|null $estate_id
 * @property float|null $estate_price
 * @property Carbon|null $price_date
 *
 * @package App\Models
 */
class EstatePrice extends Model
{
	protected $table = 'estate_price';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'estate_price' => 'float'
	];

	protected $dates = [
		'price_date'
	];

	protected $fillable = [
		'estate_id',
		'estate_price',
		'price_date'
	];
}
