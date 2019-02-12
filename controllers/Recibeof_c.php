<?php

/*
 * DESCRIPCIÓN: cONTRTOLADOR QUE REALIZA EL LOGIBN DELA APLICACIÓN Y SE CRERAN LAS VARIABLES DE SESION
 * FECHA: 02 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recibeof_c extends CI_Controller {
    //contralador inicial, carga el login
    function __construct()
    {
        parent::__construct();
        $his->load->library('form_validation');
        $this->load->model('catalogos/TipoJuicios_model');
    }

    public function index(){
        $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
        $this-> load -> view('recepof_view',$datos);
    }
}

