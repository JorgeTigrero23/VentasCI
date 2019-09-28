@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Editar Producto
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Producto
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($product, ['route' => ['producto.update', $product->id], 'method' => 'patch','enctype' => "multipart/form-data"]) !!}
                        {!! Form::hidden('id', $product->id) !!}
                        @include('maintenances.product.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection