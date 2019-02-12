<?php

/* 
 * DESCRIPCIÓN: MODELO PARA LA VISTA DE PSICOLOGOS
 * FECHA: 21 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */

Class Canaliaut_m extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    
    public function Busautor($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA, :PAEXPEDIENTE, :PAOFICIO, :PAFOLIO, :PAANIOEXP, :PAANIOFOL, :VAESTATUS, :PATIP_JUI, :VAVALIDA, :CURSORBUSQUEDA);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vasalida=0;
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PATOCA",$datos['toca']);
           oci_bind_by_name($querys, ":PAEXPEDIENTE",$datos['exp']);
           oci_bind_by_name($querys, ":PAOFICIO",$datos['oficio']);
           oci_bind_by_name($querys, ":PAFOLIO",$datos['folio']);
           oci_bind_by_name($querys, ":PAANIOEXP",$datos['anioexp']);
           oci_bind_by_name($querys, ":PAANIOFOL",$datos['aniofolio']);
           oci_bind_by_name($querys, ":VAESTATUS",$datos['estatus']);
           oci_bind_by_name($querys, ":PATIP_JUI",$datos['tipjui']);
           
           //----- parametros de salida //  
           oci_bind_by_name($querys, ':VAVALIDA', $vasalida,5);// no se a que se hace referencia el numero
           oci_bind_by_name($querys, ":CURSORBUSQUEDA", $cursor,-1,OCI_B_CURSOR );
       
           oci_execute($querys);
           oci_execute($cursor);
        
           return array($vasalida,$cursor);
      }
      public function Buspers($id_sol)// a que funcion hace referencia a VerificarDatos
      {
          /*Método que trae las personas registradas para la solicitud enviada
         * Parametros Entrada: id_solicitud
         * Parametros de Salida: Cursor con la información de las personas de la solicitud.
         */
          $query= oci_parse($this->db->conn_id,"SELECT CECOFAM_P.PACONSULTAS.FNBUSPERS('".$id_sol."') AS mfrc FROM dual");
          oci_execute($query);
          
          return $query;
      }
}

