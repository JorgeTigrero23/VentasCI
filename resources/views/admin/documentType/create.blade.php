@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Tipo de Documento
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Crear Tipo de Documento
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tipodocumento.store']) !!}

                        @include('admin.documentType.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
