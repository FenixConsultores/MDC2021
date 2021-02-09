<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  
    Se agrega el archivo incidencias para dar de alta las incidencias que se tienen en el almacen ejemplo(fresas podridas,palillos rotos,rosas marchitas,etc.).
--> 
<!--ADG0.0.1 Inicia Implementacion-->
<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddIncidencia">Agregar Incidencia</button><hr>

<div class="table-responsive">

	<table class="table table-hover table-striped" id="tbListIncidencia" width="100%">

		<thead>

			<tr>

				<th>Material</th>

				<th>detalle</th>

				<th>Cantidad </th>
                
                <th>Fecha Alta</th>

			<!--	<th>Accion</th> -->

			</tr>

		</thead>

	</table>

</div>



<!-- Modal add Incidencia -->

<div class="modal fade" id="modalAddIncidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Incidencia</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formAddIncidencia">

      <div class="modal-body">      

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>
<!--
      		<div class="col-sm-10">

      			<input type="text" name="id_item" class="form-control" id="id_item" placeholder="Chocolate">

      		</div>
-->
            <div class="col-12 col-sm-6 col-md-3">

					<div class="form-group">						

						<select class="form-control" name="id_item" id="id_item">

							<option value="">---	SELECCIONES  ---</option>

							<?php 

								foreach ($material as $value) {

							?>

							<option value="<?= $value['id_item'];?>"><?= $value['descripcion'];?></option>

							<?php

								}

							 ?>

						</select>

					</div>

				</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad:</label>

      		<div class="col-sm-10">

      			<input type="number" name="cantidad" class="form-control" id="cantidad" placeholder="1">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Detalles:</label>

      		<div class="col-sm-10">

      			<input type="text" name="detalle" class="form-control" id="detalle" placeholder="Se callo">

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

<div class="modal fade" id="modalUpdateIncidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Actualizar Material</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formUpdateIncidencia">

      <div class="modal-body">

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>

      		<div class="col-sm-10">

      			<input type="text" name="id_itemUpdate" class="form-control" id="id_itemUpdate" placeholder="Chocolate">

      		</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad:</label>

      		<div class="col-sm-10">

      			<input type="number" name="cantidadUpdate" class="form-control" id="cantidadUpdate" placeholder="1">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Detalles:</label>

      		<div class="col-sm-10">

      			<input type="text" name="detalleUpdate" class="form-control" id="detalleUpdate" placeholder="Se callo">

      		</div>

      	</div> 
          
<!--
      	
      <div class="modal-footer">      

        <button type="submit" class="btn btn-success btn-block">Guardar</button>

      </div>-->

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