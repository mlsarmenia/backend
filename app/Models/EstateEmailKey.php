<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateEmailKey
 *
 * @property int $id
 * @property int|null $estate_id
 * @property int|null $estate_email_type_id
 * @property string|null $security_key
 *
 * @package App\Models
 */
class EstateEmailKey extends Model
{
	protected $table = 'estate_email_key';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'estate_email_type_id' => 'int'
	];

	protected $fillable = [
		'estate_id',
		'estate_email_type_id',
		'security_key'
	];
}
