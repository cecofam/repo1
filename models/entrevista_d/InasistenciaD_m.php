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
       
     public function expediente($datos)
    {
        $sql = "BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PAEXPEDIENTE, :PAANIOEXP, : PAFOLIO, :PAANIOFOL, :VAVALIDA,:CURSORBUSQUEDA);END;";
        $pavalida=" ";
        $querys = oci_parse($this->db->conn_id,$sql);
        $cursor =  oci_new_cursor($this->db->conn_id);//declaramos cursos
       //----- parametros de entrada-------///
       //remplazo de las variables del SP con las variables de PHP
       oci_bind_by_name($querys, ":PAEXPEDIENTE",  $datos['expediente']);
       oci_bind_by_name($querys, ":PAFOLIO",  $datos['folio']);
       oci_bind_by_name($querys, ":PAANIOEXP",  $datos['año']);
       oci_bind_by_name($querys, ":PAANIOFOL",  $datos['año folio']);
        
       //----- parametros de salida //  

       oci_bind_by_name($querys, ':VAVALIDA', $pavalida,30);
       oci_bind_by_name($querys, ':CURSORBUSQUEDA', $cursor,-1,OCI_B_CURSOR );
            /*********************************************************************/
        oci_execute($querys);//ejecuta el sql
        oci_execute($cursor);

        return $cursor;
        return $pavalida;
    }
}