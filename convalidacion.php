<?php 
	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		header('Location: index.php');
		exit();
	}

	if(!isset($_POST['usuario']) || $_POST['usuario'] == '' || !isset($_POST['password']) || $_POST['password'] == '' ){
		header('Location: login.php?cod_error=1');
		exit();
	}

	session_start();
	$usuario=$_POST['usuario'];
	$contrasena=md5($_POST['password']);

	/* CONEXION BASE DE DATOS */
		include_once("modulo/conexion.php");
		mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */

	$sql="SELECT USERID,USERNAME FROM User WHERE USERNAME='$usuario' AND PASSWORD = '$contrasena' " ;
	$resultado = mysql_query($sql) or die(mysql_error()) ;

	$user = array();
	if($row = mysql_fetch_array($resultado)){
		$user[] = $row;
	}

	if(count($user) != 0 )
	{
		#asumo que los datos son correctos
		foreach($user as $u)
		{
			$_SESSION['usuario']=$u['USERID'];
			$_SESSION['nombre_usuario']=$usuario;
		}
		#redireccionamos al usuario logueado
		header('Location: index.php');
		exit();
	}
	else
	{
		header('Location: login.php?cod_error=2');
		exit();
	}
?>