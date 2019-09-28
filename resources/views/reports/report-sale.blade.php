@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Reporte Categorias
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Reporte Categoria
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    <div id="viewPdf">
                        <div class="panel">

                            <div class="panel-heading">
                                <div class="col-xs-8"></div>
                            </div>
                            <div class="panel-body">
                                <iframe src="{{ route('report.view.sales')}}" width = "100%" height = "600"></iframe>
                            </div>
                    
                        </div>
                            
                    </div>	
                </div>
            </div>
        </div>
    </div>
@endsection