<div class="row inputInfoClient" id="row-personalizado">	



	<?php $totalActive = array_sum(array_column($this->cart->contents(), 'status'));?>



	<div class="col-12 <?= ($this->cart->contents() && $totalActive >=2)?'':'oculto';?>">

		<h4 class="label-entrega">La entrega será...</h4>

		<p>

			<label class="cont-checkbox">Todos los modelos son para la misma dirección.

				<input type="checkbox" name="lugar-entrega" id="lugar-entrega">

				<span class="checkmark"></span>

			</label>

		</p>



		<!-- Costo por tipo de envio -->

		<input type="hidden" name="costKilometer" id="costKilometer" value="60">

	</div>



	<?php



	if ($carrito = $this->cart->contents()) {



		$itemIndex = 0;



		foreach ($carrito as $item) {

			++$itemIndex;



	?>	



		<div class="col-12 col-md-4 cont-cart item-purchase-container <?php echo($item['status']=='1')?'':'oculto';?>">



			<img src="<?= base_url().'assets/img/modelos/'.$item['img']?>">	



			<div class="row modelo">

				<div class="col-6 col-md-6"><?= $item['options']?></div>

				<div class="col-6 col-md-6">Cantidad: <?= $item['qty']?></div>

			</div>



			<div class="btn-action">



				<ul class="nav nav-tabs myTab" id="myTab" role="tablist">

					<li class="nav-item">

						<label class="cont-radio">Servicio domicilio

							<input type="radio" name="<?= 'value_' . $item['id'] ?>" value="valuable" data-id="<?= 'domi_' . $item['id'] ?>" class="rbtn-delivery">

							<span class="radio-check"></span>

						</label>

					</li>

					<li>

						<label class="cont-radio">En Marías

							<input type="radio" name="<?= 'value_' . $item['id'] ?>" value="valuable" data-id="<?= 'maria_' . $item['id'] ?>" checked="true">

							<span class="radio-check"></span>

						</label>

					</li>

				</ul>



				<div class="tab-content" id="myTabContent">



					<!--servicio a domicilio-->

					<div class="tab-pane fade show" id="<?= 'domi_'.$item['id'];?>" role="tabpanel" aria-labelledby="home-tab">



						<form class="form-entrega" id="<?= 'form_'.$item['id']; ?>">



							<input type="hidden" name="idrowCart" value="<?= $item['rowid']; ?>">



							<input type="hidden" name="idProduct" value="<?= $item['id']; ?>">



							<div class="form-group">

								<div class="input-group" id="">

									<input type="text" name="dayEntrega" class="form-control calendar" id="dayEntrega" placeholder="*Día de entrega" readonly="">

									<div class="input-group-append">

										<span class="input-group-text iconCalendar"><span class="fas fa-th"></span></span>

									</div>

								</div>

							</div>



							<div class="form-group" id="houtSelect">								

								<select class="form-control hourEntrega" name="hourEntrega" id="hourEntrega">

									<option value=""> -- Hora de entrega en ruta -- </option>



									<?php



									$currentDTGroup = "";



									foreach ($deliveryTimes as $dt) {



										if ($dt["grupo"] != $currentDTGroup) {



											if ($currentDTGroup != '') {

												echo '</optgroup>';

											}



											$currentDTGroup = $dt["grupo"];

											echo "<optgroup label='" . $currentDTGroup . "'>";

										}



										?>



										<option value="<?= $dt["horaInicio"]; ?>" data-group="<?= $dt["grupo"]; ?>" data-location="<?= $dt["ubicacion"]; ?>" data-cost="<?= $dt["costoEnvio"]; ?>"><?php echo $dt["horaInicio"], ' - ', $dt["horaFin"]; ?></option>



									<?php

									}



									echo '</optgroup>';



									?>

								</select>

							</div>



							<div class="form-group" id="containerHour" hidden="">

								<div class="input-group">

									<input type="text" name="hourEntregaSpecial" class="form-control time" id="hourEntregaSpecial" placeholder="Hora de entrega en horario especial" readonly>

									<div class="input-group-append">

										<span class="input-group-text"><span class="fas fa-th"></span></span>

									</div>

								</div>

							</div>



							<div class="form-group">

								<input type="text" name="nameCliente" class="form-control" id="nameCliente" placeholder="*Tu nombre">

							</div>



							<div class="form-group">

								<input type="number" name="phoneCliente" class="form-control" id="phoneCliente" placeholder="*Tu teléfono">

							</div>



							<div class="form-group">

								<input type="text" name="namePersonEntrega" class="form-control" id="namePersonEntrega" placeholder="*Nombre de la persona a entregar">

							</div>



							<div class="form-group">

								<input type="number" name="phonePersonEntrega" class="form-control" id="phonePersonEntrega" placeholder="*Telefono de la persona a entregar">

							</div>



							<div class="form-group">

								<textarea class="form-control" name="noteArreglo" id="noteArreglo" rows="5" placeholder="Agrega nota al arreglo(120 caracteres)" maxlength="120"></textarea>

							</div>



							<div class="map-container">



								<div class="form-group divDireccionEntrega">

									<input type="text" name="direccionCliente" class="form-control direccionCliente address-control" id="<?= 'direccionCliente_' . $itemIndex ?>" placeholder="*Direccion de entrega">

								</div>



								<div class="form-group">

									<div class="input-group">

										<div class="input-group-prepend">

											<span class="input-group-text">$</span>

										</div>

										<input type="text" name="cosEnvio" class="form-control cosEnvio cost-control" id="cosEnvio" placeholder="*Costo de envio" readonly="" value="60">

									</div>

								</div>



								<div class="form-group" hidden>

									<input type="text" name="entregaEspecial" class="form-control" id="entregaEspecial">

								</div>



								<div class="form-group">

									<div class="map map-control" id="<?= 'map_' . $itemIndex ?>"></div>

								</div>



								<div class="form-group">

									<input type="hidden" id="ubicacion" name="ubicacion" class="form-control ubicacion location-control" readonly="">

								</div>



							</div>



							<div class="form-group">

								<textarea class="form-control" name="confirmacionDomicilio" id="confirmacionDomicilio" placeholder="Ingrese la dirección (confirmación)" rows="5"></textarea>

							</div>



							<div class="form-group">

								<textarea class="form-control" name="detalleExteriorDomicilio" id="detalleExteriorDomicilio" placeholder="Ingrese detalles exteriores del domicilio" rows="5"></textarea>

							</div>



							<div class="form-group">

								<textarea class="form-control" name="descriptionDomicilio" id="descriptionDomicilio" placeholder="Área de trabajo o puesto si es empresa" rows="5"></textarea>

							</div>



							<input type="hidden" name="productQuantity" class="form-control" id="productQuantity" value="<?= $item['qty'];?>">



							<input type="hidden" name="tipoEntrega" value="domicilioIndividual" id="tipoEntrega">



							<div class="form-group text-right">

								<a class="btn btn-secondary btnDeleteCart" data-id="<?= $item['rowid'] ?>">Eliminar</a>

								<button class="btn btn-secondary" id="btn-confirm-data" data-id="<?= $item['id'] ?>">Todo ok

									<span class="fa fa-angle-right"></span>

								</button>

							</div>



						</form>



					</div>



					<!--servicio en Marias-->

					<div class="tab-pane fade show active" id="<?= 'maria_'.$item['id'];?>" role="tabpanel" aria-labelledby="home-tab">



						<form class="form-entrega">



							<input type="hidden" name="idrowCart" value="<?= $item['rowid'];?>">



							<input type="hidden" name="idProduct" value="<?= $item['id'];?>">



							<div class="form-group">

								<div class="input-group">

									<input type="text" name="dayEntrega" class="form-control calendar" id="dayEntrega" placeholder="Día de entrega" readonly>

									<div class="input-group-append">

										<span class="input-group-text"><span class="fas fa-th"></span></span>

									</div>

								</div>

							</div>



							<div class="form-group">

								<div class="input-group">

									<input type="text" name="hourEntrega" class="form-control time" id="hourEntrega" placeholder="Hora de entrega" readonly>

									<div class="input-group-append input-group-append-time">

										<span class="input-group-text"><span class="fas fa-th"></span></span>

									</div>

								</div>

							</div>



							<div class="form-group">

								<input type="text" name="nameCliente" class="form-control" id="nameCliente" placeholder="Nombre">

							</div>



							<div class="form-group">

								<input type="number" name="phoneCliente" class="form-control" id="phoneCliente" placeholder="Teléfono">

							</div>



							<input type="hidden" name="productQuantity" class="form-control" id="productQuantity" value="<?= $item['qty']; ?>">



							<input type="hidden" name="tipoEntrega" id="tipoEntrega" value="mariasIndividual">



							<div class="form-group" style="text-align: right;">

								<a class="btn btn-secondary btnDeleteCart" data-id="<?= $item['rowid'] ?>">Eliminar</a>

								<button class="btn btn-secondary" id="btn-confirm-data">Todo ok

									<span class="fa fa-angle-right"></span>

								</button>

							</div>



						</form>



					</div>



				</div>



			</div>



		</div>



	<?php		



		}



	}



	else{



	?>	



	<div class="col-12">



		<div class="alert alert-info" role="alert" style="margin-top: 30px;text-align: center;font-family:'Lato', sans-serif;">

			<hr>

			<span class="fas fa-shopping-cart" style="font-size: 40px;"></span>

			<h3>Tu carrito está vacío</h3>

			<a href="<?= base_url(); ?>fontend/customer/home/p1">

				<span class="fas fa-angle-double-left"></span>

				Ir a comprar

			</a>

			<hr>

		</div>



	</div>



	<?php



	}



	 ?>	



</div>



<div class="row customize-row oculto item-purchase-container" id="todo-uno">



	<div class="col-12">



		<div class="row" id="">



			<div class="col-12 col-md-4">

				<label class="cont-radio">

					Servicio a domicilio

					<input type="radio" name="misma_direccion" data-id="only-domicilio" class="rbtn-delivery">

					<span class="radio-check"></span>

				</label>

			</div>



			<div class="col-12 col-md-4">

				<label class="cont-radio">

					En Marías

					<input type="radio" name="misma_direccion" data-id="only-maria" checked="true">

					<span class="radio-check"></span>

				</label>

			</div>



		</div>



	</div>



	<div class="col-12">



		<div class="row">



			<div class="col-12 col-md-4 tab-content">



				<div class="tab-pane fade show only-domicilio" id="only-domicilio">



					<form class="form-entrega">



						<div class="form-group">

							<div class="input-group" id="datetimepicker1">

								<input type="text" name="dayEntrega" class="form-control calendar" id="dayEntrega" placeholder="*Día de entrega" readonly="">

								<div class="input-group-append">

									<span class="input-group-text"><span class="fas fa-th"></span></span>

								</div>

							</div>

						</div>



						<div class="form-group">

							<select class="form-control hourEntrega" name="hourEntrega" id="hourEntrega">

								<option value=""> -- Hora de entrega en ruta --</option>

								<?php



								$currentDTGroup = "";



								foreach ($deliveryTimes as $dt) {



									if ($dt["grupo"] != $currentDTGroup) {



										if ($currentDTGroup != '') {

											echo '</optgroup>';

										}



										$currentDTGroup = $dt["grupo"];

										echo "<optgroup label='" . $currentDTGroup . "'>";

									}



									?>



									<option value="<?= $dt["horaInicio"]; ?>" data-group="<?= $dt["grupo"]; ?>" data-location="<?= $dt["ubicacion"]; ?>" data-cost="<?= $dt["costoEnvio"]; ?>"><?php echo $dt["horaInicio"], ' - ', $dt["horaFin"]; ?></option>



									<?php

								}



								echo '</optgroup>';

								?>

							</select>

						</div>



						<div class="form-group" id="containerHour" hidden="hidden">

							<div class="input-group">

								<input type="text" name="hourEntregaSpecial" class="form-control time" id="hourEntregaSpecial" placeholder="Hora de entrega en horario especial" readonly>

								<div class="input-group-append">

									<span class="input-group-text"><span class="fas fa-th"></span></span>

								</div>

							</div>

						</div>



						<div class="form-group">

							<input type="text" name="nameCliente" class="form-control" id="nameCliente" placeholder="*Tu nombre">

						</div>



						<div class="form-group">

							<input type="number" name="phoneCliente" class="form-control" id="phoneCliente" placeholder="*Tu teléfono">

						</div>



						<div class="form-group">

							<input type="text" name="namePersonEntrega" class="form-control" id="namePersonEntrega" placeholder="*Nombre de la persona a entregar">

						</div>



						<div class="form-group">

							<input type="number" name="phonePersonEntrega" class="form-control" id="phonePersonEntrega" placeholder="*Telefono de la persona a entregar">

						</div>



						<div class="form-group">

							<textarea class="form-control" name="noteArreglo" rows="5" id="noteArreglo" placeholder="Agrega nota al arreglo(120 caracteres)" maxlength="120"></textarea>

						</div>



						<div class="map-container">



							<div class="form-group">

								<input type="text" name="direccionCliente" class="form-control direccionCliente address-control" id="direccionCliente" placeholder="*Direccion de entrega">

							</div>



							<div class="form-group">

								<div class="input-group">

									<div class="input-group-prepend">

										<span class="input-group-text">$</span>

									</div>

									<input type="text" name="cosEnvio" class="form-control cosEnvio cost-control" id="cosEnvio" placeholder="*Costo de envio" readonly="" value="60">

								</div>

							</div>



							<div class="form-group">

								<div class="map map-control"></div>

							</div>



							<div class="form-group">

								<input type="hidden" id="ubicacion" name="ubicacion" class="form-control ubicacion location-control" readonly="">

							</div>



						</div>



						<div class="form-group">

							<textarea class="form-control" name="confirmacionDomicilio" id="confirmacionDomicilio" placeholder="Ingrese el domicilio de entrega (confirmación)" rows="5"></textarea>

						</div>



						<div class="form-group">

							<textarea class="form-control" name="detalleExteriorDomicilio" id="detalleExteriorDomicilio" placeholder="Ingrese detalles exteriores del domicilio" rows="5"></textarea>

						</div>



						<div class="form-group">

							<textarea class="form-control" name="descriptionDomicilio" id="descriptionDomicilio" placeholder="Área de trabajo o puesto si es empresa" rows="5"></textarea>

						</div>



						<input type="hidden" name="tipoEntrega" id="tipoEntrega" value="todoDomicilio">



						<div class="form-group" style="text-align: right;">

							<button class="btn btn-secondary" id="btn-confirm-data" data-id="<?= $item['id'] ?>">Todo ok</button>

						</div>



					</form>



				</div>



				<div class="tab-pane fade show active only-maria" id="only-maria">



					<form class="form-entrega">



						<div class="form-group">

							<div class="input-group">

								<input type="text" name="dayEntrega" class="form-control calendar" id="dayEntrega" placeholder="Día de entrega" readonly>

								<div class="input-group-append">

									<span class="input-group-text"><span class="fas fa-th"></span></span>

								</div>

							</div>

						</div>



						<div class="form-group">

							<div class="input-group">

								<input type="text" name="hourEntrega" class="form-control time" id="hourEntrega" placeholder="Hora de entrega" readonly>

								<div class="input-group-append input-group-append-time">

									<span class="input-group-text"><span class="fas fa-th"></span></span>

								</div>

							</div>

						</div>



						<div class="form-group">

							<input type="text" name="nameCliente" class="form-control" id="nameCliente" placeholder="Nombre">

						</div>



						<div class="form-group">

							<input type="number" name="phoneCliente" class="form-control" id="phoneCliente" placeholder="Teléfono">

						</div>



						<input type="hidden" name="tipoEntrega" id="tipoEntrega" value="todoMarias">



						<div class="form-group" style="text-align: right;">

							<button class="btn btn-secondary" id="btn-confirm-data">Todo ok ></button>

						</div>



					</form>



				</div>



			</div>



		</div>



	</div>



</div>



<div class="loading">

	<div class="innerLoading">

		<img src="<?= base_url() ?>assets/img/various/loading.gif">

		<h4>Procesando producto ...</h4>

	</div>

</div>



<!-- Modal -->





<div class="modal fade" id="erroGeolocalizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title" id="exampleModalLabel">

					<span class="far fa-frown"></span>

					Ubicación desactivada

				</h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true" style="color: initial;">&times;</span>

				</button>

			</div>

			<div class="modal-body">

				<div>

					<img width="60%" src="<?= base_url(); ?>assets/img/various/locationDisable.png">

				</div>

				Parece que tu ubicación esta desactivada

				<span class="fa fa-map-marker-alt"></span>

				, porfavor activelo y permita que la aplicación pueda utilizar su ubicación para poder ubicar en donde sera entregado su pedido.

				<p>Att:

					<a href="mailto:mariasdechocolate@gmail.com">mariasdechocolate@gmail.com</a>

				</p>

			</div>

		</div>

	</div>

</div>