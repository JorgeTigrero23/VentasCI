@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Editar Cliente
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Cliente
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($client, ['route' => ['cliente.update', $client->id], 'method' => 'patch','enctype' => "multipart/form-data"]) !!}
                   {!! Form::hidden('id', $client->id) !!}
                        @include('maintenances.client.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection