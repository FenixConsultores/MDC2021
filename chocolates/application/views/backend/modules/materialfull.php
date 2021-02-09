<!--<div class="table-responsive">
<table class="table" >
<thead>
<tr>
<th>Producto</th>
<th>Material</th>
<th>Cantidad</th>
</tr>
</thead>
	 <tbody>
		 	<?php /*?><?php 
	foreach ($material as $value) { ?><?php */?>
	

     <tr>
		 <td>
			<?php /*?> <?= $value['producto'];?><?php */?>
		</td>
     <td>
		<?php /*?> <?= $value['material'];?><?php */?>
		</td>
		 <td>
		  <?php /*?><?= $value['sumacantidad'];?><?php */?>
		 </td>

		</tr>
	
                        <?php /*?><?php
                        }?><?php */?>
	</tbody>
</table>
</div>

<div class="col-sm-4">
	<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
	<?php /*?><?php 
	foreach ($producto as $values) { ?><?php */?>
<h4 class="mb-3">Producto: <?php /*?><?= $values['nombre'];?> Cantidad  <?= $values['cantidad'];?><?php */?>  </h3>
	
	<?php /*?><?php
                        }?><?php */?>
<div>

</div>
	</div>-->
<div>
	<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
<div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Fecha Inicial:</label>
                        <!--Formato fecha  $hoy = date("Y-m-d");     -->
                        <?php
						$hoy = date("Y-m-d"); 
						?>
                            <div class="input-group">
                                <input type="text" name="" class="form-control" id="minDate1" value="<?= $hoy;?>">
                                <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Fecha Final:</label>
                        <div class="input-group">
                            <input type="text" name="" class="form-control" id="minDate2" value="<?= $hoy;?>">
                            <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
<div class="table-responsive">
	<table class="table table-hover nowrap" id="tbMaterialFull" width="100%">
		<thead>
		<tr>
			<th>Imagen</th>
			<th>Producto</th>
			<th>diaEntrega</th>
			<th>Cantidad Pedidos</th>
			<th>Material</th>
			<th>Total Cantidad</th>
			
			
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
</div>




<!------------------------------------------------------------------------>
<!--<?php /*?><?php 
	foreach ($producto as $values) { ?><?php */?>
<div id="ui-view"><div><div class="animated fadeIn">
<div class="card">
	
<div class="card-header">
<h4 class="mb-3">Producto: <?php /*?><?= $values['nombre'];?></h4> <h4 class="mb-3">Pedidos: <?= $values['cantidad'];?> <?php */?> </h4>
	<form id="fromMaterialProd">
 <input type="hidden"  id="id_producto" name="id_producto" value="<?php /*?><?= $values['id_producto']?><?php */?>"/>
<input type="hidden"  id="cantidad" name="cantidad" value="<?php /*?><?= $values['cantidad']?><?php */?>"/>
		</form>

</div>

</div>
	<?php /*?><?php
                        }?><?php */?>
	
<div class="modal fade" id="modalEditProduct" tabindex="-1" role="dialog" aria-labelledby="modalTitleAdd" aria-hidden="true">	
	<div class="card-body">
<div class="row bd-example2">
<div class="col-8">
<!--<div id="spy-example2" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
<table class="table"  id="tbMaterialFull">
<!--<table  class="table" id="tbDetalleProd"  >-->
<!--<thead>
<tr>
<th>producto</th>
<th>cantidad</th>
	<th>material</th>
		<th>sumaCantidad</th>
</tr>
</thead>
	
</table>
</div>
</div>
</div>
</div>
	</div>-->

	
	
