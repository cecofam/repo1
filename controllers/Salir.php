<?php

/*
 * DESCRIPCION: CONTROLADOR QUE EJECUTA EL SP PARA SALIR DEL SISTEMA Y REGRESA AL INDEX
 * FECHA: 04 ABRIL DE  2014
 * SISTEMA: CENSO JUDICIAL
 */

class Salir extends CI_Controller {
    function __construct() {
           
          parent::__construct();
      }
      
     public function index(){
         $this->load->model('acceso/Login');//cargamos el modelo
         $datos['iduser']     = $this->session->userdata('idUser');//id del usuario
         $this->load->view('login');//cargamos vista
         $this->db->close();
         // destory session
        $this->session->sess_destroy();
         
     }
}

?>
