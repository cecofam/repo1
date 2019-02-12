
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="Pcita">
        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='35'> <b>Primera Cita</font></b>
            <hr/>
        <?=form_open(base_url().'index.php/Primer_enc/Primer_enc_c/registro');?>
            <center>
            <br/>
             <b><?= $mensaje.$fechafinal ?><br/><br/>
               <?= $mensaje1 ?></b><br/><br/>
             <?php  echo "<input type='HIDDEN'  name='FECHAFI'          id='FECHAFI' value='$fechafinal'>  ";?>  
             <?php  echo "<input type='HIDDEN'  name='NTS'              id='NTS' value='$NTS'>";?>   
            </center> <b><?= $mensaje12 ?></b><br/><br/><center>
                
                
               <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 100%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>N°</b></center></td>
                            <td style="vertical-align:middle"><center><b>NTS</b></center></td>
                            <td style="vertical-align:middle"><center><b>NOMBRE</b></center></td>
                            <td style="vertical-align:middle"><center><b>PARTE</b></center></td>
                            <td style="vertical-align:middle"><center><b>TRABAJADOR</b></center></td>
                            <td style="vertical-align:middle"><center><b>HORARIO</b></center></td>   
                        </tr> 
                       
                          <?php 
                           $param['fechaP']=   $fechafinal;
                            $countt=1;
                                while($respuesta = oci_fetch_array($PARTES, OCI_ASSOC)){
                                      $indice=$respuesta['MFRC'];
                                      oci_execute($indice);
                                  while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                        $IIDPARTEE  =$arr['IIDPARTE'];
                                        $CNOMBRE   =$arr['NOMBRE'];
                                        $IIDSOLICITUD =$arr['IIDSOLICITUD'];
                                        $PARTE =$arr['CDESCRIPCION'];
                                        
                                        ?>
                            <tr>
                            
                                <td><center><?php ECHO $countt;?></center></td>
                                <td><center><?php ECHO $IIDSOLICITUD;?></center></td>
                                <td><center><?php ECHO $CNOMBRE;?></center></td>
                                <td><center><?php ECHO$PARTE;?></center></td>
               
                        
                    <td><center> <?php  echo "<select class='form-control'  style='width:250px' required name='IDD".$countt."' id='IDD".$countt."'>"?> 
                        
                                <!--<td><center><select class="form-control" style="width:250px" required name="ID" id="ID"/>-->                              
                                             <option value="">Seleccione</option>  
                                    <?PHP   $datos['trabajadores'] = $this->consulta_model->combo_param1('PACONSULTAS','FNTRABAJADOR',$param['fechaP']);
                                    $trabajadores =$datos['trabajadores'] ;
                                    while($respuesta = oci_fetch_array($trabajadores, OCI_ASSOC)){
                                                $indicea=$respuesta['MFRC'];
                                                 oci_execute($indicea);
                                            while($arr = oci_fetch_array($indicea,OCI_ASSOC)){
                                                  $ID_TRABAJADOR =$arr['ID_TRABAJADOR'];
                                                  $nombre   =$arr['NOMBRE'];
                                                  $CONTADOR   =$arr['CONTADOR'];
                                         
                                         echo" <option value =\"$ID_TRABAJADOR\" >'$nombre  tiene $CONTADOR citas agendadas en este dia'</option>";    

                                              }
                                                  
                                                    }?>
                                    </center></td>
                         
                                    <?PHP 
                                        $datos['dia']= $fechafinal;
                                        $datos['HORA'] = $this->consulta_model->combo_param1('PACONSULTAS','FNHORAPRIMERACITA',$datos['dia']);
                                        $HORA=$datos['HORA'];

                                         while($respuesta = oci_fetch_array($HORA, OCI_ASSOC)){
                                                $indiceb=$respuesta['MFRC'];
                                                oci_execute($indiceb);
                                           while($arr = oci_fetch_array($indiceb,OCI_ASSOC)){
                                                    $id_hora =$arr['ID_HORA'];                                                    
                                                    $hora   =$arr['HORA'];                          
                                                    $CONTADOR   =$arr['CONTADOR'];
                                              
                                                if ($CONTADOR < 10) { ?>
                                 <td><center><input class="form-control" type="TEXT" id="horaa" name="horaa" value="<?PHP ECHO $hora;?>" readonly> </center> </td>
                                                  <input class="form-control" type="hidden" id="hora" name="hora" value="<?PHP ECHO $id_hora;?>" readonly>
                                                  <?php  echo "<input type='HIDDEN'  name='hora'         id='hora' value='$id_hora'>"
                                                             . "<input type='HIDDEN'  name='IIDPARTEE".$countt."'         id='IIDPARTEE".$countt."' value='$IIDPARTEE'>"
                                                             . "<input type='HIDDEN'  name='countt'    id='countt' value='$countt'>";?>   

                            <?PHP                    break;  
                                         
                                                }
                                            }
                                        }
                                $countt=$countt+1;}
                                }
                             ?>
                             
                            </tr> 
             </table>         
   <!--//************************************************************************************************************************************************************************-->                         
            </center> <b><?= $mensaje13 ?></b><br/><br/> <center>
                    <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 100%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>N°</b></center></td>
                            <td style="vertical-align:middle"><center><b>NTS</b></center></td>
                            <td style="vertical-align:middle"><center><b>NOMBRE</b></center></td>
                            <td style="vertical-align:middle"><center><b>PARTE</b></center></td>
                            <td style="vertical-align:middle"><center><b>TRABAJADOR</b></center></td>
                            <td style="vertical-align:middle"><center><b>HORARIO</b></center></td>   
                        </tr>   
                          <?php 
                            $count=1;
                           $param['fechaP']=   $fechafinal;
                                while($respuesta = oci_fetch_array($PARTESDOMI, OCI_ASSOC)){
                                      $indice=$respuesta['MFRC'];
                                      oci_execute($indice);
                                  while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                        $IIDPARTE  =$arr['IIDPARTE'];
                                        $CNOMBRE   =$arr['NOMBRE'];
                                        $IIDSOLICITUD =$arr['IIDSOLICITUD'];
                                        $PARTE =$arr['CDESCRIPCION'];
                                        
                                        ?>
                            <tr>
                            
                                <td><center><?php ECHO $count;?></center></td>
                                <td><center><?php ECHO $IIDSOLICITUD;?></center></td>
                                <td><center><?php ECHO $CNOMBRE;?></center></td>
                                <td><center><?php ECHO$PARTE;?></center></td>
               
                    <td><center> <?php  echo  "<select class='form-control'  style='width:250px' required name='ID".$count."' id='ID".$count."'>"?> 
                            
                                <!--<td><center><select class="form-control" style="width:250px" required name="ID" id="ID"/>-->                              
                                             <option value="">Seleccione</option>  
                                    <?PHP   $datos['trabajadores'] = $this->consulta_model->combo_param1('PACONSULTAS','FNTRABAJADOR',$param['fechaP']);
                                    $trabajadores =$datos['trabajadores'] ;
                                    while($respuesta = oci_fetch_array($trabajadores, OCI_ASSOC)){
                                                $indicea=$respuesta['MFRC'];
                                                 oci_execute($indicea);
                                            while($arr = oci_fetch_array($indicea,OCI_ASSOC)){
                                              ECHO    $ID_TRABAJADOR =$arr['ID_TRABAJADOR'];
                                                  $nombre   =$arr['NOMBRE'];
                                               ECHO   $CONTADOR   =$arr['CONTADOR'];
                                         
                                         echo" <option value =\"$ID_TRABAJADOR\" >$ID_TRABAJADOR  $nombre  tiene $CONTADOR citas agendadas en este dia'</option>";    

                                              }
                                                  
                                                    }
                                                          echo"</select> ";    ?>
                                   </center></td>
                         
                                    <?PHP 
                                        $datos['dia']= $fechafinal;
                                        $datos['HORA'] = $this->consulta_model->combo_param1('PACONSULTAS','FNHORAPRIMERACITA',$datos['dia']);
                                        $HORA=$datos['HORA'];

                                         while($respuesta = oci_fetch_array($HORA, OCI_ASSOC)){
                                                $indiceb=$respuesta['MFRC'];
                                                oci_execute($indiceb);
                                           while($arr = oci_fetch_array($indiceb,OCI_ASSOC)){
                                                    $id_hora =$arr['ID_HORA'];                                                    
                                                    $hora   =$arr['HORA'];                          
                                                    $CONTADOR   =$arr['CONTADOR'];
                                              
                                                if ($CONTADOR < 10) { ?>
                                 <td><center><input class="form-control" type="TEXT" id="horaa" name="horaa" value="<?PHP ECHO $hora;?>" readonly> </center> </td>
                                                   <?php  echo "<input type='HIDDEN'  name='hora'         id='hora' value='$id_hora'>"
                                                             . "<input type='HIDDEN'  name='IIDPARTE".$count."'         id='IIDPARTE".$count."' value='$IIDPARTE'>"
                                                             . "<input type='HIDDEN'  name='count'    id='count' value='$count'>";?>   
              
                            <?PHP                    break;  
                                         
                                                }
                                            }
                                        }
                                        
                                $count=$count+1;}
                                }
                             ?>
                             
                            </tr>  
                            
                               
                               
               </table> 
            
              <center>
                   <br/> <br/>
                  <table>
                      <tr>
                          <td><button type="SUBMIT" id="close" value ="" class="btn btn-primary"/>Aceptar</button></td>
                           <td>&nbsp;&nbsp;</td>   <?= form_close();?>
                          <td> <button type="button" id="close" value ="" onclick="CierraError();" class="btn btn-primary"/>Cerrar</button></td>
                      </tr>
                  </table>
              </center>    
        </div> 
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>
  


        