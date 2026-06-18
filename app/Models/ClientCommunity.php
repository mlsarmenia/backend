<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientCommunity
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $community_id
 *
 * @package App\Models
 */
class ClientCommunity extends Model
{
	protected $table = 'client_community';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'client_id' => 'int',
		'community_id' => 'int'
	];

	protected $fillable = [
		'client_id',
		'community_id'
	];
}
