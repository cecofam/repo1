
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
       <img src="<?php echo site_url('images/error.png')?>"> <b><font color="red">Operaci&oacuten Rechazada</font></b>
            <hr/>
                                <b >&iquest;Qu&eacute; puedo hacer?</b><br/>
				<b class="mesageError"><?=$subtitulo?></b><br/>
				<label> <?= $mensaje;?></label><br/><br/>
                        <center><button type="button" id="close" value =""  class="btn btn-default active" onclick="Closecorrecto(); 
                     location='<?php echo base_url().$url; ?>';"/>Aceptar</button></center>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>
