<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfessionalProfession
 *
 * @property int|null $user_id
 * @property int|null $profession_id
 * @property int $id
 *
 * @property CProfessionType|null $c_profession_type
 *
 * @package App\Models
 */
class ProfessionalProfession extends Model
{
	protected $table = 'professional_profession';

	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'profession_id' => 'int',
		'id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'profession_id'
	];

	public function c_profession_type()
	{
		return $this->belongsTo(CProfessionType::class, 'profession_id');
	}
}
