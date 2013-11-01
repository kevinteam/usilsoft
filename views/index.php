<?php
    session_start();
    include_once("../modulo/logeado.php");
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
                                <li><a href="#">Ayuda</a></li>
                                <li class="last"><a href="../controllers/logout.php">Logout</a></li>
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
                    <div class="slider">
                        <ul class="items">
                            <li>
                                <img src="images/slider-img1.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Lista de </strong><em>Ordenes</em>
                                    </strong>
                                    <p class="p3">Podra generar la lista de ordenes de forma dinamica.</p>
                                    <a class="button-1" href="orders_lists.php">Ir a Ordenes</a>
                                </div>
                            </li>
                            <li>
                                <img src="images/slider-img2.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Creacion de</strong><em>Kardex</em>
                                    </strong>
                                    <p>Podra crear un kardex automaticamente.</p>
                                    <a class="button-1" href="kardex.php">Ir a Kardex</a>
                                </div>
                            </li>
                            <li>
                                <img src="images/slider-img3.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Inserccion de</strong><em>Datos</em>
                                    </strong>
                                    <p>Ahora podra facilmente agregar proveedores,productos,marcas,etc.</p>
                                    <a class="button-1" href="datos.php">Ir a Datos</a>
                                </div>
                            </li>
                        </ul>
                        <a class="banner-2" href="#"></a>
                    </div>
                    <ul class="pags">
                    	<li><a href="orders_lists.php">1</a></li>
                        <li><a href="kardex.php">2</a></li>
                        <li><a href="datos.php">3</a></li>
                    </ul>
                    <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                                <article class="col-1">
                                    <h3>Lista de Ordenes</h3>
                                    <p>El siguiente link le permite generar y modificar listas de ordenes. Esta herramienta le permitira realizarlo con suma facilidad.</p>
                                    <div class="relative">
                                        <a class="button-2" href="orders_lists.php">Ir a Lista de Ordenes</a>
                                    </div>
                                </article>
                                <article class="col-1">
                                    <h3>Kardex</h3>
                                    <p>El siguiente link le permite generar el kardex automaticamente.</p>
                                    <div class="relative">
                                        <a class="button-2" href="kardex.php">Ir a Kardex</a>
                                    </div>
                                </article>
                                <article class="col-2">
                                    <h3>Datos</h3>
                                    <p>El siguiente link le permite agregar y/o modificar precios, productos, proveedores, marcas y todo lo relacionado con logistica. <a class="link" href="#">Insertar Datos</a>. <a class="link" href="mailto:usilsoft@outlook.com">Contactenos</a> (Porfavor contactenos en caso detecte algun error).</p>
                                    <div class="relative">
                                        <a class="button-2" href="datos.php">Ir a Datos</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="padding-2">
                        <div class="indent-top">
                            <div class="wrapper">
                                <article class="col-3">
                                    <h4><strong>Bienvenido</strong> <em>a la seccion Logistica</em></h4>
                                    <p class="color-2 p1">En esta pagina usted podra encontrar todas las herramientas necesarias para llevar un eficiente control de logistica. La cual cuenta con los siguiente:</p>
                                    <ul class="list-1">
                                        <li><a href="orders_lists.php">Agregar y modificar listas de ordenes</a></li>
                                        <li><a href="#">Generar Kardex</a></li>
                                        <li><a href="#">Agregar y/o modificar datos diversos de elementos de logistica y almacen</a></li>
                                    </ul>
                                </article>
                                <div class="extra-wrap">
                                    <a href="#"><img src="images/banner-1.jpg" alt="" /></a>
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
