<?php

class MDL_Usuario extends CI_Model {

	private $tabla = "usuarios";
	private $tablaUsuarioTipo = "usuarios_tipo";
	private $tablaUsuarioReclamoParqueRel = "usuarios_reclamos_parques";
	private $tablaTipoDocumento = "tipos_documento";
	
	public $idUsuario, $nombre, $apellido, $contraseña, $email, $numeroDocumento, $tipoDni, $token, $idGoogle;


	public function registrarUsuario() {

		//pregunto si existe el usuario
		$usuario = $this->db->query("SELECT email FROM $this->tabla WHERE email = ". $this->db->escape($this->email) ." LIMIT 1")->row();
		
		if(!empty($usuario)) {
			return true;
		
		} else {
			
			$this->tipoDni = empty($tipoDni) ? "1" : $tipoDni;
			//Generar Token
			$cadena = $this->nombre.$this->email.rand(1,9999999).date('Y-m-d');
			$this->token = sha1($cadena);

			//Encriptar pass
			$this->contraseña = $this->encrypt->encode($this->contraseña);
			$fechaCreacion = date("Y-m-d H:i:s");

			$resultQuery = $this->db->query("INSERT INTO $this->tabla (id_tipo_usuario,nombre,contrasenia,email,apellido,numero_documento,id_tipo_documento,token,fecha_creacion) Values (1, ". $this->db->escape($this->nombre) .",". $this->db->escape($this->contraseña) ." , ". $this->db->escape($this->email) .", ". $this->db->escape($this->apellido) .", ". $this->db->escape($this->numeroDocumento) .", ". $this->db->escape_str($this->tipoDni) .", ". $this->db->escape($this->token) .", '$fechaCreacion');");
			
			if($resultQuery == true) {
				$usuario = new stdClass();
				$usuario->email = $this->email;
				$usuario->nombre = $this->nombre;
				$usuario->apellido = $this->apellido;
				$usuario->token = $this->token;
				return $usuario;
			}
		}
		return null;
	}

	public function activarUsuario() {

		$usuario = $this->db->query("SELECT email, token FROM $this->tabla WHERE email = ". $this->db->escape($this->email) ." AND token = ". $this->db->escape($this->token) ." LIMIT 1")->row();
		
		if(empty($usuario)) {
			return null;
		}

		$resultQuery = $this->db->query("UPDATE $this->tabla SET activo = 1, token = NULL WHERE email = ". $this->db->escape($this->email) ." LIMIT 1");

		if($resultQuery !== true) {
			return false;
		}

		return $usuario;
	}

	public function insertarToken($email) {

		$usuario = $this->db->query("SELECT id_usuario, nombre, email FROM $this->tabla WHERE email = ". $this->db->escape($email) ." AND activo = 1 OR activo = 2 LIMIT 1")->row();

		if(empty($usuario)) {
			return false;
		}

		$cadena = $usuario->nombre.$usuario->email.rand(1,9999999).date('Y-m-d');
		$token = sha1($cadena);

		$resultQuery = $this->db->query("UPDATE usuarios SET token = '$token' WHERE email = '$email' LIMIT 1");

		if($resultQuery == true) {
			$usuario->token = $token;
			return $usuario;
		}

		return null;
 
	}

	public function validarToken($email = null, $token = null) {

		if(empty($email) || empty($token)) {
			return false;
		}

		$usuario = $this->db->query("SELECT email, token FROM $this->tabla WHERE email =  ". $this->db->escape($email) ." AND token =  ". $this->db->escape($token) ." LIMIT 1")->row();

		if(empty($usuario)) {
			return false;
		}

		return $usuario;
	}

	public function actualizarContraseña($contraseña = null, $email = null) {

		$usuario = $this->db->query("SELECT nombre, email, activo FROM $this->tabla WHERE email = ". $this->db->escape($email) ." LIMIT 1")->row();

		if(!empty($usuario)) {

			$contraseña = $this->encrypt->encode($contraseña);
			
			$resultQuery = $this->db->query("UPDATE $this->tabla SET contrasenia = ". $this->db->escape($contraseña) .", token = NULL WHERE email = ". $this->db->escape($email) ." LIMIT 1");

			if($resultQuery == true) {
				return true;
			} else {
				return null;
			}
		}
		return false;
	}

	public function validarUsuarioLogin($email, $contraseña) {

		if(empty($email) || empty($contraseña)) {
			return false;
		}

		$usuario = $this->db->query("SELECT * FROM $this->tabla WHERE email = ". $this->db->escape($email) ." AND activo = 1 LIMIT 1")->row();
		if(empty($usuario)) {
			return false;
		}

		if($this->encrypt->decode($usuario->contrasenia) != $contraseña) {
			return false;
		}
		return $usuario;
	}	
	
	public function mostrarPerfil($idUsuario) {
		$usuario = $this->db->query("SELECT id_usuario,id_tipo_usuario,t.id_tipo_documento,nombre,apellido,numero_documento,email,contrasenia,activo,t.descripcion, id_google FROM $this->tabla LEFT JOIN tipos_documento t ON usuarios.id_tipo_documento = t.id_tipo_documento WHERE id_usuario =  ". $this->db->escape($idUsuario) ." LIMIT 1")->row();
		if(empty($usuario)) {
			return false;
		}

		$usuario->contrasenia = $this->encrypt->decode($usuario->contrasenia);

		return $usuario;
	}

	public function actualizarUsuario() {

		$id = !empty($this->session->userdata["id"]) ? $this->session->userdata["id"] : $this->idUsuario;
		$result = $this->db->query("SELECT * FROM $this->tabla WHERE id_usuario = ". $this->db->escape($id) ." LIMIT 1");
		$data = $result->row();
		// si hay mas de un registro nos devuelve una fila
		
		if(!empty($data)) {

			//Encriptar pass
			$contraseña = $this->encrypt->encode($this->contraseña);
			$sql = "UPDATE $this->tabla SET nombre = ". $this->db->escape($this->nombre) .", apellido =". $this->db->escape($this->apellido) .", contrasenia = ". $this->db->escape($contraseña) .", numero_documento = ". $this->db->escape($this->numeroDocumento) .", id_tipo_documento = ". $this->db->escape($this->tipoDni) ." WHERE id_usuario = ". $this->db->escape($id) ." limit 1";
			
			if($this->db->query($sql) === true && $this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		return null;
	}

	public function validarUsuarioEstado($email) {

		if(empty($email)) {
			return false;
		}
			
		//pregunto si existe el usuario y si esta desactivado
		$usuario = $this->db->query("SELECT nombre, email, activo FROM $this->tabla WHERE email = ". $this->db->escape($email) ." LIMIT 1")->row();

		if(empty($usuario)) {
			return false;
		}

		if($usuario->activo == 0) {
			
			$cadena = $usuario->nombre.$usuario->email.rand(1,9999999).date('Y-m-d');
			$token = sha1($cadena);
			
			$resultQuery = $this->db->query("UPDATE $this->tabla SET token = ". $this->db->escape($token) ." WHERE email = ". $this->db->escape($email) ." LIMIT 1");

			if($resultQuery == true) {
				$usuario->token = $token;
				return $usuario;
			} else {
				return null;
			}

		} else {
			return true;
		}
	}	

	public function mostrarReclamosPorUsuario($idUsuario) {

		if(!empty($idUsuario)) {

			$resultQuery = $this->db->query("
				SELECT urp.id_usuario_reclamo_parque, r.descripcion as reclamo_decripcion, p.nombre as parque_nombre , re.descripcion, urp.comentarios, urp.fecha_creacion, urp.imagen, urp.latitud, urp.longitud
				FROM usuarios_reclamos_parques urp
				LEFT JOIN parques p ON p.id_parque = urp.id_parque
				LEFT JOIN reclamos r ON r.id_reclamo = urp.id_reclamo
				LEFT JOIN reclamos_estado re ON re.id_estado = urp.id_estado
				WHERE id_usuario = ". $this->db->escape($idUsuario) .""
			);

			return !empty($resultQuery->result()) ? $resultQuery->result() : null;
		}
		return $resultQuery = null;
	}

	public function eliminarUsuario($idUsuario) {

		if(!empty($idUsuario)) {
			
			$usuario = $this->db->query("SELECT * FROM $this->tabla WHERE id_usuario = ". $this->db->escape($idUsuario) ." LIMIT 1")->row();

			if(empty($usuario)) {
				return null;
			}

			$resultQuery = $this->db->query("UPDATE $this->tabla SET activo = 0, numero_documento = null, contrasenia = null, id_tipo_documento = 1, token = null, id_google = null WHERE id_usuario = ".$this->db->escape($idUsuario)."");

			return $resultQuery;
		}

		return $resultQuery = null;
	}

	public function obtenerEstadisticaUsuario() {

		$resultQuery = $this->db->query("SELECT t.fecha_creacion, COUNT(*) total FROM $this->tabla t GROUP BY YEAR(t.fecha_creacion), MONTH(t.fecha_creacion)")->result();
		if(!empty($resultQuery)) {
			return $resultQuery;
		}
		return false;
	}

	public function obtenerUsuariosActivos() {
		$result = $this->db->query("SELECT u.id_usuario, u.nombre, u.apellido, ut.id_tipo, ut.descripcion as perfil FROM $this->tabla u LEFT JOIN $this->tablaUsuarioTipo ut ON u.id_tipo_usuario = ut.id_tipo")->result();
		return $result;
	}

	public function obtenerPerfiles() {
		$result = $this->db->query("SELECT * FROM  ". $this->tablaUsuarioTipo ."")->result();
		return $result;
	}

	public function actualizarPerfil($idUsuario, $idTipoUsuario) {

		if(empty($idUsuario) || empty($idTipoUsuario)) {
			return false;
		}

		$resultQuery = $this->db->query("UPDATE $this->tabla SET id_tipo_usuario = ".$this->db->escape($idTipoUsuario)." WHERE id_usuario = ".$this->db->escape($idUsuario)."");

		return $resultQuery;
	}

	public function obtenerTipoDocumento() {
		$result = $this->db->query("SELECT * FROM $this->tablaTipoDocumento");
		return $result->result();
	}

	public function registroGoogle() {

		$sql = "SELECT * FROM $this->tabla WHERE email = ". $this->db->escape($this->email) ." limit 1;";
		$result = $this->db->query($sql);
		$data = $result->row();

		if(!empty($data) && empty($data->id_google) && ($data->activo == 1 || $data->activo == 0)) {
			// vincular
			$sql = "UPDATE $this->tabla SET id_google = ". $this->db->escape($this->idGoogle) ." WHERE id_usuario = '$data->id_usuario' limit 1";

			if($this->db->query($sql)) {
				return $data;
			} else {
				return false;
			}			

		
		} elseif(!empty($data) && !empty($data->id_google) && $data->id_google == $this->idGoogle) {
			//devuelvue el usuario
			return $data;

		} elseif(empty($data)) {
			//se crea el registro
			$fecha_creacion = date("Y-m-d H:i:s");
			$sql = "INSERT INTO $this->tabla (id_tipo_usuario, nombre, apellido, email, contrasenia, id_tipo_documento, id_google, activo, fecha_creacion) Values (1, ". $this->db->escape($this->nombre) .", ". $this->db->escape($this->apellido) .", ". $this->db->escape($this->email) .", '', '1', ". $this->db->escape($this->idGoogle) .", '1', '$fecha_creacion');";
			if($this->db->query($sql)) {
				
				$sql = "SELECT * FROM $this->tabla WHERE email = ". $this->db->escape($this->email) ." limit 1;";
				$result = $this->db->query($sql);
				return $result->row();

			} else {
				return false;
			}
		}
		return false;
	}


}

?>