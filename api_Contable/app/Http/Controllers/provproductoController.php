<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProvProducto;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Output\ConsoleOutput;
use Process;

//LA TABLA PROV_PRODUCTO SE LE PUEDE HACER REFERENCIA COMO VINCULACION/VINCULACIONES

class provproductoController extends Controller
{
    //Funcion para mostrar las vinculaciones de los productos con proveedores
    public function index()
    {
        $vinculacion = DB::select("SELECT 
    prov_productos.idProveedor, 
    proveedores.nombreProveedor, 
    prov_productos.idProducto, 
    productos.nombreProducto FROM prov_productos JOIN proveedores ON prov_productos.idProveedor = proveedores.idProveedor JOIN productos ON prov_productos.idProducto = productos.idProducto");
        if(!$vinculacion){
            $result=[
                'message'=>'No hay vinculaciones de productos con proveedores',
                'status'=>'404'
            ]; 
            return response()->json($result,404);
        }else{
            $result=[
                'status'=>200,
                'vinculaciones'=>$vinculacion
            ];
            return response()->json($result,200);
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
        $vinculacion = DB::select("
            SELECT 
                prov_productos.idProducto, 
                productos.nombreProducto
            FROM 
                prov_productos
            JOIN 
                productos ON prov_productos.idProducto = productos.idProducto
            WHERE 
                prov_productos.idProveedor = ?
        ", [$idProveedor]);

        if(!$vinculacion){
            return response()->json([
                'message' => 'No se encontraron productos para este proveedor',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'productos' => $vinculacion
        ], 200);
    }

    //
    public function update(Request $request, string $id)
    {
        //
    }

    //Funcion para eliminar una vinculacion pidienco como parametro idProveedor e idProducto
    public function delete($idProveedor, $idProducto)
    {
        //Vinculacion por proveedor y producto
        $vinculacion = DB::table('prov_productos')->where('idProveedor',$idProveedor)->where('idProducto',$idProducto)->first();
        
        if(!$vinculacion){
            return response()->json([
                'message'=>'No hay vinculacion con ese producto y ese proveedor',
                'status'=>404
            ],404);
        }

        // Eliminamos la vinculación
        DB::table('prov_productos')
        ->where('idProveedor', $idProveedor)
        ->where('idProducto', $idProducto)
        ->delete();

        return response()->json([
            'message' => 'La vinculación ha sido eliminada correctamente',
            'status' => 200
        ], 200);
    }
}
