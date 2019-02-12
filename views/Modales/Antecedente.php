
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="Pcita">
        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='35'> <b>Antecedente</font></b>
            <hr/>
        <?=form_open(base_url().'index.php/Estudios/consultar/guardarAntecedente');?>
            <center>
            <br/>
        <?php if($tipo=='1') {   
            $count=1;?> 

            </center> <b><?= $mensaje11 ?></b><br/><br/><center>
                
               <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width:  90%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>N°</b></center></td>
                            <td style="vertical-align:middle"><center><b>NTS</b></center></td>
                            <td style="vertical-align:middle"><center><b>EXPEDIENTE</b></center></td>
                            <td style="vertical-align:middle"><center><b>AÑO</b></center></td>
                            <td style="vertical-align:middle"><center><b>VS</b></center></td>
                        </tr> 
                        
                        <?php  while ($datos  = oci_fetch_array($cursor)){
                               $NTS= $datos['IIDNTS'];
                               $ANIO= $datos['IIDANIO'];
                               
                               $EXPEDIENTE= $datos['CEXPEDIENTE'];                               
                               $IANIOEXP= $datos['IANIOEXP'];
                               
                               $ACPATERNO = $datos['CACTORAPPATERNO'];
                               $ACMATERNO = $datos['CACTORAPMATERNO'];
                               $ACNOMBRE = $datos['CACTORNOMBRE'];
                               
                               $DEPATERNO = $datos['CDEMANDADOAPPATERNO'];
                               $DEMATERNO = $datos['CDEMANDADOAPMATERNO'];
                               $DENOMBRE = $datos['CDEMANDADONOMBRE'];?>
                              
                        <tr>
                             <td><?php echo $count; ?></td>
                             <td><?php echo $NTS."/".$ANIO; ?></td>
                             <td><?php echo $EXPEDIENTE."/".$IANIOEXP; ?></td>
                             <td><?php echo $ANIO; ?></td>
                             <td><?php echo $ACNOMBRE." ".$ACPATERNO." ".$ACMATERNO." VS ".$DENOMBRE." ".$DEPATERNO." ".$DEMATERNO ?></td>
                        </tr>
                            
                  <?php   $count=$count+1;  }
                         echo " <input type='HIDDEN'  name='NTS'    id='NTS' value='$NTS'>".$tabla;
                        ?>
                       
                        
                             
             </table>      
        <?php }
         if($tipo=='2') {   
            $count=1;?>          
   <!--//************************************************************************************************************************************************************************-->                         
            </center> <b><?= $mensaje12 ?></b><br/><br/> <center>
                     <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 90%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>N°</b></center></td>
                            <td style="vertical-align:middle"><center><b>NTS</b></center></td>
                            <td style="vertical-align:middle"><center><b>EXPEDIENTE</b></center></td>
                            <td style="vertical-align:middle"><center><b>AÑO</b></center></td>
                            <td style="vertical-align:middle"><center><b>VS</b></center></td>
                        </tr> 
                        
                          <?php  while ($datos  = oci_fetch_array($cursor)){
                               $NTS= $datos['IIDSOLICITUD'];
                               $EXPEDIENTE= $datos['EXPEDIENTE'];
                               $ANIO= $datos['ANIO'];
                               $ACTOR = $datos['ACTOR'];
                               $DEMANDADO= $datos['DEMANDADO'];?>
                              
                        <tr>
                             <td><?php echo $count; ?></td>
                             <td><?php echo $NTS; ?></td>
                             <td><?php echo $EXPEDIENTE; ?></td>
                             <td><?php echo $ANIO; ?></td>
                             <td><?php echo $ACTOR." VS ".$DEMANDADO; ?></td>
                            
                  <?php   $count=$count+1;  }
                         echo " <input type='hidden'  name='NTS'    id='NTS' value='$NTS'>".$tabla;
                        ?>
                          
                             
             </table>  
                                                      
        <?php } ?>                        
          
                
                <input type='HIDDEN'  name='acepta'    id='acepta' value='1'>
            
              <center>
                   <br/> <br/>
                  <table>
                      <tr>
                          <td><button type="SUBMIT" id="close" value ="" class="btn btn-default active"/>Aceptar</button></td>
                           <td>&nbsp;&nbsp;</td>   <?= form_close();?>
                        <?=form_open(base_url().'index.php/Estudios/consultar/guardarAntecedente');
                           echo $tabla;?>   
                          <input type='HIDDEN'  name='acepta'    id='acepta' value='0'>
                           <td> <button type="SUBMIT" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Otro</button></td>
                        <?= form_close();?>
                      </tr>
                  </table>
              </center>    
        </div> 
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>
  


        