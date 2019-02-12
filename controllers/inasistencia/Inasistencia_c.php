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
    Class Inasistencia_c extends CI_Controller
 {
    
    function __construct() 
    {
        parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('inasistencia/Inasistencia_m');       
    }
     public function index()
    {
        $param['tabla']="";
        $this->load->view('inasistencia/Inasistencia_v',$param);
    } 
    
       public function imprimir(){
            $datos['toca']=$this->input->post('toca');
            $datos['expediente']=$this->input->post('expediente');
            $datos['oficio']=$this->input->post('oficio');
            $datos['folio']=$this->input->post('folio');
            $datos['anioexp']=$this->input->post('anioexp');
            $datos['aniofol']=$this->input->post('aniofol');
            $datos['estatus']=7;
            $datos['tipjui']=NULL;
            
            
            list($vasalida,$cursor)=$this->Inasistencia_m->BusPer($datos);            
            
            $param['tabla'] = "<center>
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
                                                        Juicio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Nombre
                                                    </div>
                                               </th>
                                               
                                               
                                                                                                                                            
                                            </tr>
                                            </thead>";
            $count =1;
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
                 $param['tabla'].="<br>
                                 <tr>                                                            
                                 <th >&nbsp;&nbsp;&nbsp;".$count."</th>
                                 <td >&nbsp;&nbsp;&nbsp;".$data['EXPEDIENTE']."</td>
                                 <td>";                                                                                                                        
                                 $aux=$data['ID_SOL'];                                                     
                                 $cursor2 = $this->Inasistencia_m->juicio($aux);//Se manda a llamar la función que busca el juicio 
                                 $cursor3 = $this->Inasistencia_m->tipoPer($aux);//Se manda a llamar la función que busca los nombres y tipo de persona    
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
                                    while($row = oci_fetch_array($cursor3,OCI_ASSOC))
                                       {
                                          $param['tabla'].="<td>";
                                          $rc = $row['MFRC'];
                                          oci_execute($rc);
                                         while($data3 = oci_fetch_array($rc,OCI_ASSOC))
                                            {   
                                               $aux2=$data3['IDTIP']; 
                                                  if (($aux2 == 5) || ($aux2 == 6))
                                                  {
                                                    $url = (base_url().'index.php/inasistencia/Inasistencia_c/RegistraI');
                                                    $param['tabla'].="<table>
                                                                   <tr>
                                                                   <td>
                                                                   ".$data3['NOMBRE'].":&nbsp;&nbsp;&nbsp; <th>".$data3['TIP_PER']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                                   </td>                                                                                                         
                                                                   <td>
                                                                   <form action='".$url."' method='post'>
                                                                   <input style=\"height:20px;width:40px\" type='checkbox' id='".$aux."' name='checkbox[]' value ='".$aux."'></td>
                                                                    </tr>
                                                                    </table>";                                                                            
                                                  }
                                                                            }                                                                            
                                                                        }      
                                        $url = (base_url().'index.php/inasistencia/Inasistencia_c/RegistraI');
                                        $param['tabla'].="</td>"."<form action='".$url."' method='post'>"
                                               
                                                                                                                                                                                               
                                                . "</tr>";
                                        $count ++;                                               
                                    }
                            }                                                                          
                        $param['tabla'].="</table>
                                          <br>                                                                    
                                                <input type='submit' class='btn btn-primary' id='turnar' name='turnar' value='Registrar Inasistencia'>                                                                       
                                          </form>";
                        $this->load->view('inasistencia/Inasistencia_v',$param); 
            
            
  }
  //detalle en insercion, inserta un campo extra :/
  public function RegistraI()
    {
        
      $usuario=1;
     $id_solicitud = $this->input->post('checkbox');
     $toca = $this->input->post('toca');
     
     
     $fechahoy = date("d").'/'.date("m").'/'.date("y"); 
     $datos['dias_habiles'] = 15;
     $datos['fecha_inicio'] = $fechahoy;
     
     
     
     $countA =0;   
     $countD =0;  
                $cursor2 = $this->Inasistencia_m->tipoPer($id_solicitud[0]);        
                        while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))   {
                               $rc = $row['MFRC'];
                               oci_execute($rc);
                           while(($data2 = oci_fetch_array($rc,OCI_ASSOC))) {
                                  $aux2=$data2['IDTIP']; 
                              
                                 if (($aux2 == 5)){
                                      $actor=$data2['IDPER']; 
                                      $countA ++; 
                                      
                                              list($fecha_fin,$valida) = $this->Inasistencia_m->consultaDias($datos); 
                                                   $param['fechaP']    = $fecha_fin;

                                                    $Dias               = $this->Inasistencia_m->verificaDias($param); 

                                                       if($Dias < 50){ 
                                                             // $datos['dias_habiles']++;

                                                           }
                                                           else{
                                                               $bandera = 0;

                                                               while($bandera == 0){
                                                                   $datos['dias_habiles']++; 

                                                                           list($fecha_fin,$valida) = $this->Inasistencia_m->consultaDias($datos); 
                                                                               $param['fechaP']     = $fecha_fin;            
                                                                               $Dias                = $this->Inasistencia_m->verificaDias($param); 


                                                                       if($Dias < 50){                       
                                                                          $datos['dias_habiles']++;
                                                                             $bandera = 1;

                                                                           }else{
                                                                             $bandera = 0;
                                                                                }
                                                                   }                        
                                                               }
                                                       $datos['fechaP']=$param['fechaP'];        
                                                       $HORA       = $this->Inasistencia_m->CUENTADIAS($datos); 

                                                           if(isset($HORA)===true){
                                                                 $HORA = $HORA;
                                                             }else{
                                                     //           $HORA = 25;
                                                                 $HORA = 0;}

                                                       //     $HORAACT=$HORA-24;
                                                              $HORAACT=$HORA+1;

                                                   $datos['id_sol']=$id_solicitud[0];        
                                                   $datos['id_pers'] =$actor;     
                                                   $datos['usuario'] =$usuario;
                                                   //$datos['ncita']=$fecha_fin;
                                                   //$datos['hora']=$HORAACT;
                                                  $vavalidaA   = $this->Inasistencia_m->regisInasistencia($datos);
                                       
                                   }  
                                   
                                 if (($aux2 == 6)) {
                                     $demandado=$data2['IDPER'];  
                                     $countD ++;
                                     
                                     list($fecha_fin,$valida) = $this->Inasistencia_m->consultaDias($datos); 
                                                   $param['fechaP']    = $fecha_fin;

                                                    $Dias               = $this->Inasistencia_m->verificaDias($param); 

                                                       if($Dias < 50){ 
                                                             // $datos['dias_habiles']++;

                                                           }
                                                           else{
                                                               $bandera = 0;

                                                               while($bandera == 0){
                                                                   $datos['dias_habiles']++; 

                                                                           list($fecha_fin,$valida) = $this->Inasistencia_m->consultaDias($datos); 
                                                                               $param['fechaP']     = $fecha_fin;            
                                                                               $Dias                = $this->Inasistencia_m->verificaDias($param); 


                                                                       if($Dias < 50){                       
                                                                          $datos['dias_habiles']++;
                                                                             $bandera = 1;

                                                                           }else{
                                                                             $bandera = 0;
                                                                                }
                                                                   }                        
                                                               }
                                                            $datos['fechaP']=$param['fechaP'];        
                                                            $HORA       = $this->Inasistencia_m->CUENTADIAS($datos); 

                                                           if(isset($HORA)===true){
                                                                 $HORA = $HORA;
                                                             }else{
                                                     //           $HORA = 25;
                                                                 $HORA = 0;}

                                                       //     $HORAACT=$HORA-24;
                                                              $HORADEM=$HORA+1;

                                                   $datos['id_sol']=$id_solicitud[0];        
                                                   $datos['id_pers'] =$demandado;     
                                                   $datos['usuario'] =$usuario;
                                                   //$datos['ncita']=$datos['fechaP'];
                                                   //$datos['hora']=$HORADEM;
                                                   $vavalidaD = $this->Inasistencia_m->regisInasistencia($datos);
                                     
                                   }  
                            }
                        }     
         $datos['toca']=    $toca;                

        if($vavalidaD == 1 || $vavalidaA == 1){

             $data=array('mensaje'   => '<center>Se ha registrado la inasistencia corectamente<br/><br/>¿Que desea hacer?<br/><br/></center> ',
                         'solicitud' => $datos['id_sol'],
                        'toca' => $datos['toca'],
                        'url'       => 'index.php/inasistencia/Inasistencia_c',
                        'facilitador'=>'');

                       $this->load->view('Modales/Correcto_ina',$data); 
                         $param['tabla']="";
                      $this->load->view('inasistencia/Inasistencia_v',$param);  
           }
           else{
            $data = array( 'subtitulo' => 'Error: Ocurrio un problema al registrado la primera cita'
                                       ,'mensaje'   => 'Por favor revise e intente nuevamente'
                                       ,'url'       => 'index.php/inasistencia/'
                                       ,'onclick'   => 'CierraError();');  

                                    $param['tabla']="";
                                    $this->load->view('inasistencia/Inasistencia_v',$param);   
                                    $this->load->view('footer'); 
                                    $this->load->view('Modales/error',$data);}
      
    }
    
    public function wordInasistencia()//oficio en fase de pruebas :)
    {
        
        $id_solicitud = $this->input->post('ID_SOL');
        $Noficio = $this->input->post('oficio');
        $data['toca'] = $this->input->post('toca');
        $data['nts'] =$id_solicitud;
        $datos['nts'] =$id_solicitud; 
        $datos['Noficio'] =$Noficio; 
        $datos['TOFICIO']='PC';
        $datos['persona']='0';
        $datos['usuario']='1';
        $aux =$id_solicitud;  
        list($vasalida,$cursor)=$this->Inasistencia_m->BusPer($datos); 
        $info    =$this->Inasistencia_m->consultaoficio($datos);  
        $OFICIO  =$this->Inasistencia_m->OFICIO($datos); 
        $PERSONAS =$this->Inasistencia_m->PERSONASPC($datos); 
        $cursor2 =$this->Inasistencia_m->tipoPer($id_solicitud);
        $cursor3 = $this->Inasistencia_m->tipoJuis($aux);
        $cursor4 = $this->Inasistencia_m->NUM_OFICIO();
        
  //      $VALIDA = $this->Inasistencia_m->REGITRO_OFICIO($datos);

                         while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))   {
                                   $rc = $row['MFRC'];
                                   oci_execute($rc);
                               while(($data2 = oci_fetch_array($rc,OCI_ASSOC))) {
                                      $aux2=$data2['IDTIP']; 
                                    if (($aux2 == 5)){
                                      $actor=$data2['NOMBRE']; }  

                                    if (($aux2 == 6)) {
                                      $demandado=$data2['NOMBRE']; }  
                                  }
                                } 
                         while(($rowa = oci_fetch_array($info,OCI_ASSOC)))   {
                                   $rca = $rowa['MFRC'];
                                   oci_execute($rca);
                               while(($data3 = oci_fetch_array($rca,OCI_ASSOC))) {
                                      $anioexp=$data3['ANIO_TOCA_EXPEDIENTE']; 
                                      $FeficioRec=$data3['FECHA_OFICIO_RECIBIDO'];                                       
                                      $anioexp=$data3['ANIO_TOCA_EXPEDIENTE']; 
                               }
                         }
       
                        while(($row = oci_fetch_array($cursor3,OCI_ASSOC))) {
                           $rcp = $row['MFRC'];
                           oci_execute($rcp);
                        while(($data22 = oci_fetch_array($rcp,OCI_ASSOC))) {
                                  $datos['DES']=$data22['DES']; 
                               
                                      
                                }    
                        }       
                  
        $datos['tabla']=$id_solicitud;

           while($data1 = oci_fetch_array($PERSONAS)){             
             $TIPO_PER  =  $data1['ID_TIPO_PERSONA'];
             IF($TIPO_PER=='5'){
             $NOMBREA    =  $data1['NOMBRE'];
             $FECHAA=  $data1['FECHA'];
             } ELSE IF($TIPO_PER=='6'){
             $NOMBRED    =  $data1['NOMBRE'];
             $FECHAD=  $data1['FECHA'];}
            }
            
             while($dataa = oci_fetch_array($OFICIO)){
             $EXPE    =  $dataa['EXPE'];
             $ANIOTE  =  $dataa['ANIOTE'];
             $RECEOFICIO=  $dataa['OFICIO'];
             $FOFICIO =  $dataa['FOFICIO'];
             $SECRE   =  $dataa['TIPO'];
             $JUZGADO =  $dataa['JUZGADO'];
             $JUEZ   =  $dataa['JUEZ'];
             
            }
            while($datE = oci_fetch_array($cursor4)){
                    $datos['ANIO'] =$datE['ANIO']; 
                  $datos['NUMERO']=$datE['NUMERO'];  
             
            }
            $ANIO    = $datos['ANIO'];
            $NUMERO  = $datos['NUMERO'];
                 $fin =$this->Inasistencia_m->GUARDA_OFICIO($datos);    

            $templateWord = new TemplateProcessor('plantillas/OFICIO 2.docx');

                    $actor = $actor;
                    $demandado =  $demandado;
                    $num_expediente = $EXPE;
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
                    $anioexp = $ANIOTE;
                    $folio = $datos['nts'];
                    $sec = $SECRE;
                    $tipo_juicio =$datos['DES'];
                    $oficio = $RECEOFICIO;
                    $f_oficio = $FOFICIO;
                    $persona1 = $actor;
                    $persona2 =$demandado;
                    $f_custodio = $FECHAA;
                    $f_ncustodio = $FECHAD;
                    $of_num = $NUMERO."/".$ANIO;
                    $f_reprog = date('j-m-Y');
                    $nuevafecha = strtotime ( '+15 day' , strtotime ( $f_reprog ) ) ;
                    $nuevafecha = date ( 'j-m-Y' , $nuevafecha );
                    $hora = "9:00 am a 2:00 pm";

                    // --- Asignamos valores a la plantilla
                $templateWord->setValue('actor',$actor);
                $templateWord->setValue('demandado',$demandado);
                $templateWord->setValue('expediente',$expediente);
                $templateWord->setValue('anioexp',$anioexp);
                $templateWord->setValue('secretaria', $sec);
                $templateWord->setValue('tipo_juicio', $tipo_juicio);
                $templateWord->setValue('folio', $folio);                   
                $templateWord->setValue('dia_actual',$dia_actual);
                $templateWord->setValue('mes_actual',$mes);
                $templateWord->setValue('anio_actual',$anio);
                $templateWord->setValue('oficio',$no_oficio);
                $templateWord->setValue('fecha_oficio',$fecha_oficio);                
                $templateWord->setValue('nocustodio',$actor);
                $templateWord->setValue('custodio',$demandado);                
                $templateWord->setValue('persona1',$persona1);
                $templateWord->setValue('persona2',$persona2);                
                $templateWord->setValue('fecha',$nuevafecha);
                $templateWord->setValue('horario',$hora);
                    // --- Guardamos el documento
                    $templateWord->saveAs('Inasistencia.docx');

                    header("Content-Disposition: attachment; filename=Inasistencia.docx; charset=iso-8859-1");
                    echo file_get_contents('Inasistencia.docx');

        $param['tabla']="";
//        

            $this->load->view('inasistencia/Inasistencia_v',$param);
    }        
}
