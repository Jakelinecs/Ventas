@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inventario</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container">

                                <div class="row">
                                    <div class="col-md-4">
                                        <h2>Productos con stock igual a 0:</h2>
                                        <ul class="list-group">
                                            @foreach ($faltantes as $producto)
                                                <li class="list-group-item">{{ $producto->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Productos con stock menor a 3 y mayores a 0:</h2>
                                        <ul class="list-group">
                                            @foreach ($excasos as $producto)
                                                <li class="list-group-item">{{ $producto->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Productos ordenados por stock:</h2>
                                        <ul class="list-group">
                                            @foreach ($productos as $producto)
                                                <li class="list-group-item">
                                                    {{ $producto->nombre }} - Stock: {{ $producto->stock }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




