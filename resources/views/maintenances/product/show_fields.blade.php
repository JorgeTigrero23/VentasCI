
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    <p> {!! $product->id !!} </p>
</div>

<div class="form-group">
    <!-- Barcode Field -->
    {!! Form::label('barcode', 'Código de Barra:') !!}
    <p> {!! $product->barcode !!} </p>
</div>

<div class="form-group">
    <!-- Name Field -->
    {!! Form::label('name', 'Nombre:') !!}
    <p> {!! $product->name !!} </p>
</div>

<div class="form-group">
    <!-- Description Field -->
    {!! Form::label('description', 'Descripción:') !!}
    <p> {!! $product->description !!} </p>
</div>

<div class="form-group">
    <!-- Price Field -->
    {!! Form::label('price', 'Precio:') !!}
    <p> {!! $product->price !!} </p>
</div>

<div class="form-group">
    <!-- Stock Field -->
    {!! Form::label('stock', 'Stock:') !!}
    <p> {!! $product->stock !!} </p>
</div>

<div class="form-group">
    <!-- product Field -->
    {!! Form::label('catgory', 'Categoría:') !!}
    <p> {!! $product->category->name !!} </p>
</div>

<div class="form-group">
    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    <p> {!! $product->created_at !!} </p>
</div>

<div class="form-group">
    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    <p> {!! $product->updated_at !!} </p>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

