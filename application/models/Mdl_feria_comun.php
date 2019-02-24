<?php

class MDL_Feria_Comun extends CI_Model {

	private $tabla = "ferias_comunes";

	public $idParque, $idParqueFeriaComun, $tipo, $fecha, $activo, $latitud, $longitud;

	public function obtenerFeriasComunesPorParque($idParque) {

		if(!empty($idParque)) {
			$resultQuery = $this->db->query("
				SELECT fc.id_feria_comun, fc.fecha, fc.tipo, fc.latitud, fc.longitud, fc.activo
				FROM $this->tabla fc
				WHERE  fc.id_parque = ".$this->db->escape($idParque)." AND fc.activo = 1"
			);

			return !empty($resultQuery->result()) ? $resultQuery->result() : null;
		}

		return $resultQuery = null;
	}

	public function obtenerFeriasComunes() {
		$feriasComunes = $this->db->query("SELECT id_feria_comun, tipo FROM $this->tabla GROUP BY tipo")->result();
		$inicio = (object) array(
			"id_feria_comun" => null,
			"tipo" => "-"
		);
		array_unshift($feriasComunes, $inicio);
		return $feriasComunes;
	}

	public function crearFeriaComunParque() {

		$query = "INSERT INTO $this->tabla (id_parque, fecha, tipo, latitud, longitud, activo) VALUES (". $this->db->escape_str($this->idParque) .", ". $this->db->escape($this->fecha) .", ". $this->db->escape($this->tipo) .", ". $this->db->escape($this->latitud) .", ". $this->db->escape($this->longitud) .", 1);";

		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function actualizarFeriaComunParque() {

		$query = "UPDATE $this->tabla SET tipo = ". $this->db->escape($this->tipo) .", fecha = ". $this->db->escape($this->fecha) .", latitud = ". $this->db->escape($this->latitud) .", longitud = ". $this->db->escape($this->longitud) .", activo = ". $this->db->escape_str($this->activo) ." WHERE id_feria_comun = ". $this->db->escape_str($this->idParqueFeriaComun) ." ";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

}

?>