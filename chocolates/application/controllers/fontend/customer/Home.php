<?php defined('BASEPATH') OR exit('Permiso denegado');



class Home extends CI_Controller {

	private $fecha;

	public function __construct(){

		parent::__construct();

		$this->fecha = date('Y-m-d G:i:s');

		$this->load->Model('fontend/M_producto');

	}



	public function index(){		

		$this->load->view('fontend/customer/home');		

	}



	public function P1(){

	$data['products'] = $this->M_producto->getProducts();	

		$page=array(

			'page'=>$this->load->view('fontend/customer/products',$data,true),

			'title'=>'Seleccione los productos',

			'paso'=>'Paso 1/4',

			'progreso'=>'25%'

		);

		$this->load->view('fontend/customer/paso1',$page);	

	}



	public function description($dni){

		$data['information'] = $this->M_producto->getProductsId($dni);

		$page = array(

			'page' => $this->load->view('fontend/customer/description',$data,true),

			'title' => 'Descipción'

		);

		$this->load->view('fontend/customer/paso1',$page);

	}

	

	public function P2(){

		$data = array("deliveryTimes" => $this->M_producto->getDeliveryTimes());

		$page = array(

			'page' => $this->load->view('fontend/customer/paso2', $data, true),

			'title' => 'Entrega de productos',

			'paso' => 'Paso 2/4',

			'progreso' => '50%'

		);

		$this->load->view('fontend/customer/paso1', $page);

	}



	public function P3($identificador){

		if ($this->uri->segment(5)) {

			$data['resumen']= $this->M_producto->getProductResumeCustomer($identificador);				

			$page=array(

				'page'=>$this->load->view('fontend/customer/paso3',$data,true),

				'title'=>'Resumen de compra',

				'paso'=>'Paso 3/4',

				'progreso'=>'75%'

			);	

			$this->load->view('fontend/customer/paso1',$page);		

		}else{

			redirect(base_url('fontend/customer/home/p2'));

		}

	}

	

	public function pago($identificador){

		if ($this->uri->segment(5)) {			

			$data['resumen'] = $this->M_producto->getProductResume($identificador);			

			$page = array(

				'page'=>$this->load->view('fontend/customer/pago',$data,true),

				'title'=>'OPCIONES DE PAGO',

				'paso'=>'Paso 4/4',

				'progreso'=>'100%'

			);			

			$this->load->view('fontend/customer/paso1',$page);											

		}else{

			redirect(base_url('fontend/customer/home/p1'));

		}

	}



	public function login(){

		$this->load->view('fontend/customer/login');

	}



	public function payPayPal(){

		if ($this->input->is_ajax_request()) {

			$data = $this->input->post();

			//print_r($data);

			$url = 'https://www.paypal.com/cgi-bin/webscr?amount='.$data['amount'].'&quantity='.$data['quantity'].'&cmd='.$data['cmd'].'&business='.$data['business'].'&item_name='.$data['item_name'].'&item_number='.$data['item_number'].'&page_style='.$data['page_style'].'&cancel_return='.$data['cancel_return'].'&currency_code='.$data['currency_code'].'&cn='.$data['cn'].'&custom='.$data['custom'].'&country='.$data['country'].'&return='.$data['return'].'';

			//print_r($url);			

		}else{

			show_404();

		}



		echo $url;

	}

	public function bancomer($dni){

		$data['description'] = $this->M_producto->getProductResume($dni);

		$page = array(

			'page' => $this->load->view('fontend/customer/metodosPago/bancomer',$data,true),

			'title' => 'Deposito'

		);

		$this->load->view('fontend/customer/paso1',$page);

	}

	public function oxxo($dni){

		$data['description'] = $this->M_producto->getProductResume($dni);

		$page = array(

			'page' => $this->load->view('fontend/customer/metodosPago/oxxo',$data,true),

			'title' => 'Deposito'

		);

		$this->load->view('fontend/customer/paso1',$page);

	}



	public function seguimientoEnvio(){		

		if ($this->session->userdata('logged_in')) {

			$search = $this->session->userdata('dni');

			$data ['resumen'] = $this->M_producto->getProductResume($search);

			$page = array(

				'page' => $this->load->view('fontend/customer/seguimiento/seguimiento',$data,true),

				'title' => 'seguimiento'

			);

			$this->load->view('fontend/customer/seguimiento/dashboard',$page);	

		}else{

			redirect(base_url('fontend/customer/home'));

		}

	}



	public function statusEnvio(){

		if ($this->session->userdata('logged_in')) {

			$search = $this->session->userdata('dni');

			$data ['resumen'] = $this->M_producto->getProductResume($search);

			$data['evidence'] = $this->M_producto->M_getEvidence($search);

			$page = array(

				'page' => $this->load->view('fontend/customer/seguimiento/envio',$data,true),

				'title' => 'Estado envio'

			);

			$this->load->view('fontend/customer/seguimiento/dashboard',$page);

		}else{

			redirect(base_url('fontend/customer/home'));

		}

	}



	public function detail($model,$orden){

		$data = array('model'=>urldecode($model),'orden'=>$orden);

		$send['data']= $this->M_producto->getDetail($data);		

		$page = array(

			'page' => $this->load->view('fontend/customer/seguimiento/detail',$send,true),

			'title' => 'Detalle'

		);

		$this->load->view('fontend/customer/seguimiento/dashboard',$page);	

	}



	public function errorPay(){

		$page = array(

			'page' => $this->load->view('fontend/customer/error','',true),

			'Pago_status' => 'Exito'

		);

    	$this->load->view('fontend/customer/paso1',$page);

	}

	

	public function mapa(){

		$page = array(

			'page' =>  $this->load->view('fontend/customer/calCost','',true),

			'Calcular Costo Envio'

		);

		$this->load->view('fontend/customer/paso1',$page);	

	}

}