<?php 
	session_start();
    $base_general       = "..";
    $base_inicial       = $base_general."/inicial";
	unset($_SESSION['usuario']);
	unset($_SESSION['nombre_usuario']);
	header('Location: '.$base_inicial.'/views/index.php');
?>