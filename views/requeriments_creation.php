<?php
	session_start();
	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
	/* CONEXION BASE DE DATOS */
	include_once("modulo/conexion.php");
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
		<title>Generador de Lista de Requerimientos</title>
		<link href='css/css.css' type='text/css' rel='stylesheet'>
	</head>
	<body>
		<div id='container'>
			<header>
				<img src='static/images/logo.jpg' alt="logo">
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="logout.php">Logout</a></li>
					<li> | </li>
					<li><?php if(isset($_SESSION['nombre_usuario'])) echo $_SESSION['nombre_usuario']; ?></li>
				</ul>
				<hgroup>
					<h1 class="title">CREACION DE REQUERIMIENTOS</h1>
					<h2>Ingrese los datos para generar una lista de requerimientos</h2>
				</hgroup>
			</header>
			<article id="formulario-crearreq">
				<form action="procesar_requerimientos.php"  method="post">
					
					<div class="izq label">Nombre de Producto:</div>
					<input  name="rName" class="input izq username"  type="text" value=""/>
					<div style="clear:both"></div>
					
					<div class="izq label">Marca:</div>
					<input name="rBranch" class="input izq username"  type="text" value=""/>
					<div style="clear:both"></div>
					
					<div class="izq label">Proveedor:</div>
					<input  name="rSupplier" class="input izq username"  type="text" value=""/>
					<div style="clear:both"></div>
					
					
					<div class="izq label">Cantidad</div>
					<input name="rQuantity" class="input izq username"  type="text" value=""/>
					<div style="clear:both"></div>
					
					
					<div class="izq label">Unidad:</div>
					<input name="rUnit" class="input izq username"  type="text" value=""> 
					<div style="clear:both"></div>
			
					<div class="izq label">Precio:</div>
					<input name="rPrice" class="input izq username"  type="text" value="">
					<div style="clear:both"></div>

					<input type="submit" class="submit izq" value="Crear">					
					<a href="index.php">Volver</a>
				</form>
			</article>
			<footer>
			</footer>
	</body>
</html>