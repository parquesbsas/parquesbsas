<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/core/My_util.php');

class Reenviar_email extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_usuario");
		$this->load->library("recaptcha");
	}

	public function index() {

		if($this->session->userdata('login')) {
			return redirect(base_url());
		}

		$data["info"] = " | Reenviar email activacion";
		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav",$data);
		$this->load->view("/user/reenviar_email_confirmacion");
		$this->load->view("/guest/footer");

	}

	public function enviar() {

		if($this->input->is_ajax_request()) {

			$this->form_validation->set_rules("email_resend", "email", "trim|required|valid_email|xss_clean");
			$this->form_validation->set_message("valid_email" , 'Debe ingresar un %s valido.');
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message("required" , 'El campo %s no puede estar vacio.');

			if($this->form_validation->run() === false) {

				$dataResponse = array(
					"email_resend" => form_error("email_resend"),
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
					$email = $this->input->post("email_resend");
					$email = preg_replace("/\s+/", "", $email);
					$result = $this->mdl_usuario->validarUsuarioEstado($email);
					$dataResponse = $this->validarRespuesta($result);
				}
			}

			echo json_encode($dataResponse);
		} else {
			return redirect(base_url()."Error404");
		}
	}

	protected function validarRespuesta($result) {

		if(is_object($result)) {
			$result = $this->enviarEmailActivacion($result);
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
				"message" => "Sucedio un error al solicitar el email de confirmacion."
			);
		} elseif($result == false) {
			return array(
				"res" => "no_existe",
				"message" => "El email no se encuentra registrado."
			);
		} elseif($result == true) {
			return array(
				"res" => "activado",
				"message" => "El usuario ya se encuentra activado."
			);
		}
	}
}

?>
