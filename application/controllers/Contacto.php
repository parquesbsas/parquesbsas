<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library("My_PHPMailer");
		$this->load->library("recaptcha");
	}

	public function index() {
		$data["info"]= " | Contacto";
		$this->load->view("/guest/head", $data);
		$data['logo']= 'logo.png';
		$this->load->view("/guest/nav", $data);
		$this->load->view("/guest/contacto");
		$this->load->view("/guest/footer");

	}

	public function enviar() {
		if($this->input->is_ajax_request()) {

			//Validaciones
			$this->form_validation->set_rules("asunto","asunto", "trim|required|min_length[4]|max_length[20]|xss_clean");
			$this->form_validation->set_rules("comentario","comentario", "trim|required|min_length[10]|max_length[100]|xss_clean");
			$this->form_validation->set_rules("nombre","nombre", "trim|required|min_length[5]|max_length[18]|xss_clean");
			$this->form_validation->set_rules("email","email", "trim|required|valid_email|xss_clean");
			$this->form_validation->set_error_delimiters('<p class="text-danger">' , '</p>' );
			$this->form_validation->set_message('required' , 'El campo %s no puede estar vacio.');
			$this->form_validation->set_message('min_length' ,'El campo %s no puede tener menos de %s caracteres.');
			$this->form_validation->set_message('max_length' , 'El campo %s no puede tener mas de %s caracteres.');
			$this->form_validation->set_message('valid_email' , 'Debe ingresar un %s valido.');

			if($this->form_validation->run() === false) {

				$data = array (
					"asunto_contacto" => form_error("asunto"),
					"comentario_contacto" => form_error("comentario"),
					"nombre_contacto" => form_error("nombre"),
					"email_contacto" => form_error("email"),
					"res" => "error"
				);

			} else {

				$nombreContactoPost = $this->input->post("nombre");
				$emailContactoPost = $this->input->post("email");
				$comentarioContactoPost = $this->input->post("comentario");
				$asuntoContactoPost = $this->input->post("asunto");

				$captchaAnswer = $this->input->post("g-recaptcha-response");
				$response = $this->recaptcha->verifyResponse($captchaAnswer);

				if($response["success"] == false) {
					$data = array(
						"res" => "error_captcha",
						"message" => "Debe completar el captcha."
					);

				} else {
					$result = $this->enviarMailContacto($nombreContactoPost, $emailContactoPost, $comentarioContactoPost, $asuntoContactoPost);
					
					if($result === true) {
						$data = array(
							"res" =>  "enviado",
							"message" => "El mail fue enviado correctamente."
						);

					} else {
						$data = array(
							"res" =>  "error_email",
							"message" => $result
						);
					}
				}
			}

			echo json_encode($data);	

		} else {
			show_404();
		}
	}	

	protected function enviarMailContacto($nombreContactoPost, $emailContactoPost, $comentarioContactoPost, $asuntoContactoPost) {
		$data = array();
		$data["nombre"] = $nombreContactoPost;
		$data["email"] = $emailContactoPost;
		$data["comentario"] = $comentarioContactoPost;
		$data["asunto"] = $asuntoContactoPost;
		$rutaLogoImage = dirname(dirname(__DIR__)). "/public/img/logo.png";		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth	= true;
		$mail->Port = 465;
		$mail->Username = "prueba.p5256@gmail.com";
		$mail->Password = "Parques12345";
		$mail->SMTPSecure = "ssl";
		$mail->SetFrom($emailContactoPost, $nombreContactoPost);
		$destino = "victor.1995.18@gmail.com";
		$mail->AddAddress($destino);
		$mail->AddReplyTo($emailContactoPost);
		$mail->Subject = "Contacto | ". $asuntoContactoPost;
		$mail->AddEmbeddedImage($rutaLogoImage, "logo");
		$mail->Body = $this->load->view("/guest/contacto_template", $data, true);		
		$mail->IsHTML(true);

		if(!$mail->send()) {
			return "Error al enviar el email: ". $mail->ErrorInfo ." | Si el problema persiste contactenos a traves del email parquesbsas.contacto@gmail.com";
		}  else {
			return true;
		}
	}
}
?>