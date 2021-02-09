<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  
    Se agrega el archivo inventario para dar de alta los materiales(materia prima) para hacer los productos ejemplo(5 fresas,5 palillos,1 taza,etc.).
-->
<!--ADG0.0.1 Inicia Implementacion-->
<button class="btn btn-primary" data-toggle="modal" data-target="#modalAddInventario">Agregar Material</button>
<hr>

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
				
				<th>Detalles de preparacion</th>

                <th>Fecha Alta</th>

                <th>Fecha Actualizacion</th>

                <th>Activo</th>

                <th>Ingrediente</th>

                <th>Accion</th>

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

                                    <option value="">--- SELECCIONES ---</option>

                                    <?php 

								foreach ($unidadMedida as $value) {

							?>

                                        <option value="<?= $value['id_udm'];?>">
                                            <?= $value['descripcion'];?>
                                        </option>

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
					
					<div class="form-group row">

                        <label class="col-sm-2 col-form-label">¿Es ingrediente?</label>

                        <div class="col-sm-10">

                            <select name="ingrediente" id="ingrediente">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>

                        </div>

                    </div>
					
					 <div class="form-group row">

                        <label class="col-sm-2 col-form-label">Detalle de preparacion:</label>

                        <div class="col-sm-10">

                            <input type="text" name="DetallePepara" class="form-control" id="DetallePepara" placeholder="fresa cubierta de chocolate blanco sin rabo y con un palillo grande">

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success btn-block">Guardar</button>

                    </div>

                </div>
            </form>
        </div>

    </div>
</div>

<!--Actualizar Inventario -->

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
                        <input type="hidden" name="id_itemUpdate" class="form-control" id="id_itemUpdate">

                        <label class="col-sm-2 col-form-label">Material:</label>

                        <div class="col-sm-10">

                            <input type="text" name="descripcionUpdate" class="form-control" id="descripcionUpdate" placeholder="Chocolate">

                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label">Unidad de Medida:</label>

                        <div class="col-sm-10">

                            <input type="text" name="udmUpdate" class="form-control" id="udmUpdate" placeholder="Kilo">

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

                        <label class="col-sm-2 col-form-label">¿Es ingrediente?</label>

                        <div class="col-sm-10">

                            <select name="IngredienteUpdate" id="IngredienteUpdate">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>

                        </div>

                    </div>
					
					 <div class="form-group row">

                        <label class="col-sm-2 col-form-label">Detalle de preparacion:</label>

                        <div class="col-sm-10">

                            <input type="text" name="DetallePeparaUpdate" class="form-control" id="DetallePeparaUpdate" placeholder="fresa cubierta de chocolate blanco sin rabo y con un palillo grande">

                        </div>

                    </div>
					

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <section class="section-preview">
                                <!-- Default inline 1-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="activoInventarioUpdate" name="inlineDefaultRadiosExample" value="1">
                                    <label class="custom-control-label" for="activoInventarioUpdate">Activo</label>
                                </div>

                                <!-- Default inline 2-->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="inactivoInventarioUpdate" name="inlineDefaultRadiosExample" value="0">
                                    <label class="custom-control-label" for="inactivoInventarioUpdate">Inactivo</label>
                                </div>
                            </section>

                        </div>

                        <!--<div class="form-check">
              <input class="form-check-input" type="radio" name="activoUpdate" id="activoUpdate" value="1">
              <label class="form-check-label" for="activo">
                Activo
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="inactivoUpdate" id="inactivoUpdate" value="0">
              <label class="form-check-label" for="inactivo">
                Inactivo
              </label>
            </div>-->
                        <input type="hidden" name="id_statusUpdate" id="id_statusUpdate">
                        <input type="hidden" name="id_udmUpdate" class="form-control" id="id_udmUpdate" placeholder="Kilo">

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Actualizar</button>

                </div>

            </form>
			
			<!--<div class="table-responsive">
<table  class="table" id="tbIngredienteProd"  >
<thead>
<th>Ingredientes</th>
<th>Cantidad</th>
<th class="center">Accion</th>
</tr>
</thead>
	 
</table>
</div>-->

        </div>
		

    </div>

</div>

<!--ADG0.0.1 Finaliza Implementacion-->
<div class="modal fade" id="modalIngredienteInventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Agregar Material</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form id="formIngredienteInventario">

                <div class="modal-body">

                    <div class="form-group">

                        <label>Material:</label>

                        <select class="form-control" name="selectArticulos" id="selectArticulos">
                            <option value="">--- SELECCIONES ---</option>
                            <?php 
                        foreach ($material as $value) {
                        ?>
                                <option value="<?= $value['id_item'];?>">
                                    <?= $value['descripcion'];?>
                                </option>
                                <?php
                        }?>
                        </select>
                        <input type="hidden" id="id_prod" name="id_prod" value="<?= $value['id_producto']?>" />
                        <label>Cantidad:</label>
                        <input id="cantidadElemento" type="number" name="cantidadElemento" value="" />
                        <button class="btn btn-danger push-5-r push-10" type="submit">
                            <span class="fa fa-save"></span>Agregar</button>
                        <!--<input type="hidden" name="redirect" value="<?php echo "http://".$host.$url;?>">-->
                    </div>

                </div>

            </form>
            <div class="table-responsive">
                <!--<table class="table table-striped"  >-->
                <table class="table" id="tbDetalleProd">
                    <thead>
                        <tr>
                            <th>idProducto</th>
                            <th>idMaterial</th>
                            <th>Ingredientes</th>
                            <th>Cantidad</th>
                            <th class="center">Accion</th>
                        </tr>
                    </thead>

                </table>
            </div>

        </div>

    </div>

</div>