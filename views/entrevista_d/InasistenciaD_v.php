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
                    <!-- /#left  style="overflow: scroll;margin-left: 15%" style="height: 1200px;"-->
                <div id="content" style="overflow: scroll;margin-left: 15%">
                    <div class="outer" style="height: 1200px;">
                        <div class="inner bg-light lter">
                            <div class="body">

                                <h3>Inasistencia de entrevista diagnostica</h3>
                                <hr>

                                    <?= form_open(base_url().'index.php/entrevista_d/InasistenciaD_c/Recepe',array('name'=>'',
                                                                                                 'id'=>'', 
                                                                                                 'autocomplete' => 'off') );?>
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
                                                <td><?= form_input('folio','','class="form-control" onkeypress="return textonly(event);" maxlength="5" size="5" placeholder="####"');?></td>                    
                                                <td><?= form_input('aniofol','','class="form-control" onkeypress="return textonly(event);" maxlength="5" size="5" placeholder="####"');?></td>
                                                <td><?= form_input('oficio','','class="form-control" onkeypress="return numbertext(event);" maxlength="15" placeholder="####/####"');?></td>                    
                                                <td><?= form_input('expediente','','class="form-control" onkeypress="return numbertext(event);" maxlength="5" size="5" placeholder="####"');?></td>                    
                                                <td><?= form_input('anioexp','','class="form-control" onkeypress="return textonly(event);" maxlength="5" size="5" placeholder="####"');?></td>
                                                <td><?= form_input('toca','','class="form-control" onkeypress="return numbertext(event);" maxlength="5" size="5" placeholder="####"');?></td>                        
                                                <td>
                                                    <div class="row form-group">
                                                        <div class="col-lg-3">
                                                            <input type="submit" class="btn btn-primary" id="buscar" name="buscar" value="Buscar" />
                                                        </div>    
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <?= form_close();?>
                                        <br><br><br>
                                        <div id="sortableTable" class="body collapse in">
                                        <table class="table table-bordered sortableTable responsive-table tablesorter tablesorter-default" role="grid">
<!--                                          <thead>-->
<!--                                            <tr>
                                              <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Número
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Expediente
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Tipo de Juicio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Folio
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Persona
                                                    </div>
                                               </th>                                               
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Ver
                                                    </div>
                                               </th>
                                               <th class='tablesorter-header tablesorter-headerAsc'>
                                                    <div class='tablesorter-header-inner'>
                                                        Descargar
                                                    </div>
                                               </th>
                                              
                                              
                                            </tr>-->
<!--                                          </thead>-->
<!--                                          <tbody aria-live="polite" aria-relevant="all">
                                          <tr role="row">
                                              <td>1</td>
                                              <td>Jill</td>
                                              <td>Smith</td>    
                                              <td>50</td>
                                              <td>50</td>
                                              <td>50</td>
                                              <td>50</td>
                                            </tr><tr role="row">
                                              <td>2</td>
                                              <td>Eve</td>
                                              <td>Jackson</td>
                                              <td>94</td>
                                              <td>94</td>
                                              <td>94</td>
                                              <td>94</td>
                                            </tr><tr role="row">
                                              <td>3</td>
                                              <td>John</td>
                                              <td>Doe</td>
                                              <td>80</td>
                                              <td>80</td>
                                              <td>80</td>
                                              <td>80</td>
                                            </tr><tr role="row">
                                              <td>4</td>
                                              <td>Adam</td>
                                              <td>Johnson</td>
                                              <td>67</td>
                                              <td>67</td>
                                              <td>67</td>
                                              <td>67</td>
                                            </tr>
                                          </tbody>-->
                                        </table>
                                    </div>
                                            <?php echo $tabla;?>
                                    </center> 

                                    <?= form_open(base_url().'index.php/entrevista_d/InasistenciaD_c/Recep',array('name'=>'',
                                                                                                 'id'=>'', 
                                                                                                 'autocomplete' => 'off') );?>

                                
                                
                                
                               
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

                