
<div>
  <?php
	//var_dump($pdetalle);
	//echo json_decode($pdetalle);
	 foreach ($pdetalle as $value) { ?>

		
	</div>
<div class="card-header"><!--Id Producto-->
<!--<a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="inventario_detalle.php/?id_item=<?= $idItem?>">
	<i class="fa fa-retweet"></i> Actualizar</a> -->
<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
<a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="javascript:history.back()">
	<i class="fa fa-undo-alt"></i> Regresar</a>

	</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-8">
<h3 class="mb-3"> 
	<strong><?= $value['descripcion'] ?></strong>
</h3>
<h6 class="mb-3">Detalles:</h6>

<div>
	
<strong><?= $value['detalle_prepara'] ?></strong>
</div>
</div>



<?php } ?>
<div class="col-sm-4">
<form id="formAddSubInv"> 
	<input type="hidden"  id="idItem" name="idItem" value="<?= $idItem?>"/>
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
                    <label>Cantidad:</label>
                    <input id="cantidadElemento" type="number" name="cantidadElemento" value=""/>
					<button class="btn btn-danger push-5-r push-10" type="submit" >
					<span class="fa fa-save"></span>Guardar</button>
					
                </div>
	</form>
</div>

</div>

<div class="table-responsive">
<div class="table-responsive">
<table  class="table" id="tbIngredienteProd"  >
<thead>
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
</div></div>
</div>
</div>



<!--Eliminar  Detalles Producto-->


<div class="modal fade" id="confirmDropSubInv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<form  id ="formDropSubInv" >

  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-body">



      	<input type="hidden" name="id_ItemIngrediente" id="id_ItemIngrediente">
		  
		<input type="hidden" name="idItemDrop" id="idItemDrop">



        <p>Esta seguro de eliminar este ingrediente <strong id="nameIngredienteDrop"></strong></p>



      </div>



      <div class="modal-footer footerConfirmDrop">



      	<div class="col-6">



      		<button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal"><i class="fas fa-ban"></i> No</button>



      	</div>



      	<div class="col-6">



      		<button type="button" class="btn btn-danger btn-lg btn-block" id="btnSubInvDrop"><i class="fas fa-trash-alt"></i> Si</button>



      	</div>                



      </div>



    </div>

 </div>


</from>

</div>