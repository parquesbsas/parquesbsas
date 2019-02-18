<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/My_util.php';

class Perfil extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_usuario");
		$this->load->library("encrypt");
	}
	public function index() {

		if($this->session->userdata("login") !== true || empty($this->session->userdata("id"))) {
			return header("Location: ". base_url());
		}

		$data["info"]= "";
		$this->load->view("/guest/head",$data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav",$data);

		$id = $this->session->userdata["id"];

		$usuario = $this->mdl_usuario->mostrarPerfil($id);

		if(empty($usuario)) {
			redirect(base_url()."Error404");
		}

		$dniOpciones = $this->ordenarDniOpciones($usuario);

		$result["tipo_dni"] = $dniOpciones;
		$result["result"] = $usuario;

		$this->load->view("/user/profile",$result);
		$this->load->view("/guest/footer");

	}

	protected function ordenarDniOpciones($usuario) {

		$tipoDni = $this->mdl_usuario->obtenerTipoDocumento();

		$dniOpciones = array();
		foreach($tipoDni as $dni) {
			if($usuario->id_tipo_documento == $dni->id_tipo_documento) {
				array_unshift($dniOpciones, $dni);
				continue;
			}
			$dniOpciones[] = $dni;
		}

		return $dniOpciones;
	}

	public function actualizar() {

		if($this->input->is_ajax_request()) {

			$validarContraseña = $this->input->post("validar_contrasenia_act");

			if(!empty($validarContraseña)) {
				$this->form_validation->set_rules("password_act","contraseña", "trim|required|min_length[8]|max_length[16]|callback_checkPassword|xss_clean");
			}

			$this->form_validation->set_rules("nombre","nombre", "trim|required|callback_checkFieldName|min_length[5]|max_length[18]|xss_clean");
			$this->form_validation->set_rules("apellido","apellido",  "trim|required|callback_checkFieldLastName|min_length[5]|max_length[18]|xss_clean");
			$this->form_validation->set_rules("tipo_dni","Tipo de documento", "trim|required|xss_clean");

			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('alpha' , 'El campo %s debe contener solo letras.');
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			if($this->form_validation->run() === false) {

				$data = array(
					"nombre_act"			=> form_error("nombre"),
					"apellido_act"			=> form_error("apellido"),
					"tipo_dni_act"			=> form_error("tipo_dni"),
					"res"					=> "error"
				);

				if(!empty($validarContraseña)) {
					$data = array_merge($data, array("password_act" => form_error("password_act")));
				}

			} else {

				$numeroDocumentoPost = $this->input->post("numero_documento_act");
				$validarNumeroDocumento = empty($numeroDocumentoPost) ? true : $this->form_validation->set_rules("numero_documento_act","numero de documento_act", "callback_checkNumberDocument|trim|xss_clean");

				if($this->form_validation->run() == false) {
					$data = array(
						"numero_documento_act" => form_error("numero_documento_act"),//$validarNumeroDocumento,
						"res" => "error"
					);
				} else {

					$nombreActualizar = $this->input->post("nombre");
					$apellidoActualizar = $this->input->post("apellido");
					$contraseñaActualizar = $this->input->post("password_act");
					$usuarioId = $this->input->post("id_user_act");
					$tipoDnipost = $this->input->post('tipo_dni');

					$data = array(
						"res" => "no_existe",
						"message" => "El usuario a actualizar no existe"
					);

					if(!empty($usuarioId)) { //|| !empty($this->session->userdata["id"])) {

						$this->mdl_usuario->idUsuario = $usuarioId;
						$this->mdl_usuario->nombre = trim($nombreActualizar);
						$this->mdl_usuario->apellido  = trim($apellidoActualizar);
						$this->mdl_usuario->numeroDocumento = preg_replace('/\s+/', '', $numeroDocumentoPost);
						$this->mdl_usuario->contraseña = preg_replace('/\s+/', '', $contraseñaActualizar);
						$this->mdl_usuario->tipoDni = preg_replace('/\s+/', '', $tipoDnipost);

						$result = $this->mdl_usuario->actualizarUsuario();

						if($result == true) {
							$data = array(
								"res" => "actualizado",
								"message" => "Perfil Actualizado"

							);
						} elseif(is_null($result)) {
							$data = array(
								"res" => "no_existe",
								"message" => "El usuario a actualizar no existe"
							);
						} elseif($result == false) {
							$data = array(
								"res" => "fail_db",
								"message" => "Hubo un error al actualizar sus datos, reintente nuevamente en unos minutos."
							);
						}
					}
				}
			}

			echo json_encode($data);

		} else {
			show_404();
		}
	}

	public function eliminar() {

		if($this->session->userdata("login") !== true || empty($this->session->userdata("id"))) {
			return redirect(base_url());
		}

		$usuarioId = $this->session->userdata("id");
		$result = $this->mdl_usuario->eliminarUsuario($usuarioId);

		if($result == true) {
			$this->session->sess_destroy();
			return redirect(base_url());
		}

		return redirect(base_url()."Error404");
	}
}
