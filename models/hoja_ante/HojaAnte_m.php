<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class HojaAnte_m extends CI_Model
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
    
    public function tipJui($aux){
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNJUICIOS_SOL('".$aux."') AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        return $querys;
           
    }
    
    public function religion(){
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNRELIGION() AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        $seleRelig="<select class='form-control' name='religion' id='religion'>".
                   "<option value=''>Seleccione...</option>";
        
        while($respuesta = oci_fetch_array($querys, OCI_ASSOC)){
              $indice=$respuesta['MFRC'];
              oci_execute($indice);
              while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                    $idRel   =$arr['ID'];
                    $religion =$arr['RELI'];
                    $seleRelig.="<option value='".$idRel."'>".$religion."</option>";                          
              }
        }
        $seleRelig.="</select>";
        return $seleRelig;
           
    }
    public function escol(){
        $sql = "SELECT CECOFAM_P.PACONSULTAS.FNESCOLARIDAD() AS mfrc FROM dual";
        $querys = oci_parse($this->db->conn_id,$sql);
        oci_execute($querys);
        
        $seleRelig="<select class='form-control' name='escola' id='escola'>".
                   "<option value=''>Seleccione...</option>";
        
        while($respuesta = oci_fetch_array($querys, OCI_ASSOC)){
              $indice=$respuesta['MFRC'];
              oci_execute($indice);
              while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                    $idesc   =$arr['ID'];
                    $escol =$arr['ESCOL'];
                    $seleRelig.="<option value='".$idesc."'>".$escol."</option>";                          
              }
        }
        $seleRelig.="</select>";
        return $seleRelig;
           
    }
    
    public function municipios($id)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPMUNICIPIOS(:PAENT, :VACURMUNICI);END;';
        $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
        $cursor = oci_new_cursor($this->db->conn_id);
        $vasalida=0;
           
         //----- parametros de entrada-------///
         //remplazo de las variables del SP con las variables de PHP
         oci_bind_by_name($querys, ":PAENT",$id);
           
           
         //----- parametros de salida //  
         oci_bind_by_name($querys, ":VACURMUNICI", $cursor,-1,OCI_B_CURSOR );
       
         oci_execute($querys);
         oci_execute($cursor);
        
         return $cursor;
      }
      //********************************************************************************************************************************************       
   public function RegHA($datos)// a que funcion hace referencia a VerificarDatos
    {

        $sql='BEGIN CECOFAM_P.PACONSULTAS.SPCON_SOL(:PATOCA, :PAEXPEDIENTE, :PAOFICIO, :PAFOLIO, :PAANIOEXP, :PAANIOFOL, :VAESTATUS, :PATIP_JUI, :VAVALIDA, :CURSORBUSQUEDA);END;';
        
        CECOFAM_P.PAREGISTRAR.REGDATGRAL (PAIDSOL         => var_PAIDSOL,
                                      PAIDPERSONA     => var_PAIDPERSONA,
                                      PAUSUARIO       => var_PAUSUARIO,
                                      PAEDAD          => var_PAEDAD,
                                      PAFEC_NAC       => var_PAFEC_NAC,
                                      PATELCASA       => var_PATELCASA,
                                      PATELMOVIL      => var_PATELMOVIL,
                                      PAENT_FED       => var_PAENT_FED,
                                      PAMUNALC        => var_PAMUNALC,
                                      PANACION        => var_PANACION,
                                      PARELIGION      => var_PARELIGION,
                                      PAESTCIVIL      => var_PAESTCIVIL,
                                      PAESCOLARI      => var_PAESCOLARI,
                                      PAACTVLAB       => var_PAACTVLAB,
                                      PAHORLAB        => var_PAHORLAB,
                                      PANUMHIJ        => var_PANUMHIJ,
                                      PAEVA_PS        => var_PAEVA_PS,
                                      PAPEREPS        => var_PAPEREPS,
                                      PAFECEVAL       => var_PAFECEVAL,
                                      PALUGEVA        => var_PALUGEVA,
                                      PATERAPS        => var_PATERAPS,
                                      PAPERTPS        => var_PAPERTPS,
                                      PAPERIOTPS      => var_PAPERIOTPS,
                                      PALUGARTPS      => var_PALUGARTPS,
                                      PAVALOMPS       => var_PAVALOMPS,
                                      PAPERVALPS      => var_PAPERVALPS,
                                      PAFECVALO       => var_PAFECVALO,
                                      PALUGVALO       => var_PALUGVALO,
                                      PADIAGVAL       => var_PADIAGVAL,
                                      PAMEDVAL        => var_PAMEDVAL,
                                      PAFRECMEDVAL    => var_PAFRECMEDVAL,
                                      PAENFCRODEGE    => var_PAENFCRODEGE,
                                      PAPERCRODEGE    => var_PAPERCRODEGE,
                                      PADIAGCRODEGE   => var_PADIAGCRODEGE,
                                      PAMEDCRONDEGE   => var_PAMEDCRONDEGE,
                                      PAFMCRONDEGE    => var_PAFMCRONDEGE,
                                      PAALERGIAS      => var_PAALERGIAS,
                                      PAPERALERGIAS   => var_PAPERALERGIAS,
                                      PAESPEALERGIA   => var_PAESPEALERGIA,
                                      PASERVMED       => var_PASERVMED,
                                      PAPERSSM        => var_PAPERSSM,
                                      PAESPECSM       => var_PAESPECSM,
                                      PAEMERGEN       => var_PAEMERGEN,
                                      PATELEMER       => var_PATELEMER,
                                      PAGUARCUST      => var_PAGUARCUST,
                                      PAPENSION       => var_PAPENSION,
                                      PAREGVISITAS    => var_PAREGVISITAS,
                                      PAVISITASFAV    => var_PAVISITASFAV,
                                      PAVISILDH       => var_PAVISILDH,
                                      PADATPROJUR     => var_PADATPROJUR,
                                      PACONPROJUD     => var_PACONPROJUD,
                                      PAINFHIJOS      => var_PAINFHIJOS,
                                      PAACUERDOS      => var_PAACUERDOS,
                                      PACUALACUERD    => var_PACUALACUERD,
                                      PACUMPACUER     => var_PACUMPACUER,
                                      PACAUSASACU     => var_PACAUSASACU,
                                      PAOTROSPROC     => var_PAOTROSPROC,
                                      VAVALIDA        => var_VAVALIDA);
        
        
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
  
    
}