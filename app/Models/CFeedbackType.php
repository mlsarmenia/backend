<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CFeedbackType
 *
 * @property int $id
 * @property int|null $sort_id
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 * @property string|null $comment
 * @property bool|null $is_deleted
 * @property int|null $created_by
 * @property Carbon|null $created_on
 * @property int|null $last_modified_by
 * @property Carbon|null $last_modified_on
 *
 * @package App\Models
 */
class CFeedbackType extends Model
{
	protected $table = 'c_feedback_type';

	public $timestamps = false;

    use ApiMultiLanguage;
    protected array $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int',
		'sort_id' => 'int',
		'is_deleted' => 'bool',
		'created_by' => 'int',
		'last_modified_by' => 'int'
	];

	protected $dates = [
		'created_on',
		'last_modified_on'
	];

	protected $fillable = [
		'sort_id',
		'name_arm',
		'name_eng',
		'name_ru',
		'name_ar',
		'comment',
		'is_deleted',
		'created_by',
		'created_on',
		'last_modified_by',
		'last_modified_on'
	];
}
