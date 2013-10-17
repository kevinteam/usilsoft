<?php
	session_start();
	
/* CONEXION BASE DE DATOS */
include_once("modulo/conexion.php"); 
		mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */

$logeado = (isset($_SESSION['nombre_usuario']) && isset($_SESSION['usuario']) ) ? true : false;
if($logeado==false){
	header("Location: index.php"); 
}

/* sentencia que retorna el id del usuario q ha iniciado sesión */
	$user = $_SESSION['nombre_usuario'];
	$userid = mysql_query("SELECT USERID FROM user WHERE USERNAME='$user'");
	$row = mysql_fetch_assoc($userid);
	$id = $row["USERID"];

/* sentencia que retorna el numero de tarjeta */
	$sql = "SELECT CREDITCARD FROM creditcarduser where USERID = $id AND ISMAINCARD = 1";
	$resultado = mysql_query($sql) or die(mysql_error());
	$row1= mysql_fetch_assoc($resultado);
	$credit = $row1['CREDITCARD'];

/* sentencia que retorna los datos de la tarjeta del usuario */
	$query = "SELECT * FROM creditcard where CREDITCARD = '$credit' ";
	$resultado1 = mysql_query($query) or die(mysql_error());
	$tarjeta= array();
	while ($row2 = mysql_fetch_array($resultado1)){
		$tarjeta[] = $row2;
	}
	
	if(count($tarjeta) == 0 ){ // si el arreglo tarjeta no retorna datos
			$agregar = '<p id="parrafo">REALIZA TU PRIMERA COMPRA Y AGREGA TU TARJETA AHORA MISMO</p>';
	}
	else{
		$agregar = "" ;
	}

/* sentencia que retorna los datos del usuario */
	$query1 = "SELECT * FROM user where USERID = $id ";
	$resultado2 = mysql_query($query1) or die(mysql_error());
	$usuario= array();
	while ($row3 = mysql_fetch_array($resultado2)){
		$usuario[] = $row3;
	}
	
	
	$meses = array("Seleccionar Mes", "Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
	$anho = date("o");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Editar</title>
		<link href='css/css.css' type='text/css' rel='stylesheet'>
		<script src="jquery-1.8.3.js"></script>
	</head>
	<body>
		<div id='container'>
			<div id='header'>
			
				<img src='images/logo.jpg' alt=""/>
				<ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<?php 			if(!$logeado){ ?>
					<li><a  href="login.php">Login</a></li>
					<li> | </li>
					<li><a href="registro.php">Registrarse</a></li>
					<?php 			}
				else
				{ ?>
					<li><a  href="logout.php">Logout</a></li>
					<li> | </li>
					<li><?php if(isset($_SESSION['nombre_usuario'])) echo $_SESSION['nombre_usuario']; ?>
					<li> | </li>
					<li><a  href="comprados.php">Mis Compras</a></li>
					<li> | </li>
					<li><a href="editar_datos.php"><img src="images/lapiz.jpg" alt="comprar" ></a></li>	
					<?php 			} ?>
				</ul>
			
			</div>
			<div id='main'>
				<div id="infotarjeta">
				<h1 class="title"> Editar datos de la tarjeta </h1>
				<form action ="<?php if(count($tarjeta) != 0 ){ ?><?php echo "actualizar_tarjeta.php"; }else{?><?php echo "modulo/sutarjeta.php";}?>" method = "POST">
				<?php foreach ($tarjeta as $t){ ?>
					
						
					<div class="dato">Nro de tarjeta:<input id="username" name="tarjeta" class="datas"  type="text" value="<?php echo $t['CREDITCARD']?>" size="30"></div>
					</br></br>
					<div class="dato">Cod. seguridad:<input id="username" name="seguridad" class="datas"  type="password" value="<?php echo $t['SECRETCODE']?>" size="30"></div>
					</br></br>
					
				<div class="dato">Fecha de vencimiento:
				</br>
				<select name="mes"> 
						<option value="<?php echo $t['MONTHEXP']?>"> <?php echo $meses[$t['MONTHEXP']]?></option>
						<?php for ($mes = 1; $mes<=12 ; $mes++) { ?>
			
							<option value="<?php echo $mes?>"> <?php echo $meses[$mes]?> </option>
						
						<?php } ?>
					</select>
					
					<select name="anho">
						<option value="<?php echo $t['YEAREXP']?>"><?php echo $t['YEAREXP']?></option>
						<?php for ($ahos = $anho; $ahos <= 2500 ; $ahos++) { ?>
				
							<option value="<?php echo $ahos;?>"> <?php echo $ahos;?>	</option>
						
						<?php } ?>
					</select>
						<?php } ?>
					<input type="submit" class="submit izq" value="Actualizar"> </br>
					<?php echo $agregar?>	
				</div>
			
					</form>	
				</div>
				<div id="infousuario">
				<h1 class="title"> Editar información </h1>
				<?php foreach ($usuario as $u){ ?>
					<form action="actualizar_usuario.php"  method="post">
						
						<div class="izq label">Nombre:</div>
						<input  name="nombre" class="input der username"  type="text" value="<?php echo $u['NAME']?>" size="30"/>
						<div style="clear:both"></div>
						
						<div class="izq label">Apellido:</div>
						<input name="apellido" class="input der username"  type="text" value="<?php echo $u['LAST']?>" size="30"/>
						<div style="clear:both"></div>
						
						<div class="izq label">Email</div>
						<input name="email" class="input der username"  type="text" value="<?php echo $u['EMAIL']?>" size="30"/>
						<div style="clear:both"></div>

					<?php } ?>
						<input type="submit" class="submit izq" value="Actualizar">
					</form>	
				
				<a href = "password.php" > Cambiar contraseña </a>
				</div>
				
				<div style="clear:both"></div>
			</div>
			<div id='footer'>
			</div>
		</div>	
	</body>
</html>