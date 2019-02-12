<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates.

 * and open the template in the editor */
require_once 'phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class InasistenciaD_c extends CI_Controller{
   
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('inasistencia/InasistenciaD_m');

    }
     public function index()
    {
       
         $param['tabla']=""; //parametros de la tabla 
         $this->load->view('entrevista_d/InasistenciaD_v',$param); 
         } 
    
    //////////////************************************************************///////////////////////////////
   public function Recepe() {

            $datos['toca']=$this->input->post('toca');
            $datos['expediente']=$this->input->post('expediente');
            $datos['oficio']=NULL;
            $datos['folio']=$this->input->post('folio');
            $datos['anioexp']=$this->input->post('anioexp');
            $datos['aniofol']=$this->input->post('aniofol');
            $datos['estatus']=13;  //CAMBIO ESTATUS DE 1 A 11 YA QUE PARA ENTREVISTA DIAGNOSTICA EL 11 ES EL ESTATUS CORRECTO 1610
            $datos['tipjui']=NULL;
            list($vasalida,$cursor)=$this->InasistenciaD_m->Recep($datos);
          
             $param['tabla'] = "<center>
                                        <div id='sortableTable' class='body collapse in'>
                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid'>
                                            <thead>
                                            <tr>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Número:
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Expediente
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                       Juicio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Folio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Persona
                                                    </div>
                                               </th>                                               
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Inasistencia 
                                                    </div>
                                             
                                               </th>
                                            </tr>
                                            </thead>";
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
                    //pasar a input
                    //iniciar un contador en lugar de Id Solicitud
                    ////INPUT DE EXPEDIENTE (REVISAR SI SE USA O NEL
                    //"<td>".$data['EXPEDIENTE']."<input style=\"height:50px;width:80px\" type='text' name='EXPEDIENTE' id='EXPEDIENTE' value='".$data['EXPEDIENTE']."'></td>
                 //********************************** FORM ****************************
                    /*$url =base_url().'index.php/Entrevista_d/InasistenciaD_c/wordAntecedentes';
                    $param['tabla'].="<form action='$url' method ='post'>
                        <tbody aria-live='polite' aria-relevant='all'>
                        <tr>
                        <td>".$incr."&nbsp;&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp".$data['EXPEDIENTE']."</td>
                        <td>&nbsp;&nbsp;&nbsp;".$data['FOLIO']."</td>
                        <td>".$data['FOLIO']."<input style=\"height:50px;width:80px\" type='hidden' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'></td> 
                        ";
                        $incr++;*/
  
                        $vaaux=0;
                        $aux=$data[0];
                        $cursor2 = $this->InasistenciaD_m->tipoPer($aux);
                        
                        while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
                            {                                
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                                while(($data2 = oci_fetch_array($rc,OCI_ASSOC))){
//                             { 
                                $url =base_url().'index.php/Entrevista_d/InasistenciaD_c/wordAntecedentes';
                                        $param['tabla'].="<form action='$url' method ='post'>
                                            <tbody aria-live='polite' aria-relevant='all'>
                                            <tr>
                                            <td><center>".$incr."&nbsp;&nbsp;&nbsp;</center></td>
                                            <td>&nbsp;&nbsp;&nbspEXPEDIENTE:&nbsp;".$data['EXPEDIENTE']."</td>
                                            <td>&nbsp;&nbsp;&nbspJUICIO:&nbsp;".$data['FOLIO']."</td>
                                            <td>FOLIO:&nbsp;".$data['FOLIO']."<input style=\"height:50px;width:80px\" type='hidden' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'></td> 
                                            ";
                                               
                                $per=$data2['IDTIP'];
//                                    if($per){
//                                $param['tabla'].=$data2['TIP_PER'].": ".$data2['NOMBRE']."<input style=\"height:50px;width:280px\" type='hidden' name='NOMBRE' id='NOMBRE' value='".$data2['NOMBRE']."'><br><br>";    
//                              }//end if (6)
                                  
                                $param['tabla'].="<td>".$data2['TIP_PER']."<br>".$data2['NOMBRE']."</td><input style=\"height:50px;width:280px\" type='hidden' name='NOMBRE' id='NOMBRE' value='".$data2['NOMBRE']."'>";    
                               //end f (5)
                                $param['tabla'].="<td><center><input type='checkbox' name='checkbox[]' value='ID_PERSONA'/></center></td>";
                                $incr++; 
                              }//end while $data2
                              
                            }//end while $row

                            //poner un form 
                            //inicio de boton de ver y descarga
                   
                            
                            
               }
         }
        
            $param['tabla'].="</tbody></table></div>"
                    . "</form>";     
            
            $this->load->view('entrevista_d/InasistenciaD_v',$param);   
  }

  
  //*********************************************************************************************************************************
//GENERACION DE FUNCIONES QUE GENERAN EL DOCUMENTO EN WORD PARA EL FORMATO NUMERO 1  
//
//
//   public function wordAntecedentes()
//    {
//        $templateWord = new TemplateProcessor('plantillas/FORMATO 1.docx');
 ////modelo. recorerlo, ESTATUS 11 (pendiente de cambiar), cambiar funcion, tres formatos diferentes, tres funciones,
//        //MANDO A LLAMAR AL MODELO PARA REALIZAR LA CONSULTA DONDE SE EXTRAEN $DATOS
//        list($vasalida,$cursor)=$this->InasistenciaD_m->Recep($datos);            
//		$nombre = "MIRIAM MARTINEZ GONZALEZ";
//                $edad = "18";
//                $folio = "123456";
//                $dia = "11";
//                $mes = "OCTUBRE";
//                $anio = "2000";
//                $tel_c = "25897456";
//                $tel_m = "5512345678";
//                $entidad = "Ciudad de Mexico";
//                $municipio = "Iztapalapa";
//                $nacionalidad = "Mexicana";
//                $religion = "Catolica";
//                $escolaridad = "Bachillerato";
//                $act_lab = "EMPLEADA";
//                
//                
//		// --- Asignamos valores a la plantilla
//		$templateWord->setValue('nombre',$nombre);
//		$templateWord->setValue('edad',$edad);
//		$templateWord->setValue('dia',$dia);
//                $templateWord->setValue('mes',$mes);
//		$templateWord->setValue('anio',$anio);
//                $templateWord->setValue('folio', $folio);
//                $templateWord->setValue('tel_casa', $tel_c);
//                $templateWord->setValue('tel_movil', $tel_m);
//		$templateWord->setValue('entidad', $entidad);
//                $templateWord->setValue('municipio',$municipio);
//                $templateWord->setValue('nacionalidad',$nacionalidad);
//                $templateWord->setValue('religion',$religion);
//		$templateWord->setValue('escolaridad',$escolaridad);
//                $templateWord->setValue('act_lab',$act_lab);
//		
//		// --- Guardamos el documento
//		$templateWord->saveAs('Hoja de Antecedentes.docx');
//
//		header("Content-Disposition: attachment; filename=Hoja de Antecedentes.docx; charset=iso-8859-1");
//		echo file_get_contents('Hoja de Antecedentes.docx');
//    }
  //*********************************************************************************************************************************
   public function wordAntecedentes()
    {  
//       $data2['TIP_PER'].": ".$data2['NOMBRE'];
//       echo $data2."tipo persona";
//       
//       $datos['folio']=$this->input->post('folio');
//       $datos['aniofol']=$this->input->post('aniofol');
//       list($vasalida,$cursor)=$this->InasistenciaD_m->Recep($datos);
////       $folio=$this->input->post('folio');
////       $aniofol=$this->input->post('aniofol');
//       echo $data['FOLIO']."mas la variable jiji ";
//       echo $datos['aniofol'];
//       
//       echo 'esto funciona, las variables no';
       
//      
//        $templateWord = new TemplateProcessor('plantillas/FORMATO 1.docx');
////modelo. recorerlo, ESTATUS 11 (pendiente de cambiar), cambiar funcion, tres formatos diferentes, tres funciones,
//        //MANDO A LLAMAR AL MODELO PARA REALIZAR LA CONSULTA DONDE SE EXTRAEN $DATOS
//        
//                
//		// --- Asignamos valores a la plantilla
//		$templateWord->setValue('nombre',$nombre);
//	
//		// --- Guardamos el documento
//		$templateWord->saveAs('Hoja de Antecedentes.docx');
//
//		header("Content-Disposition: attachment; filename=Hoja de Antecedentes.docx; charset=iso-8859-1");
//		echo file_get_contents('Hoja de Antecedentes.docx');
    }
}
   