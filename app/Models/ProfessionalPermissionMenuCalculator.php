<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfessionalPermissionMenuCalculator
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $contract_type_id
 * @property int|null $estate_type_id
 * @property int|null $location_community_id
 * @property int|null $screened_count
 *
 * @package App\Models
 */
class ProfessionalPermissionMenuCalculator extends Model
{
	protected $table = 'professional_permission_menu_calculator';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'contract_type_id' => 'int',
		'estate_type_id' => 'int',
		'location_community_id' => 'int',
		'screened_count' => 'int'
	];

	protected $fillable = [
		'user_id',
		'contract_type_id',
		'estate_type_id',
		'location_community_id',
		'screened_count'
	];
}
