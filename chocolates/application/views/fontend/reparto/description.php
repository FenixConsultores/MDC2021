<?php

if (!empty($description)) {
	foreach ($description as $value) {
		$models = explode(',', $value['modelos']);
		?>

		<div class="headDescription">
			<div class="container">
				<div class="row">
					<div class="col-3 col-sm-2" style="text-align: center;">
						<span class="fa fa-user" id="icon-user"></span>
					</div>
					<div class="col-9 col-am-10 titleDescription">
						<p><strong><?= $value['nombreCliente'] ?></strong></p>
						<p><strong>Hora de entrega: <?= $value['horaEntrega'] ?></strong></p>
						<p id="txtNoORDEN"><?= $value['numeroOrden'] ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="container" id="section2">
			<ul class="list-group">

				<li class="list-group-item">
					<h5>
						<i class="fas fa-map-marker-alt"></i>
						Ubicacion
					</h5>
					<p><?= $value['direccion']; ?></p>
					<label>
						<a href="https://www.google.com.mx/maps/place/<?= $value['geolocalizacion']; ?>" target="_blank">
							<i class="fas fa-location-arrow"></i>
							Ver en google maps
						</a>
					</label>
					<br>
					<label for="">
					<a href="waze://?q=<?= $value['confirmarDomicilio']; ?>" class="hidden-md hidden-lg " target="_blank">Waze Celular</a><br>
						
					<a href="https://www.waze.com/ul?ll=<?= $value['geolocalizacion']; ?>&navigate=yes&zoom=17"  target="_blank" class="hidden-sm hidden-xs">Waze PC</a>
					</label>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-home"></i>
						Confirmación de Domicilio
					</h5>
					<?= $value['confirmarDomicilio']; ?>
				</li>
				<li class="list-group-item">
					<h5>
						<i class="fas fa-home"></i>
						Detalles exteriores del domicilio
					</h5>
					<?= $value['detallesExteriorDomicilio']; ?>
				</li>
				<li class="list-group-item">
					<h5>
						<i class="fas fa-home"></i>
						Área de trabajo o puesto si es empresa
					</h5>
					<?= $value['caracteristicasDomicilio']; ?>
				</li>


				<li class="list-group-item">
					<h5>
						<i class="fas fa-box"></i>
						Modelos que se entregan
					</h5>
					<ul class="list-group">
						<?php for ($i = 0; $i < count($quantity); $i++) { ?>
							<li class="list-group-item">
								<div>
									<div style="display: inline-block;">
										<img src="<?= $routeProdImages ?><?= $quantity[$i]['imagen']; ?>" width="150px;">
									</div>
									<div style="display: inline-block; margin-left: 20px;">
										<?= $quantity[$i]['modelo']; ?><br>
										<span class="badge badge-primary badge-pill"><?= $quantity[$i]['cantidad']; ?> <?= intval($quantity[$i]['cantidad']) > 1 ? "Unidades" : "Unidad"; ?> </span>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-mobile-alt"></i>
						Teléfono Cliente
					</h5>
					<?= $value['telefonoCliente']; ?>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-phone"></i>
						Teléfono Entrega
					</h5>
					<?= $value['telefonoEntrega']; ?>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-users"></i>
						Persona Entrega
					</h5>
					<?= $value['personaEntrega']; ?>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-sticky-note"></i>
						Nota
					</h5>
					<?= $value['nota']; ?>
				</li>

				<li class="list-group-item">
					<h5>
						<i class="fas fa-camera-retro"></i>
						Evidencia
					</h5>

					<?php if ($value['evidencia'] == '' || $value['evidencia'] == NULL) { ?>
						Aun no ha cargado ninguna evidencia
					<?php } else {
						$evidencia = explode(',', $value['evidencia']);
						for ($j = 0; $j < count($evidencia); $j++) { ?>

							<img src="<?= base_url('assets/img/evidencia/') . $evidencia[$j]; ?>" width="200px">

						<?php }
					} ?>

				</li>

			</ul>

		</div>


		<div class="clearfix"></div>

		<div class="section4">
			<div class="row">
				<div class="col-6">
					<label id="spanPicture">
						<input type="file" name="pictureEvidencia" hidden="" id="pictureEvidencia">
						<span class="fas fa-camera"></span>
					</label>
					<br>
					<small><strong>Subir evidencia...</strong></small>
					<br>
					<!-- <button class="btn btn-primary" id="btnspanPicture">Enviar</button> -->
				</div>
				<div class="col-6">
					<?php if ($value['statusEnvio'] == '2' || $value['statusEnvio'] == '3') { ?>

						<label id="spanUser">
							<span class="fas fa-clipboard-check text-success"></span>
						</label><br>
						<small class="text-success"><strong>En ruta</strong></small>

					<?php } else { ?>

						<label id="spanUser">
							<span class="fas fa-times-circle text-danger" id="verifProduct"></span>
						</label><br>
						<small class="text-danger"><strong id="textVerific">Producto sin verificar</strong></small>

					<?php } ?>

				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-6">
					<div class="progress">
						<div class="progress-bar progress-bar-striped" id="porgressBar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
} else {
	?>
	<div class="col-12">
		<div class="alert alert-info">
			No existen datos
		</div>
	</div>

	<?php
}
?>

<!-- animacion cargando -->

<div class="loading">
	<div class="innerLoading">
		<img src="<?= base_url() ?>assets/img/various/file.gif">
		<h4>Subiendo Imagen ...</h4>
	</div>
</div>