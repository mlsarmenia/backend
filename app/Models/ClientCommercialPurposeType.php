<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCommercialPurposeType
 *
 * @property int $id
 * @property string|null $client_id
 * @property string|null $commercial_purpose_type_id
 *
 * @package App\Models
 */
class ClientCommercialPurposeType extends Model
{
	protected $table = 'client_commercial_purpose_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'commercial_purpose_type_id'
	];
}
