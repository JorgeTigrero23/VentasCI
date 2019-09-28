<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-12">
    {!! Form::label('quantity', 'Catidad:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Igv Field -->
<div class="form-group col-sm-12">
    {!! Form::label('igv', 'Igv:') !!}
    {!! Form::number('igv', null, ['class' => 'form-control']) !!}
</div>

<!-- Serie Field -->
<div class="form-group col-sm-12">
    {!! Form::label('serie', 'Serie:') !!}
    {!! Form::text('serie', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipocomprobante.index') !!}" class="btn btn-default">Cancelar</a>
</div>
