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
    Class Primer_enc_c extends CI_Controller
 {    
       function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->model('Primer_enc/Primer_enc_m');        
    }    
    public function index(){
        $param['tabla']="";
        $this->load->view('Primer_enc/Primer_enc_v',$param);
    } 
    public function imprimir()
    {
        $this->form_validation->set_rules('folio','folio','alpha_numeric|xss_clean');
        $this->form_validation->set_rules('annio_folio','annio_folio','numeric|xss_clean');
        $this->form_validation->set_rules('oficio','oficio','alpha_numeric|xss_clean');
        $this->form_validation->set_rules('expediente','expediente','alpha_numeric|xss_clean');
        $this->form_validation->set_rules('annio_exp','annio_exp','numeric|xss_clean');
        $this->form_validation->set_rules('toca','toca','alpha_numeric|xss_clean');       
        if($this->form_validation->run() == FALSE){ //si no se cumplio una regla, muestra la pantalla, y ejecuta la 
//          //la vista que contiene la ventana modal
            $this->index();
            $this->load->view('Modales/modalError');
        }
        else
        {            
            $datos['estatus']=16;  //ESTATUS PRIMER ENCUENTRO PARA PRUEBAS 1234 (JAIME AGURRE ORTIZ)  
            $datos['folio'] = $this->input->post('folio');
            $datos['annio_folio'] = $this->input->post('annio_folio');
            $datos['oficio']= $this->input->post('oficio');
            $datos['expediente']= $this->input->post('expediente'); 
            $datos['annio_exp'] = $this->input->post('annio_exp');
            $datos['toca'] = $this->input->post('toca');
            $datos['tipjui']=NULL;//$this->input->post('tipjuc');            
            list($varegper,$cursor) = $this->Primer_enc_m->Buscar_sol($datos);
            if($varegper==1)
            {
                    $param['tabla'] ="<center> <br> <br>
                                       <div id='sortableTable' class='body collapse in'> 
                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid'>
                                               <thead>
                                            <tr>                                               
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Registro
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
                                                        Persona
                                                    </div>
                                               </th>       
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Registrar
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
                    $url =base_url().'index.php/Primer_enc/Primer_enc_c/asignarED'; 
                    $param['tabla'].="<tr>"
                        ."<form action='$url' method ='post' enctype='multipart/form-data'>"                        
                        ."<td>".$data['FOLIO']."<input type='hidden' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'>"
                        ."<input type='hidden' name='totchper' id='totchper' value='1'>"
                        . "<input type='hidden' value='".$data['ID_SOL']."' name='id_sol' id='id_sol'></td>"
                        ."<td>".$data['EXPEDIENTE']."<input type='hidden' value='".$data['EXPEDIENTE']."' name='exp' id='exp'></td><td>";
  //************************************WHILE TIP JUI************************************************                 
                        $cursor3 = $this->Primer_enc_m->tipJui($aux);
                    while(($row = oci_fetch_array($cursor3,OCI_ASSOC)))
                {
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                        while(($data = oci_fetch_array($rc,OCI_ASSOC)))
                    {                                                                               
                             $param['tabla'].="*".$data['DES']."<br>";
                       } 
                   }
                        $param['tabla'].="</td><td><table>";    
                        $incr++;   
                        $vaaux=0;
                        $cursor2 = $this->Primer_enc_m->Buspers($aux);
                        while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
                        {
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                                while(($data2 = oci_fetch_array($rc,OCI_ASSOC)))
                              {
                                    $per=$data2['IDTIP'];
                                    $param['nombre']=$data2['NOMBRE'];
                                    
                                    if(isset($data2['IDCUST'])){
                                        $cus=$data2['IDCUST'];
                                    }else{
                                        $cus=0;
                                    }
                                    
                                    if($cus==1){
                                       $tip_per="Custodio";
                                    }else{
                                        $tip_per="Conviviente"; 
                                    }
                                    if($per==3){
                                        $tip_per="Niño(a) o Adolecente";
                                    }
                                    
                                    if($per == 3){
                                    $param['tabla'].="<tr><th>".$tip_per.":&nbsp;&nbsp;</th><td>".$data2['NOMBRE']."<br>"
                                               ."<input type='hidden' name='nomH' id='nomH' value='".$data2['NOMBRE']."'>"
                                               ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                               ."<input type='hidden' name='tipperH' id='tipperH' value='".$tip_per."'>"
                                               . "<input type='hidden' name='idper[]' id='idper[]' value='".$data2['IDPER']."'></td></tr>";    
                                    }//end if (3)
                                                                     
                                    if ($per == 5){
                                        $datos['sol']    =$aux;
                                        $datos['persona']=$data2['IDPER'];
                                        
                                        $param['tabla'].="<tr><th>".$tip_per.":&nbsp;</th><td>".$data2['NOMBRE']."<br>"
                                                         ."<input type='hidden' name='nomA' id='nomA' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipperA' id='tipperA' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         ."<input type='hidden' name='nom' id='nom' value=''></td></tr>"; 
                                    }//end if (5)
                                    if($per == 6){
                                        $datos['sol']    =$aux;
                                        $datos['persona']=$data2['IDPER'];
                                        
                                        $param['tabla'].="<tr><th>".$tip_per.":&nbsp;</th><td>".$data2['NOMBRE']."<br>"
                                                         ."<input type='hidden' name='nomD' id='nomD' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipperD' id='tipperD' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         ."<input type='hidden' name='nom' id='nom' value=''></td></tr>";                                       
                                    }//end if (6)
                              }//end while $data2
                            }//end while $row
                        
            //********************************************BOTONES****************************************
            $param['tabla'].="</table><td>"
                            ."<center><br>"
                            . "<input type='submit' class='btn btn-primary' id='aceptar' name='aceptar' value='Reprogramar'/>"
                            . "</center>"
                            . "</td></tr></form>";
                            }
            }
            $param['tabla'].="</table>     
                             </div>";                    
                    $this->load->view('Primer_enc/Primer_enc_v',$param);

            }
            else
            {
                //en caso de no sea exitosa la consulta
                $this->index();
                $this->load->view('Modales/modalError');
            }
        }   
}        
   public function registro()//funcion para llenar modal / cambiar estatus
  {             
        $totper= $this->input->post('totchper');
        $estatus=16; //solo para pruebas documento
        $fecha = $this->input->post('fecha_ed');
        $datos['idsol'] = $this->input->post('idsol');
        $datos['idper'] = $this->input->post('idper');
        $folio=$this->input->post('folio');
        $fechaActual = date('j/m/Y');
        $persona= $this->input->post('fac');
        $valchek= $this->input->post('check');
        $idNin= $this->input->post('idN');
        $tipper= $this->input->post('tipper');
        $datos['idUser']= $this->session->idUser;
        $nomparte= $this->input->post('nomparte');
        $nomfac= $this->input->post('nomfac');
//        
        $vavalida = $this->Primer_enc_m->regisInasistencia($datos);
//        $vavalida = $this->Primer_enc_m->registro($datos); 
        $vavalida=1;  
        if($vavalida == 1){
                $datos['idsol'] = $datos['idsol'];
                $datos['estatus'] = 16; //solo para pruebas documento
                $vavalida = $this->Primer_enc_m->actualiza($datos); 
        

        $data=array('mensaje'   => '<center>Se ha registrado la nueva cita corectamente<br/><br/></center>'
                    ,'solicitud' => $datos['idsol']
                    ,'url'       => 'index.php/Primer_enc/Primer_enc_c'
                    ,'facilitador'=>''
//                    ,'onclick'   => '');        
                    
                    ,'onclick'   => 'wordInasistencia()'); //para word
                    $this->wordInasistencia($fecha,$nomparte,$fechaActual,$nomfac);

                  $this->load->view('Modales/modalCorrecto',$data); 
                  $param['tabla']="";
                  $this->load->view('Primer_enc/Primer_enc_v',$param);  
        }else{
           $data = array( 'subtitulo' => 'Error: Ocurrio un problema al registrado la primera cita'
                                      ,'mensaje'   => 'Por favor revise e intente nuevamente'
                                      ,'url'       => 'index.php/Primer_enc/'
                                      ,'onclick'   => 'CierraError()');  
                                   $param['tabla']="";
                                   $this->load->view('Primer_enc/Primer_enc_v',$param);   
                                   $this->load->view('footer'); 
                                   $this->load->view('Modales/error',$data);
        }         
    }
    public function asignarED()
    {   
        $usuario=1;
        $idpersona="";
        $hijos="";
        $idpersona.= $this->input->post('check');//Traía el valor del Checkbox         
        $idsol = $this->input->post('id_sol');//Recoge el valor de la solicitud
        $folio = $this->input->post('FOLIO');//Recoge el valor del registro.
        $exp = $this->input->post('exp');
        $datos['tipperH'] = $this->input->post('tipperH'); //Recoge el valor del tipo de persona.
        $datos['tipper'] = $this->input->post('tipper'); //Recoge el valor del tipo de persona.        
//        $nomA = $this->input->post('nomA');//Nombre del actor
//        $nomD = $this->input->post('nomD');//Nombre del demandado
//        $nomH = $this->input->post('nomH');//Nombre de los Hijos
        $idper3=$this->input->post('idper');//recogía valor del id persona de los niños
        $tam_nom3=sizeof($idper3);
        $totchper= $tam_nom3+1;   
        $aux = $idsol;
        $personas = $this->Primer_enc_m->Buspers($aux);
        while(($row = oci_fetch_array($personas,OCI_ASSOC))){
                  $rc = $row['MFRC'];
                  oci_execute($rc);
                  while(($pers = oci_fetch_array($rc,OCI_ASSOC))){
                        
                        $per=$pers['IDTIP'];
                        $datos['nombre']=$pers['NOMBRE'];

                        if(isset($pers['IDCUST'])){
                            $cus=$pers['IDCUST'];
                        }else{
                            $cus=0;
                        }

                        if($cus==1){if($per==5){
                              $custodio=$pers['NOMBRE'];      
                            }elseif($per==6){
                                $custodio=$pers['NOMBRE'];      
                            }
                        }else{if($per==5){
                              $conv=$pers['NOMBRE'];      
                            }elseif($per==6){
                                $conv=$pers['NOMBRE'];      
                            }
                        }
                        if($per == 3)
                        {
                            $hijos.=$pers['NOMBRE'].", ";
                        }
                  }
        }
                        
        echo "idper->".$idpersona."<br>";
        echo "idsol->".$idsol."<br>";
        echo "registro->".$folio."<br>";
        echo "custodio->".$custodio."<br>";
        echo "conv->".$conv."<br>";
        echo "hijos->".$hijos."<br>";
        
        
        
        
        
//        $datos['nom']= $nom3;                     
//        $datos['id_per']= $idpersona[0];        
//        $datos['tipper'] = $this->input->post('tip');
//        $datos['id_per']= $idpersona[0];
//        $tam = sizeof($nom3);
        
        $fechahoy = date("d").'/'.date("m").'/'.date("y");    
        
//      if($datos['tipper']=="Custodio"){
//            $datos['tab_nino']="<table>"
//                                 . "<tr>"
//                                 . "<th>".$nomparte."</th>"
//                                 . "<th>Niños o Adolecentes: </th>"
//                                 . "</tr>";
//            
//            for($i=0;$i<=$tam_nom3-1;$i++){
////                $datos['tab_nino'].="<tr><td>".$nom3[$i]."<input type='text' name='idN[]' value='".$idper3[$i]."'>"
////                                    ."<input type='text' name='totnin' value='".$tam_nom3."'></td></tr
//               $datos['tab_nino'].="<tr><td>".$nom3[$i]."</td></tr>"; //muestra el nombre de los menores                     
//            }                                 
//            $datos['tab_nino'].="</table>"; //datos del menor en la tabla
//        }else{
//            $datos['tab_nino']="";
//        }       
//                                                          
//        $cursorpsico = $this->Primer_enc_m->FACILITADOR1($idsol);
//        while($data = oci_fetch_array($cursorpsico))
//        {
//          $id_psicologo = $data['ID_PSICOLOGO']; 
//        }
//        if (!empty($id_psicologo)){
//              list($fecha_programada,$valida) = $this->Primer_enc_m->SieteDiasPsico($idsol, $id_psicologo);
//        }else{
//           list($fecha_programada,$valida) = $this->Primer_enc_m->SieteDias();
//         }
//              if($valida==1){      
//                  $datos['fechaP'] = $fecha_programada;
//                  //agregammos la funcion que busca el id de psicologo en la tabla formatos_ed
//         //agrgar un if, si la solicitud  aparece en la tabla formatos_ed. FNPSICO_FORMATO              
//        if(!empty($id_psicologo)) {
//            
//               $cursor = $this->Primer_enc_m->facDia($datos['fechaP']);
//               $countchek=1;
//               $datos['tabla_fa']="<h4><th>Horarios de Facilitadores: </th></h4><table border='1'>";
//               while(($row = oci_fetch_array($cursor,OCI_ASSOC)))
//               {
//                   $rc = $row['MFRC'];
//                   oci_execute($rc);
//                   while(($data = oci_fetch_array($rc,OCI_ASSOC)))
//                   {
//                       if ($data['IDPS']==$id_psicologo){ //horario psicologos con id
//                       $datos['nom']=$nomparte;/*Para pintar el nombre de la parte dentro de la solicitud*/
//                       $datos['tabla_fa'].="<tr><th colspan='2'><br>".$data['NOMBRE']."---".$data['IDPS']."</th></tr>";
//                       $idps = $data['IDPS'];
//                       $cursor1 = $this->Primer_enc_m->psicope($idps); //para horarios de facilitadores primer encuentro
//                       while(($row1 = oci_fetch_array($cursor1,OCI_ASSOC)))
//                       {
//                           $rc1 = $row1['MFRC'];
//                            oci_execute($rc1);                                                        
//                            while(($data1 = oci_fetch_array($rc1,OCI_ASSOC)))
//                            {              
//                                
//                               $datos['tabla_fa'].="<tr><td>".$data1['HORA_INI']." - ".$data1['HORA_FIN']."</td>";
//                               if($countchek <= $totchper){
//                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['HORARIO']."' name='check[]' checked >"
//                                                        ."</td>";
//                                }else{
//                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['HORARIO']."' name='check[]'>"
//                                                        ."</td>";
//                                }
//                                $horaintervalo = $data1['HORA_INI']."-".$data1['HORA_FIN'];
//                                 $datos['tabla_fa'].="<input type='hidden' name='idsol' id='idsol' value='".$idsol."'>
//                                                    <input type='hidden' name='idper' id='idper' value='".$idpersona."'>
//                                                    <input type='hidden' name='fac' id='fac' value='".$data['IDPS']."'>
//                                                    <input type='hidden' name='totchper' id='totchper' value='".$totchper."'>    
//                                                    <input type='hidden' name='folio' id='folio' value='".$folio."'>
//                                                    <input type='hidden' name='tipper' id='tipper' value='".$datos['tipper']."'>
//                                                    <input type='hidden' name='nomparte' id='nomparte' value='".$datos['nom']."'>                                                       
//                                                    <input type='hidden' name='nomfac' id='nomfac' value='".$data['NOMBRE']."'></td></tr>";
//                                 $countchek++;
//                                 
//                                 
//                                }
//                       }
//                    }
//                 }                    
//               }                   
//               }else{ //horario psicologos sin id
//               $cursor = $this->Primer_enc_m->facDia($datos['fechaP']);
//               $countchek=1;
//               $datos['tabla_fa']="<h4><th>Horarios de Facilitadores: </th></h4><table border='1'>";
//               while(($row = oci_fetch_array($cursor,OCI_ASSOC)))
//               {
//                   $rc = $row['MFRC'];
//                   oci_execute($rc);
//                   while(($data = oci_fetch_array($rc,OCI_ASSOC)))
//                   {
//                       /*Para pintar el nombre de la parte dentro de la solicitud*/
//                       $datos['nom']=$nomparte;
//                       $datos['tabla_fa'].="<tr><th colspan='2'><br>".$data['NOMBRE']."</th></tr>";
//                       $idps = $data['IDPS'];
//                       $cursor1 = $this->Primer_enc_m->psicope($idps,$fecha_programada); //para horarios de facilitadores primer encuentro
//                       while(($row1 = oci_fetch_array($cursor1,OCI_ASSOC)))
//                       {
//                           $rc1 = $row1['MFRC'];
//                            oci_execute($rc1);                                                        
//                            while(($data1 = oci_fetch_array($rc1,OCI_ASSOC)))
//                            {                                
//                                $datos['tabla_fa'].="<tr><td>".$data1['HORA_INI']." - ".$data1['HORA_FIN']."</td>";
//                               if($countchek <= $totchper){
//                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['HORARIO']."' name='check[]' checked>"
//                                                        ."</td>";
//                                }else{
//                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['HORARIO']."' name='check[]'>"
//                                                        ."</td>";
//                                }
//                                $horaintervalo = $data1['HORA_INI']."-".$data1['HORA_FIN'];
//                                 $datos['tabla_fa'].="<input type='hidden' name='idsol' id='idsol' value='".$idsol."'>
//                                                    <input type='hidden' name='idper' id='idper' value='".$idpersona."'>
//                                                    <input type='hidden' name='fac' id='fac' value='".$data['IDPS']."'>
//                                                    <input type='hidden' name='totchper' id='totchper' value='".$totchper."'>    
//                                                    <input type='hidden' name='folio' id='folio' value='".$folio."'>
//                                                    <input type='hidden' name='tipper' id='tipper' value='".$datos['tipper']."'>
//                                                    <input type='hidden' name='nomparte' id='nomparte' value='".$datos['nom']."'>                                                       
//                                                    <input type='hidden' name='nomfac' id='nomfac' value='".$data['NOMBRE']."'></td></tr>";
//                                 $countchek++;
//                                 
//                            }
//                       }
//                    }
//                 }                    
//               }
//               
//               $datos['tabla_fa'].="</table><br><br><table><tr><td><div class='row form-group'>
//                                        <div class='col-lg-3'>
//                                            <button type='submit' name='btnasis' class='btn btn-primary' id='BtnAsignar' name='BtnAsignar'>Registrar</button>                                           
// 
//                                    </div></td></tr>
//                                    </table>";               
//           
//               $this->load->view('Primer_enc/Primer_v_reg',$datos);                          
//          }else{
//              $mensaje=array('subtitulo'=>'',
//                               'mensaje'=>'No cuenta con asignacion para reprogramar una nueva cita',
//                               'onclick'=>'CierraError();');                     
//                $this->index();
//                $this->load->view('Modales/error',$mensaje);
//                
//          }             
    }  

/***********************************************************************************************************************************************/
   
//    public function wordInasistencia()//genera oficio
//    {    
//        $Cleyenda=$this->Primer_enc_m->LEYENDA();
//            while($data = oci_fetch_array($Cleyenda)){
//                  $leyenda=  $data['LEYENDA'];
//            }
//        $aux='';
////            $id_solicitud = $this->input->post('id_soli');    
//        $Noficio = $this->input->post('oficio');
////        $data['nts'] =$id_solicitud;
//        $datos['Noficio'] =$Noficio; 
//        $datos['TOFICIO']='REPPE';        
//        $OFICIO  =$this->Primer_enc_m->OFICIO($datos); 
//        $PERSONAS =$this->Primer_enc_m->PERSONASPC($datos);   
//        $horario = $this->Primer_enc_m->psicope($aux);
//        $idsol =  $this->input->post('idsol');
//        $toca =  $this->input->post('toca');
//        $nueva_cita =  $this->input->post('nueva_cita');
//        $horario = $this->input->post('horario');
//        $nombre = $this->input->post('nombre');
//            
//            $datos['toca']=$toca;
////            $datos['expediente']=NULL;
//            $datos['oficio']=NULL;
//            $datos['folio']=NULL;
//            $datos['anioexp']=NULL;
//            $datos['aniofol']=NULL;
//            $datos['estatus']=16;
//            $datos['tipjui']=NULL;
//            
//            list($vasalida,$cursor)=$this->Primer_enc_m->BusPer($datos);
//            $cursor2 = $this->Primer_enc_m->tipJui($idsol);
//            $cursor3 = $this->Primer_enc_m->tipoPer($idsol);
//            $cursor4 = $this->Primer_enc_m->OFICIO($idsol);
//            $cursor5 = $this->Primer_enc_m->NUM_OFICIO();
//            while($data = oci_fetch_array($cursor))
//         {
//                $expediente = $data['EXPEDIENTE'];
//                $folio      = $data['FOLIO'];              
//            }            
//            while($data2 = oci_fetch_array($cursor4))
//         {
//                $oficio  = $data2['OFICIO'];
//                $foficio = $data2['FOFICIO'];
//                $juzgado = $data2['JUZGADO'];
//                $juez    = $data2['JUEZ'];
//                $secre   = $data2['TIPO'];
//            }            
//            while($row = oci_fetch_array($cursor2,OCI_ASSOC))
//                                    {
//                                        $rc = $row['MFRC'];
//                                        oci_execute($rc);
//                                        while($data2 = oci_fetch_array($rc,OCI_ASSOC))
//                                       {
//                                           $tipo_juicio = $data2['DES']; 
//                                       }
//                                    }
//                                    while($row = oci_fetch_array($cursor3,OCI_ASSOC))
//                                       {
//                                          $rc = $row['MFRC'];
//                                          oci_execute($rc);
//                                         while($data3 = oci_fetch_array($rc,OCI_ASSOC))
//                                            {   
//                                             $rol=$data3['IDTIP'];
//                                             if($rol == 5){
//                                                 $actor = $data3['NOMBRE'];
//                                             }
//                                             if($rol == 6){
//                                                 $demandado = $data3['NOMBRE'];
//                                             }
//                                            }
//                                       }                                      
////                                       echo "actor------->".$actor."<br>";
////                                       echo "demandado------->".$demandado."<br>";
////                                       echo "nombre oficio------->".$nombre."<br>";
////                                       echo "expediente------->".$expediente."<br>";
////                                       echo "nueva_cita------->".$nueva_cita."<br>";
////                                       echo "horario------->".$horario."<br>";
////                                       echo "folio------->".$folio."<br>";
////                                       echo "oficio------->".$oficio."<br>";
////                                       echo "fecha oficio------->".$foficio."<br>";
////                                       echo "juzgado------->".$juzgado."<br>";
////                                       echo "juez------->".$juez."<br>";
//                                       
//                    $dia=date("j",time());
//                    $mes_actual= date("m", time());
//
//                                //Obtener el dÃƒÂ­a en texto y no en nÃƒÂºmero
//                                $month ['mes']= $mes_actual;
//                                //echo "tt-->".$date_info['mes'];
//                                //Traducimos los meses de inglÃƒÂ©s a EspaÃƒÂ±ol
//                                switch ($month['mes']) { 
//                                    case "01" : $month['mes']="Enero";break; 
//                                    case "02" : $month['mes']="Febrero";break; 
//                                    case "03" : $month['mes']="Marzo";break; 
//                                    case "04" : $month['mes']="Abril";break; 
//                                    case "05" : $month['mes']="Mayo";break; 
//                                    case "06" : $month['mes']="Junio";break; 
//                                    case "07" : $month['mes']="Julio";break; 
//                                    case "08" : $month['mes']="Agosto";break; 
//                                    case "09" : $month['mes']="Septiembre";break; 
//                                    case "10" : $month['mes']="Octubre";break; 
//                                    case "11" : $month['mes']="Noviembre";break; 
//                                    case "12" : $month['mes']="Diciembre";break; 
//                                }; 
//                                $mes = $month['mes'];
//
//                    $anio= date("Y", time());
//                      $fecha = $dia."/".$mes."/".$anio;                     
//                      $datos2['TOFICIO']='INAED';
//                       while($datE = oci_fetch_array($cursor5)){
//                    $datos2['ANIO'] =$datE['ANIO']; 
//                  $datos2['NUMERO']=$datE['NUMERO'];  
//            }
//            $ANIO    = $datos2['ANIO'];
//            $NUMERO  = $datos2['NUMERO'];
//            $datos2['persona']='0';
//            $datos2['usuario']='1';
//            $datos2['idsol']=$idsol;
//        
//        $of_num = $NUMERO."/".$ANIO; 
////            $this->Primer_enc_m->GUARDA_OFICIO($datos2); //registramos nuevo oficio en la tabla 
//                      
//             $templateWord = new TemplateProcessor('plantillas/re_pcita.docx');
//             
//             
//              // --- Asignamos valores a la plantilla
//                    $templateWord->setValue('leyenda',$leyenda);
//                    $templateWord->setValue('persona1',$actor);
//                    $templateWord->setValue('persona2',$demandado);
//                    $templateWord->setValue('juicio',$tipo_juicio);
//                    $templateWord->setValue('expediente',$expediente);
//                    $templateWord->setValue('anioexp',$anioexp);
//                    $templateWord->setValue('secretaria',$secre);
//                    $templateWord->setValue('of_num',$of_num);
//                    $templateWord->setValue('folio', $folio);
//                    $templateWord->setValue('dia_actual',$dia_actual);
//                    $templateWord->setValue('mes_actual',$mes);
//                    $templateWord->setValue('anio_actual',$anio);                    
//                    $templateWord->setValue('juez',$juez);
//                    $templateWord->setValue('juzgado',$juzgado);
//                    $templateWord->setValue('oficio',$oficio);
//                    $templateWord->setValue('fecha_oficio',$foficio);
//                    $templateWord->setValue('horario',$horario);
//                  
//                    // --- Guardamos el documento
//                    $templateWord->saveAs('InasistenciaPE.docx');
//
//                    header("Content-Disposition: attachment; filename=InasistenciaPE.docx; charset=iso-8859-1");
//                    echo file_get_contents('InasistenciaPE.docx');
//
//        $param['tabla']="";
////        
//
//            $this->load->view('Primer_enc/Primer_enc_v',$param);
//                 
//    }
}