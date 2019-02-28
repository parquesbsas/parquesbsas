<?php

class MDL_Parque extends CI_Model {

	private $tabla = "parques";
	private $tablaEncuestaUsuarioParque = "encuestas_usuarios_parques";

	public $idParque, $idComuna, $idBarrio, $idWifi, $nombre, $descripcion, $direccion, $imagen, $patioJuegos, $latitud, $longitud, $likes, $hates, $imagenAndroid, $activo, $urlParque;

	public function obtenerParque($idParque, $nombreParque, $estado = true) {

		if(empty($idParque) && !empty($nombreParque)) {

			$parque = $this->db->query("
				SELECT p.id_parque, p.nombre, p.descripcion, p.direccion, p.imagen, p.patio_juegos, p.likes, p.hates, c.comuna, b.descripcion as  barrio, p.longitud, p.latitud, p.url_parque
				FROM $this->tabla p
				LEFT JOIN comunas c ON c.id_comuna = p.id_comuna
				LEFT JOIN barrios b ON b.id_barrio = p.id_barrio
				WHERE p.nombre LIKE '%". $this->db->escape_like_str($nombreParque) ."%' ESCAPE '!' AND p.activo = 1"
			)->result();

		} else if(!empty($idParque)) {

			$sql = "SELECT p.id_parque, p.nombre, p.descripcion, p.direccion, p.imagen, p.patio_juegos, p.likes, p.hates, p.id_wifi, c.comuna, c.id_comuna, b.descripcion as barrio, b.id_barrio, p.longitud, p.latitud, p.url_parque, p.activo
				FROM $this->tabla p
				LEFT JOIN comunas c ON c.id_comuna = p.id_comuna
				LEFT JOIN barrios b ON b.id_barrio = p.id_barrio
				WHERE p.id_parque = ".$this->db->escape($idParque);

			if($estado == true) {
				$sql = $sql ."AND p.activo = 1";
			}

			$parque = $this->db->query($sql)->row();
		}

		if(is_array($parque)) {
			return $parque;
		}

		return $parque;
	}

	public function obtenerParquesActivo() {
		$this->db->select("count(*) as number");
		$this->db->where("activo", "1");
		$this->db->where("nombre !=", "");
		$result = intval($this->db->get("parques")->row()->number);
		return $result;
	}

	public function obtenerParques($estado = true) {
		$this->db->select("*");
		if($estado == true) {
			$this->db->where("activo", "1");
		}
		$this->db->where("nombre !=", "");
		$parques = $this->db->get("parques")->result();
		return $parques;
	}

	public function obtenerPaginado($por_pagina, $segmento) {
		$this->db->select("*");
		$this->db->where("activo", "1");
		$this->db->where("nombre !=", "");
		$parques = $this->db->get('parques', $por_pagina,$segmento);

		if($parques->num_rows() > 0) {
			foreach($parques->result() as $parque) {
				$data[] = $parque;
			}
			return $data;
		}

		return null;
	}

	public function votar($columna) {

		if(empty($columna)) {
			return false;
		}

		if(isset($_COOKIE["votado_". $this->idParque])) {

			return date("Y-m-d h:i:s", $_COOKIE["tiempo_expiracion_voto"]);;

		} else {

			$sql = "SELECT {$columna} as total FROM $this->tabla WHERE id_parque = ? LIMIT 1";
			$resultQuery = $this->db->query($sql, array($this->idParque));

			if(empty($resultQuery)) { // Falla el escape de variables
				return false;
			}

			$totalVotos = $resultQuery->row();

			if($totalVotos === null) { // tiene que dar 0
				return false;
			}

			$totalVotos = intval($totalVotos->total);

			$totalVotos += 1;
			$sql = "UPDATE $this->tabla SET {$columna} = ". $totalVotos ." WHERE id_parque = ?";
			$resultQuery = $this->db->query($sql, array($this->idParque));

			if($resultQuery == true) {
				setcookie("votado_". $this->idParque, 1, time()+50);
				setcookie("tiempo_expiracion_voto", time()+50, time()+50);
				return $totalVotos;
			} else {
				return false;
			}

			return false;
		}

		return false;
	}

	public function buscarParquePorComuna($comuna) {
		if(!empty($comuna)) {
			$result = $this->db->query("SELECT id_parque, id_comuna, id_barrio, nombre, url_parque FROM $this->tabla p WHERE id_comuna = ". $this->db->escape($comuna)." AND activo = 1")->result();
			return !empty($result) ? $result : null;
		}
		return false;
	}

	public function buscarParquePorBarrio($barrio) {
		if(!empty($barrio)) {
			$result = $this->db->query("SELECT id_parque, id_comuna, id_barrio, nombre, url_parque FROM $this->tabla p WHERE id_barrio = ". $this->db->escape($barrio)." AND activo = 1")->result();
			return !empty($result) ? $result : null;
		}
		return false;
	}

	public function buscarParquePorFiltros($actividades, $juego, $feriaComun, $feriaItinerante, $centroSalud) {

		$from = $this->prepararFromQueryBusquedaPersonalizada($actividades, $juego, $feriaComun, $feriaItinerante, $centroSalud);
		$where = $this->prepararWhereQueryBusquedaPersonalizada($actividades, $juego, $feriaComun, $feriaItinerante, $centroSalud);

		if(empty($where)) {
			return false;
		}

		$parques = $this->db->query("SELECT p.id_parque, p.nombre, p.url_parque FROM $from WHERE $where and p.activo = 1 group by p.nombre")->result();
		return $parques;
	}

	protected function prepararFromQueryBusquedaPersonalizada($actividades, $juego, $feriaComun, $feriaItinerante, $centroSalud) {
		$from = "parques p";

		if($actividades) {
			$from = $from .", parques_actividades pa";
		}

		if(!empty($feriaComun) && $feriaComun != "-") {
			$from = $from .", ferias_comunes fc";
		}

		if($feriaItinerante) {
			$from = $from .", ferias_itinerantes fi";
		}

		if($centroSalud) {
			$from = $from .", estaciones_salud es";
		}

		return $from;
	}

	protected function prepararWhereQueryBusquedaPersonalizada($actividades, $juego, $feriaComun, $feriaItinerante, $centroSalud) {
		$where = null;

		if($actividades) {
			$filter = null;
			foreach($actividades as $idActividad) {
				$filter .= "pa.id_actividad = ". $this->db->escape($idActividad) ." OR ";
			}
			$filter = rtrim($filter, "OR "); // Elimino el OR final
			$where = "p.id_parque = pa.id_parque and ($filter)";
		}

		if(!empty($feriaComun) && $feriaComun != "-") {
			if(empty($where)) {
				$where = $where ."p.id_parque = fc.id_parque and fc.tipo = ". $this->db->escape($feriaComun) ."";
			} else {
				$where = $where ." and p.id_parque = fc.id_parque and fc.tipo =  ". $this->db->escape($feriaComun) ."";
			}
		}

		if($juego) {
			if(empty($where)) {
				$where = $where ."p.patio_juegos = 1";
			} else {
				$where = $where ." and p.patio_juegos = 1";
			}
		}

		if($feriaItinerante) {
			if(empty($where)) {
				$where = $where ."p.id_parque = fi.id_parque";
			} else {
				$where = $where ." and p.id_parque = fi.id_parque";
			}
		}

		if($centroSalud) {
			if(empty($where)) {
				$where = $where ."p.id_parque = es.id_parque";
			} else {
				$where = $where ." and p.id_parque = es.id_parque";
			}
		}

		return $where;
	}

	public function obtenerEstadisticaEncuestaPorParque() {
		$resultQuery = $this->db->query("SELECT e.descripcion, COUNT(*) total FROM ". $this->tablaEncuestaUsuarioParque ." eup , parques p, encuestas e WHERE e.id_encuesta = eup.id_encuesta and p.id_parque = ". $this->db->escape($this->idParque) ." and eup.id_parque = ". $this->db->escape($this->idParque) ." GROUP BY e.descripcion")->result();
		return $resultQuery;
	}

	public function actualizarParque() {

		$query = "UPDATE ". $this->tabla ." SET nombre = ". $this->db->escape($this->nombre) .", descripcion = ". $this->db->escape($this->descripcion) .", direccion = ". $this->db->escape($this->direccion) .", patio_juegos = ". $this->db->escape_str($this->patioJuegos) .", id_wifi = ". $this->db->escape_str($this->idWifi) .", latitud = ". $this->db->escape($this->latitud) .", longitud = ". $this->db->escape($this->longitud) .", activo = ". $this->db->escape_str($this->activo) .", url_parque = ". $this->db->escape($this->urlParque) .", id_barrio = ". $this->db->escape_str($this->idBarrio) .", id_comuna = ". $this->db->escape_str($this->idComuna) ." WHERE id_parque = ". $this->db->escape_str($this->idParque) ." ";

		$resultQuery = $this->db->query($query);

		if(empty($resultQuery)) {
			return false;
		}

		return true;
	}

	public function crear() {

		$saveImage = $this->guardarImagen();

		if(!empty($saveImage["file_name"])) {

			$this->imagen = $saveImage["file_name"];
			$this->imagenAndroid = $saveImage["file_name"];

			$sql = "INSERT INTO $this->tabla (nombre, descripcion, direccion, id_barrio, id_comuna, url_parque, patio_juegos, id_wifi, imagen, imagen_android, latitud, longitud, activo) VALUES(". $this->db->escape($this->nombre) .", ". $this->db->escape($this->descripcion) .", ". $this->db->escape($this->direccion) .", ". $this->db->escape_str($this->idBarrio) .", ". $this->db->escape_str($this->idComuna) .", ". $this->db->escape($this->urlParque) .", ". $this->db->escape_str($this->patioJuegos) .", ". $this->db->escape_str($this->idWifi) .", ". $this->db->escape($this->imagen) .", ". $this->db->escape($this->imagenAndroid) .", ". $this->db->escape($this->latitud) .", ". $this->db->escape($this->longitud) .", 1);";

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

		$config["encrypt_name"] = TRUE;
		$config["upload_path"] = "./public/img/parques";
		$config["allowed_types"] = "jpg|JPEG|jpeg";
		$config["max_size"] = "2048";
		$config["max_width"] = "1680";
		$config["max_height"] = "1054";

		$this->load->library("upload", $config);

		$this->upload->initialize($config);

		if(!$this->upload->do_upload("crearParqueImagen")) {
			return $this->upload->display_errors();
		} else {
			return $this->upload->data();
		}
		return false;
	}

	public function obtenerEmailOngs() {

		$sqlOng = "SELECT o.id_ong, o.nombre_ong, o.nombre_referente, o.apellido_referente, o.email_ong, o.email_referente, o.telefono_ong, o.telefono_referente, b.descripcion as barrio, o.id_barrio
				FROM ongs o LEFT JOIN barrios b ON o.id_barrio = b.id_barrio";

		if(empty($this->db->query($sqlOng))) {
			return false;
		}

		$ongs = $this->db->query($sqlOng)->result();

		if(empty($ongs)) {
			return false;
		}

		$idsBarrio = null;
		$ongsOrdenado = array();

		foreach($ongs as $ong) {

			if(empty($ongsOrdenado[$ong->barrio])) {
				$ongsOrdenado[$ong->barrio] = new stdClass();
				$ongsOrdenado[$ong->barrio]->ongs = array();
				$ongsOrdenado[$ong->barrio]->parques = null;
			}

			$ongsOrdenado[$ong->barrio]->ongs[] = $ong;

			if(empty($idsBarrio)) {
				$idsBarrio = $ong->id_barrio;

			} else {
				$idsBarrio .= ", ". $ong->id_barrio;
			}
		}

		$idsBarrioArray = explode(", ", $idsBarrio);

		$idsBarrioSql = [];

		foreach($idsBarrioArray as $key => $idBarrio) {
			$idsBarrioSql[$idBarrio] = $key;
		}

		$idsBarrioSql = array_flip($idsBarrioSql);
		$idsBarrioSql = implode(", ", $idsBarrioSql);

		$sqlParques = "SELECT p.nombre, b.descripcion as barrio FROM $this->tabla p LEFT JOIN barrios b ON p.id_barrio = b.id_barrio where p.id_barrio in ($idsBarrioSql) AND p.activo <> 0 OR p.activo <> null";

		if(empty($this->db->query($sqlParques))) {
			return false;
		}

		$parques = $this->db->query($sqlParques)->result();

		if(empty($parques)) {
			return false;
		}

		foreach($parques as $parque) {

			if(!empty($ongsOrdenado[$parque->barrio])) {

				$ongsOrdenado[$parque->barrio]->parques = !empty($ongsOrdenado[$parque->barrio]->parques) ? $ongsOrdenado[$parque->barrio]->parques : $parque->nombre;

				if(strpos($ongsOrdenado[$parque->barrio]->parques, $parque->nombre) !== false) {
					continue;
				}

				$ongsOrdenado[$parque->barrio]->parques .= ", ". $parque->nombre;
			}

		}

		return $ongsOrdenado;
	}
}

?>