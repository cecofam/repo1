<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <title>Inactividad</title>
   <link rel="stylesheet" type="text/css" href="<?php echo site_url('/styles/principal.css');?>">        
   <link href="<?php echo site_url('bootstrap/css/bootstrap.css')?>" rel="stylesheet" >
   <script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/registro.js') ?>"></script>
   <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
    </head>
    <body>
        
    <div class="contenido">
        <center><fieldset class="fieldSet">            
            <h3 class="page-header"> <center><b>Sesi&oacute;n Cerrada por Inactividad</b></center></h3>
            <img src="<?php echo site_url("images/usuarios.png");?>" width="120"><br/>
            Su sesi&oacute;n ha sido cerrada por inactividad, por favor de click en el siguiente enlace para
                   ingresar nuevamente al sistema:<br><br>
                   
                   <b><a class="liga" href ="<?php echo base_url().'index.php/Frames/salir'?>" target='_parent' >Ingresar nuevamente al Sistema</a></b>
              
                     <br/>
            
            </fieldset></center>
            
        </div>
        
    </body>
</html>
