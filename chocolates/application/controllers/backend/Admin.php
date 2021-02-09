<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
        Fecha      Version 
        01-02-18   ADG0.0.1  
        Se agrega las vistas para insertar unidad de medida de los materiales de inventario, ejemplo(Kilo, Gramo,etc.) y los productos en inventario, ejemplo(5 fresas,5 palillos,1 taza,etc.)
        Se agregan la lista de materiales para hacer los productos, ejemplo(Taza de Gato:5 fresas,5 palillos,1 taza,etc.)
*/


class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();

		if (!$this->session->userdata('logged_admin')) {

			redirect(base_url('home/login'));

		}

		$this->load->Model('backend/M_admin');
		$this->load->Model('backend/M_production_helper');
		$this->load->Model('backend/M_common');

	}

	public function index()

	{

		$data['statistic'] = $this->M_admin->statistic();

		$page = array(

			'page'=>$this->load->view('backend/modules/main',$data,true),

			'title'=>'Dashboard'

		);

		$this->load->view('backend/dashboard',$page);

	}



	public function compras(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_purchase.js";
		$extraJSSE = array();
		$extraJSSE[] = "assets/js/main/admin_purchase_sinentrega.js";
		$extraJSSP = array();
		$extraJSSP[] = "assets/js/main/admin_purchase_sinpago.js";

		$page = array(
			'page' => $this->load->view('backend/modules/compras', '', true),
			'title' => 'Compras',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}
	
	public function compras_sinentregar(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_purchase_sinentrega.js";
		
		

		$page = array(
			'page' => $this->load->view('backend/modules/compras_sinentregar', '', true),
			'title' => 'Compras',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}
	
	public function compras_sinpagar(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_purchase_sinpago.js";
		

		$page = array(
			'page' => $this->load->view('backend/modules/compras_sinpagar', '', true),
			'title' => 'Compras',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}
	
	public function compras_ruta(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_purchase_ruta.js";
		

		$page = array(
			'page' => $this->load->view('backend/modules/compras_ruta', '', true),
			'title' => 'Compras',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}
	
	public function pedidos_sinentregar(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_purchase.js";

		$page = array(
			'page' => $this->load->view('backend/modules/pedidos_sinentregar', '', true),
			'title' => 'Compras',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}

	public function productos(){

		$data['products'] = $this->M_admin->getProducts();

		$data['description'] = $this->M_admin->getDescription();
/*ADG0.0.1 Inicia cmabio*/
        $data['material'] = $this->M_admin->getInventario();
/*ADG0.0.1 Inicia cmabio*/
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_product_materials.js";

		$page = array(
			'page'=>$this->load->view('backend/modules/productos',$data,true),
			'title'=>'Productos',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);

	}
	
	public function productos_detalle(){
		$id_producto =$this->input->get("id_producto");
		$data['pdetalle'] = $this->M_admin->getProducts_id($id_producto);
		$data['detalles_prod']=$this->M_admin->get_DetallesProducts($id_producto);
/*ADG0.0.1 Inicia cmabio*/
        $data['material'] = $this->M_admin->getInventarioProd($id_producto);
/*ADG0.0.1 Inicia cmabio*/
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_product_materials.js";

		$page = array(
			'page'=>$this->load->view('backend/modules/productos_detalle',$data,true),
			'title'=>'Productos',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);

	}
	
	
	
	
	public function inventario_detalle(){
		$idItem =$this->input->get("idItem");
		$data['pdetalle'] = $this->M_admin->getIngInv($idItem);
		$data['material'] = $this->M_admin->getIng();
		$data['idItem'] =$this->input->get("idItem");
		
/*ADG0.0.1 Inicia cmabio*/
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_material_inv.js";

		$page = array(
			'page'=>$this->load->view('backend/modules/inventario_detalle',$data,true),
			'title'=>'Subinventario',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);

	}
	


// url pagos

	public function pagos(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_payments.js";

		$page = array(
			'page'=>$this->load->view('backend/modules/pagos','',true),
			'title'=>'Pagos',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}

	public function slopes(){

		$page = array(

			'page'=>$this->load->view('backend/modules/pending','',true),

			'title'=>'Pagos'

		);

		$this->load->view('backend/dashboard',$page);

	}

// end url pagos

	public function incompleto(){

		$page = array(

			'page'=>$this->load->view('backend/modules/incompleted','',true),

			'title'=>'Pagos'

		);

		$this->load->view('backend/dashboard',$page);

	}

	public function users(){

		$page = array(

			'page'=>$this->load->view('backend/modules/users','',true),

			'title'=>'Pagos'

		);

		$this->load->view('backend/dashboard',$page);

	}

	public function deliver(){

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_delivery_assignment.js";

		$driver['driver'] = $this->M_admin->get_Route();

		$page = array(
			'page' => $this->load->view('backend/modules/deliver', $driver, true),
			'title' => 'Asignar Rutas',
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard', $page);

	}

	public function deliveryfullmap(){


		$googleMapApiKey = $this->M_common->getMapsApiKey();

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_delivery_full_map.js";

		$extraExternalJS = array();
		$extraExternalJS[] = "https://maps.googleapis.com/maps/api/js?key=" . $googleMapApiKey . "&libraries=places";

		$page = array(
			'page' => $this->load->view('backend/modules/delivery_full_map', '', true),
			'title' => 'Mapa de entregas',
			'extraJS' => $extraJS,
			'extraExternalJS' => $extraExternalJS

		);

		$this->load->view('backend/dashboard', $page);

	}

	public function addRoute(){

		$driver['drivers'] = $this->M_admin->get_UserDriver();

		$driver['route'] = $this->M_admin->get_Route();

		$page = array(

			'page'=>$this->load->view('backend/modules/route',$driver,true),

			'title'=>'Asignar Rutas'

		);

		$this->load->view('backend/dashboard',$page);

	}



	//	******************************* Delivery times ************************************

	public function deliverytimes(){

		$googleMapApiKey = $this->M_common->getMapsApiKey();

		$extraJS = array();
		$extraJS[] = "assets/js/jquery.common.g-map-init.js";
		$extraJS[] = "assets/js/main/admin_delivery_times.js";

		$extraExternalJS = array();
		$extraExternalJS[] = "https://maps.googleapis.com/maps/api/js?key=" . $googleMapApiKey . "&libraries=places";

		$page = array(
			'page' => $this->load->view('backend/modules/delivery_times', '', true),
			'title' => 'Horarios de entrega',
			'extraJS' => $extraJS,
			'extraExternalJS' => $extraExternalJS
		);

		$this->load->view('backend/dashboard',$page);
	}

	//	******************************* Shipment costs ************************************

	public function shipmentcosts(){

		$googleMapApiKey = $this->M_common->getMapsApiKey();

		$extraJS = array();
		$extraJS[] = "assets/js/jquery.common.g-map-init.js";
		$extraJS[] = "assets/js/main/admin_shipment_costs.js";

		$extraExternalJS = array();
		$extraExternalJS[] = "https://maps.googleapis.com/maps/api/js?key=" . $googleMapApiKey . "&libraries=places";

		$page = array(
			'page' => $this->load->view('backend/modules/shipment-cost-calc', '', true),
			'title' => 'Costos de envío',
			'extraJS' => $extraJS,
			'extraExternalJS' => $extraExternalJS
		);

		$this->load->view('backend/dashboard',$page);
	}

	//	******************************* ProductionHelper ************************************

	public function productionhelper()
	{

		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_production_helper.js";

		$productDescriptions = $this->M_production_helper->getProductsMaterials();

		$page = array(
			'page' => $this->load->view(
				'backend/modules/production-helper',
				array("productDescriptions" => json_encode($productDescriptions, true)),
				true
			),
			'title' => 'Auxiliar de producción',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard', $page);
	}

	//	******************************* products descriptions ************************************

	public function productdescriptions(){


		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_product_descriptions.js";

		$page = array(
			'page' => $this->load->view('backend/modules/product_descriptions', '', true),
			'title' => 'Descripciones de productos',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}

	//	******************************* products descriptions ************************************

	public function productssorting(){


		$data=array();
		$data["products"]= $this->M_admin->getProductsSorted();


		$extraJS = array();
		$extraJS[] = "assets/js/plugins/jquery-ui/jquery-ui.min.js";
		$extraJS[] = "assets/js/main/admin_product_sorting.js";

		$page = array(
			'page' => $this->load->view('backend/modules/products_sorting', $data, true),
			'title' => 'Ordenamiento de productos',
			'extraJS' => $extraJS
		);

		$this->load->view('backend/dashboard',$page);
	}
/*ADG0.0.1  Inicia Cambio */    
    //	******************************* Unidad de Medida  ************************************
    	public function unidad_medida(){
        
		$page = array(
			'page' => $this->load->view('backend/modules/unidad_medida', /*$data*/'', true),
			'title' => 'Unidades de Medida'
		);

		$this->load->view('backend/dashboard',$page);
	}
    //	******************************* Inventario ************************************
    public function inventario(){
        $data['unidadMedida'] = $this->M_admin->get_UnidadMedida();
		$page = array(
			'page' => $this->load->view('backend/modules/inventario', $data, true),
			'title' => 'Inventario'
		);

		$this->load->view('backend/dashboard',$page);
	}
    //	******************************* Incidencias ************************************
    public function incidencia(){
        $data['material'] = $this->M_admin->getInventario();
		$page = array(
			'page' => $this->load->view('backend/modules/incidencia', $data, true),
			'title' => 'Inciencias'
		);

		$this->load->view('backend/dashboard',$page);
	}
	//	******************************* Expirar ************************************
	public function expirar(){
		

		$page = array(

			'page'=>$this->load->view('backend/modules/expirar','',true),

			'title'=>'Pagos'

		);

		$this->load->view('backend/dashboard',$page);

	}
	public function materialfull(){
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_material_pedido.js";
		
		 $data['material'] = $this->M_admin->getmaterualfull();
		$data['producto'] = $this->M_admin->getmaterualfullProd();

		$page = array(

			'page'=>$this->load->view('backend/modules/materialfull',$data,true),

			'title'=>'Material para pedidos',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	public function materialpagado(){
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_material_pagado.js";
		
		
		 $data['material'] = $this->M_admin->getmaterialpagado();
		

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	public function materialpagado_h1(){
		
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		$data['material'] = $this->M_admin->getmaterialpagadoH1();

		$page = array(
			

			'page'=>$this->load->view('backend/modules/materialpagado_h1',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	
	public function materialpagado_h1marias(){
		
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		$data['material'] = $this->M_admin->getmaterialpagadoH1marias();

		$page = array(
			

			'page'=>$this->load->view('backend/modules/materialpagado_h1marias',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	
	public function materialpagado_h2(){
		
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		$data['material'] = $this->M_admin->getmaterialpagadoH2();

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado_h2',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	public function materialpagado_h2marias(){
		
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		
		$data['material'] = $this->M_admin->getmaterialpagadoH2marias();

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado_h2marias',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	public function materialpagado_h3(){
		
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		
		$data['material'] = $this->M_admin->getmaterialpagadoH3();

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado_h3',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	
	public function materialpagado_h3marias(){
		$extraJS = array();
		$extraJS[] = "assets/js/main/admin_materialpagado_h1.js";
		
		$data['material'] = $this->M_admin->getmaterialpagadoH3marias();

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado_h3marias',$data,true),

			'title'=>'Material Pedidos Pagados',
			
			'extraJS' => $extraJS

		);

		$this->load->view('backend/dashboard',$page);

	}
	
	public function materialpagadoh1(){
		 $data['material'] = $this->M_admin->getmaterialpagadoH1();
		

		$page = array(

			'page'=>$this->load->view('backend/modules/materialpagado_h1',$data,true),

			'title'=>'Material Pedidos Pagados'

		);

		$this->load->view('backend/dashboard',$page);

	}
	
	//***************************Ingredientes Producto*******************************
	 public function ingredientes(){
        $data['material'] = $this->M_admin->getInventario();
		$data['producto'] = $this->M_admin->get_Products();
		$page = array(
			'page' => $this->load->view('backend/modules/ingredientes', $data, true),
			'title' => 'Ingredientes'
		);

		$this->load->view('backend/dashboard',$page);
	}
	
	 public function top(){
        $data['material'] = $this->M_admin->getInventario();
		$data['producto'] = $this->M_admin->get_Products();
		$page = array(
			'page' => $this->load->view('backend/modules/top', $data, true),
			'title' => 'Ingredientes'
		);

		$this->load->view('backend/dashboard',$page);
	}
/*ADG0.0.1   Finaliza Cambio*/

}

