
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
        <img src="<?php echo site_url('images/error.png')?>" height='35' width='30'> <b><font color="#137799">Operaci&oacuten Rechazada</font></b>
            <hr/>
            <br/>
            <b class="mesageError"><?=$subtitulo?></b>
            <br/>
              
            <center><input type="button" id="close" value ="Aceptar"  onclick=" location='<?php echo base_url().$url; ?>';"/></div></center>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>