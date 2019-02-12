<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rec_oficios_c extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');  
        $this->load->model('rec_oficios/rec_oficios_m');        
        
    }    
    public function index()
    {
       $param['tabla']="";       
       $this->load->view('rec_oficios/rec_oficios_v', $param);        
    }
    //Validación de los campos
     public function validabus(){
            
            $this->form_validation->set_rules('toca','Toca','tirm|max_length[6]|xss_clean|integer');
            $this->form_validation->set_rules('oficio','Oficio','trim|max_length[6]|xss_clean|integer');            
            $this->form_validation->set_rules('expediente','Expediente','trim|max_length[6]|xss_clean|integer');            
            $this->form_validation->set_rules('anioexp','Año de Expediente','trim|max_length[4]|xss_clean|integer');
                                   
        
          if($this->form_validation->run() == FALSE){ //si no se cumplio una regla, muestra la pantalla, y ejecuta la 
                     $this->load->view('rec_oficios/rec_oficios_v'); //la vista que contiene la ventana modal
                     $this->load->view('Modales/modalError');                      
                      }
                      else{
                           $this->load->view('rec_oficios/rec_oficios_v');
		           
                           $data=array('mensaje' =>'¿Est&aacute;s seguro de guardar la informaci&oacute;n del curso?',
                                                 'onclick'=>'Closecorrecto();requisitos();mjecorrecto();');
                           $this->load->view('Modales/confirmacion',$data);
                          
                      }
        }
    
    public function bus_Solictud()
    { 
            $datos['toca'] = strtoupper(trim($this->input->post('toca')));;
            $datos['expediente'] = strtoupper(trim($this->input->post('expediente')));
            $datos['oficio'] = strtoupper(trim($this->input->post('oficio')));
            $datos['anioexp'] = strtoupper(trim($this->input->post('anioexp')));            
            $datos['estatus']= 4;            
            
            //$datos['folio'] = strtoupper(trim($this->input->post('folio')));
            //$datos['aniofol'] = strtoupper(trim($this->input->post('aniofol')));                      
                                                                                    
            //LLAMAR A LA FUNCIÓN QUE BUSCA LA SOLICITUD
            list($vasalida,$cursor) = $this->rec_oficios_m->busSolictud($datos);            
            //echo "varegper --->".$varegper."<br>";     
            $param['tabla'] = "<center>
                                        <div id='sortableTable' class='body collapse in'>
                                        <table class='table table-bordered sortableTable responsive-table tablesorter tablesorter-default' role='grid'>
                                            <thead>
                                            <tr>                                                
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        EXPEDIENTE
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        TIPO DE JUICIO
                                                    </div>
                                                </th>
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        JUICIO
                                                    </div>
                                                </th>                                                                                                                                                                                            
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        NOMBRE
                                                    </div>
                                                </th>                                                                                                                                                                                                                                  
                                                <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        ACUSE
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>";
            //Recorrido de la función "busSolicitud" para obtener el id_sol
            $count1 =0;        
            $count =1; 
            if(($datos['toca']=="") and ($datos['expediente']=="") and ($datos['oficio']=="")and ($datos['anioexp']==""))
            {
                $param['tabla']="";
                                $datos=array('subtitulo'=>'Ocurri&oacute; un problema en consulta.<br/> ',
                                                             'mensaje'=>'Por favor realiza una consulta',
                                                              'onclick'=>'CierraError();');
                                                            $this->load->view('Modales/modalerror',$datos);
                                                            $this->load->view('rec_oficios/rec_oficios_v',$param);
            }
            else
            {
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
                                $param['tabla'].="<tbody aria-live='polite' aria-relevant='all'>
                                                <tr>
                                                    <th >&nbsp;&nbsp;&nbsp;".$count."</th>
                                                    <td >&nbsp;&nbsp;&nbsp;".$data['EXPEDIENTE']."</td>
                                                    <td >&nbsp;&nbsp;&nbsp;".$data['TIP_JUI']."</td><td>";
                                                      
                                                      $aux=$data['ID_SOL'];//Guardamos el id_sol en una variable.                                                      
                                                      $cursor2 = $this->rec_oficios_m->juicio($aux);//Se manda a llamar la función que busca el juicio 
                                                      $cursor3 = $this->rec_oficios_m->busper($aux);//Se manda a llamar la función que busca los nombres y tipo de persona    
                                                      while($row = oci_fetch_array($cursor2,OCI_ASSOC))
                                                                {
                                                                    $rc = $row['MFRC'];
                                                                    oci_execute($rc);
                                                                    while($data2 = oci_fetch_array($rc,OCI_ASSOC))
                                                                    {                                                                               
                                                                            $param['tabla'].="<table>"
                                                                                    . "<tr>"
                                                                                    . "<td>".$data2['DES']."<br></td>"
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
                                                                            if (($aux2 == 5) || ($aux2 == 6)){
                                                                            $param['tabla'].="<table >
                                                                                                <tr>
                                                                                                <th>
                                                                                                   ".$data3['NOMBRE']." "."<br>"." ".$data3['TIP_PER']." 
                                                                                                </th>                                                         
                                                                                                </tr>
                                                                                                </table>";                                                                            
                                                                            }
                                                                    }
                                                                }                                 
                                $param['tabla'].="</td><td><input style='height:15px;width:150px' type='checkbox' id='acuse.$count1' name='acuse' value ='".$data['ID_SOL']."'></td>"
                                        . "<input type='hidden' id=\"sol".$count1."\" name=\"sol".$count1."\" value='".$data['ID_SOL']."'/> </tr>";
                                $count ++;                                         
                            }
                              
                    }   
            }
            $param['tabla'].="</tbody></table></div>"
                    . "<input type='submit' class='btn btn-primary' id='turnar' name='turnar' value='Turnar al Sistema' onClick=\"Turna('sol".$count1."');\"/>";      
            $count1 ++;
            $this->load->view('rec_oficios/rec_oficios_v',$param); 
            
            $anio=date('Y');            
        }
    }

?>