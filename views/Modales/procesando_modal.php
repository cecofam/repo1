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
            
            <b> <img src="<?php echo site_url('images/reloj.jpg')?>" width="50"> <font color="#52857D">Por favor, espere un momento...</font></b><hr/>
            <center>
                <img src="<?php echo site_url('images/procesando.gif')?>" > 
                <br/>
                  <?= $mensaje //parámetro?>
             </center>
            </div> 
           <div  class="backgroundError"></div>
          
    </body>     
</html>