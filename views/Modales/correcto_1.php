
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="error">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#52857D">Operaci&oacuten Completa</font></b>
            <hr/>
      
            <b class="mesageError"><?= $titulo ?></b>
            <br/>
              <?= $mensaje ?><br/><br/>
              <center><button type="button" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Aceptar</button></center>
        </div> 
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>