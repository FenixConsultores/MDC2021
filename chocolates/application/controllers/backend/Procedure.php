<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
        Fecha      Version 
        04-02-18   ADG0.0.1  
        Se agrega funcion getUnidadMedida para listar las unidades de medida
        Se agrega funcion addUnidadMedida para listar las unidades de medida
        Se agrega funcion updateUnidadMedida para actualizar las unidades de medida
        
        Se agrega funcion getInventario para listar los productos en inventario
        Se agrega funcion addInventario para listar los productos en inventario
        Se agrega funcion updateInventario para actualizar los productos en inventario
         
        Se agrega funcion getIncidencia para listar las incidencias en los productos de almacen.
        Se agrega funcion addIncidencia para listar las incidencias en los productos de almacen.
        Se agrega funcion updateIncidencias para actualizar las incidencias en los productos de almacen.
        
*/




class Procedure extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		$this->load->Model('backend/M_admin');

		$this->load->Model('backend/M_production_helper');

		$this->load->Model('fontend/M_producto');

	}

	// listar tabla

	public function listaCompras()
	{

		$response['data'] = $this->M_admin->obtenerCompras();

		echo json_encode($response);

	}

	
	public function listaComprasSinEntregar()
	{

		$response['data'] = $this->M_admin->obtenerComprasSinEntregar();

		echo json_encode($response);

	}
	
	public function listaComprasRuta()
	{

		$response['data'] = $this->M_admin->obtenerComprasRuta();

		echo json_encode($response);

	}
	
	public function listaComprasSinPagar()
	{
		/*$data = array(

			'fechamin' => $this->input->post('minDate1SinPagar'),
			
			'fechamax' => $this->input->post('minDate2SinPagar'),

		);*/
		

		$response['data'] = $this->M_admin->obtenerComprasSinPagar();

		echo json_encode($response);

	}

	// Actualizar datos del cliente

	public function updateDataClient()
	{

		$data = array(

			'modelo' => $this->input->post('selectModel'),

			'orden' => $this->input->post('inputOrder'),

			'nombre' => $this->input->post('inputName'),

			'phone' => $this->input->post('inputPhone'),

			'nota' => $this->input->post('areaNota'),

			'deliverDay' => $this->input->post('inputDayEntrega'),

			'deliverHour' => $this->input->post('inputHourEntrega')

		);

		$response = $this->M_admin->updateDataClient($data);

		if ($response == true) {

			$msg = 'success';

		} else {

			$msg = 'error';

		}

		echo json_encode($msg);

	}
	
	
	public function duplicaNoOrden()
	{

		$data = array(

			'orden' => $this->input->post('numeroOrdenDuplica'),

			'diaEntrega' => $this->input->post('diaEntregaDuplica'),

			'horaEntrega' => $this->input->post('horaEntregaDuplica')

		);

		$response = $this->M_admin->duplicaOrden($data);
		
		

		

		echo json_encode($response);

	}

	
	public function duplicaNoOrdenSinEntregar()
	{

		$data = array(

			'orden' => $this->input->post('numeroOrdenDuplicaSinEntregar'),

			'diaEntrega' => $this->input->post('diaEntregaDuplicaSinEntregar'),

			'horaEntrega' => $this->input->post('horaEntregaDuplicaSinEntregar')

		);

		$response = $this->M_admin->duplicaOrden($data);
		
		

		

		echo json_encode($response);

	}
	
	public function duplicaNoOrdenSinPagar()
	{

		$data = array(

			'orden' => $this->input->post('numeroOrdenDuplicaSinPagar'),

			'diaEntrega' => $this->input->post('diaEntregaDuplicaSinPagar'),

			'horaEntrega' => $this->input->post('horaEntregaDuplicaSinPagar')

		);

		$response = $this->M_admin->duplicaOrden($data);
		
		

		

		echo json_encode($response);

	}

	
	public function getBuySpecific()
	{

		$data = array(

			'orden' => $this->input->post('orden'),

			'model' => $this->input->post('model')

		);

		$response = $this->M_admin->getBuySpecific($data);

		header('Content-Type:Application/json');

		echo json_encode($response);

	}

	public function deleteItemBuy()
	{

		$orden = $this->input->post('numOrden');

		$action = $this->M_admin->M_deleteItemBuy($orden);

		if ($action == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

//	***********************************	Methos Pay 	************************************************************

	// agregar producto nuevo

	public function insertProduct()
	{
		//$materiales = localStorage.getItem("materiales");
		//echo json_encode($materiales);

		$config = array(

			'upload_path' => './assets/img/modelos/',

			'allowed_types' => 'jpg|jpeg|png'

		);

		$data = array(

			'name' => $this->input->post('nameProduct'),

			'model' => $this->input->post('modelProduct'),

			'price' => $this->input->post('priceProduct'),


			'description' => $this->input->post('descriptionProduct'),

			'public' => $this->input->post('publicateProduct'),

			'almacen' => $this->input->post('almacenProduct')

		);

		$files = count($_FILES['imageModel']['name']);

		$contentFile = $_FILES;

		for ($i = 0; $i < $files; $i++) {

			$_FILES['imageModel']['name'] = $contentFile['imageModel']['name'][$i];

			$_FILES['imageModel']['type'] = $contentFile['imageModel']['type'][$i];

			$_FILES['imageModel']['tmp_name'] = $contentFile['imageModel']['tmp_name'][$i];

			$_FILES['imageModel']['error'] = $contentFile['imageModel']['error'][$i];

			$_FILES['imageModel']['size'] = $contentFile['imageModel']['size'][$i];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('imageModel')) {

				$data['imagen'] [$i] = $this->upload->data('file_name');

			} else {

				$data['imagen'] [$i] = 'nopreview.jpg';

			}

		}

		$response = $this->M_admin->insertProducts($data);

		header('Content-Type:Application/json');

		echo json_encode($response);

	}

	// Update item products

	public function updateItemProduct()
	{

		$data = array(

			'dni' => $this->input->post('dniUpdate'),

			'name' => $this->input->post('nameProductUpdate'),

			'model' => $this->input->post('modelProductUpdate'),

			'price' => $this->input->post('priceProductUpdate'),

			'description' => $this->input->post('descriptionProductUpdate'),

			'public' => $this->input->post('publicateProductUpdate'),

			'almacen' => $this->input->post('almacenProductUpdate'),

		);

		$response = $this->M_admin->updateProducts($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

	// add new picture product

	public function addNewPicture()
	{

		$dni = $this->input->post('dni');

		$config = array(

			'upload_path' => './assets/img/modelos/',

			'allowed_types' => 'jpg|jpeg|png'

		);

		$files = count($_FILES['picture']['name']);

		$contentFile = $_FILES;

		for ($i = 0; $i < $files; $i++) {

			$_FILES['picture']['name'] = $contentFile['picture']['name'][$i];

			$_FILES['picture']['type'] = $contentFile['picture']['type'][$i];

			$_FILES['picture']['tmp_name'] = $contentFile['picture']['tmp_name'][$i];

			$_FILES['picture']['error'] = $contentFile['picture']['error'][$i];

			$_FILES['picture']['size'] = $contentFile['picture']['size'][$i];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('picture')) {

				$picture['imagen'][$i] = $this->upload->data('file_name');

			} else {

				$picture['error'][$i] = $this->upload->display_errors();

			}

		}

		header('Content-Type:Application/json');

		$insert = $this->M_admin->m_addNewPicture($dni, $picture);

		echo json_encode($insert);

	}

	// drop product

	public function dropPictureProduct()
	{

		$data = array(

			'dni' => htmlspecialchars(addslashes($this->input->post('dni'))),

			'picture' => htmlspecialchars(addslashes($this->input->post('picture')))

		);

		$delete = unlink('./assets/img/modelos/' . $data['picture']);

		if ($delete == true) {

			$response = $this->M_admin->dropPictureProduct($data['dni']);

			if ($response == true) {

				$msg = array('status' => 'success');

			} else {

				$msg = array('status' => 'error');

			}

		} else {

			$msg = array('status' => 'errorDropPicture');

		}

		header('Content-Type:Application/json');

		echo json_encode($msg);

	}

	public function dropItemProduct()
	{

		$img = explode(',', $this->input->post('img'));

		$dni = $this->input->post('dni');

		$response = $this->M_admin->dropProduct($dni);

		if ($response == true) {

			if ($img[0] != 'nopreview.jpg') {

				for ($i = 0; $i < count($img); $i++) {

					$status[$i] = unlink('./assets/img/modelos/' . $img[$i]);

				}

			} else {

				$status = true;

			}

			$msg = array(

				'status' => 'success',

				'deleteImg' => true

			);

		} else {

			$msg = array(

				'status' => 'error',

				'deleteImg' => false

			);

		}

		echo json_encode($msg);

	}

// ###################### Acciones de pagos ################################

	public function listaPagos()
	{

		$response['data'] = $this->M_admin->obtenerPagos();

		echo json_encode($response);

	}


	public function updatePayClient()
	{

		$data = array(

			'status' => $this->input->post('status'),

			'noOrden' => $this->input->post('dni'),

		);

		$validate = array('status' => 'processed');

		$cuantity = $this->M_producto->m_totalPurchaseProduct($data);

		for ($i = 0; $i < count($cuantity); $i++) {

			if ($cuantity[$i]['cantidad'] > $cuantity[$i]['almacen']) {

				$validate = array('status' => 'warning', 'message' => 'No hay producto suficiente en almacen no se puede hacer la transacción');

				break;

			}

			continue;

		}

		if ($validate['status'] == 'processed') {

			$response = $this->M_admin->updatePay($data, $cuantity);

			if ($response == true) {

				$msg = array('status' => 'success');

			} else {

				$msg = array('status' => 'error');

			}

		} else {

			$msg = $validate;

		}

		echo json_encode($msg);

	}

// ###################### Pagos incompletos ################################

	public function buyIncompleted()
	{

		$response['data'] = $this->M_admin->getBuyIncompleted();

		echo json_encode($response);

	}

	public function freePayment()
	{

		$order = $this->input->post('orden');

		$getTotal = $this->M_producto->getPaymentData($order);

		$data = array(

			'dni' => $order,

			'subtotal' => $getTotal->subtotal

		);

		$response = $this->M_admin->m_freePayment($data);

		$msg = ($response == true) ? array('status' => 'success') : array('status' => 'error');

		echo json_encode($msg);

	}

	public function dropBuyIncompleted()
	{

		$noOrden = $this->input->post('orden');

		$action = $this->M_admin->M_dropBuyIncompleted($noOrden);

		if ($action == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

// ###################### Usuarios ################################

	public function getUsers()
	{

		$data['data'] = $this->M_admin->m_getUsers();

		echo json_encode($data);

	}

	public function addUser()
	{

		$data = array(

			'typeUser' => htmlspecialchars($this->input->post('typeUser')),

			'name' => htmlspecialchars($this->input->post('nameUser')),

			'firstName' => htmlspecialchars($this->input->post('firstName')),

			'lastName' => htmlspecialchars($this->input->post('lastName')),

			'email' => htmlspecialchars($this->input->post('emailUser')),

			'phone' => htmlspecialchars($this->input->post('phoneUser')),

			'pass' => htmlspecialchars($this->input->post('passUser'))

		);

		$response = $this->M_admin->m_addUser($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

	public function updateUser()
	{

		$data = array(

			'dni' => htmlspecialchars($this->input->post('inpDniUser')),

			'typeUser' => htmlspecialchars($this->input->post('typeUserUpdate')),

			'name' => htmlspecialchars($this->input->post('nameUserUpdate')),

			'firstName' => htmlspecialchars($this->input->post('firstNameUpdate')),

			'lastName' => htmlspecialchars($this->input->post('lastNameUpdate')),

			'email' => htmlspecialchars($this->input->post('emailUserUpdate')),

			'phone' => htmlspecialchars($this->input->post('phoneUserUpdate')),

			'pass' => htmlspecialchars($this->input->post('passUserUpdate'))

		);

		$response = $this->M_admin->m_updateUser($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

// ###################### routes ################################	

	public function addRoute()
	{

		$data = array(

			'chofer' => $this->input->post('driverRoute'),

			'nameRoute' => $this->input->post('nameRoute'),

			'location' => $this->input->post('locationRoute'),

			'note' => $this->input->post('noteRoute'),

		);

		$response = $this->M_admin->addRoute($data);

		echo json_encode($response);

	}

	public function listDeliver()
	{

		$response['data'] = $this->M_admin->m_listdeliver();

		echo json_encode($response);

	}

	public function addDeliver()
	{

		$data = array(

			'order' => $this->input->post('data1'),

			'rute' => $this->input->post('data2')

		);

		$response = $this->M_admin->insertDeliver($data);

		echo json_encode($response);

	}


	public function removeDeliveryAssignment()
	{
		$response = array();
		try {
			$daId = $this->input->post('daId');
			$response["success"] = $this->M_admin->removeDeliveryAssignment($daId);
		} catch (Exception $e) {
			$response["success"] = false;
		}
		echo json_encode($response);
	}

	public function activeEntrega()
	{

		$dni = $this->input->post('order');

		$response = $this->M_admin->M_activeEntrega($dni);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}


	//	******************** Delivery Times
	public function deliveryTimesList()
	{
		$response['data'] = $this->M_admin->getDeliveryTimes();
		echo json_encode($response);
	}

	public function saveDeliveryTime()
	{

		$message = '';

		$data = array(
			'id' => $this->input->post('dtId'),
			'group' => $this->input->post('dtGroup'),
			'startTime' => $this->input->post('dtStartTime'),
			'endTime' => $this->input->post('dtEndTime'),
			'active' => $this->input->post('dtActive')
		);

		if ($this->input->post('dtSetDeliveryPlace') == 1) {
			$data['location'] = $this->input->post('dtDeliveryLocation');
			$data['deliveryCost'] = $this->input->post('dtDeliveryCost');
		} else {
			$data['location'] = "";
			$data['deliveryCost'] = 0;
		}

		try {
			if (intval($data["id"]) > 0) {
				//update
				$result = $this->M_admin->updateDeliveryTime($data);
			} else {
				//insert
				$result = $this->M_admin->insertDeliveryTime($data);
			}
		} catch (Exception $e) {
			$result = false;
		}


		if ($result) {
			$arr = array("status" => "success");
			echo json_encode($arr);
		} else {
			$arr = array("status" => "error");
			echo json_encode($arr);
		}

	}

	public function deleteDeliveryTime()
	{

		$message = '';

		$data = array(
			'id' => $this->input->post('dtId'),
		);

		try {
			if (intval($data["id"]) > 0) {
//				delete
				$result = $this->M_admin->deleteDeliveryTime($data);
			} else {

				$result = false;
			}
		} catch (Exception $e) {
			$result = false;
		}


		if ($result) {
			$arr = array("status" => "success");
			echo json_encode($arr);
		} else {
			$arr = array("status" => "error");
			echo json_encode($arr);
		}

	}

	//	******************** Production Helper


	public function getProductsByDeliveryTypeDateAndHour()
	{

		$response = array();
		try {

			$response['data'] = $this->M_production_helper->getProductsByDeliveryTypeDateAndHour(
				$this->input->post('dType'),
				$this->input->post('dDate'),
				$this->input->post('dStartHour'),
				$this->input->post('dFinishHour')
			);
			$response["success"] = true;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}

	public function updateProductionUnits()
	{
		$response = array("success" => false);

		try {
			$response["success"] = $this->M_production_helper->updateProductionUnits(
				$this->input->post('productionHelperId'),
				$this->input->post('productId'),
				$this->input->post('units')
			);
		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}

	//	******************** Products description

	public function getProductsDescription(){
		$response = array();
		try {

			$response['data'] = $this->M_production_helper->getProductsDescriptions();
			$response["success"] = true;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}

	public function saveProductsDescription()
	{
		$response = array();
		try {

			$data = $this->input->post('data');

			$result = false;

			if (intval($data["descriptionId"]) <= 0) {
				//insert
				$result = $this->M_production_helper->insertProductDescription($data);
			} else {
				//update
				$result = $this->M_production_helper->updateProductDescription($data);
			}

			$response["success"] = $result;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}

	public function getProductMaterials()
	{
		$response = array();
		try {

			$productId = $this->input->post('productId');
			$response['data'] = $this->M_production_helper->getProductMaterials($productId);
			$response["success"] = true;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}

	public function saveProductMaterials()
	{
		$response = array();
		try {
			$data = $this->input->post('data');
			$response["success"] = $this->M_production_helper->saveProductMaterials($data);;
		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}



	//	******************** Products sorting

	public function saveSortedProducts()
	{
		$response = array();
		try {

			$sortedProducts = $this->input->post('sorted');
			$result = $this->M_admin->updateSortedProducts($sortedProducts);
			$response["success"] = $result;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}


	//	******************** Deliveries full map
	public function getAllDeliveriesToFullMap()
	{
		$response = array();
		try {

			$response['data'] = $this->M_admin->getAllDeliveriesToFullMap();
			$response["success"] = true;

		} catch (Exception $e) {
			$response["success"] = false;
		}

		echo json_encode($response);
	}
/*ADG 0.0.1 Inicia Cambio*/
    public function getUnidadMedida()
	{
        
		$data['data'] = $this->M_admin->m_getUnidadMedida();
        
		echo json_encode($data);

	}
    
    public function addUnidadMedida()
    {

		$data = array(
            'clave' => htmlspecialchars($this->input->post('clave')),

			'descripcion' => htmlspecialchars($this->input->post('descripcion'))/*,

			/*,

			'activo' => htmlspecialchars($this->input->post('activo'))*/
            

		);
        //echo json_encode($data);

		 $response = $this->M_admin->m_addUnidadMedida($data);
        echo ('response');
        echo json_encode($response);

		if ($response == true) {
            

			$msg = array('status' => 'success');

            
            
            
		} else {
            echo ('Entra error');

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

	public function updateUnidadMedida()
	{

		$data = array(

			'idUDM' => htmlspecialchars($this->input->post('id_umdUpdate')),

			'clave' => htmlspecialchars($this->input->post('claveUpdate')),
            
            'descripcion' => htmlspecialchars($this->input->post('descripcionUpdate')),

			'activo' => htmlspecialchars($this->input->post('statusActivoUDMUpdate'))

		);

		$response = $this->M_admin->m_updateUnidadMedida($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

  /********************************INVENTARIO*********************************/  
    public function getInventario()
	{

		$data['data'] = $this->M_admin->m_getInventario();

		echo json_encode($data);

	}
        public function addInventario()
	{

		$data = array(

			'descripcion' => htmlspecialchars($this->input->post('descripcion')),

			'cantidad_fisica' => htmlspecialchars($this->input->post('cantidad_fisica')),
            
            'maximo' => htmlspecialchars($this->input->post('maximo')),
            
            'minimo' => htmlspecialchars($this->input->post('minimo')),

			'id_udm' => htmlspecialchars($this->input->post('id_udm')),
			
			'ingrediente' => htmlspecialchars($this->input->post('ingrediente')),
			
			'DetallePepara' => htmlspecialchars($this->input->post('DetallePepara'))

		);

		$response = $this->M_admin->m_addInventario($data); 

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

	public function updateInventario()
	{
		

		$data = array(
			'id_item' => htmlspecialchars($this->input->post('id_itemUpdate')),

			'descripcion' => htmlspecialchars($this->input->post('descripcionUpdate')),


			'cantidad_fisica' => htmlspecialchars($this->input->post('cantidad_fisicaUpdate')),

			'activo' => htmlspecialchars($this->input->post('id_statusUpdate')),
			
			'ingrediente' => htmlspecialchars($this->input->post('IngredienteUpdate')),
			
			'DetallePepara' => htmlspecialchars($this->input->post('DetallePeparaUpdate')),

			'id_udm' => htmlspecialchars($this->input->post('id_udmUpdate')),
            
			'maximo' => htmlspecialchars($this->input->post('maximoUpdate')),
            
			'minimo' => htmlspecialchars($this->input->post('minimoUpdate'))
			

		);
		

		$response = $this->M_admin->m_updateInventario($data);
		

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

    
/***************************************Inicidencia********************/
    
   public function getIncidencia()
	{

		$data['data'] = $this->M_admin->m_getIncidencia();

		echo json_encode($data);

	}
        public function addIncidencia()
	{

		$data = array(

			'id_item' => htmlspecialchars($this->input->post('id_item')),

			'detalle' => htmlspecialchars($this->input->post('detalle')),
            
            'cantidad' => htmlspecialchars($this->input->post('cantidad'))

		);
            //echo json_encode($data);

		$response = $this->M_admin->m_addIncidencia($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

	public function updateIncidencia()
	{

		$data = array(

			'id_item' => htmlspecialchars($this->input->post('id_itemUpdate')),

			'detalle' => htmlspecialchars($this->input->post('detalleUpdate')),

			'cantidad' => htmlspecialchars($this->input->post('cantidadUpdate'))

		);

		$response = $this->M_admin->m_updateIncidencia($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}
	
	public function getExpira()
	{

		$response['data'] = $this->M_admin->getExpira();

		echo json_encode($response);

	}
	//////////////////////////Cancela el pedodo (status 5)
	public function updateCancelPed()
	{
		
		
		$noOrden = $this->input->post('orden');

		$action = $this->M_admin->m_UpdatePedido($noOrden);

		if ($action == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);
		
		

	}
	
	////////////////////////////Ingredientes Producto//////////////////////
		public function getDetalleIngProd()
	{
		$id_producto = $this->input->post('id_prod');

		$response['data'] = $this->M_admin->get_DetallesProducts($id_producto);
		//echo('respuesta');

		echo json_encode($response);

	}
	
	public function getIngProd()
	{
		$idItem = $this->input->post('idItem');
		
		///print($id_item);
	

		$response['data'] = $this->M_admin->getIngProd($idItem);
		//echo('respuesta');

		echo json_encode($response);

	}
	public function dropDetalleProd()
	{
		//echo ('entra dropDetalleProd');

			$data = array(

			'id_producto' => $this->input->post('idProdDrop'),
			'id_item' => $this->input->post('idItemDrop')
			
		);
		
		//echo json_encode($data);
		$response = $this->M_admin->m_dropDetalleProd($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}
		//redirect($this->input->post("redirect"));

		echo json_encode($msg);
		

	}
	
	
	public function dropSubInv()
	{

			$data = array(

			'id_ItemIngrediente' => $this->input->post('id_ItemIngrediente'),
			'id_item' => $this->input->post('idItemDrop')
			
		);
		
		//echo json_encode($data);
		$response = $this->M_admin->m_dropSubInv($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}
		//redirect($this->input->post("redirect"));

		echo json_encode($msg);
		

	}
	
	   public function getIngredienteProd()
	{

		$response['data'] = $this->M_admin->m_getIngredienteProducto();

		echo json_encode($response);

	}
       public function addIngredientes()
	{      
			$data = array(
			'id_item' => $this->input->post('selectArticulos'),

			'id_producto' => $this->input->post('id_prod'),
            
            'cantidad' => $this->input->post('cantidadElemento')
			);
			//echo json_encode($data);
			
			$response = $this->M_admin->m_addIngredientes($data);
			
			//redirect($this->input->post("redirect"));
			
    		//print_r($this->input->post());
	 if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}
	 echo json_encode($msg);

		

		  /* 
	if ($this->M_admin->m_addIngredientes($this->input->post("selectArticulos"), $this->input->post("id_prod"), $this->input->post("cantidadElemento") )) {
    		//redirect($this->input->post("redirect"));
		 echo('entro');
    	}
    	print_r($this->input->post());*/
		}
	
	public function addSubInv()
	{      
			$data = array(
			'id_ItemIngrediente' => $this->input->post('selectArticulos'),

			'idItem' => $this->input->post('idItem'),
            
            'cantidad' => $this->input->post('cantidadElemento')
			);
			//echo json_encode($data);
			
			$response = $this->M_admin->m_addSubInv($data);
		
	 if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}
	 echo json_encode($msg);

		

		  /* 
	if ($this->M_admin->m_addIngredientes($this->input->post("selectArticulos"), $this->input->post("id_prod"), $this->input->post("cantidadElemento") )) {
    		//redirect($this->input->post("redirect"));
		 echo('entro');
    	}
    	print_r($this->input->post());*/
		}

	public function updateIngredientes()
	{

		$data = array(
			
			
			'id_item' => htmlspecialchars($this->input->post('id_itemUpdate')),

			'id_producto' => htmlspecialchars($this->input->post('id_productoUpdate')),
            
            'cantidad' => htmlspecialchars($this->input->post('cantidadUpdate'))

		);

		$response = $this->M_admin->m_updateIngredientes($data);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}
	
	public function getmaterualfull()
	{ 	
		

		$response['data'] = $this->M_admin->getmaterualfull();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getmaterualfull()
	{ 	
		

		$response['data'] = $this->M_admin->m_getmaterualfull();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getmaterualpagado()
	{ 	
		

		$response['data'] = $this->M_admin->m_getmaterualpagado();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getmaterualpagadoH1()
	{ 	
		

		$response['data'] = $this->M_admin->getmaterialpagadoH1();
		//echo('respuesta');

		echo json_encode($response);

	}
	
	public function m_getmaterualpagadoH2()
	{ 	
		

		$response['data'] = $this->M_admin->getmaterialpagadoH2();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getmaterualpagadoH3()
	{ 	
		

		$response['data'] = $this->M_admin->getmaterialpagadoH3();
		//echo('respuesta');

		echo json_encode($response);

	}
	
	public function m_getProdEntregados()
	{ 	
		

		$response['data'] = $this->M_admin->m_getProdEntregados();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getProdEntregadosh1()
	{ 	
		

		$response['data'] = $this->M_admin->m_getProdEntregadosh1();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getProdEntregadosh2()
	{ 	
		

		$response['data'] = $this->M_admin->m_getProdEntregadosh2();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function m_getProdEntregadosh3()
	{ 	
		

		$response['data'] = $this->M_admin->m_getProdEntregadosh3();
		//echo('respuesta');

		echo json_encode($response);

	}
	public function activePrepado()
	{

		$dni = $this->input->post('order');

		$response = $this->M_admin->M_activePrepado($dni);

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}
		echo json_encode($msg);

	}
	
	public function m_get_MaterialCocina()
	{ 	
		

		$response['data'] = $this->M_admin->get_MaterialCocina();
		//echo('respuesta');

		echo json_encode($response);

	}
	
	
	/////////////////////////////////////////////////////Material en cocina///////////////////////7
		public function updateMaterialCocina()
	{
		

		$data = array(
			'id_item' => htmlspecialchars($this->input->post('id_item')),


			'diaEntrega' => htmlspecialchars($this->input->post('diaEntrega')),

			'horaEntrega' => htmlspecialchars($this->input->post('horaEntrega')),

			'cantidadUpdate' => htmlspecialchars($this->input->post('cantidadUpdate'))

		);
		

		$response = $this->M_admin->m_updateMaterialCocina($data);
		

		if ($response == true) {

			$msg = array('status' => 'success');

		} else {

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

/*ADG 0.0.1 Finaliza Cambio*/

}