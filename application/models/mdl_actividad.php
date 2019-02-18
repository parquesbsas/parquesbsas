<?php
class MDL_Actividad extends CI_Model {

	private $tabla = "actividades";
	private $tablaActividadesParque = "parques_actividades";

	public $idParqueActividad, $idParque, $idActividad, $desde, $hasta, $dia, $activo, $nombre, $descripcion;

	public function obtenerActividades() {
		$actividades = $this->db->query("SELECT id_actividad, nombre FROM $this->tabla")->result();
		return $actividades;
	}

	public function obtenerActividadesPorParque($idParque) {
		
		$actividades = array();

		if(!empty($idParque)) {
			$resultQuery = $this->db->query("
				SELECT a.nombre, pa.desde, pa.hasta, pa.dia, a.descripcion, a.id_actividad, pa.activo, pa.id_parque_actividad
				FROM $this->tablaActividadesParque pa
				LEFT JOIN $this->tabla a ON pa.id_actividad = a.id_actividad
				WHERE  pa.id_parque = ".$this->db->escape($idParque)." AND pa.activo = 1"
			);

			if(!empty($resultQuery->result())) {
				$actividadesQuery = $resultQuery->result();
				foreach($actividadesQuery as $actividad) {
					$actividades[$actividad->nombre][] = $actividad;	
				}
			}

			return !empty($actividades) ? $actividades : null;
		}

		return $resultQuery = null;
	}

	public function crear() {
		$query = "INSERT INTO ". $this->tabla ." (nombre, descripcion) VALUES (". $this->db->escape($this->nombre) .", ". $this->db->escape($this->descripcion) .");";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function crearActividadParque() {
		$query = "INSERT INTO ". $this->tablaActividadesParque ." (id_parque, id_actividad, desde, hasta, dia, activo) VALUES (". $this->db->escape_str($this->idParque) .", ". $this->db->escape_str($this->idActividad) .", ". $this->db->escape($this->desde) .", ". $this->db->escape($this->hasta) .", ". $this->db->escape($this->dia) .", 1);";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}		

	public function actualizarActividadParque() {

		$query = "UPDATE ". $this->tablaActividadesParque ." SET desde = ". $this->db->escape($this->desde) .", hasta = ". $this->db->escape($this->hasta) .", dia = ". $this->db->escape($this->dia) .", activo = ". $this->db->escape_str($this->activo) ." WHERE id_parque_actividad = ". $this->db->escape_str($this->idParqueActividad) ." ";
		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}
}

?>