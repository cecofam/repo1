<?php

/* 
 * DESCRIPCIÓN: MODELO PARA Tipo de juicios
 * FECHA: 24 DE SEPTIEMBRE DE 2018
 * SISTEMA: CECOFAM
 * MODIFICACION 24 DE SEPTIEMBRE 2018
 */

Class TipoJuicios_model extends CI_Model
{
    public function _construct()
    {
        parent::_construct();
    }
    
    public function BuscatipoJui (){
        /*Método que trae los diferentes tipos de juicio
         * Parametros Entrada: juicio
         * Parametros de Salida: Cursor con la información de la dirección.
         */
        
        $query= oci_parse($this->db->conn_id,"SELECT CECOFAM_P.PACONSULTAS.FNTIPO_JUICIO( ) AS mfrc FROM dual");
        oci_execute($query);
        
        $selectTJ="<select class='form-control' name='tipjuc' id='tipjuc'>".
                   "<option value=''>Seleccione...</option>";
        
        while($respuesta = oci_fetch_array($query, OCI_ASSOC)){
              $indice=$respuesta['MFRC'];
              oci_execute($indice);
              while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                    $idtj   =$arr['ID_TJ'];
                    $juicio =$arr['JUICIO'];
                    $selectTJ.="<option value='".$idtj."'>".$juicio."</option>";                          
              }
        }
        $selectTJ.="</select>";
        return $selectTJ;
    }
    
    
}

