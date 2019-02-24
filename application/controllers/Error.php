<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	public function value($numeroError = null) {

		$data = [];
		if($numeroError == "400") {
			$data["numeroError"] = "Ups";
			$data["descripcion"] = "no se ha encontrado ningun resultado";

		} elseif($numeroError == "500") {
			$data["numeroError"] = "500";
			$data["descripcion"] = "Error interno del servidor";

		} elseif($numeroError == "409") {
			$data["numeroError"] = "409";
			$data["descripcion"] = "No se pudo procesar la peticion debido a un conflicto del recurso involucrado";
		}


		$data["info"] = null;
		$this->load->view("/guest/head", $data);
		$data["logo"]= "logo.png";
		$this->load->view("/guest/nav", $data);
		$this->load->view("/guest/error", $data);
		$this->load->view("/guest/footer");
	}
}
?>