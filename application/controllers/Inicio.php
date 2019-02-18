<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index() {
		$data["info"]= "";

		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$data = array(
			'post' => 'Parques',
			'img'=>'img.jpg'
		);
		$this->load->view("/guest/header", $data);
		$this->load->view("/guest/content");
		$this->load->view("/guest/footer");
	}
}
