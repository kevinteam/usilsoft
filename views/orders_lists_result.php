<?php
    session_start();
    $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    /* CONEXION BASE DE DATOS */
    include_once("../modulo/conexion.php");
    mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());
    /* FIN CONEXION BASE DE DATOS */
    
    if($logeado==true)
    {
        if (isset($_GET['resultado']) && $_GET['resultado'] == "'1'"){
            $resultado="Se genero las ordenes correctamente";
        }
        else
        {
            $resultado="Se produjo un error al generar las ordenes";
        }
        $idusuario = $_SESSION['usuario'];
    }
    else
    {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultado de Lista de Ordenes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/login-style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
    <script src="js/easyTooltip.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/bgSlider.js" type="text/javascript"></script>
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/tms-0.3.js" type="text/javascript"></script>
    <script src="js/tms_presets.js" type="text/javascript"></script>
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
        <header>
            <div class="top-row">
                <div class="main">
                    <div class="wrapper">
                        <h1><a href="index.php">Administracion de restaurantes - Area de Logistica</a></h1>
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
                                <li><a class="active" href="index.php">Inicio</a></li>
                                <li><a href="orders_lists.php">Lista de Ordenes</a></li>
                                <li><a href="kardex.php">Kardex</a></li>
                                <li><a href="datos.php">Datos</a></li>
                                <li class="last"><a href="../controllers/logout.php">Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            
        </header>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main2">
                <section class="login-content">
                    <div class="indent-login">
                        <h3>Generacion de Lista de Ordenes</h3>
                        <div class="p3">
                            <p><?php echo $resultado; ?></p>
                            <div class="wrapper">
                                <div class="extra-wrap">
                                    <div class="clear"></div>
                                    <div class="login-buttons">
                                        <a class="button-2" href="orders_lists.php">Regresar</a>
                                    </div> 
                                </div>
                            </div>                            
                        </div>
                    </div>
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
                        <!-- {%FOOTER_LINK} -->
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
