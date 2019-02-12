<?php

/*
 * DESCRIPCIÓN: cONTRTOLADOR QUE REALIZA EL LOGIBN DELA APLICACIÓN Y SE CRERAN LAS VARIABLES DE SESION
 * FECHA: 02 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Canaliaut_c extends CI_Controller {
    //contralador inicial, carga el login
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('catalogos/TipoJuicios_model');
        $this->load->model('canaliaut/Canaliaut_m');
    }

    public function index(){
        $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
        $this-> load -> view('canaliaut/canaliaut_view',$datos);
    }
    public function Busautoriza(){
//        $exp=$this->input->post('expediente');
//        $anioexp=$this->input->post('anioexp');
//        $folio=$this->input->post('folio');
//        $aniofolio=$this->input->post('aniofol');
//        $tipjui=$this->input->post('tipjuc');
//        
//        if(($exp != NULL) and ($anioexp == NULL) and ($folio==NULL) and ($aniofolio==NULL))
//        {
//            $this->form_validation->set_rules('anioexp','El año del expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//        }else if(($exp == NULL) and ($anioexp != NULL)){
//            $this->form_validation->set_rules('expediente','El expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//        }else if(($folio != NULL) and ($aniofolio == NULL)){
//            $this->form_validation->set_rules('aniofol','El año del expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//        }else if(($folio == NULL) and ($aniofolio != NULL)){
//            $this->form_validation->set_rules('folio','El expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//        }else if(($tipjui==NULL) and (($exp == NULL) and ($anioexp == NULL)) and ($folio == NULL) and ($aniofolio == NULL)){
//            $this->form_validation->set_rules('expediente','El expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//            $this->form_validation->set_rules('anioexp','El año del expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//            $this->form_validation->set_rules('folio','El tipo de juicio no debe ir en blanco','required|trim|min_length[1]|xss_clean');
//            $this->form_validation->set_rules('aniofol','El año del expediente no debe ir vacio','required|trim|min_length[1]|xss_clean');
//            $this->form_validation->set_rules('tipjuc','El tipo de juicio no debe ir vacio','required|trim|min_length[1]|xss_clean');
//        }
//        
//        if($this->form_validation->run() == FALSE){ //si no se cumplio una regla, muestra la pantalla, y ejecutala 
//            $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
//            $this->load->view('canaliaut/canaliaut_view',$datos);
////	      $this->load->view('footer');
//              $this->load->view('Modales/modalError');
//        }else{
//            
            $datos['toca']=trim($this->input->post('toca'));
            $datos['exp']=trim($this->input->post('expediente'));
            $datos['oficio']=trim($this->input->post('oficio'));
            $datos['folio']=trim($this->input->post('folio'));
            $datos['anioexp']=trim($this->input->post('anioexp'));
            $datos['aniofolio']=trim($this->input->post('aniofol'));
            $datos['estatus']=1;
            $datos['tipjui']=NULL;
            
            
            list($varegper,$cursor) =$this->Canaliaut_m->Busautor($datos);
//            echo "varegper --->".$varegper."<br>";
            
            while($data = oci_fetch_array($cursor)  )
            {
               $id_sol=$data['ID_SOL']; 
                
               $personas =$this->Canaliaut_m->Buspers($id_sol);
               while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
               {
                    $rc=$row['MFRC'];
                    oci_execute($indice);
                        while(($data2 = oci_fetch_array($rc,OCI_ASSOC)))
                        {
                            echo "nombre-->".$data2['NOMBRE']."<br>";
                        }
                    }
               }
                
            
        
    }
    
    
}

