<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  
    Se agrega el archivo ingredientes para dar de alta los materiales(materia prima) para hacer los productos ejemplo(taza de gato ingredientes;5 fresas,5 palillos,1 taza,etc.).
--> 
<!--ADG0.0.1 Inicia Implementacion-->
<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddIngredientes">Agregar Material</button><hr>

<div class="table-responsive">

	<table class="table table-hover table-striped" id="tbListIngredientes" width="100%">

		<thead>

			<tr>

				<th>Producto</th>

				<th>Material</th>

				<th>Cantidad</th>
                
                <th>Activo</th>
                
				<!--<th>Accion</th>-->

			</tr>

		</thead>

	</table>

</div>

<!-- Modal add Ingredientes -->

<div class="modal fade" id="modalAddIngredientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Ingredientes</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formAddIngredientes">

      <div class="modal-body">      

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Producto:</label>

      		<div class="col-12 col-sm-6 col-md-3">

					<div class="form-group">						

						<select class="form-control" name="id_producto" id="id_producto">

							<option value="">---	SELECCIONES  ---</option>

							<?php 

								foreach ($producto as $value) {

							?>

							<option value="<?= $value['id_producto'];?>"><?= $value['descripcion'];?></option>

							<?php

								}

							 ?>

						</select>

					</div>

				</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>
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
		   <div class="form-group">
		  			<label>Cantidad:</label>
                    <input id="cantidad" type="number" name="cantidad" value=""/>
		  </div>

      	
      <div class="modal-footer">      

        <button type="submit" class="btn btn-success btn-block">Guardar</button>

      </div>

  	  

    </div>
</form>
  </div>

</div>


<!--Actualizar Ingrediente -->

<div class="modal fade" id="modalUpdateIngredientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Actualizar Material</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formUpdateIngredientes">

      <div class="modal-body">

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Producto:</label>

      		<div class="col-12 col-sm-6 col-md-3">

					<div class="form-group">						

						<select class="form-control" name="id_productoUpdate" id="id_productoUpdate">

							<option value="">---	SELECCIONES  ---</option>

							<?php 

								foreach ($producto as $value) {

							?>

							<option value="<?= $value['id_producto'];?>"><?= $value['descripcion'];?></option>

							<?php

								}

							 ?>

						</select>

					</div>

				</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>

      		<div class="col-12 col-sm-6 col-md-3">

					<div class="form-group">						

						<select class="form-control" name="id_itemUpdate" id="id_itemUpdate">

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
   