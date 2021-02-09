<?php defined('BASEPATH') OR exit('Permiso denegado');



class M_ruta extends CI_Model {



    public function __construct(){

        parent::__construct();        

    }



    public function dataRepartidor($id){

    	$query = $this->db->query("SELECT nombre,ubicacion,nota FROM rutas WHERE chofer ='".$id."' ");

    	return $query->row();

    }

    public function getRoad($id){

        $fecha = date('d/m/Y');

    	$query = $this->db->query("SELECT 	entrega.ruta,compra.numeroOrden,compra.producto,compra.cantidad,
											compra.diaEntrega,compra.horaEntrega,compra.nombreCliente,
        									compra.telefonoCliente,compra.direccion,compra.geolocalizacion,
        									compra.caracteristicasDomicilio,compra.statusEnvio,usuarios.nombre,
        									usuarios.email,evidencias.fotografia as evidencia ,
        									imagenes.imagen
									FROM entrega 
									INNER JOIN compra ON entrega.orden = compra.numeroOrden 
									INNER JOIN imagenes ON compra.producto = imagenes.producto
									INNER JOIN rutas ON entrega.ruta = rutas.id_rutas 
									INNER JOIN usuarios ON rutas.chofer = usuarios.id_user 
									LEFT JOIN evidencias ON compra.numeroOrden = evidencias.noOrden 
									WHERE id_user='".$id."'
 									GROUP BY numeroOrden 
 									ORDER BY STR_TO_DATE(compra.diaEntrega, '%Y-%m-%d') ASC, CAST(compra.horaEntrega AS TIME) ASC;
									");

    	return $query->result_array();

    }



    public function dataCustomer($dni){

    	$query = $this->db->query("SELECT numeroOrden,cantidad,diaEntrega,horaEntrega,nombreCliente,telefonoCliente,telefonoEntrega,personaEntrega,nota,direccion,geolocalizacion,caracteristicasDomicilio,confirmarDomicilio,detallesExteriorDomicilio,statusEnvio,baucher,statusEnvio,GROUP_CONCAT(DISTINCT productos.modelo SEPARATOR ',')AS modelos,GROUP_CONCAT(compra.cantidad SEPARATOR ',') AS cantidad,GROUP_CONCAT(DISTINCT evidencias.fotografia SEPARATOR ',')AS evidencia FROM compra INNER JOIN productos ON compra.producto = productos.id_producto LEFT JOIN evidencias ON compra.numeroOrden = evidencias.noOrden WHERE numeroOrden = '".$dni."' GROUP BY numeroOrden");

    	return $query->result_array();

    }

    public function M_quantityModels($orden){

        $query = $this->db->query("SELECT  productos.modelo, compra.cantidad, prod_img.imagen FROM compra INNER JOIN productos ON compra.producto = productos.id_producto INNER JOIN (select img.producto id_producto, img.imagen from imagenes img group by img.producto) prod_img on (productos.id_producto = prod_img.id_producto) WHERE numeroOrden = '".$orden."' ");

        return $query->result_array();

    }
	
	public function M_Models($id){

        $query = $this->db->query("	 SELECT DISTINCT compra.numeroOrden, productos.modelo, compra.cantidad, prod_img.imagen
 FROM compra 
INNER JOIN entrega ON entrega.orden = compra.numeroOrden 
INNER JOIN rutas ON entrega.ruta = rutas.id_rutas 
INNER JOIN usuarios ON rutas.chofer = usuarios.id_user 
 INNER JOIN productos ON compra.producto = productos.id_producto 
 INNER JOIN (select img.producto id_producto, img.imagen 
 from imagenes img group by img.producto) prod_img on (productos.id_producto = prod_img.id_producto) 
 WHERE id_user='".$id."' ;
									 ");

        return $query->result_array();

    }



    public function uploadEvidencia($data){

        $this->db->trans_begin();        

        $this->db->query("INSERT INTO evidencias(id_evid,noOrden,chofer,fotografia,fecha) VALUES(NULL,'".$data['noOrder']."','".$data['idChofer']."','".$data['picture']."','".$data['dateUpload']."')");

        $this->db->query("UPDATE compra SET statusEnvio= '3' WHERE numeroOrden = '".$data['noOrder']."' ");
		/////////////////////////Se actualiza la cantidad en inventario 
/*		 $this->db->query("UPDATE inventario 
        SET cantidad_logica = cantidad_fisica - (SELECT inprod.cantidad  FROM 
				compra com,
				productos prod,
                ingrediente_producto  inprod
                where com.producto  =  prod.id_producto and 
                inprod.id_producto = prod.id_producto and com.numeroOrden='".$data['noOrder']."') ,
			cantidad_fisica = cantidad_fisica - (SELECT inprod.cantidad  FROM 
				compra com,
				productos prod,
                ingrediente_producto  inprod
                where com.producto  =  prod.id_producto and 
                inprod.id_producto = prod.id_producto and com.numeroOrden='".$data['noOrder']."')
                 WHERE id_item =(SELECT inprod.id_item  FROM 
				compra com,
				productos prod,
                ingrediente_producto  inprod
                where com.producto  =  prod.id_producto and 
                inprod.id_producto = prod.id_producto and com.numeroOrden='".$data['noOrder']."');");*/
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
								AND com.numeroOrden='".$data['noOrder']."' 
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
				
				 $this->db->query("UPDATE 	inventario 
					 					SET 	cantidad_logica = cantidad_fisica  - ".$value['sumacantidad']." 
										,  		cantidad_fisica = cantidad_fisica  - ".$value['sumacantidad']." 
										
										WHERE (id_item = '".$value['id_item']."');");
			}
			
		}
		

        if ($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();

            $msg = false;

        }else{

            $this->db->trans_commit();

            $msg = true;

        }        

        return $msg;

                

    }

    public function M_validateProductGive($orden){

        $query = $this->db->query("UPDATE compra SET statusEnvio= '2' WHERE numeroOrden ='".$orden."' ");

        return ($query)?true:false;

    }

}