
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('css/modales.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#137799">Operaci&oacuten Completa</font></b>
            <hr/>
            <br/>
            <b class="mesageError">Operaci&oacute;n generada con &eacute;xito</b>
            <br/>
              <?= $mensaje ?>
            <center><input type="button" id="close" value ="Aceptar"  onclick=" location='<?php echo base_url().$url; ?>';"/></div></center>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>