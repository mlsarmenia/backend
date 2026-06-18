<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateProfession
 *
 * @property int $id
 * @property int|null $estate_id
 * @property int|null $profession_id
 *
 * @package App\Models
 */
class EstateProfession extends Model
{
	protected $table = 'estate_profession';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'profession_id' => 'int'
	];

	protected $fillable = [
		'estate_id',
		'profession_id'
	];
}
