<?php

class MDL_Punto_Verde extends CI_Model {

	public $tabla = "puntos_verdes";

	public $idParque, $idPuntoVerde, $tipo, $diasHorarios, $activo, $latitud, $longitud;

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

}
?>