<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Util extends CI_Controller {

	static $meses = array(
		"01" => "Enero",
		"02" => "Febrero",
		"03" => "Marzo",
		"04" => "Abril",
		"05" => "Mayo",
		"06" => "Junio",
		"07" => "Julio",
		"08" => "Agosto",
		"09" => "Septiembre",
		"10" => "Octubre",
		"11" => "Noviembre",
		"12" => "Diciembre"
	);

	public function __construct() {
		parent::__construct();
	}

	public function checkOnlyString($data = null) {

		if(empty($data) || !preg_match("/^[\p{L}\s]+$/ui", $data)) {
			$this->form_validation->set_message("checkOnlyString", "El campo %s acepta solo carateres alfabeticos.");
			return false;
		}

		return true;
	}

	// VALIDAR NOMBRE , valido que ingrese solo letras;
	public function checkFieldName($name = null) {

		if(empty($name) || !preg_match("/^[\p{L}\s]+$/ui", $name)) {

			$this->form_validation->set_message("checkFieldName", "El campo %s acepta solo carateres alfabeticos.");
			return false;
		}
		return true;
	}

	// VALIDAR APELLIDO , valido que ingrese solo letras;
	public function checkFieldLastName($lastName = null) {

		if(empty($lastName) || !preg_match("/^[\p{L}\s]+$/ui", $lastName)) {

			$this->form_validation->set_message("checkFieldLastName", "El campo %s acepta solo carateres alfabeticos.");
			return false;
		}
		return true;
	}

	// VALIDAR CONTRASEÑA , valido que ingrese combinaciones en minúsculas, mayúsculas, números y caracteres especiales;
	public function checkPassword($password = null) {

		if(empty($password) || !preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/', $password)) {
			$this->form_validation->set_message('checkPassword', 'La %s debe contener combinaciones en minúsculas, mayúsculas, números y caracteres especiales.');
			return false;
		}
		return true;
	}


	// VALIDAR NUMERO DE DOCUMENTO
	public function checkNumberDocument($numeroDocumento = null, $tipoDocumento = null) {

		$tipoDocumento = !empty($this->input->post("tipo_dni")) ? $this->input->post("tipo_dni") : "0"; // sin documento
		$numeroDocumento = !empty($numeroDocumento) ? preg_replace("/\s+/", "", $numeroDocumento) : $numeroDocumento; //limpio los espacios
		// VALIDO QUE INGRESE EL TIPO DE DNI SI INGRESO UN NUMERO

		if($numeroDocumento != null and $tipoDocumento == "0") {

			$this->form_validation->set_message('checkNumberDocument', 'Usted no eligio un tipo de documento.');
			return false;

			// VALIDO DNI
		} elseif($numeroDocumento != null and $tipoDocumento == "1") {

			//valido solo numeros
			if(!preg_match('/^[0-9 .\-]+$/i', $numeroDocumento)) {

				$this->form_validation->set_message('checkNumberDocument', 'Usted debe ingresar solo numeros.');
				return false;

			} elseif(strlen($numeroDocumento) > 8 || strlen($numeroDocumento) < 8) {

				$this->form_validation->set_message('checkNumberDocument', 'El DNI consta de 8 numeros.');
				return false;

			} else {
				return true;
			}

			// VALIDO LOS DEMAS MENOS  PASAPORTE
		} elseif($numeroDocumento != null and $tipoDocumento == "2" || $tipoDocumento == "3" ||  $tipoDocumento == "5" || $tipoDocumento == "6" ) {

			if(!preg_match('/^[0-9 .\-]+$/i', $numeroDocumento)) {

				$this->form_validation->set_message('checkNumberDocument', 'Usted debe ingresar solo numeros.');
				return false;

			} elseif(strlen($numeroDocumento) > 10) {

				$this->form_validation->set_message('checkNumberDocument', 'El campo numerico no puede exceder los 10 digitos.');
				return false;

			} else {
				return true;
			}

		//VALIDO  PASAPORTE
		} elseif($numeroDocumento != null and $tipoDocumento == "4") {

			//solo letras y numeros hasta 10
			if(!preg_match('/^[A-Za-z0-9\s]+$/ui', $numeroDocumento)) {

			$this->form_validation->set_message('checkNumberDocument', 'No se permiten caracteres especiales ni letras con acentos.');
			return false;

			} elseif(strlen($numeroDocumento) > 10) {

				$this->form_validation->set_message('checkNumberDocument', 'El campo numerico no puede exceder los 10 caracteres.');
				return false;

			} else {
				return true;
			}

			// valido q ingrese el numero de documento
		} elseif($tipoDocumento != "0" and $numeroDocumento == null) {

			$this->form_validation->set_message('checkNumberDocument', 'Usted debe completar el campo numerico.');
			return false;
		} else {
			return true;
		}
	}

	protected function enviarEmailActivacion($usuario) {

		$data = array();
		$data["usuario"] = $usuario;

		$rutaLogoImage = dirname(dirname(__DIR__)). "/public/img/logo.png";
		$rutaGoogleImage = dirname(dirname(__DIR__)). "/public/img/google-play.png";
		$rutaWebImage = dirname(dirname(__DIR__)). "/public/img/web-app.png";

		$this->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth	= true;
		$mail->Port = 465;
		$mail->Username = "parquesbsas@gmail.com";
		$mail->Password = "Parquesbsas2019!";
		$mail->SMTPSecure = "ssl";
		$mail->SetFrom('parquesbsas@gmail.com');
		$mail->AddAddress($usuario->email);
		$mail->AddReplyTo("parquesbsas@gmail.com");
		$mail->Subject = "Activar Cuenta en Parques Bs As";
		$mail->AddEmbeddedImage($rutaLogoImage, "logo");
		$mail->AddEmbeddedImage($rutaGoogleImage, "google");
		$mail->AddEmbeddedImage($rutaWebImage, "web");
		$mail->Body = $this->load->view("/guest/email_template", $data, true);
		$mail->IsHTML(true);

		if(!$mail->send()) {
			return "Error al enviar el email: Si el problema persiste contactenos a traves del email parquesbsas@gmail.com";
		} else {
			return true;
		}
	}

	protected function enviarEmailRecuperarContraseña($usuario) {
		$data = array();
		$data["usuario"] = $usuario;

		$rutaLogoImage = dirname(dirname(__DIR__)). "/public/img/logo.png";

		$this->load->library('My_PHPMailer');

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Port = 465;
		$mail->Username = "parquesbsas@gmail.com";
		$mail->Password = "Parquesbsas2019!";
		$mail->SMTPSecure = "ssl";
		$mail->SetFrom('parquesbsas@gmail.com');
		$mail->AddAddress($usuario->email);
		$mail->AddReplyTo("parquesbsas@gmail.com");
		$mail->Subject = "Recuperar Contraseña";
		$mail->AddEmbeddedImage($rutaLogoImage, "logo");
		$mail->Body = $this->load->view("/guest/contrasena_template", $data, true);
		$mail->IsHTML(true);
		if(!$mail->send()) {
			return "Error al enviar el email: Si el problema persiste contactenos a traves del email parquesbsas.contacto@gmail.com";
		} else {
			return true;
		}
	}

	protected function formatearResultadoEstadistica($resultQueryReclamos) {
		$result = array();
		foreach(static::$meses as $mes) {
			$result[$mes] = 0;
		}

		foreach($resultQueryReclamos as $value) {
			$añoRegistro = date("Y", strtotime($value->fecha_creacion));
			$añoActual = date("Y");
			if($añoActual != $añoRegistro) {
				continue;
			}
			$date = date("m", strtotime($value->fecha_creacion));
			$result[static::$meses[$date]] += $value->total;
		}
		return $result;
	}

	protected function formatearEstadisticaReclamoPorMes($resultQuery) {
		$resultQuery = $this->agregarMes($resultQuery);
		$resultQuery = $this->armarEstructuraPorMes($resultQuery);
		return $this->contarReclamosPorMes($resultQuery);
	}

	protected function agregarMes($resultQuery) {
		$añoActual = date("Y");
		foreach($resultQuery as $key => $value) {

			$añoRegistro = date("Y", strtotime($value->fecha_creacion));
			if($añoActual != $añoRegistro) {
				unset($resultQuery[$key]);
				continue;
			}

			$date = date("m", strtotime($value->fecha_creacion));
			$value->fecha_creacion = static::$meses[$date];
		}
		return $resultQuery;
	}

	protected function armarEstructuraPorMes($resultQuery) {
		$result = array();

		foreach($resultQuery as $key => $value) {
			$result[$value->fecha_creacion][$key] = $value;
		}

		return $result;
	}

	protected function contarReclamosPorMes($resultQuery) {
		$total = array();
		foreach($resultQuery as $mes => $reclamos) {

			$total[$mes]["reclamo"] = new stdClass;
			$total[$mes]["reclamo"]->total = "0";

			if(empty($reclamos)) {
				continue;
			}

			foreach($reclamos as $value) {
				if($value->total >= $total[$mes]["reclamo"]->total) {
					$total[$mes]["reclamo"] = $value;
				}
			}
		}

		return $total;
	}

	protected function enviarEmailDocumentoReclamo($emailComuna, $emailOng, $comentario, $documento) {

		$nombreDocumento = $documento["name"];

		$datos = explode("-", $nombreDocumento);

		if(count($datos) !== 3) {
			return "Asegurese de cargar el documento correcto (formato reclamo-parque-fecha).";
		}

		$reclamo = $this->db->query("SELECT descripcion FROM reclamos WHERE id_reclamo = ".$this->db->escape($datos[0])."")->row();

		$data = array();

		$data["parque"] = str_replace("_", " ", $datos[1]); // replace all "_" with space
		$data["reclamo"] = !empty($reclamo->descripcion) ? $reclamo->descripcion : "";
		$data["comentario"] = $comentario;

		$rutaLogoImage = dirname(dirname(__DIR__)). "/public/img/logo.png";

		$this->load->library('My_PHPMailer');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth	= true;
		$mail->Port = 465;
		$mail->Username = "parquesbsas@gmail.com";
		$mail->Password = "Parquesbsas2019!";
		$mail->SMTPSecure = "ssl";
		$mail->SetFrom('parquesbsas@gmail.com');

		if(!empty($emailComuna)) {
			$mail->AddAddress($emailComuna);
		}

		if(!empty($emailOng)) {
			$mail->AddAddress($emailOng);
		}

		$mail->AddReplyTo("parquesbsas@gmail.com");
		$mail->Subject = "Reclamo Documento";
		$mail->AddEmbeddedImage($rutaLogoImage, "logo");
		$mail->Body = $this->load->view("/user/email_documento_template", $data, true);
		$mail->AddAttachment($documento["tmp_name"], $documento["name"]);
		$mail->IsHTML(true);

		if(!$mail->send()) {
			return "Error al enviar el email: Si el problema persiste contactenos a traves del email parquesbsas@gmail.com";
		} else {
			return true;
		}
	}
}