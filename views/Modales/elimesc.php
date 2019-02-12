<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
	<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
	<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
        <script   type="text/javascript" src="<?php echo site_url('scripts/funciones_validaciones.js') ?>"></script>
</head>   
	<body>
            <?=  form_open(base_url().'index.php/administrador/escuelas/elimiar_escuela?actua=1',array('name'=>'elimesc',
                                                                                'id'=>'elimesc', 
                                                                                'autocomplete' => 'off'));?>
		<div id="eliminar" class="error" >
                    <b><font size="2.5" color="red">Eliminar Escuela</font></b>
				<hr/>

                                <font size="2.5">&iquest;Esta seguro de dar de baja la escuela <b><?php echo $descescuela ?></b>?</font><br/><br/>
                                <font size="2.5">Si es así, oprima el botón continuar. </font><br/><br/>
                                <input type="hidden" class="form-control" name="idesc" id="idesc" value="<?php echo $idescuela?>" >
                                <input type="hidden" class="form-control" name="nomesc" id="nomesc" value="<?php echo $descescuela?>" >
                                
                                <br/>
                                
                                <center><input type="submit" id="close" value ="Continuar" onclick="<?= $onclick ?>"/>
                                <?= form_close();?>       
                           <input type="button" id="close" value ="Cancelar"  onclick="<?= $onclick ?>"/></center>
			</div> 
		   <div id="eliminar-background" class="backgroundError"></div>
	</body>
</html>