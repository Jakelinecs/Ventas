@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Personas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>!Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{$error}}</span>
                                    @endforeach
                                    <button type= "button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">$times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::open(array('route'=>'personas.store', 'method'=>'POST')) !!}
                            <div class="row">


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipo_persona">tipo de persona</label>
                                        {!! Form::text('tipo_persona',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tipo_documento">tipo de documento</label>
                                        {!! Form::text('tipo_documento',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="num_documento">Numero   de documento</label>
                                        {!! Form::text('num_documento',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        {!! Form::text('direccion',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="telefono">telefono</label>
                                        {!! Form::text('telefono',null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        {!! Form::text('email',null,array('class'=>'form-control','id'=>'email', 'type'=>'email')) !!}
                                    </div>
                                </div>




                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
