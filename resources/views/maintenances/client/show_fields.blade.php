
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $client->id !!}</p>
</div>

<div class="form-group">
    <!-- First Name Field -->
    {!! Form::label('first_name', 'Nombres:') !!}
    <p>{!! $client->first_name !!}</p>
</div>

<div class="form-group">
    <!-- Last Name Field -->
    {!! Form::label('last_name', 'Apellidos:') !!}
    <p>{!! $client->last_name !!}</p>
</div>

<div class="form-group">
    <!-- Client Type Field -->
    {!! Form::label('client_type', 'Tipo de Cliente:') !!}
    <p>{!! $client->client_type->name !!}</p>
</div>

<div class="form-group">
    <!-- Document Type Field -->
    {!! Form::label('document_type', 'Tipo de Documento:') !!}
    <p>{!! $client->document_type->name !!}</p>
</div>

<div class="form-group">
    <!-- Document Number Field -->
    {!! Form::label('document_number', 'Número de Documento:') !!}
    <p>{!! $client->document_number !!}</p>
</div>

<div class="form-group">
    <!-- Phone Field -->
    {!! Form::label('phone', 'Teléfono:') !!}
    <p>{!! $client->phone !!}</p>
</div>

<div class="form-group">
    <!-- Address Field -->
    {!! Form::label('address', 'Dirección:') !!}
    <p>{!! $client->address !!}</p>
</div>

<div class="form-group">
    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    <p>{!! $client->created_at !!}</p>
</div>

<div class="form-group">
    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    <p>{!! $client->updated_at !!}</p>
</div>
    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $client->deleted_at !!}<p>--}}
