<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

    $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    if($logeado)
    {
        header("Location: ".$base_inicial."/views/index.php");
    }
    $mensaje_error="";
        if(isset($_GET["errorr"])){
        $mensaje_error="Debe ingresar todos sus datos completos";
        }
        
        if (isset($_GET['error']) && $_GET['error']== '1'){
        $mensaje_error="La clave debe tener al menos 6 caracteres";
        }
        
        if (isset($_GET['error']) && $_GET['error']== '2'){
        $mensaje_error= "La clave no puede tener más de 20 caracteres";
        }
        if (isset($_GET['error']) && $_GET['error']== '3'){
        $mensaje_error = "El email ingresado es incorrecto";
        }
        if (isset($_GET['error']) && $_GET['error']== '4'){
        $mensaje_error = "El nombre de usuario ya existe";
        }
        if (isset($_GET['error']) && $_GET['error']== '5'){
        $mensaje_error = "Dirección de correo duplicada";
        }       
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/login-style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/layout.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="<?php echo $base_js; ?>/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/cufon-replace.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/FF-cash.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/easyTooltip.js" type="text/javascript"></script>
	<script src="<?php echo $base_js; ?>/script.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/bgSlider.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/tms-0.3.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/tms_presets.js" type="text/javascript"></script>
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
<body id="page1">
	<div id="bgSlider"></div>
    <div class="bg_spinner"></div>
	<div class="extra">
        <!--==============================header=================================-->
<?php   $pag=2;
        include_once($base_usuarios."/views/header_usuarios.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main2">
                <section class="login-content">
                    <div class="indent-login">
                        <h3>Registrarse</h3>
                        <div class="p3">
                            <form id="login-contact-form" action="<?php echo $base_usuarios; ?>/controllers/process_registration.php" method="post" enctype="multipart/form-data">                    
                                <fieldset>
                                    <label class="login-label"><span class="login-text-form">Nombres:</span><input name="nombre" type="text" /></label>
                                    <label class="login-label"><span class="login-text-form">Apellidos:</span><input name="apellido" type="text" /></label>
                                    <label class="login-label"><span class="login-text-form">Email:</span><input name="email" type="text" /></label>
                                    <label class="login-label"><span class="login-text-form">Nick:</span><input name="usuario" type="text" /></label>
                                    <label class="login-label"><span class="login-text-form">Contraseña:</span><input name="contrasena" type="password" /></label>
                                    <div class="wrapper">
                                        <div class="extra-wrap">
                                            <div class="clear"></div>
                                            <div class="login-buttons">
                                                <a class="button-2" href="#" onClick="document.getElementById('login-contact-form').reset()">Limpiar</a>
                                                <a class="button-2" href="#" onClick="document.getElementById('login-contact-form').submit()">Registrarse</a>
                                            </div> 
                                        </div>
                                    </div>                            
                                </fieldset>                     
                            </form>
                        </div>
                    </div>
                    <span style= "color:red; font-size:15px;"><?php echo $mensaje_error; ?></span>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
	<!--==============================footer=================================-->
    <?php include_once($base_general."/views/footer.php");?>
    <script type="text/javascript"> Cufon.now(); </script>
    <script type="text/javascript">
		$(window).load(function() {
			$('.slider')._TMS({
				duration:1000,
				easing:'easeOutQuart',
				preset:'simpleFade',
				slideshow:10000,
				banners:'fade',
				pauseOnHover:true,
				waitBannerAnimation:false,
				pagination:'.pags'
			});
		});
    </script>
</body>
</html>
