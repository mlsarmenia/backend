<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role as OriginalRole;

/**
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|ModelHasRole[] $model_has_roles
 * @property Collection|Permission[] $permissions
 *
 * @package App\Models
 */
class Role extends OriginalRole
{
    use CrudTrait;
	protected $table = 'roles';

	protected $fillable = [
		'name',
		'slug',
		'guard_name',
	];

	public function model_has_roles()
	{
		return $this->hasMany(ModelHasRole::class);
	}
}
