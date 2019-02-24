<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parques extends CI_Controller {

	public function index()	{
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
			return redirect(base_url()."Error404");
		}

		$data["parques"] = $parques;
		$data["pagination"]= $this->pagination->create_links();

		$this->load->view("/guest/parques",$data);
		$this->load->view("/guest/footer");

	}

	public function crear() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque."
				);

			} else {

				$imagenPost = empty($_FILES["crearParqueImagen"]["name"]) ? null : $_FILES["crearParqueImagen"]["name"];

				if(empty($this->input->post("crearParqueNombre")) || empty($this->input->post("crearParqueDescripcion")) || empty($this->input->post("crearParqueDireccion")) || empty($this->input->post("crearParqueBarrio")) || empty($this->input->post("crearParqueComuna")) || empty($this->input->post("crearParqueLatitud")) || empty($this->input->post("crearParqueLongitud")) || empty($this->input->post("crearParqueUrl")) || empty($imagenPost)) {

					$data = array(
						"res" => "error_validacion_crear_parque",
						"message" => "Complete los campos requeridos."
					);

				} else {

					$resultLatitud = preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $this->input->post("crearParqueLatitud"));
					$resultLongitud = preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/", $this->input->post("crearParqueLongitud"));

					if(empty($resultLatitud) || empty($resultLongitud)) {
						$data = array(
							"res" => "error_validacion_crear_parque_coordenadas",
							"message" => "Ingrese coordenadas validas, ejemplo latitud -34.555524 / longitud -58.499707"
						);

					} else {

						$this->mdl_parque->nombre = $this->input->post("crearParqueNombre");
						$this->mdl_parque->descripcion = $this->input->post("crearParqueDescripcion");
						$this->mdl_parque->direccion = $this->input->post("crearParqueDireccion");
						$this->mdl_parque->idBarrio = $this->input->post("crearParqueBarrio");
						$this->mdl_parque->idComuna = $this->input->post("crearParqueComuna");
						$this->mdl_parque->urlParque = $this->input->post("crearParqueUrl");
						$this->mdl_parque->patioJuegos = $this->input->post("crearParquePatioJuego") == "true" ? 1 : 0;
						$this->mdl_parque->idWifi = $this->input->post("crearParqueWifi") == "true" ? 1 : 0;
						$this->mdl_parque->latitud = $this->input->post("crearParqueLatitud");
						$this->mdl_parque->longitud = $this->input->post("crearParqueLongitud");

		 				$result = $this->mdl_parque->crear();

						if($result === true) {
							$data = array(
								"res" => "parque_creado",
								"message" => "Se creo el parque correctamente."
							);

						} elseif($result == false) {
							$data = array(
								"res" => "fallo_crear_parque",
								"message" => "Ocurrio un error al intentar crear el parque."
							);

						} elseif(is_string($result)) {
							$data = array(
								"res" => "error_crear_parque",
								"message" => $result
							);
						}
					}
				}
			}

			echo json_encode($data);

		} else {

			if($this->session->perfil !== "2") {
				return redirect(base_url()."Error404");
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
				return redirect(base_url()."Error404");
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
			return redirect(base_url()."Error404");
		}
	}

	public function administrar($idParque = null) {

		if(empty($idParque)) {
			return redirect(base_url()."Error404");
		}

		$parque = $this->mdl_parque->obtenerParque($idParque, null, null);

		if(empty($parque)) {
			return redirect(base_url()."Error404");
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

		} else {
			return redirect(base_url()."Error404");
		}
	}


	public function crearEstacionSaludableParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("estacionSaludServicio")) || empty($this->input->post("estacionSaludFecha"))) {

					$data = array(
						"res" => "error_validacion_crear_estacion_salud_parque",
						"message" => "Complete los campos requeridos."
					);

				} else if(empty($this->input->post("parqueId"))) {

					$data = array(
						"res" => "error_crear_estacion_salud_parque",
						"message" => "Se detecto un error al crear la estacion de salud del parque."
					);

				} else {

					$this->load->model("mdl_estacion_salud");

					$this->mdl_estacion_salud->idParque = $this->input->post("parqueId");
					$this->mdl_estacion_salud->servicios = $this->input->post("estacionSaludServicio");
					$this->mdl_estacion_salud->fecha = $this->input->post("estacionSaludFecha");
					$this->mdl_estacion_salud->latitud = $this->input->post("estacionSaludLatitud");
					$this->mdl_estacion_salud->longitud = $this->input->post("estacionSaludLongitud");

	 				$result = $this->mdl_estacion_salud->crearEstacionSaludableParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_estacion_salud_creado",
							"message" => "Se creo correctamente la estacion saludable."
						);

					} else {
						$data = array(
							"res" => "error_crear_estacion_salud_parque",
							"message" => "Ocurrio un error al crear la estacion saludable del parque."
						);
					}
				}
			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function editarEstacionSaludableParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				 if(empty($this->input->post("tablaAdminParqueEstacionSaludId"))) {

					$data = array(
						"res" => "error_actualizar_estacion_salud_parque",
						"message" => "Ocurrio un error al actualizar la estacion saludable del parque."
					);

				} else {

					$this->load->model("mdl_estacion_salud");

					$this->mdl_estacion_salud->idEstacionSalud = $this->input->post("tablaAdminParqueEstacionSaludId");
					$this->mdl_estacion_salud->servicios = $this->input->post("tablaAdminParqueEstacionSaludServicio");
					$this->mdl_estacion_salud->fecha = $this->input->post("tablaAdminParqueEstacionSaludFecha");
					$this->mdl_estacion_salud->latitud = $this->input->post("tablaAdminParqueEstacionSaludLatitud");
					$this->mdl_estacion_salud->longitud = $this->input->post("tablaAdminParqueEstacionSaludLongitud");
					$this->mdl_estacion_salud->activo = $this->input->post("tablaParqueEstacionSaludActivo") == "true" ? 1 : 0;

	 				$result = $this->mdl_estacion_salud->actualizarEstacionSaludableParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_estacion_salud_actualizado",
							"message" => "Se actualizo la estacion saludable del parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_estacion_salud_parque",
							"message" => "Ocurrio un error al actualizar la estacion de salud del parque."
						);
					}
				}

			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function crearPuntoVerdeParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("puntoVerdeTipo")) || empty($this->input->post("puntoVerdeMateriales")) || empty($this->input->post("puntoVerdeDiasHorarios"))) {

					$data = array(
						"res" => "error_validacion_crear_punto_verde_parque",
						"message" => "Complete los campos requeridos."
					);

				} else if(empty($this->input->post("parqueId"))) {

					$data = array(
						"res" => "error_crear_punto_verde_parque",
						"message" => "Se detecto un error al crear el punto verde del parque."
					);

				} else {

					$this->load->model("mdl_punto_verde");

					$this->mdl_punto_verde->idParque = $this->input->post("parqueId");
					$this->mdl_punto_verde->tipo = $this->input->post("puntoVerdeTipo");
					$this->mdl_punto_verde->materiales = $this->input->post("puntoVerdeMateriales");
					$this->mdl_punto_verde->diasHorarios = $this->input->post("puntoVerdeDiasHorarios");
					$this->mdl_punto_verde->latitud = $this->input->post("puntoVerdeLatitud");
					$this->mdl_punto_verde->longitud = $this->input->post("puntoVerdeLongitud");

	 				$result = $this->mdl_punto_verde->crearPuntoVerdeParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_punto_verde_creado",
							"message" => "Se creo correctamente el punto verde."
						);

					} else {
						$data = array(
							"res" => "error_crear_punto_verde_parque",
							"message" => "Ocurrio un error al crear el punto verde del parque."
						);
					}
				}
			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function editarPuntoVerdeParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				 if(empty($this->input->post("tablaAdminParquePuntoVerdeId"))) {

					$data = array(
						"res" => "error_actualizar_punto_verde_parque",
						"message" => "Se detecto un error al actualizar el punto verde del parque."
					);

				} else {

					$this->load->model("mdl_punto_verde");

					$this->mdl_punto_verde->idPuntoVerde = $this->input->post("tablaAdminParquePuntoVerdeId");
					$this->mdl_punto_verde->tipo = $this->input->post("tablaAdminParquePuntoVerdeTipo");
					$this->mdl_punto_verde->materiales = $this->input->post("tablaAdminParquePuntoVerdeMateriales");
					$this->mdl_punto_verde->diasHorarios = $this->input->post("tablaAdminParquePuntoVerdeDiasHorarios");
					$this->mdl_punto_verde->latitud = $this->input->post("tablaAdminParquePuntoVerdeLatitud");
					$this->mdl_punto_verde->longitud = $this->input->post("tablaAdminParquePuntoVerdeLongitud");
					$this->mdl_punto_verde->activo = $this->input->post("tablaParquePuntoVerdeActivo") == "true" ? 1 : 0;

	 				$result = $this->mdl_punto_verde->actualizarPuntoVerdeParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_punto_verde_actualizado",
							"message" => "Se actualizo el punto verde del parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_punto_verde_parque",
							"message" => "Ocurrio un error al actualizar el punto verde del parque."
						);
					}
				}

			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function crearFeriaComunParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("feriaComunTipo")) || empty($this->input->post("feriaComunFechas"))) {

					$data = array(
						"res" => "error_validacion_crear_feria_comun_parque",
						"message" => "Complete los campos requeridos."
					);

				} else if(empty($this->input->post("parqueId"))) {

					$data = array(
						"res" => "error_crear_feria_comun_parque",
						"message" => "Se detecto un error al crear la feria comun del parque."
					);

				} else {

					$this->load->model("mdl_feria_comun");

					$this->mdl_feria_comun->idParque = $this->input->post("parqueId");
					$this->mdl_feria_comun->tipo = $this->input->post("feriaComunTipo");
					$this->mdl_feria_comun->fecha = $this->input->post("feriaComunFechas");
					$this->mdl_feria_comun->latitud = $this->input->post("feriaComunLatitud");
					$this->mdl_feria_comun->longitud = $this->input->post("feriaComunLongitud");

	 				$result = $this->mdl_feria_comun->crearFeriaComunParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_feria_comun_creado",
							"message" => "Se creo correctamente la feria comun."
						);

					} else {
						$data = array(
							"res" => "error_crear_feria_comun_parque",
							"message" => "Ocurrio un error al crear la feria comun del parque."
						);
					}
				}
			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function editarFeriaComunParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				 if(empty($this->input->post("tablaAdminParqueFeriaComunId"))) {

					$data = array(
						"res" => "error_actualizar_feria_comun_parque",
						"message" => "Se detecto un error al actualizar la feria comun del parque."
					);

				} else {

					$this->load->model("mdl_feria_comun");

					$this->mdl_feria_comun->idParqueFeriaComun = $this->input->post("tablaAdminParqueFeriaComunId");
					$this->mdl_feria_comun->tipo = $this->input->post("tablaAdminParqueFeriaComunTipo");
					$this->mdl_feria_comun->fecha = $this->input->post("tablaAdminParqueFeriaComunFecha");
					$this->mdl_feria_comun->latitud = $this->input->post("tablaAdminParqueFeriaComunLatitud");
					$this->mdl_feria_comun->longitud = $this->input->post("tablaAdminParqueFeriaComunLongitud");
					$this->mdl_feria_comun->activo = $this->input->post("tablaParqueFeriaComunActivo") == "true" ? 1 : 0;

	 				$result = $this->mdl_feria_comun->actualizarFeriaComunParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_feria_comun_actualizado",
							"message" => "Se actualizo la feria comun del parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_feria_comun_parque",
							"message" => "Ocurrio un error al actualizar la feria comun del parque."
						);
					}
				}

			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function crearFeriaItineranteParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				if(empty($this->input->post("feriaItineranteDireccion")) || empty($this->input->post("feriaItineranteDias"))) {

					$data = array(
						"res" => "error_validacion_crear_feria_itinerante_parque",
						"message" => "Complete los campos requeridos."
					);

				} else if(empty($this->input->post("parqueId"))) {

					$data = array(
						"res" => "error_crear_feria_itinerante_parque",
						"message" => "Se detecto un error al crear la feria itinerante del parque."
					);

				} else {

					$this->load->model("mdl_feria_itinerante");

					$this->mdl_feria_itinerante->idParque = $this->input->post("parqueId");
					$this->mdl_feria_itinerante->direccion = $this->input->post("feriaItineranteDireccion");
					$this->mdl_feria_itinerante->dias = $this->input->post("feriaItineranteDias");
					$this->mdl_feria_itinerante->latitud = $this->input->post("feriaItineranteLatitud");
					$this->mdl_feria_itinerante->longitud = $this->input->post("feriaItineranteLongitud");

	 				$result = $this->mdl_feria_itinerante->crearFeriatineranteParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_feria_itinerante_creado",
							"message" => "Se creo correctamente la feria itinerante."
						);

					} else {
						$data = array(
							"res" => "error_crear_feria_itinerante_parque",
							"message" => "Ocurrio un error al crear la feria itinerante del parque."
						);
					}
				}
			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

	public function editarFeriaItineranteParque() {

		if($this->input->is_ajax_request()) {

			if($this->session->perfil !== "2") {
				$data = array(
					"res" => "error_perfil",
					"message" => "Usted no tiene permisos para administrar la informacion del parque"
				);

			} else {

				 if(empty($this->input->post("tablaAdminParqueFeriaItineranteId"))) {

					$data = array(
						"res" => "error_actualizar_feria_itinerante_parque",
						"message" => "Se detecto un error al actualizar la feria itinerante del parque."
					);

				} else {

					$this->load->model("mdl_feria_itinerante");

					$this->mdl_feria_itinerante->idParqueFeriaItinerante = $this->input->post("tablaAdminParqueFeriaItineranteId");
					$this->mdl_feria_itinerante->direccion = $this->input->post("tablaAdminParqueFeriaItineranteDireccion");
					$this->mdl_feria_itinerante->dias = $this->input->post("tablaAdminParqueFeriaItineranteDias");
					$this->mdl_feria_itinerante->latitud = $this->input->post("tablaAdminParqueFeriaItineranteLatitud");
					$this->mdl_feria_itinerante->longitud = $this->input->post("tablaAdminParqueFeriaItineranteLongitud");
					$this->mdl_feria_itinerante->activo = $this->input->post("tablaParqueFeriaItineranteActivo") == "true" ? 1 : 0;

	 				$result = $this->mdl_feria_itinerante->actualizarFeriatineranteParque();

					if(!empty($result)) {
						$data = array (
							"res" => "parque_feria_itinerante_actualizado",
							"message" => "Se actualizo la feria itinerante del parque correctamente."
						);

					} else {
						$data = array(
							"res" => "error_actualizar_feria_itinerante_parque",
							"message" => "Ocurrio un error al actualizar la feria itinerante del parque."
						);
					}
				}

			}

			echo json_encode($data);

		} else {
			return redirect(base_url()."Error404");
		}
	}

}