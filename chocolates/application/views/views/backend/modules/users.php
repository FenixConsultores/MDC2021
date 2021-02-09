<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser"><i class="fas fa-user-plus"></i> nuevo usuario</button><hr>
<div class="table-responsive">
	<table class="table table-hover table-striped" id="tbListUsers" width="100%">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Ap. Paterno</th>
				<th>Ap. Materno</th>
				<th>E-mail</th>
				<th>Telefono</th>
				<th>Password</th>
				<th>Tipo User</th>
				<th>Accion</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<!-- Modal add User -->
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formAddUser">
      <div class="modal-body">
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Tipo:</label>
      		<div class="col-sm-10">
      			<select class="form-control" name="typeUser" id="typeUser">
      				<option value="">---- SELECCIONA ----</option>
      				<option value="Administrador">Administrador</option>
      				<option value="Estandar">Estandar</option>
      				<option value="Chofer">Chofer</option>
      			</select>
      		</div>
      	</div> 
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Nombre:</label>
      		<div class="col-sm-10">
      			<input type="text" name="nameUser" class="form-control" id="nameUser" placeholder="Maria">
      		</div>
      	</div>        
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Paterno:</label>
      		<div class="col-sm-10">
      			<input type="text" name="firstName" class="form-control" id="firstName" placeholder="Gomez">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Materna:</label>
      		<div class="col-sm-10">
      			<input type="text" name="lastName" class="form-control" id="lastName" placeholder="Vazquez">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Telefono:</label>
      		<div class="col-sm-10">
      			<input type="text" name="phoneUser" class="form-control" id="phoneUser" placeholder="222345678">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">E-mail:</label>
      		<div class="col-sm-10">
      			<input type="text" name="emailUser" class="form-control" id="emailUser" placeholder="maria@example.com">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Password:</label>
      		<div class="col-sm-10">
      			<input type="password" name="passUser" class="form-control" id="passUser" placeholder="*****************">
      		</div>
      	</div>
      </div>
      <div class="modal-footer">      
        <button type="submit" class="btn btn-success btn-block">Registrar</button>
      </div>
  	  </form>
    </div>
  </div>
</div>

<!-- Modal update User data -->
<div class="modal fade" id="modalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateUser">
      <div class="modal-body">
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Tipo:</label>
      		<input type="hidden" name="inpDniUser" id="inpDniUser">
      		<div class="col-sm-10">
      			<select class="form-control" name="typeUserUpdate" id="typeUserUpdate">
      				<option value="">---- SELECCIONA ----</option>
      				<option value="Administrador">Administrador</option>
      				<option value="Estandar">Estandar</option>
      				<option value="Chofer">Chofer</option>
      			</select>
      		</div>
      	</div> 
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Nombre:</label>
      		<div class="col-sm-10">
      			<input type="text" name="nameUserUpdate" class="form-control" id="nameUserUpdate" placeholder="Eje: Maria">
      		</div>
      	</div>        
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Paterno:</label>
      		<div class="col-sm-10">
      			<input type="text" name="firstNameUpdate" class="form-control" id="firstNameUpdate" placeholder="Eje: Gomez">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Materna:</label>
      		<div class="col-sm-10">
      			<input type="text" name="lastNameUpdate" class="form-control" id="lastNameUpdate" placeholder="Eje: Vazquez">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Telefono:</label>
      		<div class="col-sm-10">
      			<input type="text" name="phoneUserUpdate" class="form-control" id="phoneUserUpdate" placeholder="Eje: 222345678">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">E-mail:</label>
      		<div class="col-sm-10">
      			<input type="text" name="emailUserUpdate" class="form-control" id="emailUserUpdate" placeholder="Eje: maria@example.com">
      		</div>
      	</div>
      	<div class="form-group row">
      		<label class="col-sm-2 col-form-label">Password:</label>
      		<div class="col-sm-10">
      			<div class="input-group">
      				<input type="password" name="passUserUpdate" class="form-control" id="passUserUpdate" placeholder="Eje: *****************">
      				<div class="input-group-append">
      					<!-- fa-eye-slash -->
      					<button class="btn btn-secondary" id="btnPeviewPass"><i class="fa fa-eye"></i></button>
      				</div>
      			</div>      			
      		</div>
      	</div>
      </div>
      <div class="modal-footer">      
        <button type="submit" class="btn btn-success btn-block">Actualizar</button>
      </div>
  	  </form>
    </div>
  </div>
</div>