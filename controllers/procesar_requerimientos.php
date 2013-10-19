<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["rName"]) && $_POST["rName"] != "" && isset($_POST["rBranch"]) && $_POST["rBranch"] != "" && isset($_POST["rSupplier"]) && $_POST["rSupplier"] != "" && isset($_POST["rQuantity"]) && $_POST["rQuantity"] != "" && isset($_POST["rPrice"]) && $_POST["rPrice"])
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
			include_once("modulo/conexion.php"); 
			mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
			mysql_select_db($db) or die(mysql_error());
			/* FIN CONEXION BASE DE DATOS */

			/* LISTA REQUERIMIENTOS */
			$query = "INSERT INTO ListaInsumos(CANTIDAD, PRECIO, UNIDAD, NOMBREPRODUCTO, PROVEEDOR, MARCA, USUARIO) VALUES('$quantity', '$price','$unit','$name','$supplier','$branch','$userid')";
			$resultado = mysql_query($query) or die(mysql_error());
			mysql_close();
			if(!$resultado)
			{
				header("Location: crear_requerimientos.php");
				exit();
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
		<link href='css/css.css' type='text/css' rel='stylesheet'>
	</head>
	<body>
		<div id='container'>
			<header>
				<img src='images/logo.jpg' alt="logo">
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="logout.php">Logout</a></li>
					<li> | </li>
					<li><?php if(isset($_SESSION['nombre_usuario'])) echo $_SESSION['nombre_usuario']; ?></li>
				</ul>
			</header>
			<article>
				<section>Fue generado correctamente la lista de Requerimientos</section>
				<aside><a href="crear_requerimientos.php">Volver</a></aside>
			</article>
			<footer>
			</footer>
	</body>
</html>