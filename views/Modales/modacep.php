<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div class="error">
                <img src="<?php echo site_url('images/ayuda.jpg')?>" height='25' width='25' align="left"> <b><font color="#137799">Confirmaci&oacute;n de Inscripci&oacute;n</font></b>
                    <hr/>
                   <label>Se enviar&aacute; un correo electr&oacute;nico a:<br/><br/>
                        <b> <?php echo $nombre?></b><br/><br/>
                        Correo: <?php echo $correo?><br/><br/>
                        Notificandole que ha sido aceptado en la
                           oferta educativa.</label><br/><br/>
                         <label>Para confirmar de click en el bot&oacute;n Aceptar</label><br/><br/>
                   
               <?= form_open(base_url().'index.php/candidatos/cand_estatus/actualizaEstatus?acepinsc=1&idAlumno='.$idalumno.'&idCurso='.$idcurso.'&nombre='.$nombre.'&correo='.$correo.'&curso='.$curso.'&folio='.$folio.'&subarea='.$subarea.'&estatus='.$estatus,array('name'=>'aceptados',
                                                                                                  'id'=>'aceptados'
                                                                                                  ));?>    

                        <input type="submit" id="close" value ="Aceptar" onclick=" location='<?php echo base_url().$url; ?>';"/>
                        <input type="button" id="close" value ="Cancelar"  onclick=" location='<?php echo base_url().$url; ?>';"/>
                    </center>
                        
             <?= form_close()?>           
              </div>
       <div  class="backgroundError"></div>
</body>     
  </html>





