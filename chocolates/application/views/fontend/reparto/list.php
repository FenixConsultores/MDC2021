<style>
	.filter-button-container {
		margin-top: 20px;
		margin-bottom: 20px;
	}

	.filter-button {
		display: inline-block;
		padding: 8px 12px;
		margin-right: 15px;
		cursor: pointer;
		font-size: 1.2em;
		font-weight: 700;
		border: solid 1px rgba(128, 128, 128, 0.4);
	}

	/*.filter-button.active {*/
		/*background: rgba(128, 128, 128, 0.3) !important;*/
		/*color: #0b0e0f !important;*/
	/*}*/

	@media (max-width: 576px){
		.filter-button {
			font-size: 1em;
		}
	}

</style>

<div class="filter-button-container">
    <span class="filter-button btn active" data-filter-by="P">Por entregar</span>
	<span class="filter-button btn " data-filter-by="E">Entregados</span>
</div>

<div class="row">

	<div class="col-12" id="listEntrega">

		<div class="list-group">

			<?php
			if (!empty($data)) {
				//print_r($data);
				//print_r($quantity);
				

				foreach ($data as $value) {

					?>

					<a href="<?= base_url(); ?>fontend/ruta/home/description/<?= $value['numeroOrden']; ?>" class="list-group-item list-group-item-action <?= ($value['evidencia'] != '' || $value['evidencia'] == 'null') ? 'entrega-completa' : ''; ?>  <?= intval($value['statusEnvio']) == 3 ? 'delivered' : 'non-delivered'; ?> ">

						<?= $value['evidencia']; ?>

						<div class="d-flex w-100 justify-content-between">

							<h5 class="mb-1">
								<i class="fas fa-user"></i> <?= $value['nombreCliente']; ?></h5>
							<h5>
								<span class="badge <?= ($value['evidencia'] != '' || $value['evidencia'] == 'null') ? 'badge-success' : 'badge-danger'; ?>"><i class="fas fa-calendar-alt"></i> <?= $value['diaEntrega']; ?></span>
								<span class="badge <?= ($value['evidencia'] != '' || $value['evidencia'] == 'null') ? 'badge-success' : 'badge-danger'; ?>"><i class="fas fa-clock"></i> <?= $value['horaEntrega']; ?></span>
							</h5>

						</div>
						
						<div class="container">
						  <div class="row">
							<div class="col col-example">
								<p>
									<i class="fas fa-star"></i>
									Orden: <strong><?= $value['numeroOrden']; ?></strong>
								</p>

								<p>
									<i class="fas fa-map-marker-alt"></i>
									Dirección <strong><?= $value['direccion']; ?></strong>
								</p>  
							</div>
							<div class="col col-example">
								<?php for ($i = 0; $i < count($quantity); $i++) {
								if ($quantity[$i]['numeroOrden'] == $value['numeroOrden']){
								?>
								
								
									<div style="display: inline-block;">
										<p>
									
									Cantidad <strong><?= $quantity[$i]['cantidad']; ?></strong>
								</p>  
										<img src="<?= $routeProdImages ?><?= $quantity[$i]['imagen']; ?>" width="150px;">
									</div>
									
								
							
								<?php } } ?>
								<!--<div style="display: inline-block;">
										<img src="<?php /*?><?= $routeProdImages ?><?= $value['imagen']; ?><?php */?>" width="150px;">
									
									</div>  -->
								
							</div>
							
						  </div>
						</div>

						
					</a>

					<?php

				}

			} else {

				?>

				<div class="alert alert-info" style="margin-top: 30px;border-radius: 0;">
					<h2>
						<i class="fas fa-info-circle"></i>
						Aun no se te han asignado tus rutas
					</h2>
				</div>

			<?php } ?>

		</div>
	</div>
</div>