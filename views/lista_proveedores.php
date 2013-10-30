<?php
    session_start();
    include_once("../modulo/logeado.php");

    /* CONEXION BASE DE DATOS */
    include_once("../modulo/conexion.php");
    include_once("../modulo/conexion_mysql.php");

    $query = "SELECT * from suppliers";
    $resultado = mysql_query($query) or die(mysql_error());

    $proveedores = array();
    while ($row = mysql_fetch_array($resultado)){
    $proveedores[] = $row;
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
    <link rel="stylesheet" href="css/table.css" type="text/css" media="screen">
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
    <script src="js/scriptSort.js" type="text/javascript"></script>
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
                                <li><a href="#">Kardex</a></li>
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
                    <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                        <article class="tabla">
                        <h3>Listado de Proveedores</h3>
                        <!--<form action="marcas.php" method="get">
                        <p>Buscar canci&oacute;n: <input value="<?php echo $buscar ?>" type="search" name="buscar" placeholder="Ingrese su b&uacute;squeda" autofocus/> <input type="submit" value="Buscar"/> </p>
                         </form> -->
                        <br/>
                        <table class="sortable" id="sorter">
                        <tr>
                            <th>ID Proveedor</th>
                            <th>Nombre del Proveedor</th>
                            <th>RUC</th>
                            <th>Dirección</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                        <?php foreach ($proveedores as $p){?>
                        <tr>
                        <td> <?php echo $p['supplierID']?></td>
                        <td> <?php echo $p['supplier']?></td>
                        <td> <?php echo $p['ruc']?></td>
                        <td> <?php echo $p['address']?></td>
                        <td>    
                            <form action="borrar_proveedor.php" method="post">
                                <input value="<?php echo $m['supplierID']?>" type="hidden" name="id" /> 
                                <input type="image" alt="boton borrar" src="images/delete.png" title="Eliminar"/>
                            </form>
                        </td>
                        <td>
                        <form action="editar_proveedor.php" method="get">
                            <input value="<?php echo $p['supplierID']?>" type="hidden" name="id" />
                            <input type="image" alt="boton editar" src="images/edit.png" title="Editar"/>
                        </form>
                        
                            </td>
                        </tr>
                        <?php }?>
                        </table>
                    <br/>
                    <a class="button-1" href="agregar_proveedor.php">Agregar Proveedor</a>      
                    </article>
                             </div>
                        </div>
                    </div>                   
                </section>
                   <div class="block"></div>
            </div>
        </div>         
  </div>
    <script type="text/javascript">
        var sorter=new table.sorter("sorter");
        sorter.init("sorter",0);
    </script>
<!--==============================footer=================================-->
    <?php include_once("footer.php");?>