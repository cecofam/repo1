<?
/*
 * DESCRIPCIÓN : Esta vista tiene el estilo de una ventana modal, la cual es utilizada para mostrar mensajes de error personalizados, 
 *               recibe, un subtitutlo, un mensake y el método a realizar en el boton aceptar; que por lo regular se llama a CierraError
 *               el cual oculta la ventana modal.
 * FECHA: 02 JUNIO 2014
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
			<img src="<?php echo site_url('images/error.png')?>"> <b><font color="red">Operaci&oacuten Rechazada</font></b>
				<hr/>
				<b >¿Qu&eacute; puedo hacer?</b><br/>
				<b class="mesageError"><?=$subtitulo?></b><br/>
				<label> <?= $mensaje;?></label><br/><br/>
				<center><input type="button" id="close" value ="Aceptar"  onclick=" location='<?php echo base_url().$url; ?>';"/></div></center>
			</div> 
		   <div id="error-background" class="backgroundError"></div>
	</body>
</html>


