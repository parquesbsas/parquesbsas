<?php

class MDL_calificacion extends CI_Model {

	private $tabla = "calificaciones";

	public function obtenerCalificaciones() {

		$resultQuery = $this->db->query("SELECT * FROM $this->tabla")->result();
		return $resultQuery;
	}

}
?>