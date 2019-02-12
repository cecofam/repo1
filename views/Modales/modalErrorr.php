<html lang="en">
    <meta charset="utf-8" />
    
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/registro.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   <script   src="<?php echo site_url('bootstrap/calendario/js/bootstrap-datetimepicker.js')?>" charset="UTF-8"></script>
         <script   src="<?php echo site_url('bootstrap/calendario/js/locales/bootstrap-datetimepicker.es.js')?>"charset="UTF-8" ></script>
         <link href="<?php echo site_url('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">
         <link href="<?php echo site_url('bootstrap/css/main.css')?>" rel="stylesheet">
         <link href="<?php echo site_url('bootstrap/calendario/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">  
<body>
    <div id="error" class="error">
        <img src="<?php echo site_url('images/error.png')?>"> <b><font color="red">Operaci&oacuten Rechazada</font></b>
            <hr/>
            <b >&iquest;Qu&eacute; puedo hacer?</b><br/>
            <b class="mesageError"><?=$subtitulo?></b>
                <?= $mensaje ?>
            <center>
           <button type="button" id="close" name="btnGuardar" value="" onclick="Closecorrecto(); location='<?php echo base_url().$url; ?>';" class="btn btn-default active">Aceptar</button>
            </div></center>
        </div> 
       <div id="error-background" class="backgroundError"></div>
</body>