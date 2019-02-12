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
                    <!-- /#left  style="overflow: scroll;margin-left: 15%" style="height: 1200px;"-->
                <div id="content" style="overflow: scroll;margin-left: 15%">
                    <div class="outer" style="height: 1200px;">
                        <div class="inner bg-light lter">
                            <div class="body">
                <h3>Recepción de oficios para informes de primera cita.</h3>
                <hr>
                
            <?= form_open(base_url().'index.php/pCita/PCita_c/busqueda');?>     
                <center>
                            <table>
                                <tr>
                                    <th><?= form_label('Folio:','');?></th>
                                    <th><?= form_label('Año:','');?></th>
                                    <th><?= form_label('Número de oficio:','');?></th>
                                    <th><?= form_label('Expediente:','');?></th>
                                    <th><?= form_label('Año:','');?></th>
                                    <th><?= form_label('Toca:','');?></th> 
                                    <th>&nbsp;</th>
                                </tr>
                                <tr>         
                                    <td>
                                        <?= form_input('folio','','class="form-control" onkeypress="return textonly(event);" maxlength="5" size="5" placeholder="####"');?>
                                    </td>
                                    <td>
                                        <?= form_input('Añofolio','','class="form-control" onkeypress="return textonly(event);" maxlength="5" size="5" placeholder="####"');?>
                                    </td>
                                    <td> 
                                        <?= form_input('oficio','','class="form-control" onkeypress="return numbertext(event);" maxlength="15" size="15" placeholder="####/####"');?>
                                    </td>
                                    <td>
                                        <?= form_input('expe','','class="form-control" onkeypress="return numbertext(event);" maxlength="5" size="5" placeholder="####"');?>
                                    </td>
                                    <td>
                                        <?= form_input('Añoexpe','','class="form-control" onkeypress="return numbertext(event);" maxlength="5" size="5" placeholder="####"');?>
                                    </td>
                                    <td> 
                                        <?= form_input('toca','','class="form-control" onkeypress="return numbertext(event);" maxlength="5" size="5" placeholder="####"');?>
                                    </td>
                                    <td>
                                        <input  type="submit" class="btn btn-primary" id="buscar" name="aceptar" value="Buscar"/> 
                                    </td>
                                </tr>
                                                                
                            </table> 
                    <BR>
                    
                                    
                </center>            
            <?= form_close(); 
                                    
            if (isset($cursor)==true){                        
            
                form_open(base_url().'index.php/pCita/PCita_c/mostrar',array('name'=>'Buscarorgano',
                                                                                    'id'=>'Buscarorgano', 
                                                                                   'autocomplete' => 'off') );?>       <!--Tabla para mostrar consulta de datos -->
                <center>    
                    <br>
                         <hr>
                    <table id="tabla" class="table table-bordered" style="border-collapse: collapse; width: 80%;" >
                                <tr class="active">

                                    <td style="vertical-align:middle"><center><b>No.</b></center></td>
                                    <td style="vertical-align:middle"><center><b>Folio</b></center></td>
                                    <td style="vertical-align:middle"><center><b>Expediente</b></center></td>
                                    <td style="vertical-align:middle"><center><b>Tipo de juicio</b></center></td>
                                    <td style="vertical-align:middle"><center><b>Actor vs Demandado</b></center></td>
                                    <td style="vertical-align:middle"><center><b> </b></center></td>
                                </tr>   
                           <?php 
                                $count=1;
                                while ($param  = oci_fetch_array($pavalida)){                                    
                                      $ID_SOL= $param['ID_SOL'];
                                      $EXPEDIENTE= $param['EXPEDIENTE'];
                                      $FOLIO= $param['FOLIO'];
                                      
//                                      $NOMBRE= $param['NOMBRE'];
                                      
                                    ?>
                                
                                <tr>
                                    <td><?php echo $count;?> </td>
                                    <td><?php echo $FOLIO;?> </td>
                                    <td><?php echo $EXPEDIENTE;?> </td>
                                    <td><?php // echo $TJUICIO;?> </td>
                                    <td><?php // echo $NOMBRE." vs ".$DEMANDADO;?> </td>
                                    <td WIDTH="75"><input style="height:25px;width:50px"  type="submit" id="buscar" name="aceptar" value="Ver" onClick=""/> </td>
                                    
                                </tr>
                                
                                        <?php //   echo "<input type='HIDDEN'  name='FOLIO'      id='FOLIO'   value='$FOLIO'>
//                                                      <input type='HIDDEN'  name='ID'         id='ID'      value='$ID_SOL'>
//                                                      <input type='HIDDEN'  name='EXPE'       id='EXPE'    value='$EXPEDIENTE'>
//                                                      <input type='HIDDEN'  name='TJUICIO'    id='TJUICIO' value='$TJUICIO'>
//                                                      <input type='HIDDEN'  name='ACTOR'      id='ACTOR'   value='$ACTOR'> 
//                                                      <input type='HIDDEN'  name='DEMANDADO'  id='DEMANDADO' value='$DEMANDADO'>  ";
                                $count=$count+1; }?>

                    </table>            
                </center>                                                                       
                                                                                   
                                                                                   
                        <!--<center>
                            <table border="1">
                                <tr>
                                    <?php //echo $tabla;} ?>     
                                </tr>                                                                    
                            </table>
                        </center>-->
                
                        <br><br>    
                        
<!--                        <center>
                            <table border="2" cellpadding="10">
                                <tr>
                                    <th colspan="6">
                                        Oficios Emitidos
                                    </th>
                                </tr>
                                <tr>
                                    <th>Oficio de Cumplimiento</th>
                                    <th>Oficio de Primera Cita</th>
                                    <th>Hoja de Antecedentes</th>
                                    <th>Oficio de Inacistencia de Primera Cita (Custodio)</th>
                                    <th>Oficio de Inacistencia de Primera Cita (No Custodio) </th>
                                    <th>Oficio de Inacistencia de la Entrevista Diagnóstica</th>
                                </tr>
                                <tr align="center">                                    
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordOfCumplimiento')?>">Descargar</a></td> 
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordPrimeraCita')?>">Descargar</a></td> 
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordAntecedentes')?>">Descargar</a></td> 
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordInacistenciaPCitaC')?>">Descargar</a></td>
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordInacistenciaPCitaNC')?>">Descargar</a></td>
                                    <td><a href="<?php echo site_url('/index.php/pCita/PCita_c/wordEntrevistaD')?>">Descargar</a></td> 
                                </tr>
                            </table>
                        </center>-->
                
            <?= form_close(); }?>
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


            