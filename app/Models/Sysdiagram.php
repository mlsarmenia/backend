<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sysdiagram
 *
 * @property string|null $name
 * @property int|null $principal_id
 * @property int $diagram_id
 * @property int|null $version
 * @property string|null $definition
 *
 * @package App\Models
 */
class Sysdiagram extends Model
{
	protected $table = 'sysdiagrams';
	protected $primaryKey = 'diagram_id';

	public $timestamps = false;

	protected $casts = [
		'principal_id' => 'int',
		'diagram_id' => 'int',
		'version' => 'int'
	];

	protected $fillable = [
		'name',
		'principal_id',
		'version',
		'definition'
	];
}
