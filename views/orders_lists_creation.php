<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $userid = (int)($_SESSION['usuario']);
            //$dt = date('m/d/Y h:i:s a', time());

            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
            mysql_select_db($db) or die(mysql_error());
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA REQUERIMIENTOS */
            $query = "SELECT * FROM OrdersLists, Orders, Suppliers, States WHERE OrdersLists.orderListID = Orders.orderListID AND Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID";
            $resultado = mysql_query($query) or die(mysql_error());
            mysql_close();
            $lista = array();
            while($row = mysql_fetch_array($resultado))
            {
                $lista[] = $row;
            }
        }
        else
        {
            header("Location: index.php");
            exit();
        }
    }
    else
    {
        header("Location: index.php?fallo=isset");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/orderslists-creation-style.css" type="text/css" media="screen">    
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
<body id="page4">
	<div id="bgSlider"></div>
    <div class="bg_spinner"></div>
	<div class="extra">
        <!--==============================header=================================-->
        <header>
        	<div class="top-row">
            	<div class="main">
                	<div class="wrapper">
                        <h1><a href="index.html">Creacion de Lista de Ordenes</a></h1>
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
                                <li><a href="index.php">Inicio</a></li>
                                <li><a class="active" href="orders_lists.php">Lista de Ordenes</a></li>
                                <li><a href="#">Kardex</a></li>
                                <li><a href="#">Datos</a></li>
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
                    <div class="indent">
                    	<div class="wrapper">
                        	<article class="col-1">
                                <div class="indent-left">
                                    <div class="orderslist-col1">
                                        <h3>AGREGAR LISTA</h3>    
                                        <h6>Proveedor</h6>
                                        <p>
                                            <select name="supplier" id="supplier">
                                                <option value="1">Gloria</option>
                                                <option value="2">Nestle</option>
                                                <option value="3">ServePacket</option>
                                            </select>
                                        </p>
                                        <h6>RUC</h6>
                                        <p>
                                            <input type="text" value="324324324" disabled>
                                        </p>
                                    </div>
                                    <div class="orderslist-col2">
                                        <div class="relative relative-center">
                                            <a class="button-2" href="#">Agregar a la Lista</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-2">
                                <h3 class="border-bot">Fecha de Creacion</h3>
                                <div class="img-indent-bot">
                                    <h6>Fecha de Creacion </h6>
                                    <p class="p1">10/10/2013 10:08</p>
                                </div>
                                <div class="img-indent-bot">
                                    <h6>Fecha de Entrega </h6>
                                    <p class="p1"><input type="text" value=""></p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="wrapper p3">
                    	<table border="1" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>PRODUCTO</th>
                                    <th>MARCA</th>
                                    <th>PROVEEDOR</th>
                                    <th>CANTIDAD</th>
                                    <th>UNIDAD</th>
                                    <th>PRECIO</th>
                                    <th>MONEDA</th>
                                    <th>RUC</th>
                                </tr>
                            </thead>
                            <tbody class="align-center">
                                <tr>
                                    <td><a href="#">Borrar</a></td>
                                    <td>Yogurt Gloria Fresa</td>
                                    <td>Gloria</td>
                                    <td>Gloria</td>
                                    <td>Botella</td>
                                    <td>32</td>
                                    <td>320.00</td>
                                    <td>S/.</td>
                                    <td>123123123123</td>
                                </tr>
                                <tr>
                                    <td><a href="#">Borrar</a></td>
                                    <td>Gaseosa Inca Kola de 1 Litro</td>
                                    <td>Coca Cola</td>
                                    <td>Coca Cola</td>
                                    <td>Botella</td>
                                    <td>50</td>
                                    <td>250.00</td>
                                    <td>S/.</td>
                                    <td>123123123145</td>
                                </tr>
                            </tbody>
                            <tfoot>                         
                            </tfoot>
                        </table>
                    </div>
                    <div class="wrapper p3 align-right">
                        <div class="relative margen-derecho">
                            <a class="button-2" href="#">Generar Lista de Ordenes</a>
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