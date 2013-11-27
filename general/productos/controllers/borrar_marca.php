<?php
	$base_general       = "../..";

	session_start();

	/* CONEXION BASE DE DATOS */
	include_once("$base_general/data/conexion.php");
 	include_once("$base_general/views/conexion_mysql.php");
	/* FIN CONEXION BASE DE DATOS */

	$id=$_POST["id"];
	$query = "UPDATE Branchs SET status='0' WHERE branchID='$id'";
		$resultado = mysql_query($query) or die(mysql_error()) ;

		
		if($resultado != false )
		{				
			header("Location: ../views/lista_marcas.php");
			exit();
		}
		else
		{
			header("Location: ../views/lista_marcas.php?errorborrar");
			exit();
		}
?>