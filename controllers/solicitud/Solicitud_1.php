<?php

/*
 * DESCRIPCIÓN: cONTRTOLADOR QUE REALIZA EL LOGIBN DELA APLICACIÓN Y SE CRERAN LAS VARIABLES DE SESION
 * FECHA: 02 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Solicitud extends CI_Controller {
    //contralador inicial, carga el login
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('catalogos/TipoJuicios_model');
        $this->load->model('solicitud/Solicitud_model');
            
    }

    public function index(){
        $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
        $this-> load -> view('solicitud/regis_solic_view',$datos);
    }
    public function RegisSolic(){
        $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
         
        /*Valor de los checkbox para saber que valor requerir*/
        $instA=$this->input->post('insiA');
        $instD=$this->input->post('insiD');
        $custA=$this->input->post('custA');
        $custD=$this->input->post('custD');
        
        if($instA==1){
          $this->form_validation->set_rules('instA','Institución del actor','required|trim|min_length[3]|xss_clean');
        }else{
          $this->form_validation->set_rules('nombreA','Nombre del actor','required|trim|min_length[3]|xss_clean');
          $this->form_validation->set_rules('apePaternoA','Apellido Paterno del actor','required|trim|min_length[3]|xss_clean');
          $this->form_validation->set_rules('apeMaternoA','Apellido Materno del actor','required|trim|min_length[3]|xss_clean');
        }
        
        if($instD==1){
           $this->form_validation->set_rules('instD','Insituación del demandado','required|trim|min_length[3]|xss_clean'); 
        }else{
           $this->form_validation->set_rules('nombreD','Nombre del demandado','required|trim|min_length[3]|xss_clean');
           $this->form_validation->set_rules('apePaternoD','Apellido Paterno del demandado','required|trim|min_length[3]|xss_clean');
           $this->form_validation->set_rules('apeMaternoD','Apellido Materno del demandado','required|trim|min_length[3]|xss_clean');
        }
        
        if(($custA!=1) && ($custD!=1)){
            $this->form_validation->set_rules('custA','Debe seleccionar custodia','required|trim|min_length[1]|xss_clean');
        }
        if(($custA==1) && ($custD==1)){
            $this->form_validation->set_rules('custD','Seleccionar custodia solo para una parte','required|trim|min_length[1]|xss_clean');
        }
        
        $this->form_validation->set_rules('motref','Motivo de referencia','required|trim|min_length[2]|xss_clean');
        $this->form_validation->set_rules('exp','Expediente y año del expediente','required|trim|min_length[2]|xss_clean');
        $this->form_validation->set_rules('tipjuc','Tipo de juicios','required|trim|min_length[1]|xss_clean');
        $this->form_validation->set_rules('oficio','Número de oficio','required|trim|min_length[5]|xss_clean');
        
        if($this->form_validation->run() == FALSE){ //si no se cumplio una regla, muestra la pantalla, y ejecutala 
              $this->load->view('solicitud/regis_solic_view',$datos);
//	      $this->load->view('footer');
              $this->load->view('Modales/modalError');
        }else{
            
            if($instA==1){
                $datos['instituA']    = mb_strtoupper(trim($this->input->post('instA')));
            }else{
                $datos['nombreA']    = mb_strtoupper(trim($this->input->post('nombreA')));
                $datos['apePaternoA']= mb_strtoupper(trim($this->input->post('apePaternoA')));
                $datos['apeMaternoA']= mb_strtoupper(trim($this->input->post('apeMaternoA')));
            }
            
            if($instD==1){
                $datos['instituD']      = mb_strtoupper(trim($this->input->post('instD')));
            }else{
                $datos['nombreD']    = mb_strtoupper(trim($this->input->post('nombreD')));
                $datos['apePaternoD']= mb_strtoupper(trim($this->input->post('apePaternoD')));
                $datos['apeMaternoD']= mb_strtoupper(trim($this->input->post('apeMaternoD')));
            }
            
            if($custA==1){
                $datos['custA']      = $this->input->post('custA');
            }
            
            if($custD==1){
                $datos['custD']      = $this->input->post('custD');
            }
            
            $datos['oficio']    = mb_strtoupper(trim($this->input->post('oficio')));
            $datos['fec_oficio']= $this->input->post('fec_oficio');
            $datos['motref']    = mb_strtoupper(trim($this->input->post('motref')));
            $datos['exp']       = $this->input->post('exp');
            $datos['toc']       = $this->input->post('toc');
            $datos['anioexp']   = $this->input->post('anioexp');
            $datos['tipjuc']    = $this->input->post('tipjuc');
            $datos['idUser']    = $this->session->userdata['idUser'];
            $datos['anio']      = date('Y');
            $datos['id_juzse']  = $this->input->post('num');
            $datos['juzsal']    = $this->input->post('juzsal');
            $datos['totfilA']    = $this->input->post('totfilA');
            
            
            echo "totfilA --->".$datos['totfilA']."<br>";
//            $varegsol=$this->Solicitud_model->Reg_solicitud($datos);
////        
//            if($varegsol==1){
//                $data=array('mensaje'=>'Se completo el registro de la solicitud.', 
//                            'url'=>'index.php/solicitud/Solicitud');
//                $datos['combTJ']=$this->TipoJuicios_model->BuscatipoJui();
//                $this->load->view('solicitud/regis_solic_view', $datos);
//                $this->load->view('Modales/modalCorrecto',$data); 
//            }
//            
//            echo "PAID_JUZSEC --->".$datos['id_juzse']."<br>";
////            echo "custA --->".$datos['custA']."<br>";
////            echo "nombreA --->".$datos['nombreA']."<br>";
////            echo "apePaternoA --->".$datos['apePaternoA']."<br>";
////            echo "apeMaternoA --->".$datos['apeMaternoA']."<br>";
////            echo "nombreD --->".$datos['nombreD']."<br>";
////            echo "apePaternoD --->".$datos['apePaternoD']."<br>";
////            echo "apeMaternoD --->".$datos['apeMaternoD']."<br>";
//            echo "PAOFICIO -->".$datos['oficio']."<br>";
//            echo "PAMOTIVO --->".$datos['motref']."<br>";
//            echo "PAEXPEDIENTE --->".$datos['exp']."<br>";
//            echo "PATOCA --->".$datos['toc']."<br>";
//            echo "PAANIO_TOCA_EXPEDIENTE --->".$datos['anioexp']."<br>";
//            echo "PAIDTIPJUI --->".$datos['tipjuc']."<br>";
//            echo "anio --->".$datos['anio']."<br>";
//            echo "PAID_PRO --->".$datos['juzsal']."<br>";
//            echo "PAUSUARIO_CREA --->".$datos['idUser']."<br>";
//            echo "PAANIOFOLIO --->".$datos['anio']."<br>";
//            echo "PAFEC_OFICIO --->".$datos['fec_oficio']."<br>";
            
        }
    }
    public function InfNumorg(){
       
            //log_message('info', "Doctor:" . $_POST['usuario']);
           echo "id --->".$di."<br>";
           $id=$_POST['id_juz'];
           $mensaje="";
           $num_juz = $this->Solicitud_model->consnum($id);
//           while($data = oci_fetch_array($num_juz)){
//                echo "<option value='".$arr['NUM']."'>".$arr['NUM']."</option>";
//           }
           echo $num_juz;
          
    }
}

