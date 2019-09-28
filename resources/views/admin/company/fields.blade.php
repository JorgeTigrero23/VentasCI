<!-- Id Field -->
<div class="form-group col-sm-3" hidden="true">
    {!! isset($company->id)? Form::hidden('id', $company->id) : "" !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Nature Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nature', 'Naturaleza:') !!}
    {!! Form::text('nature', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-3">
    {!! Form::label('phone', 'Teléfono:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Fax Field -->
<div class="form-group col-sm-3">
    {!! Form::label('fax', 'Fax:') !!}
    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-3">
    {!! Form::label('country', 'País:') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-3">
    {!! Form::label('city', 'Ciudad:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Dirección:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Imagen Field -->
<div class="form-group col-sm-12">
    {!! Form::label('imagen', 'Imagen:') !!}
    <input id="files" name="image" type="file">
    @if($company->image != null)
        <img src="{{ asset('img/'. $company->image) }}" width="200px" height="200px" style="margin: 5px;">
    @endif
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
