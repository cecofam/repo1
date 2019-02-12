
<?php
 /*
  * DESCRIPCIÓN: vISTA QUE MUESTRA EL FORMULARIO PARA REGISTRAR A LAUMNOS EXTERNOS
  * FECHA: 11 de marzo de 2014
  * SISTEMA: CONTROL ESCOLAR IEJ
  */
?>

<html>
    <head>
        <title>Registro IEJ</title>
          <link rel="stylesheet" type="text/css" href="<?php echo site_url('css/principal.css')?>">
          <link type="text/css" rel="stylesheet" href="<?php echo site_url('scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css')?>" media="screen">
          <script   type="text/javascript" src="<?php echo site_url('scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js')?>"></script>
          <script   type="text/javascript" src="<?php echo site_url('scripts/jquery-1.9.1.min.js'); ?>"></script>
          <script   type="text/javascript" src="<?php echo site_url('scripts/modales.js') ?>"></script>
          <script   type="text/javascript" src="<?php echo site_url('scripts/registro.js') ?>"></script>
          <script   type="text/javascript" src="<?php echo site_url('scripts/validaciones.js') ?>"></script><!--validacion de carácteres--->
    </head>
    <body>
      <div class="contenido">

         
          <h1>Registro de Usuario</h1>
            <p>Estimado Participante: Le pedimos proporcionar de forma completa los siguientes datos, ya que de aqu&iacute; se tomar&aacute; 
             la informaci&oacute;n para su historial <br/>
            en el Instituto de Estudios Judiciales</p>
            
            <?= form_open(base_url().'index.php/RegistroUsers/registrer/checkdata',array('name'=>'Registro',
                                                                                          'id'=>'Registro', 
                                                                                          'autocomplete' => 'off' ) );?> 
            <fieldset class="fieldSet"><legend><h4>Nombre de Usuario</h4></legend>
                
              
                <?= form_label('* ¿Actualmente cuenta con alg&uacute;n familiar laborando en el TSJDF o CJDF:?','');?>
                <?= form_dropdown('familiarTsjdf',array('0' => 'Seleccione','1'=>'S&iacute;','2'=>'No'),'','id="familiarTsjdf" onchange="RegistroTrab();"' ); echo br(2);?>    
                <?= form_label('*Elija un nombre de usuario (m&iacute;nimo 5 caract&eacute;res): ',''); ?>
                <?= form_input('nomuser',@set_value('nomuser'),'id="nomuser"size="15" style="text-transform: lowercase;" onkeypress="return numberText(event);" maxlength="15"')?>
                <?= form_label('Este nombre de usuario lo utilizar&aacute; para identificarse en el sistema. ','');echo br(2); ?>
            <table>
                 <tr>
                    <td><?= form_label('* Nombres:','');?></td>
                    <td><?= form_input('nombre',@set_value('nombre'),'id="nombre" size="25" onkeypress="return textonly(event);" maxlength="30" style="text-transform:uppercase;"')?></td>
                    <td><?= form_label('* Apellido Paterno:','');?></td>
                    <td><?= form_input('ApePat',@set_value('ApePat'),'id="ApePat"size="25" onkeypress="return textonly(event);" maxlength="30" style="text-transform:uppercase;"')?></td>
                    <td><?= form_label('* Apellido Materno:','');?></td>
                    <td><?= form_input('ApeMat',@set_value('ApeMat'),'id="ApeMat" size="25" onkeypress="return textonly(event);" maxlength="30" style="text-transform:uppercase;"');?></td>
                 </tr>
             </table>
           </fieldset>
           <br/>
           <fieldset class="fieldSet"><legend><h4>Datos Generales</h4></legend>  
              <table style="float: left; padding-left: 10px;" >
                <tr>
                    <td><?= form_label('* Fecha de nacimiento:','');?></td>
                  
                    <td><?= form_input('edad',@set_value('edad'),'id="edad"size="20" onkeypress="return numberonly(event);" maxlength="10" id="edad" readonly')?>
                    <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].edad,'dd/mm/yyyy',this)"  </td><!---Imagen del calendario--->
                    
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                   <td><?= form_label('* RFC:','');?> </td>       
                   <td><?= form_input('rfc','','id="rfc"size="20" onkeypress="return numberText(event);" maxlength="13" style="text-transform:uppercase;"'); ?></td>
                </tr>
                 <tr>
                    <td></td>
                </tr>
                <tr>
                     <td><?= form_label('* Sexo:','');?></td>
                     <td><?= form_dropdown('sexo', array('0' =>'Seleccione','F'=>'Mujer','M'=>'Hombre'),@set_value('sexo'),'id="sexo"');?></td>
                </tr>
                 <tr>
                    <td></td>
                </tr>
                 <tr>
                    <td><?= form_label('* Correo Electr&oacute;nico:');?> </td>                 
                    <td><?= form_input('mail',@set_value('mail'),'id="mail"size="40" style="text-transform: lowercase;" onpaste="return false" oncut="return false" oncopy="return false"');?></td>   
                </tr>
                  <tr>
                    <td></td>
                </tr>
                 <tr>
                    <td><?= form_label('* Confirmaci&oacute;n: ');?> </td>
                    <td><?= form_input('confiMail',@set_value('confiMail'),'id="confiMail" size="40" style="text-transform: lowercase;" onpaste="return false" oncut="return false" oncopy="return false"');?></td>
                </tr>
            </table>
            <table style="padding-left: 15px; ">
                <tr>
                    <td><?= form_label('Tel&eacute;fono Oficina (10 D&iacute;g):');?> </td>                 
                    <td><?= form_input('teloficina',@set_value('teloficina'),'id="teloficina" size="20" onkeypress="return numberonly(event);" maxlength="10" ');?></td>   
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td><?= form_label('Extension: ');?> </td>
                    <td><?= form_input('extension',@set_value('extension'),'id="extension" size="20" onkeypress="return numberonly(event);"  maxlength="5"');?></td>
                </tr>
                
                <tr>
                    <td><?= form_label('Tel&eacute;fono Particular (10 D&iacute;g):');?> </td>
                    <td><?= form_input('telParti',@set_value('telParti'),'id="telParti" size="20" onkeypress="return numberonly(event);" maxlength="10"');?></td>
                </tr>
                 <tr>
                    <td></td>
                </tr>
                 <tr>
                    <td><?= form_label('Tel&eacute;fono Celular (044):');?> </td>
                    <td>  <?= form_input('cel',@set_value('cel'),'id="cel" size="20" onkeypress="return numberonly(event);" maxlength="13"');?></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
                <br/><br/><br/><br/>
                 
          </fieldset><br/>
          
          <!----Inputs ocultos para Familiares del TSJDF ----->
          <input type="hidden" name="nomfam" id="nomfam" value="<?php if(isset($generales[0])){echo $generales[0];}else{echo"";}?>"/>
          <input type="hidden" name="apepatfam" id="apepatfam" value="<?php if(isset($generales[1])){echo $generales[1];}else{echo"";}?>"/>
          <input type="hidden" name="apematfam" id="apematfam" value="<?php if(isset($generales[2])){echo $generales[2];}else{echo"";}?>"/>
          <input type="hidden" name="numempfam" id="numempfam" value="<?php if(isset($numempfam)){echo $numempfam;}else{echo"";}?>"/>
          <input type="hidden" name="adscripcionFam" id="adscripcionFam" value="<?php if(isset($laboral[0])){echo $laboral[0];}else{echo"";}?>"/>
          <input type="hidden" name="puestofam" id="puestofam" value="<?php if(isset($laboral[1])){echo $laboral[1];}else{echo"";}?>"/>
        
          <?php if(isset($tabla)){echo $tabla;}else{echo"";} //imprime la tabla con la información del familiar?>
          <br/>
          <input type="submit" id="btnregistro" name="btnregistro" value="Finalizar Registro" onclick="procesa();"/>
          <input type="button" id="btnCancelaregis" name="btnCancelaregis" value="Cancelar" onclick="window.location='<?php echo base_url().'index.php';?>'"/>
          </div>
      <?= form_close();?>
          
          
           <div id="background" class="backgroundHide"></div><!--Div para el fondo de la ventana Modal-->
          
          <div id="familiar" class="modaloculto">
            <fieldset class="fieldSet"><legend>Datos Generales del Empleado del TSJDF o CJDF</legend> 
             <label><b>Favor de ingresar la informaci&oacute;n del familiar</b></label><hr/>
              <?=  form_open(base_url().'index.php/RegistroUsers/registrer/datos_Fam',array('name'=>'datostsjdf',
                                                                                'id'=>'datostsjdf', 
                                                                                'autocomplete' => 'off'));?>
                    <table>
                        <tr>
                            <td><?= form_label('N&uacute;mero de Empleado:','')?></td>
                            <td><?= form_input('numEmp',@set_value('numEmp'),'id="numEmp" maxlength="8" size="25" onkeypress="return numberonly(event);"');?></td>
                            <td><?= form_label('(sin guiones)')?></td>
                        </tr>
                        <tr>
                            <td><?= form_label('RFC :','')?></td>
                            <td><?= form_input('rfc',@set_value('rfc'),'id="rfc" maxlength="13" size="25" onkeypress="return numbetext(event);"
                                               onKeyUp="datostsjdf.rfc.value=datostsjdf.rfc.value.toUpperCase();"');?></td>
                            <td><?= form_label('(Con Homoclave)')?></td>
                        </tr>
                    </table><br/>
                    <center>
                           <?= form_label('Pertenece a:','');?>
                           <?= form_label('TSJDF','');?>
                           <input type="radio" name="dependencia" id="tsjdf" value="1" <?php echo set_radio('active','1');?>
                            <?= form_label('CJDF','');?>      
                            <input type="radio" name="dependencia" id="Cjdf" value="2" <?php echo set_radio('active','2'); echo br(3)?>
                            
                          <input type="submit" id="btnValidaInfo" name="btnValidaInfo" value="Validar Información" onclick="procesa();"/>
                          <input type="button" id="cancelara" name="cancelara" value="Regresar" onclick="CierraFam();"> 
               <?= form_close();?>
                           
             </center>
         </fieldset>
          </div><br/>
        <div id="procesando"  style="display: none"><!--Muestra el div de porcesando-->
                  <?php $mensaje= array('mensaje'=> 'Su solicitud esta siendo atendida');
                        $this->load->view('Modales/procesando_modal',$mensaje);//cargamos el modal de "procesando"
                  ?>
        </div>
      </div><!--cierra el div de contenido-->
    </body>
</html>