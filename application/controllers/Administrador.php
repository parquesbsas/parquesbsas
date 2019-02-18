<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_usuario");
	}	

	public function index()	{
		
		if($this->session->perfil !== "2") {
			return redirect(base_url());
		}

		//var_dump($this->mdl_parque);die;
		$data["info"] = " | Administrador";
		$this->load->view("/guest/head",$data);
		$data["logo"] = "logo.png";
		$this->load->view("/guest/nav",$data);
		$data["usuarios"]= $this->mdl_usuario->obtenerUsuariosActivos();
		$data["perfiles"] = $this->mdl_usuario->obtenerPerfiles();
		$this->load->view("/user/usuarios",$data);
		$this->load->view("/guest/footer");
	}

	public function actualizarAdministrador($idUsuario, $idTipoUsuario) {
		
		if(empty($idUsuario) || empty($idTipoUsuario) || $this->session->perfil !== "2") {
			return redirect(base_url()."Error404");
		}

		$result = $this->mdl_usuario->actualizarPerfil($idUsuario, $idTipoUsuario);
		if(empty($result)) {
			return redirect(base_url()."Error404");
		}

		return redirect(base_url()."administrador");
	}
}
