<?php

class MDL_Barrio extends CI_Model {

	public $idBarrio, $nombreBarrio;
	private $tabla = "barrios";

	public function obtenerBarrios() {
		$resultQuery = $this->db->query("SELECT id_barrio, descripcion as barrio FROM $this->tabla")->result();
		return $resultQuery;
	}

	public function buscarBarrioPorNombre($nombreBarrio) {

		if(!empty($nombreBarrio)) {
			$result = $this->db->query("SELECT * FROM $this->tabla WHERE descripcion LIKE '%". $this->db->escape_like_str($nombreBarrio) ."%' ESCAPE '!'")->row();
			return !empty($result) ? $result : null;
		}

		return false;
	}

}
?>