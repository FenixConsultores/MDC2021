<div class="row">
	<div class="col-12">
		<form class="formAddRoute" id="formAddRoute">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-3">
					<div class="form-group">
						<input type="text" name="nameRoute" class="form-control" id="nameRoute" placeholder="Nombre ruta">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="form-group">
						<input type="text" name="locationRoute" class="form-control" id="locationRoute" placeholder="Ubicacion">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="form-group">
						<input type="text" name="noteRoute" class="form-control" id="noteRoute" placeholder="Nota">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="form-group">						
						<select class="form-control" name="driverRoute" id="driverRoute">
							<option value="">---	SELECCIONES  ---</option>
							<?php 
								foreach ($drivers as $value) {
							?>
							<option value="<?= $value['id_user'];?>"><?= $value['nombre'].' '.$value['apellido_pat'].' '.$value['apellido_mat'];?></option>
							<?php
								}
							 ?>
						</select>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="form-group">
						<button class="btn btn-primary btn-block">Registrar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="col-12">
		<hr>
	</div>
</div>
<div class="row" id="container-routes">
	<?php
	foreach ($route as $value) {
	?>
	<div class="col-12 col-sm-4 col-md-3" draggable="true" id="<?= 'contRoad_'.$value['id_rutas'];?>">
		<div class="card">
			<div class="card-header text-center"><i class="fas fa-truck"></i><?= $value['nombre'];?></div>
			<div class="card-body">
				<h3 class="text-center"><i class="fas fa-user"></i></h3>
				<h5 class="text-center">Conductor:</h5>
				<p class="card-text text-center"><?= $value['user'].' '.$value['apellido_pat'].' '.$value['apellido_mat']?></p>
			</div>
			<div class="card-footer">
				<p class="card-text text-right">
					<button class="btn btn-warning btn-sm" id="btnEditRoute"><i class="fas fa-edit"></i></button>
					<button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
				</p>
				<div class="editRoute oculto">
					<form class="formUpdateRoad" id="formUpdateRoad">
						<div class="form-group">
							<input type="text" name="roadNameUpdate" class="form-control" value="<?= $value['nombre'];?>">
						</div>
						<div class="form-group">
							<input type="text" name="roadLocationUpdate" class="form-control" value="<?= $value['ubicacion'];?>">
						</div>
						<div class="form-group">
							<input type="text" name="roadNoteUpdate" class="form-control" value="<?= $value['nota'];?>">
						</div>
						<div class="form-group">
							<button class="btn btn-success btn-block">Uctualizar</button>
						</div>
					</form>
				</div>		
			</div>
		</div>		
	</div>
	<?php
	}
	?>	
</div>