
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    <p> {!! $documentType->id !!} </p>
</div>

<div class="form-group">
    <!-- Name Field -->
    {!! Form::label('name', 'Nombre:') !!}
    <p> {!! $documentType->name !!} </p>
</div>

<div class="form-group">    
    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    <p> {!! $documentType->created_at !!} </p>
</div>

<div class="form-group">
    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    <p> {!! $documentType->updated_at !!} </p>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

