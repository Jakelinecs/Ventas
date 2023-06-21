<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoApiController extends Controller
{
    //
    public function index()
    {
        $productos = Producto::paginate(10);

        return response()->json($productos);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idcategoria' => 'required',
            'codigo' => 'nullable',
            'nombre' => 'required|unique:productos',
            'precio_venta' => 'required',
            'stock' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required',
        ]);

        Producto::create($request->all());

        return response()->json(['message' => 'Producto creado exitosamente', 'producto' => $producto]);
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return response()->json(['producto' => $producto, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idcategoria' => 'required',
            'codigo' => 'nullable',
            'nombre' => 'required|unique:productos,nombre,'.$id,
            'precio_venta' => 'required',
            'stock' => 'required',
            'descripcion' => 'nullable',
            'estado' => 'required',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return response()->json(['message' => 'Producto actualizado exitosamente', 'producto' => $producto]);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado exitosamente']);
    }

}
