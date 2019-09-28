
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    <p> {!! $clientType->id !!} </p>
</div>
<div class="form-group">
    <!-- Name Field -->
    {!! Form::label('name', 'Nombre:') !!}
    <p> {!! $clientType->name !!} </p>
</div>
<div class="form-group">
    <!-- Description Field -->
    {!! Form::label('description', 'Descripción:') !!}
    <p> {!! $clientType->description !!} </p>
</div>
<div class="form-group">
    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    <p> {!! $clientType->created_at !!} </p>
</div>
<div class="form-group">
    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    <p> {!! $clientType->updated_at !!} </p>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}</p>--}}
</div>

