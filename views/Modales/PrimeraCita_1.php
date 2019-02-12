
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="error">
        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='35'> <b>Primera Cita</font></b>
            <hr/>
        <?=form_open(base_url().'index.php/Primer_enc/Primer_enc_c/registro');?>
            <center>
            <br/>
             <b><?= $mensaje.$fechafinal ?><br/><br/>
               <?= $mensaje1 ?></b><br/><br/>
             <?php  echo "<input type='HIDDEN'  name='FECHAFI'              id='FECHAFI' value='$fechafinal'>";?>  
             <?php  echo "<input type='HIDDEN'  name='idPARTE'              id='idPARTE' value='$idPARTE'>";?>  
            <select class="form-control" style="width:250px" required name="ID" id="ID"/>                              
                        <option value="">Seleccione</option>  
                          <?php 
                                while($respuesta = oci_fetch_array($trabajadores, OCI_ASSOC)){
                                      $indice=$respuesta['MFRC'];
                                      oci_execute($indice);
                                  while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                        $id   =$arr['ID'];
                                        $nombre = $arr['NOMBRE'];
                                                echo" <option value =\"$id\" >$nombre.'tiene citas agendadas en ese dia'</option>";     
                                            
                                        }
                                    }	
                                     ?>
                                </select>  
              
            </center>  
            
              <center>
                   <br/> <br/>
                  <table>
                      <tr>
                          <td><button type="SUBMIT" id="close" value ="" class="btn btn-default active"/>Aceptar</button></td>
                           <td>&nbsp;&nbsp;</td>   <?= form_close();?>
                          <td> <button type="button" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Cerra</button></td>
                      </tr>
                  </table>
              </center>    
        </div> 
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>