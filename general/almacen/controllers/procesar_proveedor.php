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
	$ruc=$_POST["ruc"];
	$direccion=$_POST["direccion"];
	$id=isset($_POST['id'])?$_POST['id']:'nuevo';

	$sql_ruc = "SELECT ruc FROM suppliers WHERE ruc='$ruc'";
	$resultado_ruc = mysql_query($sql_ruc) or die(mysql_error());
	$numfilas_ruc = mysql_num_rows($resultado_ruc);
	
	/* Validar datos */
	
	if($nombre =="" || $direccion =="" || $ruc == ""){
		$_SESSION['direccion'] = $direccion;
		$_SESSION["nombre"] = $nombre;
		header("location: ../views/lista_proveedores.php?errorr=vacio");
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
			$query = "INSERT INTO Suppliers(supplier,ruc, address) VALUES ('$nombre', '$ruc', '$direccion')" ;
			$resultado = mysql_query($query) or die(mysql_error()) ;

	}else{
		$query = "UPDATE Suppliers SET supplier='$nombre', address='$direccion', ruc='$ruc' WHERE supplierID='$id'";

			$resultado = mysql_query($query) or die(mysql_error()) ;
	}
			
			if($resultado != false )
			{				
				echo $base_almacen;
				header("Location: ../views/lista_proveedores.php");
				exit();
			}
			else
			{
				header("Location: ../views/lista_proveedores.php?errorregistro");
				exit();
			}
?>