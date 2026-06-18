<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfessionalPermissionMenuContractType
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $contract_type_id
 *
 * @package App\Models
 */
class ProfessionalPermissionMenuContractType extends Model
{
	protected $table = 'professional_permission_menu_contract_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'contract_type_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'contract_type_id'
	];
}
