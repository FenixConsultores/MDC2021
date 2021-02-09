<div class="row methodPay">
	<div class="col-12 col-sm-6 content-banco">
		<div class="banco">
			<?php				
				$subtotal = array_sum(array_column($description, 'subtotal'));
				$envio = array_sum(array_column($description, 'costoEnvio'));
			 ?>
			<hr>
			<h5>Deposita $ <?=$this->cart->format_number($subtotal+$envio);?> en <strong>Bancomer</strong></h5><br>
			<p>Estos son los datos que necesitas:</p>
			<p>N° de cuenta</p>
			<div class="noCuenta">
				0464525922
			</div>
			<p>Clabe Interbancaria:</p>
			<div class="claveInterbancaria">
				012650004645259223
			</div>
			<p><span class="fa fa-file-image"></span>&nbsp;Al realizar tu pago sube la fotografía de tu ticket para confirmar tu pedido. <a href="<?= base_url();?>fontend/customer/home">Ingresar</a></p>
			<div id="acordion">
				<div class="cart">
					<div class="cart-header" id="headingOne">
						<h5 class="mb-0">
							<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					        	Concepto <span class="fa fa-angle-down" id="iconCollaps"></span>
					        </a>
						</h5>
					</div>
					 <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				      <div class="card-body">
				       	<!-- <strong>Compra de productos en marias de chocolate</strong> -->
				       	<div class="descriprionProduct">
				       		<ul>
				       			<?php 
				       				foreach ($description as $item) {
				       			?>
				       				<li><span class="fa fa-check-circle"></span>&nbsp;<?= $item['nombre'].' x'.$item['cantidad'].' $ '.$item['subtotal'];?></li>
				       			<?php
				       				}
				       			 ?>
				       		</ul>
				       	</div>
				      </div>
				    </div>
			    </div>
			</div>
			<button class="btn btn-secondary" id="imprimir">Imprimir</button>
			</div>
		</div>
	</div>
</div>