<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateIp
 *
 * @property int $id
 * @property int|null $estate_id
 * @property string|null $ip
 *
 * @package App\Models
 */
class EstateIp extends Model
{
	protected $table = 'estate_ip';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int'
	];

	protected $fillable = [
		'estate_id',
		'ip'
	];
}
