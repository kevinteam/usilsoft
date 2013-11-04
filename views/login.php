<?php
    session_start();
    $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    if(!$logeado)
    {
        $mensaje_error="";
        if (isset($_GET['cod_error']) && $_GET['cod_error']== '1'){
            $mensaje_error="Debe ingresar nombre de Usuario y/o contraseña";
        }       
        if (isset($_GET['cod_error']) && $_GET['cod_error']== '2'){
            $mensaje_error="Usuario y/o contraseña es incorrecta";
        }
    }
    else
    {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <link rel="stylesheet" href="css/login-style2.css" type="text/css" media="screen">
    <script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
    <script src="js/easyTooltip.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
    <script src="js/bgSlider.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#sublog').keyup(function(ev){
                if(ev.which == 13)
                    $('#contact-form').submit();
            });
        });
    </script>
	<!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        	<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page6">
	<div id="bgSlider"></div>
    <div class="bg_spinner"></div>
	<div class="extra">
        <!--==============================header=================================-->
        <header>
        	<div class="top-row">
            	<div class="main">
                	<div class="wrapper">
                        <h1><a href="index.php">Gestion de Restaurantes-Area de Logistica</a></h1>
                        <ul class="pagination">
                            <li class="current"><a href="images/bg-img1.jpg">1</a></li>
                            <li><a href="images/bg-img2.jpg">2</a></li>
                            <li><a href="images/bg-img3.jpg">3</a></li>
                        </ul>
                        <strong class="bg-text">Background:</strong>
                    </div>
                </div>
            </div>
            <div class="menu-row">
            	<div class="menu-border">
                	<div class="main">
                        <nav>
                            <ul class="menu">
                                <li><a class="active" href="login.php">Login</a></li>
                                <li><a href="registration.php">Registrarse</a></li>
                                <li class="last"><a href="password_recovery.php">Recuperar Contraseña</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
			
        </header>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <div class="indent">
                    	<div class="wrapper">
                        	<article>
                            	<div>
                                    <fieldset>
                                	    <legend>Login</legend>
                                        <div class="p3">
                                            <form id="contact-form" action="../controllers/process_login.php" method="post" enctype="multipart/form-data">                    
                                                <label><span class="text-form">Usuario:</span><input name="usuario" type="text" /></label>
                                                <label><span class="text-form">Contraseña:</span><input id ="sublog" name="password" type="password" /></label>                              
                                                <div class="wrapper">
                                                    <div class="extra-wrap">                                                        
                                                        <div class="clear"></div>
                                                        <div>
                                                            <a class="button-2" href="#" onClick="document.getElementById('contact-form').reset()">Limpiar</a>
                                                            <a class="button-2" href="#" onClick="document.getElementById('contact-form').submit()">Logearse</a>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                            </form>
                                        </div>
                                    </fieldset>						
                                </div>
                            </article>
                        </div>
                    </div>
                    <span style= "color:red; font-size:15px;"><?php echo $mensaje_error ?></span>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
	<!--==============================footer=================================-->
    <footer>
    	<div class="padding">
        	<div class="main">
                <div class="wrapper">
                	<div class="fleft footer-text">
                    	<span>Administrador de Restaurantes - Logistica </span> &copy; 2013
                        <strong>Desarrollado por <a rel="nofollow" class="link" target="_blank" href="#">Usilsoft</a></strong>
                    </div>
                    <ul class="list-services">
                    	<li>Conectate con Nosotros:</li>
                    	<li><a class="tooltips" title="facebook" href="#"></a></li>
                        <li class="item-1"><a class="tooltips" title="twitter" href="#"></a></li>
                        <li class="item-2"><a class="tooltips" title="linkedin" href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>