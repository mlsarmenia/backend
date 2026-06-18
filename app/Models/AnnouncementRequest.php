<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\ApiMultiLanguage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnnouncementRequest
 *
 * @property int $id
 * @property int|null $announcement_id
 * @property int|null $requester_id
 * @property string|null $confirm_code
 *
 * @package App\Models
 */
class AnnouncementRequest extends Model
{
	protected $table = 'announcement_request';

	public $timestamps = false;

    use ApiMultiLanguage;
    protected  $multi_lang = [
        'name',
    ];

	protected $casts = [
		'id' => 'int',
		'announcement_id' => 'int',
		'requester_id' => 'int'
	];

	protected $fillable = [
		'announcement_id',
		'requester_id',
		'confirm_code'
	];
}
