<div class="row">	<div class="col-2">		<div class="form-group">			<label for="">Fecha Inicial:</label>			<div class="input-group">				<input type="text" name="" class="form-control" id="daMinDate">				<div class="input-group-append">					<span class="input-group-text"><span class="far fa-calendar-alt"></span></span>				</div>			</div>		</div>	</div>	<div class="col-2">		<div class="form-group">			<label>Fecha Final:</label>			<div class="input-group">				<input type="text" name="" class="form-control" id="daMaxDate">				<div class="input-group-append">					<span class="input-group-text"><span class="far fa-calendar-alt"></span></span>				</div>			</div>		</div>	</div>	<div class="col-2">		<div class="form-group">			<label>Hora inicial:</label>			<div class="input-group">				<input type="text" class="form-control" id="daMinHour">				<div class="input-group-append">					<span class="input-group-text"><span class="fas fa-th"></span></span>				</div>			</div>		</div>	</div>	<div class="col-2">		<div class="form-group">			<label>Hora final:</label>			<div class="input-group">				<input type="text" class="form-control" id="daMaxHour">				<div class="input-group-append">					<span class="input-group-text"><span class="fas fa-th"></span></span>				</div>			</div>		</div>	</div>	<div class="col-3">		<div class="form-group">			<label for="cbPurchaseStatus">Estatus asignación:</label>			<select class="form-control" id="daDeliveryAssignmentStatus">				<option value="P" selected="selected">Pendientes por asignar</option>				<option value="A">Asignados</option>			</select>		</div>	</div></div><div class="row oculto" id="optionAddDeliver">	<div class="col-12 col-sm-3">		<h4 class="text-center">			<span class="badge badge-success"><i class="fa fa-tasks"></i> <i id="quantitySelected">22 seleccinado</i></span>		</h4>	</div>	<div class="col-12 col-sm-4">		<select class="form-control" name="rutaSelected" id="rutaSelected">			<option value="">---- SELECCIONA CHOFER ----</option>			<?php foreach ($driver as $value) { ?>				<option value="<?= $value['id_rutas']; ?>"><?= $value['nombre'] . ' | ' . $value['user']; ?></option>			<?php } ?>		</select>	</div>	<div class="col-12 col-sm-3">		<button class="btn btn-primary btn-block" id="showValuesChecked">			<i class="fas fa-user-plus"></i>			ASIGNAR CHOFER		</button>	</div></div><hr><div class="table-responsive">	<table class="table" id="tbAsignRoute" width="100%">		<thead>		<tr>			<th>				<input type="checkbox" id="checkAll">			</th>			<th width="100px">Fecha Entrega</th>			<th>Hora Entrega</th>			<th width="100px">Orden</th>			<th width="200px">Cliente</th>			<th>Geolocalizacion</th>			<th>Dirección</th>			<th>Ruta</th>			<th>Acciones</th>		</tr>		</thead>		<tbody></tbody>	</table></div>