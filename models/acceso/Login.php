<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * DESCRIPCION: Modelo que ejecuta el SP para ingresar al sistema
 * FECHA: 31 ENERO 2014
 * SISTEMA: Control Escolar IEJ
 * MODIFICACION: enero 2015
 * 
 */

class Login extends CI_Model 
{
   public function __construct() 
    {
        parent::__construct();
    } 
   public function acceso($datos){
       
        /*
         *  Método que ejecuta el SP para ingrear al sistem,a.
         *  Parámetros de Entrada: Arreglo que contiene los valores del formulario
         *  Parámetros de Salida: Regresa 1/0 si se ejecuto correctamente el SP 
         */
       $sql='BEGIN CECOFAM_P.PAVALIDAR.PSLOGIN (:PAUSUARIO,:PACLAVE,:VAVALIDA,:VACURPRIV);END;';
       
       $pavalida="";       
       $querys= oci_parse($this->db->conn_id,$sql);//ejecutamos el query
       $cursor=  oci_new_cursor($this->db->conn_id);//declaramos cursos
       //----- parametros de entrada-------///
       //remplazo de las variables del SP con las variables de PHP
       oci_bind_by_name($querys, ":PAUSUARIO",$datos['usuario']);   
       oci_bind_by_name($querys, ":PACLAVE",$datos['pass']);
       //----- parametros de salida //  
       oci_bind_by_name($querys, ':VACURPRIV', $cursor,-1,OCI_B_CURSOR );
       oci_bind_by_name($querys, ':VAVALIDA', $pavalida,30);
       
       oci_execute($querys);
       oci_execute($cursor);
       
       
       
        while($data = oci_fetch_array($cursor)){
            
            switch ($data){
                //Los dos valores son cero, entonces el usuario  y la contraseña son inválidos
                case $data[0] == 0 && $data[1]== 0:
                     $validauser= 0;
                     return array($validauser,0,0,0,0,0);  
                     break;   
                  //La contraseña es incorrecta
                case $data[1] == 0:
                    $validauser= "-1";
                    return array($validauser,0,0,0,0,0); 
                    break;
                //el usuario y password son corret 
              case $data[1] > 0:
                  $validauser= 1; //La bandera se coloca en 1, si existe el usuario
                  $idUser=$data[0];//id de usuario
                  $rol   =$data[1];//rol del usuario
                 
               return array($validauser,$idUser,$rol);  
            }
        }//cierra el while
    }
 }
?>
