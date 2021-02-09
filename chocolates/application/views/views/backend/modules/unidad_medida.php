<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  
    Se agrega el archivo incidencias para dar de alta las incidencias que se tienen en el almacen ejemplo(fresas podridas,palillos rotos,rosas marchitas,etc.).
--> 
<!--ADG0.0.1 Inicia Implementacion-->
<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUnidadMedida">Agregar Unidad Medida</button><hr>

<div class="table-responsive">

	<table class="table table-hover table-striped" id="tbListUnidadMedida" width="100%">

		<thead>

			<tr>

				<th>Clave</th>

				<th>Nombre</th>

				<th>Activo</th>

				<!--<th>Accion</th>-->

			</tr>

		</thead>

	</table>

</div>



<!-- Modal add UnidadMedida -->

<div class="modal fade" id="modalAddUnidadMedida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Unidad de Medida</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formAddUnidadMedida">

      <div class="modal-body">

     

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Clave:</label>

      		<div class="col-sm-10">

      			<input type="text" name="clave" class="form-control" id="clave" placeholder="K">

      		</div>

      	</div>        

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Nombre:</label>

      		<div class="col-sm-10">

      			<input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Kilo">

      		</div>

      	</div>

      	
      <div class="modal-footer">      

        <button type="submit" class="btn btn-success btn-block">Guardar</button>

      </div>

  	  

    </div>
</form>
  </div>

</div>



<!--Actualizar Unidad de medida -->

<div class="modal fade" id="modalUpdateUnidadMedida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Actualizar Unidad de Medida</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formUpdateUnidadMedida">

      <div class="modal-body">

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Clave:</label>

      		<div class="col-sm-10">

      			<input type="text" name="claveUpdate" class="form-control" id="claveUpdate" placeholder="Eje: K">

      		</div>

      	</div>        

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Nombre:</label>

      		<div class="col-sm-10">

      			<input type="text" name="descripcionUpdate" class="form-control" id="descripcionUpdate" placeholder="Eje: Kilo">

      		</div>

      	</div>

      	<div class="form-group row">


      		<div class="form-check">
              <input class="form-check-input" type="radio" name="activoUpdate" id="activoUpdate" value="1" checked>
              <label class="form-check-label" for="activo">
                Activo
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="inactivoUpdate" id="activoUpdate" value="0">
              <label class="form-check-label" for="inactivo">
                Inactivo
              </label>
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
<!--ADG0.0.1 Finaliza Implementacion-->