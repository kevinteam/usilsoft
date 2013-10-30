<?php
	
	include_once("../modulo/request_post.php");

	session_start();

	/* CONEXION BASE DE DATOS */
	include_once("../modulo/conexion.php");
 	include_once("../modulo/conexion_mysql.php");
	/* FIN CONEXION BASE DE DATOS */
	
	$nombre=$_POST["nombre"];
	$descripcion=$_POST["descripcion"];
	$id=isset($_POST['id'])?$_POST['id']:'nuevo';

	$sql_nombre = "SELECT branch FROM branchs WHERE branch='$nombre'";
	$resultado_nombre = mysql_query($sql_nombre) or die(mysql_error());
	$numfilas_nombre = mysql_num_rows($resultado_nombre);
	
	/* Validar datos */
	
	if($nombre =="" || $descripcion =="" ){
		$_SESSION['descripcion'] = $descripcion;
		$_SESSION["nombre"] = $nombre;
		header("location: ../views/lista_marcas.php?errorr=vacio");
		exit;
	}
	/* 
	elseif($numfilas_nombre != 0){
		$_SESSION['descripcion'] = $descripcion;
		$_SESSION["nombre"] = $nombre ;
		header("location: ../views/agregar_marca.php?error=yaexiste");
		exit;
	}
 */
	if($id=='nuevo'){
			$query = "INSERT INTO Branchs(branch,description) VALUES ('$nombre', '$descripcion')" ;
			$resultado = mysql_query($query) or die(mysql_error()) ;

	}else{
		$query = "UPDATE Branchs SET branch='$nombre', description='$descripcion' WHERE branchID='$id'";

			$resultado = mysql_query($query) or die(mysql_error()) ;
	}
			
			if($resultado != false )
			{				
				header("Location: ../views/lista_marcas.php");
				exit();
			}
			else
			{
				header("Location: ../views/lista_marcas.php?errorregistro");
				exit();
			}
?>