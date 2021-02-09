<?php defined('BASEPATH') OR exit('Permiso denegado');


class M_production_helper extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	//NOTA: SE REMOVIO EL FILTRO AND c.statusEnvio != 3 (excluir enviados) ya que si no se eliminarian del total y generaría problemas


	private function existsProductsByFilters($dType, $dDate, $dStartHour, $dFinishHour)
	{
		$query =
			"
			SELECT 
				count(c.producto) total
			FROM compra c
			INNER JOIN pagos p ON (c.numeroOrden = p.numeroOrden)
			WHERE
				p.statusPago = 1
				AND c.tipoEntrega = '$dType'
				AND c.diaEntrega = date_format(str_to_date('$dDate','%d-%m-%Y'), '%Y-%m-%d')
				AND (CAST(c.horaEntrega AS TIME) BETWEEN CAST('$dStartHour' AS TIME) AND CAST('$dFinishHour' AS TIME))
			";

		$resultset = $this->db->query($query);
		$row = $resultset->row_array();
		$total = intval($row["total"]);

		return $total > 0;

	}

	private function getProductionHelperId($dType, $dDate, $dStartHour, $dFinishHour)
	{
		$query = "SELECT id_produccion
					FROM produccion_auxiliar
					WHERE tipoEntrega = '$dType' 
					AND fechaEntrega = '$dDate' 
					AND horaInicioEntrega = '$dStartHour' 
					AND horaFinEntrega = '$dFinishHour'";

		$resultset = $this->db->query($query);
		if ($resultset->num_rows() > 0) {

			// already exists a record with the existing filters
			$row = $resultset->row_array();

			return intval($row['id_produccion']);

		} else {

			// does not exists any record with the existing filters, so have to insert it

			$this->db->query("INSERT INTO produccion_auxiliar (tipoEntrega,fechaEntrega,horaInicioEntrega,horaFinEntrega) values ('$dType','$dDate','$dStartHour','$dFinishHour')");

			return $this->db->insert_id();

		}

	}

	public function getProductsByDeliveryTypeDateAndHour($dType, $dDate, $dStartHour, $dFinishHour)
	{

		//checks if exists products to produce with the filters
		if (!$this->existsProductsByFilters($dType, $dDate, $dStartHour, $dFinishHour)) {
			return array();
		}

		//begins transaction
		$this->db->trans_begin();

		try {

			//gets product helper id
			$productionHelperId = $this->getProductionHelperId($dType, $dDate, $dStartHour, $dFinishHour);

			//copies current production to mirror table
			$this->db->query("
			insert into produccion_auxiliar_productos_espejo (id_produccion, id_producto, unidades, unidades_realizadas)
			SELECT id_produccion, id_producto, unidades, unidades_realizadas
			FROM produccion_auxiliar_productos where id_produccion = $productionHelperId
			");

			//deletes current productionHelperId products
			$this->db->query("delete from produccion_auxiliar_productos where id_produccion = $productionHelperId");

			//reinsert products of productionHelperId joining with mirror table
			$this->db->query("
			insert into produccion_auxiliar_productos (id_produccion, id_producto, unidades, unidades_realizadas)
			SELECT $productionHelperId, p.id_producto, p.unidades,  ifnull(pape.unidades_realizadas,0) unidades_realizadas
			FROM (
				SELECT 
					c.producto id_producto, sum(cantidad) unidades
				FROM compra c
				INNER JOIN pagos p ON (c.numeroOrden = p.numeroOrden)
				WHERE 
					p.statusPago = 1
					AND c.tipoEntrega = '$dType'
					AND c.diaEntrega = date_format(str_to_date('$dDate','%d-%m-%Y'), '%Y-%m-%d')
					AND (CAST(c.horaEntrega AS TIME) BETWEEN CAST('$dStartHour' AS TIME) AND CAST('$dFinishHour' AS TIME))
				GROUP BY c.producto
			) p
			LEFT JOIN (
					SELECT id_produccion, id_producto, unidades, unidades_realizadas 
					FROM produccion_auxiliar_productos_espejo where id_produccion = $productionHelperId
				) pape on (p.id_producto = pape.id_producto)
			");

			//truncates mirror table
			$this->db->query("truncate table produccion_auxiliar_productos_espejo");

			$this->db->trans_commit();

		} catch (Exception $e) {
			$this->db->trans_rollback();
		}


		$q_query = "
			SELECT 
				prod.id_producto,
				prod.descripcion id_descripcion,
				prod.nombre nombre_producto,
				prod.modelo modelo_producto,
				prod_cant.unidades,
				prod_img.imagen,
				ifnull( pape.id_produccion, -1) id_produccion,
				ifnull(pape.unidades_realizadas,0) unidades_realizadas
			FROM productos prod
			INNER JOIN (
				SELECT 
					c.producto id_producto, sum(cantidad) unidades
				FROM compra c
				INNER JOIN pagos p ON (c.numeroOrden = p.numeroOrden)
				WHERE
					p.statusPago = 1
					AND c.tipoEntrega = '$dType'
					AND c.diaEntrega = date_format(str_to_date('$dDate','%d-%m-%Y'), '%Y-%m-%d')
					AND (CAST(c.horaEntrega AS TIME) BETWEEN CAST('$dStartHour' AS TIME) AND CAST('$dFinishHour' AS TIME))
				GROUP BY c.producto
			) prod_cant on prod.id_producto = prod_cant.id_producto
			INNER JOIN (select img.producto id_producto, img.imagen from imagenes img group by img.producto) prod_img on (prod.id_producto = prod_img.id_producto)
			LEFT JOIN (
				SELECT id_produccion, id_producto, unidades, unidades_realizadas 
				FROM produccion_auxiliar_productos where id_produccion = $productionHelperId
			) pape on (prod.id_producto = pape.id_producto)
			ORDER BY prod.modelo
		";

		$query = $this->db->query($q_query);

		return $query->result_array();
	}

	public function updateProductionUnits($productionHelperId, $productId, $units)
	{
		$query = $this->db->query("update produccion_auxiliar_productos set unidades_realizadas = $units where id_produccion = $productionHelperId and id_producto = $productId");

		return ($query) ? true : false;
	}


	//description table

	public function getProductsDescriptions()
	{
		$query = $this->db->query("
		SELECT 
			des.id_descripcion, des.t_fresa, des.no_fresas, des.no_fresas_cafe, des.no_fresas_blanca,
			des.no_rosas, des.espirales, des.puntos, des.rayas, des.figuras, des.lisa, 
			des.s_chocolate, des.desnuda_rayada, des.rosa_de_chocolate, des.palo_chico, des.palo_grande,
			(SELECT psi.imagen FROM productos prod INNER JOIN products_single_image psi ON (prod.id_producto = psi.id_producto) where prod.descripcion = des.id_descripcion order by prod.id_producto limit 1) imagen
		FROM descripcion des order by des.id_descripcion");

		return $query->result_array();
	}

	public function insertProductDescription($data)
	{
		return $this->db->query("
		INSERT INTO descripcion (t_fresa, no_fresas, no_fresas_cafe, no_fresas_blanca,
			no_rosas, espirales, puntos, rayas, figuras, lisa, 
			s_chocolate, desnuda_rayada, rosa_de_chocolate, palo_chico, palo_grande)
		VALUES ('$data[tStrawberry]',$data[nStrawberry],$data[nStrawberryBrown],$data[nStrawberryWhite],
				$data[nRoses],$data[nSpirals],$data[nDots],$data[nStripes],$data[nFigures],$data[nFlats],
				$data[nChocolate],$data[nNakedStripes],$data[nChocolateRose],$data[nSmallStick],$data[nBigStick])");

	}

	public function updateProductDescription($data)
	{
		return $this->db->query("
		UPDATE descripcion
		SET t_fresa = '$data[tStrawberry]', no_fresas = $data[nStrawberry], no_fresas_cafe = $data[nStrawberryBrown], 
			no_fresas_blanca = $data[nStrawberryWhite], no_rosas = $data[nRoses], espirales = $data[nSpirals], 
			puntos = $data[nDots], rayas = $data[nStripes], figuras = $data[nfigures], lisa = $data[nFlats], 
			s_chocolate = $data[nChocolate], desnuda_rayada = $data[nNakedStripes], rosa_de_chocolate = $data[nChocolateRose], 
			palo_chico = $data[nSmallStick], palo_grande = $data[nBigStick]
		WHERE id_descripcion = $data[descriptionId]");

	}
    
    public function getUnidadMedida()
	{
		$query = $this->db->query("
		SELECT 
			*
		FROM cat_udm des order by descripcion");

		return $query->result_array();
	}
    public function getInventario()
	{
		$query = $this->db->query("
		SELECT 
			*
		FROM inventario inv des order by inv.descripcion");

		return $query->result_array();
	}
}