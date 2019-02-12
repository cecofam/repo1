
<html>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
   <div id="error" class="Visita">
        <img src="<?php echo site_url('images/iconos_gris/enviar2.png')?>" height='35' width='35'> <b>Visitador</font></b>
            <hr/>
        <?=form_open(base_url().'index.php/Agenda/visita/GUARDAVISITA');?>
            <center>
            <br/>
            <?= $mensaje?><br/><br/>
             
             <?php  echo "<input type='HIDDEN'  name='FECHAFI'          id='FECHAFI' value='$fechafinal'>  ";
                    echo "<input type='HIDDEN'  name='NTS'              id='NTS' value='$NTS'>";
                    echo "<input type='HIDDEN'  name='cp'              id='cp' value='$cp'>";
                    echo "<input type='HIDDEN'  name='parte'           id='parte' value='$IIDPARTE'>";
                   $count=1;?>   
        
                
               <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 100%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>N°</b></center></td>
                            <td style="vertical-align:middle"><center><b>FECHA</b></center></td>
                            <td style="vertical-align:middle"><center><b>TRABAJADOR</b></center></td>
                        </tr> 
                        
                        <tr>
                             <td><center><?php echo $count;?></center></td>
                             <td><center><?php echo $fechafinal;?></center></td>
                             <td><center><?php echo $cursor?>  </td>
                                
                        </tr> 
             </table>         
       
                   
   <!--//************************************************************************************************************************************************************************-->                         
            <center>
                   <br/> <br/>
                  <table>
                      <tr>
                          <td><button type="SUBMIT" id="close" value ="" class="btn btn-default active"/>Aceptar</button></td>
                           <td>&nbsp;&nbsp;</td>   <?= form_close();?>
                          <td> <button type="button" id="close" value ="" onclick="CierraError();" class="btn btn-default active"/>Cerrar</button></td>
                      </tr>
                  </table>
              </center>    
        </div> 
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>
  


        