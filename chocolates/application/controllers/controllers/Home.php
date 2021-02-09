<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('M_login');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('fontend/customer/home');
	}

	public function login(){
		$this->load->view('backend/Login');
	}

	public function ruta(){
		$this->load->view('fontend/reparto/login');
	}
	public function access(){
		$data = array(
			'email' =>addslashes($this->input->post('mailAdmin')),
			'password' =>addslashes($this->input->post('passwordAdmin'))
		);
		$response = $this->M_login->login($data);
		if ($response == 'empty') {
			$config = 'empty';
		}else{
			if ($response->tipo_usuario == 'Administrador') {
				$config = array(
					'type'=>$response->tipo_usuario,
					'name'=>$response->nombre,					
					'email'=>$response->email,
					'dni' =>$response->id_user,
					'logged_admin'=>TRUE					
				);
				$this->session->set_userdata($config);
			}elseif ($response->tipo_usuario == 'Estandar') {
				$config = array(
					'type'=>$response->tipo_usuario,
					'name'=>$response->nombre,					
					'email'=>$response->email,
					'dni' =>$response->id_user,
					'logged_standar'=>TRUE					
				);
				$this->session->set_userdata($config);
			}else if ($response->tipo_usuario == 'Chofer'){
				$config = array(
					'type'=>$response->tipo_usuario,
					'name'=>$response->nombre,					
					'email'=>$response->email,
					'dni' =>$response->id_user,
					'logged_ruta'=>TRUE					
				);
				$this->session->set_userdata($config);
			}
		}
		echo json_encode($config);
	}

	public function logoutAdmin(){
		$this->session->unset_userdata('logged_admin');
		$response = array('status' => 'success');
		echo json_encode($response);
	}

	public function logoutReparto(){
		$this->session->unset_userdata('logged_ruta');
		echo json_encode("success");
	}

}
