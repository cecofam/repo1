<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login CECOFAM</title>
    <meta name="author" content="">
    <!--<meta name="msapplication-TileImage" content="<?php // echo base_url('images/metis-tile.png')?>" />-->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.rtl.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('font-awesome/css/font-awesome.css')?>">
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/main.rtl.css')?>">
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/metisMenu.css') ?>">
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/onoffcanvas.css')?>">
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('css/animate.css')?>">
    <!-- modales.css stylesheet -->
    <!--<link rel="stylesheet" href="<?php // echo base_url('css/modales.css')?>">-->
    
    <style media="screen">
        body {
            direction: rtl;
        }
    </style>
</head>

<body class="login">

    <div class="form-signin">
        <div class="text-center">
            <img src="<?php echo base_url('images/logo.png')?>" alt="CECOFAM Logo">
        </div>
        <hr>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <?= form_open(base_url().'index.php/ingresar/loginVerif',array('name'=>'login',
                                                                               'id'=>'login', 
                                                                               'autocomplete' => 'off') );?>
                    <p class="text-muted text-center">
                        Introducir usuario y password
                    </p>
                    <?= form_input('usuario',@set_value('usuario'),'size="10" maxlength="10" onkeypress="return numberText(event);" placeholder="Usuario" 
                                                      onKeyUp="login.rfc.value=login.rfc.value.toUpperCase();" class="form-control top text-right"');echo br(0.5);?>
                    <?= form_password('pass',@set_value('pass'),'size="8" maxlength="8" placeholder="Contrase&ntilde;a" class="form-control bottom text-right"');echo br(0.5);?>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar al sistema</button>
                <?= form_close(); ?>  
            </div>
            <div id="forgot" class="tab-pane">
                <form action="index.html">
                    <p class="text-muted text-center">Enter your valid e-mail</p>
                    <input type="email" placeholder="mail@domain.com" class="form-control">
                    <br>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Recuperar Password</button>
                </form>
            </div>
            <div id="signup" class="tab-pane">
                <form action="index.html">
                    <input type="text" placeholder="username" class="form-control top">
                    <input type="email" placeholder="mail@domain.com" class="form-control middle">
                    <input type="password" placeholder="password" class="form-control middle">
                    <input type="password" placeholder="re-password" class="form-control bottom">
                    <button class="btn btn-lg btn-success btn-block" type="submit">Registrar</button>
                </form>  
            </div>
        </div>
        <hr>
        <div class="text-center">
            <ul class="list-inline">
                <li><a class="text-muted" href="#login" data-toggle="tab">Ingresar</a></li>
                <li><a class="text-muted" href="#forgot" data-toggle="tab">Recuperar Password</a></li>
                <li><a class="text-muted" href="#signup" data-toggle="tab">Registrar</a></li>
            </ul>
        </div>
  </div>


    <!--jQuery--> 
    <script src="<?php echo base_url('scripts/jquery.js')?>"></script>

    <!--Bootstrap--> 
    <script src="<?php echo base_url('scripts/bootstrap.js')?>"></script>


    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
            });
        })(jQuery);
    </script>
 
</body>

</html>