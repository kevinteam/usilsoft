<?php
    session_start();
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

    /* CONEXION BASE DE DATOS */
    include_once("../modulo/conexion.php");
    mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());
   
    $query= "SELECT supplier,supplierID FROM Suppliers";
    $resultado = mysql_query($query);
    $prov = array();
    while ($row = mysql_fetch_array($resultado)){
    $prov[] = $row;
    }


    $query2= "SELECT branch,branchID FROM Branchs";
    $resultado2 = mysql_query($query2);
    $marca = array();
    while ($row1 = mysql_fetch_array($resultado2)){
    $marca[] = $row1;
    }

    $query3= "SELECT unit,unitID FROM Units";
    $resultado3 = mysql_query($query3);
    $unid = array();
    while ($row1 = mysql_fetch_array($resultado3)){
    $unid[] = $row1;
    }

    $query4= "SELECT productType,productTypeID FROM ProductsTypes";
    $resultado4 = mysql_query($query4);
    $tpro = array();
    while ($row1 = mysql_fetch_array($resultado4)){
    $tpro[] = $row1;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/table.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
        <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
    <script src="js/easyTooltip.js" type="text/javascript"></script>
	<script src="js/script.js" type="text/javascript"></script>
    <script src="js/bgSlider.js" type="text/javascript"></script>
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/tms-0.3.js" type="text/javascript"></script>
    <script src="js/tms_presets.js" type="text/javascript"></script>
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
<body id="page1">
	<div id="bgSlider"></div>
    <div class="bg_spinner"></div>
	<div class="extra">
        <!--==============================header=================================-->
        <header>
        	<div class="top-row">
            	<div class="main">
                	<div class="wrapper">
                        <h1><a href="index.php">Administracion de restaurantes - Area de Logistica</a></h1>
                        <ul class="pagination">
                            <li class="current"><a href="images/bg-img1.jpg">1</a></li>
                            <li><a href="images/bg-img2.jpg">2</a></li>
                            <li><a href="images/bg-img3.jpg">3</a></li>
                        </ul>
                        <strong class="bg-text">Background:</strong>
                    </div>
                </div>
            </div>
            <div class="menu-row">
            	<div class="menu-border">
                	<div class="main">
                        <nav>
                            <ul class="menu">
                                <li><a class="active" href="index.php">Inicio</a></li>
                                <li><a href="orders_lists.php">Lista de Ordenes</a></li>
                                <li><a href="#">Kardex</a></li>
                                <li><a href="datos.php">Datos</a></li>
                                <li class="last"><a href="../controllers/logout.php">Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
			
        </header>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                   <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                           
                          <form id="marca" name="marca" action="../controllers/procesar_producto.php" method="post">
                           <fieldset>
                            <legend>Insertar Producto</legend>     
                           <input type="hidden" name="id" />
                                                         <label >Marca : </label>
                             <select name="marca">
                                 <option >Escoger marca</option>
                                <?php foreach ($marca as $m){?>
                                <option value="<?php echo $m['1']?>"><?php echo $m['0']?></option>
                                 <?php }?>

                             </select><br><br><br>
                             <label for="nombre"> Nombre : </label>
                             <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre" required />
                             <br><br>
                             
                              <label >Unidades : </label>
                            <select name="unidades">
                                 <option >Escoger unidades</option>
                                <?php foreach ($unid as $u){?>
                                <option value="<?php echo $u['1']?>"><?php echo $u['0']?></option>
                                 <?php }?>

                             </select><br><br><br>

                             <label for="nombre"> Tipo Producto : </label>
                             <select name="tproducto">
                                 <option >Escoger tipo producto</option>
                                <?php foreach ($tpro as $t){?>
                                <option value="<?php echo $t['1']?>"><?php echo $t['0']?></option>
                                 <?php }?>

                             </select><br><br>
                             <br>
                            <label for="descripcion"> Descripción : </label>
                            <input type="text" name="descripcion" id="descripcion" placeholder="Ingrese una descripción" required />
                        
                           <br/>
                           <br/>      
                            <input  class="button-1" type="submit" value="Agregar Producto"/>
                            </fieldset>
                            </form>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
	<!--==============================footer=================================-->
   <footer>
        <div class="padding">
            <div class="main">
                <div class="wrapper">
                    <div class="fleft footer-text">
                        <span>Administrador de Restaurantes - Logistica </span> &copy; 2013
                        <strong>Desarrollado por <a rel="nofollow" class="link" target="_blank" href="#">Usilsoft</a></strong>
                        <!-- {%FOOTER_LINK} -->
                    </div>
                    <ul class="list-services">
                        <li>Conectate con Nosotros:</li>
                        <li><a class="tooltips" title="facebook" href="#"></a></li>
                        <li class="item-1"><a class="tooltips" title="twitter" href="#"></a></li>
                        <li class="item-2"><a class="tooltips" title="linkedin" href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        var sorter=new table.sorter("sorter");
        sorter.init("sorter",1);
    </script> 
    <script type="text/javascript"> Cufon.now(); </script>
    <script type="text/javascript">
        $(window).load(function() {
            $('.slider')._TMS({
                duration:1000,
                easing:'easeOutQuart',
                preset:'simpleFade',
                slideshow:10000,
                banners:'fade',
                pauseOnHover:true,
                waitBannerAnimation:false,
                pagination:'.pags'
            });
        });
    </script>