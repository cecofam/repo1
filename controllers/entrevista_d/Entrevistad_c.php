<?php
//se modifico el tipo de juicio en la consulta de la solicitudes, verificar
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
//
//require_once 'phpword/src/PhpWord/Autoloader.php';
//\PhpOffice\PhpWord\Autoloader::register();
//use PhpOffice\PhpWord\Autoloader;
//use PhpOffice\PhpWord\Settings;
//use PhpOffice\PhpWord\TemplateProcessor;


if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Entrevistad_c extends CI_Controller{
    
    function __construct() 
    {
        parent::__construct();
    //$param['tabla']="";        
        //fac['tablahorario']="";
        $this->load->model('entrevista_d/Entrevistad_model');
        //$this->facilitador();
    }
     public function index()
    {
        $fac['tablahorario']="";
        $param['tabla']="";
        //$datos['tablahorario']=$fac;
        //$datos['tabla']=$param;        
        $this->load->view('entrevista_d/Entrevista_view',$param);
        //$this->load->view('entrevista_d/Entrevista_view',$fac);
    } 
    public function Buscar_sol()
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
            $datos['estatus']=7;
            $datos['folio'] = $this->input->post('folio');
            $datos['annio_folio'] = $this->input->post('annio_folio');
            $datos['oficio']= $this->input->post('oficio');
            $datos['expediente']= $this->input->post('expediente'); 
            $datos['annio_exp'] = $this->input->post('annio_exp');
            $datos['toca'] = $this->input->post('toca');
            $datos['tipjui']=NULL;//$this->input->post('tipjuc');
            
            list($varegper,$cursor) = $this->Entrevistad_model->Buscar_sol($datos);
            if($varegper==1)
            {
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
                    $url =base_url().'index.php/entrevista_d/Entrevistad_c/asignarED';
                    $param['tabla'].="<tr>
                        <form action='$url' method ='post' enctype='multipart/form-data'>
                        <td>".$incr."<br>"."<input type='hidden' value='".$data['ID_SOL']."' name='id_sol' id='id_sol'></td>".
                        "<td>&nbsp;&nbsp;&nbsp;$data[1]</td>".
                        "<td>".$data['FOLIO']."<br>"."<input type='hidden' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'>"
                            ."<input type='hidden' name='totchper' id='totchper' value='1'></td><td>";
  //************************************WHILE TIP JUI************************************************                 
                        $cursor3 = $this->Entrevistad_model->Busjuiciosol($aux);
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
                        $cursor2 = $this->Entrevistad_model->Buspers($aux);
                        while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
                        {
                                $rc = $row['MFRC'];
                                oci_execute($rc);
                                while(($data2 = oci_fetch_array($rc,OCI_ASSOC)))
                              {
                                    $per=$data2['IDTIP'];
                                    
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
                                        $param['tabla'].="<tr><th>".$tip_per.":&nbsp;&nbsp;</th><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nomH' id='nomH' value='".$data2['NOMBRE']."'>"
                                               ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                ."<input type='hidden' name='nom3[]' id='nom3[]' value='".$data2['NOMBRE']."'>"
                                               . "<input type='hidden' name='idper3[]' id='idper3[]' value='".$data2['IDPER']."'></td></tr>";    
                                    }//end if (3)
//                                                                     
                                    if ($per == 5){
                                        $datos['sol']    =$aux;
                                        $datos['persona']=$data2['IDPER'];
                                        $reg_ED="";

                                        if($reg_ED==1){
                                            $inp="<input class='uniform' type='checkbox' value='".$data2['IDPER']."' name='check1' id='check1' checked disabled>";
                                        }else{
                                            $inp="<input class='uniform' type='checkbox' value='".$data2['IDPER']."' name='check1' id='check1'>";
                                        }
                                        $param['tabla'].="<tr><th>".$tip_per.":&nbsp;</th><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nomA' id='nomA' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipper".$data2['IDPER']."' id='tipper".$data2['IDPER']."' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         ."<input type='hidden' name='nom".$data2['IDPER']."' id='nom".$data2['IDPER']."' value='".$data2['NOMBRE']."'>"
                                                         ."<td>&nbsp;".$inp."</td><td>&nbsp;</td></tr>";
                                    }//end if (5)
                                    if($per == 6){
                                        $datos['sol']    =$aux;
                                        $datos['persona']=$data2['IDPER'];
                                        $reg_ED="";

                                        if($reg_ED==1){
                                            $inp="<input class='uniform' type='checkbox' value='".$data2['IDPER']."' name='check' id='check' checked disabled>";
                                        }else{
                                            $inp="<input class='uniform' type='checkbox' value='".$data2['IDPER']."' name='check' id='check'>";
                                        }
                                        $param['tabla'].="<tr><th>".$tip_per.":&nbsp;</th><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nomD' id='nomD' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipper".$data2['IDPER']."' id='tipper".$data2['IDPER']."' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         ."<input type='hidden' name='nom".$data2['IDPER']."' id='nom".$data2['IDPER']."' value='".$data2['NOMBRE']."'>"
                                                         ."<td>&nbsp;".$inp."</td><td>&nbsp;</td></tr>";
                                    }//end if (6)
                              }//end while $data2
                            }//end while $row
                        }
            //********************************************BOTONES****************************************                           
                    $param['tabla'].="</table><td>"
                            ."<center><br><input type='submit' class='btn btn-primary' id='aceptar' name='aceptar' value='Asignar'/></center></td></tr></form>";
                   }
            $param['tabla'].="</table>     
                             </div>";                    
                    $this->load->view('entrevista_d/Entrevista_view',$param);
            }
            else
            {
                //en caso de nos exitosa la consulta
                $this->index();
                $this->load->view('Modales/modalError');
            }
        }
   
}
    public function asignarED()
    {                  
        $idpersona = $this->input->post('check');         
        $idsol = $this->input->post('id_sol');
        $folio = $this->input->post('FOLIO');
        $datos['tipper'] = $this->input->post('tipper'.$idpersona);
        $nomparte = $this->input->post('nom'.$idpersona);
        $nom3=$this->input->post('nom3');
        $tam_nom3=sizeof($nom3);
        $totchper= $tam_nom3+1;
        $idper3=$this->input->post('idper3');
        
        if($datos['tipper']=="Custodio"){
            $datos['tab_nino']="<table>"
                                 . "<tr>"
                                 . "<th>Niño, niñas o Adolecentes</th>"
                                 . "</tr>";
            
            for($i=0;$i<=$tam_nom3-1;$i++){
                $datos['tab_nino'].="<tr><td>".$nom3[$i]."<input type='text' name='idN[]' value='".$idper3[$i]."'>"
                                    ."<input type='text' name='totnin' value='".$tam_nom3."'></td></tr>";
            }                     
            
            $datos['tab_nino'].="</table>";
        }else{
            $datos['tab_nino']="";
        }
        
//        echo "idpersona--->".$idpersona;echo br(1);
//        echo "idsol--->".$idsol;echo br(1);                                                
//        echo "tipper--->".$datos['tipper'];echo br(1);   
//        echo "tot--->".$tam_nom3;echo br(1);   
//        
        if($idpersona == NULL)
        {
                $mensaje=array('subtitulo'=>'',
                               'mensaje'=>'Selecione a una persona '
                               .'para asignar la fecha de la Entrevista Diagnóstica',
                               'onclick'=>'CierraError();');                     
                $this->index();
                $this->load->view('Modales/error',$mensaje);
        }else{
          list($valor,$fecsugED) = $this->Entrevistad_model->fechaPcita($idpersona);
          
          if($valor==1){
               $datos['fec_ED']=$fecsugED;
//              echo "FECHA--->".$fecsugED."<br>";
               $cursor = $this->Entrevistad_model->facDia($datos['fec_ED']);
               $countchek=1;
               $datos['tabla_fa']="<table border='1'>";
               while(($row = oci_fetch_array($cursor,OCI_ASSOC)))
               {
                   $rc = $row['MFRC'];
                   oci_execute($rc);
                   while(($data = oci_fetch_array($rc,OCI_ASSOC)))
                   {
                       $datos['nom']=$nomparte;/*Para pintar el nombre de la parte dentro de la solicitud*/
                       $datos['tabla_fa'].="<tr><th colspan='2'><br>".$data['NOMBRE']."</th></tr>";
//                       echo "psicologo--->".$data['NOMBRE']."<br>";
//                       echo "id_ps--->".$data['IDPS']."<br>";
//                       echo "tot-->".$tam_nom3."<br>";
//                       echo "totchper-->".$totchper."<br>";
                       
                       $cursor1 = $this->Entrevistad_model->horariosed($data['IDPS'],$data['NOMBRE']);
                       while(($row1 = oci_fetch_array($cursor1,OCI_ASSOC)))
                       {
                           $rc1 = $row1['MFRC'];
                            oci_execute($rc1);
                            while(($data1 = oci_fetch_array($rc1,OCI_ASSOC)))
                            {
                                  $datos['tabla_fa'].="<tr><td>".$data1['HORA_INI']." - ".$data1['HORA_FIN']."</td>";
                                if($countchek <= $totchper){
//                                    echo "tot-->".$tam_nom3."<br>";
                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['ID_HORARIO']."' name='check[]' checked>"
                                                        ."</td>";
                                }else{
                                    $datos['tabla_fa'].="<td><input class='uniform' type='checkbox' value='".$data1['ID_HORARIO']."' name='check[]'>"
                                                        ."</td>";
                                }
//                                                    
                                 $datos['tabla_fa'].="<input type='hidden' name='idsol' id='idsol' value='".$idsol."'>
                                                    <input type='hidden' name='idper' id='idper' value='".$idpersona."'>
                                                    <input type='hidden' name='fac' id='fac' value='".$data['IDPS']."'>
                                                    <input type='hidden' name='totchper' id='totchper' value='".$totchper."'>    
                                                    <input type='hidden' name='folio' id='folio' value='".$folio."'>
                                                    <input type='hidden' name='tipper' id='tipper' value='".$datos['tipper']."'>
                                                    <input type='hidden' name='nomparte' id='nomparte' value='".$datos['nom']."'>
                                                    <input type='hidden' name='nomfac' id='nomfac' value='".$data['NOMBRE']."'></td></tr>";
//                                echo "hora_ini--->".$data1['HORA_INI']."<br>";
//                                echo "hora_fin--->".$data1['HORA_FIN']."<br>";
                                 $countchek++;
                            }
                       }
                    }
                    
               }    
               
               $datos['tabla_fa'].="</table><br><br><table><tr><td><div class='row form-group'>
                                        <div class='col-lg-3'>
                                            <button type='submit' class='btn btn-primary' id='BtnAsignar' name='BtnAsignar'>Asignar</button>
                                        </div>    
                                   </div></td></tr>
                                    </table>";
               
               $this->load->view('entrevista_d/Fac_Horarios_v',$datos);                          
          }else{
              $mensaje=array('subtitulo'=>'',
                               'mensaje'=>'No cuenta con asignacion'
                               .'para Primera Cita',
                               'onclick'=>'CierraError();');                     
                $this->index();
                $this->load->view('Modales/error',$mensaje);
          }
        }          
    }
    public function registro()
    {  
        $totper= $this->input->post('totchper');
        $estatus=11;//manejaremos estatus 11 antes 2
        $fecha = $this->input->post('fecha_ed');
        $datos['idsol'] = $this->input->post('idsol');
        $datos['idper'] = $this->input->post('idper');
        $folio=$this->input->post('folio');
        $fechaActual = date('j/m/Y');
        $persona= $this->input->post('fac');
        $valchek= $this->input->post('check');
        $idNin= $this->input->post('idN');
        $tam_idni=sizeof($idNin);
        $tipper= $this->input->post('tipper');
        $datos['idUser']= $this->session->idUser;
        $nomparte= $this->input->post('nomparte');
        $nomfac= $this->input->post('nomfac');
        
//        $chek=$this->input->post('check');
//        
//        print_r($chek);  
        
        
        if($tipper=="Custodio"){
            $formato="FORMATO 2";
        }else{
            $formato="FORMATO 3";
        }
        
        
//        echo "tam_idni --->".$tam_idni."<br>";
//        
//        for($i=0;$i<=$totper-1;$i++){
//            echo "valor_chek--->".$valchek[$i]."<br>";
//        }
//        for($j=0;$j<=$tam_idni-1;$j++){
//            echo "valor_idNin--->".$idNin[$j]."<br>";
//        }
      
        echo "idniño--->".$idNin[$i]."<br>";
        echo "fecha --->".$fecha."<br>";
        echo "idsol --->".$datos['idsol']."<br>";
//        echo "id_hor --->".$id_hor."<br>";
        echo "idper --->".$datos['idper']."<br>";
        echo "folio --->".$folio."<br>";
        echo "fechaActual --->".$fechaActual."<br>";
        echo "persona --->".$persona."<br>";
        echo "totper --->".$totper."<br>";
        echo "tipper --->".$tipper."<br>";
        echo "nomfac --->".$nomfac."<br>";
        
        
        
        $auxfolio=$folio;
//        $auxp=$datos['idper'];
//        $vavalida = $this->Entrevistad_model->registro($datos); 
        $vavalida=1;
//        if($vavalida == 1)
//        {
//            $data=array('mensaje'=>'Su re$fechagistro se ha completado de forma correcta',
//                        'url'=>'index.php/entrevista_d/Entrevistad_c');
//           // $this->wordEDCustodio($fecha);
//            $this->wordEDConviviente($fecha,$nomparte,$fechaActual,$auxfolio,$nomfac,$formato);
//            $this->index();//load->view('entrevista_d/Entrevistad_view');
//            $this->load->view('Modales/modalCorrecto',$data);
//            //$this->load->view('entrevista_d/Entrevistad_view');
//        }
//        
        
    }
    public function wordEDConviviente($fecha,$nomparte,$fechaActual,$auxfolio,$nomfac,$formato)
    {
        $templateWord = new TemplateProcessor('plantillas/FORMATO 2.docx');

                // ---Declaramos las variables a reemplazar 
                //$fecha=$this->input->post('fecha');
		// --- Asignamos valores a la plantilla
                $templateWord->setValue('fecha',$fecha);		
                $templateWord->setValue('facilitador',$nomfac);		
                $templateWord->setValue('persona',$nomparte);		
		$templateWord->setValue('reg',$auxfolio);
                $templateWord->setValue('fecact',$fechaActual);

		// --- Guardamos el documento
		$templateWord->saveAs('Entrevista Diagostica (Conviviente).docx');

		header("Content-Disposition: attachment; filename=Entrevista Diagostica (Conviviente).docx; charset=iso-8859-1");
		echo file_get_contents('Entrevista Diagostica (Conviviente).docx');
                
                return;
    }
    
}



