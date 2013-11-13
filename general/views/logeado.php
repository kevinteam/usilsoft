<?php 
	$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    $base_usuarios  = $base_general."/usuarios";
    
    if($logeado==true)
    {
        $idusuario = $_SESSION['usuario'];
    }
    else
    {
        header("Location: ".$base_usuarios."/views/login.php");
        exit();
    }
 ?>