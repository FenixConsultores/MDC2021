<div class="row">	<div class="col-4">		<div class="form-group">			<label for="">Fecha Inicial:</label>			<div class="input-group">				<input type="text" name="" class="form-control" id="date1">				<div class="input-group-append">					<span class="input-group-text"><span class="far fa-calendar-alt"></span></span>				</div>			</div>		</div>	</div>	<div class="col-4">		<div class="form-group">			<label>Fecha Final:</label>			<div class="input-group">				<input type="text" name="" class="form-control" id="date2">				<div class="input-group-append">					<span class="input-group-text"><span class="far fa-calendar-alt"></span></span>				</div>			</div>		</div>	</div>	<div class="col-4">		<div class="form-group">			<label for="cbPaymentStatus">Estatus:</label>			<select class="form-control" id="cbPaymentStatus">				<option value="P" selected="selected">Pendientes</option>				<option value="E">Pagados</option>			</select>		</div>	</div></div><hr><div class="table-responsive">	<table class="table table-hover" id="tbPagos" width="100%">		<thead>			<tr>				<th class="text-center">Fecha entrega</th>				<th class="text-center">N°. Orden</th>				<th>Cliente</th>				<th class="text-center">Subtotal</th>				<th class="text-center">Tipo Pago</th>				<th class="text-center">Accion</th>				<th class="text-center">Estatus</th>				<th>Nota</th>				<th class="text-center">Baucher</th>			</tr>		</thead>		<tbody>		</tbody>	</table></div><div class="imgBaucher" id="imgBaucher">	<span class="closeModalImg" id="closeModalImg">&times;</span>	<img src="" class="baucherContent" id="baucherContent">	<div id="captionBaucher">Baucher 8989923.jpg</div></div><!-- Modal Realizar pago --><div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg" role="document">    <div class="modal-content">      <div class="modal-header">        <h5 class="modal-title" id="exampleModalLabel">Pagos</h5>        <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">        <div class="row">        	<div class="col-12 col-sm-6">        		<div class="picture">        			<img src="" width="100%" id="baucherConfirmPayment">        		</div>        	</div>        	<div class="col-12 col-sm-6">        		<form>        			<input type="hidden" name="" id="dniUpdate">        			<div class="form-group row">        				<div class="col-6 text-center">        					<label>Pagar</label><br>	        				<label class="switch switch-text switch-pill switch-primary switch-lg">			                    <input type="checkbox" class="switch-input" id="checkPay" data-id="">			                    <span class="switch-label" data-on="On" data-off="Off"></span>			                    <span class="switch-handle"></span>			                </label>        				</div>        				<div class="col-6 text-center">        					<label>Abonar</label><br>	        				<label class="switch switch-text switch-pill switch-warning switch-lg">			                    <input type="checkbox" class="switch-input" id="checkPay121" data-id="">			                    <span class="switch-label" data-on="On" data-off="Off"></span>			                    <span class="switch-handle"></span>			                </label>        				</div>        			</div>        			<div class="form-group">        				<label>Agregar Nota</label>        				<input type="text" name="" class="form-control" placeholder="Nota ...">        			</div>        			<div class="form-group">        				<button class="btn btn-primary btn-block">Guardar Nota</button>        			</div>        		</form>        	</div>        </div>      </div>    </div>  </div></div>