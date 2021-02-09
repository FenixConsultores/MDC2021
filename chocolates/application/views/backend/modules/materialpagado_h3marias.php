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

<?php 
	
//var_dump($material);
?>

<div>
	<hr>
	<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
	<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="materialpagado_h3">A domicilio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="materialpagado_h3marias">En Marias</a>
  </li>
</ul>
	
            <hr>
 <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Fecha Inicial:</label>
                        <!--Formato fecha  $hoy = date("Y-m-d");     -->
                         <?php
						if (isset($_GET["DateIn3marias"]) ) {
   
    						$DateIn3marias = $_GET["DateIn3marias"];
						}
						else{
							$DateIn3marias=date("Y-m-d"); 
						}
						if (isset($_GET["DateFn3marias"]) ) {
   
    						$DateFn3marias = $_GET["DateFn3marias"];
						}
						else{
							$DateFn3marias=date("Y-m-d"); 
						}
						 
						?>
                            <div class="input-group">
                                <input type="text" name="" class="form-control" id="DateIn3marias" value="<?= $DateIn3marias;?>">
                                <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Fecha Final:</label>
                        <div class="input-group">
                            <input type="text" name="" class="form-control" id="DateFn3marias" value="<?= $DateFn3marias;?>">
                            <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <hr>
<div class="container">
	<div class="col-12">
		<h1>Horario de 16:00 - 18:00</h1>
	</div>
</div>

<!--<div class="table-responsive">
	<table class="table table-hover nowrap" id="tbMaterialPagado_H1" width="100%">
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
</div>-->
	
	
	<div class="row">
		

	<div class="col-12">

		<div class="content-products row" >

			<?php 	

				for ($i=0; $i <count($material) ; $i++) {
					if(( $material[$i]['diaEntrega'] >= $DateIn3marias) && ( $material[$i]['diaEntrega'] <= $DateFn3marias)){
						
					
					$pictures = explode(',',$material[$i]['imagen']);					

			?>

			<div class="col-12 col-sm-4 col-md-4" >

				<div class="card" style="height: 600px; overflow: auto; position: relative;">

					<div id="<?= $material[$i]['id_producto'] ;?>" class="carousel slide" data-ride="carousel">

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

					  

					</div>					

					<div class="card-body">


						<h3 class="card-title"><?= $material[$i]['producto']?></h3>
						<hr>
						
						<h5 class="card-title">F. E. : <small  class="card-text"> <?= $material[$i]['diaEntrega']?></small></h3>
						
						<h5 class="card-title">Cantidad:  <span class="badge badge-primary"><?= $material[$i]['cantidad']?></span></h3> 

						

						<?php if($material[$i]['materialtab']!='NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO'){
							 ?>
						<table class="table table-striped">
							<thead>
							<tr>
								<th>Material</th>
								<th>Cantidad</th>
							</tr>
							</thead>
							<tbody>
								<? echo $material[$i]['materialtab']?>
								
								
								
								 
								
							</tbody>

						</table>
							 
						<?php
							 
						 }
					else{
						echo $material[$i]['materialtab'];
					}
						 ?>	 
						
						
						
						<!--<h5 class="card-text">Material:</h5>
						<p class="card-text"><?php /*?><?= $material[$i]['ingrediente']?><?php */?></p>-->


						
					</div>

				</div>

			</div>

			<?php
				}

				}

			 ?>

		</div>

	</div>	

</div>
	
	
</div>