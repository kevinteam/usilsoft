<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

    $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    /* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php"); 
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
        header("Location: ".$base_usuarios."/views/login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Resultado de Lista de Ordenes</title>
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
        include_once($base_general."/views/header.php");?>
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
                                        <a class="button-2" href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Regresar</a>
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
