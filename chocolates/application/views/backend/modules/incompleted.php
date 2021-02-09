<div class="table-responsive">
	<table class="table" id="tbPayIncompleted" width="100%">
		<thead>
			<tr>
				<th>No. Orden</th>
				<th>Cliente</th>
				<th>Telefono</th>
				<th>Modelos</th>
				<th>Fecha Entrega</th>
				<th>Subtotal</th>
				<th>Captura</th>
				<th>Accion</th>
			</tr>
		</thead>
	</table>
</div>
<!-- Modal confirm delete -->

<div class="modal fade" id="confirmDropBuyIncompleted" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="dniDropBuyIncompleted" id="dniDropBuyIncompleted">
        <p>Esta seguro de eliminar este pedido incompleto de <strong id="nameIncompletedClientDrop"></strong></p>
      </div>
      <div class="modal-footer footerConfirmDrop">
      	<div class="col-6">
      		<button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal"><i class="fas fa-ban"></i> No</button>
      	</div>
      	<div class="col-6">
      		<button type="button" class="btn btn-danger btn-lg btn-block" id="btnDropBuyIncompleted"><i class="fas fa-trash-alt"></i> Si</button>
      	</div>                
      </div>
    </div>
  </div>
</div>