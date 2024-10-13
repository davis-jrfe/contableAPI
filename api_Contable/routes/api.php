<?php

use App\Http\Controllers\categoriaController;
use App\Http\Controllers\provproductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\proveedoresController;
use App\Http\Controllers\productosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('/proveedores',proveedoresController::class);
Route::resource('/categoria', categoriaController::class);
Route::resource('/productos',productosController::class);
Route::resource('/provproductos', provproductoController::class);
//Route::get('/proveedoresID',[proveedoresController::class, 'indexbyID']);