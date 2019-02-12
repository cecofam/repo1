<html>
    <head> 
       <link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
       <script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
       <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
    </head>
    <?php //form_open(base_url().'index.php/Admin/registro_casos/generaOficioPreregG');?>  
    
    <body>
        <form action ="<?php echo base_url().$url?>" onsubmit="return <?= $onclick; ?>"/>
        <div  id="error" class="error">
            <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#ABBA8C"><b>Operaci&oacute;n Completa</b></font></b>
            <hr/>
            <b class="mesageError">Operaci&oacute;n generada con &eacute;xito</b>
            <br/><br/>
            <?= $mensaje ?>           
            <input type="hidden" id="datoscaso" name="datoscaso" value="<?php echo base64_encode(serialize($datos));?>"><br><br>
           <input type="hidden" id="condatos" name="condatos" value="<?php echo $condatos;?>"><br><br>
<!--            <center><a href="<?php //echo $ruta ?>"><img src="<?php //echo $pdf ?>"></a><br></center>-->

            <center><input type=image width="48" height="48" src="<?php echo site_url('images/iconos/word_icon.png');?>" id='btnActOf' name='btnActOf'></center>
            <!--<center><input type="submit" name="agreg" id="agreg" value ="Generar Oficio"/>-->
        </div>
    </form>
        <div id="error-background" class="backgroundError" ></div>   
        
    </body>  
    <?php // form_close();?>  
</html>