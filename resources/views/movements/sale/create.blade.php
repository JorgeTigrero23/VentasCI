@extends('adminlte::layouts.app')
@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('htmlheader_title')
	Crear Venta
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Nueva Venta
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'venta.store','enctype' => "multipart/form-data"]) !!}

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
                    $('#voucher_number').val(generateNumber(info[1]));

                }else{

                    $('#idcomprobante').val('');
                    $('#igv').val('');
                    $('#serie').val('');
                    $('#numero').val('');
                }

               amount(); // call function amount

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
                    html += '<td><input type="hidden" name="product_id[]" value="'+ info[0] +'">' + info[1] + '</td>';
                    html += '<td>' + info[2] + '</td>';
                    html += '<td><input type="hidden" name="price[]" value="'+ info[3] +'">' + info[3] + '</td>';
                    html += '<td>' + info[4] + '</td>';
                    html += '<td><input type="number" name="quantity[]" class="cantidades" value="1" min="0" max="'+info[4]+'"></td>';
                    html += '<td><input type="hidden" name="amounts[]" value="'+ info[3] +'"><p>' + info[3] + '</p></td>';
                    html += '<td><button type="button" class="btn btn-danger btn-remove-producto"><span class="fa fa-remove"></span></td>';
                    html += '</tr>';

                    $("#tableSales tbody").append(html);
                   
                    amount();  // call function amount
                    $('#btnAddProduct').val(null);
                    $('#product').val(null);
                    
                }

            });

            $(document).on('click','.btn-remove-producto', function(){
                $(this).closest('tr').remove();
               
                amount();  // call function amount
            });

            $(document).on('keyup','#tableSales input.cantidades', function(){
                
                let quantity = $(this).val();
                let stock = $(this).closest('tr').find('td:eq(3)').text();
                let price = $(this).closest('tr').find('td:eq(2)').text();


                if(Number(quantity) > Number(stock)){
                    $(this).val(stock);
                    quantity = $(this).val();
                }

                let importe = quantity * price;

                $(this).closest('tr').find('td:eq(5)').children('p').text(importe.toFixed(2));
                $(this).closest('tr').find('td:eq(5)').children('input').val(importe.toFixed(2));

                amount(); // call function amount

            });

            function amount()
            {
                let subtotal = 0;

                $('#tableSales tbody tr').each(function(){
                    subtotal = subtotal + Number($(this).find('td:eq(5)').text());
                });

                $('input[name=subtotal]').val(subtotal.toFixed(2));

                let procentaje = $('#igv').val();
                let igv = subtotal * (procentaje/100);

                $('input[name=igv]').val(igv.toFixed(2));

                let descuento = $('input[name=descuento]').val();

                let total = subtotal + igv - descuento;

                $('input[name=total]').val(total.toFixed(2));
            }

        });

        
        $('#btnSaveClient').on('click', function(){

            let data = {
                _token : $('meta[name="csrf-token"]').attr('content'),
                first_name : $('#first_name').val(),
                last_name : $('#last_name').val(),
                document_type_id : $('#document_type_id').val(),
                document_number : $('#document_number').val(),
                phone : $('#phone').val(),
                mail : $('#mail').val(),
                client_type_id : $('#client_type_id').val(),
                address : $('#address').val()
            }

            $.ajax({
                url: '{{ URL("mantenimiento/cliente")}}',
                type: "POST",
                dataType: "json",
                data: data,
                success: function(result){

                    $("#client_id").val(result.data.id);
                    $("#client").val(result.data.last_name + ' ' + result.data.first_name);

                    emptyFormClient();

                    $('#modal-new-client').modal('hide');

                },
                error: function(result){

                    var errorDiv = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';

                    $.each(result.responseJSON.errors, function (key, value) {
                        errorDiv += '<p><i class="icon fa fa-ban"></i>' + value + '</p>';
                        
                    })

                    errorDiv += '</div>';

                    $( "#messageError" ).first().html(errorDiv);

                }

            });

        });

        function emptyFormClient()
        {
            $( "#messageError" ).first().html("");
            $('#first_name').val("");
            $('#last_name').val("");
            $('#document_type_id').val("");
            $('#document_number').val("");
            $('#phone').val("");
            $('#mail').val("");
            $('#client_type_id').val("");
            $('#address').val("");
        }
        
    </script>
@endpush
