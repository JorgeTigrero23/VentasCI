@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Editar Venta
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Venta
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sale, ['route' => ['venta.update', $sale->id], 'method' => 'patch','enctype' => "multipart/form-data"]) !!}

                        @include('movements.sale.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){

            setTimeout(function(){
                table();
            }, 100);

            $('#product').autocomplete({
                source: function(request, response){
                    $.ajax({
                        url: "{{ url('movimiento/listProduct') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: { term: request.term },
                        success: function(data){
                            response(data);
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui){
                    let barcode = ui.item.barcode
                    let name = ui.item.name
                    if(typeof barcode == 'undefined'){
                        barcode = ui.item.label;
                    }else if(typeof name == 'undefined'){
                        name = ui.item.label;
                    }

                    data = ui.item.id + '*' +
                        barcode + '*' +
                        name + '*' +
                        ui.item.price + '*' +
                        ui.item.stock;
                    $('#btnAddProduct').val(data);
                    
                },
            });

            $('#client').autocomplete({
                source: function(request, response){
                    $.ajax({
                        url: "{{ url('movimiento/listClient') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: { term: request.term },
                        success: function(data){
                            response(data);
                            console.log(data);
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui){
                    $('#client_id').val(ui.item.id);
                },
            }).autocomplete( "instance" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .append( "<div><strong> Nombres: </strong>" + item.label + "<br><strong> Cedula: </strong>" + item.document_number + "</div>" )
                .appendTo( ul );
            };
            
            $('#voucher').on('change', function(){
                
                let option = $(this).val();

                if (option != '')
                {
                    let info = option.split('*');

                    $('#voucher_type_id').val(info[0]);
                    $('#igv').val(info[2]);
                    $("#labelIGv").text('IGV ' + info[2] + '% : ')
                    $('#serie').val(info[3]);
                    $('#document_number').val(generateNumber(info[1]));

                }else{

                    $('#idcomprobante').val('');
                    $('#igv').val('');
                    $('#serie').val('');
                    $('#numero').val('');
                }

               amount();  // call function amount

            });

            function generateNumber(number)
            {
                if (number >= 99999 && number < 999999){
                    return (Number(number) + 1);
                } 
                if (number >= 9999 && number < 99999){
                    return "0" + (Number(number) + 1);
                } 
                if (number >= 999 && number < 9999){
                    return "00" + (Number(number) + 1);
                } 
                if (number >= 99 && number < 999){
                    return "000" + (Number(number) + 1);
                }
                if (number >= 9 && number < 99){
                    return "0000" + (Number(number) + 1);
                } 
                if (number < 9){
                    return "00000" + (Number(number) + 1);
                } 
            }
                    
            $('#btnAddProduct').on('click', function(){
		
                let data = $(this).val();

                if (data != '') {
                    let info = data.split('*');

                    html = '<tr>';
                    html += '<td hidden="true"><input type="hidden" name="sale_items[]"></td>';
                    html += '<td><input type="hidden" name="product_id[]" value="'+ info[0] +'">' + info[1] + '</td>';
                    html += '<td>' + info[2] + '</td>';
                    html += '<td><input type="hidden" name="price[]" value="'+ info[3] +'">' + info[3] + '</td>';
                    html += '<td>' + info[4] + '</td>';
                    html += '<td><input type="number" name="quantity[]" class="cantidades" value="1" min="0" max="'+ info[4] +'"></td>';
                    html += '<td><input type="hidden" name="amounts[]" value="'+ info[3] +'"><p>' + info[3] + '</p></td>';
                    html += '<td><button type="button" class="btn btn-danger btn-remove-producto"><span class="fa fa-remove"></span></td>';
                    html += '</tr>';

                    $("#tableSales tbody").append(html);

                    amount()// call function amount
                    
                    $('#btnAddProduct').val(null);
                    $('#product').val(null);
                    
                }

            });

            $(document).on('click','.btn-remove-producto', function(){
                $(this).closest('tr').remove();
                
                amount(); // call function amount
            });

            $(document).on('keyup','#tableSales input.cantidades', function(){
                let element = $(this)[0];
                let default_value = $(element).prop("defaultValue");

                let quantity = $(this).val();
                let stock = $(this).closest('tr').find('td:eq(4)').text();
                let price = $(this).closest('tr').find('td:eq(3)').text();

                if(Number(stock)==0)
                {   
                    if(Number(quantity) < Number(default_value)){
                        quantity = $(this).val();
                    }else{
                        $(this).val(default_value);
                        quantity = $(this).val();
                    }
                }else if(Number(quantity) > Number(stock)){
                    $(this).val(stock);
                    quantity = $(this).val();
                }

                let importe = quantity * price;

                $(this).closest('tr').find('td:eq(6)').children('p').text(importe.toFixed(2));
                $(this).closest('tr').find('td:eq(6)').children('input').val(importe.toFixed(2));

                amount(); // call function amount

            });

            function amount()
            {
                let subtotal = 0;

                $('#tableSales tbody tr').each(function(){
                    subtotal = subtotal + Number($(this).find('td:eq(6)').text());
                });

                $('input[name=subtotal]').val(subtotal.toFixed(2));

                let procentaje = $('#igv').val();
                let igv = subtotal * (procentaje/100);

                $('input[name=igv]').val(igv.toFixed(2));

                let descuento = $('input[name=descuento]').val();

                let total = subtotal + igv - descuento;

                $('input[name=total]').val(total.toFixed(2));
            }
            
            function table()
            {
                // let items = "{{ $sale->sale_items }}"
                // var sale_items = items.replace(/&quot;/gi, '"');
                // var objSaleItems = JSON.parse(sale_items);
    
                <?php 
                    foreach($sale->sale_items as $item){
                ?>;
                        html = '<tr>';
                        html += '<td hidden="true"><input type="hidden" name="sale_items[]" value="<?php echo $item->id ?>"><?php echo $item->id ?></td>';
                        html += '<td><input type="hidden" name="product_id[]" value="<?php echo $item->product->id ?>"><?php echo $item->product->barcode ?></td>';
                        html += '<td><?php echo $item->product->name ?></td>';
                        html += '<td><input type="hidden" name="price[]" value="<?php echo $item->product->price ?>"><?php echo $item->product->price ?></td>';
                        html += '<td><?php echo $item->product->stock ?></td>';
                        html += '<td><input type="number" name="quantity[]" class="cantidades" value="<?php echo $item->quantity ?>" min="0" max="<?php if($item->product->stock > 0) echo $item->product->stock; else echo $item->quantity; ?>"></td>';
                        html += '<td><input type="hidden" name="amounts[]" value="<?php echo $item->importe ?>"><p><?php echo $item->importe ?></p></td>';
                        html += '<td><button type="button" class="btn btn-danger btn-remove-producto"><span class="fa fa-remove"></span></td>';
                        html += '</tr>';

                        $("#tableSales tbody").append(html);
                        
                <?php
                    }
                 ?>;

                

            }

        });
        
    </script>
@endpush