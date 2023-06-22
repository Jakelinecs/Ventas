<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Categoria;
use App\Models\Producto;


use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener datos de ventas por categoría
        $ventasPorCategoria = Categoria::select('categorias.nombre', \DB::raw('COUNT(ventas.id) as total_ventas'))
        ->leftJoin('productos', 'categorias.id', '=', 'productos.idcategoria')
        ->leftJoin('detalle_ventas', 'productos.id', '=', 'detalle_ventas.idproducto')
        ->leftJoin('ventas', 'detalle_ventas.idventa', '=', 'ventas.id')
        ->groupBy('categorias.id')
        ->orderBy('total_ventas', 'desc')
        ->get();

        $ventasPorCategoriaData = [
        'labels' => $ventasPorCategoria->pluck('nombre'),
        'values' => $ventasPorCategoria->pluck('total_ventas'),
        ];

        // Obtener datos de ventas por producto
        $ventasPorProducto = Producto::select('productos.nombre', \DB::raw('COUNT(detalle_ventas.id) as total_ventas'))
        ->leftJoin('detalle_ventas', 'productos.id', '=', 'detalle_ventas.idproducto')
        ->groupBy('productos.id')
        ->orderBy('total_ventas', 'desc')
        ->get();

        $ventasPorProductoData = [
        'labels' => $ventasPorProducto->pluck('nombre'),
        'values' => $ventasPorProducto->pluck('total_ventas'),
        ];


        // Obtener datos de evolucion de las ventas
        $evolucionVentas = Venta::select('fecha_hora', 'total')
        ->orderBy('fecha_hora')
        ->get();

        // Preparar los datos para el gráfico
        $labels = [];
        $values = [];

        foreach ($evolucionVentas as $venta) {
            $fecha = Carbon::parse($venta->fecha_hora); // Convertir a objeto Carbon
            $labels[] = $fecha->format('Y-m-d');
            $values[] = $venta->total;
        }

        $evolucionVentasData = [
            'labels' => $labels,
            'values' => $values,
        ];

        return view('home', compact('ventasPorCategoriaData', 'ventasPorProductoData','evolucionVentasData'));
    }
}
