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
            $query = "SELECT * FROM Orders, Suppliers, States WHERE Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID";
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
<html lang="es">
<head>
    <title>Listas de Ordenes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/orderslists-style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/sortedtable.css" type="text/css" media="screen">    
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
<body id="page4">
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
                                <li><a href="index.php">Inicio</a></li>
                                <li><a class="active" href="orders_lists.php">Lista de Ordenes</a></li>
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
            <div class="main">
                <section id="content">
                    <div class="bkg">
                        <div class="padding">
                            <div class="wrapper">
                                <article class="tabla">
                                <fieldset>
                                    <legend>Lista de Ordenes</legend>
                                    <br/>
                                    <table class="sortable" id="sorter">
                                        <tr>
                                            <th>ID</th>
                                            <th>PROVEEDOR</th>
                                            <th>FECHA DE CREACION</th>
                                            <th>FECHA DE ENTREGA</th>
                                            <th>ESTADO</th>
                                            <th>IR</th>
                                        </tr>
<?php                               foreach ($lista as $r)
                                    {?>
                                        <tr>
                                            <td><?php echo $r['orderID']; ?></td>
                                            <td><?php echo $r['supplier']; ?></td>
                                            <td><?php echo $r['creationDate']; ?></td>
                                            <td><?php echo $r['deliveryDate']; ?></td>
                                            <td><?php echo $r['state']; ?></td>
                                            <td><a href="orders_lists_update.php?listaid=<?php echo $r['orderListID']; ?>"><img src="images/go.png" alt=""></a></td>
                                        </tr>
<?php                               }?>
                                    </table>
                                    <br/>
                                    <ul>
                                        <li><a class="button-1" href="orders_lists_creation.php">Crear Ordenes</a></li>
                                        <li><a class="button-1" href="index.php">Volver</a></li>                     
                                    </ul>      
                                </fieldset>
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
    <?php include_once("../modulo/footer.php");?>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>