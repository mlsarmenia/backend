<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstateDocumentDownload
 *
 * @property int $id
 * @property int|null $user_id
 * @property Carbon|null $download_date
 * @property int|null $estate_id
 *
 * @package App\Models
 */
class EstateDocumentDownload extends Model
{
	protected $table = 'estate_document_download';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'estate_id' => 'int'
	];

	protected $dates = [
		'download_date'
	];

	protected $fillable = [
		'user_id',
		'download_date',
		'estate_id'
	];
}
