<div>
<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'Nombres:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Apellidos:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Document Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_type_id', 'Tipo de Documento:') !!}
    <select name="document_type_id" id="document_type_id" class="form-control">
        <option value=""> -- Seleccione -- </option>
        @foreach($documentTypes as $documentType)
            <option value="{{$documentType->id}}" >{{$documentType->name}}</option>
        @endforeach
    </select>
</div>

<!-- Document Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_number', 'Num. Documento:') !!}
    {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Teléfono:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mail', 'Email:') !!}
    {!! Form::email('mail', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_type_id', 'Tipo de Cliente:') !!}
    <select name="client_type_id" id="client_type_id" class="form-control">
        <option value=""> -- Seleccione -- </option>
        @foreach($clientTypes as $clientType)
            <option value="{{$clientType->id}}" >{{$clientType->name}}</option>
        @endforeach
    </select>
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
</div>
