<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ws_parques extends CI_Controller {

  public function index ()
  {

   
     $data= 'Parque Rivadavia';
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->getParquee($data);
     echo json_encode($result);



}
  public function index2 ()
  {

   
     $data= 'Parque Lezama';
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

  public function crear ()
  {

   
     $nombre=$_GET['nombre'];
     $comen=$_GET['comentario'];
     $this->load->model('wsm_parques');       
     $result=$this->wsm_parques->crearComen($nombre,$comen);

}
}
