<?php


namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateOptionType
 *
 * @package App\Models
 */
class EstateOptionType extends Model
{
    use CrudTrait;
    use ApiMultiLanguage;


    public $timestamps = false;

    protected  array $multi_lang = [
        'name'
    ];
    protected $casts = [
        'id' => 'int',
        'name_arm' => 'string',
    ];



    protected $fillable = [
        'name_arm',
        'name_en',
        'name_ru',
        'estate_type',
    ];


}
