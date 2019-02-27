<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_encuesta");
	}

	public function realizar() {
		//solo entra aca si es una peticion ajax
		if($this->input->is_ajax_request()) {

			//Validaciones  y mensajes
			$this->form_validation->set_rules("tipo_encuesta", "tipo_encuesta", "trim|required|min_length[1]|max_length[15]|xss_clean");
			$this->form_validation->set_rules("calificacion", "calificacion", "trim|required|min_length[1]|max_length[10]|xss_clean");
			$this->form_validation->set_rules("id_parque_encuesta", "id_parque_encuesta", "trim|required|min_length[1]|max_length[50]|xss_clean");
			$this->form_validation->set_rules("id_usuario_encuesta", "id_usuario_encuesta", "trim|required|min_length[1]|max_length[50]|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">', "</p>");
			$this->form_validation->set_error_delimiters('<p class="text-danger">', "</p>");
			$this->form_validation->set_message("required", "El campo %s no puede estar vacio.");
			$this->form_validation->set_message("min_length", "El campo %s no puede tener menos de %s caracteres.");
			$this->form_validation->set_message("max_length", "El campo %s no puede tener mas de %s caracteres.");

			if($this->form_validation->run() === false ) {

				$data = array (
					"tipo_encuesta" => form_error("tipo_encuesta"),
					"calificacion_encuesta" => form_error("calificacion"),
					"id_parque_encuesta" => form_error("id_parque_encuesta"),
					"id_usuario_encuesta" => form_error("id_usuario_encuesta"),
					"res" => "error"
				);

			} else {

				$this->mdl_encuesta->idParque = $this->input->post("id_parque_encuesta");
				$this->mdl_encuesta->idUsuario = $this->input->post("id_usuario_encuesta");
				$this->mdl_encuesta->idTipoEncuesta = $this->input->post("tipo_encuesta");
				$this->mdl_encuesta->calificacion = $this->input->post("calificacion");
				$this->mdl_encuesta->fechaCreacion = date("Y-m-d H:i:s");

	 			$result = $this->mdl_encuesta->realizarEncuestaParque();

				if($result === true) {
					$data = array(
						"res" =>  "enviado_encuesta",
						"message" => "Encuesta completada."
					);

				} elseif(is_null($result)) {
					$data = array(
						"res" =>  "fallo_db",
						"message" => "Falta completar campos de la encuesta."
					);
				} elseif(is_string($result)) {
					$data = array(
						"res" =>  "error_encuesta",
						"message" => $result
					);
				} elseif(empty($result)) {
					$data = array(
						"res" =>  "fallo_db",
						"message" => "Ocurrio un error al intentar registrar los datos de la encuesta, intente mas tarde."
					);
				}
			}

			echo json_encode($data);

		} else return redirect(base_url()."Error404");
	}
}
?>