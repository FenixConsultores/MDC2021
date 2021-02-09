<?php 
defined('BASEPATH') OR exit('Permiso denegado');

class M_login extends CI_Model {

	public function __construct(){
        parent::__construct();        
    }

    public function login($data){    	
    	$query = $this->db->query("SELECT * FROM usuarios WHERE BINARY email='".$data['email']."' AND BINARY contraseña='".$data['password']."'");
    	if ($query->num_rows()>0) {
    		$msg = $query->row();
    	}else{
    		$msg = 'empty';
    	}
    	return $msg;
    }
}