<!DOCTYPE html>
<html>
<head>
	<title>Seguimiento</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/design.css">
</head>
<body class="bodySeguimiento">
	<?php 
		$nombre = explode(' ', $this->session->userdata('name'));		
	 ?>
	<header class="headerSeguimiento">
		<div class="container">
			<input type="hidden" name="route" id="route" value="<?= base_url();?>">
			<div class="row">
				<a href="<?= base_url()?>fontend/customer/home" class="col-5">
					<img src="<?= base_url();?>assets/img/various/logobrand.png">
				</a>
				<ul class="col-2 textSeguimiento">					
				</ul>
				<ul class="col-5">
					<div class="dropdown" id="out">
						<a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="fa fa-user"></span>&nbsp;<?= $nombre[0];?>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">							
							<a class="dropdown-item"><span class="fa fa-info-circle"></span> info</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" id="signOff"><span class="fa fa-sign-in-alt"></span> Cerrar session</a>
						</div>
					</div>
				</ul>
				<a id="btnBack" href="<?= base_url();?>fontend/customer/home/seguimientoEnvio<?= $this->uri->segment(5);?>" <?php echo($this->uri->segment(4) == 'statusEnvio')?'':'hidden';?>><span class="fa fa-arrow-left"></span></a>
			</div>
		</div>
	</header>	
	<section>
		<div class="container" id="pageContainer">
			<?php echo $page; ?>			
		</div>
	</section>
	<!-- div container loading -->
	<div class="loadingFile">
		<div class="innerLoading">
			<img src="<?= base_url();?>assets/img/various/file.gif">
			<h5>Cargando archivo...</h5>
		</div>
	</div>
	<!-- Notificacion -->
	<div class="container-notification">
		<!-- <div class="msg-dialog msg-success">
			<span class="fas fa-times msg-close"></span>
			<div class="success-icon"></div>
			<div class="msg-content">
				<div class="msg-title">Exito!</div>
				<div class="msg-body">Producto agregado al carrito</div>
			</div>
		</div> -->		
	</div>
	<script src="<?= base_url();?>assets/js/jquery.js"></script>
	<script src="<?= base_url();?>assets/js/popper.min.js"></script>
	<script src="<?= base_url();?>assets/js/bootstrap.js"></script>
	<script src="<?= base_url();?>assets/js/main/seguimiento.js"></script>
</body>
</html>