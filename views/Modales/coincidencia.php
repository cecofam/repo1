<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
	<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
	<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
</head>   
	<body>
		<div id="error" class="error">
                    <b><font color="red">Se encontraron las siguientes coincidencias</font></b>
				<!--<hr/>-->
                                <br>
                                <br>
                                <?=  form_open(base_url().$url2,array('name'=>'busc',
                                                                                'id'=>'busc', 
                                                                                'autocomplete' => 'off'));?>
                                <b >&iquest;<?php echo $mensaje ?> <?php 
                                while ($datos = oci_fetch_array($opcionseleccionada)){
                                    $idotracarrera = $datos[0];
                                    $descotracarrera = $datos[1];
                                    echo $idotracarrera.$descotracarrera;
                                    }
                                ?> que desea agregar se encuentra dentro de la siguiente lista?</b><br/><br/>
                                ■ Si se encuentra <b>selecciónela</b> y oprima el botón actualizar.<br/>
                                ■ Si no se encuentra oprima el botón agregar.<br/><br/>
                                <select class='form-control' name='cdescripcion' id='cdescripcion'/>
                                <option value="" selected="selected">Seleccione</option>
                                <?php
                                    while ($datos = oci_fetch_array($cursor)){
                                    $iddesc = $datos[0];
                                    $desc = $datos[1];
                                    echo'<option value ="'.$iddesc.'">'.$iddesc.$desc.'</option>';
                                    }           
                                ?>
                                </select>
                                <br/>
                                <!--<center><input type="button" id="close" value ="Actualizar"  onclick="<?//= $onclick ?> location='<?php //echo base_url().$url2."?iddesc=".$iddesc; ?>'"/>-->
                                <center><input type="submit" id="close" value ="Actualizar"  onclick="<?= $onclick ?>"/>
                                <?= form_close();?>  
                                <input type="button" id="close" value ="Agregar"  onclick="<?= $onclick ?> location='<?php echo base_url().$url; ?>'"/>
				<input type="button" id="close" value ="Cancelar"  onclick="<?= $onclick ?> "/></center>
			</div> 
		   <div id="error-background" class="backgroundError"></div>
	</body>
</html>