<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProvProducto
 * 
 * @property int $idProveedor
 * @property int $idProducto
 *
 * @package App\Models
 */
class ProvProducto extends Model
{
	protected $table = 'prov_productos';

	// Indicar que no hay clave primaria
	protected $primaryKey = null;
	public $incrementing = false; // No debe incrementar ninguna clave

	// No necesitas timestamps
	public $timestamps = false;

	protected $casts = [
		'idProveedor' => 'int',
		'idProducto' => 'int'
	];

	protected $fillable = [
		'idProveedor',
		'idProducto'
	];
}
