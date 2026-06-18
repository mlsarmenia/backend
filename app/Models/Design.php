<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Design
 *
 * @property int $id
 * @property int|null $design_room_id
 * @property int|null $design_room_type_id
 * @property int|null $design_color_id
 * @property int|null $design_style_id
 * @property int|null $design_price_id
 * @property string|null $title_arm
 * @property string|null $title_eng
 * @property string|null $title_ru
 * @property string|null $title_ar
 * @property string|null $comment_arm
 * @property string|null $comment_eng
 * @property string|null $comment_ru
 * @property string|null $comment_ar
 * @property int|null $created_by
 * @property Carbon|null $created_on
 * @property int|null $last_modified_by
 * @property Carbon|null $last_modified_on
 * @property string|null $main_image_file_name
 * @property string|null $main_image_file_path
 * @property string|null $main_image_file_path_thumb
 * @property bool|null $is_published
 * @property bool|null $is_approved
 * @property int|null $view_count
 *
 * @property CDesignColor|null $c_design_color
 * @property CDesignPrice|null $c_design_price
 * @property CDesignRoom|null $c_design_room
 * @property CDesignRoomType|null $c_design_room_type
 * @property CDesignStyle|null $c_design_style
 *
 * @package App\Models
 */
class Design extends Model
{
	protected $table = 'design';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'design_room_id' => 'int',
		'design_room_type_id' => 'int',
		'design_color_id' => 'int',
		'design_style_id' => 'int',
		'design_price_id' => 'int',
		'created_by' => 'int',
		'last_modified_by' => 'int',
		'is_published' => 'bool',
		'is_approved' => 'bool',
		'view_count' => 'int'
	];

	protected $dates = [
		'created_on',
		'last_modified_on'
	];

	protected $fillable = [
		'design_room_id',
		'design_room_type_id',
		'design_color_id',
		'design_style_id',
		'design_price_id',
		'title_arm',
		'title_eng',
		'title_ru',
		'title_ar',
		'comment_arm',
		'comment_eng',
		'comment_ru',
		'comment_ar',
		'created_by',
		'created_on',
		'last_modified_by',
		'last_modified_on',
		'main_image_file_name',
		'main_image_file_path',
		'main_image_file_path_thumb',
		'is_published',
		'is_approved',
		'view_count'
	];

	public function c_design_color()
	{
		return $this->belongsTo(CDesignColor::class, 'design_color_id');
	}

	public function c_design_price()
	{
		return $this->belongsTo(CDesignPrice::class, 'design_price_id');
	}

	public function c_design_room()
	{
		return $this->belongsTo(CDesignRoom::class, 'design_room_id');
	}

	public function c_design_room_type()
	{
		return $this->belongsTo(CDesignRoomType::class, 'design_room_type_id');
	}

	public function c_design_style()
	{
		return $this->belongsTo(CDesignStyle::class, 'design_style_id');
	}
}
