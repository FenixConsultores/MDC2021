<div class="row">
	<div class="col-12 order-2 col-sm-12 col-md-9">
		<div class="tb-detail">			
			<table class="table">
				<thead>
					<tr>
						<th colspan="2" class="text-center">RESUMEN COMPRA</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Costo producto</td>
						<td>$ <?= $this->cart->format_number($data->precio);?></td>
					</tr>
					<tr>
						<td>Cantidad</td>
						<td>x <?= $data->cantidad;?></td>
					</tr>
					<!-- <tr>
						<td>Envio</td>
						<td>$ <?= $this->cart->format_number($data->costoEnvio);?></td>
					</tr> -->
					<tr>
						<td>Subtotal</td>
						<td>$ <?= $this->cart->format_number($data->subtotal);?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- <div class="detail-pago">
			<div class="row">
				<div class="col-2 text-center"><span class="fa <?= ($data->statusPago != '0')?'fa-check-circle':'fa-times-circle';?> fa-2x"></span></div>
				<div class="col-10">
					<p>Bancomer</p>
					<p>Pago ($ 700.00)</p>
					<p>Pago acreditado el dia 2 de abril</p>
				</div>
			</div>
		</div>
		<div class="location-delivery">
			<div class="row">
				<div class="col-2 text-center">
					<span class="fa fa-map-marker-alt fa-2x"></span>
				</div>
				<div class="col-10">
					<p><?= $data->direccion?></p>
					<p><?= $data->caracteristicasDomicilio?></p>
				</div>
			</div>
		</div> -->
	</div>
	<div class="col-12 col-sm-12 col-md-3 order-1 order-md-12">
		<div class="img-compra">
			<p>Compraste</p>
			<img src="<?= base_url();?>assets/img/modelos/<?= $data->imagen;?>">
			<figcaption><?= $data->nombre;?></figcaption>
			<figcaption><?= $data->modelo;?></figcaption>
			<figcaption><?= $data->subtotal.' x '.$data->cantidad;?></figcaption>
		</div>		
	</div>
</div>