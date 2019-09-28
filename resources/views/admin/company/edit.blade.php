@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Datos de la Empresa
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       
       <div class="box box-primary">
           <div class="box-body">
                @include('flash::message')
               <div class="row">
                   {!! Form::model($company, ['route' => ['empresa.update', $company->id], 'method' => 'patch', 'enctype' => "multipart/form-data"]) !!}

                        @include('admin.company.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection