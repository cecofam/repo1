<html>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css'); ?>"/>
    <script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js'); ?>"></script>
    <script   type="text/javascript" src="<?php echo site_url('scripts/registro.js') ?>"></script>
    <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<body>
    <div id="error" class="error">
        <img src="<?php echo site_url('images/iconos/warning.png')?> "width='30' align="center"> <b><font color="#374917"><?= $titulo ?></font></b>
            <hr/>
            <label>Operaci&oacute;n a realizar: &nbsp;<b><?= $mensaje1 ?></b></label><br/><br />
            <?= $mensaje2 ?><br /><br />
            <b><?= $mensaje3 ?></b><br /><br />
            <center>
                <input type="button" id="aceptar" value ="Aceptar"  onclick="CierraError();"/>
                <input type="button" id="cancelar" value ="Cancelar" onclick="location='<?php echo base_url().$url; ?>';"/>
            </center>
        </div> 
       <div id="error-background" class="backgroundError"></div>
</body>