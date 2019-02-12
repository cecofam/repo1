<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Inasistencia_m extends CI_Model{
    
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
    
    public function tipoPer($aux)//funcion para mostrar tipo persona
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
    
    public function juicio($aux)//funcion para mostrar tipo persona
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
        
    public function regisInasistencia($datos)
    {
        $sql = 'BEGIN CECOFAM_P.PAREGISTRAR.SPINASISTENCIA (:PAIDINA,:PASOLICITUD,:PAIDPER,:PACITANT,:PATIPO,:PAUSU,:PAFECHA,:PANCITA,:PAESTATUS,:VAVALIDA);END;';
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
          
    public function LEYENDA(){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.LEYENDA(:LEYENDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $leyenda = oci_new_cursor($this->db->conn_id);
  
        oci_bind_by_name($querys, ":LEYENDA", $leyenda,-1,OCI_B_CURSOR );
       
        oci_execute($querys);
        oci_execute($leyenda);
        
          return $leyenda;                                
    }
    
    public function  consultaoficio ($datos){
      
      $sql='BEGIN CECOFAM_P.PACONSULTAS.SPPCITA(:PAIDSOL,:CURSORPC);END;';
      $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
         
     $valida="";//variable para validar si el SP se ejecuto correctamente
   
     /*Variables de entrada*/
        oci_bind_by_name($querys, ":PAIDSOL", $datos['nts']);
        /*Variables de salida*/    
        oci_bind_by_name($querys, ':CURSORPC',$info,30);

        oci_execute($querys);//ejecuta el sql
        return $info;    
      
          }
    
    public function OFICIO($datos){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.OFICIOPC(:PASOL, :OFICIO);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $OFICIO = oci_new_cursor($this->db->conn_id);
      
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PASOL",$datos['nts']);
           
           //----- parametros de salida //  
            oci_bind_by_name($querys, ":OFICIO", $OFICIO,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($OFICIO);
        
           return $OFICIO;                                
    } 
    
    
    public function PERSONASPC($datos){

        $sql='BEGIN CECOFAM_P.PACONSULTAS.PERSONASPC(:PASOL, :PERSONAS);END;';
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
    
    public function tipoJuis($aux){
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
    
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
    
    public function  GUARDA_OFICIO($datos){
     
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
     echo "qq".$VAVALIDA;
          }
    
          
}
