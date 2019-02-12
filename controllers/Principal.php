<?php
/*
 * Descripción: Controlador que valida que venga del login y llama a la vista que carga los frames
 * Fecha: 03 de Abril de 2014
 * Sistema: Control Escolar IEJ
 */

class Principal extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
               
                $url='http://localhost/CECOFAM_C/index.php';
                $url2='http://localhost/CECOFAM_C/index.php/ingresar/login';//definimos la url de inicio, siempre se tiene que hacer referencia a un archivo en este caso index
                $url3='http://localhost/CECOFAM_C/index.php/';
                $url7='http://localhost/CECOFAM_C/';
                $url8='http://localhost/CECOFAM_C/index.php/Ingresar';
                $url9='http://localhost/CECOFAM_C/index.php/ingresar/loginVerif';
                $url10='http://localhost/CECOFAM_C/index.php/ingresar';
                $url11='http://localhost/CECOFAM_C/index.php/Salir';
//                
                //url administrador
                $url4='http://localhost/CECOFAM_C/index.php/admin/login';
                $url5='http://localhost/CECOFAM_C/index.php/admin/';
                $url6='http://localhost/CECOFAM_C/index.php/admin';
	        		
////        echo "url -->".$_SERVER['HTTP_REFERER']."<br>";
//      
             if( isset($_SERVER['HTTP_REFERER'])){//validamos que exista la variable SERVER
                  if($_SERVER['HTTP_REFERER']== $url || $_SERVER['HTTP_REFERER']== $url2 ||$_SERVER['HTTP_REFERER']== $url3
                     ||$_SERVER['HTTP_REFERER']== $url4 || $_SERVER['HTTP_REFERER']== $url5 || $_SERVER['HTTP_REFERER']== $url6 
                     || $_SERVER['HTTP_REFERER']==$url7 || $_SERVER['HTTP_REFERER']==$url8 || $_SERVER['HTTP_REFERER']==$url9
                     || $_SERVER['HTTP_REFERER']==$url10 || $_SERVER['HTTP_REFERER']==$url11){ //si*/
		      
                                             
                         $this->load->view('principal_view');//carga los frames
                 }
           }
            else{//si no viene de index, Muestra vista Accesso Restringido*/
                 
			  $this->load->view('restricted');
                    
            }
            
      }
    
    
}