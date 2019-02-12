<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Menu extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    
   public function modulos ($iduser)
    {
        $sql="SELECT CECOFAM_P.PACONSULTAS.FNMODULOS ('".$iduser."') AS mfrc FROM dual";

        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        //oci_bind_by_name($querys, ':VACURSORM', $cursor,-1,OCI_B_CURSOR );
        oci_execute($querys);
        //oci_execute($cursor);

        return $querys;
    }
    public function submodulos($id_modulo,$iduser)
    {
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNSUBMENU ('".$id_modulo."','".$iduser."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        return $querys;
    }
    
}