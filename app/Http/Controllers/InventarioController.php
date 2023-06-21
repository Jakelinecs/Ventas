<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\DetalleVenta;


class InventarioController extends Controller
{
    //

    public function index()
    {
        $faltantes = Producto::where('stock', '=', 0)->get();
        $excasos= Producto::where('stock', '<', 3)
                            ->where('stock', '>', 0)
                            ->get();
        $demandas = DetalleVenta::all();
        $productos = Producto::orderBy('stock', 'asc')->get();

        return view('inventarios.index', compact('faltantes','excasos','productos','demandas'));
    }

}
