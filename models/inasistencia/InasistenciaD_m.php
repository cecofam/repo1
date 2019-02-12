<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class InasistenciaD_m extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
   //********************************************************************************************************************************************       
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
  //********************************************************************************************************************************************         
    public function tipoPer($aux)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        return $querys;
           
           
    }
  //*********************************************************************************************************************************************
//    public function wordAntecedentes($datos){
//        $sql="CECOFAM_P.PACONSULTAS.FNBUSPERS ('".$datos."') AS mfrc FROM dual)";
//        $querys = oci_parse($this->db->conn_id,$sql);
//        oci_execute($querys);
//        return $querys;
//           
//        
//    }
    
}