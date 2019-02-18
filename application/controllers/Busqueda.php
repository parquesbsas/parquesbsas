<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once('/../core/MY_Util.php');

class Busqueda extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_calificacion");
		$this->load->model("mdl_comuna");
		$this->load->model("mdl_barrio");
	}

	public function parque($nombreParque = null, $idParque = null) {

		$nombreParque = !empty($this->input->post("buscar_parque")) ? $this->input->post("buscar_parque") : $nombreParque;

		if(empty($nombreParque) && empty($idParque)) {
			redirect(base_url()."Error404");
		}

		$parque = $this->mdl_parque->obtenerParque($idParque, $nombreParque);

		if(empty($parque)) {
			redirect(base_url()."Error404");
		}

		if(is_array($parque)) {
			return $this->resultadoParques($parque);
		}

		$this->obtenerDetalleParque($parque, $idParque);

		$data = array();
		$data["info"] = " | ". $parque->nombre;;
		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$this->load->library("googlemaps");
		$config["center"] = $parque->latitud .", ". $parque->longitud;//"37.429, -122.1419";//$parque->latitud .",". $parque->longitud;
		$config["zoom"] = 16;
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker["position"] = $parque->latitud .",". $parque->longitud;//"37.429, -122.1419";//$parque->latitud .",". $parque->longitud;
		$this->googlemaps->add_marker($marker);
		$data["map"] = $this->googlemaps->create_map();
		$data["parque"] = $parque;
		$data["ecobici"] = null;
		$data["encuestas"] = $this->mdl_encuesta->obtenerEncuestas();
		$data["calificaciones"] = $this->mdl_calificacion->obtenerCalificaciones();
		$this->load->view("/guest/info", $data);
		$this->load->view("/guest/footer");
	}	

	protected function obtenerDetalleParque(&$parque, $idParque) {
		
		$this->load->model("mdl_encuesta");
		$this->load->model("mdl_punto_verde");
		$this->load->model("mdl_estacion_salud");
		$this->load->model("mdl_feria_comun");
		$this->load->model("mdl_reclamo");
		$this->load->model("mdl_feria_itinerante");
		$this->load->model("mdl_actividad");			
		
		$parque->puntos_verdes = $this->mdl_punto_verde->obtenerPuntoVerdePorParque($idParque);
		$parque->estaciones_salud = $this->mdl_estacion_salud->obtenerEstacionSaludablePorParque($idParque);
		$parque->reclamos = $this->mdl_reclamo->obtenerListadoReclamos();
		$parque->ferias = array();
		$feriasComunesParque = $this->mdl_feria_comun->obtenerFeriasComunesPorParque($idParque);
		$feriasItinerantesParque = $this->mdl_feria_itinerante->obtenerFeriasItinerantesPorParque($idParque);	
		$parque->actividades = $this->mdl_actividad->obtenerActividadesPorParque($idParque);

		if(!empty($feriasComunesParque)) {
			$parque->ferias["Ferias Comunes"] = $feriasComunesParque;
		}
		
		if(!empty($feriasItinerantesParque)) {
			$parque->ferias["Ferias Itinerantes"] = $feriasItinerantesParque;
		}
	}

	public function busquedaPorBarrio() {
		//solo entra aca si es una peticion ajax
		if($this->input->is_ajax_request()) {
			//Validaciones  y mensajes	
			$this->form_validation->set_rules("barrio","barrio", "trim|required|callback_checkOnlyString|min_length[5]|max_length[25]|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			if($this->form_validation->run() === false) {

				$data = array (
					"barrio" => form_error("barrio"),
					"res" => "error"
				);

			} else {

				$barrio = $this->mdl_barrio->buscarBarrioPorNombre($this->input->post("barrio"));

				if(!empty($barrio->id_barrio)) {
	 				$result = $this->mdl_parque->buscarParquePorBarrio($barrio->id_barrio);
				}

				if(!empty($result)) {
					$data = array(
						"res" =>  "exito",
						"data" => $result,
						"message" => "Se encontraron ". count($result) . " parque/s."						
					);

				} else {
					$data = array(
						"res" =>  "error_resultado",
						"message" => "No se encontraron resultados"
					);
				}
			}
			echo json_encode($data);

		} else show_404();
	}	

	public function busquedaPorComuna() {

		//solo entra aca si es una peticion ajax
		if($this->input->is_ajax_request()) {
			//Validaciones  y mensajes	
			$this->form_validation->set_rules("comuna","comuna", "trim|required|min_length[5]|max_length[15]|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');

			if($this->form_validation->run() === false) {

				$data = array (
					"comuna" => form_error("comuna"),
					"res" => "error"
				);

			} else {

				$comuna = $this->mdl_comuna->buscarComunaPorNombre($this->input->post("comuna"));

				if(!empty($comuna->id_comuna)) {
					$result = $this->mdl_parque->buscarParquePorComuna($comuna->id_comuna);
				}

				if(!empty($result)) {
					$data = array(
						"res" =>  "exito",
						"data" => $result,
						"message" => "Se encontraron ". count($result) . " parque/s."
					);

				} else {

					$data = array(
						"res" => "error_resultado",
						"message" => "No se encontraron resultados"
					);
				}
			}
			echo json_encode($data);

		} else show_404();
	}

	public function resultadoParques($parques = null) {

		if(empty($parques)) {
			redirect(base_url()."Error404");
		}		

		$data["info"]= "";
		$this->load->view("/guest/head", $data);
		$data["logo"]= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data["parques"] = $parques;
		$this->load->view("/guest/busqueda_parque", $data);
		$this->load->view("/guest/footer");

	}	

	public function barrio() {
		$data["info"]= " | Barrio";
		$this->load->view("/guest/head", $data);
		$data["logo"]= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data["barrios"] = $this->mdl_barrio->obtenerBarrios();
		$this->load->view("/guest/busqueda_barrio", $data);
		$this->load->view("/guest/footer");

	}

	public function comuna() {
		$data["info"]= " | Comuna";
		$this->load->view("/guest/head", $data);
		$data["logo"]= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data["comunas"] = $this->mdl_comuna->obtenerComunas();
		$this->load->view("/guest/busqueda_comuna", $data);
		$this->load->view("/guest/footer");

	}
}