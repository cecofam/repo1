<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        Brand and toggle get grouped for better mobile display
        <header class="navbar-header">
          <center>
                <a href="index.html">
                    <img src="<?php echo base_url('images/logo.png')?>" style="white: 151px;height: 72px;" alt="">
                </a>
            </center>
        </header>
        <div class="topnav">
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                   class="btn btn-default btn-sm" id="toggleFullScreen">
                    <i class="glyphicon glyphicon-fullscreen"></i>
                </a>
            </div>
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip"
                   class="btn btn-default btn-sm">
                    <i class="fa fa-envelope"></i>
                    <span class="label label-warning">5</span>
                </a>
                <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip"
                   class="btn btn-default btn-sm">
                    <i class="fa fa-comments"></i>
                    <span class="label label-danger">4</span>
                </a>
                <a data-toggle="modal" data-original-title="Help" data-placement="bottom"
                   class="btn btn-default btn-sm"
                   href="#helpModal">
                    <i class="fa fa-question"></i>
                </a>
            </div>
            <div class="btn-group">
                <a href="<?php echo site_url('index.php/Salir');?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                   class="btn btn-metis-1 btn-sm">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
            <div class="btn-group">
                <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
                   class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm" aria-expanded="false">
                    <span class="fa fa-fw fa-comment"></span>
                </a>
            </div>

        </div>
</div>
     <!--/.container-fluid--> 
</nav>