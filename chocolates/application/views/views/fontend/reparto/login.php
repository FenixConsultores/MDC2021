<!DOCTYPE html>
<html>
<head>
	<title>Reparto Login</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/reparto.css">
</head>
<body id="loginRuta">
	<div class="container">
		<section id="sectionLogin">
			<div class="login">
				<input type="hidden" name="route" id="route" value="<?= base_url();?>">
				<div id="imgLogin">
					<img src="<?= base_url();?>assets/img/various/brand.png">
				</div>				
				<form class="row" id="formLoginRuta">
					<div class="form-group col-10">
						<div class="input-group">
							<input type="text" name="userRuta" class="form-control form-control-lg" id="userRuta" placeholder="Usuario">
						</div>
					</div>
					<div class="form-group col-10">						
						<div class="input-group input-group-lg">
							<input type="password" name="passRuta" class="form-control form-control-lg" id="passRuta" placeholder="Contraseña">
							<div class="input-group-append">
								<span class="input-group-text" id="btnLoginRuta"><i class="fa fa-arrow-right"></i></span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
	<script src="<?= base_url();?>assets/js/jquery.js"></script>
	<script src="<?= base_url();?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?= base_url();?>assets/js/main/authentication.js"></script>
</body>
</html>