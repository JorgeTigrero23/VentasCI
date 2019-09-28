<!-- Barcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('barcode', 'Código de Barra:') !!}
    {!! Form::number('barcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Precio:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
        {!! Form::label('category_id', 'Catégoria:') !!}
        <select name="category_id" id="category_id" class="form-control">
            <option value=""> -- Seleccione -- </option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
            @endforeach
        </select>
    </div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('producto.index') !!}" class="btn btn-default">Cancelar</a>
</div>
