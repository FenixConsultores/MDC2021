<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v6.0&appId=1456921667889737&autoLogAppEvents=1"></script>



<div class="row lista-products" id="row-personalizado">

	<?php		

		foreach ($products as $item) {

		$picture = explode(',',$item['imagenes']);		

	?>

		<div class="col-lg-4 col-sm-6 col-12">

			<div class="groupProduct row">
				<div class="col-12" style="box-shadow: 0 6px 10px 0 rgba(0,0,0,0.4); margin:0px; padding: 0px;">
					<a href="<?= base_url();?>fontend/customer/home/description/<?=$item['id_producto'];?>">

						<img src="<?= base_url();?>assets/img/modelos/<?= $picture[0];?>">

						
						
					</a>

				</div>
				
				<div class="col-12 contentProduct" style="margin-top: 15px;">

					<h4><?= $item['nombre'];?> <br>
					
					
						<?php 

							if ($item['almacen'] > 0) {

						?>

							<span class="badge badge-success" style="padding: 5px; font-size:10px;">DISPONIBLE</span>

						<?php

							}else{

						 ?>

						 	<span class="badge badge-warning" style="padding: 5px; font-size:10px;">AGOTADO</span>

						 <?php 

						 	}

						  ?>
					
					</h4>

					<p><?= $item['modelo'];?></p>

					<div>

<a href="<?= base_url();?>fontend/customer/home/description/<?=$item['id_producto'];?>" style="text-decoration: none;">
						<h5  class="priceProduct">  <i class="fas fa-cart-plus"></i>  <b> $ <?= $this->cart->format_number($item['precio']);?> </b></h5>
						
	
						</a>
					</div>
					<div>
					<div class="fb-share-button" data-href="<?= base_url();?>fontend/customer/home/description/<?=$item['id_producto'];?>" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url();?>fontend/customer/home/description/<?=$item['id_producto'];?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a></div>
					</div>

				</div>

			</div>		

		</div>

	<?php

		}

	 ?>	

</div>

