<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientBuildingProjectType
 *
 * @property int $id
 * @property string|null $client_id
 * @property string|null $building_project_type_id
 *
 * @package App\Models
 */
class ClientBuildingProjectType extends Model
{
	protected $table = 'client_building_project_type';

	public $timestamps = false;

    use ApiMultiLanguage;
    protected array $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'building_project_type_id'
	];
}
