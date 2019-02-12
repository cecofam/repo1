<html lang="en">
    <meta charset="utf-8" />
    
   <link rel="stylesheet" type="text/css" href="<?php echo site_url('/styles/principal.css');?>">        
   <link href="<?php echo site_url('bootstrap/css/bootstrap.css')?>" rel="stylesheet" >
   <script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/registro.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
    
<body>
    <div id="error" class="error">
        <img src="<?php echo site_url('images/error.png')?>"> <b><font color="red">Operaci&oacuten Rechazada</font></b>
            <hr/>
            <b >&iquest;Qu&eacute; puedo hacer?</b><br/>
            <b class="mesageError">Favor de capturar los siguientes campos.</b>
                <?= validation_errors(); ?>
            <center>
           <button type="button" id="close" name="" value="" onclick="CierraError();" class="btn btn-default active">Aceptar</button>
            </div></center>
        </div> 
       <div id="error-background" class="backgroundError"></div>
</body>