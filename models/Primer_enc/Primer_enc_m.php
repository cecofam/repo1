<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Primer_enc_m extends CI_Model{
    
    public function _construct()
    {
        parent::_construct();
    }
    
    public function BusPer($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA, :PAEXPEDIENTE, :PAOFICIO, :PAFOLIO, :PAANIOEXP, :PAANIOFOL, :VAESTATUS, :PATIP_JUI, :VAVALIDA, :CURSORBUSQUEDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vasalida=0;
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PATOCA",$datos['toca']);
           oci_bind_by_name($querys, ":PAEXPEDIENTE",$datos['expediente']);
           oci_bind_by_name($querys, ":PAOFICIO",$datos['oficio']);
           oci_bind_by_name($querys, ":PAFOLIO",$datos['folio']);
           oci_bind_by_name($querys, ":PAANIOEXP",$datos['anioexp']);
           oci_bind_by_name($querys, ":PAANIOFOL",$datos['aniofol']);
           oci_bind_by_name($querys, ":VAESTATUS",$datos['estatus']);
           oci_bind_by_name($querys, ":PATIP_JUI",$datos['tipjui']);
           
           //----- parametros de salida //  
           oci_bind_by_name($querys, ':VAVALIDA', $vasalida,5);// no se a que se hace referencia el numero
           oci_bind_by_name($querys, ":CURSORBUSQUEDA", $cursor,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($cursor);
        
           return array($vasalida,$cursor);                                
      }
//----------------------------------------------------------------------------------------------------      
      public function Buscar_sol ($datos)
    {
        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA, :PAEXPEDIENTE, :PAOFICIO, :PAFOLIO, :PAANIOEXP, :PAANIOFOL, :VAESTATUS, :PATIP_JUI, :VAVALIDA, :CURSORBUSQUEDA);END;';
        $pavalida=" ";
        
        $querys = oci_parse($this->db->conn_id,$sql);
        $cursor =  oci_new_cursor($this->db->conn_id);//declaramos cursos
       //----- parametros de entrada-------///
       //remplazo de las variables del SP con las variables de PHP
       oci_bind_by_name($querys, ":PATOCA",$datos['toca']);  
       oci_bind_by_name($querys, ":PAEXPEDIENTE",  $datos['expediente']);
       oci_bind_by_name($querys, ":PAOFICIO",  $datos['oficio']);
       oci_bind_by_name($querys, ":PAFOLIO",  $datos['folio']);
       oci_bind_by_name($querys, ":PAANIOEXP",  $datos['annio_exp']);
       oci_bind_by_name($querys, ":PAANIOFOL",  $datos['annio_folio']);
       oci_bind_by_name($querys, ":VAESTATUS", $datos['estatus']);
       oci_bind_by_name($querys, ":PATIP_JUI",$datos['tipjui']);
       
       //----- parametros de salida //  
       oci_bind_by_name($querys, ':VAVALIDA', $pavalida,5);
       oci_bind_by_name($querys, ':CURSORBUSQUEDA', $cursor,-1,OCI_B_CURSOR );
            /*********************************************************************/
        oci_execute($querys);//ejecuta el sql
        oci_execute($cursor);
       return array($pavalida,$cursor);
        //return $cursor;
        //return $pavalida;
    }
//----------------------------------------------------------------------------------------------------      
    public function registro($datos)
    {     
//       $sql = "BEGIN CECOFAM_P.PACONSULTAS.SPASIG_FAC(:PAIDSOL,:PAIDFAC,:PAFECHA,:PAHORAED_INI,:PAHORAED_FIN,:VAVALIDA);END;";
       
       $sql = "BEGIN CECOFAM_P.PAREGISTRAR.SPASIG_FAC(:PAIDSOL,:PAIDPERSONA,:PAIDFAC,:PAFECHA,:PAIDHOR,:PAUSUARIO,:VAVALIDA);END;";
        
       $vavalida="";
       $querys = oci_parse($this->db->conn_id,$sql);
            //-----------Par�metros de Entraada-------------------//
        oci_bind_by_name($querys, ":PAIDSOL",   $datos['idsol']);
        oci_bind_by_name($querys, ":PAIDPERSONA",   $datos['idper']);
        oci_bind_by_name($querys, ":PAIDFAC",   $datos['fecha']);
        oci_bind_by_name($querys, ":PAFECHA", $datos['hora_ini']);
        oci_bind_by_name($querys, ":PAIDHOR", $datos['horaed_fin']);
        oci_bind_by_name($querys, ":PAUSUARIO", $datos['idUser']);                
        oci_bind_by_name($querys, ":VAVALIDA", $vavalida);
        oci_execute($querys);
       
        return ($vavalida);
    } 
//----------------------------------------------------------------------------------------------------          
    //Función que veifica la disponibilidad de los facilitadores
    public function facED($fec_ed)
    {
        $sql = 'BEGIN CECOFAM_P.PACONSULTAS.SPFACED(:PAFECHAED,:PAVALIDA,:CURSORF);END;';
        $vavalida="";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        oci_bind_by_name($querys, ":PAFECHAED",$fec_ed);
        
        //parametros de salida
        oci_bind_by_name($querys,":PAVALIDA", $vavalida,5);
        oci_bind_by_name($querys, ":CURSORF", $cursor,-1,OCI_B_CURSOR );
        
        oci_execute($querys);
        oci_execute($cursor);
        
        return array($cursor,$vavalida);
    }
//----------------------------------------------------------------------------------------------------      
    //Función que realiza la búsqueda de las personas pertenecientes a la solicitud. 
    public function Buspers($aux)
    { 
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
//----------------------------------------------------------------------------------------------------       
    public function tipoPer($aux)//funcion para mostrar tipo persona
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
        
    }
//----------------------------------------------------------------------------------------------------         
    //Función que realiza la búsqueda de las primeras citas y hace el cálculo de días.
    public function fechaPcita($idpersona)
    {
        $sql = 'BEGIN CECOFAM_P.PACONSULTAS.SPFECHAPCITAED(:IDPERSONA,:FECHA_SUGED,:PAVALIDA);END;';
        
        $fechaprop_ed="";
        $valida="";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        oci_bind_by_name($querys, ":IDPERSONA",$idpersona);
        
        //parametros de salida
        oci_bind_by_name($querys,":FECHA_SUGED", $fechaprop_ed,20);
        oci_bind_by_name($querys,":PAVALIDA", $valida,5);
        
        oci_execute($querys);
        
        
        return array($valida,$fechaprop_ed);
    }
//----------------------------------------------------------------------------------------------------          
    //Función que veifica los facilitadores de acuerdo al dia
    public function facDia($fec_ed)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNDIAS_PSICO('".$fec_ed."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
//----------------------------------------------------------------------------------------------------          
    //Función que trae los horarios de las entrevistas diagnósticas 
    public function horariosed($auxps,$auxnom)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNHORARIOED('".$auxps."','".$auxnom."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
//----------------------------------------------------------------------------------------------------          
    //Función que trae los horarios del primer encuentro 
    public function psicope($idps)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNPSICOPE('".$idps."' ) AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
//----------------------------------------------------------------------------------------------------          
        public function SieteDias()//Función que calcula 7 dias
    {
      $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCALFECED(:FECHA_SUGED,:PAVALIDA);END;';
      $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
     $valida="";//variable para validar si el SP se ejecuto correctamente
     $fecha_fin="";//variable 
     
     /*Variables de entrada*/
//        oci_bind_by_name($querys, ":PAFEC_CAL", $datos['fecha_inicio']);
//        oci_bind_by_name($querys, ":NUMDIAS", $datos['num_dias']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':FECHA_SUGED',$fecha_fin,30);
        oci_bind_by_name($querys, ':PAVALIDA',$valida,30);

        oci_execute($querys);//ejecuta el sql
        return array($fecha_fin,$valida);    
      
    }
//----------------------------------------------------------------------------------------------------          
        public function SieteDiasPsico($idsol, $id_psicologo)//Función que calcula 7 dias id psicologo
    {
      $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCALFEC_PSICOED(:PAIDSOL,:PAIDPSICO,:FECHA_SUGED,:PAVALIDA);END;';
      $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
     $valida="";//variable para validar si el SP se ejecuto correctamente
     $fecha_fin="";//variable 
     
     /*Variables de entrada*/
       oci_bind_by_name($querys, ":PAIDPSICO",$id_psicologo);
              oci_bind_by_name($querys, ":PAIDSOL",$idsol);
//        oci_bind_by_name($querys, ":NUMDIAS", $datos['num_dias']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':FECHA_SUGED',$fecha_fin,30);
        oci_bind_by_name($querys, ':PAVALIDA',$valida,30);

        oci_execute($querys);//ejecuta el sql
        return array($fecha_fin,$valida);    
      
    }
//----------------------------------------------------------------------------------------------------          
//Función para calculo de dias SPFECHAPCITAED
    public function Dia($aux)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.SPFECHAPCITAED('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
//----------------------------------------------------------------------------------------------------          
//Función para aolicitar id de facilitador
    public function FACILITADOR1($idsol){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.FNPSICO_FORMATO(:PAIDSOL, :PSICO);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $PSICO = oci_new_cursor($this->db->conn_id);
      
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PAIDSOL",$idsol);
           
           //----- parametros de salida //  
            oci_bind_by_name($querys, ":PSICO", $PSICO,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($PSICO);
        
           return $PSICO;                                
    }    
//----------------------------------------------------------------------------------------------------              
    public function regisInasistencia($datos)
    {
        $sql = 'BEGIN CECOFAM_P.PAREGISTRAR.SPINASISTENCIA(:PAIDINA,:PASOLICITUD,:PAIDPER,:PACITANT,:PATIPO,:PAUSU,:PAFECHA,:PANCITA,:PAESTATUS,:VAVALIDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vavalida=0;
        //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PAIDINA",$datos['id_inas']);
           oci_bind_by_name($querys, ":PASOLICITUD",$datos['id_sol']);
           oci_bind_by_name($querys, ":PAIDPER",$datos['id_pers']);
           oci_bind_by_name($querys, ":PACITANT",$datos['cita_a']);
           oci_bind_by_name($querys, ":PATIPO",$datos['tipo']);
           oci_bind_by_name($querys, ":PAUSU",$datos['usuario']);
           oci_bind_by_name($querys, ":PAFECHA",$datos['fecha']);
           oci_bind_by_name($querys, ":PANCITA",$datos['fechaP']);
           oci_bind_by_name($querys, ":PAESTATUS",$datos['estatus']);
           
           //----- parametros de salida //  
           oci_bind_by_name($querys, ':VAVALIDA', $vavalida,30);
           oci_execute($querys);
          
           return $vavalida;
           
    }
//----------------------------------------------------------------------------------------------------                  
    public function  verificaDias ($datos)
    {
      
     $sql='BEGIN TRABAJO_P.PACONSULTAS.FNCUENTADIAS(:PADIAA,:TOTAL);END;';
     $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
    // $valida="";//variable para validar si el SP se ejecuto correctamente
     $Dias="";//variable 
     
     /*Variables de entrada*/
        oci_bind_by_name($querys, ":PADIAA",$datos['fechaP']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':TOTAL',$Dias,30);
    //    oci_bind_by_name($querys, ':valida',$valida,30);

        oci_execute($querys);//ejecuta el sql
      //  return array($fecha_final,$valida);    
      return $Dias;
    }
//----------------------------------------------------------------------------------------------------              
    public function  CUENTADIAS ($datos){
      
     $sql='BEGIN CECOFAM_P.PACONSULTAS.FNCUENTAHORA(:PADIAA,:HORA);END;';
     $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
    // $valida="";//variable para validar si el SP se ejecuto correctamente
     $Dias="";//variable 
     /*Variables de entrada*/
        oci_bind_by_name($querys, ":PADIAA",$datos['fechaP']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':HORA',$Dias,30);
    //    oci_bind_by_name($querys, ':valida',$valida,30);

        oci_execute($querys);//ejecuta el sql
      //  return array($fecha_final,$valida);    
     return $Dias;
          }
//----------------------------------------------------------------------------------------------------                    
    public function LEYENDA(){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.LEYENDA(:LEYENDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $leyenda = oci_new_cursor($this->db->conn_id);
  
        oci_bind_by_name($querys, ":LEYENDA", $leyenda,-1,OCI_B_CURSOR );
       
        oci_execute($querys);
        oci_execute($leyenda);
        
          return $leyenda;                                
    }

//----------------------------------------------------------------------------------------------------              
    public function OFICIO($idsol){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.OFICIOPC(:PASOL, :OFICIO);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $OFICIO = oci_new_cursor($this->db->conn_id);
              
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PASOL",$idsol);
           
           //----- parametros de salida //  
            oci_bind_by_name($querys, ":OFICIO", $OFICIO,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($OFICIO);
        
           return $OFICIO;                                
    } 
//----------------------------------------------------------------------------------------------------              
    //Función que realiza la búsqueda de los diferntes juicios dentro de una solicitud. 
    public function tipJui($aux)//funcion para mostrar tipo persona
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
//----------------------------------------------------------------------------------------------------              
    public function facilitador($aux)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNPSICO('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id, $sql);//ejecutamos el query
        oci_execute($querys); 
        
        return $querys;
    }
//----------------------------------------------------------------------------------------------------              
    public function NUM_OFICIO(){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.NUMERO_OFICIO(:NUM_OFICIO);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $NUM_OFICIO = oci_new_cursor($this->db->conn_id);
      
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           
         //----- parametros de salida //  
            oci_bind_by_name($querys, ":NUM_OFICIO", $NUM_OFICIO,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($NUM_OFICIO);
        
           return $NUM_OFICIO;                                
    }
//----------------------------------------------------------------------------------------------------              
    public function  GUARDA_OFICIO($datos){
     
 ECHO    $datos['nts']."-".$datos['TOFICIO']."--".$datos['NUMERO']."---".$datos['persona']."----".$datos['usuario']."-----".$datos['ANIO'];
     $sql='BEGIN CECOFAM_P.PAREGISTRAR.OFICIO(:PASOLICITUD,:PATIPOFICIO,:PANUM_OFICI,:PAPERSONA,:PAUSUARIO,:PAANIO,:VAVALIDA);END;'; 
     $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query  
    
     $VAVALIDA="";//variable 
     /*Variables de entrada*/
        
        oci_bind_by_name($querys, ":PASOLICITUD",$datos['nts']);
        oci_bind_by_name($querys, ":PATIPOFICIO",$datos['TOFICIO']);
        oci_bind_by_name($querys, ":PANUM_OFICI",$datos['NUMERO']);
        oci_bind_by_name($querys, ":PAPERSONA",$datos['persona']);        
        oci_bind_by_name($querys, ":PAUSUARIO",$datos['usuario']);
        oci_bind_by_name($querys, ":PAANIO",$datos['ANIO']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':VAVALIDA',$VAVALIDA,30);
    //    oci_bind_by_name($querys, ':valida',$valida,30);

        oci_execute($querys);//ejecuta el sql
      //  return array($fecha_final,$valida);    
     echo "ok".$VAVALIDA;
          }
  //Función que realiza la búsqueda de la solicitud.
//----------------------------------------------------------------------------------------------------                    
    public function busSolictud ($datos)
    {
        $sql = "BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA,:PAEXPEDIENTE,:PAOFICIO,"
                . ":PAFOLIO,:PAANIOEXP,:PAANIOFOL,:VAESTATUS,:PATIP_JUI,:VAVALIDA,:CURSORBUSQUEDA); END;";
        $vasalida=0;        
        $cursor =  oci_new_cursor($this->db->conn_id);//declaramos cursor         
        $querys = oci_parse($this->db->conn_id,$sql);        
       //----- parámetros de entrada-------///
       //Reemplazo de las variables del SPCON_SOL con las variables de PHP
       oci_bind_by_name($querys, ":PATOCA",  $datos['toca']);       
       oci_bind_by_name($querys, ":PAEXPEDIENTE",  $datos['expediente']);
       oci_bind_by_name($querys, ":PAOFICIO",  $datos['oficio']);              
       oci_bind_by_name($querys, ":PAFOLIO",$datos['folio']);  
       oci_bind_by_name($querys, ":PAANIOEXP",  $datos['anioexp']);
       oci_bind_by_name($querys, ":PAANIOFOL",  $datos['aniofol']);
       oci_bind_by_name($querys, ':VAESTATUS', $datos['estatus']);
       oci_bind_by_name($querys, ":PATIP_JUI",  $datos['tipjui']);    
       //----- parámetros de salida //  
       oci_bind_by_name($querys, ':VAVALIDA', $vasalida,5);             
       //----- Cursores //  
       oci_bind_by_name($querys, ':CURSORBUSQUEDA', $cursor,-1,OCI_B_CURSOR );              
            /*********************************************************************/
       oci_execute($querys);//ejecuta el sql
       oci_execute($cursor);                
        
       return array($vasalida,$cursor);    
       
    }
//----------------------------------------------------------------------------------------------------               
    public function  modaloculto($datos){
     
 //ECHO    $datos['nts']."-".$datos['TOFICIO']."--".$datos['NUMERO']."---".$datos['persona']."----".$datos['usuario']."-----".$datos['ANIO'];
     $sql='BEGIN CECOFAM_P.PAREGISTRAR.OFICIO(:PASOLICITUD,:PATIPOFICIO,:PANUM_OFICI,:PAPERSONA,:PAUSUARIO,:PAANIO,:VAVALIDA);END;'; 
     $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query  
    
     $VAVALIDA="";//variable 
     /*Variables de entrada*/
        
        oci_bind_by_name($querys, ":PASOLICITUD",$datos['nts']);
        oci_bind_by_name($querys, ":PATIPOFICIO",$datos['TOFICIO']);
        oci_bind_by_name($querys, ":PANUM_OFICI",$datos['NUMERO']);
        oci_bind_by_name($querys, ":PAPERSONA",$datos['persona']);        
        oci_bind_by_name($querys, ":PAUSUARIO",$datos['usuario']);
        oci_bind_by_name($querys, ":PAANIO",$datos['ANIO']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':VAVALIDA',$VAVALIDA,30);
    //    oci_bind_by_name($querys, ':valida',$valida,30);

        oci_execute($querys);//ejecuta el sql
      //  return array($fecha_final,$valida);    
     echo "ok".$VAVALIDA;
          }
//----------------------------------------------------------------------------------------------------                       
    public function juicio($aux)//funcion para mostrar tipo persona
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }           
//----------------------------------------------------------------------------------------------------              
    public function consultaDias($datos)
    {
      
      $sql='BEGIN TRABAJO_P.PACONSULTAS.FNSumar_Dias_Habiles(:fecha_inicio,:dias_habiles,:fecha_fin,:valida);END;';
      $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
     $valida="";//variable para validar si el SP se ejecuto correctamente
     $fecha_fin="";//variable 
     
     /*Variables de entrada*/
        oci_bind_by_name($querys, ":fecha_inicio", $datos['fecha_inicio']);
        oci_bind_by_name($querys, ":dias_habiles", $datos['dias_habiles']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':fecha_fin',$fecha_fin,30);
        oci_bind_by_name($querys, ':valida',$valida,30);

        oci_execute($querys);//ejecuta el sql
        return array($fecha_fin,$valida);    
      
    }
//----------------------------------------------------------------------------------------------------                            
    public function actualiza($datos)
    {
        $sql = "BEGIN CECOFAM_P.PAACTUALIZA.SPUPEST(:PAIDSOL,:PAESTATUS,:VAVALIDA); END;";
        $vavalida= 0;        
        $querys = oci_parse($this->db->conn_id, $sql);
            //----- parÃ¡metros de entrada-------///
        //Reemplazo de las variables del SPRECESOL con las variables de PHP
        oci_bind_by_name($querys, ":PAIDSOL", $datos['idsol']);
        oci_bind_by_name($querys, ":PAESTATUS",  $datos['estatus']);        
        /*********************************************************************/
                //----- parÃ¡metros de salida //  
        oci_bind_by_name($querys, ':VAVALIDA', $vavalida,5);  
       
        oci_execute($querys);//ejecuta el sql                 
                             
        return $vavalida;
    }
//----------------------------------------------------------------------------------------------------                  
    public function PERSONASPC($datos){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.FECHAINAS(:PASOL, :PERSONAS);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $PERSONAS = oci_new_cursor($this->db->conn_id);
      
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PASOL",$datos['nts']);
           
           //----- parametros de salida //  
            oci_bind_by_name($querys, ":PERSONAS", $PERSONAS,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($PERSONAS);
        
           return $PERSONAS;                                
    }
//----------------------------------------------------------------------------------------------------              
    public function tipoJuis($aux){
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
//----------------------------------------------------------------------------------------------------                  
    public function Checkina($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCHECKINA(:PASOLICITUD, :PAPERSONA, :VAEXIST);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vasalida=0;
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PASOLICITUD",$datos['id_sol']);
           oci_bind_by_name($querys, ":PAPERSONA",$datos['id_pers']);
           
           
           
           //----- parametros de salida //  
           oci_bind_by_name($querys, ':VAEXIST', $vasalida,5);// no se a que se hace referencia el numero x999 XD
       
           oci_execute($querys);
          
        
           return $vasalida;
      }      
//----------------------------------------------------------------------------------------------------          
public function Recep($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA, :PAEXPEDIENTE, :PAOFICIO, :PAFOLIO, :PAANIOEXP, :PAANIOFOL, :VAESTATUS, :PATIP_JUI, :VAVALIDA, :CURSORBUSQUEDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vasalida=0;
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PATOCA",$datos['toca']);
           oci_bind_by_name($querys, ":PAEXPEDIENTE",$datos['expediente']);
           oci_bind_by_name($querys, ":PAOFICIO",$datos['oficio']);
           oci_bind_by_name($querys, ":PAFOLIO",$datos['folio']);
           oci_bind_by_name($querys, ":PAANIOEXP",$datos['anioexp']);
           oci_bind_by_name($querys, ":PAANIOFOL",$datos['aniofol']);
           oci_bind_by_name($querys, ":VAESTATUS",$datos['estatus']);
           oci_bind_by_name($querys, ":PATIP_JUI",$datos['tipjui']);
           
           //----- parametros de salida //  
           oci_bind_by_name($querys, ':VAVALIDA', $vasalida,5);// no se a que se hace referencia el numero
           oci_bind_by_name($querys, ":CURSORBUSQUEDA", $cursor,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($cursor);
        
           return array($vasalida,$cursor);
      }          
}
