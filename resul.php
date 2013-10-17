<?php
	session_start();

	/* CONEXION BASE DE DATOS */
	include_once("modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */
	
	$usuario = $_POST["usuario"];
	$contrasena = md5($_POST["contrasena"]);
	$contrasenha = $_POST["contrasena"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$email=$_POST["email"];
	
	$sql="SELECT USERNAME FROM User WHERE USERNAME='$usuario'";
	$resultado = mysql_query($sql) or die(mysql_error());
	$numfilas = mysql_num_rows($resultado);

	$sql_email = "SELECT EMAIL FROM User WHERE EMAIL='$email'";
	$resultado_email = mysql_query($sql_email) or die(mysql_error());
	$numfilas_email = mysql_num_rows($resultado_email);
	
	/* Validar datos */
	
	if($nombre =="" || $apellido ==""  || $email =="" || $usuario =="" || $contrasenha =="" ){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: registro.php?errorr=1");
		exit;
	}
	elseif(strlen($contrasenha) < 6){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: registro.php?error=1");
		exit;
	}
	elseif(strlen($contrasenha) > 20){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: registro.php?error=2");
		exit;
	}
	elseif(!strpos($email,"@"))
	{
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		header("location: registro.php?error=3");
		exit;
	}
	elseif($numfilas != 0){
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: registro.php?error=4");
		exit;
	}
	elseif($numfilas_email != 0){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		header("location: registro.php?error=5");
		exit;
	}

	if($nombre != "" && $apellido !="" && $email !="" && $usuario != "" && $contrasena !="")
	{
		$query = "INSERT INTO User(NAME,LAST,EMAIL,USERNAME,PASSWORD) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contrasena')" ;
		$resultado = mysql_query($query) or die(mysql_error()) ;
		session_unset();
		session_start();
		if($resultado != false )
		{
			$query = "SELECT USERID FROM User WHERE USERNAME='$usuario'" ;
			$r = mysql_query($query) or die(mysql_error());
			if($row = mysql_fetch_array($r))
			{	
				$_SESSION['usuario'] = $row['USERID'];
				$_SESSION['nombre_usuario'] = $usuario;
			}
			header("Location: index.php");
			exit();
		}
		else
		{
			header("Location: login.php?errorregistro");
			exit();
		}
	}
	else
	{
		header("Location: login.php?errorvacio");
		exit();
	}
?>