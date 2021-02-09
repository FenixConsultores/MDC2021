<?php  defined('BASEPATH') OR exit('Permiso denegado');



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

    	$query = $this->db->query("SELECT entrega.ruta,compra.numeroOrden,compra.producto,compra.cantidad,compra.diaEntrega,compra.horaEntrega,compra.nombreCliente,compra.telefonoCliente,compra.direccion,compra.geolocalizacion,compra.caracteristicasDomicilio,compra.statusEnvio,usuarios.nombre,usuarios.email,evidencias.fotografia as evidencia FROM entrega INNER JOIN compra ON entrega.orden = compra.numeroOrden INNER JOIN rutas ON entrega.ruta = rutas.id_rutas INNER JOIN usuarios ON rutas.chofer = usuarios.id_user LEFT JOIN evidencias ON compra.numeroOrden = evidencias.noOrden WHERE id_user='".$id."' GROUP BY numeroOrden ORDER BY STR_TO_DATE(compra.diaEntrega, '%Y-%m-%d') ASC");

    	return $query->result_array();

    }



    public function dataCustomer($dni){

    	$query = $this->db->query("SELECT numeroOrden,cantidad,diaEntrega,horaEntrega,nombreCliente,telefonoCliente,telefonoEntrega,personaEntrega,nota,direccion,geolocalizacion,caracteristicasDomicilio,statusEnvio,baucher,statusEnvio,GROUP_CONCAT(DISTINCT productos.modelo SEPARATOR ',')AS modelos,GROUP_CONCAT(compra.cantidad SEPARATOR ',') AS cantidad,GROUP_CONCAT(DISTINCT evidencias.fotografia SEPARATOR ',')AS evidencia FROM compra INNER JOIN productos ON compra.producto = productos.id_producto LEFT JOIN evidencias ON compra.numeroOrden = evidencias.noOrden WHERE numeroOrden = '".$dni."' GROUP BY numeroOrden");

    	return $query->result_array();

    }

    public function M_quantityModels($orden){

        $query = $this->db->query("SELECT  productos.modelo, compra.cantidad, prod_img.imagen FROM compra INNER JOIN productos ON compra.producto = productos.id_producto INNER JOIN (select img.producto id_producto, img.imagen from imagenes img group by img.producto) prod_img on (productos.id_producto = prod_img.id_producto) WHERE numeroOrden = '".$orden."' ");

        return $query->result_array();

    }



    public function uploadEvidencia($data){

        $this->db->trans_begin();        

        $this->db->query("INSERT INTO evidencias(id_evid,noOrden,chofer,fotografia,fecha) VALUES(NULL,'".$data['noOrder']."','".$data['idChofer']."','".$data['picture']."','".$data['dateUpload']."')");

        $this->db->query("UPDATE compra SET statusEnvio= '3' WHERE numeroOrden = '".$data['noOrder']."' ");

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