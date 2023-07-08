@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Sistema de Ventas e Inventario</h3>
        </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                @can('crear-venta')
                <a class="btn btn-warning" href="{{ route('ventas.create') }}"> Revistrar Venta </a>
                @endcan
                @can('crear-ingreso')
                <a class="btn btn-warning" href="{{ route('ingresos.create') }}">Registrar ingreso de Peridos</a>
                @endcan
            </div>


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">


                                <!--
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-color-01 order-card">
                                            <div class="card-block">
                                                <h5>Usuarios</h5>
                                                @php
                                                use App\Models\User;
                                                $cant_user =User::count();
                                            @endphp
                                            {{count(App\Models\User::all())}}
                                            <h2 class="text-right"><i class="fas fa-users f-left"></i><span>{{ $cant_user }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/usuarios" > Ver mas </a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-c-color-03 order-card">
                                        <div class="card-block">
                                            <h5>Blog</h5>
                                            @php
                                            use App\Models\Blog;
                                            $cant_blog = Blog::count();
                                            @endphp
                                            <h2 class="text-right"><i class="fas fa-users f-left"></i><span>{{ $cant_blog }}</span></h2>
                                            <p class="m-b-0 text-right"><a href="/blogs" > Ver mas </a></p>
                                        </div>
                                    </div>
                                </div>


                            -->


                            <h1>Dashboard de Ventas</h1>

                                <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <canvas id="graficoVentas"></canvas>
                                </div>

                                    <div class="col-md-6">
                                        <canvas id="ventasPorCategoria"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <canvas id="ventasPorProducto"></canvas>
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


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        // Obtener los datos para los gráficos desde el controlador
        var ventasPorCategoriaData = {!! json_encode($ventasPorCategoriaData) !!};
        var ventasPorProductoData = {!! json_encode($ventasPorProductoData) !!};
        const evolucionVentas = {!! json_encode($evolucionVentasData) !!};

        // Configurar y renderizar el gráfico de ventas por categoría
        var ventasPorCategoriaCtx = document.getElementById('ventasPorCategoria').getContext('2d');
        var ventasPorCategoriaChart = new Chart(ventasPorCategoriaCtx, {
            type: 'bar',
            data: {
                labels: ventasPorCategoriaData.labels,
                datasets: [{
                    label: 'Ventas por Categoría',
                    data: ventasPorCategoriaData.values,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Configurar y renderizar el gráfico de ventas por Producto
        var ventasPorProductoCtx = document.getElementById('ventasPorProducto').getContext('2d');
        var ventasPorProductoChart = new Chart(ventasPorProductoCtx, {
            type: 'bar',
            data: {
                labels: ventasPorProductoData.labels,
                datasets: [{
                    label: 'Ventas por Productos',
                    data: ventasPorProductoData.values,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });



         // Crear el contexto del gráfico
         const ctx = document.getElementById('graficoVentas').getContext('2d');

        // Crear el gráfico de línea
        const graficoVentas = new Chart(ctx, {
            type: 'line',
            data: {
                labels: evolucionVentas.labels,
                datasets: [{
                    label: 'Evolución de Ventas',
                    data: evolucionVentas.values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Fecha'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Ventas'
                        }
                    }
                }
            }
        });



    </script>
@endsection


