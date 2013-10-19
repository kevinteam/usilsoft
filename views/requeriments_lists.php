<?php
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		session_start();
		$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
		if($logeado)
		{
			$userid = (int)($_SESSION['usuario']);
			$name = $_POST['rName'];
			$branch = $_POST['rBranch'];
			$supplier = $_POST['rSupplier'];
			$quantity = (double)($_POST['rQuantity']);
			$unit = $_POST['rUnit'];
			$price = (double)($_POST['rPrice']);
			//$dt = date('m/d/Y h:i:s a', time());

			/* CONEXION BASE DE DATOS */
			include_once("../modulo/conexion.php"); 
			mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
			mysql_select_db($db) or die(mysql_error());
			/* FIN CONEXION BASE DE DATOS */

			/* LISTA REQUERIMIENTOS */
			$query = "SELECT * FROM RequerimentsLists, Users WHERE RequerimentsLists.userID = User.userID";
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
		<title>Generadro de Lista de Requerimientos</title>
		<link href='../static/css/css.css' type='text/css' rel='stylesheet'>
	</head>
	<body>
		<div id='container'>
			<header>
				<img src='../static/images/logo.jpg' alt="logo">
			    <ul id="menu-top" >
					<li><a href="../views/index.php">Inicio</a></li>
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
								<th>LISTAID</th>
								<th>PRODUCTO</th>
								<th>CANTIDAD</th>
								<th>UNIDAD</th>
								<th>PRECIO</th>
								<th>PROVEEDOR</th>
								<th>MARCA</th>
								<th>USUARIO</th>
							</tr>
						</thead>
						<tbody>
<?php					foreach ($lista as $r)
						{ ?>
							<tr>
								<td><?php echo $r['LISTAID']; ?></td>
								<td><?php echo $r['NOMBREPRODUCTO']; ?></td>
								<td><?php echo $r['CANTIDAD']; ?></td>
								<td><?php echo $r['UNIDAD']; ?></td>
								<td><?php echo $r['PRECIO']; ?></td>
								<td><?php echo $r['PROVEEDOR']; ?></td>
								<td><?php echo $r['MARCA']; ?></td>
								<td><?php echo $r['USERNAME']; ?></td>
							</tr>
<?php					} ?>
						</tbody>
						<tfoot>							
						</tfoot>
					</table>
				</section>
				<aside><a href="index.php">Volver</a></aside>
			</article>
			<footer>
			</footer>
	</body>
</html>