<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");
    include_once($base_general."/views/logeado.php");

    /* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php");



    $query= "SELECT Products.productID, Products.product, Products.description, Branchs.branch, Units.unit, ProductsTypes.productType FROM
             Products INNER JOIN  Branchs ON Branchs.branchID = Products.branchID 
                      INNER JOIN  Units ON Products.unitID = Units.unitID
                      INNER JOIN  ProductsTypes ON Products.ProductTypeID = ProductsTypes.productTypeID 
                      ";
    $resultado = mysql_query($query);


    $campos = array();
    while ($row = mysql_fetch_array($resultado)) {
    $campos[]=$row;
    }

    
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/table.css" type="text/css" media="screen">
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="<?php echo $base_js; ?>/jquery-1.6.3.min.js" type="text/javascript"></script>
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
        label
        {
            padding-top: 0px !important;
            margin-left: 20%;
        }
    </style>
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
<?php   $pag=5;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    
                    <div class="bg">
                        <div class="padding">
                            <div class="wrapper">
                               
<article class="tabla">
                        <h3>Listado de Productos</h3>
        <!--<form action="marcas.php" method="get">
        <p>Buscar canci&oacute;n: <input value="<?php echo $buscar ?>" type="search" name="buscar" placeholder="Ingrese su b&uacute;squeda" autofocus/> <input type="submit" value="Buscar"/> </p>
        </form> -->
        <br/>
                        <table class="sortable" id="sorter">
                        <tr>
                            
                            <th>Product Name</th>
                            <th>Branch</th>
                            <th>Product Type</th>
                            <th>Units</th>
                            <th>Description</th>

                            <th colspan="2">Acciones</th>
                        </tr>
                        <?php foreach ($campos as $c) { ?>
                        <tr>
                            
                             <td><?php echo $c[1]?></td>
                             <td><?php echo $c[3]?></td>
                             <td><?php echo $c[5]?></td>
                             <td><?php echo $c[4]?></td>
                             <td><?php echo $c[2]?></td>
                              <td>    
                    <form action="<?php echo $base_productos; ?>/controllers/borrar_marca.php" method="post">
                        <input value="<?php echo $c['productID']?>" type="hidden" name="id" /> 
                        <input type="image" alt="boton borrar" src="<?php echo $base_images; ?>/delete.png" title="Eliminar"/>
                    </form>
                </td>
                <td>
                    <form action="<?php echo $base_productos; ?>/views/editar_producto.php" method="get">
                        <input value="<?php echo $c['productID']?>" type="hidden" name="id" />
                        <input type="image" alt="boton editar" src="<?php echo $base_images; ?>/edit.png" title="Editar"/>
                    </form>
                </td>
                         </tr>
                         <?php } ?>
                     </table>


        <br/>
        <a class="button-1" href="<?php echo $base_productos; ?>/views/agregar_producto.php">Agregar Producto</a>      
        </article>




                            </div>
                        </div>
                    </div>
                    <div class="padding-2">
                        <div class="indent-top">
                            <div class="wrapper">
                                <article class="col-3">
                                   
                                </article>
                                <div class="extra-wrap">
                                                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
	<!--==============================footer=================================-->
    <?php include_once($base_general."/views/footer.php");?>
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
</body>
</html>