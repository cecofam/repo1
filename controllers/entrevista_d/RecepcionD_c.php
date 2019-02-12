<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class RecepcionD_c extends CI_Controller{
   
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('entrevista_d/RecepcionD_m');

    }
     public function index()
    {
       
         $param['tabla']=""; //parametros de la tabla 
         $this->load->view('entrevista_d/RecepcionD_v',$param); 
         } 
    
    //////////////************************************************************///////////////////////////////
   public function Recep() {
           
            $datos['toca']=NULL;
            $datos['expediente']=$this->input->post('expediente');
            $datos['oficio']=$this->input->post('oficio');
            $datos['folio']=$this->input->post('folio');
            $datos['anioexp']=$this->input->post('anioexp');
            $datos['aniofol']=$this->input->post('aniofol');
            $datos['estatus']=11;  //CAMBIO ESTATUS DE 1 A 11 YA QUE PARA ENTREVISTA DIAGNOSTICA EL 11 ES EL ESTATUS CORRECTO 1610
            $datos['tipjui']=NULL;
            
            list($vasalida,$cursor)=$this->RecepcionD_m->Recep($datos);
      
              $param['tabla'] ="<center> <br> <br>
                                       <div id='sortableTable' class='body collapse in'> 
                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid'>
                                               <thead>
                                            <tr>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Número
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Expediente
                                                    </div>
                                               </th>
                                               
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Folio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                      Juicio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Persona
                                                    </div>
                                               </th>       
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Carga
                                                    </div>
                                               </th>
                                            </tr>
                                            </thead>
                                            </div>";
             $incr=1;
              
          while($data = oci_fetch_array($cursor))
         {
                if($data[0]=="")
                {
                    $param['tabla']="";
                    $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                              $this->index();
                                                              $this->load->view('Modales/error',$datos);
                }
                else
                {    
 //********************************** FORM ****************************
                    $aux=$data['ID_SOL'];
                     $juicios='';
                    $url =base_url().'index.php/entrevista_d/RecepcionD_c/cargar';
                    $param['tabla'].="<tr>
                        <form action='$url' method ='post' enctype='multipart/form-data'>
                        <td>".$incr."<br>"."<input type='text' value='".$data['ID_SOL']."' name='id_sol' id='id_sol'></td>".
                        "<td>&nbsp;&nbsp;&nbsp;$data[1]</td>".
                        "<td>".$data['FOLIO']."<br>"."<input style=\"height:50px;width:80px\" type='text' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'></td><td>";
  //************************************WHILE TIP JUI************************************************                 
                        $cursor3 = $this->RecepcionD_m->tipJui($aux);
                            while(($row = oci_fetch_array($cursor3,OCI_ASSOC)))
                        {
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                        while(($data = oci_fetch_array($rc,OCI_ASSOC)))
                       {                                                                               
                         $param['tabla'].="*".$data['DES']."<br>";
               } 
               }
                         $param['tabla'].="</td><td>";    
                        $incr++;   
                        $vaaux=0;
                        $cursor2 = $this->RecepcionD_m->tipoPer($aux);
                        while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
                            {
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                                while(($data2 = oci_fetch_array($rc,OCI_ASSOC)))
                              {
                                    $per=$data2['IDTIP'];
                                    if($per == 6){
                                $param['tabla'].="<br>".$data2['TIP_PER'].": ".$data2['NOMBRE']."<br>"."<input style=\"height:50px;width:280px\" type='text' name='NOMBREDEM' id='NOMBREDEM' value='".$data2['NOMBRE']."'>";    
                              }//end if (6)
                                    if ($per == 5){
                                $param['tabla'].="<br>".$data2['TIP_PER'].": ".$data2['NOMBRE']."<br>"."<input style=\"height:50px;width:280px\" type='text' name='NOMBREACT' id='NOMBREACT' value='".$data2['NOMBRE']."'>";    
                               }//end if (5)
                              }//end while $data2
                            }//end while $row
                        }
//********************************************BOTONES****************************************                           
                    $param['tabla'].="<td><br><input type='file' class='btn btn-primary' id='mi_archivo'  name='carga' value='cargar archivo'/></input> "
                            ."<center><br><input type='submit' class='btn btn-primary' id='aceptar' name='aceptar' value='aceptar'/></center></td></tr></form>";
                   }
            $param['tabla'].="</table>";      
            $this->load->view('entrevista_d/RecepcionD_v',$param);       
  }

  //*********************************************************************************************************************************

  //************************************CARGAR*********************************************************************************************
   public function cargar(){
       $mi_archivo = 'mi_archivo';
        $config['upload_path'] = "desktop";
        $config['file_name'] = "nombre_archivo";
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        if ( ! $this->upload-> do_upload('mi_archivo'))
    {

                   $errors = $this->upload->display_errors();
                   $this->session->set_flashdata('error', $errors);
                       redirect('index.php/entrevista_d/RecepcionD_c');
    }
    else
    { 
                            $data = array('upload_data' => $this->upload->data());
                            $fullpath= $data['upload_data']['full_path'];
                            $file_name = $data['upload_data']['file_name'];
                    }
    }
        
          
//        $data['ID_SOL']=$this->input->post('id_sol');
//         $data2['NOMBREDEM']=$this->input->post('NOMBREDEM');
//         $data2['NOMBREACT']=$this->input->post('NOMBREACT');
//         $data['FOLIO']=$this->input->post('FOLIO');
// 
//        
//        echo "id --->".$data['ID_SOL']."<br>";
//         echo "Nombre ACTOR --->".$data2['NOMBREACT']."<br>";
//         echo "Nombre DEMANDADO --->".$data2['NOMBREDEM']."<br>";
//         echo "FOLIO --->".$data['FOLIO']."<br>";
//        

         
    }  



   