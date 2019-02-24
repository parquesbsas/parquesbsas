<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/core/My_util.php');

class Registro extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_usuario");
		$this->load->library("encrypt");
		$this->load->library("recaptcha");
	}

	public function index() {

		if($this->session->userdata('login')) {
			return redirect(base_url());
		}

		$data["info"] = " | Registro";
		$this->load->view("/guest/head",$data);
		$data["logo"] = "logo.png";
		$this->load->view("/guest/nav",$data);


		$result = $this->mdl_usuario->obtenerTipoDocumento();
		$new = new stdClass();
		$new->id_tipo_documento = "0";
		$new->descripcion = "Seleccione el tipo de documento :";
		array_unshift($result, $new);
		$data['tipo_dni'] = $result;
		$this->load->view("/guest/registro",$data);
		$this->load->view("/guest/footer");
	}

	public function crear() {

    	//solo entra aca si es una peticion ajax
		if($this->input->is_ajax_request()) {

			//Validaciones  y mensajes
			$this->form_validation->set_rules("nombre","nombre", "trim|required|callback_checkFieldName|min_length[5]|max_length[18]|xss_clean");
			$this->form_validation->set_rules("apellido","apellido", "trim|required|callback_checkFieldLastName|min_length[3]|max_length[18]|xss_clean");
			$this->form_validation->set_rules("numero_documento","numero de documento", "trim|callback_checkNumberDocument|xss_clean");
			$this->form_validation->set_rules("email_reg", "email", "trim|required|valid_email|xss_clean");
			$this->form_validation->set_rules("password","contraseña", "trim|required|min_length[8]|max_length[16]|callback_checkPassword|xss_clean");
			$this->form_validation->set_rules("password_confirm","confirmar contraseña", "trim|required|matches[password]|xss_clean");
			$this->form_validation->set_rules("tipo_dni","Tipo de documento", "xss_clean");


			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('alpha' , 'El campo %s debe contener solo letras.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');
			$this->form_validation->set_message('matches' , 'Las contraseñas no coinciden.');
			$this->form_validation->set_message('valid_email' , 'Debe ingresar un %s valido.');


			if($this->form_validation->run() === false) {

				 $dataResponse = array (
					"nombre"             => form_error("nombre"),
					"apellido"           => form_error("apellido"),
					"numero_documento"   => form_error("numero_documento"),
					"email_reg"          => form_error("email_reg"),
					"password"           => form_error("password"),
					"password_confirm"   => form_error("password_confirm"),
					"tipo_dni"           => form_error("tipo_dni"),
					"res"                => "error"
				);

			} else {

				$captchaAnswer = $this->input->post("g-recaptcha-response");
				$response = $this->recaptcha->verifyResponse($captchaAnswer);

				if($response["success"] == false) {
					$dataResponse = array(
						"res" => "error_captcha",
						"message" => "Debe completar el captcha"
					);
				} else {


					// Quitar espacios en blanco
					$this->mdl_usuario->nombre = trim($this->input->post("nombre"));
					$this->mdl_usuario->apellido  = trim($this->input->post("apellido"));
					$this->mdl_usuario->numero_documento = preg_replace('/\s+/', '', $this->input->post("numero_documento"));
					$this->mdl_usuario->email = preg_replace('/\s+/', '', $this->input->post("email_reg"));
					$this->mdl_usuario->contraseña = preg_replace('/\s+/', '', $this->input->post("password"));
					$this->mdl_usuario->tipoDni = $this->input->post("tipo_dni");

					$result = $this->mdl_usuario->registrarUsuario();
					$dataResponse = $this->validarRespuesta($result);
				}
			}

			echo(json_encode($dataResponse));
		} else {
			return redirect(base_url()."Error404");
		}
	}

	protected function validarRespuesta($result = null) {
		if(is_object($result)) {
			$result = $this->enviarEmailActivacion($result);
			if($result === true) {
				return array(
					"res" => "registrado",
					"message" => "Registrado, hemos enviado el mail de activacion correctamente."
				);
			} else {
				return array(
					"res" => "erroremail",
					"message" => $result
				);
			}

		} elseif(is_null($result)) {
			return array(
				"res" => "fallo_db",
				"message" => "Ocurrio un error al intentar registrar los datos del formulario."
			);
		} elseif($result == true) {
			return array(
				"res" => "existe",
				"message" => "El email ingresado ya existe."
			);
		}
	}

	//activar usuario
	public function activar($email = null, $token = null) {

		if(empty($email) || empty($token)) {
			return redirect(base_url()."Error404");
		}

		$this->mdl_usuario->token = trim($token);
		$this->mdl_usuario->email = $email;

		$usuario = $this->mdl_usuario->activarUsuario();

		if(is_object($usuario)) {
			$data["email"]= $usuario->email;
			$data["info"] = "";
			$data["logo"]= "logo.png";
			$this->load->view("/guest/head", $data);
			$this->load->view("/guest/nav", $data);
			$this->load->view("/user/cuenta_activada", $data);
			$this->load->view("/guest/footer");

		} elseif(is_null($usuario)) {
			// no existe el usuario
			return redirect(base_url()."Error404");
		} else {
			// Fallo el insert al actualizar
			return redirect(base_url()."Error404");
		}
	}
}