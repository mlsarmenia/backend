<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientLandUseType
 *
 * @property int $id
 * @property string|null $client_id
 * @property string|null $land_use_type_id
 *
 * @package App\Models
 */
class ClientLandUseType extends Model
{
	protected $table = 'client_land_use_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'land_use_type_id'
	];
}
