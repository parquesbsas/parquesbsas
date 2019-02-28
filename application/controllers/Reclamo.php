<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'/core/My_util.php');

class Reclamo extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_usuario");
		$this->load->model("mdl_reclamo");
		$this->load->library("My_PHPMailer");
		$this->load->library("recaptcha");
		$this->load->library("encrypt");
	}

	public function index() {

		if(!empty($this->session->id)) {
			$data["info"] = " | Mis Reclamos";
			$this->load->view("/guest/head", $data);
			$data['logo'] = "logo.png";
			$this->load->view("/guest/nav", $data);

			$reclamos = $this->mdl_usuario->mostrarReclamosPorUsuario($this->session->id);
			$reclamos["reclamos"] = $reclamos;
			$this->load->view("/user/reclamos", $reclamos);
			$this->load->view("/guest/footer");

		} else {
			return redirect(base_url()."Error404");
		}
	}


	public function crear() {
		//solo entra aca si es una peticion ajax

		if($this->input->is_ajax_request()) {

			$this->form_validation->set_rules("comentario","comentario", "trim|required|min_length[10]|max_length[100]|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			$comentarioPost = $this->input->post("comentario");
			$idParquePost = $this->input->post("id_parque_reclamo");
			$idUsuarioPost = $this->input->post("id_usuario_reclamo");
			$tipoReclamoPost = $this->input->post("tipo_reclamo");
			$imagenPost = empty($_FILES["fileImagen"]["name"]) ? null : $_FILES["fileImagen"]["name"];

			if(empty($comentarioPost) && empty($idParquePost) && empty($idUsuarioPost) && empty($tipoReclamoPost) && empty($imagenPost)) {
				$data = array(
					"res" => "error_vacio",
					"message" => "Asegurese de completar bien los campos del formulario, que la imagen sea un archivo tipo jpeg."
				);

			} else {
				if($this->form_validation->run() === false) {

					$data = array(
						"comentario" => form_error("comentario"),
						"res" => "error"
					);

				} else {

					$captchaAnswer = $this->input->post("g-recaptcha-response");
					$response = $this->recaptcha->verifyResponse($captchaAnswer);

					if($response["success"] == false) {
						$data = array(
							"res" => "error_captcha",
							"message" => "Debe completar el captcha."
						);

					} else {

						$usuario = $this->mdl_usuario->mostrarPerfil($idUsuarioPost);

						if(empty($usuario->id_tipo_documento) || empty($usuario->numero_documento)) {
							$data = array(
								"res" => "error_reclamo",
								"message" => "Asegurese de completar su tipo y numero de documento."
							);

						} else {

							$this->mdl_reclamo->idParque = $idParquePost;
							$this->mdl_reclamo->idUsuario = $idUsuarioPost;
							$this->mdl_reclamo->idReclamo = $tipoReclamoPost;
							$this->mdl_reclamo->imagen = $imagenPost;
							$this->mdl_reclamo->comentario = $comentarioPost;

							$result = $this->mdl_reclamo->guardarReclamo();

							if($result === true) {
								$data = array(
									"res" => "reclamo_registrado",
									"message" => "Se registro el reclamo correctamente."
								);

							} elseif(is_null($result)) {
								$data = array(
									"res" => "error_campos_vacios",
									"message" => "Algunos campos se encuentra vacios, si el problema persiste envianos un mail en el formulario de contacto."
								);

							} elseif($result == false) {
								$data = array(
									"res" => "fallo_db",
									"message" => "Ocurrio un error al intentar registrar los datos del formulario."
								);

							} elseif(is_string($result)) {
								$data = array(
									"res" => "error_reclamo",
									"message" => $result
								);
							}
						}
					}
				}
			}

			echo json_encode($data);

		} else return redirect(base_url()."Error404");
	}

	public function detalle($idReclamo = null) {

		if(!empty($idReclamo)) {
			$data["info"]= " | Detalle";
			$this->load->view("/guest/head",$data);
			$data['logo']= 'logo.png';
			$this->load->view("/guest/nav",$data);
			$reclamo = $this->mdl_reclamo->mostrarReclamo($idReclamo);

			if(empty($reclamo)) {
				redirect(base_url()."Error404");
			}
			$reclamo = array("reclamo" => $reclamo);
			$this->load->view("/user/info_reclamo", $reclamo);
			$this->load->view("/guest/footer");
		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function documentos() {

		if($this->session->perfil !== "2") {
			return redirect(base_url()."Error404");
		}

		$data["info"] = " | Documentos";
		$this->load->view("/guest/head", $data);
		$data["logo"] = "logo.png";
		$this->load->view("/guest/nav", $data);

		$files = glob("public/documents/*.docx");

		// array populated with files found
		// containing the search string.
		$filesFound = array();

		// iterate through the files and determine
		// if the filename contains the search string.
		foreach($files as $file) {

			$archivoData = new stdClass();
			$archivoData->nombre = pathinfo($file, PATHINFO_FILENAME);
			$archivoData->archivo = pathinfo($file, PATHINFO_BASENAME);

			$filesFound[] = $archivoData;
		}

		$data = array("documentos" => $filesFound);
		$this->load->view("/user/reclamos_documento", $data);
		$this->load->view("/guest/footer");
	}

	public function descargarDocumento($nombreDocumento = null) {

		if(empty($nombreDocumento)) {
			redirect(base_url());
		}

		$this->load->helper("download");

		$rutaArchivo = glob("public/documents/". $nombreDocumento);

		if(empty($rutaArchivo) || empty($rutaArchivo[0])) {
			redirect(base_url());
		}

		$file = file_get_contents($rutaArchivo[0]);

		ob_clean();
		force_download($nombreDocumento, $file);
	}

	public function enviarEmail() {

		if($this->input->is_ajax_request()) {

			$this->form_validation->set_rules("comentario","comentario", "trim|required|min_length[10]|max_length[100]|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			$reclamoEmailComunaPost = filter_var($this->input->post("email_comuna"), FILTER_VALIDATE_EMAIL) ? $this->input->post("email_comuna") : false;
			$reclamoOngPost = filter_var($this->input->post("email_ong"), FILTER_VALIDATE_EMAIL) ? $this->input->post("email_ong") : false;
			$reclamoComentarioMailPost = $this->input->post("comentario");
			$documentoMailPost = empty($_FILES["fileDocumento"]) ? null : $_FILES["fileDocumento"];

			if(empty($reclamoEmailComunaPost) && empty($reclamoOngPost)) {
				$data = array(
					"res" => "error_destinatario",
					"message" => "Asegurese de completar al menos un destinatario (Email ONG/Comuna) con el formato de email valido."
				);

			} elseif(empty($documentoMailPost)) {
				$data = array(
					"res" => "error",
					"documentFile" => "Asegurese de subir el documento del tipo .docx"
				);

			} else {

				if($this->form_validation->run() === false) {
					$data = array (
						"res" => "error",
						"comentario_documento_email" => form_error("comentario")
					);

				} else {

					if($this->session->perfil !== "2") {
						$data = array(
							"res" => "error_perfil",
							"message" => "No tiene permisos para enviar el reclamo"
						);

					} else {

						$result = $this->enviarEmailDocumentoReclamo($reclamoEmailComunaPost, $reclamoOngPost, $reclamoComentarioMailPost, $documentoMailPost);

						if(is_string($result)) {
							$data = array (
								"res" => "error_envio_email",
								"message" => $result
							);

						} else {

							$result = $this->mdl_reclamo->actualizarEstadoReclamos($documentoMailPost["name"]);

							if($result === true) {
								$data = array(
									"res" => "reclamo_enviado",
									"message" => "Se envio correctamente el email y se actualizo el estado de los reclamos."
								);

							} elseif(is_string($result)) {
								$data = array(
									"res" => "fallo_actualizar",
									"message" => $result
								);

							} else {

								$data = array (
									"res" => "fallo_db",
									"message" => "Ocurrio un error al actualizar los estados del reclamo."
								);
							}
						}
					}
				}
			}

			echo json_encode($data);

		} else {

			if($this->session->perfil !== "2") {
				return redirect(base_url()."Error404");
			}

			$data["info"]= " | Enviar Documento Reclamo";
			$this->load->view("/guest/head",$data);
			$data['logo']= 'logo.png';
			$this->load->view("/guest/nav",$data);
			$data["ongsBarrios"] = $this->mdl_parque->obtenerEmailOngs();
			$this->load->view("/user/formulario_enviar_documento", $data);
			$this->load->view("/guest/footer");
		}
	}

	public function eliminar($idReclamo, $nombreImagen = null) {

		if($this->session->userdata("login") !== true || empty($this->session->userdata("id")) || empty($idReclamo)) {
			return redirect(base_url());
		}

		$result = $this->mdl_reclamo->eliminarReclamoPorUsuario($idReclamo, $nombreImagen);

		if($result == true) {
			return redirect(base_url()."reclamo");
		}

		return redirect(base_url()."Error404");
	}

}