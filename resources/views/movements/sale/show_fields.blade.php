<div class="form-group" style="padding-right: 20px">
	<div class="form-group  col-sm-12 text-center">
		<b>Empresa de Ventas</b><br>
		Calle Moquegua 430 <br>
		Tel. 099999999 <br>
		Email:empresa@gmail.com
	</div>

	<div class="form-group  col-sm-6">	
		<b>CLIENTE</b><br>
		<b>Nombre: </b> <?php echo $sale->client->first_name.' '. $sale->client->last_name;?> <br>
		<b>Número Documento: </b> <?php echo $sale->client->document_number;?> <br>
		<b>Teléfono: </b> <?php echo $sale->client->phone;?> <br>
		<b>Dirección: </b> <?php echo $sale->client->address;?><br>
	</div>	
	<div class="form-group  col-sm-6">	
		<b>COMPROBANTE</b> <br>
		<b>Tipo de Comprobante:</b> <?php echo $sale->voucher_type->name;?><br>
		<b>Serie:</b> <?php echo $sale->serie;?><br>
		<b>Número de Comprobante:</b> <?php echo $sale->voucher_number;?><br>
		<b>Fecha</b> <?php echo $sale->date;?>
	</div>	

    <div class="form-group col-sm-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sale->sale_items as $det): ?>
                <tr>
                    <td><?php echo $det->product->barcode; ?></td>
                    <td><?php echo $det->product->name; ?></td>
                    <td><?php echo $det->price; ?></td>
                    <td><?php echo $det->quantity; ?></td>
                    <td><?php echo $det->importe; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                    <td><?php echo $sale->subtotal; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>IGV:</strong></td>
                    <td><?php echo $sale->igv; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Descuento:</strong></td>
                    <td><?php echo $sale->discount;?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total:</strong></td>
                    <td><?php echo $sale->total; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="form-group col-sm-12">
        <button type="button" class="btn btn-primary btn-print pull-right" data-dismiss="modal"><span class="fa fa-print"> Imprimir</span></button>
    </div>

</div>