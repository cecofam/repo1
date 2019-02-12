<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
   
<body>
    <div  class="error">
        <img src="<?php echo site_url('images/correcto.png')?>" height='35' width='30'> <b><font color="#137799">Operaci&oacuten Completa</font></b>
            <hr/>
            <label>Se enviar&aacute; un correo electr&oacute;nico a:<br/><br/>
                        <b> <?php echo $nombre?></b><br/><br/>
                        Correo: <?php echo $correo?><br/><br/>
                         Notificandole que no ha sido aceptado en la
                          oferta educativa.</label><br/><br/>
                          <?= form_open(base_url().'index.php/candidatos/cand_estatus/actualizaEstatus?acep=1&idAlumno='.$idalumno.'&idCurso='.$idcurso.'&nombre='.$nombre.'&correo='.$correo.'&estatus='.$estatus,array('name'=>'rechazados',
                                                                                                  'id'=>'rechazados'
                                                                                                  ));?>       
                           <table>
                        <tr>
                            <td><?= form_label('Por el siguiente motivo:','');?></td>
                            <td><select id="motivos" name="motivos">
                                   <?php 
                                  
                                      echo " <option value='0'> Seleccione</option>"; 
                                      
                                      while($respuesta = oci_fetch_array($requisitos, OCI_ASSOC)){
                                            $indice=$respuesta['MFRC'];
                                            oci_execute($indice);
                                            while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                                $idreq=$arr['IDMOT'];
                                                $descripcion =$arr['DESCMOT'];
                                           echo" <option value =\"$idreq\" >$descripcion</option>";  
                                              
                                            }
                                          }	   
                                   
                                     ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                     <td><?= form_label('Observaciones:');?></td>
                     <td><textarea name="observ" rows="10" cols="40"></textarea></td>
                     </tr>
                     
                 
                </table>
            <br/>
            
            <center>
                        <input type="submit" id="close" value ="Aceptar"  onclick=" location='<?php echo base_url().$url; ?>';"/>
                        <input type="button" id="close" value ="Cancelar"  onclick=" location='<?php echo base_url().$url; ?>';">
                    </center>  
           <?= form_close()?>
        </div> 
       <div  class="backgroundError"></div>
</body>     
  </html>