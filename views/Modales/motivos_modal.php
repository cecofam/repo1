<?
/*
 * DESCRIPCIÓN : Esta vista tiene el estilo de una ventana modal, la cual es utilizada para mostrar los motivos por el cual un candidato fue rechazado, 
 *               recibe, un subtitutlo, un mensaje y el método a realizar en el boton aceptar; que por lo regular se llama a CierraError
 *               el cual oculta la ventana modal.
 * FECHA: 14 AGOSTO 2015
 * SISTEMA: Control Escolar IEJ
 *  
 * 
 */
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
	<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
	<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
</head>   
	<body>
		<div id="error" class="error">
                        <td><label>Seleccione el motivo por el cual fue rechazado:</label></td>
                                   <td><select id="mot" name="mot">
                                   <?php 
                                  
                                      echo "<option value='0'> Seleccione</option>";
                                      
                                      while($respuesta = oci_fetch_array($requisitos, OCI_ASSOC)){
                                            $indice=$respuesta['MFRC'];
                                            oci_execute($indice);
                                            while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                                $idreq=$arr['IDREQ'];
                                                $descripcion =$arr['REQDOC'];
                                           echo" <option value =\"$idreq\" >$descripcion</option>";  
                                              
                                            }
                                          }	   
                                   
                                     ?>
				<hr/>
				<b >¿Qu&eacute; puedo hacer?</b><br/>
				<b class="mesageError"><?=$subtitulo?></b><br/>
				<label> <?= $mensaje;?></label><br/><br/>
				<center><input type="button" id="close" value ="Aceptar"  onclick=" location='<?php echo base_url().$url; ?>';"/></div></center>
			</div> 
		   <div id="error-background" class="backgroundError"></div>
	</body>
</html>
