<?php	
	$mensaje_error="";
		if (isset($_GET['cod_error']) && $_GET['cod_error']== '1'){
		$mensaje_error="Debe ingresar su contraseña";
		}
		
		if (isset($_GET['cod_error']) && $_GET['cod_error']== '2'){
		$mensaje_error="Usuario y/o contraseña es incorrecta";
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>password</title>
		<link href='css/css.css' type='text/css' rel='stylesheet'/>
		<script src="jquery-1.8.3.js"></script>
		<style>
		#formulario .enviar{margin-top:3px;width:330px;left:60px;}
		</style>
	</head>
	<body>
	  <div id='container'>
		<div id='header'>
		<img src='images/logo.jpg' alt=""/>
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a href="logout.php">Logout</a></li>
					<li> | </li>
					<li><a href="registro.php">Registrarse</a></li>
				</ul>
		
		</div>
		<div id='main'>
		<!-- CAMBIOS -->
		<h1 id="titulo">Cambiar Contraseña</h1>
		<div class="logueo-cuerpo">
			<div id="formulario">
				<form action="password_change.php"  method="post">
					<span style= "color:red; font-size:15px;"><?php echo $mensaje_error ?></span>
					
					<div class="izq label">Antigua Contraseña:</div>
					<input id="oldpassword" name="oldpassword" class="input der"  type="password" value="" size="30">
					<div style="clear:both"></div>
					
					<div class="izq label">Nueva Contraseña:</div>
					<input id="newpassword" name="newpassword" class="input der"  type="password" value="" size="30" maxlength="32" >
					<div style="clear:both"></div>
					
					<div class="enviar der">
					<input type="submit" class="submit izq" value="Procesar!">
					<a href="editar_datos.php" class="olvido">Regresar a editar</a>
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