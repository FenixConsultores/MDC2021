<?php  defined('BASEPATH') OR exit('Permiso denegado');



class Action extends CI_Controller {

	private $fecha;

	public function __construct(){

		parent::__construct();

		if (!$this->session->userdata('logged_ruta')) {

			redirect(base_url('home/ruta'));

		}

		$this->load->Model('fontend/M_ruta');

		$this->fecha = date('Y-m-d H:m:s');

	}



	public function getRoad(){

		header('Content-Type:Application/json');

		$data = $this->M_ruta->getRoad();

		echo json_encode($data);

	}



	public function getRoad2(){		

		$data = $this->M_ruta->getRoad($this->session->userdata('dni'));

		for ($i=0; $i <count($data) ; $i++) { 

			$value = explode(',', $data[$i]['geolocalizacion']);			

			$data[$i]['location']['lat'] = $value[0];

			$data[$i]['location']['lng'] = $value[1];

		}

		header('Content-Type:Application/json');

		echo json_encode($data);

	}



	public function loadPicture(){

		$config = array(

    		'upload_path' => './assets/img/evidencia/',

    		'allowed_types' => 'jpg|png|jpeg',    		

    		'overwrite' => false

    	);

    	$this->load->library('upload', $config);

    	if (!$this->upload->do_upload('evidencia')) {

    		$msg = array('error' => $this->upload->display_errors());           

    	}else{    		

    		$data = array(

    			'picture' => $this->upload->data('file_name'),

    		 	'noOrder' => $this->input->post('numberOrder'),

    		 	'idChofer' => $this->session->userdata('dni'),

    		 	'dateUpload' => $this->fecha

    		);

    		$response = $this->M_ruta->uploadEvidencia($data);

    		if ($response == true) {

    			$msg = array('status' => 'success');

    		}else{

    			$msg = array('status' => 'error');

    		}

    	}

    	echo json_encode($msg);

	}



	public function validateProductGive(){

		$orden = $this->input->post('numberOrder');

		$action = $this->M_ruta->M_validateProductGive($orden);

		if ($action == true) {

			$msg = array('status' => 'success');

		}else{

			$msg = array('status' => 'error');

		}

		echo json_encode($msg);

	}

}