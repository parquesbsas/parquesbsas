<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function index() {
		$data["info"] = null;
		$this->load->view("/guest/head", $data);
		$data["logo"]= "logo.png";
		$this->load->view("/guest/nav", $data);
		$this->load->view("/guest/error");
		$this->load->view("/guest/footer");
	}
}
?>