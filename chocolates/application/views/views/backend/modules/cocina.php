<!--
    Fecha      Version 
    13-03-18   ADG0.0.2  
    Se agrega el archivo cocina para administrar la produccion de los materiales en cocina 
-->
<!--ADG0.0.1 Inicia Implementacion-->
<div>
	<a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();">
<i class="fa fa-print"></i> Imprimir</a>
<div class="table-responsive">
	<table class="table table-hover nowrap" id="tbMaterialCocina" width="100%">
		<thead>
		<tr>
			<th>Dia entregra</th>
			
			<th>Horario </th>
			
			<th>Material</th>
			
			<th>Cantidad por preparar</th>
			
			<th>Accion</th>
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
</div>

<!--Actualizar Inventario -->

<div class="modal fade" id="modalUpdateCocina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Actualizar Material</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form id="formUpdateCocina">

                <div class="modal-body">
					<h5 id="descripcion"></h5>

                    <div class="form-group row">
                        <input type="hidden" name="id_item" class="form-control" id="id_item">
						 <input type="hidden" name="diaEntrega" class="form-control" id="diaEntrega">
						<input type="hidden" name="horaEntrega" class="form-control" id="horaEntrega">
						
						 
						
						<label class="col-sm-2 col-form-label" >Cantidad Pendiente:</label>

                        <div class="col-sm-10">

                           
							
							<label class="col-sm-2 col-form-label" id="cantidad"></label>
							

                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 col-form-label">Cantidad elavorada:</label>

                        <div class="col-sm-10">

                            <input type="text" name="cantidadUpdate" class="form-control" id="cantidadUpdate" placeholder="1">

                        </div>

                    </div>
                    
                   

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Actualizar</button>

                </div>

            </form>

        </div>

    </div>

</div>
<!--ADG0.0.1 Finaliza Implementacion-->