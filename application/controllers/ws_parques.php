<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('content-type : bitmap; charset=utf-8');
class Ws_parques extends CI_Controller {

  public function index ()
  {

   /*
     $data= 'Parque Rivadavia';
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->getParquee($data);
     print_r(json_encode($result)); 
*/
    $response = array();


$apps = array();
     $apps["name"] = "victor";
     array_push($response, $apps);
     echo json_encode($response);


}
  public function index2 ()
  {

   
     $data= 'Parque de los Niños';
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->getParquee($data);
     echo json_encode($result);



}

 public function Todos ()
  {

   
   
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->getAllparques();
     echo json_encode($result);



}

  public function Mostrar ()
  {
     $data= 'Parque de los Niños';
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->mostrarParque($data);
     echo json_encode($result);

}


  public function Consulta ()
  {  
      $nombre=$_GET['nombre'];
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->consultaParque($nombre);
     echo json_encode($result);

}



  public function crear ()
  {

   
     $nombre=$_GET['nombre'];
     $comen=$_GET['comentario'];
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->crearComen($nombre,$comen);

}


public function subirImagen(){
if(isset($_POST["image"])) {
 
    $encoded_string = $_POST["encoded_string"];
    $image_name = $_POST["image"];
 
    $decoded_string = base64_decode($encoded_string);
 //'uploads/'.$image_name;
 // $path = 'uploads/'.$image_name;

    $path = './public/img/'.$image_name;
    echo($path);
    $file = fopen($path,"wb");
    $is_written = fwrite($file,$decoded_string);
    fclose($file);
     
    echo 'Image Uploading Success';
}

}


}
