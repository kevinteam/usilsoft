<?php 
	session_start();
	unset($_SESSION['usuario']);
	unset($_SESSION['nombre_usuario']);
	header('Location: index.php');
?>