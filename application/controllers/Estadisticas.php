<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/My_util.php';

class Estadisticas extends MY_Util {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_reclamo");
		$this->load->model("mdl_usuario");
	}
	public function index() {

		$data["info"]= " | Estadisticas";
		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$this->load->view("/guest/estadisticas");
		$this->load->view("/guest/footer");
	}

	public function obtenerReclamosPorMes() {
		$result = $this->mdl_reclamo->obtenerEstadisticaReclamo();
		if(!empty($result)) {
			$result = $this->formatearResultadoEstadistica($result);
		}
		echo json_encode($result);

	}

	public function obtenerUsuariosPorMes() {
		$result = $this->mdl_usuario->obtenerEstadisticaUsuario();
		if(!empty($result)) {
			$result = $this->formatearResultadoEstadistica($result);
		}
		echo json_encode($result);

	}

	public function obtenerMayorReclamoPorMes() {
		$result = $this->mdl_reclamo->obtenerMayorReclamoPorMes();
		if(!empty($result)) {
			$result = $this->formatearEstadisticaReclamoPorMes($result);
		}
		echo json_encode($result);

	}

	public function obtenerEstadisticasEncuestaPorParque() {
		if(empty($this->session->userdata("login")) || empty($this->input->post("id_parque"))) {
			return redirect(base_url()."Error404");
		}

		$this->mdl_parque->idParque = $this->input->post("id_parque");
		$result = $this->mdl_parque->obtenerEstadisticaEncuestaPorParque();
		echo json_encode($result);
	}
}
?>