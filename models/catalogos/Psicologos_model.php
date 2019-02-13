<?php

/* 
 * DESCRIPCIÓN: MODELO PARA LA VISTA DE PSICOLOGOS
 * FECHA: 21 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */

Class Psicologos_model extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    
    public function BuscarPM($datos)// a que funcion hace referencia a VerificarDatos
    {
        $query= oci_parse($this->db->conn_id,"SELECT CECOFAM_P.PACONSULTAS.FNBUSPS('".$datos['appat']."','".$datos['apmat']."','".$datos['nombre']."','".$datos['iniciales']."','".$datos['cedula']."','".$datos['activo']."')AS mfrc FROM dual");
        //var_RetVal := CECOFAM_P.PACONSULTAS.FNBUSPS(PAPPAT => var_PAPPAT, PAPMAT => var_PAPMAT, PANOMBRE => var_PANOMBRE, PACEDULA => var_PACEDULA, PACTIVO => var_PACTIVO);
         oci_execute($query);
         return $query;        
             //oci_bind_by_name($querys, ':VACURSOR', $cursor,-1,OCI_B_CURSOR );
            //oci_execute($query);
           //oci_execute($cursor);   
          //      return $cursor;
    }
     public function EditarPM($datos)// a que funcion hace referencia a VerificarDatos
    {
       //$sql='UPDATE CECOFAM_P.PAREGISTRAR.SPEDITPS(:PAPPAT,:PAPMAT,:PANOMBRE,:PACEDULA,:PACTIVO,:PAVALIDAPS);END;';
        $sql='BEGIN CECOFAM_P.PAREGISTRAR.SPEDITPS(:PACVEPSICOLOGO, :PAPPAT, :PAPMAT, :PANOMBRE, :PAINICIALES, :PACEDULA, :PACTIVO, :PAFECHA_CREACION, :PAFECHA_ACTUALIZACION, :PAVALIDAPS);END;';
        //--- Call
//    CECOFAM_P.PAREGISTRAR.SPEDITPS (
//        PACVEPSICOLOGO          => var_PACVEPSICOLOGO,
//        PAPPAT                  => var_PAPPAT,
//        PAPMAT                  => var_PAPMAT,
//        PANOMBRE                => var_PANOMBRE,
//        PAINICIALES             => var_PAINICIALES,
//        PACEDULA                => var_PACEDULA,
//        PACTIVO                 => var_PACTIVO,
//        PAFECHA_CREACION        => var_PAFECHA_CREACION,
//        PAFECHA_ACTUALIZACION   => var_PAFECHA_ACTUALIZACION,
//        PAVALIDAPS              => var_PAVALIDAPS);

        $array['valida']="";
        $array['fechaActualizacion']="";
        $array['fecha_creacion']="";
        $querys= oci_parse($this->db->conn_id,$sql);
        //oci_bind_by_name($querys,":PACVEPSICOLOGO",$blanco);
        oci_bind_by_name($querys,":PACVEPSICOLOGO",$datos['cvepsicologo']);
        oci_bind_by_name($querys,":PAPPAT",$datos['appat']);
        oci_bind_by_name($querys,":PAPMAT",$datos['apmat']);
        oci_bind_by_name($querys,":PANOMBRE",$datos['nombre']);
        oci_bind_by_name($querys,":PAINICIALES",$datos['iniciales']);
        oci_bind_by_name($querys,":PACEDULA",$datos['cedula']);
        oci_bind_by_name($querys,":PACTIVO",$datos['activo']);
        oci_bind_by_name($querys,":PACTIVO",$datos['dasectivado']);
     // oci_bind_by_name($querys,":PAFECHA_CREACION",$datos['fecha_creacion']);
        oci_bind_by_name($querys,":PAFECHA_CREACION",$array['fecha_creacion'],50);
        oci_bind_by_name($querys,":PAFECHA_ACTUALIZACION",$array['fechaActualizacion'],50);
        
        oci_bind_by_name($querys,':PAVALIDAPS', $array['valida'], 30);
        oci_execute($querys);
        return $array;
      
        
        // return $datos['nombre'];
            
           
    }

}
