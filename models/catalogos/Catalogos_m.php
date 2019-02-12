<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class Catalogos_m extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
   //********************************************************************************************************************************************       
    public function FuncVar($nom_paq,$nom_func,$var)
    {
        $sql = "SELECT CECOFAM_P.".$nom_paq.".".$nom_func."('".$var."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        return $querys;
   }
    public function FunCat($nom_paq,$nom_func){
        $sql = "SELECT CECOFAM_P.".$nom_paq.".".$nom_func."() AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        return $querys;
           
    }
    
  
    
}