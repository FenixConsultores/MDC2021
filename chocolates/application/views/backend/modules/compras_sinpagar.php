<div class="card-body">
<!--    <ul class="nav nav-tabs" id="myTab1" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="compras_sinentregar" role="tab" aria-controls="home" aria-selected="true">Pagado sin entregar</a>
        </li>
		<li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="compras_ruta" role="tab" aria-controls="home" aria-selected="true">En ruta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="compras" role="tab" aria-controls="profile" aria-selected="false">Pagados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="page-tab" data-toggle="tab" href="compras_sinpagar" role="tab" aria-controls="page" aria-selected="false">Sin pagar</a>
        </li>
    </ul>-->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="compras_sinentregar">Pagado sin entregar</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="compras_ruta">En ruta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="compras">Pagados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="compras_sinpagar">Sin pagar</a>
  </li>
</ul>
    <div class="tab-content" id="myTab1Content">
        <?php
						$hoy = date("Y-m-d"); 
						?>
            
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Fecha Inicial:</label>
                        <div class="input-group">
                            <input type="text" name="" class="form-control" id="minDate1SinPagar" value="<?= $hoy;?>">
                            <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Fecha Final:</label>
                        <div class="input-group">
                            <input type="text" name="" class="form-control" id="minDate2SinPagar" value="<?= $hoy;?>">
                            <div class="input-group-append"> <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover nowrap" id="tbListComprasSinPagar" width="74%">
                    <thead>
                        <tr>
                            <th width="6%">F-Entrega </th>
                            <th width="8%">H-Entrega</th>
                            <th width="8%">N°. Orden</th>
                            <th width="4%">Cliente</th>
                            <th width="4%">Chofer</th>
                            <th width="8%">Tip. Entrega</th>
                            <th width="6%">Pagado</th>
                            <th width="6%">Váucher</th>
                            <th width="6%">Estatus</th>
                            <th width="5%">Tel</th>
                            <th width="6%">Cant.</th>
                            <th width="4%">Modelo</th>
                            <th width="3%">Nota</th>
                            <th width="5%">Direcc.</th>
                            <th width="7%">Car. Domic</th>
                            <th width="6%">Preparado</th>
                            <th width="18%">Acción</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Modal Edit data client -->
            <div class="modal fade" id="modalEditDataClientSinPagar" tabindex="-1" role="dialog" aria-labelledby="EditDataClient" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <form id="formUpdateClientSinPagar">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-3">Modelo:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="selectModel" id="selectModelSinPagar"> </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">N° Orden:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inputOrder" class="form-control" id="inputOrderSinPagar" readonly> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Nombre:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inputName" class="form-control" id="inputNameSinPagar"> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Telefono:</label>
                                    <div class="col-sm-9">
                                        <input type="phone" name="inputPhone" class="form-control" id="inputPhoneSinPagar"> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Día enrtega:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inputDayEntrega" class="form-control inputDayEntrega" id="inputDayEntregaSinPagar"> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Hora Entrega:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="inputHourEntrega" class="form-control" id="inputHourEntregaSinPagar"> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Nota:</label>
                                    <div class="col-sm-9">
                                        <textarea name="areaNota" class="form-control" id="areaNotaSinPagar" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btnUpdateDataClient">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal delete data client -->
            <div class="modal fade" id="modalConfirmDropSinPagar" tabindex="-1" role="dialog" aria-labelledby="ConfirmDeleteClient" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <p>Esta usted seguro de eliminar los datos del cliente con nombre: <strong id="nameClientDeleteSinPagar">test</strong></p>
                        </div>
                        <div class="modal-footer footerConfirmDrop">
                            <input type="hidden" name="numOrden" id="numOrden">
                            <div class="col-6">
                                <button type="button" class="btn btn-warning btn-lg btn-block" data-dismiss="modal">cancelar</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger btn-lg btn-block" id="btnDeleteClientSinPagar">borrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal duplicar pedido con otro numero de orden-->
            <div class="modal fade" id="modalConfirmDupicaSinPagar" tabindex="-1" role="dialog" aria-labelledby="ConfirmDuplic" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Datos del No. Orden</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <form id="formDuplicaSinPagar">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-sm-3">N° Orden:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="numeroOrdenDuplicaSinPagar" class="form-control" id="numeroOrdenDuplicaSinPagar" readonly> </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3">Día enrtega:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="diaEntregaDuplicaSinPagar" class="form-control inputDayEntrega" id="diaEntregaDuplicaSinPagar"> </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3">Hora Entrega:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="horaEntregaDuplicaSinPagar" class="form-control" id="horaEntregaDuplicaSinPagar"> </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btnDuplicaData">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="imgBaucher" id="imgBaucherSinPagar"> <span class="closeModalImg" id="closeModalImgSinPagar">&times;</span> <img src="" class="baucherContent" id="baucherContentSinPagar">
                <div id="captionBaucherSinPagar">Baucher 8989923.jpg</div>
            </div>
            <!-- Modal Realizar pago -->
            <div class="modal fade" id="modalPaymentSinPagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pagos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="picture"> <img src="" width="100%" id="baucherConfirmPaymentSinPagar"> </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <form>
                                        <input type="hidden" name="" id="dniUpdateSinPagar">
                                        <div class="form-group">
                                            <div id="modalPaymentInfoSinPagar"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label style="display: inline-block; margin-right: 15px;">Pagar</label>
                                            <label class="switch switch-text switch-pill switch-primary switch-lg">
                                                <input type="checkbox" class="switch-input" id="checkPaySinPagar" data-id=""> <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> </label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
       

    
    <hr>
</div>