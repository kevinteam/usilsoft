<?php
	session_start();
	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
	/* CONEXION BASE DE DATOS */
	include_once("../modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */
	
   	//$_SESSION['usuario'] = 1;
   	//$_SESSION['nombre_usuario'] = "analisamelchoto";
   	/*CAROUSEL SI USUARIO INICIO SESION */
   	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario']) ) ? true : false;
   	if($logeado==true)
   	{
   		$idusuario = $_SESSION['usuario'];
   	}
   	else
	{
		header("Location: login.php?fallo=isset");
		exit();
	}
   	/*FIN CAROUSEL SI USUARIO INICIO SESION*/
?>
<!doctype html>	
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Administrador de Restaurante (Seccion Logistica)</title>
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
					<h1 class="title">¿Que Desea Realizar?</h1></b>
					<ul>
						<li><a href="orders_lists.php">Ir a lista de Ordenes</a></li>
						<li><a href="mostrar_requerimientos.php">Obtener Requerimientos</a></li>
						<li><a href="crear_requerimientos.php">Crear Requerimientos</a></li>
					</ul>
				</section>
			</article>
			<footer>
			</footer>
	</body>
</html>