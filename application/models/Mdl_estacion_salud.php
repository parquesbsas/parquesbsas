<?php

class MDL_Estacion_Salud extends CI_Model {

	private $tabla = "estaciones_salud";

	public $idParque, $idEstacionSalud, $servicios, $fecha, $activo, $latitud, $longitud;

	public function obtenerEstacionSaludablePorParque($idParque) {

		if(!empty($idParque)) {
			$resultQuery = $this->db->query("
				SELECT es.id_estacion_salud, es.servicios, es.fecha, es.activo, es.latitud, es.longitud
				FROM $this->tabla es
				WHERE  es.id_parque = ".$this->db->escape($idParque)." AND es.activo = 1"
			);

			return $resultQuery->row();
		}

		return $resultQuery = null;
	}

	public function crearEstacionSaludableParque() {
		$query = "INSERT INTO $this->tabla (id_parque, servicios, fecha, latitud, longitud, activo) VALUES (". $this->db->escape_str($this->idParque) .", ". $this->db->escape($this->servicios) .", ". $this->db->escape($this->fecha) .", ". $this->db->escape($this->latitud) .", ". $this->db->escape($this->longitud) .", 1);";

		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function actualizarEstacionSaludableParque() {

		$query = "UPDATE $this->tabla SET servicios = ". $this->db->escape($this->servicios) .", fecha = ". $this->db->escape($this->fecha) .", latitud = ". $this->db->escape($this->latitud) .", longitud = ". $this->db->escape($this->longitud) .", activo = ". $this->db->escape_str($this->activo) ." WHERE id_estacion_salud = ". $this->db->escape_str($this->idEstacionSalud) ." ";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}
}
?>