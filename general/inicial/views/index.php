<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");
    include_once($base_general."/views/logeado.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
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
<?php   $pag=1;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <div class="slider">
                        <ul class="items">
                            <li>
                                <img src="<?php echo $base_images; ?>/slider-img1.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Lista de </strong><em>Ordenes</em>
                                    </strong>
                                    <p class="p3">Podra generar la lista de ordenes de forma dinamica.</p>
                                    <a class="button-1" href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Ir a Ordenes</a>
                                </div>
                            </li>
                            <li>
                                <img src="<?php echo $base_images; ?>/slider-img2.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Creacion de</strong><em>Kardex</em>
                                    </strong>
                                    <p>Podra crear un kardex automaticamente.</p>
                                    <a class="button-1" href="<?php echo $base_contabilidad; ?>/views/kardex.php">Ir a Kardex</a>
                                </div>
                            </li>
                            <li>
                                <img src="<?php echo $base_images; ?>/slider-img3.jpg" alt="" />
                                <div class="banner">
                                    <strong class="title">
                                        <strong>Inserccion de</strong><em>Datos</em>
                                    </strong>
                                    <p>Ahora podra facilmente agregar proveedores,productos,marcas,etc.</p>
                                    <a class="button-1" href="<?php echo $base_inicial; ?>/views/datos.php">Ir a Datos</a>
                                </div>
                            </li>
                        </ul>
                        <a class="banner-2" href="#"></a>
                    </div>
                    <ul class="pags">
                    	<li><a href="<?php echo $base_ordenes; ?>/views/orders_lists.php">1</a></li>
                        <li><a href="<?php echo $base_contabilidad; ?>/views/kardex.php">2</a></li>
                        <li><a href="<?php echo $base_inicial; ?>/views/datos.php">3</a></li>
                    </ul>
                    <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                                <article class="col-1">
                                    <h3>Lista de Ordenes</h3>
                                    <p>El siguiente link le permite generar y modificar listas de ordenes. Esta herramienta le permitira realizarlo con suma facilidad.</p>
                                    <div class="relative">
                                        <a class="button-2" href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Ir a Lista de Ordenes</a>
                                    </div>
                                </article>
                                <article class="col-1">
                                    <h3>Kardex</h3>
                                    <p>El siguiente link le permite generar el kardex automaticamente.</p>
                                    <div class="relative">
                                        <a class="button-2" href="<?php echo $base_contabilidad; ?>/views/kardex.php">Ir a Kardex</a>
                                    </div>
                                </article>
                                <article class="col-2">
                                    <h3>Datos</h3>
                                    <p>El siguiente link le permite agregar y/o modificar precios, productos, proveedores, marcas y todo lo relacionado con logistica. <a class="link" href="#">Insertar Datos</a>. <a class="link" href="mailto:usilsoft@outlook.com">Contactenos</a> (Porfavor contactenos en caso detecte algun error).</p>
                                    <div class="relative">
                                        <a class="button-2" href="<?php echo $base_inicial; ?>/views/datos.php">Ir a Datos</a>
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
                                        <li><a href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Agregar y modificar listas de ordenes</a></li>
                                        <li><a href="<?php echo $base_contabilidad; ?>/views/kardex.php">Generar Kardex</a></li>
                                        <li><a href="<?php echo $base_inicial; ?>/views/datos.php">Agregar y/o modificar datos diversos de elementos de logistica y almacen</a></li>
                                    </ul>
                                </article>
                                <div class="extra-wrap">
                                    <a href="#"><img src="<?php echo $base_images; ?>/banner-1.jpg" alt="" /></a>
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
