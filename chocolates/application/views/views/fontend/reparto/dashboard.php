<!DOCTYPE html>

<html>

<head>

	<title>Reparto Dashboard</title>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/fontawesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/reparto.css">

</head>

<body>

	<header id="headerReparto">

		<input type="hidden" name="route" id="route" value="<?= base_url();?>">

		<a href="<?= base_url();?>fontend/ruta/home" id="btnBack1"><span class="fa fa-arrow-left"></span></a>

		<a class="nav-link dropdown-toggle navSession" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          <span class="fa fa-user"></span>&nbsp;<?= $this->session->userdata('name');?>

        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdownSession">

          <a class="dropdown-item" id="logoutRepartidor" href="#"><span class="fas fa-sign-in-alt"></span>&nbsp;Logout</a>                

        </div>

		<div class="container">

			<div class="bar">

				<h3 id="nameRuta">Hola <?= $this->session->userdata('name');?> - <a href="<?= base_url();?>fontend/ruta/home/showMap">

					<?php 

					if (empty($ruta)) {

					?>

					Parece que aun no tienes rutas asignadas

					<?php

					}else{

						echo $ruta->nombre;

					}					

					 ?>

					</a>

				</h3>

			</div>

		</div>

	</header>

	<section>

		<div class="container">

			<?php echo $page; ?>

		</div>		

	</section>

	<script src="<?= base_url();?>assets/js/jquery.js"></script>

	<script src="<?= base_url();?>assets/js/popper.min.js"></script>

	<script src="<?= base_url();?>assets/js/bootstrap.js"></script>	

	<script src="<?= base_url();?>assets/js/main/authentication.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=<?= $mapApiKey ?>"></script>

	<script src="<?= base_url();?>assets/js/main/ruta.js"></script>

	<?php

	if (isset($extraJS)) {
		foreach ($extraJS as $jsFile) {
			echo '<script src="' . base_url() . $jsFile . '""></script>';

		}
	}


	if (isset($extraExternalJS)) {
		foreach ($extraExternalJS as $jsFile) {
			echo '<script src="' . $jsFile . '""></script>';
		}
	}

	?>


</body>

</html>