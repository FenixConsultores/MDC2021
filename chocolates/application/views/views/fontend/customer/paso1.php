<!DOCTYPE html>

<html lang="es">

<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113504248-1"></script>
	<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-113504248-1');
	</script>


	<title>Marias de Chocolate</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/js/plugins/datatimepicker/datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/js/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/customer.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/design.css">
</head>

<body>

	<?php  //$apiKey= 'AIzaSyCXQUUZ1dyYr6X3Uj6jfPTxElOq9WCvyB4'; ?> <!--API SAMUEL-->
	<?php $apiKey= 'AIzaSyDWkUDb4wZPN-JQd7gNtABDb07tB_YeByU'; ?>  <!--API Marias-->
	<?php   //$apiKey= 'AIzaSyDxQSn2FMikiWlPAsv0uL2SPjznYmYVueg'; ?>   <!--API Marias-->


	<header>
		<div id="cont-bar" style="position: relative;">
			<div class="container">
				<div class="headerMarias">
					<a href="<?= base_url(); ?>fontend/customer/home">
						<img src="<?= base_url(); ?>assets/img/various/brand.png">
					</a>
				</div>
			</div>
			<a href="<?= base_url(); ?>fontend/customer/home" <?php echo ($this->uri->segment(4) == 'p1') ? '' : 'hidden'; ?>>
				<span class="fa fa-arrow-left"></span>
			</a>
			<a href="<?= base_url(); ?>fontend/customer/home/p1" <?php echo ($this->uri->segment(4) == 'p2') ? '' : 'hidden'; ?>>
				<span class="fa fa-arrow-left"></span>
			</a>
			<a href="<?= base_url(); ?>fontend/customer/home/p1" <?php echo ($this->uri->segment(4) == 'description') ? '' : 'hidden'; ?>>
				<span class="fa fa-arrow-left"></span>
			</a>
			<a href="<?= base_url(); ?>fontend/customer/home/pago/<?= $this->uri->segment(5); ?>" <?php echo ($this->uri->segment(4) == 'bancomer' || $this->uri->segment(4) == 'oxxo') ? '' : 'hidden'; ?>>
				<span class="fa fa-arrow-left"></span>
			</a>
		</div>
	</header>

	<input type="hidden" name="urlRoute" id="urlRoute" value="<?= base_url() ?>">

	<section>
		<div class="container">
			<?php echo $page; ?>
		</div>
	</section>

	<section class="secction-notify"></section>


<!-- boton flotante de carrito -->
	<div class="col-md-6 col-12 cartContent" style="display: <?php echo ($this->cart->total_items() > 0) ? '' : 'none'; ?>">
		<div class="cartContentInner">
			<label>
				<span class="fa fa-shopping-cart"></span>
				<label id="numItemasCart"></label>
				productos <strong id="priceTotalCart"><?= '$' . $this->cart->total(); ?></strong>
			</label>
			<a class="next-step-link" href="<?= base_url(); ?>fontend/customer/home/p2" <?php echo ($this->uri->segment(4) == 'p2') ? 'hidden' : ''; ?>>
				<span class="next-step-title">Siguiente paso</span>
				<span class="fa fa-arrow-right next-step-icon"></span>
			</a>
		</div>
	</div>

																	<!-- Notificacion -->

	<div class="container-notification"></div>

	<script src="<?= base_url(); ?>assets/js/jquery.js"></script>

	<?php if ($this->uri->segment(4) == 'p2' || $this->uri->segment(4) == 'P2' || $this->uri->segment(4) == 'mapa') { ?>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKey; ?>&libraries=places"></script>
	<?php } ?>

	<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.common.pluggins.js"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.common.g-map-init.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugins/datatimepicker/datepicker.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugins/datatimepicker/datepicker.es.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-clockpicker/bootstrap-clockpicker.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/main/chocolate.js"></script>

</body>

</html>