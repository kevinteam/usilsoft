<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $proveedor = $_POST['json_lista_orden'];
            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            $link = mysqli_connect($mysqliserver,$mysqllogin,$mysqlpass,$db);
            /* check connection */
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
            /* FIN CONEXION BASE DE DATOS */
            date_default_timezone_set('America/Lima');
            $json = json_decode($proveedor,true);
            $estado = 1;
            $usuario = (int)$json['items'][0]['user'];
            $fechacreacion = date('Y-m-d H:i:s');
            $query = "INSERT INTO OrdersLists(creationDate,userID) VALUES ('$fechacreacion', '$usuario')" ;
            $resultado = mysqli_query($link, $query) or die(mysqli_error($link));
            $insertado = true;
            if (mysqli_affected_rows ( $link )<1)
            {
                mysqli_close($link);
                header("Location: ../views/index.php");
                exit();
            }
            else
            {
                $listaid = mysqli_insert_id($link);   
                for($i=0;$i<count($json['items']);$i++)
                {
                    $proveedor = (int)$json['items'][$i]['orderval'][0];//proveedor
                    $producto = (int)$json['items'][$i]['orderval'][1];//producto
                    $cantidad = (double)$json['items'][$i]['orderval'][2];//cantidad
                    $costo = (double)$json['items'][$i]['orderval'][3];//costo
                    $moneda = (int)$json['items'][$i]['orderval'][4];//moneda
                    $fechaentrega = $json['items'][$i]['orderval'][5];//fecha
                    $format = 'd/m/Y h:i:s a';
                    $date = date_create_from_format($format, $fechaentrega);
                    $fechaentregaformateada = date_format($date, 'Y-m-d H:i:s');
 
                    $query = "INSERT INTO Orders(productID,qty,cost,orderListID,supplierID,stateID,currencyID,creationDate,deliveryDate) VALUES ('$producto','$cantidad','$costo','$listaid','$proveedor','$estado','$moneda','$fechacreacion','$fechaentregaformateada')";
                    $resultado = mysqli_query($link, $query) or die(mysqli_error($link));
                    if (mysqli_affected_rows ( $link )<1)
                    {
                        $insertado = false;
                    }
                }
                mysqli_close($link);
                header("Location: ../views/orders_lists_result.php?resultado='$insertado'");
                exit();
            }
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