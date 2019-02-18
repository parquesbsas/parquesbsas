<?php

class MDL_Comuna extends CI_Model {

	public $idComuna, $nombreComuna;
	private $tabla = "comunas";

	public function obtenerComunas() {
		$resultQuery = $this->db->query("SELECT * FROM $this->tabla")->result();
		return $resultQuery;
	}		
	
	public function buscarComunaPorNombre($nombreComuna) {

		if(!empty($nombreComuna)) {
			$result = $this->db->query("SELECT * FROM $this->tabla WHERE comuna LIKE '%". $this->db->escape_like_str($nombreComuna) ."%' ESCAPE '!'")->row();
			return !empty($result) ? $result : null;
		}
		
		return false;
	}

}
?>