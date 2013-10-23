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
            /* FIN LISTA PROVEEDORES */
            /* LISTA MARCAS */
            $query = "SELECT Products.branchID AS branchid,Branchs.branch AS branch FROM ProductsCosts,Products,Branchs WHERE Branchs.branchID = Products.productID AND Products.productID = ProductsCosts.productID AND ProductsCosts.supplierID='$proveedor'";
            $resultado = mysql_query($query) or die(mysql_error());
            $branchs = array();
            while($row = mysql_fetch_array($resultado))
            {
                $branchs[] = $row;
            }
            /* FIN LISTA MARCAS */
            mysql_close();  
        
            $data = array(
                'ruc' => $ruc,
                'marcas' => $branchs  
            );  
            //$branch = [[1,"marca1"],[2,"marca2"]];
            //$branchjson = json_encode($branch);
            //echo "{ruc:$ruc,branchid:$branchjson}";
            echo json_encode($data);
        }
        else
        {
            header("Location: ../views/index.php");
            exit();
        }
    }
    else
    {
        header("Location: ../views/index.php?fallo=isset");
        exit();
    }
?>