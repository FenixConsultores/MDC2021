<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/main.css">
</head>
<body class="">	
	<header id="headerLogin">
		<div class="container">
			<div class="row">
				<a href="#" class="col-6" id="navLogin">
					<img src="<?= base_url();?>assets/img/various/logobrand.png">
				</a>
			</div>
		</div>
	</header>
	<div class="container">
		<input type="hidden" name="" id="route" value="<?= base_url();?>">
		<div class="conten">
			<div class="middle">
				<form class="form-signin" id="forSeguimientoCompra">
					<h2 style="padding-bottom: 10px;">Numero Orden:</h2>
					<div class="row">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<input type="text" name="numOrden" class="form-control" id="numOrden" placeholder="YR86K90JJU89IOL
">
						</div>
						<div class="col-sm-12">
							<button class="btn btn-primary btn-block">Validar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url();?>assets/js/jquery.js"></script>
	<script src="<?= base_url();?>assets/js/main/seguimiento.js"></script>
</body>
</html>