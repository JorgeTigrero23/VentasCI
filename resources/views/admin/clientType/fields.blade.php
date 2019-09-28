<!-- Id Field -->
<div class="form-group col-sm-12">
    {!! isset($clientType->id)? Form::hidden('id', $clientType->id) : "" !!}
</div>

    {{-- {!! Form::hidden('id', $category->id) !!} --}}
<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tipocliente.index') !!}" class="btn btn-default">Cancelar</a>
</div>