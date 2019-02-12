<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Entrevistad_model extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    //Busqueda de los facilitadores disponibles.
    public function facilitador()
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNFACILITADOR ('') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }
    //Función que realiza la búsqueda de las personas pertenecientes a la solicitud. 
    public function Buspers($aux)
    { 
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }    
    //Función que realiza la búsqueda de los diferntes juicios dentro de una solicitud. 
    public function Busjuiciosol($aux)
    { 
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
    //Función que realiza la búsqueda de las solicitudes.
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
    //Función que almacena los datos de la entrevista diagnóstica
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
    //Función que trae los horarios de las entrevistas diagnósticas    
    public function horariosed($auxps,$auxnom)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNHORARIOED('".$auxps."','".$auxnom."' ) AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
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
    //Función que veifica los facilitadores de acuerdo al dia
    public function facDia($fec_ed)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNDIAS_PSICO('".$fec_ed."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);
        return $querys;
    }
}

