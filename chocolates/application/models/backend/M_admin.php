<?php defined('BASEPATH') OR exit('Permiso denegado');

/*
        Fecha      Version 
        04-02-18   ADG0.0.1  
        Se agrega funcion m_addUnidadMedida para agregar las unidades de medida
        Se agrega funcion m_getUnidadMedida para listar las unidades de medida
        Se agrega funcion getUnidadMedida para listar las unidades de medida activas
        Se agrega funcion m_updateUnidadMedida para Actualizar las unidades de medida 
        
        
        Se agrega funcion m_addInventario para agregar los materiales en inventario
        Se agrega funcion m_getInventario para listar los materiales en inventario
        Se agrega funcion getInventario para listar los materiales en inventario activos
        Se agrega funcion m_updateInventario para Actualizar los materiales en inventario
        
        Se agrega funcion m_addIncidencia para agregar las incidencias en los materiales de almacen.
        Se agrega funcion m_getIncidencia para listar las incidencias en los materiales de almacen.
        Se agrega funcion m_updateIncidencia para Actualizar las incidencias en los materiales de almacen.  
        
        Se agrega funcion m_addIngredienteProducto para agregar los materiales(materia prima) para hacer los productos
        Se agrega funcion m_getIngredienteProducto para listar los materiales(materia prima) para hacer los productos
        Se agrega funcion m_updateIngredienteProducto para Actualizar los materiales(materia prima) para hacer los productos
        IngredienteProducto
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
							pagos.fechaPago,
                            r.nombre  chofer
						FROM 
							compra 
							INNER JOIN productos ON compra.producto = productos.id_producto 
							INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden 
                             LEFT JOIN entrega e ON compra.numeroOrden =  e.orden
                             LEFT JOIN  rutas r ON e.ruta = r.id_rutas
						WHERE statusRegistro='1' 
						AND pagos.statusPago = '1'
						GROUP BY compra.numeroOrden
						");

        return $query->result_array();

    }
	 public function obtenerComprasSinEntregar(){

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
							pagos.fechaPago,
                            r.nombre  chofer
						FROM 
							compra 
							INNER JOIN productos ON compra.producto = productos.id_producto 
							INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden 
                             LEFT JOIN entrega e ON compra.numeroOrden =  e.orden
                             LEFT JOIN  rutas r ON e.ruta = r.id_rutas
						WHERE statusRegistro='1' 
                        and compra.statusEnvio<>'3'
						AND pagos.statusPago = '1'
						AND r.nombre  IS NULL
						GROUP BY compra.numeroOrden;
						");

        return $query->result_array();

    }
	
	 public function obtenerComprasRuta(){

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
							pagos.fechaPago,
                            r.nombre  chofer
						FROM 
							compra 
							INNER JOIN productos ON compra.producto = productos.id_producto 
							INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden 
                             LEFT JOIN entrega e ON compra.numeroOrden =  e.orden
                             LEFT JOIN  rutas r ON e.ruta = r.id_rutas
						WHERE statusRegistro='1' 
                        and compra.statusEnvio<>'3'
						AND pagos.statusPago = '1'
						AND r.nombre  <>''
						GROUP BY compra.numeroOrden;
						");

        return $query->result_array();

    }
	
	 public function obtenerComprasSinPagar(){

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
							pagos.fechaPago,
                            r.nombre  chofer
						FROM 
							compra 
							INNER JOIN productos ON compra.producto = productos.id_producto 
							INNER JOIN pagos ON compra.numeroOrden = pagos.numeroOrden 
                             LEFT JOIN entrega e ON compra.numeroOrden =  e.orden
                             LEFT JOIN  rutas r ON e.ruta = r.id_rutas
						WHERE statusRegistro='1' 
                        
						AND pagos.statusPago = '0'
						GROUP BY compra.numeroOrden;
						");

        return $query->result_array();

    }



    public function getBuySpecific($data){

        $query = $this->db->query("SELECT * FROM compra WHERE numeroOrden = '".$data['orden']."' AND producto = '".$data['model']."' ");

        return $query->row();

    }

     public function M_deleteItemBuy($numberOrder){

        $this->db->trans_begin();
/*ADG0.0.1 Inicia cambio , ya no se eliminan las ordenes de  compra ni los pagos, solo se cancelan (status 5)*/
		 $this->db->query("UPDATE compra SET statusRegistro = 5 WHERE numeroOrden='".$numberOrder."' ");
		 $this->db->query("UPDATE pagos SET statusPago = 5 WHERE numeroOrden='".$numberOrder."' ");
		 /*
        $this->db->query("DELETE FROM compra WHERE numeroOrden='".$numberOrder."' ");
        $this->db->query("DELETE FROM pagos WHERE numeroOrden ='".$numberOrder."' ");
		 */

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
// Duplica datos del numero de Orden	
	public function duplicaOrden($data){
		
		
		$orden= substr(('A'.substr($data['orden'],6).date("His")), 0, 9);
			
		//echo ($data);
		//echo ($o.'p');
        $query = $this->db->query(" insert  into compra 
                        SELECT 
							null,
							'".$orden."',
							producto,
							cantidad,
                            '".$data['diaEntrega']."',
                            '".$data['horaEntrega']."',
                            horaEntregaEspecial,
                            nombreCliente,
                            telefonoCliente,
                            personaEntrega,
                            telefonoEntrega,
                            nota,
                            direccion,
                            costoEnvio,
                            geolocalizacion,
                            caracteristicasDomicilio,
                            tipoEntrega,
                            statusEnvio,
                            statusRegistro,
                            baucher,
                            fechaCaptura,
                            confirmarDomicilio,
                            detallesExteriorDomicilio,
							0,
							imagenDireccion
						FROM 
							compra  WHERE numeroOrden='".$data['orden']."' ");

       

        if ($query) {
			 $query = $this->db->query(" insert  into pagos 
                        SELECT 
							null,
							'".$orden."',
							montoPago,
                            tipoPago,
                            statusPago,
                            nota,
                            fechaPago
						FROM 
							pagos  WHERE numeroOrden='".$data['orden']."' ");
			$query = $this->db->query("UPDATE compra SET statusRegistro = 5 WHERE numeroOrden='".$data['orden']."' ");
			$query = $this->db->query("UPDATE pagos SET statusPago = 5 WHERE numeroOrden='".$data['orden']."' ");
			
			if ($query) {
				 $msg = array('status'=>'success','numOrden'=>$orden);
			}
			else{
				$msg =array('status'=>'error','numOrden'=>$data['orden']);
				
			}

           

        }else{

            $msg =array('status'=>'error','numOrden'=>$data['orden']);

        }

        return $msg;


    }

// lista de los productos

    public function getProducts(){

        $query = $this->db->query("SELECT productos.*,GROUP_CONCAT(imagenes.imagen SEPARATOR ',') as imagenes,GROUP_CONCAT(imagenes.id_imagenes SEPARATOR ',') AS id_imagenes FROM productos INNER JOIN imagenes ON productos.id_producto = imagenes.producto group by id_producto");

        return $query->result_array();

    }
public function getProducts_id($id_producto){

        $query = $this->db->query("SELECT productos.*,GROUP_CONCAT(imagenes.imagen SEPARATOR ',') as imagenes,GROUP_CONCAT(imagenes.id_imagenes SEPARATOR ',') AS id_imagenes 
		FROM productos 
		INNER JOIN imagenes ON productos.id_producto = imagenes.producto 
		where productos.id_producto ='{$id_producto}' group by id_producto");

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

    	//echo json_encode($data);

        $this->db->query("INSERT INTO productos(id_producto,descripcion,nombre,modelo,precio,publicar,almacen) VALUES(null,'".$data['description']."','".$data['name']."','".$data['model']."','".$data['price']."','".$data['public']."','".$data['almacen']."')");

        $idRegister = $this->db->insert_id();

        for ($i=0; $i <count($data['imagen']) ; $i++) {

            $this->db->query("INSERT INTO imagenes(id_imagenes,producto,imagen,fecha) VALUES(NULL,'".$idRegister."','".$data['imagen'][$i]."','".$this->fecha."')");

        }
/*ADG0.0.1 Inicia cambio*/
        /*for ($i=0; $i <count($data['material']) ; $i++) {
            $this->db->query("INSERT INTO ingrediente_producto(id_producto,id_item,cantidad) VALUES(NULL,'".$idRegister."','".$data['id_item'][$i]."','".$date['cantidad'][$i]."')");
        }*/
/*ADG0.0.1 Finaliza cambio*/

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
		
		
		$query = $this->db->query("SELECT 
							inprod.id_item ,
                            sum(inicio.cantidad *( inprod.cantidad )) sumacantidad ,
                            inicio.diaEntrega,
                            inicio.horaEntrega
					FROM 
						(SELECT com.diaEntrega,com.numeroOrden, prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos,com.horaEntrega
						FROM compra com, 
								productos prod
						WHERE 	com.producto =prod.id_producto 
								AND com.numeroOrden='".$data['noOrden']."' 
								GROUP BY com.producto 
								)inicio 
					INNER JOIN ingrediente_producto inprod
							ON inicio.producto=inprod.id_producto
					LEFT JOIN inventario inv
							ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
							group by inprod.id_item;");

        $item =  $query->result_array();
		
		
		if (empty($item)) {
			$MSJ= '<script type="text/javascript">alert("NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO CON LOS PRODUCTOS CON ESTE NUMERO DE ORDEN")</script>';
		}
		else{
			
			foreach ($item as $value) {
				$q = $this->db->query("	SELECT count(id_item) num
										FROM  pendiente
										WHERE  id_item ='".$value['id_item']."'  
											AND diaEntrega ='".$value['diaEntrega']."' 
											AND  horaEntrega ='".$value['horaEntrega']."';");
				 $count =  $q->result_array();
					
				foreach ($count as $c) {
					
				
				if ($c['num']==0){
					 $this->db->query("INSERT  INTO  pendiente (id_item,cantidad, diaEntrega, horaEntrega)
					 					VALUES('".$value['id_item']."' ,'".$value['sumacantidad']."','".$value['diaEntrega']."' ,'".$value['horaEntrega']."'    );");
				}else{
					$this->db->query("UPDATE pendiente 
										SET cantidad = cantidad +".$value['sumacantidad']."
        								WHERE id_item = '".$value['id_item']."' 
										AND diaEntrega ='".$value['diaEntrega']."' 
										AND  horaEntrega = '".$value['horaEntrega']."';");
					
				}

					
				}
				
				

			
			}
			
		}
	

		
		
		
		/*$this->db->query("UPDATE pendiente as t1
        					INNER JOIN	(SELECT 
												inprod.id_item ,
												sum(inicio.cantidad *( inprod.cantidad )) sumacantidad ,
												inicio.diaEntrega,
												inicio.horaEntrega
										FROM 
											(SELECT com.diaEntrega,com.numeroOrden, prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos,com.horaEntrega
											FROM compra com, 
													productos prod
											WHERE 	com.producto =prod.id_producto 
													AND com.numeroOrden= ='".$data['noOrden']."' 
													AND com.statusPreparacion=0
													GROUP BY com.producto 
													)inicio 
										INNER JOIN ingrediente_producto inprod
												ON inicio.producto=inprod.id_producto
										LEFT JOIN inventario inv
												ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
												group by inprod.id_item) as t2
							ON t1.id_item = t2.id_item  AND t1.diaEntrega = t2.diaEntrega AND  t1.horaEntrega = t2.horaEntrega
							SET t1.cantidad = t1.cantidad - t2.sumacantidad ; ");
*/


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


	public function removeDeliveryAssignment($deliveryAssignmentId){
		$query = $this->db->query("delete from entrega where id_entrega = ". $deliveryAssignmentId);
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


	// **************************************** Deliveries full map***********************************************

	public function getAllDeliveriesToFullMap(){
		$query = $this->db->query("
			SELECT 
				entrega.ruta,
				compra.numeroOrden,
				compra.producto,
				compra.cantidad,
				compra.diaEntrega,
				compra.horaEntrega,
				compra.nombreCliente,
				compra.telefonoCliente,
				compra.direccion,
				compra.geolocalizacion,
				compra.caracteristicasDomicilio,
				compra.statusEnvio,
				usuarios.nombre repartidorNombre,
				usuarios.email  repartidorEmail  
			FROM entrega 
			INNER JOIN compra ON entrega.orden = compra.numeroOrden
			INNER JOIN rutas ON entrega.ruta = rutas.id_rutas
			INNER JOIN usuarios ON rutas.chofer = usuarios.id_user
			GROUP BY numeroOrden
			ORDER BY STR_TO_DATE(compra.diaEntrega, '%Y-%m-%d') ASC
		");
		return $query->result_array();
	}
/* ADG0.0.1  Inicia Cambio*/
/*******************************UNIDAD DE MEDIDA******************************************************/
    
    public function m_getUnidadMedida(){
		$query = $this->db->query("
		select *
        from cat_udm order by descripcion");
		return $query->result_array();
	}
    public function get_UnidadMedida(){

        $query = $this->db->query("
        select *
        from cat_udm 
        WHERE 
        activo = 1
        order by descripcion");
        

        return  $query->result_array();

    }
    
    public function m_addUnidadMedida($data){

        $query = $this->db->query("INSERT INTO cat_udm (clave,descripcion) VALUES('".$data['clave']."','".$data['descripcion']."')");
        
        
        return ($query)?true:false;

    }
    
    public function m_updateUnidadMedida($data){

        $query = $this->db->query("UPDATE cat_udm SET   clave = '".$data['clave']."',
														descripcion = '".$data['descripcion']."',
														activo = '".$data['activo']."' 
														WHERE id_udm = '".$data['idUDM']."'");

        return ($query)?true:false;

    }
/*******************************INVENTARIO******************************************************/
    public function m_getInventario(){
		$query = $this->db->query("
		SELECT 
		inv.id_udm,
			inv.id_item ,
            inv.descripcion,
            udm.descripcion udm, 
            inv.cantidad_fisica,
            inv.cantidad_logica,
            inv.maximo,
            inv.minimo,
			inv.detalle_prepara,
            inv.fecha_alta,
            inv.fecha_actualizacion,
			inv.ingrediente,
			inv.activo status,
            CASE
        WHEN inv.activo =1 THEN 'Activo'
        WHEN inv.activo = 0 THEN 'Inactivo'
        END activo
            
        FROM 
            inventario inv, 
            cat_udm udm
        where inv.id_udm=udm.id_udm
        order by inv.descripcion");
		return $query->result_array();
	}
    public function getInventario(){
		$query = $this->db->query("
		SELECT *
        FROM 
            inventario 
        where activo=1
        order by descripcion");
		return $query->result_array();
	}
	 public function getInventarioProd($idproducto){
		$query = $this->db->query("
		SELECT inv.*,
		'".$idproducto."' id_producto
		
        FROM 
            inventario inv
        where inv.activo=1
        order by inv.descripcion");
		return $query->result_array();
	}
    
    
    public function m_addInventario($data){

        $query =  $this->db->query("INSERT  INTO 	inventario 	(descripcion,cantidad_fisica,maximo,minimo,id_udm,ingrediente,detalle_prepara) 
													VALUES		('".$data['descripcion']."',
																'".$data['cantidad_fisica']."',
																'".$data['maximo']."',
																'".$data['minimo']."',
																'".$data['id_udm']."',
																'".$data['ingrediente']."',
																'".$data['DetallePepara']."' )");
		/* $query =  $this->db->query("INSERT  INTO 	inventario 	(descripcion,cantidad_fisica,maximo,minimo,id_udm) 
													VALUES		('".$data['descripcion']."',
																'".$data['cantidad_fisica']."',
																'".$data['maximo']."',
																'".$data['minimo']."',
																'".$data['id_udm']."' )");*/

        return ($query)?true:false;

    }
    
    
    public function m_updateInventario($data){
		

        $query = $this->db->query("UPDATE inventario SET 	descripcion = '".$data['descripcion']."',
															cantidad_fisica = '".$data['cantidad_fisica']."',
															activo = '".$data['activo']."',
															id_udm = '".$data['id_udm']."',
															maximo = '".$data['maximo']."',
															minimo = '".$data['minimo']."',
															ingrediente = '".$data['ingrediente']."',
															detalle_prepara = '".$data['DetallePepara']."',
															fecha_actualizacion= NOW()
														WHERE id_item = '".$data['id_item']."'");
		 /*$query = $this->db->query("UPDATE inventario SET 	descripcion = '".$data['descripcion']."',
															cantidad_fisica = '".$data['cantidad_fisica']."',
															activo = '".$data['activo']."',
															id_udm = '".$data['id_udm']."',
															maximo = '".$data['maximo']."',
															minimo = '".$data['minimo']."',
															fecha_actualizacion= NOW()
														WHERE id_item = '".$data['id_item']."'");*/

        return ($query)?true:false;

    }
    
/*******************************INCIDENCIAS******************************************************/    
    public function m_getIncidencia(){
		$query = $this->db->query("
		SELECT 
            inv.descripcion id_item,
            inci.detalles detalle,
            inci.cantidad,
            inci.fecha_alta
        FROM 
            incidencia inci,
            inventario inv
        WHERE 
            inci.id_item=inv.id_item
        order by inci.fecha_alta");
		return $query->result_array();
	}

    public function m_addIncidencia($data){
        
        $query = $this->db->query("INSERT INTO incidencia (id_item,detalles,cantidad) VALUES('".$data['id_item']."','".$data['detalle']."','".$data['cantidad']."')");
		////////////////Se disminulle la cantidad del material dependiendo las incidencias//////////////////
		$query = $this->db->query("UPDATE inventario 
        SET cantidad_logica = cantidad_fisica - '".$data['cantidad']."' ,
			cantidad_fisica = cantidad_fisica - '".$data['cantidad']."'
        WHERE id_item = '".$data['id_item']."'");
        
        return ($query)?true:false;

    }
    
    public function m_updateIncidencia($data){

        $query = $this->db->query("UPDATE incidencia SET id_item = '".$data['id_item']."',cantidad = '".$data['cantidad']."',activo = '".$data['activo']."',detalles = '".$data['detalles']."' WHERE id_incidencia = '".$data['id_incidencia']."'");

        return ($query)?true:false;

    }
    /*******************************INGREDIENTES PRODUCTOS******************************************************/    
    public function m_getIngredienteProducto(){

        $query = $this->db->query("
        SELECT  prod.nombre    producto,
				inv.descripcion     material,
                inprod.cantidad,
				CASE
					WHEN inprod.activo =1 THEN 'Activo'
					WHEN inprod.activo = 0 THEN 'Inactivo'
				END activo
        FROM    ingrediente_producto    inprod,
                productos               prod,
                inventario              inv
        WHERE 
                inprod.id_producto  = prod.id_producto and
                inprod.id_item      = inv.id_item
		order by prod.descripcion
        ;");
		 
        return $query->result_array();

    }
    public function getIngredienteProducto(){

        $query = $this->db->query("
        SELECT  prod.nombre    producto,
				inv.descripcion     material,
                inprod.cantidad,
                inprod.activo
        FROM    ingrediente_producto    inprod,
                productos               prod,
                inventario              inv
        WHERE 
                inprod.id_producto  = prod.id_producto and
                inprod.id_item      = inv.id_item      and
                inprod.activo =1 
		order by prod.descripcion
        ;");
        return $query->result_array();

    }
	public function get_Products(){

        $query = $this->db->query("
        SELECT  id_producto,
				nombre    descripcion
        FROM    
                productos  
		order by nombre
        ;");
        return $query->result_array();

    }
	public function m_addIngredientes($data){
		//return $this->db->insert("ingrediente_producto",array("","id_item" => $key, "id_producto" => $key, "cantidad" => $key,""));
		//echo json_encode($data);
		
        $query = $this->db->query("INSERT INTO ingrediente_producto (id_item,id_producto,cantidad)  VALUES('".$data['id_item']."','".$data['id_producto']."','".$data['cantidad']."')");
		
        return ($query)?true:false;

    }
	
	public function m_addSubInv($data){
		//echo json_encode($data);
		//

        $query = $this->db->query("INSERT INTO subinventario (id_Item, cantidad, id_ItemIngrediente) VALUES ('".$data['idItem']."','".$data['cantidad']."','".$data['id_ItemIngrediente']."');");
		
        return ($query)?true:false;

    }
	
	public function get_DetallesProducts($idproducto){
		//echo json_encode($idproducto);
		$query = $this->db->query("SELECT  
		'".$idproducto."' id_producto,
		inv.id_item  ,
				inv.descripcion     material,
                inprod.cantidad,
                inprod.activo
        FROM    ingrediente_producto    inprod,
                productos               prod,
                inventario              inv
        WHERE 
                inprod.id_producto  = prod.id_producto and
                inprod.id_item      = inv.id_item      and
                inprod.activo =1 					and
				 inprod.id_producto  = '".$idproducto."' ");
        
        return $query->result_array();

    }
	
	public function getIngProd($idItem){
		
		$query = $this->db->query("SELECT subinventario.* ,inventario.descripcion,inventario.detalle_prepara
FROM  inventario
INNER JOIN  subinventario ON inventario.id_item = subinventario.id_ItemIngrediente
WHERE subinventario.id_Item= '".$idItem."'  ; ");
        
        return $query->result_array();

    }
	
	public function getIngInv($id_item){
		//echo json_encode($idproducto);
		$query = $this->db->query("SELECT *
FROM  inventario

WHERE id_Item= '".$id_item."'  ; ");
        
        return $query->result_array();

    }
	
	public function getIng(){
		//echo json_encode($idproducto);
		$query = $this->db->query("SELECT * FROM inventario where ingrediente=1; ");
        
        return $query->result_array();

    }
	
	
		public  function m_dropDetalleProd($data){
			//echo json_encode($data);

        $query = $this->db->query("DELETE FROM ingrediente_producto WHERE id_producto ='".$data['id_producto']."'and id_item ='".$data['id_item']."'");
			

        return ($query)?true:false;

    }
	
	
	public  function m_dropSubInv($data){
			//


        $query = $this->db->query("DELETE FROM subinventario WHERE (id_Item ='".$data['id_item']."' and id_ItemIngrediente  ='".$data['id_ItemIngrediente']."');");
			

        return ($query)?true:false;

    }
	
	
	/////////////////////////////////////
	 public function getExpira(){

        $query = $this->db->query("
       select 
			com.numeroOrden,
			com.nombreCliente,
			com.telefonoCliente,
			com.fechaCaptura,
			prod.modelo,
			com.cantidad,
			prod.almacen,
			prod.precio
		from compra com ,
			 productos prod
		where com.producto =prod.id_producto and
				com.statusRegistro= 1 and 
				com.baucher='0'  and 
				DATE_ADD(NOW(), INTERVAL 36 HOUR) > com.fechaCaptura;");
		
		
       return  $query->result_array();

    }
	///////////////////////////////Se el campo statusRegistro = 5 para cancelacion de pedido
	public function m_UpdatePedido($numberOrder){
		$query = $this->db->query("UPDATE compra SET statusRegistro = 5 WHERE numeroOrden='".$numberOrder."' ");
		 

		///$this->db->query("UPDATE compra SET statusRegistro = 5 WHERE numeroOrden='".$numberOrder."' ");
		//$this->db->query("SELECT * FROM  compra ");

        return ($query)?true:false;

    }
	
	public function getmaterualfull(){

        $query = $this->db->query("SELECT inprod.id_producto,(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,inprod.id_item,inprod.cantidad catidadItem , 
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) group by inprod.id_producto,inprod.id_item;");

        return $query->result_array();

    }
	public function m_getmaterualfull(){
		

       /* $query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
		
		
		
		
		
		
		/*$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, 
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<br>'),' ') id_item , 
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<br>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos
											FROM 	compra com, 
													productos prod
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
											GROUP BY com.producto)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								GROUP BY inicio.producto ;");*/
		
		
		
		
		$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<br>'),' ') id_item , 
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<br>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega
											FROM 	compra com, 
													productos prod
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								GROUP BY inicio.producto,inicio.diaEntrega ;");

        return $query->result_array();

    }
		public function getmaterualfullProd(){

        $query = $this->db->query("SELECT prod.id_producto, prod.nombre, sum(com.cantidad) cantidad
								FROM 
 								 compra  com,
 								 productos prod
 where  com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and com.producto = prod.id_producto
group by com.producto;");

        return $query->result_array();

    }
	
		public function getmaterialpagado(){

        $query = $this->db->query("SELECT inprod.id_producto,(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,inprod.id_item,inprod.cantidad catidadItem , 
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and 
comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and inprod.id_producto= comp.producto
	and comp.baucher is not null 
    and comp.baucher <> '0'
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item;");
			
			
		

        return $query->result_array();

    }
	
	public function getmaterialpagadoH1(){

        /*$query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
and comp.horaEntrega BETWEEN  '07:00'  AND  '09:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
AND comp.horaEntrega BETWEEN  '07:00'  AND  '09:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro =1 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
 and com.horaEntrega BETWEEN  '07:00'  AND  '09:00' 
 and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
		
		
		$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                    and com.horaEntrega BETWEEN  '07:00'  AND  '09:00' 
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega ='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
	
	public function getmaterialpagadoH1marias(){

     
		$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                    and com.horaEntrega BETWEEN  '07:00'  AND  '09:00' 
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega !='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
	public function getmaterialpagadoH2(){

     /*   $query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
and comp.horaEntrega BETWEEN  '09:01'  AND  '15:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
AND comp.horaEntrega BETWEEN  '09:01'  AND  '15:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro =1 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
 and com.horaEntrega BETWEEN  '09:01'  AND  '15:00' 
 and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
		
		 $query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                   and com.horaEntrega BETWEEN  '09:01'  AND  '15:00'  
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega ='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
	
	
	public function getmaterialpagadoH2marias(){
		
		 $query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                   and com.horaEntrega BETWEEN  '09:01'  AND  '15:00'  
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega !='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
		public function getmaterialpagadoH3(){

        /*$query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
and comp.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
AND comp.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro =1 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
 and com.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
 and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
			
			$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                  and com.horaEntrega BETWEEN  '15:01'  AND  '18:00'  
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega ='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
	
	public function getmaterialpagadoH3marias(){

        /*$query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
and comp.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro =1 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
AND comp.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro =1 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) 
 and com.horaEntrega BETWEEN  '15:01'  AND  '18:00' 
 and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
			
			$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen, inicio.statusPago,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<hr>'),' ') id_item , 
                                          
                                            IFNULL(GROUP_CONCAT( CONCAT (inv.descripcion ,' Cantidad: ',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )))SEPARATOR '<hr>'  ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           ingrediente,
										    IFNULL(GROUP_CONCAT( CONCAT ('<tr><td>',inv.descripcion ,' </td><td>',(inicio.cantidad *( IFNULL(inprod.cantidad,0) )),'</td></tr>') ),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO')
                                           materialtab,
										   GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<td>') sumacantidadtab,
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<hr>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega,pag.statusPago
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.statusPreparacion=0
                                                  and com.horaEntrega BETWEEN  '15:01'  AND  '18:00'  
                                                    AND com.numeroOrden=pag.numeroOrden
													AND com.tipoEntrega !='domicilio'
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								
								GROUP BY inicio.producto,inicio.diaEntrega;");

        return $query->result_array();

    }
	
	
	public function getmaterialpagadoProd(){

        $query = $this->db->query("SELECT prod.id_producto, prod.nombre, sum(com.cantidad) cantidad
								FROM 
 								 compra  com,
 								 productos prod
 where  com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and com.producto = prod.id_producto and com.baucher is not null and com.baucher <> '0'
group by com.producto;");

        return $query->result_array();

    }
	
    public function m_getmaterualpagado(){
		

/*        $query = $this->db->query("select tab.id_producto , tab.producto ,GROUP_CONCAT(tab.id_item SEPARATOR '<br>') AS id_item,GROUP_CONCAT(tab.catidadItem SEPARATOR '<br>') AS catidadItem
,GROUP_CONCAT(tab.sumacantidad SEPARATOR '<br>') AS sumacantidad,GROUP_CONCAT(tab.material SEPARATOR '<br>') AS material, tab.cantidad
from(
SELECT inprod.id_producto,
	(select prod.nombre from productos prod where prod.id_producto = inprod.id_producto )producto,
		inprod.id_item,
        inprod.cantidad catidadItem , 
        (select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto) cantidad,
(inprod.cantidad *
(select sum(comp.cantidad)
FROM  compra  comp
where comp.statusRegistro <3 and comp.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and comp.baucher is not null and comp.baucher <> '0'
and comp.producto=  inprod.id_producto
group by comp.producto)
)sumacantidad, (select inven.descripcion from inventario inven where inven.id_item =inprod.id_item ) material
FROM  ingrediente_producto  inprod,
  compra  com
 where inprod.id_producto= com.producto and com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY) and com.baucher is not null and com.baucher <> '0'
group by inprod.id_producto,inprod.id_item) tab
group by tab.id_producto;");*/
		$query = $this->db->query("SELECT 	inicio.producto id_producto ,inicio.nombre producto, inicio.diaEntrega, img.imagen,
											IFNULL(GROUP_CONCAT( inprod.id_item SEPARATOR '<br>'),' ') id_item , 
											inicio.cantidad cantidad,
											IFNULL(GROUP_CONCAT( inv.descripcion SEPARATOR '<br>'),'NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO') material,
        									GROUP_CONCAT(inicio.cantidad *( IFNULL(inprod.cantidad,0) )SEPARATOR '<br>') sumacantidad
									FROM 
											(SELECT prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos, com.diaEntrega
											FROM 	compra com, 
													productos prod,
                                                    pagos pag
											WHERE 	com.producto =prod.id_producto 
													AND com.statusRegistro <3 and com.diaEntrega  > DATE_ADD(CURDATE(), INTERVAL -1 DAY)
                                                    AND com.baucher is not null 
													AND com.baucher <> '0'
                                                    AND pag.numeroOrden = com.numeroOrden
                                                    AND pag.statusPago=1
											GROUP BY com.producto,com.diaEntrega)inicio 
								LEFT JOIN ingrediente_producto inprod
										ON inicio.producto=inprod.id_producto
								LEFT JOIN inventario inv
										ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
								lEFT JOIN imagenes img
										ON inicio.producto = img.producto
								GROUP BY inicio.producto,inicio.diaEntrega ;;");

        return $query->result_array();

    }
	
	    public function m_getProdEntregados(){
		

        $query = $this->db->query("SELECT com.producto,prod.nombre, sum(com.cantidad) stock
FROM compra com,
	productos prod
where com.diaEntrega='2020-02-14' AND com.statusEnvio=3
 and com.producto= prod.id_producto
group by com.producto ;");

        return $query->result_array();

    }
	public function m_getProdEntregadosh1(){
		

        $query = $this->db->query("SELECT com.producto,prod.nombre, sum(com.cantidad) stock
FROM compra com,
	productos prod
where com.diaEntrega='2020-02-14' AND com.statusEnvio=3
 and com.producto= prod.id_producto
 and com.horaEntrega  between '07:00' and '09:00'
  
group by com.producto ;");

        return $query->result_array();

    }
	
	 public function m_getProdEntregadosh2(){
		

        $query = $this->db->query("SELECT com.producto,prod.nombre, sum(com.cantidad) stock
FROM compra com,
	productos prod
where com.diaEntrega='2020-02-14' AND com.statusEnvio=3
 and com.producto= prod.id_producto
 and com.horaEntrega  between '10:30' and '15:00'
 and tipoEntrega ='domicilio'
group by com.producto ;");

        return $query->result_array();

    }
	public function m_getProdEntregadosh3(){
		

        $query = $this->db->query("SELECT com.producto,prod.nombre, sum(com.cantidad) stock
FROM compra com,
	productos prod
where com.diaEntrega='2020-02-14' AND com.statusEnvio=3
 and com.producto= prod.id_producto
 and com.horaEntrega  between '16:30' and '18:00'
  and tipoEntrega ='domicilio'
group by com.producto ;");

        return $query->result_array();

    }
	
	public function m_getProdEntregadosh4(){
		

        $query = $this->db->query("SELECT com.producto,prod.nombre, sum(com.cantidad) stock
FROM compra com,
	productos prod
where com.diaEntrega='2020-02-14' AND com.statusEnvio=3
 and com.producto= prod.id_producto
 and com.horaEntrega  between '16:30' and '18:00'
  and tipoEntrega ='marias'
group by com.producto ;");

        return $query->result_array();

    }
	
	
 public function M_activePrepado($order){
	

        $query = $this->db->query("UPDATE compra SET statusPreparacion = '1' WHERE numeroOrden = '".$order."' ");
	 	$query = $this->db->query("SELECT 
							inprod.id_item ,
                            sum(inicio.cantidad *( inprod.cantidad )) sumacantidad ,
                            inicio.diaEntrega,
                            inicio.horaEntrega
					FROM 
						(SELECT com.diaEntrega,com.numeroOrden, prod.nombre ,com.producto, sum(com.cantidad) cantidad, count(com.producto)numPedidos,com.horaEntrega
						FROM compra com, 
								productos prod
						WHERE 	com.producto =prod.id_producto 
								AND com.numeroOrden='".$order."' 
								GROUP BY com.producto 
								)inicio 
					INNER JOIN ingrediente_producto inprod
							ON inicio.producto=inprod.id_producto
					LEFT JOIN inventario inv
							ON  inprod.id_item= inv.id_item  AND inv.ingrediente=0
							group by inprod.id_item;");

        $item =  $query->result_array();
		
		
		if (empty($item)) {
			$MSJ= '<script type="text/javascript">alert("NO SE A DADO DE ALTA LOS MATERIALES DE ESTE MODELO CON LOS PRODUCTOS CON ESTE NUMERO DE ORDEN")</script>';
		}
		else{
			
			foreach ($item as $value) {
				$q = $this->db->query("	SELECT count(id_item) num
										FROM  pendiente
										WHERE  id_item ='".$value['id_item']."'  
											AND diaEntrega ='".$value['diaEntrega']."' 
											AND  horaEntrega ='".$value['horaEntrega']."';");
				 $count =  $q->result_array();
				 $this->db->query("UPDATE 	inventario 
					 					SET 	cantidad_logica = cantidad_fisica  - ".$value['sumacantidad']." 
										,  		cantidad_fisica = cantidad_fisica  - ".$value['sumacantidad']." 
										
										WHERE (id_item = '".$value['id_item']."');");
					
				foreach ($count as $c) {
					
				
				if ($c['num']>0){
					 $this->db->query("UPDATE pendiente 
										SET cantidad = cantidad -".$value['sumacantidad']."
        								WHERE id_item = '".$value['id_item']."' 
										AND diaEntrega ='".$value['diaEntrega']."' 
										AND  horaEntrega = '".$value['horaEntrega']."';");
					
					
				}

					
				}
				
				

			
			}
			
		}
	

	 
	 

        return ($query)?true:false;

    }	
	
	
		public function get_MaterialCocina(){
		//echo json_encode($idproducto);
		$query = $this->db->query("	SELECT pd.*,inv.descripcion
									FROM pendiente  pd
									INNER JOIN inventario inv
									ON pd.id_item= inv.id_item
									WHERE pd.cantidad >0
									ORDER BY pd.diaEntrega ,pd.horaEntrega, inv.descripcion
									; ");
        
        return $query->result_array();

    }
	
	
	public function m_updateMaterialCocina($data){
		
		$query = $this->db->query("	update 	pendiente 
        							set 	cantidad = cantidad- ".$data['cantidadUpdate']."
        							where 	id_item = '".$data['id_item']."'  
											AND diaEntrega ='".$data['diaEntrega']."'  
											AND  horaEntrega = '".$data['horaEntrega']."' ");
		
		

       

        return ($query)?true:false;

    }
/* ADG0.0.1  Finaliza Cambio */
}