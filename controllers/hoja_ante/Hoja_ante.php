<?php

/*
 * DESCRIPCIÓN: cONTRTOLADOR QUE REALIZA EL LOGIBN DELA APLICACIÓN Y SE CRERAN LAS VARIABLES DE SESION
 * FECHA: 02 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hoja_ante extends CI_Controller {
    //contralador inicial, carga el login
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('hoja_ante/HojaAnte_m');
        $this->load->model('catalogos/Catalogos_m');
    }

    public function index(){
        $this-> load -> view('hoja_ante/hoja_ante_view');
    }
     public function buscaHoja() {
           
            $datos['toca']=$this->input->post('toca');
            $datos['expediente']=$this->input->post('expediente');
            $datos['oficio']=$this->input->post('oficio');
            $datos['folio']=$this->input->post('folio');
            $datos['anioexp']=$this->input->post('anioexp');
            $datos['aniofol']=$this->input->post('aniofol');
            $datos['estatus']=7;  //CAMBIO ESTATUS DE 1 A 11 YA QUE PARA ENTREVISTA DIAGNOSTICA EL 11 ES EL ESTATUS CORRECTO 1610
            $datos['tipjui']=NULL;
            
            list($vasalida,$cursor)=$this->HojaAnte_m->Recep($datos);
      
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
                    $url =base_url().'index.php/hoja_ante/Hoja_ante/Registro';
                    $param['tabla'].="<tr>
                        <form action='$url' method ='post' enctype='multipart/form-data'>
                        <td>".$incr."<br>"."<input type='hidden' value='".$data['ID_SOL']."' name='id_sol' id='id_sol'></td>".
                        "<td>&nbsp;&nbsp;&nbsp;$data[1]</td>".
                        "<td>".$data['FOLIO']."<br>"."<input type='hidden' name='FOLIO' id='FOLIO' value='".$data['FOLIO']."'></td><td>";
  //************************************WHILE TIP JUI************************************************                 
                        $cursor3 = $this->HojaAnte_m->tipJui($aux);
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
                        $cursor2 = $this->HojaAnte_m->tipoPer($aux);
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
                                    if ($per == 5){
                                        $param['tabla'].="<tr><td>".$tip_per.":&nbsp;</td><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nomA' id='nomA' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipA' id='tipA' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         . "<input type='hidden' name='idper' id='idper' value='".$data2['IDPER']."'></td>"
                                                         ."<td>&nbsp;<input class='uniform' type='checkbox' value='1' name='hja' id='hja'></td></tr>";    
                                    }//end if (5)
                                    if($per == 6){
                                        $param['tabla'].="<tr><td>".$tip_per.":&nbsp;</td><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nomD' id='nomD' value='".$data2['NOMBRE']."'>"
                                                         ."<input type='hidden' name='tipD' id='tipD' value='".$tip_per."'>"
                                                         ."<input type='hidden' name='id_sol' id='id_sol' value='".$aux."'>"
                                                         . "<input type='hidden' name='idper' id='idper' value='".$data2['IDPER']."'></td>"
                                                         ."<td>&nbsp;<input class='uniform' type='checkbox' value='1' name='hjd' id='hjd'></td></tr>";    
                                    }//end if (6)
                                    
                              }//end while $data2
                            }//end while $row
                        }
//********************************************BOTONES****************************************                           
                    $param['tabla'].="</table><td>"
                            ."<center><br><input type='submit' class='btn btn-primary' id='aceptar' name='aceptar' value='Registrar'/></center></td></tr></form>";
                   }
            $param['tabla'].="</table>";      
            $this->load->view('hoja_ante/hoja_ante_view',$param);       
  }
  
  public function Registro() {
     $datos['hja']   =$this->input->post('hja'); 
     $datos['hjd']   =$this->input->post('hjd'); 
     $datos['id_sol']=$this->input->post('id_sol');
     $datos['id_per']=$this->input->post('idper');
    
     
     if($datos['hja']==1){$datos['nom']=$this->input->post('tipA')." : ".$this->input->post('nomA');}
     if($datos['hjd']==1){$datos['nom']=$this->input->post('tipD')." : ".$this->input->post('nomD');}
     $datos['religion']   =$this->HojaAnte_m->religion();
     $datos['escolaridad']=$this->HojaAnte_m->escol();
     $datos['entidad']=$this->Catalogos_m->FunCat('PACONSULTAS','FNENTIDAD');
     
     $datos['tabla']="<table class='table responsive-table'>
                         <thead>   
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Fecha de nacimiento</th>
                            </tr>
                           </thead>
                           <tbody>";
     
     $cursor2 = $this->HojaAnte_m->tipoPer($datos['id_sol']);
     $count=0;
     while(($row = oci_fetch_array($cursor2,OCI_ASSOC)))
     {
                $rc = $row['MFRC'];
                oci_execute($rc);
                while(($data2 = oci_fetch_array($rc,OCI_ASSOC)))
              {
                    $per=$data2['IDTIP'];
                                        
                    if(isset($data2['FEC_NAC'])){
                        $anio_act=date('Y');
                        $mes_act =date('m');
                        $dia_act =date('d');
                        $anio_nac=explode("/",$data2['FEC_NAC']);
                        
                        
                        if($mes_act==$anio_nac[1]){
                            if(($dia_act==$anio_nac[0])||($dia_act>$anio_nac[0])){
                                $edad= ($anio_act-$anio_nac[2])." años";
                           }else{
                                $edad= $anio_act-$anio_nac[2];
                                $edad=($edad-1)." años";
                            }
                        }else if($mes_act>$anio_nac[1]){
                            $edad= ($anio_act-$anio_nac[2])." años";
                        }else{
                                $edad= $anio_act-$anio_nac[2];
                                $edad=($edad-1)." años";
                        }
                        
                        if($anio_act==$anio_nac[2]){
                            $edad=($mes_act-$anio_nac[1])." mes(es)";
                        }
                        
                     }
                    
                    
                    
                    
                    
                    if ($per == 3){
                        $datos['tabla'].="<tr><td>".$data2['NOMBRE']."<br>"."<input type='hidden' name='nom' id='nom' value='".$data2['NOMBRE']."'>"
                                         . "<input type='hidden' name='idper3' id='idper3' value='".$data2['IDPER']."'</td>"
                                         ."<td>".$edad."<br>"."<input type='hidden' name='edad' id='edad' value='".$edad."'></td>"
                                         ."<td>".$data2['FEC_NAC']."<br>"."<input type='hidden' name='fec_nac' id='fec_nac' value='".$data2['FEC_NAC']."'></td></tr>";
                        $count++;                 
                    }//end if (5)
                
              }//end while $data2
     }//end while $row
     
     
     $datos['tabla'].="</tbody></table>";
     $datos['num_hijos'] =$count;
     
     
     $this-> load -> view('hoja_ante/regis_HA_view',$datos); 
  }  
  
  public function selecMun() {
     
      $id=$_POST['idmun'];   
      $statement = $this->HojaAnte_m->municipios($id);
//        echo json_decode($juicios);
        
       $mun=array();
        
       while($arr=oci_fetch_array($statement))
       {
           $mun[]=array('id'=>$arr['ID'],
                         'des'=>$arr['NOM']
                        ); 
       }
        
       echo json_encode($mun);
  }
  public function Guarda_HA() {
     
     $datos['idper'] =$this->input->post('idper'); 
     $datos['idsol'] =$this->input->post('id_sol');
     $datos['edad'] =$this->input->post('edad'); 
     $datos['fec_nac'] =$this->input->post('fec_nac');
     $datos['telcas'] =$this->input->post('telcas'); 
     $datos['telmov'] =$this->input->post('telmov');
     $datos['entidadF'] =$this->input->post('entidadF'); 
     $datos['alcmun'] =$this->input->post('alcmun');
     $datos['naciona'] =$this->input->post('naciona');
     $datos['religion'] =$this->input->post('religion'); 
     $datos['estciv'] =$this->input->post('estciv');
     $datos['escola'] =$this->input->post('escola');
     $datos['actividad'] =$this->input->post('actividad'); 
     $datos['horlab'] =$this->input->post('horlab');
     $datos['numhij'] =$this->input->post('numhij');
     $datos['ep'] =$this->input->post('ep'); 
     $datos['quieneva'] =$this->input->post('quieneva');
     $datos['fec_eva'] =$this->input->post('fec_eva');
     $datos['lugareva'] =$this->input->post('lugareva');
     $datos['terap'] =$this->input->post('terap'); 
     $datos['quientera'] =$this->input->post('quientera');
     $datos['periotera'] =$this->input->post('periotera');
     $datos['lugartera'] =$this->input->post('lugartera');
     $datos['psiqui'] =$this->input->post('psiqui'); 
     $datos['quienpsiq'] =$this->input->post('quienpsiq');
     $datos['fec_valo'] =$this->input->post('fec_valo');
     $datos['lugarvalo'] =$this->input->post('lugarvalo'); 
     $datos['diagval'] =$this->input->post('diagval');
     $datos['medprein'] =$this->input->post('medprein');
     $datos['frecmed'] =$this->input->post('frecmed');
     $datos['psiqui'] =$this->input->post('psiqui'); 
     $datos['quiencron'] =$this->input->post('quiencron');
     $datos['diagcron'] =$this->input->post('diagcron');
     $datos['medpreincron'] =$this->input->post('medpreincron'); 
     $datos['frecmedcron'] =$this->input->post('frecmedcron');
     $datos['alerg'] =$this->input->post('alerg');
     $datos['quienalergia'] =$this->input->post('quienalergia');
     $datos['Especaler'] =$this->input->post('Especaler'); 
     $datos['sm'] =$this->input->post('sm');
     $datos['quienserv'] =$this->input->post('quienserv');
     $datos['Especserv'] =$this->input->post('Especserv'); 
     $datos['avisaremerg'] =$this->input->post('avisaremerg');
     $datos['telemerg'] =$this->input->post('telemerg');
     $datos['custde'] =$this->input->post('custde');
     $datos['pension'] =$this->input->post('pension'); 
     $datos['visconv'] =$this->input->post('visconv');
     $datos['visfav'] =$this->input->post('visfav'); 
     $datos['ldh'] =$this->input->post('ldh');
     $datos['hpj'] =$this->input->post('hpj');
     $datos['chpj'] =$this->input->post('chpj'); 
     $datos['eacuar'] =$this->input->post('eacuar');
     $datos['cumpl'] =$this->input->post('cumpl');
     $datos['causas'] =$this->input->post('causas');
     $datos['otrosJ'] =$this->input->post('otrosJ'); 
    
     
     echo "idper --->".$datos['idper']."<br>";
     echo "idsol --->".$datos['idsol']."<br>";
     echo "edad --->".$datos['edad']."<br>";
     echo "fec_nac --->".$datos['fec_nac']."<br>";
     echo "telcas --->".$datos['telcas']."<br>";
     echo "telmov --->".$datos['telmov']."<br>";
     echo "entidadF --->".$datos['entidadF']."<br>";
     echo "alcmun --->".$datos['alcmun']."<br>";
     echo "naciona --->".$datos['naciona']."<br>";
     echo "religion --->".$datos['religion']."<br>";
     echo "estciv --->".$datos['estciv']."<br>";
     echo "escola --->".$datos['escola']."<br>";
     echo "horlab --->".$datos['horlab']."<br>";
     echo "numhij --->".$datos['numhij']."<br>";
     echo "ep --->".$datos['ep']."<br>";
     echo "terap --->".$datos['terap']."<br>";
     echo "psiqui --->".$datos['psiqui']."<br>";
     echo "alerg --->".$datos['alerg']."<br>";
  }  
}

