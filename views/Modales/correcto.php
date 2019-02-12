
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
    <div  class="modalstyled">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#52857D">Operaci&oacuten Completa</font></b>
            <hr/>
      
            <b class="mesageError"><?= $titulo ?></b>
            <br/>
              <?= $mensaje ?><br/><br/>
            <center><input type="button" id="close" value ="Aceptar"  onclick="Closecorrecto();"/></div></center>
        </div> 
       <div  class="modal-background"></div>
</body>     
  </html>