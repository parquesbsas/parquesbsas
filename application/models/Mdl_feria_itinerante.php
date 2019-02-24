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

	public function crearFeriatineranteParque() {

		$query = "INSERT INTO $this->tabla (id_parque, direccion, dias, latitud, longitud, activo) VALUES (". $this->db->escape_str($this->idParque) .", ". $this->db->escape($this->direccion) .", ". $this->db->escape($this->dias) .", ". $this->db->escape($this->latitud) .", ". $this->db->escape($this->longitud) .", 1);";

		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function actualizarFeriatineranteParque() {

		$query = "UPDATE $this->tabla SET direccion = ". $this->db->escape($this->direccion) .", dias = ". $this->db->escape($this->dias) .", latitud = ". $this->db->escape($this->latitud) .", longitud = ". $this->db->escape($this->longitud) .", activo = ". $this->db->escape_str($this->activo) ." WHERE id_feria_itinerantes = ". $this->db->escape_str($this->idParqueFeriaItinerante) ." ";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}
}

?>