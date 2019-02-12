<!doctype html>
<!--https://colorlib.com/polygon/metis/bgcolor.html-->
<html>
<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CECOFAM</title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('font-awesome/css/font-awesome.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('font-awesome/css/font-awesome.css')?>">    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/main.css')?>">
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/metisMenu.css') ?>">
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/onoffcanvas.css')?>">
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/animate.css')?>">
    
   
    <script src="<?php echo base_url('scripts/jquery-1.9.1.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('scripts/functionHA.js')?>" type="text/javascript"></script>
    
    
    <link type="text/css" rel="stylesheet" href="<?php echo site_url('scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css')?>" media="screen">
    <script   type="text/javascript" src="<?php echo site_url('scripts/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js')?>"></script>
    <!--For Development Only. Not required -->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url('less/theme.less')?>">
    
   
  </head>
        <body class="  ">
            <div class="bg-dark dk" id="wrap">
                <div id="top">
                    <!-- .navbar -->
                    <?php $this->load->view('cabecera');?>
                    <!--/.container-fluid--> 
               </div>
                <!-- /#top -->
                    <div id="left">
                        <div class="media user-media bg-dark dker">
                            <div class="user-media-toggleHover">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="user-wrapper bg-dark">
                                <a class="user-link" href="">
                                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url('images/usuario.png')?>" style="white: 100px;height: 100px;">
                                    <!--<span class="label label-danger user-label">16</span>-->
                                </a>
                        
                                <div class="media-body">
                                    <h5 class="media-heading">Archie</h5>
                                    <ul class="list-unstyled user-info">
                                        <li><a href="">Administrator</a></li>
                                        <li>Last Access : <br>
                                            <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- #menu -->
                        <?php $this->load->view('menu');?>
                        <!-- /#menu -->
                    </div>
                    <!-- /#left  style="overflow: scroll;margin-left: 15%" style="height: 1800px;"-->
                <div id="content" style="overflow: scroll;margin-left: 15%">
                    <div class="outer">
                        <div class="inner bg-light lter">
                            <div class="body">
                                
                                <?= form_open(base_url().'index.php/hoja_ante/Hoja_ante/Guarda_HA',array('name'=>'AgreHA',
                                                                                               'id'=>'AgreHA', 
                                                                                               'autocomplete' => 'off',
                                                                                                'class' =>'form-inline') );?> 
                               
                                <div name="datgen" id="datgen">
                                    <input type="hidden" name="id_sol" id="id_sol" value="<?php echo $id_sol;?>">
                                    <input type="hidden" name="idper" id="idper" value="<?php echo $id_per;?>">
                                      <h3><?php echo $nom;?></h3>
                                      <br><br>
                                      <h4>1. Datos Generales</h4>
                                      <hr>
                                      <br>
                                      <div class="form-group">
                                         <label class="control-label col-lg-4">Edad:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="edad" name="edad" placeholder="####" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="13" size="10">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Fecha de nacimiento:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-11">
                                             <input type="text" class="form-control" id="fec_nac" name="fec_nac" placeholder="dd/mm/yyyy" readonly>
                                             <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_nac,'dd/mm/yyyy',this)">
                                         </div>
                                       </div>
                                       <br><br><br> 
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Teléfono de casa:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="telcas" name="telcas" placeholder="##########" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="13" size="10">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Teléfono de movil:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="telmov" name="telmov" placeholder="##########" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="13" size="10">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Entidad Federativa:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-8">
                                             <select class="form-control" name="entidadF" id="entidadF">
                                               <option value="">Seleccione...</option>
                                               <?php
                                               while($respuesta = oci_fetch_array($entidad, OCI_ASSOC)){
                                                     $indice=$respuesta['MFRC'];
                                                     oci_execute($indice);
                                                     while($arr = oci_fetch_array($indice,OCI_ASSOC)){
                                                           $idEst   =$arr['ID'];
                                                           $estado =$arr['ESTADO'];
                                                           echo "<option value='".$idEst."'>".$estado."</option>";                          
                                                     }
                                               }
                                               ?>
                                             </select>
                                         </div>    
                                       </div>
                                       <br><br><br>
                                       <div class="form-group">
                                         <label class="control-label col-lg-6">Alcaldia o Municipio:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-3">
                                             <select class="form-control" name="alcmun" id="alcmun">
                                                 <option value="">Seleccione...</option>
                                            </select>
                                         </div>    
                                       </div>
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Nacionalidad:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="naciona" name="naciona" placeholder="NACIONALIDAD" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="20" size="20">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <div class="form-group">
                                         <label class="control-label col-lg-6">Religi&oacute;n:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-3">
                                             <?php echo $religion;?>
                                         </div>    
                                       </div>

                                       <br><br><br>
                                       <div class="form-group">
                                         <label class="control-label col-lg-3">Estado civil:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-3">
                                             <select class="form-control" name="estciv" id="estciv">
                                               <option value="">Seleccione ...</option>
                                               <option value="C">CASADO(A)</option>
                                               <option value="S">SOLTERO(A)</option>
                                             </select>
                                         </div>    
                                       </div>
                                       <div class="form-group">
                                         <label class="control-label col-lg-3">Escolaridad:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-3">
                                             <?php echo $escolaridad;?>
                                         </div>    
                                       </div>
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Actividad laboral:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="actividad" name="actividad" placeholder="ACTIVIDAD" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="20" size="20">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <br><br><br>

                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Horario laboral:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="horlab" name="horlab" placeholder="HH:MM" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="20" size="20">
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       <div class="form-group">
                                         <label class="control-label col-lg-8">Numero de hijos:</label> 
                                       </div>
                                       <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="naciona" name="numhij" value="<?php echo $num_hijos;?>" size="2" disabled>
                                         </div><!-- /.col-lg-4 -->

                                       </div><!-- /.row -->
                                       
                                       <br><br>
                                       <h4>2. Datos de Niño(s),niña(s) y/o adolecentes</h4>
                                       <hr>

                                       <?php echo $tabla;?>

                                    <!--</form>-->
                                    <br><br><br>
                                    <div class="row form-group">
                                         <div class="col-lg-3">
                                             <button type="button" class="btn btn-primary" id="BtnSig1" name="BtnSig1" onClick="DatClin();">Siguiente</button>
                                         </div>    
                                     </div>
                                    
                                 </div>
                                <div name="datclin" id="datclin" hidden>
                                    <h3><?php echo $nom;?></h3>
                                    <br>
                                    <h4>3. Datos clínicos.(papá, mamá, niña, niño y/o adolecente)</h4>
                                    
                                    <table style="background-color: #E5E8E8;">
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-12">¿Ha sido evaluado psicológicamente?</label> 
                                                </div>
                                                <div class="row form-group">
                                                     <div class="col-lg-3">
                                                         <label class="control-label col-lg-3">Sí </label>
                                                         <input type="radio" name="ep" id="ep" value="1">
                                                     </div>
                                                 </div>
                                                 <div class="row form-group">
                                                     <div class="col-lg-3">
                                                         <label class="control-label col-lg-3">No</label>
                                                         <input type="radio" name="ep" id="ep" value="0">
                                                     </div>    
                                                 </div>
                                               </td> 
                                            </tr>
                                      </table>
                                    <br><br>
                                     <div class="form-group">
                                          <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                     </div>
                                     <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="quieneva" name="quieneva" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                         </div><!-- /.col-lg-4 -->
                                      </div><!-- /.row -->
                                      <br><br>
                                      <div class="col-lg-6">
                                        <label class="control-label">Fecha de evaluación:</label>
                                        <input type="text" class="form-control" id="fec_eva" name="fec_eva" placeholder="dd/mm/yyyy" readonly>
                                        <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_eva,'dd/mm/yyyy',this)">
                                      </div>
                                      <br><br>
                                      <div class="form-group">
                                          <label class="control-label col-lg-12">Lugar:</label> 
                                     </div>
                                      <div class="row form-group">
                                         <div class="col-lg-4">
                                             <input  class="form-control" type="text" id="lugareva" name="lugareva" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                         </div><!-- /.col-lg-4 -->
                                      </div><!-- /.row -->
                                      <br><br>
                                      <table style="background-color: #E5E8E8;">
                                          <tr>
                                              <td>
                                                <div class="form-group">
                                                  <label class="control-label col-lg-12">¿Ha tomado terapía psicológica?</label> 
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-3">
                                                       <label class="control-label col-lg-3">Sí </label>
                                                       <input type="radio" name="terap" id="terap" value="1">
                                                     </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-3">
                                                       <label class="control-label col-lg-3">No</label>
                                                       <input type="radio" name="terap" id="terap" value="0">
                                                    </div>    
                                                 </div>
                                              </td>    
                                          </tr>
                                        </table>
                                        <br><br>
                                         <div class="form-group">
                                              <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                         </div>
                                         <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="quientera" name="quientera" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="col-lg-6">
                                            <label class="control-label">Periodo de la terapía:</label>
                                            <input  class="form-control" type="text" id="periotera" name="periotera" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="50" size="50">
                                          </div>
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Lugar:</label> 
                                         </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="lugartera" name="lugartera" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">¿Ha sido valorado por médico psiquiatra?</label> 
                                                    </div>
                                                    <div class="row form-group">
                                                         <div class="col-lg-3">
                                                             <label class="control-label col-lg-3">Sí </label>
                                                             <input type="radio" name="psiqui" id="psiqui" value="1">
                                                         </div>
                                                     </div>
                                                      <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label col-lg-3">No</label>
                                                            <input type="radio" name="psiqui" id="psiqui" value="0">
                                                        </div>    
                                                      </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                        <br><br>
                                         <div class="form-group">
                                              <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                         </div>
                                         <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="quienpsiq" name="quienpsiq" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="col-lg-6">
                                            <label class="control-label">Fecha de valoración:</label>
                                            <input type="text" class="form-control" id="fec_valo" name="fec_valo" placeholder="dd/mm/yyyy" readonly>
                                            <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_valo,'dd/mm/yyyy',this)">
                                          </div>
                                          <br><br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Lugar:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="lugarvalo" name="lugarvalo" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Diagnóstico:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="diagval" name="diagval" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Medicamentos preinscritos:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="medprein" name="medprein" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Frecuencia de la toma del medicamento:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="frecmed" name="frecmed" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br><br>
                                           <div class="row form-group">
                                             <div class="col-lg-3">
                                                 <button type="button" class="btn btn-primary" id="BtnAnt2" name="BtnAnt2" onClick="AntDatClin2();"><< Anterior</button>
                                             </div>    
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-3">
                                                 <button type="button" class="btn btn-primary" id="BtnSig2" name="BtnSig2" onClick="DatClin2();">Siguiente >></button>
                                             </div>    
                                          </div>
                                          
                                </div>
                                <div name="datclin1" id="datclin1" hidden>
                                    
                                    <h3><?php echo $nom;?></h3>
                                    <br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">¿Presenta alguna enfermedad de tipo crónica o degenerativa?</label> 
                                                    </div>
                                                    <div class="row form-group">
                                                         <div class="col-lg-3">
                                                             <label class="control-label col-lg-3">Sí </label>
                                                             <input type="radio" name="psiqui" id="psiqui" value="1">
                                                         </div>
                                                     </div>
                                                      <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label col-lg-3">No</label>
                                                            <input type="radio" name="psiqui" id="psiqui" value="0">
                                                        </div>    
                                                      </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                        <br><br>
                                         <div class="form-group">
                                              <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                         </div>
                                         <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="quiencron" name="quiencron" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Diagnóstico:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="diagcron" name="diagcron" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Medicamentos preinscritos:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="medpreincron" name="medpreincron" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <div class="form-group">
                                              <label class="control-label col-lg-12">Frecuencia de la toma de medicamento:</label> 
                                          </div>
                                          <div class="row form-group">
                                             <div class="col-lg-4">
                                                 <input  class="form-control" type="text" id="frecmedcron" name="frecmedcron" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                             </div><!-- /.col-lg-4 -->
                                          </div><!-- /.row -->
                                          <br><br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">¿Es alergico a algún medicamento?</label> 
                                                    </div>
                                                    <div class="row form-group">
                                                         <div class="col-lg-3">
                                                             <label class="control-label col-lg-3">Sí </label>
                                                             <input type="radio" name="alerg" id="alerg" value="1">
                                                         </div>
                                                     </div>
                                                      <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label col-lg-3">No</label>
                                                            <input type="radio" name="alerg" id="alerg" value="0">
                                                        </div>    
                                                      </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="quienalergia" name="quienalergia" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">Especificar:</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="Especaler" name="Especaler" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">¿Cuenta con algún tipo de servicio médico?</label> 
                                                    </div>
                                                    <div class="row form-group">
                                                         <div class="col-lg-3">
                                                             <label class="control-label col-lg-3">Sí </label>
                                                             <input type="radio" name="sm" id="sm" value="1">
                                                         </div>
                                                     </div>
                                                      <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label col-lg-3">No</label>
                                                            <input type="radio" name="sm" id="sm" value="0">
                                                        </div>    
                                                      </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">¿Quién(es)?</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="quienserv" name="quienserv" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">Especificar:</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="Especserv" name="Especserv" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">En caso de emergencia avisar a:</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="avisaremerg" name="avisaremerg" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br>
                                            <div class="form-group">
                                                 <label class="control-label col-lg-12">Número Telefónico:</label> 
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-4">
                                                    <input  class="form-control" type="text" id="telemerg" name="telemerg" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="10" size="10">
                                                </div><!-- /.col-lg-4 -->
                                            </div><!-- /.row -->
                                            <br><br><br>
                                            <div class="row form-group">
                                             <div class="col-lg-3">
                                                 <button type="button" class="btn btn-primary" id="BtnAnt3" name="BtnAnt3" onClick="AntDatsitjur();"><< Anterior</button>
                                             </div>    
                                            </div>
                                            <div class="row form-group">
                                             <div class="col-lg-3">
                                                  <button type="button" class="btn btn-primary" id="BtnSig3" name="BtnSig3" onClick="Datsitjur();">Siguiente >></button>
                                             </div>    
                                            </div>
                                </div>
                                <div name="datsitjur" id="datsitjur" hidden>
                                   
                                    <h3><?php echo $nom;?></h3>
                                    <h3>4. Situación Jurídica</h3>
                                    <br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">Se determinó la guardia y custodia a favor de:</label> 
                                                    </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                            <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="custde" name="custde" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                    <br><br>
                                          <table style="background-color: #E5E8E8;">
                                              <tr>
                                                  <td>
                                                    <div class="form-group">
                                                      <label class="control-label col-lg-12">¿Pensión alimenticia?</label> 
                                                    </div>
                                                    <div class="row form-group">
                                                         <div class="col-lg-3">
                                                             <label class="control-label col-lg-3">Sí </label>
                                                             <input type="radio" name="psiqui" id="pension" value="1">
                                                         </div>
                                                     </div>
                                                      <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <label class="control-label col-lg-3">No</label>
                                                            <input type="radio" name="psiqui" id="pension" value="0">
                                                        </div>    
                                                      </div>
                                                  </td>    
                                              </tr>
                                            </table>
                                            <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">¿Existe un régimen de visitas y convivencias previo?</label> 
                                                      </div>
                                                      <div class="row form-group">
                                                           <div class="col-lg-3">
                                                               <label class="control-label col-lg-3">Sí </label>
                                                               <input type="radio" name="visconv" id="visconv" value="1">
                                                           </div>
                                                       </div>
                                                        <div class="row form-group">
                                                          <div class="col-lg-3">
                                                              <label class="control-label col-lg-3">No</label>
                                                              <input type="radio" name="visconv" id="visconv" value="0">
                                                          </div>    
                                                        </div>
                                                    </td>    
                                                </tr>
                                              </table>
                                              <div class="form-group">
                                                 <label class="control-label col-lg-12">A favor de:</label> 
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="visfav" name="visfav" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <div class="form-group">
                                                 <label class="control-label col-lg-12">Lugar, días y horarios:</label> 
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="ldh" name="ldh" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">Por favor indique quien inicio el proceso juridico, el motivo y que es lo que se pretende:</label> 
                                                      </div>
                                                    </td>    
                                                </tr>
                                               </table>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="motpret" name="motpret" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">¿Los hijos tienen conocimiento del proceso judicial?</label> 
                                                      </div>
                                                      <div class="row form-group">
                                                           <div class="col-lg-3">
                                                               <label class="control-label col-lg-3">Sí </label>
                                                               <input type="radio" name="hpj" id="hpj" value="1">
                                                           </div>
                                                       </div>
                                                        <div class="row form-group">
                                                          <div class="col-lg-3">
                                                              <label class="control-label col-lg-3">No</label>
                                                              <input type="radio" name="hpj" id="hpj" value="0">
                                                          </div>    
                                                        </div>
                                                    </td>    
                                                </tr>
                                              </table>
                                               <div class="form-group">
                                                 <label class="control-label col-lg-12">¿Como se les ha informado?</label> 
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="chpj" name="chpj" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">¿Existencia de acuerdos?</label> 
                                                      </div>
                                                      <div class="row form-group">
                                                           <div class="col-lg-3">
                                                               <label class="control-label col-lg-3">Sí </label>
                                                               <input type="radio" name="eacuar" id="eacuar" value="1">
                                                           </div>
                                                       </div>
                                                        <div class="row form-group">
                                                          <div class="col-lg-3">
                                                              <label class="control-label col-lg-3">No</label>
                                                              <input type="radio" name="eacuar" id="eacuar" value="0">
                                                          </div>    
                                                        </div>
                                                    </td>    
                                                </tr>
                                              </table>
                                               <div class="form-group">
                                                 <label class="control-label col-lg-12">¿Cuales?</label> 
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="cualacuer" name="cualacuer" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">¿Se han cumplido?</label> 
                                                      </div>
                                                      <div class="row form-group">
                                                           <div class="col-lg-3">
                                                               <label class="control-label col-lg-3">Sí </label>
                                                               <input type="radio" name="cumpl" id="cumpl" value="1">
                                                           </div>
                                                       </div>
                                                        <div class="row form-group">
                                                          <div class="col-lg-3">
                                                              <label class="control-label col-lg-3">No</label>
                                                              <input type="radio" name="cumpl" id="cumpl" value="0">
                                                          </div>    
                                                        </div>
                                                    </td>    
                                                </tr>
                                              </table>
                                               <div class="form-group">
                                                 <label class="control-label col-lg-12">Causas:</label> 
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <input  class="form-control" type="text" id="causas" name="causas" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="200" size="100">
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br>
                                               <table style="background-color: #E5E8E8;">
                                                <tr>
                                                    <td>
                                                      <div class="form-group">
                                                        <label class="control-label col-lg-12">Otros procesos Juridicos (ordenes de restriccion, denuncias por violencia, abuso sexual,etc):</label> 
                                                      </div>
                                                    </td>    
                                                </tr>
                                              </table>
                                               <div class="row form-group">
                                                    <div class="col-lg-4">
                                                        <textarea class="form-control" name="otrosJ" id="otrosJ" rows="10" cols="100" onKeyPress="return textonly(event);" style="text-transform:uppercase;"></textarea>
                                                    </div><!-- /.col-lg-4 -->
                                               </div><!-- /.row -->
                                               <br><br><br>
                                               <div class="row form-group">
                                                <div class="col-lg-3">
                                                    <button type="button" class="btn btn-primary" id="BtnAnt3" name="BtnAnt3" onClick="AntDatfin();"><< Anterior</button>
                                                </div>    
                                               </div>
                                               <div class="row form-group">
                                                    <div class="col-lg-3">
                                                        <button type="submit" class="btn btn-primary" id="BtnGuardar" name="BtnGuardar">Guardar</button>
                                                    </div>    
                                               </div>
                                </div>                                                                
                                <?= form_close(); ?>
                             </div> 
                        </div>
                    </div>
                </div>
                        <!-- /.inner -->
                    </div>
                    <!-- /.outer -->
                </div>
                <!-- /#content -->

                    <div id="right" class="onoffcanvas is-right is-fixed bg-light" aria-expanded=false>
                        <a class="onoffcanvas-toggler" href="#right" data-toggle=onoffcanvas aria-expanded=false></a>
                        <br>
                        <br>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Warning!</strong> Best check yo self, you're not looking too good.
                        </div>
                        <!-- .well well-small -->
                        <div class="well well-small dark">
                            <ul class="list-unstyled">
                                <li>Visitor <span class="inlinesparkline pull-right">1,4,4,7,5,9,10</span></li>
                                <li>Online Visitor <span class="dynamicsparkline pull-right">Loading..</span></li>
                                <li>Popularity <span class="dynamicbar pull-right">Loading..</span></li>
                                <li>New Users <span class="inlinebar pull-right">1,3,4,5,3,5</span></li>
                            </ul>
                        </div>
                        <!-- /.well well-small -->
                        <!-- .well well-small -->
<!--                        <div class="well well-small dark">
                            <button class="btn btn-block">Default</button>
                            <button class="btn btn-primary btn-block">Primary</button>
                            <button class="btn btn-info btn-block">Info</button>
                            <button class="btn btn-success btn-block">Success</button>
                            <button class="btn btn-danger btn-block">Danger</button>
                            <button class="btn btn-warning btn-block">Warning</button>
                            <button class="btn btn-inverse btn-block">Inverse</button>
                            <button class="btn btn-metis-1 btn-block">btn-metis-1</button>
                            <button class="btn btn-metis-2 btn-block">btn-metis-2</button>
                            <button class="btn btn-metis-3 btn-block">btn-metis-3</button>
                            <button class="btn btn-metis-4 btn-block">btn-metis-4</button>
                            <button class="btn btn-metis-5 btn-block">btn-metis-5</button>
                            <button class="btn btn-metis-6 btn-block">btn-metis-6</button>
                        </div>-->
                        <!-- /.well well-small -->
                        <!-- .well well-small -->
                        <div class="well well-small dark">
                            <span>Default</span><span class="pull-right"><small>20%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                            </div>
                            <span>Success</span><span class="pull-right"><small>40%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                            </div>
                            <span>warning</span><span class="pull-right"><small>60%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                            </div>
                            <span>Danger</span><span class="pull-right"><small>80%</small></span>
                        
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /#right -->
            </div>
            <!-- /#wrap -->
            <footer class="Footer bg-dark dker">
                <p>2017 &copy; Metis Bootstrap Admin Template v2.4.2</p>
            </footer>
            <!-- /#footer -->
            <!-- #helpModal -->
            <div id="helpModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- /#helpModal -->
            <!--jQuery -->
            <script src="<?php echo base_url('scripts/jquery.js')?>"></script>
            <!--Bootstrap -->
            <script src="<?php echo base_url('scripts/bootstrap.js')?>"></script>
            <!-- MetisMenu -->
            <script src="<?php echo base_url('scripts/metisMenu.js')?>"></script>
            <!-- onoffcanvas -->
            <script src="<?php echo base_url('scripts/onoffcanvas.js')?>"></script>
            <!-- Screenfull -->
            <script src="<?php echo base_url('scripts/screenfull.js')?>"></script>
            <!-- Metis core scripts -->
            <script src="<?php echo base_url('scripts/core.js')?>"></script>
            <!-- Metis demo scripts -->
            <script src="<?php echo base_url('scripts/app.js')?>"></script>
            <script src="<?php echo base_url('scripts/style-switcher.js')?>"></script>
        </body>

</html>

