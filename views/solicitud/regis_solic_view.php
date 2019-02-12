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
    <link rel="stylesheet" href="<?php echo base_url('css/metisMenu.min.css')?>">
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/onoffcanvas.css')?>">
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/animate.css')?>">
    
    <script src="<?php echo base_url('scripts/jquery-1.9.1.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('scripts/solicitud.js')?>" type="text/javascript"></script>
    
    
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
    <link rel="stylesheet" href="<?php echo base_url('css/style-switcher.css')?>">
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
                    <div class="outer" style="height: 1200px;">
                        <div class="inner bg-light lter">
                            <div class="body">
                               
                               <!--<form id="validVal" class="form-inline" novalidate="novalidate">-->
                               <?= form_open(base_url().'index.php/solicitud/Solicitud/RegisSolic',array('name'=>'AgreSol',
                                                                                          'id'=>'AgreSol', 
                                                                                          'autocomplete' => 'off',
                                                                                           'class' =>'form-inline') );?> 
                                 
                                 <br><br><br>
                                 <div class="form-group">
                                    <label class="control-label col-lg-8">Procedencia:</label> 
                                 </div>
                                 <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="juzsal" id="juzsal">
                                          <option value="">Seleccione...</option>
                                          <option value="6">JUZGADO</option>
                                          <option value="7">SECRETARIA</option>
                                          <option value="9">SALAS</option>
                                        </select>
                                    </div>    
                                  </div>
                                 <div class="form-group">
                                    <label class="control-label col-lg-8">Número:</label> 
                                 </div>
                                 <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="num" id="num">
                                          <option value="">Seleccione...</option>
                                        </select>
                                    </div>    
                                  </div>
                                 <div class="form-group">
                                    <label class="control-label col-lg-8">Oficio:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                        <input  class="form-control" type="text" id="oficio" name="oficio" placeholder="####/####" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="13" size="10">
                                    </div><!-- /.col-lg-4 -->
                                    
                                  </div><!-- /.row -->
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Fecha oficio:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="fec_oficio" name="fec_oficio" placeholder="dd/mm/yyyy" readonly>
                                        <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_oficio,'dd/mm/yyyy',this)">
                                    </div>
                                  </div>
                                  <br><br><br>                                                        
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Actor:</label>
                                  </div>
                               <br>
                                  <div class="checkbox">
                                    <label>
                                        <div class="checker"><span class=""><input class="uniform" type="checkbox" value="1" name="insiA" id="insiA"></span>  Instituto</div> 
                                    </label>
                                  </div>
                                  <br>
                                  <div class="row form-group" name="institutoA" id="institutoA">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="instA" name="instA" placeholder="Instituto" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="50" size="50">
                                    </div><!-- /.col-lg-4 -->
                                  </div><!-- /.row -->
                               
                                  <br>
                                  <div class="row form-group" id="DatAct" name="DatAct">
                                    <div class="col-lg-4">
                                        <input  class="form-control" type="text" id="apePaternoA" name="apePaternoA" placeholder="Apellido Paterno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apeMaternoA" name="apeMaternoA" placeholder="Apellido Materno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="nombreA" name="nombreA" placeholder="Nombre(s)" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div>
                                  </div><!-- /.row -->
                                  <div class="row form-group">
                                    <div class="col-lg-6">
                                      <div class="checker"><span class=""><input class="uniform" type="checkbox" value="1" name="custA" id="custA"> Custodia</span></div> 
                                    </div><!-- /.col-lg-6 -->
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3">Sexo:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="sexoA" id="sexoA">
                                          <option value="">SEXO</option>
                                          <option value="HOMBRE">HOMBRE</option>
                                          <option value="MUJER">MUJER</option>
                                        </select>
                                    </div>    
                                  </div>
                                  
                                  <br><br><br>
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Demandado:</label> 
                                  </div>
                                  <br>
                                  <div class="checkbox">
                                    <label>
                                        <div class="checker"><span class=""><input class="uniform" type="checkbox" value="1" name="insiD" id="insiD"></span>  Instituto</div> 
                                    </label>
                                  </div>
                                  <br>
                                  <div class="row form-group"  name="institutoD" id="institutoD">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="instD" name="instD" placeholder="Instituto" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="50" size="50">
                                    </div><!-- /.col-lg-4 -->
                                  </div><!-- /.row -->
                                  <br>
                                  <div class="row form-group" id="DatDem" name="DatDem">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apePaternoD" name="apePaternoD" placeholder="Apellido Paterno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apeMaternoD" name="apeMaternoD" placeholder="Apellido Materno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="nombreD" name="nombreD" placeholder="Nombre(s)" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div>
                                  </div><!-- /.row -->
                                  <div class="row form-group">
                                    <div class="col-lg-6">
                                      <div class="checker"><span class=""><input class="uniform" type="checkbox" value="1" name="custD" id="custD"> Custodia</span></div> 
                                    </div><!-- /.col-lg-6 -->
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3">Sexo:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="sexoD" id="sexoD">
                                          <option value="">SEXO</option>
                                          <option value="HOMBRE">HOMBRE</option>
                                          <option value="MUJER">MUJER</option>
                                        </select>
                                    </div>    
                                  </div>
                                  
                                  <br><br><br>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="motref" name="motref" placeholder="Motivo de referencia" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="100" size="100">
                                    </div><!-- /.col-lg-4 -->
                                  </div><!-- /.row -->
                                  
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Expediente:</label> 
                                  </div>
                                  <div class="row form-group">  
                                    <div class="col-lg-4">
                                        <input  class="form-control" type="text" id="exp" name="exp" placeholder="####" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="4" size="4">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                        <input  class="form-control" type="text" id="anioexp" name="anioexp" placeholder="####" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="4" size="4">
                                    </div><!-- /.col-lg-4 -->
                                     
                                  </div><!-- /.row -->
                                  <br><br><br>
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Toca:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                        <input  class="form-control" type="text" id="toc" name="toc" placeholder="####" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="5" size="5">
                                    </div><!-- /.col-lg-4 -->
                                  </div><!-- /.row -->
                                  <div class="form-group">
                                    <label class="control-label col-lg-4">Tipo juicios:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                        <?php  echo $combTJ;?>
                                    </div>    
                                  </div>
                                  <div class="form-group">
                                    <div class="col-lg-12 hidden"  id="difjuicios" name="difjuicios">
                                      <input type="checkbox" name="jui" id="jui" value="">
                                      Accion de reconocimiento de la patria potestad (ambos padres mueren) 
                                                
                                    </div>
                                  </div>
                                  <br><br>
                                  <h4>Niño(s),niña(s) y/o adolecentes</h4>
                                  <hr>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apeMaternoN" name="apeMaternoN" placeholder="Apellido Materno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apePaternoN" name="apePaternoN" placeholder="Apellido Paterno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="nombreN" name="nombreN" placeholder="Nombre(s)" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div>
                                  </div><!-- /.row -->
                                  <br><br>
                                  <div class="col-lg-6">
                                      <label class="control-label">Fecha nacimiento:</label> 
                                      <input type="text" class="form-control" id="fec_nacN" name="fec_nacN" placeholder="dd/mm/yyyy" readonly>
                                      <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_nacN,'dd/mm/yyyy',this)">
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3">Sexo:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="sexoN" id="sexoN">
                                          <option value="">SEXO</option>
                                          <option value="HOMBRE">HOMBRE</option>
                                          <option value="MUJER">MUJER</option>
                                        </select>
                                    </div>    
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <button class="btn btn-primary" id="agreN" name="agreN" type="button"> + </button>
                                    </div> 
                                  </div>  
                                  <br><br>
                                  <div class="body collapse in">
                                      <input type="hidden" name="valfila" id="valfila">
                                      <table class='table responsive-table' id='DatosN'>
                                            <thead>
                                                <tr>
                                                  <th>Nombre</th>
                                                  <th>Nacimiento</th>
                                                  <th>Sexo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>   
                                  </div>
                                  <br><br>
                                  <h4>Terceros emergentes</h4>
                                  <hr>
                                  <div class="row form-group">
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apeMaternoT" name="apeMaternoT" placeholder="Apellido Materno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="apePaternoT" name="apePaternoT" placeholder="Apellido Paterno" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div><!-- /.col-lg-4 -->
                                    <div class="col-lg-4">
                                      <input  class="form-control" type="text" id="nombreT" name="nombreT" placeholder="Nombre(s)" onKeyPress="return textonly(event);" style="text-transform:uppercase;" maxlength="30">
                                    </div>
                                  </div><!-- /.row -->
                                  <br><br>
                                  <div class="col-lg-6">
                                      <label class="control-label">Fecha nacimiento:</label>
                                      <input type="text" class="form-control" id="fec_nacT" name="fec_nacT" placeholder="dd/mm/yyyy" readonly>
                                      <img src="<?php echo site_url('images/Icon_Cal.gif');?>" onClick="displayCalendar(document.forms[0].fec_nacT,'dd/mm/yyyy',this)">
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-lg-3">Sexo:</label> 
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <select class="form-control" name="sexoT" id="sexoT">
                                          <option value="">SEXO</option>
                                          <option value="HOMBRE">HOMBRE</option>
                                          <option value="MUJER">MUJER</option>
                                        </select>
                                    </div>    
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-lg-3">
                                        <button class="btn btn-primary" id="agreT" name="agreT" type="button"> + </button>
                                    </div>    
                                  </div>
                                  <br><br>
                                  <div id="DatosT" class="body collapse in">
                                      <table class='table responsive-table' id='DatosT'>
                                            <thead>
                                                <tr>
                                                  <th>Nombre</th>
                                                  <th>Nacimiento</th>
                                                  <th>Sexo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>   
                                  </div>
                                  <br><br><br><br>  
                               <!--</form>-->
                               <br><br><br>
                               <div class="row form-group">
                                    <div class="col-lg-3">
                                        <button class="btn btn-primary" id="BtnGuaSol" name="BtnGuaSol" type="submit">Guardar Solicitud</button>
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

