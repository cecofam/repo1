<?php
/*
 * DESCRIPCIÓN: CONTRTOLADOR PARA LA BUSQUEDA Y EDICION DE PSICOLOGOS
 * FECHA: 21 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Psicologos_c extends CI_Controller {
    //contralador inicial, carga psicologos
    function __construct()
    {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('catalogos/Psicologos_model');
    }
    public function index()
    {
         $param['tabla']="";
        $this-> load -> view('catalogos/psicologos_view',$param); 
    }
        public function BuscarPC ()
        {       
        
        $datos['cvepsicologo']= $this->input->post('cvepsicologo');
        $datos['appat']= $this->input->post('appat');
        $datos['apmat']= $this->input->post('apmat');
        $datos['nombre']= $this->input->post('nombre');
        $datos['iniciales']= $this->input->post('iniciales');
        $datos['cedula']= $this->input->post('cedula');
        $datos['activo']= $this->input->post('activo');
            if($datos['activo'] == 'ACTIVO')
            {
                $datos['activo'] = 'S';
            }else{ 
                if ($datos['activo'] == 'INACTIVO') {
                $datos['activo'] = 'N';
            }
        }
        //$datos['activo']= $this->input->post('activo');
        
         //LLAMAR A LOS MODELOS
            
        $cursor = $this->Psicologos_model->BuscarPM($datos); 
        $url=base_url().'#';
        $param['tabla'] = "<center>
                                
                                       <table class='contenidoTable' border='1'>
                                            <tr> 
                                                <td>Número</td>
                                                <td>Apellido Paterno</td>
                                                <td>Apellido Materno</td>
                                                <td>Nombre(s)</td>
                                                <td>Iniciales</td>
                                                <td>Cedula</td>
                                                <td>Activo</td>
                                                <td>desactivado</td>
                                                
                                                <td></td>
                                            </tr>";
          $num=1;
          
           while($data = oci_fetch_array($cursor,OCI_ASSOC)){
               $rc=$data['MFRC'];
               oci_execute($rc);
               
               while($ar=oci_fetch_array($rc,OCI_ASSOC)){
                  if($ar['ACTIVO'] == 'S')
                  {
                    $activo = "ACTIVO";
                   
                  }
                  else
                  { 
                  if($ar ['ACTIVO'] == 'N')    
                    $activo = "INACTIVO";
                  }
                  
                  if(isset($ar['APPAT'])){
                      $app=$ar['APPAT'];
                  }else{
                      $app="";
                  }
                  if(isset($ar['CEDULA'])){
                      $ced=$ar['CEDULA'];
                  }else{
                      $ced="";
                 
                  } 
                  
                  $param['id_sol'][$num]    =$ar['CVEPSICOLOGO'];                  
                  $param['appat'][$num]     =$ar['APPAT'];
                  $param['apmat'][$num]     =$ar['APMAT'];
                  $param['nombre'][$num]    =$ar['NOMBRE'];
                  $param['iniciales'][$num] =$ar['INICIALES'];
                  $param['cedula'][$num]    =$ar['CEDULA'];
                  $param['activo'][$num]    =$ar['ACTIVO'];
                  
                  
                  $param['tabla'].="<tr><form action='$url' method ='post'>" 
                                 . "<td>".$num."<input type='hidden' value='".$ar['CVEPSICOLOGO']."' name='id_sol' id='id_sol'>"
                                 . "<input type='hidden' value='".$num."' name='num' id='num'>"
                                 . "</td>"
                                 . "<td>".$app."<input type='hidden' name='appat' id='appat' value='".$app."'></td>"
                                 . "<td>".$ar['APMAT']."<input type='hidden'  name='apmat' id='apmat' value='".$ar['APMAT']."'></td>"
                                 . "<td>".$ar['NOMBRE']."<input type='hidden' name='nombre' id='nombre' value='".$ar['NOMBRE']."'></td>"
                                 . "<td>".$ar['INICIALES']."<input type='hidden' name='iniciales' id='iniciales' value='".$ar['INICIALES']."'></td>"          
                                 . "<td>".$ced."<input type='hidden' name='cedula' id='cedula' value='".$ced."'></td>"
                                 . "<td>".$activo."<input type='hidden' name='activo' id='activo' value='".$ar['ACTIVO']."'></td>"
                                 . "<td><a href='#' class='btn btn-block btn-primary btn-sm' style'width: 20%;' data-toggle='modal' data-target='#EditarModal' onClick='Recibe('".$num."');'> </td>"
                                 ."</form>". "</tr>";

                   

                  $num++;
               }
           }
           $param['tabla'].="</table>";   
          
           $this->load->view('catalogos/psicologos_view',$param,$num); 
        }
        
        public function EditarPC()
        {
            
             
             
//            $this->form_validation->set_rules('cvepsicologo','ID','required|min_length[1]|numeric');
//            $this->form_validation->set_rules('appat','A.paterno','required|min_length[2]|alpha');
//            $this->form_validation->set_rules('apmat','A.materno','required|min_length[2]|alpha');
//            $this->form_validation->set_rules('nombre','Nombre(s)','required|min_length[2]|alpha');
//            $this->form_validation->set_rules('iniciales','Iniciales','required|min_length[2]|alpha');
//            $this->form_validation->set_rules('cedula','Cedula','required|trim|min_length[4]|numeric');
//            $this->form_validation->set_rules('activo','Activo','required|trim|min_length[1]|alpha');
               
                       
                       
            $datos['cvepsicologo']= $this->input->post('id_sol');
            $datos['appat']= $this->input->post('appat');
            $datos['apmat']= $this->input->post('apmat');
            $datos['nombre']= $this->input->post('nombre');
            $datos['iniciales']= $this->input->post('iniciales');
            $datos['cedula']= $this->input->post('cedula');
            $datos['activo']= $this->input->post('activo');
            $datos['fecha_creacion']= $this->input->post('fecha_creacion');
            // $datos['idusuario']= $this->input->post('idusuario');
            $datos['fecha_actualizacion']= $this->input->post('fecha_actualizacion');
         
        echo "id--->".$datos['cvepsicologo']."<br>";
        echo "nombre--->".$datos['nombre']."<br>";
        echo "Iniciales--->".$datos['iniciales']."<br>";
        echo "Apellido Materno--->".$datos['appat']."<br>";
        echo "Apellido Paterno--->".$datos['apmat']."<br>";
        echo "Cedula--->".$datos['cedula']."<br>";
        echo "Activo--->".$datos['activo']."<br>";
      
        
      
         
                    //LLAMAR A LOS MODELOS  
         // $this->BuscarPs_model->EditarPM($datos);
       // $this->BuscarPs_model->EditarPM($datos);
//        $valida=$this->input->post('valida');
//        echo "valida--->".$valida;
       
      
//      
          $guard_psi=$this->Psicologos_model->EditarPM($datos);
          echo "Fecha_creacion--->".$guard_psi['fecha_creacion']."<br>"; 
       echo "fecha Actualización--->".$guard_psi['fechaActualizacion']."<br>";
        // echo "IDusuario--->".$guard_psi['idusuario']."<br>";
       echo "guarda --->".$guard_psi['valida']."<br>";
       
       
       
    }  
}
        
    

