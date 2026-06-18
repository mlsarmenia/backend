<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateFavorite
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $client_id
 * @property int|null $estate_id
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class EstateFavorite extends Model
{
	protected $table = 'estate_favorites';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'client_id' => 'int',
		'estate_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'user_id',
		'client_id',
		'estate_id',
		'date'
	];
}
