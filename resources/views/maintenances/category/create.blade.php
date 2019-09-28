@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Crear Cateoría
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Categoria
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'categoria.store']) !!}

                        @include('maintenances.category.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
