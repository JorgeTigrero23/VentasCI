<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte - Categoría</title>
    <style>

        table th{ 
            background-color:#18BC9C; 
            color:#000;
            text-align:center; 
            font-size:14px; 
            padding: 10px 2px 10px 2px;
            font-family: Elegance, sans-serif;
        } 
        table{ 
            border-collapse:collapse; 
        } 
        table td{ 
            font-size:14px; 
            padding:10px;
            text-align:left; 
            border:#2C7AB8 1px solid; 
        } 
        table thead td { 
            font-size:12px; 
                
            } 
        table tr{ 
            border:1px solid #2C7AB8; 
        } 

        body {
            font-family: Elegance, sans-serif;
        }

    </style>
</head>

<body>
        <div class="form-group" style="padding-right: 20px; font-family:Arial!important;">
                <div  style="text-align: center; color: red; font-size: 50px; padding-bottom: 20px;">
                    @if($sale->voucher_type->id == 1)
                        FACTURA
                    @else
                        BOLETA
                    @endif
                </div>
                <div style="text-align: center">
                    <b>Empresa de Ventas</b><br>
                    Calle Moquegua 430 <br>
                    Tel. 099999999 <br>
                    Email:empresa@gmail.com
                </div>
                <div style="padding-top: 50px">
                    <div style="float:left; width: 350px;">	
                        <b>CLIENTE</b><br><br>
                        <b>Nombre: </b> {{ $sale->client->first_name.' '. $sale->client->last_name }} <br>
                        <b>Número Documento: </b> {{ $sale->client->document_number }} <br>
                        <b>Teléfono: </b> {{ $sale->client->phone }} <br>
                        <b>Dirección: </b> {{ $sale->client->address }} <br>
                    </div>	
                    <div style="float:right; width: 300px;">	
                        <b>COMPROBANTE</b><br><br>
                        <b>Tipo de Comprobante: </b> {{ $sale->voucher_type->name }}<br>
                        <b>Serie: </b> {{ $sale->serie }}<br>
                        <b>Número de Comprobante: </b> {{ $sale->voucher_number }}<br>
                        <b>Fecha: </b> {{ $sale->date }}
                    </div>	
                </div>

                <div style="padding-top: 220px">
                    <table class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 15%">Codigo</th>
                                <th style="width: 40%">Producto</th>
                                <th style="width: 15%">Precio</th>
                                <th style="width: 15%">Cantidad</th>
                                <th style="width: 15%">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sale->sale_items as $det): ?>
                            <tr>
                                <td>{{ $det->product->barcode }}</td>
                                <td>{{ $det->product->name }}</td>
                                <td style="text-align: center">{{ $det->price }}</td>
                                <td style="text-align: center">{{ $det->quantity }}</td>
                                <td style="text-align: right">{{ $det->importe }} <strong>$</strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>Subtotal </strong></td>
                                <td style="text-align: right">{{ $sale->subtotal }} <strong>$</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>IGV</strong></td>
                                <td style="text-align: right">{{ $sale->igv }} <strong>$</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>Descuento</strong></td>
                                <td style="text-align: right">{{ $sale->discount }} <strong>$</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: right"><strong>Total</strong></td>
                                <td style="text-align: right">{{ $sale->total }} <strong>$</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            
            </div>
</body>

</html>