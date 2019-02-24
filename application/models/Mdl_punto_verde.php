<?php

class MDL_Punto_Verde extends CI_Model {

	public $tabla = "puntos_verdes";

	public $idParque, $idPuntoVerde, $tipo, $diasHorarios, $activo, $latitud, $longitud, $materiales;

	public function obtenerPuntoVerdePorParque($idParque) {

		if(!empty($idParque)) {
			$resultQuery = $this->db->query("
				SELECT pv.id_punto_verde, pv.tipo, pv.materiales, pv.dias_horarios, pv.latitud, pv.longitud, pv.activo
				FROM $this->tabla pv
				WHERE  pv.id_parque = ".$this->db->escape($idParque)." AND pv.activo = 1"
			);

			return $resultQuery->row();
		}

		return $resultQuery = null;
	}

	public function crearPuntoVerdeParque() {

		$query = "INSERT INTO $this->tabla (id_parque, tipo, materiales, dias_horarios, latitud, longitud, activo) VALUES (". $this->db->escape_str($this->idParque) .", ". $this->db->escape($this->tipo) .", ". $this->db->escape($this->materiales) .", ". $this->db->escape($this->diasHorarios) .", ". $this->db->escape($this->latitud) .", ". $this->db->escape($this->longitud) .", 1);";

		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function actualizarPuntoVerdeParque() {

		$query = "UPDATE $this->tabla SET tipo = ". $this->db->escape($this->tipo) .", materiales = ". $this->db->escape($this->materiales) .", dias_horarios = ". $this->db->escape($this->diasHorarios) .", latitud = ". $this->db->escape($this->latitud) .", longitud = ". $this->db->escape($this->longitud) .", activo = ". $this->db->escape_str($this->activo) ." WHERE id_punto_verde = ". $this->db->escape_str($this->idPuntoVerde) ." ";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

}
?>