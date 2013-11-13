<?php
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

	if(($_SERVER['REQUEST_METHOD'] == 'GET') AND isset($_GET['listaid']))
	{
		session_start();
		$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
		if($logeado)
		{
			$userid = (int)($_SESSION['usuario']);
            $listaid = (int)($_GET['listaid']);
			/* CONEXION BASE DE DATOS */
            include_once($base_general."/data/conexion.php"); 
			mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
			mysql_select_db($db) or die(mysql_error());
			/* FIN CONEXION BASE DE DATOS */

			/* LISTA DE ORDENES */
			$query = "SELECT * FROM OrdersLists, Users WHERE OrdersLists.userID = Users.userID AND OrdersLists.orderListID = '$listaid'";
			$resultado = mysql_query($query) or die(mysql_error());
			$lista = array();
			while($row = mysql_fetch_array($resultado))
			{
				$lista[] = $row;
			}
            /* FIN LISTA DE ORDENES */
		    
            /* LISTA DE ORDENES */
            $query = "SELECT * FROM Orders, Suppliers, States, Products, Currencies,Units WHERE Orders.orderListID = '$listaid' AND Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID AND Orders.productID = Products.productID AND Orders.currencyID = Currencies.currencyID AND Products.unitID = Units.unitID";
            $resultado = mysql_query($query) or die(mysql_error());
            mysql_close();
            $lista2 = array();
            $simbolo = "S/.";
            $total = 0.0;
            while($row = mysql_fetch_array($resultado))
            {
                $lista2[] = $row;
                $total = $total+$row['cost'];
            }
            /* FIN LISTA DE ORDENES */
        }
		else
		{
			header("Location: ".$base_inicial."/views/index.php");
			exit();
		}
	}
	else
	{
		header("Location: ".$base_inicial."/views/index.php?fallo=isset");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Ordenes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/orderslists-list-style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/sortedtable.css" type="text/css" media="screen">    
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
    <script src="<?php echo $base_js; ?>/scriptSort.js" type="text/javascript"></script>	<!--[if lt IE 7]>
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
<?php   $pag=2;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <fieldset>
                        <legend>Lista de Ordenes</legend>
                    <div>
                        <div class="wrapper">
		                    <table id="tdatos" border="1" style="width:100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>USUARIO ENCARGADO</th>
                                        <th>FECHA DE CREACION</th>
									</tr>
								</thead>
								<tbody class="align-center">
<?php							foreach ($lista as $l)
								{ ?>
									<tr>
										<td><?php echo $l['orderListID']; ?></td>
										<td><?php echo $l['last'].", ".$l['name']; ?></td>
										<td><?php echo $l['creationDate']; ?></td>
									</tr>
<?php							} ?>
								</tbody>
								<tfoot>							
								</tfoot>
							</table>
                            <table class="sortable" id="sorter">
                                    <tr>
                                        <th>ID ORDEN</th>
                                        <th>FECHA DE ENTREGA</th>
                                        <th>PROVEEDOR</th>
                                        <th>RUC</th>
                                        <th>PRODUCTO</th>
                                        <th>CANTIDAD</th>
                                        <th>SUBTOTAL</th>
                                        <th>ESTADO</th>
                                    </tr>
<?php                           foreach ($lista2 as $o)
                                { ?>
                                    <tr>
                                        <td><?php echo $o['orderID']; ?></td>
                                        <td><?php echo $o['deliveryDate']; ?></td>
                                        <td><?php echo $o['supplier']; ?></td>
                                        <td><?php echo $o['ruc']; ?></td>
                                        <td><?php echo $o['product']; ?></td>
                                        <td><?php echo $o['qty']." ".$o['unit']; ?></td>
                                        <td><?php echo $o['symbol']." ".$o['cost']; ?></td>
                                        <td><?php echo $o['state']; ?></td>
                                    </tr>
<?php                           } ?>
                            </table>
                            <p><span>TOTAL: </span> <?php echo $simbolo." ".$total; ?></p>
							<ul>
								<li><a class="button-2" href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Volver</a></li>						
                            </ul>
                        </div>
                    </div>
                    </fieldset>
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
    <?php include_once($base_general."/views/footer.php");?>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>