<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
	<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
	<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
        <script   type="text/javascript" src="<?php echo site_url('scripts/funciones_validaciones.js') ?>"></script>
</head>   
	<body>
            <?=  form_open(base_url().'index.php/administrador/programas/elimiar_prog?var=1',array('name'=>'elimprog',
                                                                                'id'=>'elimprog', 
                                                                                'autocomplete' => 'off'));?>
		<div id="eliminar" class="error" >
                    <b><font size="2.5" color="red">Dar de baja programa</font></b>
				<hr/>

                                <font size="2.5">&iquest;Esta seguro de dar de baja el programa <b><?php echo $descprograma ?></b>?</font><br/><br/>
                                <font size="2.5">Si es así, oprima el botón continuar. </font><br/><br/>
                                <input type="hidden" class="form-control" name="idprog" id="idprog" value="<?php echo $idprograma?>" >
                                <input type="hidden" class="form-control" name="nomprog" id="nomprog" value="<?php echo $descprograma?>" >
                                
                                <br/>
                                
                                <center><input type="submit" id="close" value ="Continuar" onclick="<?= $onclick ?>"/>
                                <?= form_close();?>       
                           <input type="button" id="close" value ="Cancelar"  onclick="<?= $onclick ?>"/></center>
			</div> 
		   <div id="eliminar-background" class="backgroundError"></div>
	</body>
</html>