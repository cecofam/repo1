
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
        <img src="<?php echo site_url('images/ayuda.jpg')?>" height='35' width='30'>
            <hr/>
            <label>Operaci&oacute;n a realizar: &nbsp;<b><?= $mensaje1 ?></b></label><br/><br />
            <?= $mensaje2 ?><br /><br />
            <b><?= $mensaje3 ?></b><br /><br />
            <center>
            <input type="button" id="close" value ="Aceptar"  onclick="Closecorrecto();location='<?php echo base_url().$url; ?>';"/>
            <input type="button" id="close" value ="Cancelar"  onclick="Closecorrecto();location='<?php echo base_url('index.php/administrador/programas'); ?>'"/></div></center>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>