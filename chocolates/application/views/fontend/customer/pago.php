<div class="row" id="row-personalizado">

	<div class="col-12 col-sm-12">

		<div class="container">

			<br>

			<p><strong>Método de pago </strong>(Transferencia / Paypal)</p>

		</div>

	</div>

	<?php

	$importe = array_sum(array_column($resumen, 'subtotal'));

	$cosEnvio = array_sum(array_column($resumen, 'costoEnvio'));

	$paypalExtraFee = ($importe + $cosEnvio) * (0.08); //se cobrará 8% extra en pagos de paypal

	?>

	<div class="col-6 col-sm-3 option-pay">

		<form method="POST" action="<?= base_url();?>fontend/customer/home/deposito">

			<input type="hidden" name="numeroOrdenPagar" id="numeroOrdenPagar" value="<?= $this->uri->segment(5);?>">			

			<a id="btnTransferencia"><!-- <span class="fas fa-exchange-alt"></span> -->

				<img src="<?= base_url();?>assets/img/various/bbva.png" class="iconoOptioPay">

			</a>

		</form>		

	</div>

	<div class="col-6 col-sm-3 option-pay">

		<form name='formulario' id="payPalPal" method="POST" action="https://www.paypal.com/cgi-bin/webscr">
			<input type='hidden' name='amount' id="amount" value='<?php echo $importe + $cosEnvio + $paypalExtraFee; ?>'>
			<input type='hidden' name='quantity' id="quantity" value='1'>
			<input type='hidden' name='cmd' value='_xclick'>
			<input type='hidden' name='business' value='pqts3515@gmail.com'>
			<input type='hidden' name='item_name' value='<?php echo 'Pedido marias de chocolate'; ?>'>
			<input type='hidden' name='item_number' value='<?php echo $this->uri->segment(5);?>'>
			<input type='hidden' name='page_style' value='primary'>
			<input type='hidden' name='currency_code' value='MXN'>
			<input type='hidden' name='cn' value='PP-BuyNowBF'>
			<input type='hidden' name='custom' value=''>
			<input type='hidden' name='country' value='MX'>
			<input type='hidden' name='cancel_return' value='<?= base_url();?>fontend/customer/home/errorPay'>
			<input type="hidden" name="return" value="<?= base_url();?>fontend/customer/products/payStatus/<?= $this->uri->segment(5);?>">
			<a>
				<img id="iconPayPal" src="<?= base_url()?>assets/img/various/paypal.png" class="iconoOptioPay">
			</a>
		</form>

	</div>

	<div class="col-6 col-sm-3 option-pay">

		<form method="POST" action="<?= base_url();?>fontend/customer/home/deposito">

			<input type="hidden" name="numeroOrdenOxxo" id="numeroOrdenOxxo" value="<?= $this->uri->segment(5);?>">			

			<a id="btnTransferenciaOxxo"><img width="10px" src="<?= base_url()?>assets/img/various/oxxo.png" class="iconoOptioPayOxxo"></a>

		</form>		

	</div>

	<div class="col-12 col-sm-12" id="resumen-after-pay">					

		<h5>Importante:
			<br>* No olvides guardar tu número de órden ya que es necesario para el seguimineto de tu pedido.
			<br>* Para pagos con depósito a cuenta bancaria o en sucursales OXXO recuerda realizar el pago y
					subir el baucher para su confirmación en las 48 despúes de la compra.
		</h5>
		<hr>

		<div class="container">

			<p><span class="far fa-money-bill-alt"></span> Cantidad a pagar</p>
			<h3>$ <?= $this->cart->format_number($importe+$cosEnvio);?></h3><hr>

			<p><span class="far fa-money-bill-alt"></span> Cobro extra (8% sólo para pagos con paypal)</p>
			<h3>$ <?= $this->cart->format_number($paypalExtraFee);?></h3><hr>

			<p><span class="fas fa-tag fa-flip-horizontal"></span> Número de órden</p>			
			<h3><?= $resumen[0]['numeroOrden'];?></h3><hr>

			<?php foreach ($resumen as $item) { ?>

				<p><span class="far fa-calendar-alt"></span> Fecha y hora de entrega</p>
				<h3><?= $item['diaEntrega'];?></h3><hr>

				<p><span class="fas fa-star"></span> Producto</p>
				<h3><?= $item['modelo'];?></h3><hr>

			<?php } ?>

		</div>

	</div>

</div>

<div class="loading">
	<div class="innerLoading">
		<img src="<?= base_url() ?>assets/img/various/loading.gif">
		<h4>Procesando pago ...</h4>
	</div>
</div>