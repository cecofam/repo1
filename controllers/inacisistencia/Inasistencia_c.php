<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Inasistencia_c extends CI_Controller{
    
    function __construct() 
    {
        parent::__construct();
            //$param['tabla']="";
            $this->load->library('form_validation');
            $this->load->model('inasistencia/Inasistencia_m');       
    }
     public function index()
    {
        $param['tabla']="";
        $this->load->view('inasistencia/Inasistencia_v');
    } 
    public function busqueda()
    { 

            $datos['FOLIO']= $this->input->post('FOLIO');
            $datos['ANIOFOL']= $this->input->post('ANIOFOL');
            $datos['OFICIO']= $this->input->post('OFICIO');         
            $datos['EXPEDIENTE']= $this->input->post('EXPEDIENTE');
            $datos['ANIOEXP']= $this->input->post('ANIOEXP');
            $datos['TOCA']= $this->input->post('TOCA');
            if(($datos['FOLIO']=="") and ($datos['ANIOFOL']=="") and ($datos['OFICIO']=="") and ($datos['EXPEDIENTE']=="") and ($datos['ANIOEXP']=="") and ($datos['TOCA']==""))
            {
                $param['tabla']="";
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/modalerror',$datos);
                                                            $this->load->view('inasistencia/Inasistencia_v',$param);
            }
            else
            {
                    //LLAMAR A LOS MODELOS
            $cursor = $this->Inasistencia_m->busqueda($datos);
            $param['tabla'] = "<center>
                                        <table class='contenidoTable' border='2'>
                                            <tr>
                                               <th class='title'>NOMBRE</th>
                                               <th class='title'>EXPEDIENTE/AÑO</th>
                                               <th class='title'>TIPO DE JUICIO</th>
                                               <th class='title'>INASISTENCIA</th>
                                              </tr>";
           while($data = oci_fetch_array($cursor))
           {
               if($data[0]=="")
                {
                                $param['tabla']="";
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/error',$datos);
                }
                else
                {    
                                    $param['tabla'].="<tr>
                                                      <td>$data[0]</td>
                                                      <td>$data[1]</td>
                                                      <td>$data[2]</td>
                                                      <td><input type=\"checkbox\" name=\"check\" align='center'></td>
                                                      </tr>";
                }
           }
            $param['tabla'].="</table>";      
            $this->load->view('inasistencia/Inasistencia_v',$param);
            }   
    }
}