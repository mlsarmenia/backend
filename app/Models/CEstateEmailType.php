<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CEstateEmailType
 *
 * @property int $id
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 *
 * @package App\Models
 */
class CEstateEmailType extends Model
{
	protected $table = 'c_estate_email_type';

	public $timestamps = false;

    use ApiMultiLanguage;
    protected array $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name_arm',
		'name_eng',
		'name_ru',
		'name_ar'
	];
}
