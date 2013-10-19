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
			$query = "SELECT * FROM OrdersLists, Orders, Suppliers WHERE OrdersLists.orderListID = Orders.orderListID AND Orders.supplierID = Suppliers.supplierID";
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
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Ordenes de Compras</title>
		<link href='../static/css/css.css' type='text/css' rel='stylesheet'>
	</head>
	<body>
		<div id='container'>
			<header>
				<img src='../static/images/logo.jpg' alt="logo">
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="../controllers/logout.php">Logout</a></li>
					<li> | </li>
					<li><?php if(isset($_SESSION['nombre_usuario'])) echo $_SESSION['nombre_usuario']; ?></li>
				</ul>
			</header>
			<article>
				<section>
					<table border="1" style="width:100%">
						<thead>
							<tr>
								<th>ID ORDEN DE COMPRA</th>
								<th>PROVEEDOR</th>
								<th>FECHA DE CREACION</th>
								<th>FECHA DE ENTREGA</th>
								<th>ESTADO</th>
							</tr>
						</thead>
						<tbody>
<?php					foreach ($lista as $r)
						{ ?>
							<tr>
								<td><?php echo $r['orderID']; ?></td>
								<td><?php echo $r['supplier']; ?></td>
								<td><?php echo $r['creationDate']; ?></td>
								<td><?php echo $r['deliveryDate']; ?></td>
								<td><?php echo $r['state']; ?></td>
							</tr>
<?php					} ?>
						</tbody>
						<tfoot>							
						</tfoot>
					</table>
				</section>
				<aside>
					<a href="orders_lists_creation.php">Crear Lista de Ordenes de Compra</a>
					<a href="orders_lists_update.php">Modificar Lista de Ordenes</a>
					<a href="index.php">Volver</a>
				</aside>
			</article>
			<footer>
			</footer>
	</body>
</html>