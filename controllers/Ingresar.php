<?php

/*
 * DESCRIPCIÓN: cONTRTOLADOR QUE REALIZA EL LOGIBN DELA APLICACIÓN Y SE CRERAN LAS VARIABLES DE SESION
 * FECHA: 02 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ingresar extends CI_Controller {
    //contralador inicial, carga el login
    function __construct()
    {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('Session/Session');
            $this->load->model('acceso/Login');
    }

    public function index(){
        $this-> load -> view('login');
    }
    public function loginVerif(){
        $this->form_validation->set_rules('usuario','Usuario','required|min_length[1]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('pass','Contraseña','required|trim|min_length[5]|xss_clean');
             
        if($this->form_validation->run() == FALSE){ //si no se cumplio una regla, muestra la pantalla, y ejecuta la 
//          //la vista que contiene la ventana modal
          $this->load->view('Modales/modalError');
          $this->index();
        }
        else
        {
            $datos['usuario']= $this->input->post('usuario');
            $datos['pass']= $this->input->post('pass');  
            //$valida = $this->login->acceso($datos);
              
            //LLAMAR A LOS MODELOS
            //declaramos la variable de session y le asignamoe el nombre de usuario del login.
            list($valida,$idUser,$rol)= $this->Login->acceso($datos);//llamamos al método que ejecuta el SP
            //$validauser,$idUser,$rol
            //Validamos la bandera que envia el modelo
            switch($valida){
                //Usuario y contraseña inválidos
                case $valida == 0:
                    $data = array('subtitulo' => 'Verifique la siguiente informaci&oacute;n',
                                   'mensaje'   => 'Los datos ingresados son incorrectos',
                                   'onclick'   =>'CierraError();');
                    $this->index();
                    $this->load->view('Modales/error',$data);
                break;
                //Contraseña incorrecta  
                case $valida == "-1":
                     $data = array('subtitulo' => 'Verifique la siguiente informaci&oacute;n',
                                   'mensaje'   => 'Los datos ingresados son incorrectos<br/> Por favor Intente de nuevo',
                                   'onclick'   =>'CierraError();');
                     $this->index();
                     $this->load->view('Modales/error',$data);
                break;
                //Contraseña incorrecta  
                case $valida == 1:
                     $sesion_data= array('idUser'=>$idUser,
                                         'rol'   =>$rol
                                        );  
                     //se inicilializacion las sesiones
                     $this->session->set_userdata($sesion_data);
                     redirect('index.php/Principal');//rediccionamiento si el usuario es correcto
                break;
            }
        }  
    }
}

