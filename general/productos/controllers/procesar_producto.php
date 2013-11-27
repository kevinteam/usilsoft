<?php
	session_start();
	$base_general       = "../..";

	/* CONEXION BASE DE DATOS */
	include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php"); 
	/* FIN CONEXION BASE DE DATOS */
	
	
	$marca=$_POST["marca"];
	$nombre=$_POST["nombre"];
	$unidades=$_POST["unidades"];
	$tipo=$_POST["tproducto"];
	$descripcion=$_POST["descripcion"];

	$sql_nombre = "SELECT product FROM Products WHERE product='$nombre'";
	$resultado_nombre = mysql_query($sql_nombre) or die(mysql_error());
	$numfilas_nombre = mysql_num_rows($resultado_nombre);
	
	/* Validar datos */
	
	if($nombre =="" || $descripcion =="" ){
		$_SESSION['descripcion'] = $descripcion;
		$_SESSION["nombre"] = $nombre ;
		header("location: ../views/registration.php?errorr=vacio");
		exit;
	}
	elseif($numfilas_nombre != 0){
		$_SESSION['descripcion'] = $descripcion;
		$_SESSION["nombre"] = $nombre ;
		header("location: ../views/agregar_producto.php?error=existe");
		exit;
	}

	if($nombre != "" && $descripcion!= ""){
			$query = "INSERT INTO Products(product,description,productTypeID,unitID,branchID) VALUES ('$nombre','$descripcion','$tipo','$unidades','$marca')" ;
			$resultado = mysql_query($query) or die(mysql_error()) ;
			
			session_start();
		}
			
			if($resultado != false )
			{				
				header("Location: ../views/lista_productos.php");
				exit();
			}
			else
			{
				header("Location: ../views/lista_productos.php?errorregistro");
				exit();
			}
?>