<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voto extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper("cookie");
	}

	public function Insertar() {

		if($this->session->userdata("login") !== true || empty($this->session->userdata("id"))) {
			return redirect(base_url()."Error404");
		}

		$voto = $this->input->post("voto");
		$idParque = $this->input->post("id");

		if(empty($voto) || empty($idParque)) {
			return redirect(base_url() ."Error404");
		}

		$this->mdl_parque->idParque = $idParque;

		if($voto === "likes") {
			$result = $this->mdl_parque->votar("likes");

		} elseif($voto === "hates") {
			$result = $this->mdl_parque->votar("hates");
		}

 		echo($result);
	}
}

?>
