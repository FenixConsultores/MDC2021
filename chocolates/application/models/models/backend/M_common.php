<?php defined('BASEPATH') OR exit('Permiso denegado');








class M_common extends CI_Model


{





	private $googleMapsApiKey;





	public function __construct()


	{





		parent::__construct();





		$this->googleMapsApiKey = 'AIzaSyDWkUDb4wZPN-JQd7gNtABDb07tB_YeByU';





	}





	public function getMapsApiKey()


	{


		return $this->googleMapsApiKey;


	}





}