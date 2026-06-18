<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateStructure
 *
 * @property int $id
 * @property int|null $estate_id
 * @property float|null $area
 * @property int|null $structure_type_id
 * @property string|null $comment_arm
 * @property string|null $comment_eng
 * @property string|null $comment_ru
 * @property string|null $comment_ar
 *
 * @package App\Models
 */
class EstateStructure extends Model
{
	protected $table = 'estate_structure';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'estate_id' => 'int',
		'area' => 'float',
		'structure_type_id' => 'int'
	];

	protected $fillable = [
		'estate_id',
		'area',
		'structure_type_id',
		'comment_arm',
		'comment_eng',
		'comment_ru',
		'comment_ar'
	];
}
