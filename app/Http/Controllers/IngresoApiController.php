<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Models\DetalleIngreso;
use App\Models\Ingreso;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\User;


class IngresoApiController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::paginate(10);

        for ($i = 0; $i < count($ingresos); $i++) {
            $proveedor = Persona::find($ingresos[$i]['idproveedor']);
            $ingresos[$i]['idproveedor'] = $proveedor->nombre;
        }

        return response()->json($ingresos);
    }

    public function create()
    {
        $productos = Producto::all();
        $proveedores = Persona::where('tipo_persona', 'Proveedor')->get();

        return response()->json([
            'productos' => $productos,
            'proveedores' => $proveedores
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validar los datos de la ingreso
        $request->validate([
            'idproveedor' => 'required',

            'productos.*' => 'required',
            'precio.*' => 'required',
            'cantidad.*' => 'required|integer|min:1',
        ]);

        $request['num_comprobante'] = $request->num_comprobante ?? "000000";
        $impuesto=0;
        if($request->tipo_comprobante == "recibo"){
            $impuesto = 0.15;
        }


        // Crear una nueva ingreso
        $ingreso = Ingreso::create([
            'idproveedor' => $request->idproveedor,
            'idusuario' => auth()->id(),
            'tipo_comprobante'=> $request->tipo_comprobante,
            'serie_comprobante'=> $request->serie_comprobante,
            'num_comprobante'=> $request->num_comprobante,
            'fecha'=> now() ,
            'impuesto'=> $impuesto,
            'total' => 0, // Se actualizará más adelante
            'estado' => 'Pendiente',
        ]);

        // Calcular el total de la ingreso y crear los detalles de ingreso
        $totalVenta = 0;
        foreach ($request->productos as $index => $idProducto) {
            $subcadenas = explode(" ", $idProducto);
            $producto = Producto::findOrFail($subcadenas[0]);
            $cantidad = $request->cantidad[$index];
            $precio = $request->precio[$index];

            $subtotal = $precio * $cantidad;
            $totalVenta += ($subtotal );

            DetalleIngreso::create([
                'idingreso' => $ingreso->id,
                'idproducto' => $subcadenas[0],
                'cantidad' => $cantidad,
                'precio' => $precio,
            ]);

            // Actualizar el stock del producto
            $producto->stock += $cantidad;
            $producto->save();
        }

        // Actualizar el total de la ingreso
        $ingreso->impuesto = $totalVenta *$impuesto ;
        // Actualizar el total de la ingreso
        $ingreso->total = $totalVenta ;
        $ingreso->estado ="Concluido" ;
        $ingreso->save();

        return response()->json($ingreso, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        //        $productos = Producto::where('stock', '>', 0)->get();
        $ingreso = Ingreso::find($id);
        // Obtener el nombre del cliente
        $proveedor = Persona::find($ingreso->idproveedor)->nombre;
        // Obtener el nombre del usuario
        $usuario = User::find($ingreso->idusuario)->name;
        // Obtener los detalles de la ingreso
        $detalles = DetalleIngreso::where('idingreso', $id)->get();

        for ($i = 0; $i < count($detalles); $i++) {
            $producto = Producto::find($detalles[$i]['idproducto']);
            $detalles[$i]['idproducto'] = $producto->nombre;
        }
        $productos = Producto::all();

//        return view('ingresos.show', compact('ingreso', 'productos', 'proveedor','usuario', 'detalles'));
        return response()->json([
            'ingreso' => $ingreso,
            'detalles' => $detalles
        ]);

    }

    public function edit($id)
    {
        $ingreso = Ingreso::findOrFail($id);
        $proveedores = Persona::all();
        $productos = Producto::all();
        $detalles = DetalleIngreso::where('idingreso', $id)->get();
        return response()->json([
            'ingreso' => $ingreso,
            'proveedores' => $proveedores,
            'productos' => $productos,
            'detalles' => $detalles
        ]);    }


    public function update(Request $request, $id)
    {
        // Validar los datos de la ingreso
        $request->validate([
            'idproveedor' => 'required',

            'productos.*' => 'required',
            'descuento.*' => 'required',
            'cantidad.*' => 'required|integer|min:1',
        ]);

        $request['num_comprobante'] = $request->num_comprobante ?? "000000";
        $impuesto=0;
        if($request->tipo_comprobante == "recibo"){
            $impuesto = 0.15;
        }

        $ingreso = Venta::findOrFail($id);
        $ingreso->idproveedor = $request->idproveedor;
        $ingreso->tipo_comprobante = $request->tipo_comprobante;
        $ingreso->serie_comprobante = $request->serie_comprobante;
        $ingreso->num_comprobante = $request->num_comprobante;
        $ingreso->save();

        // Eliminar los detalles de ingreso existentes
        $ingreso->detalleVentas()->delete();

        // Crear los nuevos detalles de ingreso
        // Calcular el total de la ingreso y crear los detalles de ingreso
        $totalVenta = 0;
        foreach ($request->productos as $index => $idProducto) {
            $subcadenas = explode(" ", $idProducto);
            $producto = Producto::findOrFail($subcadenas[0]);
            $cantidad = $request->cantidad[$index];
            $precio = $producto->precio_ingreso;
            $descuento = $request->descuento[$index];

            $subtotal = $precio * $cantidad;
            $totalVenta += ($subtotal - $descuento);

            DetalleVenta::create([
                'idingreso' => $ingreso->id,
                'idproducto' => $subcadenas[0],
                'cantidad' => $cantidad,
                'precio' => $precio,
                'descuento' => $descuento,
            ]);

            // Actualizar el stock del producto
            $producto->stock -= $cantidad;
            $producto->save();
        }

        // Actualizar el total de la ingreso
        $ingreso->impuesto = $totalVenta *$impuesto ;
        // Actualizar el total de la ingreso
        $ingreso->total = $totalVenta ;
        $ingreso->estado ="Concluido" ;
        $ingreso->save();

        return response()->json($ingreso);
    }


    public function destroy($id)
    {
        //
        $ingreso = Venta::find($id);
        Venta::find($id)->delete();



        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
