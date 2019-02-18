<?php
class Wsm_parques extends CI_Model
{


     public function getParquee($name = '')

     {

     $result= $this->db->query("SELECT * From parques where nombre like '$name'");
      return $result->result();
    }
   

   public function getAllparques()

     {
   
      $result= $this->db->query("SELECT * From  parques");
	   return $result->result();
    }

  public function mostrarParque()

     {
   
      $result= $this->db->query("SELECT * From  parques");
	   return $result->result();
    }

   public function crearComen($nombre = '' , $comentario ='')

     {

     $result= $this->db->query("INSERT INTO ej SET nombre ='$nombre', comentario = '$comentario'");

    }



    public function consultaParque($nombre = '')

     {

     $result= $this->db->query("SELECT * From parques where nombre ='$nombre' ");
     return $result->result();

    }

}

/*


     {


     $result= $this->db->query("SELECT * From parques where nombre like '$name'");

 

    if ($result->num_rows() > 0  ) {
      
       foreach ($result->result() as $datos ) {
         $data[]=$datos;
       }

    return $data;
    }else {

    return null;

    }



    }
*/
   ?>

