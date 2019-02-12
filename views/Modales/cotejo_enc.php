<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
    <?=form_open(base_url().'index.php/Primer_enc/Primer_enc_c/modal');?>
   <div id="error" class="error">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#52857D">Operaci&oacuten Completa</font></b>
            <hr/><?php    
                               
                               echo "<input type='HIDDEN'  name='FFIN'       id='FFIN' value='$FFIN'>"
                                  . "<input type='HIDDEN'  name='NTS'      id='NTS' value='$NTS'>";?> 
      
            <b class="mesageError"><?= $titulo ?></b>
            <br/>
              <?= $mensaje ?><br/><br/>
              <center><button type="submit" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Aceptar</button></center>
        </div> 
    <?= form_close();?>
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>