<!--<div class="table-responsive">
<table class="table table-striped"  >
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
		 <td><<?php /*?>?= $value['producto'];?><?php */?>
		</td>
     <td><?php /*?><?= $value['material'];?><?php */?>
		</td>
		 <td>
		 <?php /*?> <?= $value['sumacantidad'];?><?php */?>
		 </td>

		</tr>
	
                       <?php /*?> <?php
                        }?><?php */?>
	</tbody>
</table>
</div>-->
<div>
	<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
<div class="table-responsive">
	<table class="table table-hover nowrap" id="tbMaterialPagado" width="100%">
		<thead>
		<tr>
			<th>Producto</th>
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