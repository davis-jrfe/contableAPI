<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productosController extends Controller
{
    //Funcion para obtener lista de productos
    public function index()
    {
        $productos= DB::select("SELECT p.idProducto,p.codigo,p.nombreProducto,c.nombreCategoria,p.cantidad,pr.nombreProveedor FROM productos p JOIN prov_productos pp ON p.idProducto = pp.idProducto JOIN proveedores pr ON pp.idProveedor = pr.idProveedor JOIN  categoria c ON p.idCategoria = c.idCategoria");
        if(!$productos){
            $result=[
                'message'=>'No hay productos registrados',
                'status'=>404
            ];
            return response()->json($result,404);
        }
        else{
            $result=[
                'status'=>200,
                'informacion'=>$productos
            ];
            return response()->json($result,200);
        }
    }


    //Funcion para agregar un producto
    public function store(Request $request)
    {
        $producto = Producto::create([
            'idProducto'=>$request->idProducto,
            'codigo'=>$request->codigo,
            'nombreProducto'=>$request->nombreProducto,
            'idCategoria'=>$request->idCategoria,
            'idProveedor'=>$request->idProveedor,
            'cantidad'=>$request->cantidad,
            'descripcion'=>$request->descripcion
        ]);
        return response()->json($producto,201);
    }

    //Funcion para mostrar producto especifico
    public function show($idProducto)
    {
        $producto = Producto::find($idProducto);
        return response()->json($producto,200);
    }

    //Funcion para actualizar un producto
    public function update(Request $request, $idProducto)
    {
        $newProd = Producto::find($idProducto);
        $newProd->codigo = $request->codigo;
        $newProd->nombreProducto = $request->nombreProducto;
        $newProd->idCategoria = $request->idCategoria;
        $newProd->idProveedor = $request->idProveedor;
        $newProd->cantidad = $request->cantidad;
        $newProd->descripcion = $request->descripcion;
        $newProd->save();

        return response()->json([
            'success' => true,
            'data' => $newProd
        ], 200);
    }

    //Funcion para eliminar un producto
    public function destroy($idProducto)
    {
        $producto = Producto::find($idProducto)->delete();
        return response()->json([
            'success'=>true,
        ],200);
    }
}
