<html lang="en">
    <meta charset="utf-8" />
 <head>   
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/modales.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
 </head>  
<body>
    <div id="error" class="error fade in">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
            <img src="<?php echo site_url('images/error.png')?>">
            <code><b><font color="red">Operaci&oacuten Rechazada</font></b></code>
        </div>
        <div class="modal-body">
            <b >¿Qu&eacute; puedo hacer?</b><br/>
            <b>Favor de capturar los siguientes campos</b>
                <?= validation_errors(); ?>
        </div>    
            <center><input type="button" id="close" value ="Aceptar"  onclick="CierraError();"/></center>
        
    </div> 

       <div id="error-background" class="backgroundError"></div>
</body>
</html>