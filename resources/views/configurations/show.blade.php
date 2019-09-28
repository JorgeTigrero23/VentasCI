@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Configuración
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('configurations.show_fields')
                    <a href="{!! route('configurations.index') !!}" class="btn btn-default">Atrás</a>
                </div>
            </div>
        </div>
    </div>
@endsection
