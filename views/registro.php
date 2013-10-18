<?php
	session_start();
	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
	if($logeado)
	{
		header("Location: index.php");
	}
	$mensaje_error="";
		if(isset($_GET["errorr"])){
		$mensaje_error="Debe ingresar todos sus datos completos";
		}
		
		if (isset($_GET['error']) && $_GET['error']== '1'){
		$mensaje_error="La clave debe tener al menos 6 caracteres";
		}
		
		if (isset($_GET['error']) && $_GET['error']== '2'){
		$mensaje_error= "La clave no puede tener más de 20 caracteres";
		}
		if (isset($_GET['error']) && $_GET['error']== '3'){
		$mensaje_error = "El email ingresado es incorrecto";
		}
		if (isset($_GET['error']) && $_GET['error']== '4'){
		$mensaje_error = "El nombre de usuario ya existe";
		}
		if (isset($_GET['error']) && $_GET['error']== '5'){
		$mensaje_error = "Dirección de correo duplicada";
		}		
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro</title>
		<link href='../static/css/css.css' type='text/css' rel='stylesheet'>
		<script src="jquery-1.8.3.js"></script>
	</head>
	<body>
	  <div id='container'>
		<div id='header'>
			<img src='../static/images/logo.jpg' alt=""/>
		    <ul id="menu-top" >
				<li><a href="index.php">Inicio</a></li>
				<li> | </li>
				<li><a id="contactenos" href="login.php">Login</a></li>
				<li> | </li>
				<li><a href="registro.php">Registrarse</a></li>
			</ul>
		</div>
		<div id='main'>
			<div id="formulario-reg">
				<h1 class="title"> Iniciar una cuenta </h1>
				<form action="../controllers/resul.php"  method="post">
					
					<div class="izq label">Nombre:</div>
					<input  name="nombre" class="input der username"  type="text" value="" size="30"/>
					<div style="clear:both"></div>
					
					<div class="izq label">Apellido:</div>
					<input name="apellido" class="input der username"  type="text" value="" size="30"/>
					<div style="clear:both"></div>
					
					<div class="izq label">Usuario:</div>
					<input  name="usuario" class="input der username"  type="text" value="" size="30"/>
					<div style="clear:both"></div>
					
					
					<div class="izq label">Email</div>
					<input name="email" class="input der username"  type="text" value="" size="30"/>
					<div style="clear:both"></div>
					
					
					<div class="izq label">Contraseña:</div>
					<input id="password" name="contrasena" class="input der"  type="password" value="" size="30" maxlength="20" > 
			
					<div style="clear:both"></div>
					<p class="form-hint">Entre 6 y 20 caracteres</p>
					<span style= "color:red; font-size:15px;"><?php echo $mensaje_error ?></span>
					<input type="submit" class="submit izq" value="Registrarme">					
				
				</form>
			</div>
			<div id='razones'>
				<h2 class='subtitulo'> Usilsoft</h2>
			
				<div class="box">
					<img src="../static/images/favorites.png" alt="" class="dmco_image">
					<div class="dmco_html"><span>Administracion de <b>restaurantes</b></span></div>
				</div>
				<div class="box">
					<img src="../static/images/editorial.png" alt="" class="dmco_image">
					<div class="dmco_html"><span><b>Selecciones de calidad con contenido editorializado</b></span></div>
				</div>
				
				<div class="box">
					<img src="../static/images/categories.png" alt="" class="dmco_image">
					<div class="dmco_html"><span>Usilsoft</b></span></div>
				</div>
				
				<div class="box">
					<img src="../static/images/world.png" alt="" class="dmco_image">
					<div class="dmco_html"><span>USILSOFT</b></span></div>
				</div>
			</div>
			<div style="clear:both"></div>
		</div>
		<div id='footer'>
		</div>
	  </div>	
	</body>
</html>