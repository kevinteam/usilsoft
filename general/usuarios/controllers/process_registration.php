<?php
	session_start();
	$base_general       = "../..";
    include_once($base_general."/views/variables.php");

	/* CONEXION BASE DE DATOS */
	include_once($base_general."/data/conexion.php");
	include_once($base_general."/views/conexion_mysql.php");
	/* FIN CONEXION BASE DE DATOS */
	
	$usuario = $_POST["usuario"];
	$contrasena = md5($_POST["contrasena"]);
	$contrasenha = $_POST["contrasena"];
	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$email=$_POST["email"];
	
	$sql="SELECT userName FROM Users WHERE userName='$usuario'";
	$resultado = mysql_query($sql) or die(mysql_error());
	$numfilas = mysql_num_rows($resultado);

	$sql_email = "SELECT email FROM Users WHERE email='$email'";
	$resultado_email = mysql_query($sql_email) or die(mysql_error());
	$numfilas_email = mysql_num_rows($resultado_email);
	
	/* Validar datos */
	
	if($nombre =="" || $apellido ==""  || $email =="" || $usuario =="" || $contrasenha =="" ){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: ".$base_usuarios."/views/registration.php?errorr=1");
		exit;
	}
	elseif(strlen($contrasenha) < 6){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: ".$base_usuarios."/views/registration.php?error=1");
		exit;
	}
	elseif(strlen($contrasenha) > 20){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: ".$base_usuarios."/views/registration.php?error=2");
		exit;
	}
	elseif(!strpos($email,"@"))
	{
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		header("location: ".$base_usuarios."/views/registration.php?error=3");
		exit;
	}
	elseif($numfilas != 0){
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		$_SESSION["email"] = $email;
		header("location: ".$base_usuarios."/views/registration.php?error=4");
		exit;
	}
	elseif($numfilas_email != 0){
		$_SESSION['usuario_n'] = $usuario;
		$_SESSION["nombre"] = $nombre ;
		$_SESSION["apellido"] = $apellido;
		header("location: ".$base_usuarios."/views/registration.php?error=5");
		exit;
	}

	if($nombre != "" && $apellido !="" && $email !="" && $usuario != "" && $contrasena !="")
	{
		$query = "SELECT userID FROM Users WHERE userName='$usuario'" ;
		$resultado = mysql_query($query) or die(mysql_error()) ;
		$r = mysql_query($query) or die(mysql_error());
		if($row = mysql_fetch_array($r))
		{
			header("Location: ".$base_usuarios."/views/login.php?errorregistro");
			exit();
		}
		else
		{
			$query = "INSERT INTO Users(name,last,email,userName,password) VALUES ('$nombre', '$apellido', '$email', '$usuario', '$contrasena')" ;
			$resultado = mysql_query($query) or die(mysql_error()) ;
			session_unset();
			session_start();
			if($resultado != false )
			{
				$query = "SELECT userID FROM Users WHERE userName='$usuario'" ;
				$resultado = mysql_query($query) or die(mysql_error()) ;
				$r = mysql_query($query) or die(mysql_error());
				if($row = mysql_fetch_array($r))
				{
					$_SESSION['usuario'] = $row['userID'];
					$_SESSION['nombre_usuario'] = $usuario;
				}				
				header("Location: ".$base_inicial."/views/index.php");
				exit();
			}
			else
			{
				header("Location: ".$base_usuarios."/views/login.php?errorregistro");
				exit();
			}
		}
	}
	else
	{
		header("Location: ".$base_usuarios."/views/login.php?errorvacio");
		exit();
	}
?>