<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientHouseFloorType
 *
 * @property int $id
 * @property string|null $client_id
 * @property string|null $house_floor_type_id
 *
 * @package App\Models
 */
class ClientHouseFloorType extends Model
{
	protected $table = 'client_house_floor_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'house_floor_type_id'
	];
}
