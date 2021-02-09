<div class="table-responsive">


	<table class="table" id="tbExpira" width="100%">

		<thead>

			<tr>

				<th>No. Orden</th>

				<th>Cliente</th>

				<th>Telefono</th>

				<th>Modelos</th>

				<th>Fecha Captura</th>

				<th>Cantidad Pedidos</th>

				<th>Almacen</th>
				
				<th>Precio</th>

				<th>Accion</th>

			</tr>

		</thead>

	</table>

</div>

<!--Cancela pedido-->


<div class="modal fade" id="confirmUpdateExpirar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-body">



      	<input type="hidden" name="inCancel" id="inCancel">



        <p>Esta seguro de eliminar este pedido incompleto de <strong id="nameClientUpdate"></strong></p>



      </div>



      <div class="modal-footer footerConfirmDrop">



      	<div class="col-6">



      		<button type="button" class="btn btn-success btn-lg btn-block" data-dismiss="modal"><i class="fas fa-ban"></i> No</button>



      	</div>



      	<div class="col-6">



      		<button type="button" class="btn btn-danger btn-lg btn-block" id="btnCancelPedido"><i class="fas fa-trash-alt"></i> Si</button>



      	</div>                



      </div>



    </div>



  </div>



</div>