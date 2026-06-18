<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CPacketType
 *
 * @property int $id
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ar
 * @property string|null $name_ru
 * @property string|null $sort_id
 * @property int|null $version
 * @property bool|null $is_deleted
 * @property Carbon|null $last_modified_on
 * @property int|null $last_modified_by
 * @property int|null $created_by
 * @property Carbon|null $created_on
 *
 * @package App\Models
 */
class CPacketType extends Model
{
	protected $table = 'c_packet_type';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'version' => 'int',
		'is_deleted' => 'bool',
		'last_modified_by' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'last_modified_on',
		'created_on'
	];

	protected $fillable = [
		'name_arm',
		'name_eng',
		'name_ar',
		'name_ru',
		'sort_id',
		'version',
		'is_deleted',
		'last_modified_on',
		'last_modified_by',
		'created_by',
		'created_on'
	];
}
