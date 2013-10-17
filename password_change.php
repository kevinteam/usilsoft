<?php
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		header('Location: index.php');
		exit();	
	}	
	if(!isset($_POST['oldpassword']) || $_POST['oldpassword'] == '' || !isset($_POST['newpassword']) || $_POST['newpassword'] == '' )
	{
		header('Location: password.php?cod_error=1');
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
	include_once("modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	$query="SELECT USERID FROM user WHERE USERID='$id' AND PASSWORD = '$old' " ;
	$result=mysql_query($query);
	if($row=mysql_fetch_row($result))
	{
		$r= $row[0];
		$query_change="UPDATE user SET PASSWORD = '$new' WHERE USERID = $id";
		mysql_query($query_change);
		header("location:editar_datos.php");
	}
	else
	{
		echo "se produjo errores";
	}
?>