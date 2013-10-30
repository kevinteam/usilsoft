<?php 
$logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
    
    if($logeado==true)
    {
        $idusuario = $_SESSION['usuario'];
    }
    else
    {
        header("Location: login.php");
        exit();
    }
 ?>