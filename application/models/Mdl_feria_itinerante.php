<?php

class MDL_Feria_Itinerante extends CI_Model {

	private $tabla = "ferias_itinerantes";

	public $idParque, $idParqueFeriaItinerante, $direccion, $dias, $activo, $latitud, $longitud;

	public function obtenerFeriasItinerantesPorParque($idParque) {
	
		if(!empty($idParque)) {
			$resultQuery = $this->db->query("
				SELECT fi.id_feria_itinerantes, fi.dias, fi.direccion, fi.latitud, .fi.longitud, fi.activo
				FROM  $this->tabla fi
				WHERE fi.id_parque = ".$this->db->escape($idParque)." AND fi.activo = 1"
			);
			
			return !empty($resultQuery->result()) ? $resultQuery->result() : null;
		}

		return $resultQuery = null;
	}
}

?>