<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CLocationCommunity
 *
 * @property int $id
 * @property bool|null $is_deleted
 * @property Carbon|null $last_modified_on
 * @property int|null $version
 * @property int|null $sort_id
 * @property int|null $parent_id
 * @property string|null $name_arm
 * @property string|null $name_eng
 * @property string|null $name_ru
 * @property string|null $name_ar
 * @property int|null $last_modified_by
 * @property string|null $comment
 * @property int|null $created_by
 * @property Carbon|null $created_on
 *
 * @property Collection|Announcement[] $announcements
 * @property Collection|Estate[] $estates
 *
 * @package App\Models
 */
class CLocationCommunity extends Model
{
    use CrudTrait;
	protected $table = 'c_location_community';

    use ApiMultiLanguage;
    protected array $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int',
		'is_deleted' => 'bool',
		'version' => 'int',
		'sort_id' => 'int',
		'parent_id' => 'int',
		'last_modified_by' => 'int',
		'created_by' => 'int'
	];

	protected $dates = [
		'last_modified_on',
		'created_on'
	];

	protected $fillable = [
		'is_deleted',
		'last_modified_on',
		'version',
		'sort_id',
		'parent_id',
		'name_arm',
		'name_eng',
		'name_ru',
		'name_ar',
		'last_modified_by',
		'comment',
		'created_by',
		'created_on'
	];

	public function announcements()
	{
		return $this->hasMany(Announcement::class, 'location_community_id');
	}

	public function estates()
	{
		return $this->hasMany(Estate::class, 'location_community_id');
	}
}
