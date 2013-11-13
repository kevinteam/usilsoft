<?php
    session_start();
    $base_general       = "../..";
    $base_css           = $base_general."/views/css";
    $base_js            = $base_general."/views/js";
    $base_images        = $base_general."/views/images";

    $base_inicial       = $base_general."/inicial";
    $base_ordenes       = $base_general."/ordenes";
    $base_contabilidad  = $base_general."/contabilidad";
    $base_almacen       = $base_general."/almacen";
    $base_usuarios      = $base_general."/usuarios";
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
    <link rel="stylesheet" href="<?php echo $base_css; ?>/table.css" type="text/css" media="screen">
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
   		<script type="text/javascript" src="<?php echo $base_js; ?>/html5.js"></script>
        <link rel="stylesheet" href="<?php echo $base_css; ?>/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page1">
	<div id="bgSlider"></div>
    <div class="bg_spinner"></div>
	<div class="extra">
        <!--==============================header=================================-->
<?php   $pag=3;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                                        
        <h3>ENTRADA</h3>    
        <form action="<?php echo $base_contabilidad; ?>/controllers/procesar_kardex.php" method="post">
          <label>  Producto:</label> <input type="text" name="producto" value=""><br>
          <label>  Fecha: </label><input type="text" name="fecha" value=""><br>
          <label>  Numero de Unidades:</label> <input type="text" name="eUnid" value=""><br>
          <label>  Costo por Unidad:</label> <input type="text"name="eCosto" value=""><br>
            <input type="submit" value = "Entrada">
        </form>
        
        <h3>SALIDA</h3> 
        <form action="<?php echo $base_contabilidad; ?>/controllers/procesar_kardex.php" method="post">
           <label> Producto:</label> <input type="text" name="producto" value=""><br>
           <label> Fecha:</label> <input type="text" name="fecha" value=""><br>
           <label> Numero de Unidades:</label> <input type="text" name="sUnid" value=""><br>
            <input type="submit" value = "Salida">
        </form>
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