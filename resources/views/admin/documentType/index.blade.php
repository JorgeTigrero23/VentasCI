@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Tipo de Documento
@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tipos de Documentos</h1>
        <h1 class="pull-right">
           <a class="btn btn-success pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tipodocumento.create') !!}">Agregar Nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.documentType.table')
            </div>
        </div>
    </div>
@endsection

