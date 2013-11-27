<?php
    session_start();
    $base_general       = "../..";
    $base_css           = $base_general."/views/css";
    $base_js            = $base_general."/views/js";
    $base_images        = $base_general."/views/images";

    $base_inicial       = $base_general."/inicial";
    $base_ordenes       = $base_general."/ordenes";
    $base_contabilidad  = $base_general."/contabilidad";
    $base_almacen       = $base_general."/almacen";
    $base_usuarios      = $base_general."/usuarios";
    include_once($base_general."/views/logeado.php");
	/* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php");
    include_once($base_general."/views/conexion_mysql.php");
    /* FIN CONEXION BASE DE DATOS */
	


	if(!isset($_GET['page'])){
		$query = "SELECT Orders.deliveryDate, Products.product, Orders.qty, Orders.cost FROM Orders, Products WHERE Products.productID = Orders.productID AND Orders.stateID = 2";
		$result = mysql_query($query) or die(mysql_error());
		$datos = array();

		while ($row = mysql_fetch_array($result))
		{
			$datos[] = $row;
		}
		$a = 1;

	}
	else{
		$f1 = $_SESSION['fecha1'];
		$f2 = $_SESSION['fecha2'];
	
		$query = "SELECT Orders.deliveryDate, Products.product, Orders.qty, Orders.cost FROM Orders, Products WHERE Products.productID = Orders.productID AND Orders.stateID = 2 AND Orders.deliveryDate >= '$f1' AND Orders.deliveryDate <= '$f2'";
		$result = mysql_query($query) or die(mysql_error());
		$datos = array();

		while ($row = mysql_fetch_array($result))
		{
			$datos[] = $row;
		}
		
	}
	
		
	
	$ct = 0;
	$cct = 0;
	$tt = 0;
	
	/*
	<head>
		<title>Listado de personas</title>
		<style type="text/css"> 
			body {
				background-color: black;
				color: white;
			}
			
			table { 		
				color: white;		
			}  
		</style>
	</head>*/
?>


	

		
<?php
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
       
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {    
            $userid = (int)($_SESSION['usuario']);
            
            /* PAGINADO */
            // maximo por pagina
            $columnas = 1;
            $filas = 5;
            $limit = $columnas * $filas;
            $contador = 0;//sirve para saber donde ubicar los tr

            // pagina pedida
            if(isset($_GET["page"]))
            {
                $page = (int) $_GET["page"];
                if ($page < 1)
                {
                 $page = 1;
                }
            }
            else
            {
                $page=1;
            }

            $offset = ($page-1) * $limit;
            $_SESSION['offset'] = $offset;
            $_SESSION['limit']  = $limit;
            $_SESSION['page']  = $page;
            if(!isset($_GET['key'])){//si esta dentro de la pagina y despues de filtrado navegar entre paginado
                if( isset($_SESSION['array_filter']) )
                    unset($_SESSION['array_filter']);
                if( isset($_SESSION['total_array_filter_lists_orders']) )
                    unset($_SESSION['total_array_filter_lists_orders']);
            }
            if( isset($_SESSION['array_filter']) && isset($_SESSION['total_array_filter_lists_orders']) )
            {        
                $rs    = $_SESSION['array_filter'];
                $total = unserialize($_SESSION['total_array_filter_lists_orders']);
            }
            else
            {
                /* CONEXION BASE DE DATOS */
                include_once($base_general."/data/conexion.php"); 
                include_once($base_general."/views/conexion_mysql.php"); 
                /* FIN CONEXION BASE DE DATOS */
            
                $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM Orders, Suppliers, States WHERE Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID ORDER BY Orders.orderID ASC LIMIT $offset, $limit";
                $sqlTotal = "SELECT FOUND_ROWS() as total";

                $result = mysql_query($sql) or die(mysql_error());
                $rs = array();
                while($row = mysql_fetch_assoc($result))
                {
                    $rs[] = $row;
                }
                $rsTotal = mysql_query($sqlTotal) or die(mysql_error());

                // Total de registros sin limit
                $rowTotal = mysql_fetch_assoc($rsTotal);
                $total = $rowTotal["total"];
                /* FIN PAGINADO */
                mysql_close();
            }

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
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Kardex</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo $base_css; ?>/kardex.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/orderslists-style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/jquery-ui-timepicker-addon.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" media="screen">    
    <link rel="stylesheet" href="<?php echo $base_css; ?>/sortedtable.css" type="text/css" media="screen">    
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script>
        jquery2 = jQuery.noConflict( true );
    </script>
    <script src="<?php echo $base_js; ?>/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/cufon-replace.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/FF-cash.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/easyTooltip.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/script.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/bgSlider.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/tms-0.3.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/tms_presets.js" type="text/javascript"></script>
    <script src="<?php echo $base_js; ?>/scriptSort.js" type="text/javascript"></script>
    <style>
        tr td
        {
            border: 1px solid; 
        }
    </style>
    <script>
        (jquery2)(document).on("ready", evento);
        function evento (ev)
        {
            var fechainicial = $('#fechainicial');
            var fechafinal = $('#fechafinal');

            fechainicial.datetimepicker({ 
                dateFormat: "d/m/yy",
                timeFormat: "hh:mm:ss tt",
                onClose: function(dateText, inst) {
                    if (fechafinal.val() != '') {
                        var testStartDate = fechainicial.datetimepicker('getDate');
                        var testEndDate = fechafinal.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                            fechafinal.datetimepicker('setDate', testStartDate);
                    }
                    else {
                        fechafinal.val(dateText);
                    }
                },
                onSelect: function (selectedDateTime){
                    fechafinal.datetimepicker('option', 'minDate', fechainicial.datetimepicker('getDate') );
                }
            });
            fechafinal.datetimepicker({ 
                dateFormat: "d/m/yy",
                minDate:$("#fechainicial").datetimepicker("getDate"),
                timeFormat: "hh:mm:ss tt",
                onClose: function(dateText, inst) {
                    if (fechainicial.val() != '') {
                        var testStartDate = fechainicial.datetimepicker('getDate');
                        var testEndDate = fechafinal.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                            fechainicial.datetimepicker('setDate', testEndDate);
                    }
                    else {
                        fechainicial.val(dateText);
                    }
                }
            });
            (jquery2)("#subfilter").on("click",function(e){
                e.preventDefault();
                (jquery2)("#filtrarorden").submit();
            });
        }
    </script>
    <!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
        <script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
    <![endif]-->
</head>
<body id="page4">
    <div id="bgSlider"></div>
    <div class="bg_spinner"></div>
    <div class="extra">
        <!--==============================header=================================-->
<?php   $pag=4;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <div class="bkg">
                        <div class="padding">
                            <div class="wrapper">
                                <article class="tabla">
                                    <form id="filtrarorden" action="<?php echo $base_general; ?>/contabilidad/controllers/process_filter_kardex.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="isfiltered" value="yes">
                                        <label style="float:left; width:120px;">Fecha Inicial:</label>
                                        <input name="fechainicial" id="fechainicial" type="text" style="width:140px; float:left;"/>
                                        <label style="float:left; width:120px;">Fecha Final:</label>
                                        <input name="fechafinal" id="fechafinal" type="text" style="width:140px; float:left;"/>
                                        <a id="subfilter" class="button-1" href="#" style="float:left; margin-left:50px;">Filtrar</a>
                                    </form>
									
                                    <form id = "kardex" action="<?php echo $base_ordenes; ?>/controllers/process_login.php" method="post" enctype="multipart/form-data">                    
                                        <br/><br/>
										<p align = "center" style = "color: #ca4b00; font-weight: bold; font-size: 25px;"> KARDEX </p>		
										<table  width = "909" style = "border: 1px solid black; color: black;">
											<tr align = center style = "color: #ca4b00;">
												<td colspan = "2" width = "" align = center> S/. </td>
												<td colspan = "3" width = ""> ENTRADAS </td>
												<td colspan = "3" width = ""> SALIDAS </td>
												<td colspan = "3" width = ""> SALDOS </td>
											</tr>
											
											<tr align = center style = "color: #ca4b00;">
												<td width = ""> Fecha </td>
												<td width = ""> Producto </td>
												<td width = ""> Unidades </td>
												<td width = ""> Costo Unitario </td>
												<td width = ""> Total </td>		
												
												<td width = ""> Unidades </td>
												<td width = ""> Costo Unitario </td>
												<td width = ""> Total </td>
												
												
												<td width = ""> Unidades </td>
												<td width = ""> Costo Unitario </td>
												<td width = ""> Total </td>
											</tr>
											
											<?php foreach($datos as $p){?>
											<tr align = center>
												<td> <?=$p[0];?> </td>
												<td width = ""> <?=$p[1];?> </td>
												
												<td width = ""> <?=$p[2];?> </td>
												<td width = ""> <?=$p[3];?> </td>
												<td width = ""> <?=$p[2] * $p[3];?> </td>		
												
												<td width = ""> <?//=$p[6];?> </td>
												<td width = ""> <?//=$p[7];?> </td>
												<td width = ""> <?//=$p[8];?> </td>
												
												<?php $ct = $ct + $p[2]; $tt += $p[2] * $p[3]; $cct = $tt/$ct;

												?>
												<td width = ""> <?=$ct;?> </td>
												<td width = ""> <?=$cct;?> </td>
												<td width = ""> <?=$tt;?> </td>
											</tr>	
											<?php }?>
										</table>
										</br>
										<p>	<a href="<?php echo $base_inicial; ?>/views/index.php">Volver a inicio</a></p>				
                                    </form>
                                </article>
                             </div>
                        </div>
                    </div>                   
                </section>
                <div class="block"></div>
            </div>
        </div>         
    </div>
    <script type="text/javascript">
        var sorter=new table.sorter("sorter");
        sorter.init("sorter",0);
    </script>
<!--==============================footer=================================-->
    <?php include_once($base_general."/views/footer.php");?>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>