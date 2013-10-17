<?php
session_start();

$tarjeta = $_POST["tarjeta"];
$seguridad = $_POST['seguridad'];
$mes = $_POST['mes'];
$year = $_POST['anho'];
$card = $_POST['card'];
$idsong = $_POST['idsong'];
$date = date("y-m-d H:i:s");

/* CONEXION BASE DE DATOS */
	include_once("modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */

/* Validación si la sesión de usuario se ha iniciado*/

if(isset($_SESSION['nombre_usuario'])){
	$user = $_SESSION['nombre_usuario'] ;
}

/* Validación de los datos ingresados */

if($tarjeta == "" || $seguridad == "" || $mes == "0" || $year == "0" || $card == ""){
	
	if ($mes !="0"){
		$_SESSION['mes'] = $mes;
	}
	
	if($year != "0"){
		$_SESSION['anho'] = $year;
	
	}
	$_SESSION['tarjeta'] = $tarjeta;
	$_SESSION['seguridad']= $seguridad;
	$_SESSION['card'] = $card;
	header("Location: prepago.php?modulo=sutarjeta&error=empty");
	exit;
}

if($tarjeta != "" && $seguridad != "" && $mes !="0" && $year != "0" && $card != ""){
if (strlen($tarjeta)!= 8 || ctype_digit($tarjeta) == false ){ 
	$_SESSION['tarjeta'] = $tarjeta;
	$_SESSION['seguridad']= $seguridad;
	$_SESSION['mes'] = $mes;
	$_SESSION['anho'] = $year;
	header("Location: prepago.php?modulo=sutarjeta&error=longitud");
	exit;
	}
	
if (strlen($seguridad) >3 || ctype_digit($seguridad) == false){ 
	$_SESSION['tarjeta'] = $tarjeta;
	$_SESSION['seguridad']= $seguridad;
	$_SESSION['mes'] = $mes;
	$_SESSION['anho'] = $year;
	header("Location: prepago.php?modulo=sutarjeta&error=longitudseg");
	exit;
	}
	
	/* sentencia que retorna el id del usuario q ha iniciado sesión */
$userid = mysql_query("SELECT USERID FROM user WHERE USERNAME='$user'");
$user_id = array();
$row = mysql_fetch_assoc($userid);
$id = $row["USERID"];

/* Insertar los datos a la tabla creditcard y creditcarduser */
mysql_query("INSERT INTO `order`(`SONGID`, `CURRENCYID`, `DATE`, `USERID`, `CREDITCARD`) VALUES ($idsong, 2,'$date', $id, '$tarjeta')") or die(mysql_error());
mysql_query("INSERT INTO creditcard VALUES ('$tarjeta', '$year', '$mes', '$seguridad', 'NULL' )") or die(mysql_error());
mysql_query("INSERT INTO creditcarduser VALUES ($id, '$tarjeta', '0')") or die(mysql_error());
session_unset();

echo "<script language='Javascript'>
	alert('Tu pago ha sido efectuado con exito');
	window.location='index.php';
	</script>";
	
$_SESSION['nombre_usuario'] = $user;
$_SESSION['usuario'] = $id;

}?>