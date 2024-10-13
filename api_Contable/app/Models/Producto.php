<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $idProducto
 * @property string $codigo
 * @property string $nombreProducto
 * @property string $descripcion
 * @property int $idProveedor
 * @property int $idCategoria
 * @property int $cantidad
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'productos';
	protected $primaryKey = 'idProducto';
	public $timestamps = false;

	protected $casts = [
		'idProveedor' => 'int',
		'idCategoria' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'codigo',
		'nombreProducto',
		'descripcion',
		'idProveedor',
		'idCategoria',
		'cantidad'
	];
}
