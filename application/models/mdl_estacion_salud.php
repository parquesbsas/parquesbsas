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

}
?>