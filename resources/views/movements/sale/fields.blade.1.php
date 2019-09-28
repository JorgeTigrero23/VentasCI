<div class="form-group">
    <!-- Voucher Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('voucher_type_id', 'Comprobante:') !!}
        <input type="hidden" name="voucher_type_id" id="voucher_type_id">
        <input type="hidden" id="igv" value="{{ isset($sale->voucher_type->igv)? $sale->voucher_type->igv: 0 }}">
        <select name="voucher" id="voucher" class="form-control">
            <option value=""> -- Seleccione -- </option>
            @foreach($voucherTypes as $voucherType)
                {{ $dataVoucher = $voucherType->id.'*'.$voucherType->quantity.'*'.$voucherType->igv.'*'.$voucherType->serie }}
                @if(isset($sale->voucher_type_id))
                    @if($sale->voucher_type_id == $voucherType->id)
                        <option value="{{$dataVoucher}}" selected >{{$voucherType->name}}</option>
                    @else
                        <option value="{{$dataVoucher}}">{{$voucherType->name}}</option>
                    @endif
                @else
                    <option value="{{$dataVoucher}}">{{$voucherType->name}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Serie Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('serie', 'Serie:') !!}
        {!! Form::text('serie', null, ['class' => 'form-control', 'readonly']) !!}
    </div>

    <!-- Document Number Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('voucher_number', 'Numero:') !!}
        {!! Form::text('voucher_number', null, ['class' => 'form-control', 'readonly'] ) !!}
    </div>
<div>

<div class="form-group">
    <!-- Client Number Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('client', 'Cliente:') !!}
        <div class="input-group">
            <input type="hidden" name="client_id" id="client_id">
        <input type="text" class="form-control" id="client" value=" {{ isset($sale->client->id)? $sale->client->last_name.' '.$sale->client->first_name: ''}}"> 
            <span class="input-group-btn">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-new-client" > <span class="fa fa-plus"></span> </button>
            </span>
        </div><!-- /input-group -->
    </div> 

    <!-- Date Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('date', 'Fecha:') !!}
        <input type="date" class="form-control" name="fecha" required>
    </div>
</div>


<div class="form-group">
    <!-- Product Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('product', 'Producto:') !!}
        <input type="text" class="form-control" id="product" name="product">
    </div>
    <div class="form-group col-sm-2">
        <label for="">&nbsp;</label>
        <button id="btnAddProduct" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
    </div>
</div>

<div class="form-group col-sm-12">
    <table id="tableSales" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th hidden="true">Item Id </th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock Max.</th>
                <th>Cantidad</th>
                <th>Importe</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- @if(isset($sale->sale_items))
                @foreach($sale->sale_items as $item)
                <tr>
                    <th><input type="hidden" name="product_id[]" value="{{ $item->product->id }}">{{ $item->product->barcode }}</th>
                    <th>{{ $item->product->name }}</th>
                    <th><input type="hidden" name="price[]" value="{{ $item->product->price }}"> {{ $item->product->price }}</th>
                    <th>{{ $item->product->stock }}</th>
                    <th><input type="number" name="quantity[]" class="cantidades" value="{{ $item->quantity }}" min="0"></th>
                    <th><input type="hidden" name="amounts[]" value="{{ $item->quantity * $item->product->price }}"><p>{{ number_format($item->quantity * $item->product->price, 2, '.', ',') }}</p></th>
                    <th><button type="button" class="btn btn-danger btn-remove-producto"><span class="fa fa-remove"></span></th>
                </tr>
                @endforeach
            @endif --}}
        </tbody>
    </table>

    <div class="form-group">
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-addon">Subtotal:</span>
            <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly" value="{{isset($sale->subtotal)? $sale->subtotal:''}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
            <span class="input-group-addon" id="labelIGv">IGV {{ isset($sale->voucher_type->igv)? $sale->voucher_type->igv.'%': '' }}: </span>
                <input type="text" class="form-control" placeholder="0.00" name="igv" readonly="readonly"  value="{{isset($sale->igv)? $sale->igv:''}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-addon">Descuento:</span>
                <input type="text" class="form-control" placeholder="0.00" name="descuento" value="{{isset($sale->discount)? $sale->discount:''}}" readonly="readonly">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-addon">Total:</span>
                <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly" value=" {{isset($sale->total)? $sale->total:''}}">
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
    </div>
    
</div>