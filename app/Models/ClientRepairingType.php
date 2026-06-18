<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientRepairingType
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $repairing_type_id
 *
 * @package App\Models
 */
class ClientRepairingType extends Model
{
	protected $table = 'client_repairing_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'client_id' => 'int',
		'repairing_type_id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'repairing_type_id'
	];
}
