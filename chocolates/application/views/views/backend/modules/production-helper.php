<div class="row">	<div class="col-3">		<div class="form-group">			<label for="cbDeliveryType">Lugar de entrega:</label>			<select class="form-control" id="cbDeliveryType">				<option value="none" selected="selected">----------</option>				<option value="marias">Marias</option>				<option value="domicilio">Domicilio</option>			</select>		</div>	</div>	<div class="col-3">		<div class="form-group">			<label for="">Fecha de entrega:</label>			<div class="input-group">				<input type="text" class="form-control" id="dpDeliveryDate">				<div class="input-group-append">					<span class="input-group-text"><span class="far fa-calendar-alt"></span></span>				</div>			</div>		</div>	</div>	<div class="col-3">		<div class="form-group">			<label for="cbDeliveryHour">Hora de entrega:</label>			<select class="form-control" id="cbDeliveryHour">				<option value="none" selected="selected">----------</option>				<option value="06:00-09:59">06:00 - 09:59</option>				<option value="10:00-12:59">10:00 - 12:59</option>				<option value="13:00-14:59">13:00 - 14:59</option>				<option value="15:00-16:59">15:00 - 16:59</option>				<option value="17:00-20:59">17:00 - 21:00</option>			</select>		</div>	</div>	<div class="col-2 col-md-3">		<div class="form-group">			<label for="btnSearch" style="color: transparent;">-------------</label><br>			<button class="btn btn-danger" id="btnSearch">Buscar</button>		</div>	</div></div><hr><!--<div>--><!--	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalDetailProduction">Ver material de producción</button>--><!--</div>--><div class="row">	<div class="col-xs-12 col-md-8 col-lg-9">		<div class="container-fluid">			<div id="dvProductsContainer" class="row">			</div>		</div>	</div>	<div class="col-xs-12 col-sm-4 col-lg-3">		<h3>Material</h3>		<div id="dvProductsMaterialContainer">		</div>	</div></div><style type="text/css">	.production-material-item,	.production-material-item-extra {		padding: 3px 10px;		display: flex;		justify-content: space-between;		cursor: pointer;	}	.production-material-item-white{		background-color: rgba(255, 255, 255, 0.6);		border-radius: 10px;	}</style><script type="text/javascript">    var productsDescriptions = <?php echo $productDescriptions; ?>;    var strawberryTypes = ["normal", "chica", "grande", "acostada"];    var productionMaterialManager = [{"field": "no_fresas", "title": "Fresas", "showStrawberryTypes": true}, {"field": "no_fresas_cafe", "title": "Fresas cafe", "showStrawberryTypes": true}, {"field": "no_fresas_blanca", "title": "Fresas blancas", "showStrawberryTypes": true}, {"field": "no_rosas", "title": "Rosas"}, {"field": "espirales", "title": "Espirales"}, {"field": "puntos", "title": "Puntos"}, {"field": "rayas", "title": "Rayas"}, {"field": "figuras", "title": "Figuras"}, {"field": "lisa","title": "Lisa"}, {"field": "s_chocolate", "title": "S. Chocolate"}, {"field": "desnuda_rayada", "title": "Desnuda rayada"}, {"field": "rosa_de_chocolate", "title": "Rosa chocolate"}, {"field": "palo_chico", "title": "Palo chico"}, {"field": "palo_grande", "title": "Palo grande"}];    productionMaterialManager.forEach((x) => {        x["counter"] = 0;        var counters = {};        strawberryTypes.forEach((st) => {            counters[st] = 0;        });        x["counters"] = counters;    });</script>