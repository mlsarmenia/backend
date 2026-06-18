<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactVisit
 *
 * @property int $id
 * @property int|null $contact_id
 * @property Carbon|null $created_date
 * @property int|null $estate_id
 *
 * @package App\Models
 */
class ContactVisit extends Model
{
	protected $table = 'contact_visit';

	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'contact_id' => 'int',
		'estate_id' => 'int'
	];

	protected $dates = [
		'created_date'
	];

	protected $fillable = [
		'contact_id',
		'created_date',
		'estate_id'
	];
}
