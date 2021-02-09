<div class="row">
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-info">
			<div class="card-header">Total pedidos</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-box"></i> <?= $statistic['pedidos']->pedidos?></h1>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-success">
			<div class="card-header">Pedidos Confirmados</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-clipboard-check"></i> <?= $statistic['confirmados']->confirmados?></h1>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-success">
			<div class="card-header">Pedidos Entregados</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-check-circle"></i> <?= $statistic['entregados']->entregados?></h1>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-warning">
			<div class="card-header">Pedidos en ruta</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-truck"></i> <?= $statistic['ruta']->ruta?></h1>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-danger">
			<div class="card-header">Pedidos pendientes</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-exclamation-triangle"></i>
					<?php $pendientes = $statistic['confirmados']->confirmados - ($statistic['entregados']->entregados + $statistic['ruta']->ruta);
						echo $pendientes;
					 ?>
				</h1>
			</div>
		</div>
	</div>	
	<!-- <div class="col-12">
		<hr>
	</div> -->	
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-primary">
			<div class="card-header">Entrega en Marias</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-home"></i> <?= $statistic['marias']->marias;?></h1>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div class="card bg-primary">
			<div class="card-header">Entregas en Domicilio</div>
			<div class="card-body text-center">
				<h1><i class="fas fa-map-marker-alt"></i> <?= $statistic['domicilio']->domicilio;?></h1>
			</div>
		</div>
	</div>
</div>