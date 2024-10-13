<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use App\Models\Categorium;
use App\Http\Requests\CategoriaRequest;


class categoriaController extends Controller
{
    //Funcion para obtener lista de categorias
    public function index()
    {
        $categoria = Categorium::all();
        if($categoria->isEmpty()){
            $result=[
                'message'=>'No hay categorias registradas',
                'status'=>'404'
            ];
            return response()->json($result,404);
        }
        else{
            return response()->json(Categorium::all(),200);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = Categorium::create([
            'nombreCategoria'=>$request->nombreCategoria,
            'descripcion'=>$request->descripcion,
        ]);

        return response()->json([
            'message'=>'Se ha agregado una categoria',
            'success'=>true,
            'data'=>$categoria
        ],201);
    }

    //Funcion para obtener categoria especifica
    public function show($idCategoria)
    {
        $categoria = Categorium::find($idCategoria);
        return response()->json($categoria,200);
    }

    //Actualizar categoria
    public function update(Request $request, $idCategoria)
    {
        $newCate = Categorium::find($idCategoria);
        $newCate->nombreCategoria = $request->nombreCategoria;
        $newCate->descripcion = $request->descripcion;
        $newCate->save();

        return response()->json([
            'success' => true,
            'data' => $newCate
        ],200);
    }

    //Funcion para eliminar categoria
    public function destroy($idCategoria)
    {
        Categorium::find($idCategoria)->delete();
        return response()->json([
            'success'=>true,
        ],200);
    }
}
