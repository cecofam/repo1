
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('/styles/principal.css');?>">        
   <link href="<?php echo site_url('bootstrap/css/bootstrap.css')?>" rel="stylesheet" >
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='30'> &nbsp; &nbsp;<b><font color="#460054"><b>Operaci&oacute;n Completa</b></font></b>
            <hr/>
            <br/>
            <b class="mesageError">Operaci&oacute;n generada con &eacute;xito</b>
            <br/>
              <?= $mensaje ?>
            
            <center>    
                <button type="button" id="close" name="btnGuardar" value="" onclick="Closecorrecto(); location='<?php echo base_url().$url; ?>';" class="btn btn-default active">Aceptar</button>
              </center>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>