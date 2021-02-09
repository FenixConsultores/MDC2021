<div class="row product">	


	<?php 


	 // print_r($resumen);


	$subtotal = array_sum(array_column($resumen, 'subtotal'));


	$envio = array_sum(array_column($resumen, 'costoEnvio'));


	$month = array(


		'01'=>'Enero',


		'02'=>'Febrero',


		'03'=>'Marzo',


		'04'=>'Abril',


		'05'=>'Mayo',


		'06'=>'Junio',


		'07'=>'Julio',


		'08'=>'Agosto',


		'09'=>'Septiembre',


		'10'=>'Octubre',


		'11'=>'Noviembre',


		'12'=>'Diciembre');


	$day = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');	


	foreach ($resumen as $value) {		


	?>	


	<div class="col-12 card-buy">


		<div class="row">


			<div class="col-12 headerBuy">


				<h5><span class="badge <?= ($value['statusPago']== '1')?'badge-success':'badge-info';?>"><?= ($value['statusPago']=='1')?'Pago Realizado':'Pago pendiente';?></span> | No de Orden <?= $value['numeroOrden' ] ?></h5>


				<?php 


				if ($value['tipoEntrega'] == 'marias') {


				?>


				<p>Lo recoges en Marias el <?php $mes = explode('-',$value['diaEntrega']);echo $mes[2].' de '.$month[$mes[1]];?></p>


				<?php	


				}else{


				?>


				<p>Llega a su domicilio el <?php $mes = explode('-',$value['diaEntrega']);echo $mes[2].' de '.$month[$mes[1]];?></p>
				<p><span class="fa fa-map-marker-alt"><a href='https://www.google.com.mx/maps/place/<?= $value['geolocalizacion' ] ?>' target='_blank'>Ver en Mapa | <?= $value['confirmarDomicilio']?>  </a></span></p>


				<?php


				}


				 ?>				


			</div>


			<div class="col-12">


				<div class="row">


					<!-- <span class="fas fa-ellipsis-v more-datails"></span> -->


					<div class="col-5 col-sm-3 col-md-3">


						<img src="<?= base_url();?>assets/img/modelos/<?= $value['imagen'];?>">						


					</div>


					<div class="col-7 col-sm-9 col-md-6 content-description">						


						<p class="txt-desctiption"><?= $value['nombre'];?></p>


						<p class="txt-desctiption"><?= $value['modelo'];?></p>


						<p class="txt-desctiption">$ <?= $this->cart->format_number($value['subtotal']);?> x <?= $value['cantidad'];?> unidad</p>						


					</div>


					<div class="col-12 col-sm-12 col-md-3">


						<div class="link-details row">


							<div class="col-6">


								<a href="<?= base_url();?>fontend/customer/home/detail/<?= $value['modelo'].'/'.$value['numeroOrden']?>">ver detalles</a>


							</div>							


							<div class="col-6">


								<?php 


									if ($value['statusEnvio'] != '0') {


								?>


									<a href="<?= base_url();?>fontend/customer/home/statusEnvio">


									<?php 


										if ($value['statusEnvio'] == '1') {


									?>


										<i class="fas fa-box-open"></i> 


									<?php


										}else if($value['statusEnvio'] == '2'){


									?>


										<i class="fas fa-truck"></i> 


									<?php


										}else{


									?>


										<i class="fas fa-user-check"></i> 


									<?php


										}


									 ?>


									Seguimiento</a>


								<?php


									}else{





									}


								 ?>								


							</div>							


						</div>


					</div>


				</div>


			</div>			


		</div>


	</div>


	<?php


	}


	?>


	<div class="col-12 seguimiento-box">		


		<table class="tbCostProduct table table-striped" id="tbCostProduct">


			<thead>


				<tr>


					<th colspan="2">Resumen Compra General</th>


				</tr>


			</thead>


			<tbody>				


				<tr>


					<td>Producto</td>


					<td>$ <?= $this->cart->format_number($subtotal);?></td>


				</tr>				


				<tr>


					<td>Envio</td>


					<td>$ <?= $this->cart->format_number($envio);?></td>


				</tr>


				<tr>


					<td>Total</td>


					<td>$ <?= $this->cart->format_number($subtotal+$envio);?></td>


				</tr>


				<!-- <tr>


					<th colspan="2"><?= $resumen[0]['numeroOrden'];?></th>


				</tr> -->


			</tbody>


		</table><br>
		
	
		<div class="baucher" <?= ($resumen[0]['baucher'] == '0')?'':'hidden';?>>


			<h5 class="text-center">SI YA REALIZO SU PAGO FAVOR DE SUBIR SU BAUCHER</h5>


			<div class="upload-baucher">


				<form id="formUploadFile">


					<div class="preview-baucher">


						<img id="imgPreviewBaucher" src="<?= base_url();?>assets/img/various/nopreview.jpg">				


					</div>


					<div class="progresoBaucher">


						<div class="progress">


						  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>


						</div>


					</div>	


					<div class="btn-group" role="group" aria-label="Basic example">


						<label class="customiseFile" id="customiseFile">


							Selecciona ...


							<input type="file" name="baucherFile" id="baucherFile" hidden="">


						</label>


						<label class="customiseFile" id="btnUploadBaucher">


							Subir baucher						


						</label>


					</div>


				</form>		


			</div>			


		</div>		


		<div class="baucherSuccess" <?= ($resumen[0]['baucher'] != '0')?'':'hidden';?>>


			<h5 class="text-center">BAUCHER CARGADO</h5>			


			<span class="fas fa-check-circle fa-8x"></span>


			<p><a href="#" id="showBaucher" data-img="<?= base_url().'assets/img/baucher/'.$resumen[0]['baucher'];?>">Ver baucher</a></p>


		</div>


	</div>


	<div class="col-12 seguimiento-box">


		


	</div>


</div>





<div class="imgBaucher" id="imgBaucher">


	<span class="closeModalImg" id="closeModalImg">&times;</span>


	<img src="" class="baucherContent" id="baucherContent">


	<!-- <div id="captionBaucher">Baucher 8989923.jpg</div> -->


</div>