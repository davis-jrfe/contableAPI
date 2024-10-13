<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvProducto;
use Process;

class provproductoController extends Controller
{
    //Funcion para mostrar las vinculaciones de los productos con proveedores
    public function index()
    {
        $vinculacion = ProvProducto::all();
        if($vinculacion->isEmpty()){
            $result=[
                'message'=>'No hay vinculaciones',
                'status'=>'404'
            ];
            return response()->json($result, 404);
        }else{
            return response()->json(ProvProducto::all(), 200);
        }
    }



    //Creacion para crear una vinculacion de producto con proveedor
    public function store(Request $request)
    {
        $vinculacion = ProvProducto::create([
            'idProveedor'=>$request->idProveedor,
            'idProducto'=>$request->idProducto
        ]);

        return response()->json([
            'message'=>'Se ha realizado la vinculacion',
            'success'=>true,
            'data'=>$vinculacion
        ], 201);
    }

    //Funcion para mostrar vinculacion por proveedor
    public function show($idProveedor)
    {
        $vinculacion = ProvProducto::find($idProveedor);
        return response()->json($vinculacion, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    //Funcion para eliminar una vinculacion
    public function destroy($idProveedor)
    {
        ProvProducto::find($idProveedor)->delete();
        return response()->json([
            'success'=>true,
        ], 200);
    }
}
