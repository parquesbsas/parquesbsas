<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parques extends CI_Controller {

	public function index()	{
		//var_dump($this->mdl_parque);die;
		$data["info"] = " | Parques";
		$this->load->view("/guest/head",$data);
		$data["logo"] = "logo.png";
		$this->load->view("/guest/nav",$data);
		$this->load->library("pagination");
		$config['base_url']= base_url().'parques/index/'; // cabiar esto por home/articulos
		$config['total_rows']= $this->mdl_parque->obtenerParquesActivo(); // numero de filas llamada al modelo parque.php
		$config['per_page']= 9; // resultado por pagina
		$config['uri_segment']= 3; //el segmento de la paginación
		$config['num_links']= 5; //Número de links mostrados en la paginación
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false; //primer link
		$config['last_link'] = false; //último link
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo'; //anterior link
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo'; //siguiente link
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config); //inicializamos la paginación
		$parques = $this->mdl_parque->obtenerPaginado($config['per_page'], $this->uri->segment(3)); //llamada al modelo parque.php

		if(empty($parques)) {
			redirect(base_url()."Error404");
		}

		$data["parques"] = $parques;
		$data["pagination"]= $this->pagination->create_links();

		$this->load->view("/guest/parques",$data);
		$this->load->view("/guest/footer");

	}

	public function crear() {

		if($this->input->is_ajax_request()) {

			$documentoPost = empty($_FILES["fileExcel"]) ? null : $_FILES["fileExcel"];

			if(empty($documentoPost)) {
				$data = array(
					"res" => "error",
					"documentFile" => "Asegurese de subir el documento del tipo .csv"
				);

			} else {

				if($this->session->perfil !== "2") {
					$data = array(
						"res" => "error_perfil",
						"message" => "No tiene permisos para enviar el reclamo"
					);

				} else {

					$result = $this->guardarExcelParques($documentoPost);

					if(!empty($result["file_name"])) {
						$data = array (
							"res" => "excel_guardado",
							"message" => "Archivo guardado."
						);

					} else {
						$data = array(
							"res" => "error_guardar",
							"message" => "No se pudo guardar el archivo."
						);
					}
				}
			}

			echo json_encode($data);	

		} else {		
			
			if($this->session->perfil !== "2") {
				return redirect(base_url());
			}

			$data["info"]= " | Actualizar Parques";
			$this->load->view("/guest/head",$data);
			$data['logo']= 'logo.png';
			$this->load->view("/guest/nav",$data);
			$this->load->model("mdl_comuna");
			$this->load->model("mdl_barrio");		
			$data["barrios"] = $this->mdl_barrio->obtenerBarrios();
			$data["comunas"] = $this->mdl_comuna->obtenerComunas();			
			$this->load->view("/user/actualizar_parque",$data);
			$this->load->view("/guest/footer");		
		}
	}

/*	public function guardarExcelParques($documentoPost) {
		
		if(empty($documentoPost) || $this->session->perfil !== "2") { 
			return "Error al guardar el archivo .csv";
		}
		
		$config["upload_path"] = './public/excel/parque';
		$config["allowed_types"] = "csv";
		$config["max_size"] = "2048";
		$config['overwrite'] = true;

		$this->load->library("upload", $config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload("fileExcel")) {
			return $this->upload->display_errors();
		} else {
 			return $this->upload->data();
		}
		return false;
	}
*/
	public function editar() {

		if($this->input->is_ajax_request()) {
	
			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("parqueId"))) {

					$data = array(
						"res" => "error_actualizar_parque",
						"message" => "Ocurrio un error al actualizar el parque."
					);

				} else {

					$this->mdl_parque->idParque = $this->input->post("parqueId");
					$this->mdl_parque->nombre = $this->input->post("parqueNombre");
					$this->mdl_parque->descripcion = $this->input->post("parqueDescripcion");
					$this->mdl_parque->direccion = $this->input->post("parqueDireccion");
					$this->mdl_parque->patioJuegos = $this->input->post("parqueJuegos") == "true" ? 1 : 0;
					$this->mdl_parque->idWifi = $this->input->post("parqueWiFi") == "true" ? 1 : 0;
					$this->mdl_parque->latitud = $this->input->post("parqueLatitud");
					$this->mdl_parque->longitud = $this->input->post("parqueLongitud");
					$this->mdl_parque->activo = $this->input->post("parqueActivo") == "true" ? 1 : 0;
					$this->mdl_parque->urlParque = $this->input->post("parqueUrlParque");
					$this->mdl_parque->idBarrio = $this->input->post("parqueBarrio");
					$this->mdl_parque->idComuna = $this->input->post("parqueComuna");					

	 				$result = $this->mdl_parque->actualizarParque();					

					if(!empty($result)) {
						$data = array (
							"res" => "parque_actualizado",
							"message" => "Se actualizo el parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_parque",
							"message" => "Ocurrio un error al actualizar el parque."
						);
					}
				}
			}

			echo json_encode($data);	

		} else {		
			
			if($this->session->perfil !== "2") {
				return redirect(base_url());
			}
	
			$data["info"]= " | Registros Parques";
			$this->load->view("/guest/head",$data);
			$data['logo']= 'logo.png';
			$this->load->view("/guest/nav",$data);
			$data["parques"] = $this->mdl_parque->obtenerParques(false);
			$this->load->view("/user/admin_listado_parques", $data);
			$this->load->view("/guest/footer");	
		}
	}

	public function editarActividadParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				 if(empty($this->input->post("tablaAdminParqueActividadId"))) {

					$data = array(
						"res" => "error_actualizar_activad_parque",
						"message" => "Ocurrio un error al actualizar la actividad del parque."
					);

				} else {

					$this->load->model("mdl_actividad");
	
					$this->mdl_actividad->idParqueActividad = $this->input->post("tablaAdminParqueActividadId");
					$this->mdl_actividad->desde = $this->input->post("tablaAdminParqueActividadDesde");
					$this->mdl_actividad->hasta = $this->input->post("tablaAdminParqueActividadHasta");
					$this->mdl_actividad->dia = $this->input->post("tablaAdminParqueActividadDia");
					$this->mdl_actividad->activo = $this->input->post("tablaParqueActividadActivo") == "true" ? 1 : 0;

	 				$result = $this->mdl_actividad->actualizarActividadParque();					

					if(!empty($result)) {
						$data = array (
							"res" => "parque_actividad_actualizado",
							"message" => "Se actualizo la actividad del parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_actividad_parque",
							"message" => "Ocurrio un error al actualizar la actividad del parque."
						);
					}
				}

			}

			echo json_encode($data);	

		} else {
			return redirect(base_url());
		}
	}

	public function administrar($idParque = null) {
		
		if(empty($idParque)) {
			redirect(base_url()."Error404");
		}

		$parque = $this->mdl_parque->obtenerParque($idParque, null, null);
		
		if(empty($parque)) {
			redirect(base_url()."Error404");
		}

		$this->obtenerDetalleParque($parque, $idParque);
		$data = array();
		$data["info"] = " Administrar | ". $parque->nombre;;
		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data["parque"] = $parque;
		
		$this->load->model("mdl_comuna");
		$this->load->model("mdl_barrio");		
		
		$barrios = $this->mdl_barrio->obtenerBarrios();
		$barriosOrdenado = array();
		foreach($barrios as $barrio) {
			if($barrio->id_barrio == $parque->id_barrio) {
				array_unshift($barriosOrdenado, $barrio);
				continue;
			}
			$barriosOrdenado[] = $barrio;
		}

		$data["barrios"] = $barriosOrdenado;

		$comunas = $this->mdl_comuna->obtenerComunas();
		$comunasOrdenado = array();
		foreach($comunas as $comuna) {
			if($comuna->id_comuna == $parque->id_comuna) {
				array_unshift($comunasOrdenado, $comuna);
				continue;
			}
			$comunasOrdenado[] = $comuna;
		}

		$data["comunas"] = $comunasOrdenado;

		$this->load->view("/user/administrar_parque", $data);
		$this->load->view("/guest/footer");
	}

	protected function obtenerDetalleParque(&$parque, $idParque) {
		
		$this->load->model("mdl_punto_verde");
		$this->load->model("mdl_estacion_salud");
		$this->load->model("mdl_feria_comun");
		$this->load->model("mdl_feria_itinerante");
		$this->load->model("mdl_actividad");
		
		$parque->puntos_verdes = $this->mdl_punto_verde->obtenerPuntoVerdePorParque($idParque);
		$parque->estaciones_salud = $this->mdl_estacion_salud->obtenerEstacionSaludablePorParque($idParque);
		$parque->ferias = array();
		$feriasComunesParque = $this->mdl_feria_comun->obtenerFeriasComunesPorParque($idParque);
		$feriasItinerantesParque = $this->mdl_feria_itinerante->obtenerFeriasItinerantesPorParque($idParque);	
		$parque->parque_actividades = $this->mdl_actividad->obtenerActividadesPorParque($idParque);
		$parque->actividades = $this->mdl_actividad->obtenerActividades();

		if(!empty($feriasComunesParque)) {
			$parque->ferias["Ferias Comunes"] = $feriasComunesParque;
		}
		
		if(!empty($feriasItinerantesParque)) {
			$parque->ferias["Ferias Itinerantes"] = $feriasItinerantesParque;
		}
	}

	public function crearActividadParque() {

		if($this->input->is_ajax_request()) {
			
			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("actividadHorarioComienzo")) || empty($this->input->post("actividadHorarioFinalizacion")) || empty($this->input->post("actividadDias"))) {

					$data = array(
						"res" => "error_validacion_actualizar_actividad_parque",
						"message" => "Complete los campos requeridos."
					);

				} else if(empty($this->input->post("parqueId")) || empty($this->input->post("actividadId"))) {

					$data = array(
						"res" => "error_actualizar_actividad_parque",
						"message" => "Ocurrio un error al actualizar la actividad del parque."
					);

				} else {

					$this->load->model("mdl_actividad");

					$this->mdl_actividad->idParque = $this->input->post("parqueId");
					$this->mdl_actividad->idActividad = $this->input->post("actividadId");
					$this->mdl_actividad->desde = $this->input->post("actividadHorarioComienzo");
					$this->mdl_actividad->hasta = $this->input->post("actividadHorarioFinalizacion");
					$this->mdl_actividad->dia = $this->input->post("actividadDias");

	 				$result = $this->mdl_actividad->crearActividadParque();	

					if(!empty($result)) {
						$data = array (
							"res" => "parque_actividad_creado",
							"message" => "Se creo correctamente la actividad."
						);

					} else {
						$data = array(
							"res" => "error_crear_parque_actividad",
							"message" => "Ocurrio un error al crear la actividad para el parque."
						);
					}
				}
			}

			echo json_encode($data);	

		}
	}		
}
