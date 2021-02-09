<?php  defined('BASEPATH') OR exit('Permiso denegado');



class M_producto extends CI_Model {



    public function __construct(){

        parent::__construct();        

    }



    public function getProducts(){

    	$query=$this->db->query("SELECT productos.*,GROUP_CONCAT(imagenes.imagen SEPARATOR ',') AS imagenes FROM productos INNER JOIN imagenes ON productos.id_producto = imagenes.producto WHERE productos.publicar='si' group by id_producto ORDER BY productos.posicion_app , productos.id_producto;");

    	return $query->result_array();

    }



    public function getProductsId($id){

    	$query=$this->db->query("SELECT productos.*,GROUP_CONCAT(imagenes.imagen SEPARATOR ',') AS imagenes FROM productos INNER JOIN imagenes ON productos.id_producto = imagenes.producto WHERE productos.id_producto='".$id."' group by id_producto;");

    	return $query->row();

    }

    

    //obtener ultimo id 

    public function getId(){

        $query = $this->db->query("SELECT id_compra FROM compra ORDER BY id_compra DESC LIMIT 1");

        return $query->row();

    }

    //Descripcion de las opciones de encio

    /*

    1 todos a entraga a domcilio

    2 todos entrega en marias

    3 entregas a domicilio individual

    4 entregas en maria individual

    */

    public function saveShopping1($data){

        $orden = ($this->session->userdata('registerOrden'))?$this->session->userdata('registerOrden'):$data['orden'];

        //$msg = "";

        $dni = array_pop($data['idProducto']);

        $cantidad = array_pop($data['cantidad']);

        $this->db->trans_begin();            

        for ($i=0; $i <count($data['idProducto']) ; $i++) {

			$this->db->query("INSERT INTO compra VALUES(null,'" . $orden . "','" . $data['idProducto'][$i] . "','" . $data['cantidad'][$i] . "','" . $data['diaEntrega'] . "','" . $data['horaEntrega'] . "','" . $data['hourEntregaSpecial'] . "','" . $data['cliente'] . "','" . $data['telefono'] . "','" . $data['personaEntregar'] . "','" . $data['telefonoPersonaEntrega'] . "','" . $data['nota'] . "','" . $data['direccion'] . "','0','" . $data['geolocalizacion'] . "','" . $data['descripcionDomicilio'] . "','domicilio','0','0','0','" . $data['fecha_registro'] . "','" . $data['confirmacionDomicilio'] . "','" . $data['detalleExteriorDomicilio'] . "')");

        }

		$this->db->query("INSERT INTO compra VALUES(null,'" . $orden . "','" . $dni . "','" . $cantidad . "','" . $data['diaEntrega'] . "','" . $data['horaEntrega'] . "','" . $data['hourEntregaSpecial'] . "','" . $data['cliente'] . "','" . $data['telefono'] . "','" . $data['personaEntregar'] . "','" . $data['telefonoPersonaEntrega'] . "','" . $data['nota'] . "','" . $data['direccion'] . "','" . $data['costoEnvio'] . "','" . $data['geolocalizacion'] . "','" . $data['descripcionDomicilio'] . "','domicilio','0','0','0','" . $data['fecha_registro'] . "','" . $data['confirmacionDomicilio'] . "','" . $data['detalleExteriorDomicilio'] . "')");

        

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = array(

                'status' => 'error',

                'numOrden' => $orden

            );

        }else{

            $this->db->trans_commit();

            $msg = array(

                'status' => 'success',

                'numOrden' => $orden

            );

        }

        return $msg;

    }



    public function saveShopping2($data){

        $orden = ($this->session->userdata('registerOrden'))?$this->session->userdata('registerOrden'):$data['orden'];

        $this->db->trans_begin();      

        for ($i=0; $i <count($data['idProducto']) ; $i++) { 

            $this->db->query("INSERT INTO compra VALUES(null,'".$orden."','".$data['idProducto'][$i]."','".$data['cantidad'][$i]."','".$data['diaEntrega']."','".$data['horaEntrega']."','0','".$data['cliente']."','".$data['telefono']."','0','0','0','0','0','0','0','marias','0','0','0','".$data['fecha_registro']. "','" . $data['confirmacionDomicilio'] . "','" . $data['detalleExteriorDomicilio'] . "')");

        }

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = array(

                'status' => 'error',

                'numOrden' => $orden

            );

        }else{

            $this->db->trans_commit();

            $msg = array(

                'status' => 'success',

                'numOrden' => $orden

            );

        }

        return $msg;

    }



    public function saveShopping3($data){

        if ($this->session->userdata('registerOrden')) {

            $orden = $this->session->userdata('registerOrden');

        }else{

            $this->session->set_userdata('registerOrden',$data['orden']);

            $orden = $this->session->userdata('registerOrden');

        }

		$query = $this->db->query("INSERT INTO compra VALUES(null,'" . $orden . "','" . $data['idProducto'] . "','" . $data['cantidad'] . "','" . $data['diaEntrega'] . "','" . $data['horaEntrega'] . "','" . $data['hourEntregaSpecial'] . "','" . $data['cliente'] . "','" . $data['telefono'] . "','" . $data['personaEntregar'] . "','" . $data['telefonoPersonaEntrega'] . "','" . $data['nota'] . "','" . $data['direccion'] . "','" . $data['costoEnvio'] . "','" . $data['geolocalizacion'] . "','" . $data['descripcionDomicilio'] . "','domicilio','0','0','0','" . $data['fecha_registro'] . "','" . $data['confirmacionDomicilio'] . "','" . $data['detalleExteriorDomicilio'] . "')");

        if ($query) {

            $msg = array('status'=>'success','numOrden'=>$orden);

        }else{

            $msg =array('status'=>'error','numOrden'=>$orden);

        }

        return $msg;

    }



    public function saveShopping4($data){

        if ($this->session->userdata('registerOrden')) {

            $orden = $this->session->userdata('registerOrden');

        }else{

            $this->session->set_userdata('registerOrden',$data['orden']);

            $orden = $this->session->userdata('registerOrden');

        }

		$query = $this->db->query("INSERT INTO compra VALUES(null,'" . $orden . "','" . $data['idProducto'] . "','" . $data['cantidad'] . "','" . $data['diaEntrega'] . "','" . $data['horaEntrega'] . "','0','" . $data['cliente'] . "','" . $data['telefono'] . "','0','0','0','0','0','0','0','marias','0','0','0','" . $data['fecha_registro'] . "','" . $data['confirmacionDomicilio'] . "','" . $data['detalleExteriorDomicilio'] . "')");

        if ($query) {

            $msg = array('status'=>'success','numOrden'=>$orden);

        }else{

            $msg =array('status'=>'error','numOrden'=>$orden);

        }

        return $msg;

    }

    public function getProductResumeCustomer($id){

        $query = $this->db->query("SELECT compra.numeroOrden,productos.nombre,productos.precio,cantidad,(productos.precio*cantidad)AS subtotal,imagenes.imagen,horaEntrega,horaEntregaEspecial,costoEnvio,productos.modelo,tipoEntrega,diaEntrega,statusEnvio, baucher FROM compra INNER JOIN productos ON compra.producto = productos.id_producto INNER JOIN imagenes ON productos.id_producto = imagenes.producto WHERE compra.numeroOrden = '".$id."' GROUP BY modelo");

        return $query->result_array();

    }

    

    public function getProductResume($id){

        $query = $this->db->query("SELECT compra.numeroOrden,productos.nombre,productos.precio,cantidad,(productos.precio*cantidad)AS subtotal,imagenes.imagen,horaEntrega,horaEntregaEspecial,costoEnvio,productos.modelo,tipoEntrega,diaEntrega,statusEnvio,baucher,pagos.statusPago FROM compra INNER JOIN productos ON compra.producto = productos.id_producto INNER JOIN imagenes ON productos.id_producto = imagenes.producto INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden WHERE compra.numeroOrden = '".$id."' GROUP BY modelo");

        return $query->result_array();

    }

//  get evidencia

    public function M_getEvidence($orden){

        $query = $this->db->query("SELECT fotografia,fecha FROM evidencias WHERE noOrden = '".$orden."' ");

        return $query->result_array();

    }

//  get details productos

    public function getDetail($data){

        $query = $this->db->query("SELECT compra.numeroOrden,productos.nombre,productos.precio,cantidad,(productos.precio*cantidad)AS subtotal,imagenes.imagen,horaEntrega,horaEntregaEspecial,costoEnvio,productos.modelo,tipoEntrega,diaEntrega,statusEnvio, baucher,pagos.statusPago,pagos.tipoPago,compra.direccion,compra.caracteristicasDomicilio FROM compra INNER JOIN productos ON compra.producto = productos.id_producto INNER JOIN imagenes ON productos.id_producto = imagenes.producto  INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden WHERE compra.numeroOrden = '".$data['orden']."' AND modelo='".$data['model']."' GROUP BY modelo");

        return $query->row();

    }

    // consult if exists pay

    public function m_consultExistPay($orden){

        $query = $this->db->query("SELECT numeroOrden FROM pagos WHERE numeroOrden='".$orden."'");

        return $query->num_rows();

    }

    // get total buy product

    public function m_totalPurchaseProduct($data){

        $query = $this->db->query("SELECT id_compra,numeroOrden,producto,cantidad,productos.almacen FROM compra INNER JOIN productos ON compra.producto = productos.id_producto

WHERE numeroOrden = '".$data['noOrden']."'");

        return $query->result_array();

    }

    //Obtener datosdel cliente para guardar en pagos

    public  function getPaymentData($orden){

        $query = $this->db->query("SELECT numeroOrden,SUM((compra.cantidad*productos.precio))AS costoProducto,SUM(compra.costoEnvio)AS costoEnvio, SUM((compra.cantidad*productos.precio))+SUM(compra.costoEnvio) AS subtotal FROM compra INNER JOIN productos ON compra.producto = productos.id_producto where numeroOrden='".$orden."' GROUP BY numeroOrden");

        return $query->row();

    }

    //registrar pago

    public function registerPay($data){

        $this->db->trans_begin();



        $this->db->query("INSERT INTO pagos(id_pago,numeroOrden,montoPago,tipoPago,statusPago,nota,fechaPago) VALUES(null,'".$data['orden']."','".$data['subtotal']."','0','0','0','".$data['fecha']."')");

        $this->db->query("UPDATE compra SET statusRegistro='1' WHERE numeroOrden='".$data['orden']."'");



        if ($this->db->trans_status() === FALSE){

                $this->db->trans_rollback();

                $msg = false;

        }else{

                $this->db->trans_commit();

                $msg = true;

        }        

        return $msg;

    }



    public function validarSeguimiento($id){

        $query = $this->db->query("SELECT numeroOrden,statusRegistro FROM compra WHERE numeroOrden = '".$id."' limit 1");

        if ($query->num_rows () > 0) {

            $msg = array('login' => true, 'data' => $query->row());

        }else{

            $msg = array('login' => false);

        }

        return $msg;

    }



    public function dataClient($id){

        $query = $this->db->query("SELECT numeroOrden,nombreCliente FROM compra WHERE numeroOrden = '".$id."' limit 1");

        return $query->row();   

    }



    public function uploadBaucher($data){

        $query = $this->db->query("UPDATE compra SET baucher='".$data['file']."' where numeroOrden ='".$data['dni']."'");

        if ($query) {

            $msg = 'success';

        }else{

            $msg = 'error';

        }

        return $msg;

    }



    public function updatePayment($dni){

        $this->db->trans_begin();



        $this->db->query("UPDATE compra SET statusRegistro='1',statusRegistro='1',baucher='payPaypal.jpg' where numeroOrden ='".$dni."';");



        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = 'error';

        }

        else{

            $this->db->trans_commit();

            $msg = 'success';

        }

        return $msg;

    }



	public function getDeliveryTimes(){
		$query = $this->db->query("select id_horario, horaInicio, horaFin, grupo, activo, ubicacion, costoEnvio from horario_entrega where activo = 1 order by grupo, STR_TO_DATE(horaInicio, '%H:%i')");
		return $query->result_array();
	}






}