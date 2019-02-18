<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/core/My_util.php');

class Sesion extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->library("encrypt");
	}

	public function login() {

		if(!empty($this->session->id)) {

			redirect(base_url()."Error404");
		}

		if($this->input->is_ajax_request()) {

			//Validaciones
			$this->form_validation->set_rules("email","email", "trim|required|valid_email|xss_clean");
			$this->form_validation->set_rules("contraseña", "contraseña", "trim|required|min_length[8]|max_length[16]|callback_checkPassword|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('valid_email' , 'Debe ingresar un %s valido.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			if($this->form_validation->run() === false) {

				$data = array (
					"email_login" => form_error("email"),
					"contraseña_login" => form_error("contraseña"),
					"res" => "error"
				);

			} else {

				$email = $this->input->post("email"); // attributo name del input en el html
				$contraseña = $this->input->post("contraseña"); // attributo contrnameaseña del input en el html
				$this->load->model("mdl_usuario");

				$user = $this->mdl_usuario->validarUsuarioLogin($email, $contraseña);

				if(is_object($user)) {

					$dataSesion = array(
						"user" => $user->email,
						"id" => $user->id_usuario,
						"activo" => $user->activo,
						"perfil" => $user->id_tipo_usuario,
						"login" => true,
						"user_name" => $user->nombre ." ". $user->apellido,
						"google" => false
					);

					$this->session->set_userdata($dataSesion);

					$data = array(
						"res" => "sesion",
						"message" => "Bienvenido"
					);

				} else {

					$data = array(
						"res" => "no_existe",
						"message" => "El usuario y la contraseña no coinciden"
					);
				}
			}

			echo json_encode($data);

		} else {
			show_404();
		}
	}

	public function logout() {
		//destruyo la session
		if($this->session->userdata("login") == true) {
			$this->session->sess_destroy();
			header("Location: ". base_url());
		}
		header("Location: ". base_url());
	}
}
?>