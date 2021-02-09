<?php defined('BASEPATH') OR exit('Permiso denegado');

/*
        Fecha      Version 
        04-02-18   ADG0.0.1  
        Se agrega funcion m_addUnidadMedida para agregar las unidades de medida
        Se agrega funcion m_getUnidadMedida para listar las unidades de medida
        Se agrega funcion m_updateUnidadMedida para Actualizar las unidades de medida 
        
        Se agrega funcion m_getInventario para listar los productos en inventario
        Se agrega funcion m_updateInventario para Actualizar los productos en inventario
        
        Se agrega funcion m_getIncidencia para listar las incidencias en los productos de almacen.
        Se agrega funcion m_updateIncidencia para Actualizar las incidencias en los productos de almacen.  
*/




class M_admin extends CI_Model {

    private $fecha;

	public function __construct(){

        parent::__construct();

        $this->fecha = date('Y-m-d H:m:s');

    }

    // estadistica

    public function statistic(){

        $orders = $this->db->query("SELECT COUNT(DISTINCT numeroOrden) AS pedidos FROM compra WHERE statusRegistro = '1'");

        $confirmados = $this->db->query("SELECT COUNT(DISTINCT pagos.numeroOrden) as confirmados from compra INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden");

        $entregados = $this->db->query("SELECT COUNT(DISTINCT numeroOrden) AS entregados FROM compra WHERE statusEnvio = '3'");

        $ruta = $this->db->query("SELECT COUNT(DISTINCT numeroOrden) AS ruta FROM compra WHERE statusEnvio = '2'");

        $marias = $this->db->query("SELECT COUNT(DISTINCT compra.numeroOrden) AS marias FROM compra INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden WHERE tipoEntrega = 'marias'");

        $domicilio = $this->db->query("SELECT COUNT(DISTINCT compra.numeroOrden) AS domicilio FROM compra INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden WHERE tipoEntrega = 'domicilio'");

        $data = array(

            'pedidos' => $orders->row(),

            'confirmados' => $confirmados->row(),

            'entregados' => $entregados->row(),

            'ruta' => $ruta->row(),

            'marias' => $marias->row(),

            'domicilio' => $domicilio->row()

        );

        return $data;

    }

    // end estadistica

    public function obtenerCompras(){

        $query = $this->db->query("
						SELECT 
							GROUP_CONCAT(productos.modelo SEPARATOR '<br>') AS modelo,
							GROUP_CONCAT(compra.cantidad SEPARATOR '<br>') AS allBuy,
							GROUP_CONCAT(compra.geolocalizacion SEPARATOR ';') AS location,
							GROUP_CONCAT(compra.producto SEPARATOR '<br>') AS productoID,
							productos.nombre,
							compra.*,
							pagos.montoPago,
							pagos.tipoPago,
							pagos.statusPago,
							pagos.nota,
							pagos.fechaPago
						FROM 
							compra 
							INNER JOIN productos ON compra.producto = productos.id_producto 
							INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden 
						WHERE statusRegistro='1' 
						GROUP BY compra.numeroOrden
						");

        return $query->result_array();

    }



    public function getBuySpecific($data){

        $query = $this->db->query("SELECT * FROM compra WHERE numeroOrden = '".$data['orden']."' AND producto = '".$data['model']."' ");

        return $query->row();

    }

     public function M_deleteItemBuy($numberOrder){

        $this->db->trans_begin();

        $this->db->query("DELETE FROM compra WHERE numeroOrden='".$numberOrder."' ");

        $this->db->query("DELETE FROM pagos WHERE numeroOrden ='".$numberOrder."' ");

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = false;

        }else{

            $this->db->trans_commit();

            $msg = true;

        }

        return $msg;

    }

// actualizar datos de los clientes

    public function updateDataClient($data){

        $query = $this->db->query("UPDATE compra set diaEntrega= '".$data['deliverDay']."',horaEntrega = '".$data['deliverHour']."',nombreCliente='".$data['nombre']."',telefonoCliente='".$data['phone']."',nota='".$data['nota']."' WHERE numeroOrden='".$data['orden']."'");

        return ($query)?true:false;

    }

// lista de los productos

    public function getProducts(){

        $query = $this->db->query("SELECT productos.*,GROUP_CONCAT(imagenes.imagen SEPARATOR ',') as imagenes,GROUP_CONCAT(imagenes.id_imagenes SEPARATOR ',') AS id_imagenes FROM productos INNER JOIN imagenes ON productos.id_producto = imagenes.producto group by id_producto");

        return $query->result_array();

    }

// lista descripcion 

    public function getDescription(){

        $query = $this->db->query("SELECT * FROM descripcion;");

        return $query->result_array();

    }

//  registra productos

    public function insertProducts($data){

        $this->db->trans_begin();



        $this->db->query("INSERT INTO productos(id_producto,descripcion,nombre,modelo,precio,publicar,almacen) VALUES(null,'".$data['description']."','".$data['name']."','".$data['model']."','".$data['price']."','".$data['public']."','".$data['almacen']."')");

        $idRegister = $this->db->insert_id();

        for ($i=0; $i <count($data['imagen']) ; $i++) {

            $this->db->query("INSERT INTO imagenes(id_imagenes,producto,imagen,fecha) VALUES(NULL,'".$idRegister."','".$data['imagen'][$i]."','".$this->fecha."')");

        }

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = array(

                'data' => $data,

                'status' => 'error'

            );

        }else{

            $this->db->trans_commit();

            $msg = array(

                'data' => $data,

                'idInsert' => $idRegister,

                'status' => 'success'

            );

        }

        return $msg;

    }

// Actualizar productos

    public function updateProducts($data){

        $query = $this->db->query("UPDATE productos SET descripcion='".$data['description']."',nombre='".$data['name']."',modelo='".$data['model']."',precio='".$data['price']."',publicar='".$data['public']."',almacen='".$data['almacen']."' WHERE id_producto='".$data['dni']."' ");

        return ($query)?true:false;



    }



    public function m_addNewPicture($dni,$picture){

        $this->db->trans_begin();

        for ($i=0; $i < count($picture['imagen']) ; $i++) {

            $this->db->query("INSERT INTO imagenes(id_imagenes,producto,imagen,fecha) VALUES(NULL,'".$dni."','".$picture['imagen'][$i]."','".$this->fecha."')");

            $dniInsert[$i] = $this->db->insert_id();

        }

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = array('status' => 'error','picture' => $picture['error']);

        }else{

            $this->db->trans_commit();

            $msg = array('status' => 'success','picture' => $picture['imagen'],'idInsert' => $dniInsert);

        }

        return $msg;

    }

//  Eliminar imagen producto

    public  function dropPictureProduct($dni){

        $query = $this->db->query("DELETE FROM imagenes WHERE id_imagenes ='".$dni."'");

        return ($query)?true:false;

    }

//  Eliminar producto

    public  function dropProduct($noOrden){

        $query = $this->db->query("DELETE FROM productos WHERE id_producto ='".$noOrden."'");

        return ($query)?true:false;

    }

// ****************************** metodos pagos ************************************************************    

    public function obtenerPagos(){

        $query = $this->db->query("SELECT compra.numeroOrden,diaEntrega,horaEntrega,horaEntregaEspecial,nombreCliente, telefonoCliente,montoPago,tipoPago,statusPago,statusEnvio,pagos.nota,fechaPago,baucher FROM compra INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden GROUP BY numeroOrden");

        return $query->result_array();

    }

    public function updatePay($data,$cuantity){

        $this->db->trans_begin();

        for ($i=0; $i < count($cuantity); $i++) {

            $this->db->query("UPDATE productos SET almacen = (almacen-'".$cuantity[$i]['cantidad']."') WHERE id_producto = '".$cuantity[$i]['producto']."'");

        }

        $this->db->query("UPDATE pagos SET statusPago='".$data['status']."' WHERE numeroOrden='".$data['noOrden']."'");

        $this->db->query("UPDATE compra SET statusEnvio= '1' WHERE numeroOrden ='".$data['noOrden']."' ");



        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $status = false;

        }else{

            $this->db->trans_commit();

            $status = true;

        }

        return $status;

    }

// ****************************** metodos compras incompletas ************************************************************

    public function getBuyIncompleted(){

        $query = $this->db->query("SELECT id_compra,numeroOrden,nombreCliente,telefonoCliente,GROUP_CONCAT(productos.modelo SEPARATOR ',') AS modelo,diaEntrega,SUM((compra.cantidad*productos.precio))+SUM(compra.costoEnvio) AS subtotal,fechaCaptura FROM compra INNER JOIN productos ON compra.producto = productos.id_producto WHERE statusRegistro = '0' GROUP BY numeroOrden");

        return  $query->result_array();

    }

    public function m_freePayment($data){

        $this->db->trans_begin();



        $this->db->query("INSERT INTO pagos(id_pago,numeroOrden,montoPago,tipoPago,statusPago,nota,fechaPago) VALUES(NULL,'".$data['dni']."','".$data['subtotal']."','0','0','0','".$this->fecha."')");

        $this->db->query("UPDATE compra SET statusRegistro='1' WHERE numeroOrden = '".$data['dni']."'");



        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = false;

        }

        else{

            $this->db->trans_commit();

            $msg = true;

        }

        return $msg;

    }

    public function M_dropBuyIncompleted($noOrden){

        $query = $this->db->query("DELETE FROM compra WHERE numeroOrden='".$noOrden."' ");

        return ($query)?true:false;

    }

// **************************************** Methods users ******************************************************************

    public function m_getUsers(){

        $query = $this->db->query("SELECT * FROM usuarios");

        return $query->result_array();

    }

    public function m_addUser($data){

        $query = $this->db->query("INSERT INTO usuarios(id_user,tipo_usuario,nombre,apellido_pat,apellido_mat,email,telefono,contraseña) VALUES(NULL,'".$data['typeUser']."','".$data['name']."','".$data['firstName']."','".$data['lastName']."','".$data['email']."','".$data['phone']."','".$data['pass']."')");

        return ($query)?true:false;

    }

    public function m_updateUser($data){

        $query = $this->db->query("UPDATE usuarios SET tipo_usuario = '".$data['typeUser']."',nombre = '".$data['name']."',apellido_pat = '".$data['firstName']."',apellido_mat = '".$data['lastName']."',email = '".$data['email']."',telefono = '".$data['phone']."',contraseña = '".$data['pass']."' WHERE id_user = '".$data['dni']."'");

        return ($query)?true:false;

    }

// **************************************** Methods routes ******************************************************************

    public function get_UserDriver(){

        $query = $this->db->query("SELECT * FROM usuarios WHERE tipo_usuario = 'Chofer'");

        return  $query->result_array();

    }

    public function addRoute($data){

        $query = $this->db->query("INSERT INTO rutas(id_rutas,chofer,nombre,ubicacion,nota) VALUES(null,'".$data['chofer']."','".$data['nameRoute']."','".$data['location']."','".$data['note']."')");

        if ($query) {

            $data = array(

                'status' => 'success',

                'idRegister'=>$this->db->insert_id()

            );

            $query2 = $this->db->query("SELECT rutas.*,usuarios.nombre as user,usuarios.apellido_pat,usuarios.apellido_mat FROM rutas INNER JOIN usuarios on rutas.chofer = usuarios.id_user WHERE id_rutas='".$data['idRegister']."'");

            $data['response'] = $query2->row();

        }else{

             $data = array(

                'status' => 'success',

                'idRegister'=>000

            );

        }

        return $data;

    }

    public function get_Route(){

        $query = $this->db->query("SELECT rutas.*,usuarios.nombre AS user,usuarios.apellido_pat,usuarios.apellido_mat FROM rutas INNER JOIN usuarios on rutas.chofer = usuarios.id_user;");

        return  $query->result_array();

    }

    public function m_listdeliver(){

        $query = $this->db->query("SELECT id_compra,compra.numeroOrden,diaEntrega,horaEntrega,horaEntregaEspecial,nombreCliente,telefonoCliente,direccion,geolocalizacion,entrega.*,

rutas.nombre AS nombreRuta,pagos.statusPago FROM compra LEFT JOIN entrega on compra.numeroOrden = entrega.orden LEFT join rutas on entrega.ruta = rutas.id_rutas INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden WHERE tipoEntrega = 'domicilio' AND pagos.statusPago = '1'  group by compra.numeroOrden;");

        return $query->result_array();

    }

    public function insertDeliver($data){

        $this->db->trans_begin();

        for ($i=0; $i <count($data['order']) ; $i++) {

            $this->db->query("INSERT INTO entrega(id_entrega,ruta,orden) VALUES(NULL,'".$data['rute']."','".$data['order'][$i]."')");

        }

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = array('status' => 'error');

        }else{

            $this->db->trans_commit();

            $msg = array('status' => 'success');

        }

        return $msg;

    }



    public function M_activeEntrega($order){

        $query = $this->db->query("UPDATE compra SET statusEnvio = '3' WHERE numeroOrden = '".$order."' ");

        return ($query)?true:false;

    }



	// **************************************** Delivery times functions ***********************************************

	public function getDeliveryTimes(){
		$query = $this->db->query("select id_horario, horaInicio, horaFin, grupo, activo, ubicacion, costoEnvio from horario_entrega order by grupo, STR_TO_DATE(horaInicio, '%H:%i');");
		return $query->result_array();
	}

	public function insertDeliveryTime($data)
	{
		$query = $this->db->query(
			"insert into horario_entrega (horaInicio, horaFin, grupo, activo, ubicacion, costoEnvio) values('" . $data["startTime"] . "','" . $data["endTime"] . "','" . $data["group"] . "'," . $data["active"] . ",'" . $data['location'] . "'," . $data['deliveryCost'] . ")"
		);

		return ($query) ? true : false;
	}

	public function updateDeliveryTime($data)
	{

		$query = $this->db->query(
			"update horario_entrega set horaInicio='" . $data["startTime"] . "', horaFin='" . $data["endTime"] . "',grupo='" . $data["group"] . "',activo=" . $data["active"] . ", ubicacion = '" . $data['location'] . "', costoEnvio = " . $data['deliveryCost'] . " where id_horario = " . $data["id"]
		);

		return ($query) ? true : false;

	}

	public function deleteDeliveryTime($data)
	{

		$query = $this->db->query(
			"delete from horario_entrega where id_horario = " . $data["id"]
		);

		return ($query) ? true : false;

	}



	// **************************************** Products sorting ***********************************************

	public function getProductsSorted(){
		$query = $this->db->query("
		SELECT 
			prod.id_producto,
			prod.nombre,
			prod.modelo,
			prod.posicion_app orden,
			psi.imagen
		FROM
			productos prod
			inner join products_single_image psi on (prod.id_producto = psi.id_producto)
		WHERE prod.publicar = 'si'
		ORDER BY prod.posicion_app , prod.id_producto
		");
		return $query->result_array();
	}


	// **************************************** Products sorting ***********************************************

	public function updateSortedProducts($sortedProducts)
	{
		$this->db->trans_begin();

		try {

			foreach ($sortedProducts as $product) {
				$this->db->query("update productos set posicion_app = $product[order] where id_producto = $product[id]");
			}

			$this->db->trans_commit();

			return true;

		} catch (Exception $e) {
			$this->db->trans_rollback();

			return false;
		}


	}
/*ADG0.0.1 Inicia Cambio*/
       public function m_getUnidadMedida(){
		$query = $this->db->query("
		select * from cat_udm order by descripcion");
		return $query->result_array();
	}
    public function m_updateUnidadMedida($data){

        $query = $this->db->query("UPDATE cat_udm SET clave = '".$data['clave']."',descripcion = '".$data['nameUnidad']."',activo = '".$data['activo']."' WHERE id_udm = '".$data['idUDM']."'");

        return ($query)?true:false;

    }
    public function m_addUnidadMedida($data){

        $query = $this->db->query("INSERT INTO cat_udm (clave,descripcion) VALUES('".$data['clave']."','".$data['descripcion']."')");

        return ($query)?true:false;

    }
    public function m_getInventario(){
		$query = $this->db->query("
		select * from inventario order by descripcion");
		return $query->result_array();
	}
    
    public function m_getIncidencia(){
		$query = $this->db->query("
		select * from incidencia order by echa_alta");
		return $query->result_array();
	}

/*ADG0.0.1 Finaliza Cambio*/

}