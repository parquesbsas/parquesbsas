<?php

class MDL_Reclamo extends CI_Model {

	private $tabla = "reclamos";
	private $tablaUsuarioReclamoParque = "usuarios_reclamos_parques";
	private $tablaParque = "parques";

	public $idParque, $idUsuario, $idReclamo, $imagen, $comentario, $fechaCreacion;

	public function guardarReclamo() {

		if(empty($this->idParque) || empty($this->idUsuario) || empty($this->idReclamo) || empty($this->comentario) || empty($this->imagen)) {
			return null;
		}

		$saveImage = $this->guardarImagen();

		if(!empty($saveImage["file_name"])) {

			$this->fechaCreacion = date("Y-m-d H:i:s");
			$sql = "INSERT INTO $this->tablaUsuarioReclamoParque (id_usuario, id_reclamo, id_parque, id_estado, comentarios, fecha_creacion, imagen, latitud, longitud) VALUES(". $this->db->escape_str($this->idUsuario) .", ". $this->db->escape_str($this->idReclamo) .", ". $this->db->escape_str($this->idParque) .", 1, ". $this->db->escape($this->comentario) .", ". $this->db->escape($this->fechaCreacion) .", '".$saveImage['file_name']."', NULL, NULL);";

			if($this->db->query($sql)) {
				return true;
			} else {
				return false;
			}

		} elseif(is_string($saveImage)) {

			$message = filter_var($saveImage, FILTER_SANITIZE_STRING);
			return htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
		}

		return false;
	}

	protected function guardarImagen() {

		$config["upload_path"] = "./public/img/reclamo";
		$config["allowed_types"] = "jpg|JPEG|jpeg";
		$config["max_size"] = "2048";
		$config["max_width"] = "1680";
		$config["max_height"] = "1054";

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		if(!$this->upload->do_upload("fileImagen")) {
			return $this->upload->display_errors();
		} else {
 			return $this->upload->data();
		}
		return false;
	}

	public function obtenerListadoReclamos() {
		$resultQuery = $this->db->query("SELECT * FROM $this->tabla p");
		return !empty($resultQuery->result()) ? $resultQuery->result() : null;
	}

	public function obtenerEstadisticaReclamo() {

		$resultQuery = $this->db->query("SELECT t.fecha_creacion, COUNT(*) total FROM $this->tablaUsuarioReclamoParque t GROUP BY YEAR(t.fecha_creacion), MONTH(t.fecha_creacion)")->result();
		if(!empty($resultQuery)) {
			return $resultQuery;
		}
		return false;
	}

	public function obtenerMayorReclamoPorMes() {

		$resultQuery = $this->db->query("SELECT t.fecha_creacion, r.descripcion, COUNT(*) total FROM $this->tablaUsuarioReclamoParque t, `reclamos` r WHERE t.id_reclamo = r.id_reclamo GROUP BY YEAR(t.fecha_creacion), MONTH(t.fecha_creacion), r.descripcion")->result();

		if(!empty($resultQuery)) {
			return $resultQuery;
		}
		return false;
	}

	public function actualizarEstadoReclamos($nombreDocumento) {

		if(empty($nombreDocumento)) {
			return false;
		}

		$nombreDocumento = str_replace(".docx", "", $nombreDocumento);

		$datos = explode("-", $nombreDocumento);

		if(count($datos) !== 3) {
			return "Error al obtener los datos del documento";
		}

		$data = array();
  		//$reclamoStingLimpio = preg_replace("/[^A-Za-z0-9 ]/", "", $datos[0]); // Removes special chars.
  		//$reclamoPartesString = explode(" ", $reclamoStingLimpio); // cortar el string en distintas partes
  		$fechaPartesString = explode("_", $datos[2]); // cortar el string en distintas partes

		$parqueNombre = $datos[1];
		$reclamo = $datos[0];
		$mes = $fechaPartesString[0];
		$año = $fechaPartesString[1];

		$parque = $this->db->query("SELECT id_parque, nombre FROM $this->tablaParque WHERE url_parque LIKE '%". $parqueNombre ."%' ESCAPE '!'")->row();

		$usuariosReclamos = $this->db->query("SELECT id_usuario_reclamo_parque FROM $this->tablaUsuarioReclamoParque WHERE id_reclamo = ".$this->db->escape($reclamo)." and id_parque = ".$this->db->escape($parque->id_parque)." AND MONTH(fecha_creacion) = ".$this->db->escape($mes)." AND YEAR(fecha_creacion) = ".$this->db->escape($año)."")->result();

		if(!empty($usuariosReclamos)) {
			$ids = null;
			foreach($usuariosReclamos as $usuarioReclamo) {
				if(empty($ids)) {
					$ids = $usuarioReclamo->id_usuario_reclamo_parque;
				} else {
					$ids .= ",". $usuarioReclamo->id_usuario_reclamo_parque;
				}
			}
		}

		if(empty($ids)) {
			return "No se actualizaron los estados de los reclamos.";
		}

		$resultQuery =  $this->db->query("UPDATE $this->tablaUsuarioReclamoParque SET id_estado = 2 WHERE id_usuario_reclamo_parque IN (".$ids.")");

		return $resultQuery;
	}

	public function obtenerReclamoPlanilla() {

		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$hoy = date("Y-m-d H:i:s");
		$inicio = date("Y-m");
	//	$hoy = "2019-02-26 00:26:11";
	//	$inicio = "2019-02";

		/*SELECT count(id_reclamo) cantidad , id_reclamo , id_parque FROM usuarios_reclamos_parques Where `fecha_creacion` <= "2018-09-03 06:26:11" and `fecha_creacion` > '2018-09' group by id_parque, id_reclamo
		*/
		$resultQuery = $this->db->query("SELECT count(id_reclamo) cantidad , id_reclamo , id_parque FROM $this->tablaUsuarioReclamoParque WHERE id_estado = 1 AND fecha_creacion <= '$hoy' AND fecha_creacion > '$inicio' GROUP BY id_parque, id_reclamo;")->result();

		if(empty($resultQuery)) {
			return null;
		}

		//$reclamo = max($resultQuery);
		$reclamoMayor = array_search(max($resultQuery), $resultQuery);
		$reclamo = $resultQuery[$reclamoMayor];

		if($reclamo->cantidad < 0) {
			$this->expirarReclamos();
			return null;
		}

		$reclamo->parque = $this->obtenerParquePlanilla($reclamo->id_parque);
		$reclamo->reclamo = $this->obtenerDetalleReclamoPlanilla($reclamo->id_reclamo);
		$reclamo->usuarios = $this->obtenerUsuariosPlanilla($reclamo->id_reclamo, $reclamo->id_parque);

		$this->expirarReclamos($reclamo->usuarios);

		return !empty($reclamo) ? $reclamo : null;
	}

	protected function obtenerUsuariosPlanilla($idReclamo, $idParque) {

		$resultQuery = $this->db->query("
			SELECT urp.id_usuario_reclamo_parque, u.id_usuario, u.nombre, u.apellido, tp.descripcion as tipo_documento, u.numero_documento, u.email, urp.comentarios, urp.imagen
			FROM usuarios_reclamos_parques urp
			LEFT JOIN usuarios u ON urp.id_usuario = u.id_usuario
			LEFT JOIN tipos_documento tp ON tp.id_tipo_documento = u.id_tipo_documento
			WHERE id_reclamo = $idReclamo and id_parque = $idParque
			GROUP BY urp.id_usuario;
		")->result();

		return !empty($resultQuery) ? $resultQuery : null;
	}

	protected function obtenerParquePlanilla($idParque) {

		$resultQuery = $this->db->query("
			SELECT id_parque, nombre, url_parque, direccion
			FROM $this->tablaParque
			WHERE id_parque = $idParque
		")->row();

		return !empty($resultQuery) ? $resultQuery : null;
	}

	protected function obtenerDetalleReclamoPlanilla($idReclamo) {

		$resultQuery = $this->db->query("
			SELECT id_reclamo, descripcion
			FROM $this->tabla
			WHERE id_reclamo = $idReclamo
		")->row();

		return !empty($resultQuery) ? $resultQuery : null;
	}

	protected function expirarReclamos($data = null) {

		$mes = date("m");
		$año = date("Y");

		if(!empty($data)) {
			$ids = null;

			foreach($data as $dataReclamo) {
				if(empty($ids)) {
					$ids = $dataReclamo->id_usuario_reclamo_parque;
				} else {
					$ids .= ",". $dataReclamo->id_usuario_reclamo_parque;
				}
			}

			if(empty($ids)) {
				return;
			}

			$resultQuery =  $this->db->query("UPDATE $this->tablaUsuarioReclamoParque SET id_estado = 3 WHERE id_usuario_reclamo_parque NOT IN (".$ids.") AND MONTH(fecha_creacion) = ".$this->db->escape($mes)." AND YEAR(fecha_creacion) = ".$this->db->escape($año)."");
			return $resultQuery;
		}

		$resultQuery = $this->db->query("UPDATE $this->tablaUsuarioReclamoParque SET id_estado = 3 WHERE MONTH(fecha_creacion) = ".$this->db->escape($mes)." AND YEAR(fecha_creacion) = ".$this->db->escape($año)."");

		return $resultQuery;
	}

	public function eliminarReclamoPorUsuario($idReclamo, $nombreImagen) {

		$resultQuery = false;

		if(empty($idReclamo)) {
			return $resultQuery;
		}

		$this->db->where(array("id_usuario_reclamo_parque" => $idReclamo));
		$resultQuery = $this->db->delete("usuarios_reclamos_parques");

		if(empty($resultQuery)) {
			return false;
		}

		if(!empty($nombreImagen)) {

			$imagen = dirname(APPPATH) ."/public/img/reclamo/". $nombreImagen;

			if(file_exists($imagen)) {
				$result = unlink($imagen);
				return $result;
			}
		}

		return $resultQuery;
	}

	public function mostrarReclamo($idReclamo) {

		if(!empty($idReclamo)) {

			$resultQuery = $this->db->query("
				SELECT urp.id_usuario_reclamo_parque, r.descripcion as reclamo_decripcion, p.nombre as parque_nombre , re.descripcion, urp.comentarios, urp.fecha_creacion, urp.imagen, urp.latitud, urp.longitud
				FROM $this->tablaUsuarioReclamoParque urp
				LEFT JOIN parques p ON p.id_parque = urp.id_parque
				LEFT JOIN reclamos r ON r.id_reclamo = urp.id_reclamo
				LEFT JOIN reclamos_estado re ON re.id_estado = urp.id_estado
				WHERE urp.id_usuario_reclamo_parque = ". $this->db->escape($idReclamo) .""
			);

			return !empty($resultQuery->row()) ? $resultQuery->row() : null;
		}

		return $resultQuery = null;
	}

}

?>