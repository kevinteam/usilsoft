<?php
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $userid = (int)($_SESSION['usuario']);
            date_default_timezone_set('America/Lima');
            $format = 'd/m/Y h:i:s a';
            $fechainicial = $_POST['fechainicial'];//fecha
            $dateinicial = date_create_from_format($format, $fechainicial);
            $fechainicialformateada = date_format($dateinicial, 'Y-m-d H:i:s');

            $fechafinal = $_POST['fechafinal'];//fecha
            $datefinal = date_create_from_format($format, $fechafinal);
            $fechafinalformateada = date_format($datefinal, 'Y-m-d H:i:s');
            //$dt = date('m/d/Y h:i:s a', time());

            /* CONEXION BASE DE DATOS */
            include_once($base_general."/data/conexion.php");
            include_once($base_general."/views/conexion_mysql.php");
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA REQUERIMIENTOS */
            $offset = (int)($_SESSION['offset']);
            $limit  = (int)($_SESSION['limit']);
            if(isset($_POST['isfiltered']) && $_POST['isfiltered']=="yes")
            {    
                $columnas = 1;
                $filas = 5;
                $limit = $columnas * $filas;
                $page = 1;
                $offset = ($page-1) * $limit;
            }
            else
                $page = (int)($_SESSION['page']);
			$sql = "";
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Orders, Suppliers, States WHERE Orders.stateID = 2 AND Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID AND Orders.deliveryDate >= '$fechainicialformateada' AND Orders.creationDate <= '$fechafinalformateada' ORDER BY Orders.orderID ASC LIMIT $offset, $limit";
            $sqlTotal = "SELECT FOUND_ROWS() as total";

            $filters      = mysql_query($sql) or die(mysql_error());
            $filters_array = array();
            while($row = mysql_fetch_assoc($filters)){
                $filters_array[]=$row;
            }
            $_SESSION['array_filter'] = $filters_array;
            $rsTotal = mysql_query($sqlTotal) or die(mysql_error());
            
            // Total de registros sin limit
            $rowTotal = mysql_fetch_assoc($rsTotal);
            $total = $rowTotal["total"];
            




			
            $_SESSION['total_array_filter_lists_orders'] = serialize($total);
            mysql_close();                            
            $n = rand(10e16, 10e20);
            $key = base_convert($n, 10, 36);
			
			$_SESSION['fecha1'] = $fechainicialformateada;
			$_SESSION['fecha2'] = $fechafinalformateada;
            header("Location: ".$base_general."/contabilidad/views/kardex.php?page=1");
            exit();
        }
        else
        {
            header("Location: ".$base_inicial."/views/index.php");
            exit();
        }
    }
    else
    {
        header("Location: ".$base_inicial."/views/index.php?fallo=isset");
        exit();
    }
?>