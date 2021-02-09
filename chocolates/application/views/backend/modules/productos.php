<!--
    Fecha      Version 
    04-02-18   ADG0.0.1  Inicia 
    Se agrega comenta el apartado de descripcion y se agrega los input dinamicon para agregar los materiales que se ocupan para elaborar el producto ejemplo(Ramo de Fresas "ingredientes: rosas,fresas,etc.").
-->
<div class="row">

	<div class="col-12">

		<button class="btn btn-primary" id="btnModalAddProduct" data-toggle="modal" data-target="#modalAddNewProduct"><span class="fas fa-box"></span>&nbsp;Nuevo Producto</button>

	</div>

	<br><br>

	<div class="col-12">

		<div class="content-products row" id="content-products">

			<?php 				

				for ($i=0; $i <count($products) ; $i++) {

					$pictures = explode(',',$products[$i]['imagenes']);					

			?>

			<div class="col-12 col-sm-4 col-md-3">

				<div class="card">

					<div id="<?= $products[$i]['id_producto'] ;?>" class="carousel slide" data-ride="carousel">

					  <div class="carousel-inner">

					  	<div class="carousel-item active">

					      <img class="d-block w-100" src="<?= base_url('assets/img/modelos/').$pictures[0];?>" alt="First slide">

					    </div>

					    <?php 

					    	for($j = 1;$j<count($pictures);$j++) {

					    ?>

					    <div class="carousel-item">

					      <img class="d-block w-100" src="<?= base_url('assets/img/modelos/').$pictures[$j];?>" alt="First slide">

					    </div>

					    <?php

					    	}

					     ?>					    

					  </div>

					  <a class="carousel-control-prev" href="#<?= $products[$i]['id_producto'] ;?>" role="button" data-slide="prev">

					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>

					    <span class="sr-only">Previous</span>

					  </a>

					  <a class="carousel-control-next" href="#<?= $products[$i]['id_producto'] ;?>" role="button" data-slide="next">

					    <span class="carousel-control-next-icon" aria-hidden="true"></span>

					    <span class="sr-only">Next</span>

					  </a>

					</div>					

					<div class="card-body">

						<input type="hidden" name="allImgDeleted" id="allImgDeleted" value="<?= $products[$i]['imagenes'];?>">
						<input type="hidden" name="img" id="img" value="<?= $products[$i]['imagenes'];?>">
						<input type="hidden" name="dni" id="dni" value="<?= $products[$i]['id_producto'];?>">
						<input type="hidden" name="dniProduct" id="dniProduct" value="<?= $products[$i]['id_producto'];?>">

						<h5 class="card-title"><?= $products[$i]['modelo']?></h5>

						<p class="card-text"><?= $products[$i]['nombre']?></p>

						<label>Almacen: <span class="badge badge-primary"><?= $products[$i]['almacen']?></span></label>

						<label>Publicado: <span class="badge badge-success"><?= $products[$i]['publicar']?></span></label>

						<label>Costo: <span class="badge badge-primary">$ <?= $products[$i]['precio']?></span></label><br>

						<div class="row">
							<div class="col-md-8">
								<button class="btn btn-warning" title="Editar producto" onclick='modalProductUpdate(<?= json_encode($products[$i]); ?>,this)'>
									<span class="fas fa-edit"></span>
								</button>

								<button class="btn btn-info btnEditMaterials" title="Editar materiales" data-product-id="<?= $products[$i]['id_producto'] ;?>">
									<span class="fas fa-bookmark"></span>
								</button>
								<a href="productos_detalle/?id_producto=<?= $products[$i]['id_producto'] ;?>">
								<button class="btn btn-success" title="Editar materiales" >
									<span class="fas fa-clipboard-list"></span>
								</button>
								</a>
							</div>
							<div class="col-md-4">
								<button class="btn btn-danger pull-right" id="btnDelete" title="Eliminar producto">
									<span class="fas fa-window-close"></span>
								</button>
							</div>
						</div>
					</div>

				</div>

			</div>

			<?php

				}

			 ?>

		</div>

	</div>	

</div>



<!-- Modal add new Product -->

<div class="modal fade" id="modalAddNewProduct" tabindex="-1" role="dialog" aria-labelledby="modalTitleAdd" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="modalTitleAdd">Agregar <span class="badge badge-primary">NUEVO</span> producto</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>



        </button>

      </div>

      <div class="modal-body">

        <form id="formAddProduct">

        	<div class="row img-preview preview-msg">        		

        	</div>	        

	        <input type="file" name="imageModel[]" id="imageModel" multiple="multiple" hidden="true">	        	

	        <hr>

	        <div class="form-group row">

	        	<label class="col-sm-2">Nombre:</label>

	        	<div class="col-sm-10">

	        		<input type="text" name="nameProduct" class="form-control" id="nameProduct" placeholder="Nombre">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Modelo:</label>

	        	<div class="col-sm-10">

	        		<input type="text" name="modelProduct" class="form-control" id="modelProduct" placeholder="Modelo">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Precio:</label>

	        	<div class="col-sm-10">

	        		<input type="number" name="priceProduct" class="form-control" id="priceProduct" placeholder="50.00">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Almacen:</label>

	        	<div class="col-sm-10">

	        		<input type="number" name="almacenProduct" class="form-control" id="almacenProduct" placeholder="33">

	        	</div>

	        </div>
 <div class="form-group row">

	        	<label class="col-sm-2">Publicar:</label>

	        	<div class="col-sm-10">

	        		<select class="form-control" name="publicateProduct" id="publicateProduct">

	        			<option value="si">si</option>

	        			<option value="no">no</option>

	        		</select>

	        	</div>

	        </div>	   
	        <div class="hidden">

	        	<label class="col-sm-2">Descripcion:</label>
				<input type="number" name="descriptionProduct" class="form-control" id="descriptionProduct" value="1">
			
			<div class="field_wrapper">
                <div class="form-group">
                    <label>Material:</label>
                    
                    <select class="form-control" name="articulos" id="selectArticulos">
                        <option value="">---	SELECCIONES  ---</option>
                        <?php 
                        foreach ($material as $value) {
                        ?>
                        <option value="<?= $value['id_item'];?>"><?= $value['descripcion'];?></option>
                        <?php
                        }?>
                    </select>
                    <!--<input type="text" name="articulos[]" value=""/>-->
                    <label>Cantidad:</label>
                    <input id="cantidadElemento" type="number" name="cantidades" value=""/>
                    <button id="btnAgregarAlgo"  class="add_button" name="mas">+</button>
                    <table id="tablaElementos">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            </div>
	<!--<script>
                var elementos = [];
                $("#btnAgregarAlgo").click(function(){
                    var idElemeto = $("#selectArticulos").val();
                    var nombreElemnto = $('#selectArticulos option:selected').text();
                    var cantidad = $("#cantidadElemento").val();
                    elementos.push({idE: idElemeto, cantidadElemento: cantidad});
                    $("#tablaElementos tbody").append("<tr><td>"+nombreElemnto+"</td><td>"+cantidad+"</td></tr>")
                });
			 	
            </script>
-->
	                   

      </div>

      <div class="modal-footer">        

        <button type="submit" class="btn btn-primary btn-block" id="btnAddNewProduct">Agregar</button>
		  <script>
              
		     // localStorage.setItem("materiales",elementos);
//				alert(elementos);
			 	
            </script>

        </form>

      </div>

    </div>

  </div>

</div>



<!-- Modal Edit Product -->

<div class="modal fade" id="modalEditProduct" tabindex="-1" role="dialog" aria-labelledby="modalTitleAdd" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="modalTitleAdd">Editar Producto</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <form id="formUpdateProducts">

        	<input type="hidden" name="dniUpdate" id="dniUpdate">

        	<div class="row img-previewUpdate" id="imgUpdate" style="height: auto;">	        	

        		

	        </div>	        

	        	<input type="file" name="imageModelUpdate[]" id="imageModelUpdate" multiple="multiple">	        

	        <hr>

	        <div class="form-group row">

	        	<label class="col-sm-2">Nombre:</label>

	        	<div class="col-sm-10">

	        		<input type="text" name="nameProductUpdate" class="form-control" id="nameProductUpdate" placeholder="Nombre">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Modelo:</label>

	        	<div class="col-sm-10">

	        		<input type="text" name="modelProductUpdate" class="form-control" id="modelProductUpdate" placeholder="Modelo">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Precio:</label>

	        	<div class="col-sm-10">

	        		<input type="number" name="priceProductUpdate" class="form-control" id="priceProductUpdate" placeholder="50.00">

	        	</div>

	        </div>

	        <div class="form-group row">

	        	<label class="col-sm-2">Almacen:</label>

	        	<div class="col-sm-10">

	        		<input type="number" name="almacenProductUpdate" class="form-control" id="almacenProductUpdate" placeholder="33">

	        	</div>

	        </div>
<div class="form-group row">

	        	<label class="col-sm-2">Publicar:</label>

	        	<div class="col-sm-10">

	        		<select class="form-control" name="publicateProductUpdate" id="publicateProductUpdate">

	        			<option value="si">si</option>

	        			<option value="no">no</option>

	        		</select>

	        	</div>

	        </div>	
	        <div class="hidden">

	        	<label class="col-sm-2">Descripcion:</label>

	        	<div class="col-sm-10">
					
					<input type="number" name="descriptionProductUpdate" class="form-control" id="descriptionProductUpdate" value="1">

	        	</div>

			<div class="field_wrapper">
                <div class="form-group">
                    <label>Material:</label>
                    
                    <select class="form-control" name="articulos" id="selectArticulosUpdate">
                        <option value="">---	SELECCIONES  ---</option>
                        <?php 
                        foreach ($material as $value) {
                        ?>
                        <option value="<?= $value['id_item'];?>"><?= $value['descripcion'];?></option>
                        <?php
                        }?>
                    </select>
                    <!--<input type="text" name="articulos[]" value=""/>-->
                    <label>Cantidad:</label>
                    <input id="cantidadElementoUpdate" type="number" name="cantidades" value=""/>
                    <button id="btnAgregarAlgoUpdate" class="add_button" name="mas">+</button>
                    <table id="tablaElementosUpdate">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
			</div>
			<!--
            <script>
                var elementosUpdate = [];
                $("#btnAgregarAlgoUpdate").click(function(){
                    var idElemetoUpdate = $("#selectArticulosUpdate").val();
                    var nombreElemntoUpdate = $('#selectArticulosUpdate option:selected').text();
                    var cantidadUpdate = $("#cantidadElementoUpdate").val();
                    elementosUpdate.push({idE: idElemetoUpdate, cantidadElementoUpdate: cantidad});
                    $("#tablaElementosUpdate tbody").append("<tr><td>"+nombreElemntoUpdate+"</td><td>"+cantidad+"</td></tr>")
                });
            </script>-->

	                             

      </div>

      <div class="modal-footer">

        <button type="submit" class="btn btn-success btn-block" id="btnUpdateProduct">Actualizar</button>        

        </form>

      </div>

    </div>

  </div>

</div>


<!-- Modal add delivery time-->
<div class="modal fade" id="modalProductMaterials" tabindex="-1" role="dialog" aria-labelledby="addProductMaterialsLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addProductMaterialsLabel">Descripción del producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form id="formAddProductMaterials">

					<input type="hidden" id="productId" value="-1" class="form-control" data-binding-field="id_producto" />

					<div class="row">
						<div class="col-xs-12 col-md-4">
							<div>
								<img id="tImage" src="" class="w-100">
							</div>
						</div>
						<div class="col-xs-12 col-md-8">

							<div class="form-group row">
								<label for="tStrawberry" class="col-sm-4 col-form-label">Tipo fresas:</label>
								<div class="col-sm-8">
									<select id="tStrawberry" class="form-control" data-binding-field="t_fresa">
										<option value="normal">Normal</option>
										<option value="chica">Chica</option>
										<option value="grande">Grande</option>
										<option value="acostada">Acostada</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="nStrawberry" class="col-sm-4 col-form-label">No. fresas:</label>
								<div class="col-sm-8">
									<input type="text" id="nStrawberry" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="no_fresas" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nStrawberryBrown" class="col-sm-4 col-form-label">No. fresas café:</label>
								<div class="col-sm-8">
									<input type="text" id="nStrawberryBrown" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="no_fresas_cafe" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nStrawberryWhite" class="col-sm-4 col-form-label">No. fresas blancas:</label>
								<div class="col-sm-8">
									<input type="text" id="nStrawberryWhite" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="no_fresas_blanca" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nRoses" class="col-sm-4 col-form-label">No. rosas:</label>
								<div class="col-sm-8">
									<input type="text" id="nRoses" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="no_rosas" />
								</div>
							</div>

							<div class="form-group row">
								<label for="nSpirals" class="col-sm-4 col-form-label">No. espirales:</label>
								<div class="col-sm-8">
									<input type="text" id="nSpirals" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="espirales" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nDots" class="col-sm-4 col-form-label">No. puntos:</label>
								<div class="col-sm-8">
									<input type="text" id="nDots" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="puntos" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nStripes" class="col-sm-4 col-form-label">No. rayas:</label>
								<div class="col-sm-8">
									<input type="text" id="nStripes" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="rayas" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nFigures" class="col-sm-4 col-form-label">No. figuras:</label>
								<div class="col-sm-8">
									<input type="text" id="nFigures" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="figuras" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nFlats" class="col-sm-4 col-form-label">No. lisas:</label>
								<div class="col-sm-8">
									<input type="text" id="nFlats" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="lisa" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nChocolate" class="col-sm-4 col-form-label">No. chocolates:</label>
								<div class="col-sm-8">
									<input type="text" id="nChocolate" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="s_chocolate" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nNakedStripes" class="col-sm-4 col-form-label">No. desnuda/rayada:</label>
								<div class="col-sm-8">
									<input type="text" id="nNakedStripes" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="desnuda_rayada" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nChocolateRose" class="col-sm-4 col-form-label">No. rosas de chocolate:</label>
								<div class="col-sm-8">
									<input type="text" id="nChocolateRose" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="rosa_de_chocolate" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nSmallStick" class="col-sm-4 col-form-label">No. palos chicos:</label>
								<div class="col-sm-8">
									<input type="text" id="nSmallStick" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="palo_chico" />
								</div>
							</div>
							<div class="form-group row">
								<label for="nBigStick" class="col-sm-4 col-form-label">No. palos grandes:</label>
								<div class="col-sm-8">
									<input type="text" id="nBigStick" class="form-control plg-numeric" maxlength="3" value="0" data-binding-field="palo_grande" />
								</div>
							</div>

						</div>
					</div>

					<div>
						<button type="submit" class="btn btn-success btn-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modalAddIngredienteProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
   <form >
		<input type="text" id="id_productoIngre"/>
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
	</form>
	</div>
</div>