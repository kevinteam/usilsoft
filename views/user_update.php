<?php 
session_start();
/* CONEXION BASE DE DATOS */
	include_once("../modulo/conexion.php"); 
		mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */

	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$email = $_POST["email"];

/* sentencia que retorna el id del usuario q ha iniciado sesión */
	$user = $_SESSION['nombre_usuario'];
	$userid = mysql_query("SELECT userID FROM Users WHERE userName='$user'") ;
	$row = mysql_fetch_assoc($userid) ;
	$id = $row["userID"];
	
/* actualiza la tabla usuario con los datos ingresados*/
	$query = "UPDATE Users SET name = '$nombre', last = '$apellido', email = '$email' WHERE userID = $id";
	mysql_query($query) or die(mysql_error());

	echo "<script language='Javascript'>
	alert('Tus datos han sido actualizados');
	window.location='editar_datos.php';
	</script>";
?>
