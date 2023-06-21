@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Persona</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        @can('crear-persona')
                            <a class="btn btn-warning" href="{{ route('personas.create') }}"> Nuevo </a>
                        @endcan


                            <table id="data-table" class = "table table-striped mt-2">
                                <thead >
                                    <th>ID</th>
                                    <th>Tipo de Persona</th>
                                    <th>Nombre</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número de Documento</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th> Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach($personas as $persona)
                                    <tr>
                                        <td>{{ $persona->id }}</td>
                                        <td>{{ $persona->tipo_persona }}</td>
                                        <td>{{ $persona->nombre }}</td>
                                        <td>{{ $persona->tipo_documento }}</td>
                                        <td>{{ $persona->num_documento }}</td>
                                        <td>{{ $persona->direccion }}</td>
                                        <td>{{ $persona->telefono }}</td>
                                        <td>{{ $persona->email }}</td>
                                        <td>
                                        @can('editar-persona')
                                            <a class = "btn btn-info" href="{{ route('personas.edit',$persona->id) }}"> Editar </a>
                                        @endcan

                                        @can('borrar-persona')
                                            {!! Form::open(['method' => 'DELETE','route' => ['personas.destroy', $persona->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('borrar', ['class'=>'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $personas->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

