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
	<table class="table table-hover nowrap" id="tbMaterialPagado" width="100%">
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