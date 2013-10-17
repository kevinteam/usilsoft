<?php
	session_start();
	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
	if(!$logeado)
	{
		$mensaje_error="";
		if (isset($_GET['cod_error']) && $_GET['cod_error']== '1'){
			$mensaje_error="Debe ingresar nombre de Usuario y/o contraseña";
		}		
		if (isset($_GET['cod_error']) && $_GET['cod_error']== '2'){
			$mensaje_error="Usuario y/o contraseña es incorrecta";
		}
	}
	else
	{
		header("Location: index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
		<link href='css/css.css' type='text/css' rel='stylesheet'/>
	</head>
	<body>
	  <div id='container'>
		<div id='header'>
		<img src='images/logo.jpg' alt=""/>
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a href="login.php">Login</a></li>
					<li> | </li>
					<li><a href="registro.php">Registrarse</a></li>
				</ul>
		
		</div>
		<div id='main'>
			<!-- CAMBIOS -->
			<h1 id="titulo">Iniciar sesión - Miembros</h1>
			<div class="logueo-cuerpo">
				<div id="formulario">
					<form action="convalidacion.php"  method="post">
						<div class="izq label">Usuario:</div>
						<input id="username" name="usuario" class="input der"  type="text" value="" size="30">
						<div style="clear:both"></div>
						
						<div class="izq label">Contraseña:</div>
						<input id="password" name="password" class="input der"  type="password" value="" size="30" maxlength="32" >
						<div style="clear:both"></div>
						<span style= "color:red; font-size:15px;"><?php echo $mensaje_error ?></span>
						<div class="enviar der">
						
						<input type="submit" class="submit izq" value="Ingresar ahora!">
						<a href="#" class="olvido">¿Olvidó su contraseña?</a>
						<a href="registro.php" class="registro">Soy nuevo, deseo registrarme</a>
						<div style="clear:both"></div>
						</div>					
					</form>				
				</div>
			</div>	
		</div>
		<div id='footer'>
		</div>
	  </div>	
	</body>
</html>