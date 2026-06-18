<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfessionalMenuLocationCommunity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $location_community_id
 *
 * @package App\Models
 */
class ProfessionalMenuLocationCommunity extends Model
{
	protected $table = 'professional_menu_location_community';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'location_community_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'location_community_id'
	];
}
