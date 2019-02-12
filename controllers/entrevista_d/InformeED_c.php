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
class InformeED_c extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->model('entrevista_d/InformeED_m');        
        
    }    
    public function index()
    {
       $param['tabla']="";        
       $this->load->view('entrevista_d/InformeED_v', $param);        
    }
     
    public function bus_Solictud()
    { 
             //Validación de los campos 
            $this->form_validation->set_rules('toca','Toca','max_length[6]|xss_clean|is_natural');
            $this->form_validation->set_rules('oficio','Oficio','max_length[6]|xss_clean|is_natural');            
            $this->form_validation->set_rules('expediente','Expediente','max_length[6]|xss_clean|is_natural');            
            $this->form_validation->set_rules('anioexp','Año de Expediente','max_length[4]|xss_clean|is_natural');
            $this->form_validation->set_rules('folio','Folio','max_length[6]|xss_clean|is_natural');
            $this->form_validation->set_rules('aniofol','Año de Folio','max_length[4]|xss_clean|is_natural');                       
        
            if($this->form_validation->run() == FALSE)//si no se cumplio una regla, muestra la pantalla, y ejecuta la
            {  
               $this->load->view('entrevista_d/InformeED_v'); //la vista que contiene la ventana modal
               $this->load->view('Modales/modalError');                      
            }                     
            else
                {
                    $datos['toca'] = strtoupper(trim($this->input->post('toca')));;
                    $datos['expediente'] = strtoupper(trim($this->input->post('expediente')));
                    $datos['oficio'] = strtoupper(trim($this->input->post('oficio')));
                    $datos['anioexp'] = strtoupper(trim($this->input->post('anioexp')));            
                    $datos['estatus']= 11;  //Manejamos estatus 11 y se actualizará a ---> 14 y/o 15+                      
                    $datos['folio'] = strtoupper(trim($this->input->post('folio')));
                    $datos['aniofol'] = strtoupper(trim($this->input->post('aniofol')));
                    $datos['tipjui'] = NULL;

                    //LLAMAR A LA FUNCIÓN QUE BUSCA LA SOLICITUD            
                    list($vasalida,$cursor) = $this->InformeED_m->busSolictud($datos); 
                    if(($datos['anioexp']=="") and ($datos['oficio']=="") and ($datos['expediente']=="")and ($datos['toca']=="") and ($datos['folio']=="") and ($datos['aniofol']==""))
                    {  
                        $param['tabla']="";
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'La consulta no contiene datos',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/modalerror',$datos);
                                                            $this->load->view('entrevista_d/InformeED_v',$param);
                    }
                    else
                    {
                         $param['tabla'] = "
                                        <center>
                                        <div id='sortableTable' class='body collapse in'>
                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid'>
                                            <thead>
                                            <tr>                                                                                                
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        NO.
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        EXPEDIENTE
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        FOLIO
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        JUICIO(S)
                                                    </div>
                                                </th>                                                                                                                                                                                            
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        FACILITADOR
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        NOMBRE(S)
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        ¿ES CANDIDATA?
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>";
                    //**********Recorrido de la función "busSolicitud" para obtener el id_sol************
                    $count1 =0;        
                    $count =1;                                 
                    while($data = oci_fetch_array($cursor))
                            {   
                                if ($data['ID_SOL']== "")
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
                                       $url = (base_url().'index.php/entrevista_d/InformeED_c/generarInf');
                                       $param['tabla'].="<form action='".$url."' method='post'><br>
                                                            <tr>                                                            
                                                            <th >&nbsp;&nbsp;&nbsp;".$count."</th>
                                                            <td >&nbsp;&nbsp;&nbsp;".$data['EXPEDIENTE']."</td>
                                                            <td >&nbsp;&nbsp;&nbsp;".$data['FOLIO']." <input type='hidden' value='".$data['FOLIO']."' name='folio'/></td>
                                                            <td>";                                                                                                                        
                                                             $aux=$data['ID_SOL'];//Guardamos el id_sol en una variable.                                                      
                                                             $cursor2 = $this->InformeED_m->juicio($aux);//Se manda a llamar la función que busca el juicio 
                                                             $cursor3 = $this->InformeED_m->busper($aux);//Se manda a llamar la función que busca los nombres y tipo de persona 
                                                             $cursor4 = $this->InformeED_m->facilitador($aux);
                                                             /******************BÚSQUEDA DEL JUICIO(S)**************************/
                                                             while($row = oci_fetch_array($cursor2,OCI_ASSOC))
                                                                        {
                                                                            $rc = $row['MFRC'];
                                                                            oci_execute($rc);
                                                                            while($data2 = oci_fetch_array($rc,OCI_ASSOC))
                                                                            {                                                                               
                                                                                    $param['tabla'].="<table>"
                                                                                            . "<tr>"
                                                                                            . "<td>*".$data2['DES']."<br></td>"
                                                                                            . "</tr>"
                                                                                            . "</table>";                                                                                                                                                        
                                                                            }
                                                                        }
                                                             /******************BÚSQUEDA DEL FACILITADOR ASIGNADO A LA ENTREVISTA DIAGNÓSTICA**************************/    
                                                            while($row = oci_fetch_array($cursor4, OCI_ASSOC))
                                                                        {
                                                                            $param['tabla'].="<td>";
                                                                            $rc = $row['MFRC'];
                                                                            oci_execute($rc);
                                                                            while($data4 = oci_fetch_array($rc,OCI_ASSOC))
                                                                            {   
                                                                                    $param['tabla'].="<table>
                                                                                                        <tr>
                                                                                                        <td>
                                                                                                           *LIC. ".$data4['NOMBRE']." <input type='hidden' value='".$data4['NOMBRE']."' name='fac'/>
                                                                                                        </td>                                                                                                         
                                                                                                        </tr>
                                                                                                        </table>";                                                                                                                                                                
                                                                            }      
                                                                        }
                                                             /******************BÚSQUEDA DE LA(S) PERSONA(S)**************************/
                                                             while($row = oci_fetch_array($cursor3,OCI_ASSOC))
                                                                        {
                                                                            $param['tabla'].="</td><td>";
                                                                            $rc = $row['MFRC'];
                                                                            oci_execute($rc);
                                                                            while($data3 = oci_fetch_array($rc,OCI_ASSOC))
                                                                            {   
                                                                                    $aux2=$data3['IDTIP']; 
                                                                                    if (($aux2 == 5) || ($aux2 == 6) || ($aux2 == 3))
                                                                                    {
                                                                                        $param['tabla'].="<table>
                                                                                                            <tr>
                                                                                                            <td>
                                                                                                               *".$data3['NOMBRE'].":&nbsp;&nbsp;&nbsp; <th>".$data3['TIP_PER']." </th>
                                                                                                            </td>                                                                                                         
                                                                                                            </tr>
                                                                                                            </table>";                                                                            
                                                                                    }
                                                                            }                                                                            
                                                                        }                                                                                                       
                                        $param['tabla'].="</td>"                                                                                               
                                                . "<td>&nbsp;&nbsp;&nbsp;"
                                                .       "<input type='radio' id='".$aux."' name='radios[].".$count1."' value='1'>Sí&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                                .       "<input type='radio' id='".$aux."' name='radios[].".$count1."' value='0'>No"
                                                .       "<input type='hidden' value='".$aux."' name='radio[]'/>"
                                                . "</td>"
                                                . "<td><input type='submit' class='btn btn-primary' name='seleccionar' id='seleccionar' value='Seleccionar'>"
                                                . "</td>"
                                                . "</tr>                                                                                         
                                          </form>";
                                        $count ++;   
                                        $count1 ++;
                                    }
                            }                                                                          
                        $param['tabla'].="</table> ";
                        $url = form_close();
                        $this->load->view('entrevista_d/InformeED_v',$param);                         
                    }
                }
    }
    
   //********************Función que muestra los horarios de los psicólogos**************
//    public function horario()
//    {
//        echo "<center>
//                                        <div id='sortableTable' class='body collapse in'>
//                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid' border='1' id='tabla1'>
//                                            <thead>
//                                            <tr>                                                                                                
//                                                <th class='tablesorter-header tablesorter-headerAsc'>
//                                                    <div class='tablesorter-header-inner'>
//                                                        NO.
//                                                    </div>
//                                                </th>
//                                                <th class='tablesorter-header tablesorter-headerAsc'>
//                                                    <div class='tablesorter-header-inner'>
//                                                        FACILITADOR
//                                                    </div>
//                                                </th>
//                                                <th class='tablesorter-header tablesorter-headerAsc'>
//                                                    <div class='tablesorter-header-inner'>
//                                                        HORARIOS DISPONIBLES
//                                                    </div>
//                                                </th>
//                                                <th class='tablesorter-header tablesorter-headerAsc'>
//                                                    <div class='tablesorter-header-inner'>
//                                                    INFORME
//                                                    </div>
//                                                </th>
//                                            </tr>
//                                            </thead>";
//        //$mostrar = $this->input->post('seleccionar');
//        //echo "sdasdasdasdads".$mostrar;
//        //$url = (base_url().'index.php/entrevista_d/InformeED_c/generarInf');
//        $arreglo = $this->InformeED_m->psico();
//        $count= 1;
//        while($row = oci_fetch_array($arreglo,OCI_ASSOC))
//        {
//            $rc = $row['MFRC'];
//            oci_execute($rc);
//            while(($data = oci_fetch_array($rc,OCI_ASSOC)))
//            {
//                echo "
//                                                            <tr>                                                            
//                                                            <th >&nbsp;&nbsp;&nbsp;".$count."</th>
//                                                            <td >&nbsp;&nbsp;&nbsp;".$data['NOMBRE']."</td>                                                            
//                                                            <td></td>
//                                                            ";
//            }                             
//        }
//        echo "<td rowspan='6'>
//                <input type='submit' class='btn btn-primary' name='generar' id='generar' value='Generar'>
//              </td>
//              </tr>";
//    }
    
    public function generarInf()
    {    
        $radiocheck = $this->input->post('radios');//Determina si el valor del radio button es "Sí" o "No"
        $idsol = $this->input->post('radio');//Input hidden para cachar el valor del id de la solicitud           
        $dia=date("j",time());
        $mes= date("m", time());                            
        $anio= date("Y", time());
        $folio = $data['FOLIO'] = $this->input->post('folio');
        $fac = $data4['NOMBRE'] = $this->input->post('fac');    
        // 1 = "Sí" ------ 0 = ="No"
        if (isset($radiocheck[0]))//Si se ha seleccionado "Sí" o "No" 
        {            
//                echo "Valor----> ".$radiocheck[0]; echo br(1);
//                echo "idsol----> ".$idsol[0];  echo br(1);
//                echo "folio----> ".$fac = $this->input->post('folio'); echo br(1);
//                echo "facilitador---> ".$fol= $this->input->post('fac'); echo br(1);                
//                
                if ($radiocheck[0] == 1)
                {        
                    $datos['idsol'] = $idsol[0];
                    $datos['estatus'] = 14;
                    $vavalida = $this->InformeED_m->actualiza($datos);
                    
                        //*******Genera el Informe***********
                    $templateWord = new TemplateProcessor('plantillas/FORMATO 10.docx');

                    // --- Asignamos valores a la plantilla
                    $templateWord->setValue('dia',$dia);		
                    $templateWord->setValue('mes',$mes);		
                    $templateWord->setValue('anio',$anio);
                    $templateWord->setValue('folio',$folio);
                    $templateWord->setValue('fac',$fac);		

                    // --- Guardamos el documento
                    $templateWord->saveAs('Informe de Entrevista Diagostica.docx');

                    header("Content-Disposition: attachment; filename=Informe de Entrevista Diagostica.docx; charset=iso-8859-1");
                    echo file_get_contents('Informe de Entrevista Diagostica.docx');
                }    
                elseif($radiocheck[0] == 0)        
                {
                    $datos['idsol'] = $idsol[0];
                    $datos['estatus'] = 15;
                    $vavalida = $this->InformeED_m->actualiza($datos);
                    
                    $url = (base_url().'index.php/entrevista_d/InformeED_c/horario');
                    //*******Genera el Informe***********
                    $templateWord = new TemplateProcessor('plantillas/FORMATO 9.docx"');
                    
                    // --- Asignamos valores a la plantilla
                    $templateWord->setValue('dia',$dia);		
                    $templateWord->setValue('mes',$mes);		
                    $templateWord->setValue('anio',$anio);
                    $templateWord->setValue('folio',$folio);
                    $templateWord->setValue('fac',$fac);		

                    // --- Guardamos el documento
                    $templateWord->saveAs('Informe de Recomendacion.docx');

                    header("Content-Disposition: attachment; filename=Informe de Recomendacion.docx; charset=iso-8859-1");
                    echo file_get_contents('Informe de Recomendacion.docx');
                }  
            
        }
        else //Si no se ha seleccionado "Sí" o "No" muestra modal
            {
                $datos=array('subtitulo'=>'<br>No se ha seleccionado ninguna solicitud.<br>',
                                                                             'mensaje'=>'Por favor seleccione si la familia es candidata o no para poder continuar.',
                                                                              'onclick'=>'CierraError();');
                $this->load->view('Modales/error',$datos);                                                            
                $this->load->view('entrevista_d/InformeED_v'); 
            }  
    }

}

?>