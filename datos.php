
<html>
<head>	
	<title>Audio Net</title>
	<link href='css/css1.css' type='text/css' rel='stylesheet'>
	
</head>

<body>

	<div id="container">
	
		<div id='header'>
				<img src='images/logo.jpg' alt="logo">
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="login.php">Login</a></li>
					<li> | </li>
					<li><a href="registro.php">Registrarse</a></li>
				</ul>
			</div>
		
		<div id="main">
		
			<div class="pago">
				<h1 id="tit"> Llenar datos de la tarjeta</h1>
				</br></br>
				<form action = "pago.html" method = "post">
				<div class="datos">Nro de tarjeta:<input id="username" name="usuario" class="data"  type="text" value="" size="30"></div>
				</br></br>
				<div class="datos">Cod. seguridad:<input id="username" name="usuario" class="data"  type="text" value="" size="30"></div>
				</br></br>
				<div class="datos">Indicar fecha de expiración</div>

				<select name="Mes">
				
				<option value="Mes"> Mes </option>
				
				</select>
				<select name="Año">
				
				<option value="Año"> Año </option>
				
				</select>
				</br></br>
				</form>
				<a href="pago.php"><input type="submit" value="Atras" ></a>
				

				<input type="button" onclick='alert("El pago se ha reazlizado con éxito.")' value="Continuar" />
								
				

			</div>	
		</div>
		
	</div>

</body>

</html>