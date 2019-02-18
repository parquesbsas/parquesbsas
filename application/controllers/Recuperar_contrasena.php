<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/My_util.php';

class Recuperar_contrasena extends MY_Util {

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

		$data["info"] = " | Recuperar contraseña";
		$data['logo']= 'logo.png';
		$this->load->view("/guest/head", $data);
		$this->load->view("/guest/nav", $data);
		$this->load->view("/user/email_recuperar_contrasena");
		$this->load->view("/guest/footer");

	}

	public function peticion() {
		if($this->input->is_ajax_request()) {

			$this->form_validation->set_rules("email", "email", "trim|required|valid_email|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>' );
			$this->form_validation->set_message('required', 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('valid_email', 'Debe ingresar un %s valido.');

			if($this->form_validation->run() === false) {

				$dataResponse = array(
					"email_forget" => form_error("email"),
					"res" => "error"
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
					$email_post = $this->input->post("email");
					$email = preg_replace('/\s+/', '', $email_post);
					$result = $this->mdl_usuario->insertarToken($email);
					$dataResponse = $this->validarRespuestaPeticion($result);
				}

			}
			echo json_encode($dataResponse);

		} else {
			show_404();
		}
	}

	protected function validarRespuestaPeticion($result) {
		if(is_object($result)) {
			$result = $this->enviarEmailRecuperarContraseña($result);
			if($result === true) {
				return array(
					"res" => "enviado",
					"message" => "Hemos enviado el mail correctamente."
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
				"message" => "Sucedio un error al solicitar su cambio de contraseña, intentelo mas tarde."
			);
		} elseif($result == false) {
			return array(
				"res" => "no_existe",
				"message" => "El email ingresado no existe."
			);
		}
	}

	public function formulario($email = null, $token = null) {

		if(empty($email) || empty($token)) {
			redirect(base_url()."Error404");
		}

		$token = trim($token);
		$usuario = $this->mdl_usuario->validarToken($email, $token);

		if(is_object($usuario))	{
			$data["info"] = "";
			$data['email']= $usuario->email;
			$data['logo']= 'logo.png';
			$this->load->view("/guest/head", $data);
			$this->load->view("/guest/nav", $data);
			$this->load->view("/user/formulario_recuperar_contrasena", $data);
			$this->load->view("/guest/footer");

		} else {
			redirect(base_url()."Error404");
		}
	}

	public function validarFormulario() {

		if($this->input->is_ajax_request()) {

			$this->form_validation->set_rules("contraseña", "contraseña", "trim|required|min_length[8]|max_length[16]|callback_checkPassword|xss_clean");

			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('valid_email' , 'Debe ingresar un %s valido.');
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			if($this->form_validation->run() === false) {

				$dataResponse = array(
					"message" => form_error("contraseña"),
					"res" => "error"
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
					$email = $this->input->post("email_pass");
					$contraseña = $this->input->post("contraseña");
					$contraseña = preg_replace("/\s+/", "", $contraseña);
					$result = $this->mdl_usuario->actualizarContraseña($contraseña, $email);

					$dataResponse = $this->validarRespuestaFormulario($result);
				}

			}

			echo json_encode($dataResponse);
	  } else {
			show_404();
		}
	}

	protected function validarRespuestaFormulario($result) {

		if($result == true) {
			return array(
				"res" => "actualizado",
				"message" => "Su contraseña fue actualizada."
			);
		} elseif(is_null($result)) {
			return array(
				"res" => "fallo_db",
				"message" => "Sucedio un error al actualizar su contraseña."
			);
		} elseif($result == false) {
			return array(
				"res" => "no_existe",
				"message" => "El email no se encuentra registrado."
			);
		}
	}
}