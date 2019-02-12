
<html
    
<link rel="stylesheet" type="text/css" href="<?php echo site_url('styles/principal.css')?>"/>
<script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
<script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js') ?>"></script>

<body>
    <div id="error" class="error">
       <?=form_open(base_url().'index.php/Primer_enc/Primer_enc_c/registro');?>
            <center>
                          
               <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 100%;" >
                        <tr class="active">
                            
                            <td style="vertical-align:middle"><center><b>Prueba</b></center></td>
                            <td style="vertical-align:middle"><center><b>Prueba</b></center></td>
                            <td style="vertical-align:middle"><center><b>Prueba</b></center></td>>   
                        </tr> 
         
       
            <hr/>
      
            <b class="mesageError"><?= $titulo ?></b>
            <br/>
             
        </div> 
    <?= form_close();?>
        <div id="error-background" class="backgroundError"></div>
</body>     
  </html>