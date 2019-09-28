@extends('adminlte::layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Editar Categoria
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category, ['route' => ['categoria.update', $category->id], 'method' => 'patch']) !!}
                        {!! Form::hidden('id', $category->id) !!}
                        @include('maintenances.category.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection