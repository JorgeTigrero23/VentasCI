@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Tipo de Documento
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($documentType, ['route' => ['tipodocumento.update', $documentType->id], 'method' => 'patch']) !!}

                        @include('admin.documentType.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection