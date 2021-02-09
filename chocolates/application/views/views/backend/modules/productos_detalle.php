<?php 
    // var_dump($roles_Ver);
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];

 ?>
<div>
  <?php
	//var_dump($material);
	//echo($host);
	//echo($url);
	 foreach ($pdetalle as $value) { ?>

		 <input type="hidden"  id="id_prod" name="id_prod" value="<?= $value['id_producto']?>"/>
	</div>
<div class="card-header"><!--Id Producto-->
<a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="productos_detalle/?id_producto=<?=  $value['id_producto']  ;?>">
	<i class="fa fa-retweet"></i> Actualizar</a> 
<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
<a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="javascript:history.back()">
	<i class="fa fa-undo-alt"></i> Regresar</a>

	</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-4">
<h6 class="mb-3"> </h6>
<div>
 <img class="d-block w-100" src="<?= base_url('assets/img/modelos/').$value['imagenes']?>" alt="First slide">
	</div>
</div>

<div class="col-sm-4">
<h3 class="mb-3">Detalles:</h3>
<div>
	
<strong><?= $value['nombre'] ?></strong>
</div>
<div><?= $value['modelo'] ?></div>
<div><?= $value['precio'] ?></div>
<div><?= $value['almacen'] ?></div>
<div><?= $value['publicar'] ?></div>
	
</div>

<?php } ?>
<div class="col-sm-4">
<!--<form action ="Procedure/addIngredientes" method="POST"> -->
<form id="formAddIngredienteProd"> 
	<div class="form-group">
	
                    <label>Material:</label>
                    
                    <select class="form-control" name="selectArticulos" id="selectArticulos">
                        <option value="">---	SELECCIONES  ---</option>
                        <?php 
                        foreach ($material as $value) {
                        ?>
                        <option value="<?= $value['id_item'];?>"><?= $value['descripcion'];?></option>
                        <?php
                        }?>
                    </select>
					<input type="hidden" id="id_prod" name="id_prod" value="<?= $value['id_producto']?>"/>
                    <label>Cantidad:</label>
                    <input id="cantidadElemento" type="number" name="cantidadElemento" value=""/>
					<button class="btn btn-danger push-5-r push-10" type="submit" >
					<span class="fa fa-save"></span>Guardar</button>
					<input type="hidden" name="redirect" value="<?php echo "http://".$host.$url;?>">
                </div>
	</form>
</div>

</div>

<div class="table-responsive">
<!--<table class="table table-striped"  >-->
<table  class="table" id="tbDetalleProd"  >
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
</div></div>
</div>
</div>



<!--Eliminar  Detalles Producto-->


<div class="modal fade" id="confirmDropDetalleProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<form  id ="formDropDetalleProducto" >

  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-body">



      	<input type="hidden" name="idProdDrop" id="idProdDrop">
		  
		<input type="hidden" name="idItemDrop" id="idItemDrop">



        <p>Esta seguro de eliminar este ingrediente <strong id="nameIngredienteDrop"></strong></p>



      </div>



      <div class="modal-footer footerConfirmDrop">



      	<div class="col-6">



      		<button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal"><i class="fas fa-ban"></i> No</button>



      	</div>



      	<div class="col-6">



      		<button type="button" class="btn btn-danger btn-lg btn-block" id="btnDetallePrdoDrop"><i class="fas fa-trash-alt"></i> Si</button>



      	</div>                



      </div>



    </div>

 </div>


</from>

</div>