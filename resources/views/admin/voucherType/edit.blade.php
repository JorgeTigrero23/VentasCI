@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Tipo de Comprobante
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($voucherType, ['route' => ['tipocomprobante.update', $voucherType->id], 'method' => 'patch']) !!}

                        @include('admin.voucherType.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection