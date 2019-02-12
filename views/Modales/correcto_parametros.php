<?php

/*
 * DESCRIPCIÓN: Modal que envia Parametros para regresar a ver los candidatos de un curso, el parametro es el id del curso, esta ventana será
 *                un pequeño formulario.
 * FECHA CREACIÓN: 28 DE MAYO 2014
 * SISTEMA: CONTROL ESCOLAR IEJ
 */
?>


<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   
    <div  class="error">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#52857D">Operaci&oacuten Completa</font></b>
            <hr/>
      
            <b class="mesageError"><?= $titulo ?></b>
            <br/>
          <?= $mensaje ?><br/><br/>
              
              <?= form_open(base_url().'index.php/candidatos/preInscrip',array('name'=>'aceptados',
                                                                                                  'id'=>'aceptados'
                                                                                                  ));?>  
             <input type="hidden" name="idcurso" id="idcurso" value="<?= $idcurso?>"  
              
            <center><input type="submit" id="close" name="close" value ="Aceptar"/></center></div>
           <?=form_close();?> 
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>
