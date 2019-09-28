
<div class="form-group">
    <!-- Id Field -->
    {!! Form::label('id', 'Id:') !!}
    {!! $voucherType->id !!}<br>

    <!-- Name Field -->
    {!! Form::label('name', 'Name:') !!}
    {!! $voucherType->name !!}<br>

    <!-- Quantity Field -->
    {!! Form::label('quantity', 'Cantidad:') !!}
    {!! $voucherType->quantity !!}<br>
    
    <!-- Igv Field -->
    {!! Form::label('igv', 'Igv:') !!}
    {!! $voucherType->igv !!}<br>

    <!-- Serie Field -->
    {!! Form::label('serie', 'Serie:') !!}
    {!! $voucherType->serie !!}<br>

    <!-- Created At Field -->
    {!! Form::label('created_at', 'Fecha Creación:') !!}
    {!! $voucherType->created_at !!}<br>

    <!-- Updated At Field -->
    {!! Form::label('updated_at', 'Fecha Modificación:') !!}
    {!! $voucherType->updated_at !!}<br>

    {{--<!-- Deleted At Field -->--}}
    {{--{!! Form::label('deleted_at', 'Deleted At:') !!}--}}
    {{--{!! $user->deleted_at !!}<br>--}}
</div>

