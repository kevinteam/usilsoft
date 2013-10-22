<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $proveedor = $_POST['supplier'];
            $marca = $_POST['branch'];
            $producto = $_POST['product'];
            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
            mysql_select_db($db) or die(mysql_error());
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA PRODUCTOS */
            $query = "SELECT Units.unit AS unit FROM Products,ProductsCosts,Units WHERE Products.unitID= Units.unitID AND ProductsCosts.productID = Products.productID AND Products.productID = '$producto' AND Products.branchID = '$marca' AND ProductsCosts.supplierID = '$proveedor'";
            $resultado = mysql_query($query) or die(mysql_error());
            $unidad = "";
            if($row = mysql_fetch_array($resultado))
            {
                $unidad = $row[0];
            }
            /* FIN LISTA PRODUCTOS */
            mysql_close();
            echo $unidad;
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