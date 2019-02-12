<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/phpword/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class PCita_c extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->model('pCita/PCita_m');        
    }    
    public function index(){
        $param['tabla']="";
        $this->load->view('pCita/PCita_v',$param);
    }
    
    public function busqueda(){
            $datos['folio']= $this->input->post('folio');
            $datos['aniofolio']= $this->input->post('Añofolio');
            $datos['oficio']= $this->input->post('oficio');
            $datos['exp']= $this->input->post('expe');
            $datos['anioexp']= $this->input->post('Añoexpe');
            $datos['toca']= $this->input->post('toca');
            
            if(($datos['folio']=="") and ($datos['aniofolio']=="") and ($datos['oficio']=="") and ($datos['exp']=="") and ($datos['anioexp'] =="") and ($datos['toca']=="")){
               
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/modalerror',$datos);
                                                            $this->load->view('pCita/PCita_v');
            }else{
                
               list($cursor,$pavalida) = $this->PCita_m->busqueda($datos);
//                
//                $param['tabla'] = "<center>
//                                        <table class='contenidoTable' border='1'>
//                                            <tr class='active'>
//                                                <td style='vertical-align:middle'><center><b>No.</b></center></td>
//                                                <td style='vertical-align:middle'><center><b>Folio</b></center></td>
//                                                <td style='vertical-align:middle'><center><b>Expediente</b></center></td>
//                                                <td style='vertical-align:middle'><center><b>Tipo de juicio</b></center></td>
//                                                <td style='vertical-align:middle'><center><b>Actor vs Demandado</b></center></td>
//                                                <td style='vertical-align:middle'><center><b> </b></center></td>                                           
//                                              </tr>";
//                      $count=1;
//                                while ($param  = oci_fetch_array($pavalida)){                                    
//                                      $ID_SOL= $param['ID_SOL'];
//                                      $EXPEDIENTE= $param['EXPEDIENTE'];
//                                      $FOLIO= $param['FOLIO'];
//                                      
////                                      $NOMBRE= $param['NOMBRE'];
//                                      
//                                    
//                                
//                             $param['tabla'] = "<tr>
//                                    <td><$count> </td>
//                                    <td><$FOLIO> </td>
//                                <td><$EXPEDIENTE></td>";}
//                
//                
//          echo   $param['tabla'] ="</table><center>"; 
             
             
             
                

//                  while ($data  = oci_fetch_array($pavalida)){  
//                         $datos['SOLICITUD']= $data['ID_SOL'];  
//                  } 
//                  
//        //             list($cursortj,$vasalidatj) = $this->PCita_m->busquedatjuicio($datos);     
//                  
//                        $personas = $this->PCita_m->Buspers($datos);  
//                    $param['personas']=$personas; 
//                    
//                    $param['tabla1'] = "<center>
//                                        <table class='contenidoTable'>";
//                        while($respuesta = oci_fetch_array($personas, OCI_ASSOC)){
//                                      $indice=$respuesta['MFRC'];
//                                      oci_execute($indice);
//                                  while($arr = oci_fetch_array($indice,OCI_ASSOC)){
//                                  $nombre =   $arr['NOMBRE'];
//                                  $IDTIP =   $arr['IDTIP'];
//                                  if($IDTIP=='6' || $IDTIP=='5'){
//                                 $param['tabla1'].="<tr>
//                                                     <td>&nbsp;&nbsp;&nbsp;$nombre</td>
//                                  </tr> ";  }
//                                  
//                        }}
//                       $param['tabla1'].="</table>";      
//                      
           
                  
   


           $param['cursor']=$cursor;
           $param['pavalida']=$pavalida;
         $this->load->view('pCita/PCita_v',$param); 
            }
     }
    
    public function mostrar(){
            $datos['FOLIO']= $this->input->post('FOLIO');
            $datos['ANIOFOL']= $this->input->post('ANIOFOL');
            $datos['OFICIO']= $this->input->post('OFICIO');            
            $datos['EXPEDIENTE']= $this->input->post('EXPEDIENTE');
            $datos['ANIOEXP']= $this->input->post('ANIOEXP');
            $datos['TOCA']= $this->input->post('TOCA');
            
            
            if(($datos['FOLIO']=="") and ($datos['ANIOFOL']=="") and ($datos['OFICIO']=="") and ($datos['EXPEDIENTE']=="") and ($datos['ANIOEXP'] =="") and ($datos['TOCA']=="")){
                $param['tabla']="";
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/modalerror',$datos);
                                                            $this->load->view('pCita/PCita_v',$param);
            }else{
            
            //LLAMAR A LOS MODELOS
            $cursor = $this->PCita_m->busqueda($datos);
            $param['tabla'] = "<center>
                                        <table class='contenidoTable' border='2' align='center' cellpadding='10'>
                                            <tr>
                                               <th class='title'>NOMBRE</th>
                                               <th class='title'>EXPEDIENTE</th>
                                               <th class='title'>TIPO DE JUICIO</th> 
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
                    $url_doc=site_url('index.php/pCita/PCita_c/wordPrimeraCita');
                    
                                    $param['tabla'].="<tr>
                                                      <td>$data[0]</td>
                                                      <td>$data[1]</td>
                                                      <td>$data[2]</td>
                                                      </tr>";
                }
           }
           
              
        "<td><input value=\"\" type='file' id='file' name'request'></input></td>";
        $param['tabla'].="</table>";
        $this->load->view('pCita/PCita_v',$param);
    }
    }
    
    
    public function wordPrimeraCita()
    {
        $templateWord = new TemplateProcessor('plantillas/OFICIO 1.docx');

		$actor = "Miriam Martinez Gonzalez";
		$demandado = "Juan Lugo Martinez";
		$num_expediente = "12345";
                $dia_actual=date("j",time());
                $mes_actual= date("m", time());
                            
                            //Obtener el día en texto y no en número
                            $month ['mes']= $mes_actual;
                            //echo "tt-->".$date_info['mes'];
                            //Traducimos los meses de inglés a Español
                            switch ($month['mes']) { 
                                case "01" : $month['mes']="Enero";break; 
                                case "02" : $month['mes']="Febrero";break; 
                                case "03" : $month['mes']="Marzo";break; 
                                case "04" : $month['mes']="Abril";break; 
                                case "05" : $month['mes']="Mayo";break; 
                                case "06" : $month['mes']="Junio";break; 
                                case "07" : $month['mes']="Julio";break; 
                                case "08" : $month['mes']="Agosto";break; 
                                case "09": $month['mes']="Septiembre";break; 
                                case "10" : $month['mes']="Octubre";break; 
                                case "11" : $month['mes']="Noviembre";break; 
                                case "12" : $month['mes']="Diciembre";break; 
                            }; 
                            $mes = $month['mes'];
                            
                $anio= date("Y", time());
                $anioexp = "2018";
                $folio = "123456";
                $sec = "A";
		$tipo_juicio = "PAGO DE DAÑOS CULPOSOS CAUSADOS POR MOTIVOS DEL TRANSITO DE VEHICULO";
		$oficio = "67890";
		$f_oficio = "20 de Septiembre del 2018";
		$persona1 = "Miriam Martinez Gonzalez";
		$persona2 = "Juan Lugo Martinez";
		$f_custodio = "13 de Octubre del 2018";
		$f_ncustodio = "13 de Octubre del 2018";


		// --- Asignamos valores a la plantilla
		$templateWord->setValue('actor',$actor);
		$templateWord->setValue('demandado',$demandado);
		$templateWord->setValue('num_expediente',$num_expediente);
		$templateWord->setValue('anioexp',$anioexp);
                $templateWord->setValue('folio', $folio);
                $templateWord->setValue('secretaria', $sec);
		$templateWord->setValue('tipo_juicio', $tipo_juicio);
                $templateWord->setValue('dia_actual',$dia_actual);
                $templateWord->setValue('mes_actual',$mes);
                $templateWord->setValue('anio',$anio);
		$templateWord->setValue('oficio',$oficio);
		$templateWord->setValue('fecha_oficio',$f_oficio);
		$templateWord->setValue('persona1',$persona1);
		$templateWord->setValue('persona2',$persona2);
		$templateWord->setValue('fecha_custodio',$f_custodio);
		$templateWord->setValue('fecha_ncustodio',$f_ncustodio);

		// --- Guardamos el documento
		$templateWord->saveAs('Primera Cita.docx');

		header("Content-Disposition: attachment; filename=Primera Cita.docx; charset=iso-8859-1");
		echo file_get_contents('Primera Cita.docx');
    }
     
    public function wordOfCumplimiento()
    {
        $templateWord = new TemplateProcessor('plantillas/OFICIO 1.docx');

		$actor = "Miriam Martinez Gonzalez";
		$demandado = "Juan Lugo Martinez";
		$num_expediente = "123546";
                $dia_actual=date("j",time());
                $mes_actual= date("m", time());
                            
                            //Obtener el día en texto y no en número
                            $month ['mes']= $mes_actual;
                            //echo "tt-->".$date_info['mes'];
                            //Traducimos los meses de inglés a Español
                            switch ($month['mes']) { 
                                case "01" : $month['mes']="Enero";break; 
                                case "02" : $month['mes']="Febrero";break; 
                                case "03" : $month['mes']="Marzo";break; 
                                case "04" : $month['mes']="Abril";break; 
                                case "05" : $month['mes']="Mayo";break; 
                                case "06" : $month['mes']="Junio";break; 
                                case "07" : $month['mes']="Julio";break; 
                                case "08" : $month['mes']="Agosto";break; 
                                case "09" : $month['mes']="Septiembre";break; 
                                case "10" : $month['mes']="Octubre";break; 
                                case "11" : $month['mes']="Noviembre";break; 
                                case "12" : $month['mes']="Diciembre";break; 
                            }; 
                            $mes = $month['mes'];
                            
                $anio= date("Y", time());
                $anioexp = "2018";
                $folio = "123456";
                $sec = "A";
		$tipo_juicio = "PAGO DE DAÑOS CULPOSOS CAUSADOS POR MOTIVOS DEL TRANSITO DE VEHICULO";
		$oficio = "67890";
		$f_oficio = "20 de Septiembre del 2018";
		$persona1 = "Miriam Martinez Gonzalez";
		$persona2 = "Juan Lugo Martinez";
		$f_custodio = "13 de Octubre del 2018";
		$f_ncustodio = "13 de Octubre del 2018";


		// --- Asignamos valores a la plantilla
		$templateWord->setValue('actor',$actor);
		$templateWord->setValue('demandado',$demandado);
		$templateWord->setValue('num_expediente',$num_expediente);
		$templateWord->setValue('anioexp',$anioexp);
                $templateWord->setValue('folio', $folio);
                $templateWord->setValue('secretaria', $sec);
		$templateWord->setValue('tipo_juicio', $tipo_juicio);
                $templateWord->setValue('dia_actual',$dia_actual);
                $templateWord->setValue('mes_actual',$mes);
                $templateWord->setValue('anio',$anio);
		$templateWord->setValue('oficio',$oficio);
		$templateWord->setValue('fecha_oficio',$f_oficio);
		$templateWord->setValue('persona1',$persona1);
		$templateWord->setValue('persona2',$persona2);
		$templateWord->setValue('fecha_custodio',$f_custodio);
		$templateWord->setValue('fecha_ncustodio',$f_ncustodio);

		// --- Guardamos el documento
		$templateWord->saveAs('Oficio de Cumplimiento.docx');

		header("Content-Disposition: attachment; filename=Oficio de Cumplimiento.docx; charset=iso-8859-1");
		echo file_get_contents('Oficio de Cumplimiento.docx');
    }
    
    public function wordInacistenciaPCitaC()
    {
        $templateWord = new TemplateProcessor('plantillas/OFICIO 3.docx');

		$actor = "Miriam Martinez Gonzalez";
		$demandado = "Juan Lugo Martinez";
		$num_expediente = "123546";
                $dia_actual=date("j",time());
                $mes_actual= date("m", time());
                            
                            //Obtener el día en texto y no en número
                            $month ['mes']= $mes_actual;
                            //echo "tt-->".$date_info['mes'];
                            //Traducimos los meses de inglés a Español
                            switch ($month['mes']) { 
                                case "01" : $month['mes']="Enero";break; 
                                case "02" : $month['mes']="Febrero";break; 
                                case "03" : $month['mes']="Marzo";break; 
                                case "04" : $month['mes']="Abril";break; 
                                case "05" : $month['mes']="Mayo";break; 
                                case "06" : $month['mes']="Junio";break; 
                                case "07" : $month['mes']="Julio";break; 
                                case "08" : $month['mes']="Agosto";break; 
                                case "09" : $month['mes']="Septiembre";break; 
                                case "10" : $month['mes']="Octubre";break; 
                                case "11" : $month['mes']="Noviembre";break; 
                                case "12" : $month['mes']="Diciembre";break; 
                            }; 
                            $mes = $month['mes'];
                            
                $anio= date("Y", time());
                $anioexp = "2018";
                $folio = "123456";
                $sec = "A";
		$tipo_juicio = "PAGO DE DAÑOS CULPOSOS CAUSADOS POR MOTIVOS DEL TRANSITO DE VEHICULO";
		$oficio = "67890";
                $no_oficio="78910";
		$fecha_oficio = "20 de Septiembre del 2018";
                $f_oficio = "23 de Septiembre del 2018";
		$custodio = "Miriam Martinez Gonzalez";		
		$f_reprogramada = "18 de Octubre del 2018";
		$hora = "10:30 am";


		// --- Asignamos valores a la plantilla
		$templateWord->setValue('actor',$actor);
		$templateWord->setValue('demandado',$demandado);
		$templateWord->setValue('num_expediente',$num_expediente);
		$templateWord->setValue('anioexp',$anioexp);
                $templateWord->setValue('folio', $folio);
                $templateWord->setValue('secretaria', $sec);
		$templateWord->setValue('tipo_juicio', $tipo_juicio);
                $templateWord->setValue('dia_actual',$dia_actual);
                $templateWord->setValue('mes_actual',$mes);
                $templateWord->setValue('anio',$anio);
		$templateWord->setValue('oficio',$oficio);
                $templateWord->setValue('no_oficio',$no_oficio);
		$templateWord->setValue('fecha_oficio',$fecha_oficio);
                $templateWord->setValue('f_oficio',$f_oficio);
		$templateWord->setValue('custodio',$custodio);
		$templateWord->setValue('f_reprogramada',$f_reprogramada);
		$templateWord->setValue('hora',$hora);

		// --- Guardamos el documento
		$templateWord->saveAs('Inacistencia Primera Cita (Custodio).docx');

		header("Content-Disposition: attachment; filename=Inacistencia Primera Cita (Custodio).docx; charset=iso-8859-1");
		echo file_get_contents('Inacistencia Primera Cita (Custodio).docx');
    }
    
    public function wordInacistenciaPCitaNC()
    {
        $templateWord = new TemplateProcessor('plantillas/OFICIO 2.docx');

		$actor = "Miriam Martinez Gonzalez";
		$demandado = "Juan Lugo Martinez";
		$num_expediente = "123546";
                $dia_actual=date("j",time());
                $mes_actual= date("m", time());
                            
                            //Obtener el día en texto y no en número
                            $month ['mes']= $mes_actual;
                            //echo "tt-->".$date_info['mes'];
                            //Traducimos los meses de inglés a Español
                            switch ($month['mes']) { 
                                case "01" : $month['mes']="Enero";break; 
                                case "02" : $month['mes']="Febrero";break; 
                                case "03" : $month['mes']="Marzo";break; 
                                case "04" : $month['mes']="Abril";break; 
                                case "05" : $month['mes']="Mayo";break; 
                                case "06" : $month['mes']="Junio";break; 
                                case "07" : $month['mes']="Julio";break; 
                                case "08" : $month['mes']="Agosto";break; 
                                case "09" : $month['mes']="Septiembre";break; 
                                case "10" : $month['mes']="Octubre";break; 
                                case "11" : $month['mes']="Noviembre";break; 
                                case "12" : $month['mes']="Diciembre";break; 
                            }; 
                            $mes = $month['mes'];
                            
                $anio= date("Y", time());
                $anioexp = "2018";
                $folio = "123456";
                $sec = "A";
		$tipo_juicio = "PAGO DE DAÑOS CULPOSOS CAUSADOS POR MOTIVOS DEL TRANSITO DE VEHICULO";
		$oficio = "67890";
                $no_oficio="78910";
		$fecha_oficio = "20 de Septiembre del 2018";
                $f_oficio = "23 de Septiembre del 2018";
		$ncustodio = "Juan Lugo Martinez";		
		$f_reprogramada = "18 de Octubre del 2018";
		$hora = "10:45 am";


		// --- Asignamos valores a la plantilla
		$templateWord->setValue('actor',$actor);
		$templateWord->setValue('demandado',$demandado);
		$templateWord->setValue('expediente',$num_expediente);
		$templateWord->setValue('anioexp',$anioexp);
                $templateWord->setValue('folio', $folio);
                $templateWord->setValue('secretaria', $sec);
		$templateWord->setValue('tipo_juicio', $tipo_juicio);
                $templateWord->setValue('dia_actual',$dia_actual);
                $templateWord->setValue('mes_actual',$mes);
                $templateWord->setValue('anio',$anio);
		$templateWord->setValue('oficio',$oficio);
                $templateWord->setValue('no_oficio',$no_oficio);
		$templateWord->setValue('fecha_oficio',$fecha_oficio);
                $templateWord->setValue('f_oficio',$f_oficio);
		$templateWord->setValue('nocustodio',$ncustodio);
		$templateWord->setValue('f_reprogramada',$f_reprogramada);
		$templateWord->setValue('hora',$hora);

		// --- Guardamos el documento
		$templateWord->saveAs('Inacistencia Primera Cita (No Custodio).docx');

		header("Content-Disposition: attachment; filename=Inacistencia Primera Cita (No Custodio).docx; charset=iso-8859-1");
		echo file_get_contents('Inacistencia Primera Cita (No Custodio).docx');
    }
        
    public function wordAntecedentes()
    {
        $templateWord = new TemplateProcessor('plantillas/FORMATO 1.docx');

		$nombre = "MIRIAM MARTINEZ GONZALEZ";
                $edad = "18";
                $folio = "123456";
                $dia = "11";
                $mes = "OCTUBRE";
                $anio = "2000";
                $tel_c = "25897456";
                $tel_m = "5512345678";
                $entidad = "Ciudad de Mexico";
                $municipio = "Iztapalapa";
                $nacionalidad = "Mexicana";
                $religion = "Catolica";
                $escolaridad = "Bachillerato";
                $act_lab = "EMPLEADA";
                
                
		// --- Asignamos valores a la plantilla
		$templateWord->setValue('nombre',$nombre);
		$templateWord->setValue('edad',$edad);
		$templateWord->setValue('dia',$dia);
                $templateWord->setValue('mes',$mes);
		$templateWord->setValue('anio',$anio);
                $templateWord->setValue('folio', $folio);
                $templateWord->setValue('tel_casa', $tel_c);
                $templateWord->setValue('tel_movil', $tel_m);
		$templateWord->setValue('entidad', $entidad);
                $templateWord->setValue('municipio',$municipio);
                $templateWord->setValue('nacionalidad',$nacionalidad);
                $templateWord->setValue('religion',$religion);
		$templateWord->setValue('escolaridad',$escolaridad);
                $templateWord->setValue('act_lab',$act_lab);
		
		// --- Guardamos el documento
		$templateWord->saveAs('Hoja de Antecedentes.docx');

		header("Content-Disposition: attachment; filename=Hoja de Antecedentes.docx; charset=iso-8859-1");
		echo file_get_contents('Hoja de Antecedentes.docx');
    }
}