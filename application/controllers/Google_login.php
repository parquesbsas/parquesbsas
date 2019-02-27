<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library("google");
		$this->load->model("mdl_usuario");
	}

	public function index() {

		//redirect to profile page if user already logged in
		if($this->session->userdata("login") == true && $this->session->userdata("google") == true) {
			return redirect(base_url());
		}

		if(isset($_GET["code"])) {

			//authenticate user , return access_token , id_token, scope
			$googleToken = $this->google->getAuthenticate();

			if(empty($googleToken)) {
				return redirect(base_url()."error/value/409");
			}

			//get user info from google
			$infoUserGoogle = $this->google->getUserInfo();
			$validarUsuarioGoogle = $this->validarUsuarioGoogle($infoUserGoogle);

			if(empty($validarUsuarioGoogle)) {
				return redirect(base_url()."error/value/409");
			}

			//preparing data for database insertion
			$userData["oauth_provider"]	= "google";
			$userData["oauth_uid"]		= $infoUserGoogle["id"]; // id google
			$userData["first_name"]		= $infoUserGoogle["given_name"];
			$userData["last_name"]		= $infoUserGoogle["family_name"];
			$userData["email"]			= $infoUserGoogle["email"];
			$userData["gender"]			= !empty($infoUserGoogle["gender"]) ? $infoUserGoogle["gender"] : ""; // genero
			$userData["profile_url"]	= !empty($infoUserGoogle["link"]) ? $infoUserGoogle["link"] : ""; // google + , profile

			//insert or update user data to the database
			$this->mdl_usuario->nombre = $infoUserGoogle["given_name"];
			$this->mdl_usuario->apellido = $infoUserGoogle["family_name"];
			$this->mdl_usuario->email = $infoUserGoogle["email"];
			$this->mdl_usuario->idGoogle = $infoUserGoogle["id"];
			$result = $this->mdl_usuario->registroGoogle();

			if(!empty($result)) {

				$data = array(
					"user" => $userData["email"],
					"id" => $result->id_usuario,
					"activo" => $result->activo,
					"perfil" => $result->id_tipo_usuario,
					"user_name" => $userData["first_name"] ." ". $userData["last_name"],
					"login" => true,
					"google" => true
				);

				$this->session->set_userdata($data);
				return redirect(base_url());

			}

			//redirect to profile page
			return redirect(base_url()."Error404");
			//redirect("http://localhost/parquesbsas");
		}

		//google login url
		//$data["loginURL"] = $this->google->loginURL();
		//return $data["loginURL"];
		return redirect($this->google->loginURL());
	}

	protected function validarUsuarioGoogle($infoUserGoogle) {
		if(empty($infoUserGoogle)) {
			return false;
		}

		$loginData = $this->session->userdata();

		if(!empty($loginData["login"]) && $loginData["user"] == $infoUserGoogle["email"]) {
			return true;
		}

		return empty($loginData["login"]) ? true : false;
	}
}
