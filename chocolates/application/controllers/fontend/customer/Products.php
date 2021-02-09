<?php  defined('BASEPATH') OR exit('Permiso denegado');



class Products extends CI_Controller {

	private $fecha;

	public function __construct(){

		parent::__construct();

		$this->fecha = date('Y-m-d G:i:s');

		$this->load->model('fontend/M_producto');		

	}	

	public function get_Products(){

		

			$products=$this->M_producto->getProducts();

			if (empty($products)) {

				$products['productos']="vacio";				

			}

			header('Content-type:Application/JSON');

			$response['productos']= $products;

			$response['carrito']=$this->allDataCart();

			echo json_encode($response);			

			

	}



	public function add_cart(){

		$id=$this->input->post('id');

		$product=$this->M_producto->getProductsId($id);

		

		$cantidad = 1;

        //obtenemos el contenido del carrito

        $carrito = $this->cart->contents();

 

        foreach ($carrito as $item) {

            //si el id del producto es igual que uno que ya tengamos

            //en la cesta le sumamos uno a la cantidad

            if ($item['id'] == $id) {

                $cantidad = 1;

            }

        }

        $pictures = explode(',',$product->imagenes);

        //cogemos los productos en un array para insertarlos en el carrito

        $data = array(

            'id' => $id,

            'qty' => $cantidad,

            'price' => $product->precio,

            'name' => $product->nombre,

            'options'=>$product->modelo,

            'img'=>$pictures[0],

            'status'=>1

        );        

        //insertamos al carrito

        $this->cart->insert($data);

        echo json_encode('agregado');

	}

	//obtener los ptoductos del carrito  

	public function allDataCart(){

		header('Content-Type:application/JSON');		

		$data=$this->cart->contents();		

		if (!empty($data)) {

			foreach ($data as $key => $value) {

				$res[]=array_values($value);

			}

		}else{

			$res = 'carrito vacio';

		}

		print_r($res);

	}

	public function delete_Item_cart(){

		$rowid = $this->input->post('rowid');

		$product=array(

			'rowid'=>$rowid,

			'qty'=>0

		);

		//print_r($product);

		if ($this->cart->update($product)) {

			$msg='success';

		}else{

			$msg='error';

		}

		echo json_encode($msg);

		//redirect('http://localhost/proyectos/chocolates/customer/home/p2');

	}

	

	public function deleteCart(){

		$this->cart->destroy();

		redirect('http://localhost/proyectos/chocolates/customer/home/p2');

	}



	public function dataCart(){

		if ($this->input->is_ajax_request()) {

			$data=array(

			'numItems' => $this->cart->total_items(),

			'priceTotal' => $this->cart->total()

		);

		echo json_encode($data);

		}else{

			show_404();

		}

	}



	public function contentCart(){		

		if ($this->input->is_ajax_request()) {

			$dni = $this->input->post('dni');

			$cart = $this->cart->contents();

			$cart = array_values($cart);

			if ($cart) {

				$data[] = 'sinValor';

				for ($i=0; $i <count($cart) ; $i++) { 

					if ($cart[$i]['id'] == $dni) {					

						$msg = 'existe valor igual';

						$data[]=$cart[$i];

						array_shift($data);

						break;

					}

					//$data[] = 'no existe valor';

				}

			}else{

				$data[] = 'empty';

			}

		}else{

			show_404();

		}

		header('Content-Type:Application/JSON');

		echo json_encode($data);

	}


	public function numberOrder()
	{

		$resulId = $this->M_producto->getId();

		$string = 'M00000';

		$value = !empty($resulId->id_compra) ? $resulId->id_compra : 1;

		for ($i = 0; $i <= $value; $i++) {
			++$string;
		}

		//M[CONSECUTIVO]0[SEGUNDO]
		return $string . "0" . date('s');
	}



	public function entregaProductos(){

		header('Content-Type:Application/JSON');
		//$archivo = $_FILES['picture']['name'];
		
		//echo($archivo);

		if ($this->input->post('picture')!=""){
			echo('archivo');
			$config = array(

    		'upload_path' => './assets/img/domicilio/',

    		'allowed_types' => 'jpg|png|jpeg',    		

    		'overwrite' => false

				);

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('picture')) {

					$msg = array('error' => $this->upload->display_errors());           

				}else{    		

					$data = array(
						
						'rowid'=>$this->input->post('idrowCart'),

						'idProducto'=>$this->input->post('idProduct'),

						'cantidad'=>$this->input->post('productQuantity'),

						'diaEntrega'=>$this->input->post('dayEntrega'),

						'horaEntrega'=>$this->input->post('hourEntrega'),

						'hourEntregaSpecial'=>$this->input->post('hourEntregaSpecial'),

						'cliente'=>$this->input->post('nameCliente'),

						'telefono'=>$this->input->post('phoneCliente'),

						'personaEntregar'=>$this->input->post('namePersonEntrega'),

						'telefonoPersonaEntrega'=>$this->input->post('phonePersonEntrega'),

						'nota'=>$this->input->post('noteArreglo'),

						'direccion'=>$this->input->post('direccionCliente'),

						'costoEnvio'=>$this->input->post('cosEnvio'),

						'geolocalizacion'=>$this->input->post('ubicacion'),

						'confirmacionDomicilio'=>$this->input->post('confirmacionDomicilio'),

						'detalleExteriorDomicilio'=>$this->input->post('detalleExteriorDomicilio'),

						'descripcionDomicilio'=>$this->input->post('descriptionDomicilio'),

						'fecha_registro' => date('Y-m-d G:i:s'),

						'tipoEntrega'=>$this->input->post('tipoEntrega'),

						'file' => $this->upload->data('file_name')

					);	
				}
			
		}else{
			$data = array(

						'rowid'=>$this->input->post('idrowCart'),

						'idProducto'=>$this->input->post('idProduct'),

						'cantidad'=>$this->input->post('productQuantity'),

						'diaEntrega'=>$this->input->post('dayEntrega'),

						'horaEntrega'=>$this->input->post('hourEntrega'),

						'hourEntregaSpecial'=>$this->input->post('hourEntregaSpecial'),

						'cliente'=>$this->input->post('nameCliente'),

						'telefono'=>$this->input->post('phoneCliente'),

						'personaEntregar'=>$this->input->post('namePersonEntrega'),

						'telefonoPersonaEntrega'=>$this->input->post('phonePersonEntrega'),

						'nota'=>$this->input->post('noteArreglo'),

						'direccion'=>$this->input->post('direccionCliente'),

						'costoEnvio'=>$this->input->post('cosEnvio'),

						'geolocalizacion'=>$this->input->post('ubicacion'),

						'confirmacionDomicilio'=>$this->input->post('confirmacionDomicilio'),

						'detalleExteriorDomicilio'=>$this->input->post('detalleExteriorDomicilio'),

						'descripcionDomicilio'=>$this->input->post('descriptionDomicilio'),

						'fecha_registro' => date('Y-m-d G:i:s'),

						'tipoEntrega'=>$this->input->post('tipoEntrega'),

						'file' =>''

					);

		}

				 
				


    	
		
		

		$message = '';
		
		//echo ($data);

	

    	   

    	$cart = $this->cart->contents();    	

    	$data['orden']=$this->numberOrder();    	

    	$id = '';

    	$qty = '';

    	switch ($data['tipoEntrega']) {

    		case 'domicilioIndividual':

	    		$response = $this->M_producto->saveShopping3($data);

	        	if ($response['status'] == 'success') {

	        		$update = array(

						'rowid'=>$data['rowid'],

						'status'=>0,

						'qty'=>0

					);

					$this->cart->update($update);

					$cart = $this->cart->contents();				

					$response['validate'] = array_sum(array_column($cart, 'status'));

					if ($response['validate']==0) {

						$this->session->unset_userdata('registerOrden');

					}

					$message = array(

	        			'status'=>'success',

	        			'type'=>'allHomeOn',

	        			'statusCart'=>$response['validate'],

	        			'numOrder'=>$response['numOrden']

	        		);

	        	}else{

	        		$message = array(

	        			'status'=>'error',

	        			'type'=>'allHomeOn',

	        			'statusCart'=>$response['validate'],

	        			'numOrder'=>$response['numOrden']

	        		);

	        	}

		        // echo json_encode($message);

    			break;

    		case 'mariasIndividual':

    			$response = $this->M_producto->saveShopping4($data);

				if ($response['status']== 'success') {

					$update = array(

						'rowid'=>$data['rowid'],

						'status'=>0,

						'qty'=>0

					);

					$this->cart->update($update);

					$cart = $this->cart->contents();

					$response['validate'] = array_sum(array_column($cart, 'status'));

					if ($response['validate']== 0) {	$this->session->unset_userdata('registerOrden');	}

					$message = array(

						'status' => 'success',

						'type'=>'mariasIndividual',

						'statusCart'=>$response['validate'],

						'numOrder'=>$response['numOrden']

					);

				}else{

					$message = array(

						'status' => 'error',

						'type'=>'mariasIndividual',

						'statusCart'=>$response['validate'],

						'numOrder'=>$response['numOrden']	

					);

				}

				//echo json_encode($message);

    			break;

    		case 'todoDomicilio':

    			foreach ($cart as $value) {

					$id .=$value['id'].',';				

					$qty .=$value['qty'].',';

				}			

				$idArray = explode(',',$id);

				$cantidad = explode(',', $qty);

				array_pop($idArray);

				array_pop($cantidad);			

				$data['idProducto']=$idArray;

				$data['cantidad']=$cantidad;

				$response = $this->M_producto->saveShopping1($data);

				if ($response['status'] == 'success') {

					foreach ($cart as $rowid) {

						$update = array(

							'rowid'=> $rowid['rowid'],

							'status'=>0,

							'qty'=>0

						);

						$this->cart->update($update);

					}

					$cart = $this->cart->contents();

					$data['validate'] = array_sum(array_column($cart, 'status'));

					if($this->session->userdata('registerOrden') && $data['validate']==0){

						$this->session->unset_userdata('registerOrden');

					}

					$message = array(

						'status' => 'success',

						'type' => 'allHome',

						'statusCart' => $data['validate'],

						'numOrder'=> $response['numOrden']

					);

				}else{

					$message = array(

						'status' => 'error',

						'type' => 'allHome',

						'statusCart' => $data['validate'],

						'numOrder'=> $response['numOrden']

					);

				}

				//echo json_encode($message);

    			break;

    		case 'todoMarias':

    			foreach ($cart as $value) {

					$id .=$value['id'].',';

					$qty .=$value['qty'].',';

				}

				$idArray = explode(',',$id);

				$cantidad = explode(',', $qty);

				array_pop($idArray);

				array_pop($cantidad);

				$data['idProducto']=$idArray;

				$data['cantidad']=$cantidad;

				//$data2['orden']=$this->generateNumberOrder();

				$response = $this->M_producto->saveShopping2($data);

				if ($response['status'] == 'success') {

					foreach ($cart as $rowid) {

					$update = array(

						'rowid' => $rowid['rowid'],

						'status' => 0,

						'qty' => 0

					);

					$this->cart->update($update);

					}

					$cart = $this->cart->contents();

					$data['validate'] = array_sum(array_column($cart, 'status'));

					if($this->session->userdata('registerOrden') && $data['validate']==0){$this->session->unset_userdata('registerOrden');}

					$message = array(

						'status' => 'success',

						'type' => 'allMarias',

						'statusCart' => $data['validate'],

						'numOrder'=> $response['numOrden']

					);				

				}else{

					$message = array(

						'status' => 'error',

						'type' => 'allMarias',

						'statusCart' => $data['validate'],

						'numOrder'=> $response['numOrden']

					);

				}			

    			break;

    		default:

    			echo "opcion desconocida";

    			break;

    	}

    	echo json_encode($message);

    }



    //obtener datos para registrar pago

    public  function  getDataPayment(){

    	$search = $this->input->post('orden');

    	$response = $this->M_producto->getPaymentData($search);

    	$check = $this->M_producto->m_consultExistPay($search);

    	$data = array(

    		'orden' => $response->numeroOrden,

    		'subtotal' => $response->subtotal,

    		'fecha' => $this->fecha

    	);

    	if ($check > 0) {

    		$register = true;

    	}else{

    		$register = $this->M_producto->registerPay($data);

    	}    	

    	if ($register == true) {

    		$msg = array('status' => 'success');

    	}else{

    		$msg = array('status' => 'error');

    	}

    	header('Content-Type:Application/json');

    	echo json_encode($msg);

    }



    public function verificarSeguimiento(){

    	$id = $this->input->post('dni');

    	$response = $this->M_producto->validarSeguimiento($id);

    	if ($response['login'] == true && $response['data']->statusRegistro == '1') {

    		$data = $this->M_producto->dataClient($id);

    		$login = array(

    			'dni' => $id,

    			'name' => $data->nombreCliente,

    			'logged_in' => TRUE

    		);

    		$this->session->set_userdata($login);

    		$msg = 'success';

    	}else if($response['data']->statusRegistro == '0'){

    		$msg = 'warning';

    	}

    	else{

    		$msg = 'error';

    	}

    	echo json_encode($msg);

    }



    public function signOff(){

    	if ($this->input->is_ajax_request()) {

    		$this->session->unset_userdata('logged_in');

    		$msg = 'success';

    	}else{	

    		show_404();

    	}

    	echo json_encode($msg);

    }



    public function payStatus($id){

    	$status = 0;

    	if ($id) {

    		//echo '<strong>Pago realizado exitosamente</strong> del producto con identificador = '.$id.'<br>';   

    		$status = $this->M_producto->updatePayment($id);

    		if ($status == 'success') {

    			$page = array(

	    			'page' => $this->load->view('fontend/customer/exito','',true),

	    			'Pago_status' => 'Exito'

	    		);

	    		$this->load->view('fontend/customer/paso1',$page);

    		}else{

    			$page = array(

	    			'page' => $this->load->view('fontend/customer/error','',true),

	    			'Pago_status' => 'Exito'

	    		);

    			$this->load->view('fontend/customer/paso1',$page);

    		} 	    		    		

    	}else{

    		show_404();

    	}

    }



    public function uploadBaucher(){

    	$config = array(

    		'upload_path' => './assets/img/baucher/',

    		'allowed_types' => 'jpg|png|jpeg|jfif',

    		'file_name' => $this->session->userdata('dni'),

    		'overwrite' => true

    	);

    	$this->load->library('upload', $config);

    	if (!$this->upload->do_upload('baucherFile')) {

    		$response = array('error' => $this->upload->display_errors());           

    	}else{

    		 $data = array(

    		 	'file' => $this->upload->data('file_name'),

    		 	'dni' => $this->session->userdata('dni')

    		 );

    		 $response = $this->M_producto->uploadBaucher($data);

    	}
		
    	echo json_encode($response);

    }

}