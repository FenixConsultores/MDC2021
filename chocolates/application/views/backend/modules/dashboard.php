<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard Marias</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css">
	<link href="<?= base_url(); ?>assets/css/fontawesome-all.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/css/style.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/js/plugins/datatimepicker/datepicker.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/admin.css">
	<!--ADG0.0.1 Inicia Cambio-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--<script type="text/javascript">
        $(document).ready(function(){
            var maxField = 50; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div><label>Articulo:</label><input type="text" articulo="articulos[]" value=""/><label>Cantidad:</label><input type="number" name="cantidades[]" value=""/><button href="javascript:void(0);" type="submit" class="remove_button" name="menos">-</button></div>';  
            var x = 1; 
            $(addButton).click(function(){
                if(x < maxField){ 
                    x++; 
                    $(wrapper).append(fieldHTML);
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); 
                x--; 
            });
        });
        </script>-->
	<style>
		div.hidden {
		  visibility: hidden;
		}
	</style>
<!--ADG0.0.1 Finaliza Cambio-->
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

<header class="app-header navbar">

	<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>
	<a class="navbar-brand" href="#"></a>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">☰</button>
	<input type="hidden" name="route" id="route" value="<?= base_url(); ?>">

	<ul class="nav navbar-nav d-md-down-none">
		<li class="nav-item px-3">
			<a class="nav-link" href="#">Dashboard</a>
		</li>
		<li class="nav-item px-3">
			<a class="nav-link" href="#">Users</a>
		</li>
		<li class="nav-item px-3">
			<a class="nav-link" href="#">Settings</a>
		</li>
	</ul>

	<ul class="nav navbar-nav ml-auto">

		<li class="nav-item d-md-down-none">
			<a class="nav-link" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-pill badge-danger">5</span>
			</a>
		</li>
		<li class="nav-item d-md-down-none">
			<a class="nav-link" href="#">
				<i class="fas fa-map-marker-alt"></i>
			</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img src="<?= base_url(); ?>assets/img/various/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
				<span class="d-md-down-none">admin</span>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-header text-center">
					<strong>Cuenta</strong>
				</div>
				<a class="dropdown-item" href="#">
					<i class="fa fa-envelope-o"></i>
					Mensajes
					<span class="badge badge-success">42</span>
				</a>
				<div class="dropdown-header text-center">
					<strong>Configuracion</strong>
				</div>
				<a class="dropdown-item" href="#">
					<i class="fa fa-user"></i>
					Profile
				</a>
				<a class="dropdown-item" href="#">
					<i class="fa fa-wrench"></i>
					Settings
				</a>
				<a class="dropdown-item" href="#">
					<i class="fa fa-usd"></i>
					Payments
					<span class="badge badge-secondary">42</span>
				</a>
				<a class="dropdown-item" href="#">
					<i class="fa fa-file"></i>
					Projects
					<span class="badge badge-primary">42</span>
				</a>
				<div class="divider"></div>
				<a class="dropdown-item" href="#">
					<i class="fa fa-shield"></i>
					Lock Account
				</a>
				<a class="dropdown-item" id="linkSingOut" href="#">
					<i class="fa fa-lock"></i>
					Cerrar Sesion
				</a>
			</div>
		</li>
	</ul>

	<button class="navbar-toggler aside-menu-toggler" type="button">☰</button>

</header>


<div class="app-body">
	<div class="sidebar">
		<nav class="sidebar-nav">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>backend/admin">
						<i class="fas fa-tachometer-alt"></i>
						Dashboard
					</a>
				</li>
				<li class="nav-title">
					ACCIONES
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#">
						<i class="fa fa-boxes"></i>
						Productos
					</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>backend/admin/productos">
								<i class="fas fa-box"></i>
								Agregar Productos
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>backend/admin/users">
						<i class="fas fa-user"></i>
						Usuarios
					</a>
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#">
						<i class="fas fa-puzzle-piece"></i>
						Compras
					</a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>backend/admin/compras">
								<i class="fa fa-shopping-cart"></i>
								Pedidos
							</a>
						</li>
						<!--<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>backend/admin/pedidos_sinentregar">
								<i class="fa fa-shopping-cart"></i>
								Pedidos sin Entregar
							</a>
						</li>-->
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>backend/admin/pagos">
								<i class="fa fa-money-bill-alt"></i>
								Pagos
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<i class="icon-puzzle"></i>
								Abonos
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>backend/admin/incompleto">
								<i class="fas fa-cart-arrow-down"></i>
								Pedidos incompletos
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#">
						<i class="fas fa-truck"></i>
						Entregas</span></a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/addRoute">
								<i class="fas fa-road"></i>
								Asignar Ruta
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/deliver">
								<i class="fas fa-user-plus"></i>
								Asignar Entrega
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/deliverytimes">
								<i class="fas fa-clock"></i>
								Horarios de entrega
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<i class="fas fa-map"></i>
								Ver mapa
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#">
						<i class="fas fa-truck"></i>
						Ventas</span></a>
					<ul class="nav-dropdown-items">
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/top"><!--charts.html-->
								<i class="fas fa-road"></i>
								Ventas
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/top">
								<i class="fas fa-user-plus"></i>
								Top ventas
							</a>
						</li>
					</ul>
				</li>
				<li class="divider"></li>
				<li class="nav-title">
					COCINA
				</li>
				<li class="nav-item nav-dropdown">
					<a class="nav-link nav-dropdown-toggle" href="#">
						<i class="fab fa-html5"></i>
						Cocina
					</a>
					<ul class="nav-dropdown-items">

						<li class="nav-item">
							<a class="nav-link" href="<?= base_url(); ?>/backend/admin/productionhelper">
								<i class="fas fa-clock"></i>
								Producción
							</a>
						</li>

						<!--						<li class="nav-item">-->
						<!--							<a class="nav-link" href="pages-login.html" target="_top">-->
						<!--								<i class="icon-star"></i>-->
						<!--								Login-->
						<!--							</a>-->
						<!--						</li>-->
						<!--						<li class="nav-item">-->
						<!--							<a class="nav-link" href="pages-register.html" target="_top">-->
						<!--								<i class="icon-star"></i>-->
						<!--								Register-->
						<!--							</a>-->
						<!--						</li>-->
						<!--						<li class="nav-item">-->
						<!--							<a class="nav-link" href="pages-404.html" target="_top">-->
						<!--								<i class="icon-star"></i>-->
						<!--								Error 404-->
						<!--							</a>-->
						<!--						</li>-->
						<!--						<li class="nav-item">-->
						<!--							<a class="nav-link" href="pages-500.html" target="_top">-->
						<!--								<i class="icon-star"></i>-->
						<!--								Error 500-->
						<!--							</a>-->
						<!--						</li>-->
					</ul>
				</li>
			</ul>
		</nav>
		<button class="sidebar-minimizer brand-minimizer" type="button"></button>
	</div>

	<!-- Main content -->

	<main class="main">
		<!-- Breadcrumb -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">Home</li>
			<li class="breadcrumb-item">
				<a href="#">Admin</a>
			</li>
			<li class="breadcrumb-item active">Dashboard</li>

			<!-- Breadcrumb Menu-->
			<li class="breadcrumb-menu d-md-down-none">
				<div class="btn-group" role="group" aria-label="Button group">
					<a class="btn" href="#">
						<i class="icon-speech"></i>
					</a>
					<a class="btn" href="./">
						<i class="icon-graph"></i>
						&nbsp;Dashboard
					</a>
					<a class="btn" href="#">
						<i class="icon-settings"></i>
						&nbsp;Settings
					</a>
				</div>
			</li>
		</ol>

		<div class="container-fluid">
			<?= $page; ?>
		</div>
		<!-- /.conainer-fluid -->
	</main>


	<aside class="aside-menu">
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
					<i class="icon-list"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#messages" role="tab">
					<i class="icon-speech"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#settings" role="tab">
					<i class="icon-settings"></i>
				</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">

			<div class="tab-pane active" id="timeline" role="tabpanel">

				<div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">

					<small><b>Today</b></small>

				</div>

				<hr class="transparent mx-3 my-0">

				<div class="callout m-0 py-2 text-muted text-center bg-light text-uppercase">

					<small><b>Tomorrow</b></small>

				</div>


			</div>

		</div>

		<div class="tab-pane p-3" id="messages" role="tabpanel">

			<div class="message">

				<div class="py-3 pb-5 mr-3 float-left">

					<!-- <div class="avatar">

					  <img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">

					  <span class="avatar-status badge-success"></span>

					</div> -->

				</div>

				<div>

					<small class="text-muted">Lukasz Holeczek</small>

					<small class="text-muted float-right mt-1">1:52 PM</small>

				</div>

				<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>

				<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>

			</div>

			<hr>

			<div class="message">

				<div class="py-3 pb-5 mr-3 float-left">

					<div class="avatar">

						<img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">

						<span class="avatar-status badge-success"></span>

					</div>

				</div>

				<div>

					<small class="text-muted">Lukasz Holeczek</small>

					<small class="text-muted float-right mt-1">1:52 PM</small>

				</div>

				<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>

				<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>

			</div>

			<hr>

			<div class="message">

				<div class="py-3 pb-5 mr-3 float-left">

					<div class="avatar">

						<img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">

						<span class="avatar-status badge-success"></span>

					</div>

				</div>

				<div>

					<small class="text-muted">Lukasz Holeczek</small>

					<small class="text-muted float-right mt-1">1:52 PM</small>

				</div>

				<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>

				<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>

			</div>

			<hr>

			<div class="message">

				<div class="py-3 pb-5 mr-3 float-left">

					<div class="avatar">

						<img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">

						<span class="avatar-status badge-success"></span>

					</div>

				</div>

				<div>

					<small class="text-muted">Lukasz Holeczek</small>

					<small class="text-muted float-right mt-1">1:52 PM</small>

				</div>

				<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>

				<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>

			</div>

			<hr>

			<div class="message">

				<div class="py-3 pb-5 mr-3 float-left">

					<div class="avatar">

						<img src="img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">

						<span class="avatar-status badge-success"></span>

					</div>

				</div>

				<div>

					<small class="text-muted">Lukasz Holeczek</small>

					<small class="text-muted float-right mt-1">1:52 PM</small>

				</div>

				<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>

				<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>

			</div>

		</div>

		<div class="tab-pane p-3" id="settings" role="tabpanel">

			<h6>Settings</h6>


			<div class="aside-options">

				<div class="clearfix mt-4">

					<small><b>Option 1</b></small>

					<label class="switch switch-text switch-pill switch-success switch-sm float-right">

						<input type="checkbox" class="switch-input" checked="">

						<span class="switch-label" data-on="On" data-off="Off"></span>

						<span class="switch-handle"></span>

					</label>

				</div>

				<div>

					<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>

				</div>

			</div>


			<div class="aside-options">

				<div class="clearfix mt-3">

					<small><b>Option 2</b></small>

					<label class="switch switch-text switch-pill switch-success switch-sm float-right">

						<input type="checkbox" class="switch-input">

						<span class="switch-label" data-on="On" data-off="Off"></span>

						<span class="switch-handle"></span>

					</label>

				</div>

				<div>

					<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>

				</div>

			</div>


			<div class="aside-options">

				<div class="clearfix mt-3">

					<small><b>Option 3</b></small>

					<label class="switch switch-text switch-pill switch-success switch-sm float-right">

						<input type="checkbox" class="switch-input">

						<span class="switch-label" data-on="On" data-off="Off"></span>

						<span class="switch-handle"></span>

					</label>

				</div>

			</div>


			<div class="aside-options">

				<div class="clearfix mt-3">

					<small><b>Option 4</b></small>

					<label class="switch switch-text switch-pill switch-success switch-sm float-right">

						<input type="checkbox" class="switch-input" checked="">

						<span class="switch-label" data-on="On" data-off="Off"></span>

						<span class="switch-handle"></span>

					</label>

				</div>

			</div>


			<hr>

			<h6>System Utilization</h6>

			<div class="text-uppercase mb-1 mt-4">
				<small><b>CPU Usage</b></small>
			</div>

			<div class="progress progress-xs">
				<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
			</div>

			<small class="text-muted">348 Processes. 1/4 Cores.</small>

			<div class="text-uppercase mb-1 mt-2">
				<small><b>Memory Usage</b></small>
			</div>

			<div class="progress progress-xs">
				<div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<small class="text-muted">11444GB/16384MB</small>

			<div class="text-uppercase mb-1 mt-2">
				<small><b>SSD 1 Usage</b></small>
			</div>

			<div class="progress progress-xs">
				<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<small class="text-muted">243GB/256GB</small>

			<div class="text-uppercase mb-1 mt-2">
				<small><b>SSD 2 Usage</b></small>
			</div>

			<div class="progress progress-xs">
				<div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<small class="text-muted">25GB/256GB</small>

		</div>
	</aside>


</div>

<div class="proccesing" id="proccesing"></div>

<footer class="app-footer">
	<span><a href="http://coreui.io">CoreUI</a> © 2017 creativeLabs.</span>
	<span class="ml-auto">Powered by <a href="http://coreui.io">CoreUI</a></span>
</footer>


<!-- Bootstrap and necessary plugins -->

<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datatimepicker/datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datatimepicker/datepicker.es.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url(); ?>assets/js/app.js"></script>
<script src="<?= base_url(); ?>assets/js/main/animate.js"></script>
<script src="<?= base_url(); ?>assets/js/main/admin.js"></script>
<!-- <script src="js/views/main.js"></script> -->

</body>

</html>