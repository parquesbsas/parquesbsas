<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad extends CI_Controller {

	public function crear() {

		if($this->input->is_ajax_request()) {
	
			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty(($this->input->post("actividadNombre"))) || empty($this->input->post("actividadDescripcion"))) {

					$data = array(
						"res" => "error_validacion_crear_actividad",
						"message" => "Complete los campos requeridos."
					);

				} else {

					$this->load->model("mdl_actividad");
					$this->mdl_actividad->nombre = $this->input->post("actividadNombre");
					$this->mdl_actividad->descripcion = $this->input->post("actividadDescripcion");

	 				$result = $this->mdl_actividad->crear();					

					if(!empty($result)) {
						$data = array (
							"res" => "parque_actualizado",
							"message" => "Se creo la actividad correctamente."
						);

					} else {
						$data = array(
							"res" => "error_crear_actividad",
							"message" => "Ocurrio un error al crear la actividad."
						);
					}
				}
			}

			echo json_encode($data);	

		}
	}	
}
