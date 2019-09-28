@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Venta
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('movements.sale.show_fields')
                    <a href="{!! route('venta.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection

