<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda_personalizada extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_actividad");
		$this->load->model("mdl_feria_comun");
	}

	public function index() {
		$data["info"]= " | Personalizada";
		$this->load->view("/guest/head", $data);
		$data["logo"]= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data["busqueda_personalizada"] = $this->obtenerDetalleFeriasActividades();
		$this->load->view("/guest/busqueda_personalizada", $data);
		$this->load->view("/guest/footer");
	}

	public function buscar() {

		$actividadArray = array();

		if($this->input->is_ajax_request()) {

			$juego = $this->input->post("busqueda_personalizada_patio_juego");
			$feriaItinerante = $this->input->post("busqueda_personalizada_ferias_itinerantes");
			$feriaComun = $this->input->post("busqueda_personalizada_ferias_comunes");
			$centroSalud = $this->input->post("busqueda_personalizada_centro_salud");

			$actividades = $this->mdl_actividad->obtenerActividades();
			if(!empty($actividades)) {
				foreach($actividades as $actividad) {
					if($this->input->post("busqueda_personalizada_actividades_$actividad->id_actividad")) {
						$actividadArray[$actividad->id_actividad] = $this->input->post("busqueda_personalizada_actividades_$actividad->id_actividad");
					}
				}
			}

			$parques = $this->mdl_parque->buscarParquePorFiltros($actividadArray, $juego, $feriaComun, $feriaItinerante, $centroSalud);

			if(!empty($parques)) {
				$data = array(
					"res" =>  "exito",
					"data" => $parques,
					"message" => "Se encontraron ". count($parques) . " parque/s."
				);

			} else {
				$data = array(
					"res" =>  "error_resultado",
					"message" => "No se encontraron resultados"
				);
			}
			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	protected function obtenerDetalleFeriasActividades() {
		$info = array();
		$info["ferias_comunes"] = $this->mdl_feria_comun->obtenerFeriasComunes();
		$info["actividades"] = $this->mdl_actividad->obtenerActividades();
		return $info;
	}

}