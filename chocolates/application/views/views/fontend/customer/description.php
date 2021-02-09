


<input type="hidden" name="idProduct" id="idProduct" value="<?= $this->uri->segment(5);?>">

<div class="row">	

	<div class="col-md-8 col-xs-12 descriptionImg">

		<div>			

			<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

			  <div class="carousel-inner">

			  	<?php $pictures = explode(',',$information->imagenes); ?>

			    <div class="carousel-item active">

			      <img class="d-block w-100" src="<?= base_url();?>assets/img/modelos/<?= $pictures[0];?>" alt="First slide">

			    </div>
				  
  <meta property="og:url"           content="<?= base_url();?>fontend/customer/home/description/<?= $this->uri->segment(5);?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Marías de Chocolate | <?= $information->nombre;?>" />
  <meta property="og:description"   content="<?= $information->nombre;?> | <?= $information->modelo;?>" />
  <meta property="og:image"         content="<?= base_url();?>assets/img/modelos/<?= $pictures[0];?>" />
				  

			    <?php 					

					for ($i=1; $i < count($pictures) ; $i++) {																

				 ?>	

				<div class="carousel-item">

			      <img class="d-block w-100" src="<?= base_url();?>assets/img/modelos/<?= $pictures[$i];?>" alt="First slide">

			    </div>			    

				 <?php 

					}

				  ?>

			  </div>

			  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>

			    <span class="sr-only">Previous</span>

			  </a>

			  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

			    <span class="carousel-control-next-icon" aria-hidden="true"></span>

			    <span class="sr-only">Next</span>

			  </a>

			</div>

		</div>		

		<div class="descriptionProduct">

			<h1><?= $information->modelo;?></h1>

			<h5><?= $information->nombre;?></h5>

			<h4>$<?= $information->precio;?></h4>

			<h5>
				En existencia:

				<?php if ($information->almacen > 0) { ?>
					<span class="badge badge-success">Disponible</span>
				<?php } else { ?>
					<span class="badge badge-warning">Agotado</span>
				<?php } ?>

				<span class="badge badge-secondary"></span>
			</h5>

			<div class="buttonCart">

				<div class="btn-group" role="group" aria-label="Basic example">

				  <button type="button" class="btn btn-secondary" id="delete-itemcart"><span class="fa fa-minus"></span></button>

				  <h3 style="display: inline;" id="numItemCart">&nbsp;&nbsp;</h3>

				  <button type="button" class="btn btn-secondary" id="add-cart" <?php echo($information->almacen <= 0)?'disabled':'';?> data-id="<?= $information->id_producto;?>"><span class="fa fa-plus"></span></button>

				</div>

			</div>

			<div class="productActionButtonsCart">

				<a class="next-step-link" href="<?= base_url(); ?>fontend/customer/home/p1">
					<span class="fa fa-arrow-left next-step-icon"></span>
					<span class="next-step-title">Seguir comprando</span>
				</a>
				<a class="next-step-link" href="<?= base_url(); ?>fontend/customer/home/p2">
					<span class="next-step-title">Siguiente paso</span>
					<span class="fa fa-arrow-right next-step-icon"></span>
				</a>

			</div>

		</div>		

	</div>

</div>