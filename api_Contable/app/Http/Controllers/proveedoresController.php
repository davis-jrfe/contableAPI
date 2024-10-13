<?php

namespace App\Http\Controllers;

use App\Http\Requests\proveedorRequest;
use App\Models\Proveedore;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;

class proveedoresController extends Controller
{
    //Funcion para obtener la lista de proveedores
    public function index()
    {
        $proveedores= Proveedore::all();
        if($proveedores->isEmpty()){
            $result=[
                'message'=>'No hay proveedores',
                'status'=>'404'
            ];
            return response()->json($result,404);
        }
        else{
            return response()->json(Proveedore::all(),200);
        }
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(proveedorRequest $request)
    {
        $proveedor = Proveedore::create([
            'idProveedor'=>$request->idProveedor,
            'nombreProveedor'=>$request->nombreProveedor,
            'nombreComercial'=>$request->nombreComercial,
            'correo'=>$request->correo,
            'telefono'=>$request->telefono,
            'direccion'=>$request->direccion
        ]);
        return response()->json($proveedor,201);
    }

    //Funcion para mostrar un proveedor
    public function show($idProveedor)
    {
        $proveedor=Proveedore::find($idProveedor);
        return response()->json($proveedor,200);
    }

    //Funcion para actualizar proveedor
    public function update(Request $request, $idProveedor)
    {
        $newProv = Proveedore::find($idProveedor);
        $newProv->nombreProveedor = $request->nombreProveedor;
        $newProv->nombreComercial = $request->nombreComercial;
        $newProv->correo = $request->correo;
        $newProv->telefono = $request->telefono;
        $newProv->direccion = $request->direccion;
        $newProv->save();

        return response()->json([
            'success'=>true,
            'data' => $newProv
        ], 200);
    }

    //Funcions para eliminar un proveedor
    public function destroy($idProveedor)
    {
        $proveedor = Proveedore::find($idProveedor)->delete();
        return response()->json([
            'success'=>true,
        ],200);
    }
}
