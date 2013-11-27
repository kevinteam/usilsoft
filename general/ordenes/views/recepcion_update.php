<?php
	$base_general       = "../..";
    include_once($base_general."/views/variables.php");
	include_once($base_general."/data/conexion.php"); 
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	
	$order = $_POST['orderid'];
	$fecha = $_POST['fecha'];	
	
	$newDate = str_replace("/","-", $fecha);

	$query = "UPDATE `Orders` SET stateID = 2, deliveryDate = '$newDate' WHERE orderID = '$order'";
	mysql_query($query);
	header("Location: ".$base_general."/ordenes/views/recepcion_creation.php");
?>
