<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedore
 * 
 * @property int $idProveedor
 * @property string $nombreProveedor
 * @property string $nombreComercial
 * @property string $correo
 * @property string $telefono
 * @property string $direccion
 *
 * @package App\Models
 */
class Proveedore extends Model
{
	protected $table = 'proveedores';
	protected $primaryKey = 'idProveedor';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProveedor' => 'int'
	];

	protected $fillable = [
		'nombreProveedor',
		'nombreComercial',
		'correo',
		'telefono',
		'direccion'
	];
}
