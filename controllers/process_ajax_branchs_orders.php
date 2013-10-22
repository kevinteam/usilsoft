<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $proveedor = $_POST['supplier'];
            $marca = $_POST['branch'];
            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
            mysql_select_db($db) or die(mysql_error());
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA PRODUCTOS */
            $query = "SELECT Products.productID AS productid, Products.product AS product FROM Products,ProductsCosts WHERE ProductsCosts.productID = Products.productID AND Products.branchID = '$marca' AND ProductsCosts.supplierID = '$proveedor'";
            $resultado = mysql_query($query) or die(mysql_error());
            $products = array();
            while($row = mysql_fetch_array($resultado))
            {
                $products[] = $row;
            }
            /* FIN LISTA PRODUCTOS */
            mysql_close();
            $data = array(
                'productos' => $products  
            );  
            echo json_encode($data);
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