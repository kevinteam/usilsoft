<?php
	$base_general       = "../..";

    $base_inicial       = $base_general."/inicial";
	include_once($base_general."/views/request_post.php");

	session_start();

	/* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php"); 
	/* FIN CONEXION BASE DE DATOS */

	$nombre=$_POST["nombre"];
 	$marca=$_POST["marca"];
	$tipo=$_POST["tipo"];
	$unidades=$_POST["unidades"];
	$descripcion=$_POST["descripcion"];
	$id=isset($_POST['id'])?$_POST['id']:'nuevo';

	$query = "UPDATE Products SET product='$nombre', description='$descripcion'  WHERE productID=$id";

			$resultado = mysql_query($query) or die(mysql_error()) ;
	
	header("location: ../views/lista_productos.php");		
	
?>