<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Rec_oficios_m extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }     
    //Función que realiza la búsqueda de la solicitud.
    public function busSolictud ($datos)
    {
        $sql = "BEGIN PACONSULTAS.SPCON_SOL(:PATOCA,:PAEXPEDIENTE,:PAOFICIO,"
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
    //Función que realiza la búsqueda de los nombres de las personas en función de una solicitud.
    public function busper($aux)
    {
        
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);        
        
        return  $querys;      
    }
    //Función que realiza la búsqueda de los diferenctes juicios de una solicitud.
    public function juicio($aux)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        oci_execute($querys);        
        
        return  $querys;      
    }
    
    //Función que hace la búsqueda de los tipos de juicio.
    /*public function tipojui($aux)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNTIPO_JUICIO('') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
    }*/
    
    
    
    
}
?>