<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'/libraries/PHPWord/src/PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader as Autoloader;
Autoloader::register();
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\TemplateProcessor;


class Word extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("mdl_reclamo");
	}

	public function index() {

		$reclamo = $this->mdl_reclamo->obtenerReclamoPlanilla();

		if(empty($reclamo)) {
			return redirect(base_url());
		}

		$filename = "public/plantillaParques.docx";
		$templateWord = new TemplateProcessor($filename);

		$fechaHoy = date("m_Y");

		$nombreDocumento = $reclamo->id_reclamo ."-". $reclamo->parque->url_parque ."-". $fechaHoy;

		$templateWord->setValue('parque', $reclamo->parque->nombre);
		$templateWord->setValue('direccion', $reclamo->parque->direccion);
		$templateWord->setValue('nombre_reclamo', $reclamo->reclamo->descripcion);
		$templateWord->cloneRow("nombre_usuario", count($reclamo->usuarios));

		$contador = 1;
		foreach($reclamo->usuarios as $usuario) {
			$templateWord->setValue("nombre_usuario#".$contador, $usuario->nombre, $contador);
			$templateWord->setValue("apellido_usuario#".$contador, $usuario->apellido, $contador);
			$templateWord->setValue("tipo_documento#".$contador, $usuario->tipo_documento, $contador);
			$templateWord->setValue("numero_documento#".$contador, $usuario->numero_documento, $contador);
			$templateWord->setValue("email#".$contador, $usuario->email, $contador);
			$templateWord->setValue("comentarios#".$contador, $usuario->comentarios, $contador);
			$templateWord->setValue("imagen#".$contador, base_url('public/img/parques') ."/". $usuario->imagen, $contador);
			$contador++;
		}

		// --- Guardamos el documento
		$templateWord->saveAs("public/documents/". $nombreDocumento .".docx");
		header("Content-Disposition: attachment; filename=". $nombreDocumento. ".docx; charset=iso-8859-1");
		echo file_get_contents("public/documents/". $nombreDocumento .".docx");
	}
}
?>