<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  
    Se agrega el archivo inventario para dar de alta los materiales(materia prima) para hacer los productos ejemplo(5 fresas,5 palillos,1 taza,etc.).
--> 
<!--ADG0.0.1 Inicia Implementacion-->
<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddInventario">Agregar Material</button><hr>

<div class="table-responsive">

	<table class="table table-hover table-striped" id="tbListInventario" width="100%">

		<thead>

			<tr>

				<!--<th>ID</th>-->
				
				<th>Material</th>

				<th>Unidad de Medida</th>

				<th>Cantidad Fisica</th>
                
                <th>Cantidad Logica</th>
                
                <th>Cantidad Maxima</th>
                
                <th>Cantidad Minima</th>
                
                <th>Fecha Alta</th>
                
                <th>Fecha Actualizacion</th>
                
                <th>Activo</th>

				<!--<th>Accion</th>
-->
			</tr>

		</thead>

	</table>

</div>



<!-- Modal add Inventario -->

<div class="modal fade" id="modalAddInventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Agregar Material</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formAddInventario">

      <div class="modal-body">      

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>

      		<div class="col-sm-10">

      			<input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Chocolate">

      		</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Unidad de Medida:</label>
            <div class="col-12 col-sm-6 col-md-3">

					<div class="form-group">						

						<select class="form-control" name="id_udm" id="id_udm">

							<option value="">---	SELECCIONES  ---</option>

							<?php 

								foreach ($unidadMedida as $value) {

							?>

							<option value="<?= $value['id_udm'];?>"><?= $value['descripcion'];?></option>

							<?php

								}

							 ?>

						</select>

					</div>

				</div>


      	
      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Fisica:</label>

      		<div class="col-sm-10">

      			<input type="text" name="cantidad_fisica" class="form-control" id="cantidad_fisica" placeholder="7">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Maxima:</label>

      		<div class="col-sm-10">

      			<input type="text" name="maximo" class="form-control" id="maximo" placeholder="50">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Minima:</label>

      		<div class="col-sm-10">

      			<input type="text" name="minimo" class="form-control" id="minimo" placeholder="50">

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

<div class="modal fade" id="modalUpdateInventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Actualizar Material</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form id="formUpdateInventario">

      <div class="modal-body">

      	<div class="form-group row">

      		<label class="col-sm-2 col-form-label">Material:</label>

      		<div class="col-sm-10">

      			<input type="text" name="descripcionUpdate" class="form-control" id="descripcionUpdate" placeholder="Chocolate">

      		</div>

      	</div>
        <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Unidad de Medida:</label>

      		<div class="col-sm-10">

      			<input type="text" name="id_udmUpdate" class="form-control" id="id_udmUpdate" placeholder="Kilo">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Fisica:</label>

      		<div class="col-sm-10">

      			<input type="text" name="cantidad_fisicaUpdate" class="form-control" id="cantidad_fisicaUpdate" placeholder="7">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Maxima:</label>

      		<div class="col-sm-10">

      			<input type="text" name="maximoUpdate" class="form-control" id="maximoUpdate" placeholder="50">

      		</div>

      	</div> 
          <div class="form-group row">

      		<label class="col-sm-2 col-form-label">Cantidad Minima:</label>

      		<div class="col-sm-10">

      			<input type="text" name="minimoUpdate" class="form-control" id="minimoUpdate" placeholder="50">

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
			
      	
      			<input  type="hidden"  name="idItem"  id="idItem" >
        <button type="submit" class="btn btn-success btn-block">Actualizar</button>

      </div>

  	  </form>

    </div>

  </div>

</div>
<!--ADG0.0.1 Finaliza Implementacion-->
   