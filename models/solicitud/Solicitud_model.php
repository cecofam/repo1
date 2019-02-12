<?php

/* 
 * DESCRIPCIÓN: MODELO PARA LA VISTA DE PSICOLOGOS
 * FECHA: 21 DE AGOSTO DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION AGOSTO 2018
 */

Class Solicitud_model extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    
    public function Reg_solicitud($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PAREGISTRAR.PSSOLICITUD(:PAID_JUZSEC, :PAID_PRO, :PATOCA, :PAMOTIVO, :PAEXPEDIENTE, :PAOFICIO, :PAIDTIPJUI, :PAUSUARIO_CREA, :PAANIO_TOCA_EXP, :PAANIOFOLIO, :PAFEC_OFICIO, :PAULTIDSOL, :PAVALIDA);END;';
           
        $valida="";
        $vaidsol="";
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query 
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PAID_JUZSEC",$datos['id_juzse']);
           oci_bind_by_name($querys, ":PAID_PRO",$datos['juzsal']);
           oci_bind_by_name($querys, ":PATOCA",$datos['toc']);
           oci_bind_by_name($querys, ":PAMOTIVO",$datos['motref']);
           oci_bind_by_name($querys, ":PAEXPEDIENTE",$datos['exp']);
           oci_bind_by_name($querys, ":PAOFICIO",$datos['oficio']);
           oci_bind_by_name($querys, ":PAIDTIPJUI",$datos['tipjuc']);
           oci_bind_by_name($querys, ":PAUSUARIO_CREA",$datos['idUser']);
           oci_bind_by_name($querys, ":PAANIO_TOCA_EXP",$datos['anioexp']);
           oci_bind_by_name($querys, ":PAANIOFOLIO",$datos['anio']);
           oci_bind_by_name($querys, ":PAFEC_OFICIO",$datos['fec_oficio']);

           //----- parametros de salida //  
           oci_bind_by_name($querys, ':PAULTIDSOL', $vaidsol,5);// no se a que se hace referencia el numero
           oci_bind_by_name($querys, ':PAVALIDA', $valida,5);// no se a que se hace referencia el numero
           oci_execute($querys);
           return array($valida,$vaidsol);
        
      }
      public function consnum($id_perfil)
      {
            $sql = "SELECT CECOFAM_P.PACONSULTAS.FNNUMORG ('".$id_perfil."') AS mfrc FROM dual";
            $querys = oci_parse($this->db->conn_id,$sql);
            oci_execute($querys);

            return $querys;
      }
      public function Reg_personas($datos)// a que funcion hace referencia a VerificarDatos
      {

        $sql='BEGIN CECOFAM_P.PAREGISTRAR.PSPERSONA(:PAID_SOLICITUD, :PANOMBRE, :PAAPELLIDO_P, :PAAPELLIDO_M, :PASEXO, :PAUSUARIO_CREACION, :PAUSUARIO_MODIFICACION, :PATIPO_PERS, :PACUST, :PAFEC_NAC, :PAVALIDA);END;';
        
        $valida="";    
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query 
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
           oci_bind_by_name($querys, ":PAID_SOLICITUD",$datos['idsol']);
           oci_bind_by_name($querys, ":PANOMBRE",$datos['nom']);
           oci_bind_by_name($querys, ":PAAPELLIDO_P",$datos['ap']);
           oci_bind_by_name($querys, ":PAAPELLIDO_M",$datos['am']);
           oci_bind_by_name($querys, ":PASEXO",$datos['sex']);
           oci_bind_by_name($querys, ":PAUSUARIO_CREACION",$datos['idUser']);
           oci_bind_by_name($querys, ":PAUSUARIO_MODIFICACION",$datos['idUser']);
           oci_bind_by_name($querys, ":PATIPO_PERS",$datos['per']);
           oci_bind_by_name($querys, ":PACUST",$datos['cust']);
           oci_bind_by_name($querys, ":PAFEC_NAC",$datos['fec_nac']);

           //----- parametros de salida //  
           oci_bind_by_name($querys, ':PAVALIDA', $valida,5);// no se a que se hace referencia el numero
           oci_execute($querys);
           return $valida;
        
       }
       public function DifJuicios($id_tj)
       {
            $sql='BEGIN CECOFAM_P.PACONSULTAS.SPDIF_JUICIOS(:PATIPJUI, :CURSORDJ);END;';
        
            $valida="";    
            $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query 
             //----- parametros de entrada-------///
             //remplazo de las variables del SP con las variables de PHP
             oci_bind_by_name($querys, ":PATIPJUI",$id_tj);
             

             //----- parametros de salida //  
             oci_bind_by_name($querys, ":CURSORDJ", $cursor,-1,OCI_B_CURSOR );
             oci_execute($querys);
             return $valida;
       }
}

