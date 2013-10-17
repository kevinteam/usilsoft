
<html>
<head>	
	<title>Audio Net</title>
	<link href='css/css1.css' type='text/css' rel='stylesheet'>
	
</head>

<body>

	<div id="container">
	
		<div id="header">
		<img src='images/logo.jpg'></img>
		<ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a id="contactenos" href="#">Login</a></li>
					<li> | </li>
					<li><a href="#">Registrarse</a></li>
				</ul>
		</div>
		
		<div id="main">
			<div class="pago">
			<h1 id="tit"> Informacion del Usuario</h1>
				</BR>
				<div class="datos">Nombre:<input id="username" name="usuario" class="data"  type="text" value="" size="30"></div>
				</br>
				</br>
				<div class="datos">Apellido:<input id="username" name="usuario" class="data"  type="text" value="" size="30"></div>
				</br>
				</br>
				<div class="datos">Email: <input id="username" name="usuario" class="data"  type="text" value="" size="30"></div>
				</br>
				</br>
			<h1 id="tit"> Seleccione su forma de pago</h1>
			
			<div class="datos">Tarjeta de credito: Seleccione su tarjeta</div>
			</br>
				
				<form action = "datos.php" ,method = "post">
				<input type="radio" name="card" class="credit">
				
				<img src="images/visa.jpg">
				<input type="radio" name="card" class="credit">
				<img src="images/mastercard.jpg">
				<input type="radio" name="card" class="credit">
				<img src="images/paypal.jpg">
				</br></br>
				
				<input type="submit" value="Pagar" >
				</form>
			</div>
		</div>
		
	</div>

</body>

</html>