<?php

class MDL_Encuesta extends CI_Model {

	private $tabla = "encuestas";
	private $tablaEncuestaUsuarioParque = "encuestas_usuarios_parques";

	public $idParque, $idUsuario, $idTipoEncuesta, $calificacion, $fechaCreacion;

	public function obtenerEncuestas() {

		$resultQuery = $this->db->query("SELECT * FROM $this->tabla WHERE activo = 1")->result();
		return $resultQuery;
	}

	public function realizarEncuestaParque() {

		if(empty($this->idParque) || empty($this->idUsuario) || empty($this->idTipoEncuesta) || empty($this->calificacion)) {
			return null;
		}

		$respuestaValidar = $this->validarTiempoEncuesta();

		if(is_null($respuestaValidar)) {
			return "Usted ya ha realizado esta encuesta en este parque, debera esperar el siguiente mes para volver a realizar la encuesta.";

		} elseif($respuestaValidar === false) {
			return false;
		}

		$sql = "INSERT INTO $this->tablaEncuestaUsuarioParque (id_usuario, id_encuesta, id_calificacion, id_parque, fecha_creacion)
				VALUES ( ". $this->db->escape_str($this->idUsuario) .", ". $this->db->escape_str($this->idTipoEncuesta) .", ". $this->db->escape_str($this->calificacion) .", ". $this->db->escape_str($this->idParque) .",  ". $this->db->escape($this->fechaCreacion) .");";
		var_dump($this->db->query($sql));die;
		if($this->db->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	protected function validarTiempoEncuesta() {

		$fechaHoy = date("m");
		$sql = "SELECT MAX(fecha_creacion) fecha_creacion FROM $this->tablaEncuestaUsuarioParque WHERE id_usuario = ". $this->db->escape_str($this->idUsuario) ." and id_encuesta = ". $this->db->escape_str($this->idTipoEncuesta) ." and id_parque = ". $this->db->escape_str($this->idParque) ."";
		$queryResult = $this->db->query($sql);

		if(empty($queryResult)) { // Escape de variables , validacion
			return false;
		}

		$result = $queryResult->row();

		if(empty($result->fecha_creacion)) {
			return true;
		}

		$fechaEncuestaUnix = strtotime($result->fecha_creacion);
		$fechaEncuesta = date("m", $fechaEncuestaUnix);

		if($fechaHoy > $fechaEncuesta) {
			return true;
		}

		return null;
	}

}
?>