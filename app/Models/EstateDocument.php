<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Scopes\EstateDocumentScope;
use App\Traits\Models\HasFilePath;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class EstateDocument
 *
 * @property int $id
 * @property string|null $comment_arm
 * @property string|null $comment_eng
 * @property string|null $comment_ru
 * @property string|null $comment_ar
 * @property int|null $document_type_id
 * @property int|null $estate_id
 * @property string|null $path
 * @property string|null $path_thumb
 * @property string|null $file_name
 * @property bool|null $is_public
 * @property mixed $storage_path
 *
 * @package App\Models
 */
class EstateDocument extends Model
{

    use HasFilePath;

	protected $table = 'estate_document';
    protected string $identifiableAttribute = 'path';

	protected $casts = [
		'id' => 'int',
		'document_type_id' => 'int',
		'estate_id' => 'int',
		'is_public' => 'bool'
	];

	protected $fillable = [
		'comment_arm',
		'comment_eng',
		'comment_ru',
		'comment_ar',
		'document_type_id',
		'estate_id',
		'path',
		'path_thumb',
		'file_name',
		'is_public'
	];


    public function getStoragePathAttribute(): string
    {
        $name = $this->path;
        return "/estate/photos/".$this->estate_id."/".$name;
    }

    protected static function booted()
    {
        static::addGlobalScope(new EstateDocumentScope());
    }
}
