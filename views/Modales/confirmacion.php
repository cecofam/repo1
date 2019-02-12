
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="modalstyled">
        <img src="<?php echo site_url('images/ayuda.jpg')?>" height='35' width='30'> <b><font color="#137799">Confirmaci&oacute;n</font></b>
            <hr/>
            <b class="mesageError"><?= $mensaje ?></b>
            <center>
            <input type="button" id="close" value ="Aceptar"  onclick="<?=$onclick?>;"/>
            <input type="button" id="close" value ="Cancelar"  onclick="Closecorrecto();"/></div></center>
        </div> 
       <div  class="modal-background"></div>
</body>     
  </html>