<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");
    include_once($base_general."/views/logeado.php");
    
    /* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php"); 
    $id=$_GET["id"];
    $query = "SELECT * from Suppliers WHERE supplierID='$id'";
    $resultado = mysql_query($query) or die(mysql_error());

    $proveedor = array();
    while ($row = mysql_fetch_array($resultado)){
    $proveedor[] = $row;
    }
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
    <style>
        label
        {
            padding-top: 0px !important;
            margin-left: 20%;
        }
    </style>
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
<?php   $pag=5;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                   <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                            <?php foreach ($proveedor as $p){?>
                            <form id="proveedor" name="proveedor" action="<?php echo $base_almacen; ?>/controllers/procesar_proveedor.php" method="post">
                           <fieldset>
                            <legend>Editar Proveedor</legend>     
                           <input value="<?=$id?>" type="hidden" name="id" />
                             <label for="nombre"> Nombre : </label>
                             <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la marca" required value="<?php echo $p['supplier']?>"/>
                             <br>
                            <label for="direccion"> Dirección : </label>
                            <input type="text" name="direccion" id="direccion" placeholder="Ingrese la dirección" required value="<?php echo $p['address']?>"/>
                            <br>
                            <label for="ruc"> RUC : </label>
                            <input type="text" name="ruc" id="ruc" placeholder="Ingrese el RUC" required value="<?php echo $p['ruc']?>"/>
                           <?php }?>
                           <br>      
                            <input  class="button-1" type="submit" value="Actualizar Proveedor"/>
                            </fieldset>
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
</body>
</html>