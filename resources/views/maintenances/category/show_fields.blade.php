
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $category->id !!}</p>
</div>

<div class="form-group">
    <!-- Name Field -->
    {!! Form::label('name', 'Nombre:') !!}
    <p>{!! $category->name !!}</p>
</div>

<div class="form-group">
    <!-- Description Field -->
    {!! Form::label('description', 'Descripción:') !!}
    <p>{!! $category->description !!}</p>
</div>

<div class="form-group">
    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    <p>{!! $category->created_at !!}</p>
</div>

<div class="form-group">
    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    <p>{!! $category->updated_at !!}</p>
</div>
    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

