<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $proveedor = $_POST['code'];
            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
            mysql_select_db($db) or die(mysql_error());
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA PROVEEDORES */
            $query = "SELECT ruc FROM Suppliers WHERE supplierID='$proveedor'";
            $resultado = mysql_query($query) or die(mysql_error());
            $ruc = "";
            if($row = mysql_fetch_array($resultado))
            {
                $ruc = $row['ruc'];
            }
            mysql_close();
            /* FIN LISTA PROVEEDORES */
            echo $ruc;

        }
        else
        {
            header("Location: index.php");
            exit();
        }
    }
    else
    {
        header("Location: index.php?fallo=isset");
        exit();
    }
?>