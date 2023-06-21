<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;



class CategoriaApiController extends Controller
{
    //

    public function index()
{
    $categorias = Categoria::paginate(10);

    return response()->json($categorias);
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|unique:categorias|max:50',
        'descripcion' => 'nullable',
        'estado' => 'boolean'
    ]);

    $categoria = new Categoria();
    $categoria->nombre = $request->nombre;
    $categoria->descripcion = $request->descripcion;
    $categoria->estado = $request->estado ?? true;
    $categoria->save();

    return response()->json($categoria, 201);
}


public function update(Request $request, $id)
{
    $this->validate($request, [
        'nombre' => 'required|unique:categorias|max:50',
        'descripcion' => 'nullable',
        'estado' => 'boolean'
    ]);

    $categoria = Categoria::find($id);
    $categoria->nombre = $request->nombre;
    $categoria->descripcion = $request->descripcion;
    $categoria->estado = $request->estado ?? true;
    $categoria->save();

    return response()->json($categoria, 200);
}
public function destroy($id)
{
    $categoria = Categoria::find($id);
    $categoria->delete();

    return response()->json(null, 204);
}

}
