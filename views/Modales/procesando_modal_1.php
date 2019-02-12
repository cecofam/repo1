<?php

/*
 * DESCRIPCIÓN: Esta vista tiene el estilo de una ventana modal, la cual se utilizará para cuado sea necesario mostrar el mensaje 
 *              de "procesando información" el mesaje puede ser perosonalizado dependiendo el uso
 *              Utiliza el estilo .Modal_process para el mensaje y modal-background para el fondo
 * FECHA: 31 ENERO 2014
 * SISTEMA: Control Escolar IEJ
 */
?>
<html>
    
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
    <body>
        <div  class="modalstyledcapt">
            
            <b> <img src="<?php echo site_url('images/iconos/aviso.png')?>" width="30"> <font color="#52857D">Por favor, espere un momento...</font></b><hr/>
            <center>
<div class="table-responsive" style="width:100%" id="descar" name="descar">              
 <div class="progress progress-striped active">
  <div class="progress-bar" role="progressbar"
       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
       style="width: 100%">
    <span class="sr-only">Descargando Documento</span>
  </div>
</div>
     </div> 
                <br/>
                  <?= $mensaje //parámetro?>
             </center>
            </div> 
           <div  class="backgroundError"></div>
    </body>     
</html>