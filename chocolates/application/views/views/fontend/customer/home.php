<!DOCTYPE html>



<html lang="es">



<head>



	<title>Home</title>



	<meta charset="utf-8">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/fontawesome.min.css">



	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">



	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/main.css">



	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/design.css">



</head>



<body id="bodyHome">



	<a href="/admin" id="linkIngreso"><span class="fa fa-user"></span>&nbsp;Ingreso</a>



	<header id="headerHome">



		<div class="container">



			<div class="logo">



				<img src="<?= base_url();?>assets/img/various/home.png">



			</div>



		</div>



	</header>



	<section id="sectionHome">	



	<div class="container">



		<input type="hidden" name="" id="route" value="<?= base_url();?>">



		<a href="<?= base_url();?>fontend/customer/home/p1">



			<div class="pedido">



				<div class="alert alert-primary">					



					Hacer mi pedido



					<span class="fa fa-heart"></span>



				</div>				



			</div>



		</a>



		<div class="seguimiento">



			<form>



				<div class="form-group">



					<div class="input-group input-group-lg">



						<input type="" name="numOrden" class="form-control form-control-lg" id="numOrden" placeholder="Buscar mi pedido">



						<div class="input-group-append appendSearch">



							<span class="input-group-text searchInputGroup"><span class="fa fa-search"></span></span>



						</div>



					</div>



				</div>



				<div class="form-group">



					<div class="alert alert-danger alert-login" id="errorMsg">



						<span class="fas fa-times-circle hide-alert"></span>



						<span class="fas fa-times-circle" style="font-size: 30px;color: #dc3545;"></span> Ocurrió un error inesperado inténtalo de nuevo si el problema persiste contacte con <a href="tel:+"><span class="fas fa-phone"></span>mariasdechocolate</a>



					</div>



					<div class="alert alert-warning alert-login" id="warningMsg">



						<span class="fas fa-times-circle hide-alert"></span>



						<span class="fas fa-times-circle" style="font-size: 30px;color: #dc3545;"></span> Parece que no has concluido tu compra, es necesario concluirlo para poder dar seguimiento, favor de contactarse con mariasdechocolate para liberar la compra <a href="tel:+"><span class="fas fa-phone"></span>mariasdechocolate</a>



					</div>



					<div class="alert alert-warning alert-login" id="emptyMsg">



						<span class="fas fa-times-circle hide-alert"></span>



						<span class="fas fa-exclamation-triangle" style="font-size: 30px; color: #ffc107"></span>  Parece que su número de orden no está registrado, si crees que esto es un error contacte con <a href="tel:+"><span class="fas fa-phone"></span>mariasdechocolate</a>



					</div>



				</div>



			</form>			



		</div>		



	</div>



	</section>	



	<script src="<?= base_url();?>assets/js/jquery.js"></script>



	<script src="<?= base_url();?>assets/js/main/seguimiento.js"></script>



</body>



</html>