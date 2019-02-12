
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="cotejo">

        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='35'> <b>Cotejo</font></b>
            <hr/>
      <?=form_open(base_url().'index.php/Documentos/cotejo_c/OFICIOINASISTENCIA');?>    
            <hr/>
            <b class="mesageError"><?= $mensaje ?></b>
            <?php    echo "<input type='HIDDEN'  name='asist'       id='asist' value='$asist'>";?>
            <center>
                 
             <button type="submit" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Cerrar</button>
        <?= form_close();?>
            
    
   
        </div> 
        <div id="error-background" class="backgroundError"></div>
   
</body>     
  </html>
  