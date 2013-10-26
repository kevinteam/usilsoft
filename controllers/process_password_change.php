<?php
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		header('Location: ../views/index.php');
		exit();	
	}	
	if(!isset($_POST['oldpassword']) || $_POST['oldpassword'] == '' || !isset($_POST['newpassword']) || $_POST['newpassword'] == '' )
	{
		header('Location: ../views/password_change.php?cod_error=1');
		exit();
	}
	session_start();
	$id=$_SESSION['usuario'];
	$n=$_SESSION['nombre_usuario'];
	$old=MD5($_POST['oldpassword']);
	$new=MD5($_POST['newpassword']);
	echo $old;
	echo $new."</br>";
	echo $id;
	echo $n;
	/* CONEXION BASE DE DATOS */
	include_once("../modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	$query="SELECT userID FROM Users WHERE userID='$id' AND password = '$old' " ;
	$result=mysql_query($query);
	if($row=mysql_fetch_row($result))
	{
		$r= $row[0];
		$query_change="UPDATE Users SET password = '$new' WHERE userID = $id";
		mysql_query($query_change);
		header("location:../views/password_change.php");
		exit();
	}
	else
	{
		echo "Se produjo errores";
	}
?>
