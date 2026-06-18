<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailDocument
 *
 * @property int $id
 * @property int|null $mail_id
 * @property int|null $document_id
 *
 * @package App\Models
 */
class MailDocument extends Model
{
	protected $table = 'mail_documents';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'mail_id' => 'int',
		'document_id' => 'int'
	];

	protected $fillable = [
		'mail_id',
		'document_id'
	];
}
