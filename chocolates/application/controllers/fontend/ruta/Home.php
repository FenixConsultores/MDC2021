<?php  defined('BASEPATH') OR exit('Permiso denegado');



class Home extends CI_Controller {



	public function __construct(){

		parent::__construct();

		if (!$this->session->userdata('logged_ruta')) {

			redirect(base_url('home/ruta'));

		}

		$this->load->Model('fontend/M_ruta');
		$this->load->Model('backend/M_common');

	}



	public function index(){

		$data = array(

			'data' => $this->M_ruta->getRoad($this->session->userdata('dni')),
				'quantity' => $this->M_ruta->M_Models($this->session->userdata('dni')),
			'routeProdImages' => base_url('assets/img/modelos/')

		);

		$page = array(

			'page' => $this->load->view('fontend/reparto/list',$data,true),

			'ruta' => $this->M_ruta->dataRepartidor($this->session->userdata('dni')),

			'title' => 'Lista ruta'

		);

		$page["extraJS"] = array();
		$page["extraJS"][] = "assets/js/main/ruta_list.js";

		$this->load->view('fontend/reparto/dashboard',$page);

	}



	public function showMap(){

		$page = array(

			'page' => $this->load->view('fontend/reparto/map','',true),

			'ruta' => $this->M_ruta->dataRepartidor($this->session->userdata('dni')),

			'title' => 'Lista ruta',

			'mapApiKey'=> $this->M_common->getMapsApiKey()

		);

		$this->load->view('fontend/reparto/dashboard',$page);	

	}



	public function description($identify){

		$data = array(

			'dni' => $identify,

			'description' =>$this->M_ruta->dataCustomer($identify),

			'quantity' => $this->M_ruta->M_quantityModels($identify),

			'routeProdImages' => base_url('assets/img/modelos/')

		);		

		$page = array(

			'page' => $this->load->view('fontend/reparto/description',$data,true),

			'ruta' => $this->M_ruta->dataRepartidor($this->session->userdata('dni')),

			'title' => 'Description'

		);

		$this->load->view('fontend/reparto/dashboard',$page);	

	}



	public function showMapClient(){



		$data = array(

			'location' => $this->input->get('location'),

			'ruta' => $this->M_ruta->dataRepartidor($this->session->userdata('dni'))

		);

		$page = array(

			'page' => $this->load->view('fontend/reparto/ubicacion',$data,true),			

			'title' => 'Ubicacion cliente'

		);

		$this->load->view('fontend/reparto/dashboard',$page);

	}

}