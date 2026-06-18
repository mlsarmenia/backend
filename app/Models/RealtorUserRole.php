<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RealtorUserRole
 *
 * @property int|null $user_id
 * @property int|null $role_id
 * @property int $id
 *
 * @property RealtorUser|null $realtor_user
 *
 * @package App\Models
 */
class RealtorUserRole extends Model
{
	protected $table = 'realtor_user_role';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];

	public function realtor_user()
	{
		return $this->belongsTo(RealtorUser::class, 'user_id');
	}
}
