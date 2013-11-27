<?php
    session_start();
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");
    include_once($base_general."/views/logeado.php");

    /* CONEXION BASE DE DATOS */
    include_once($base_general."/data/conexion.php"); 
    include_once($base_general."/views/conexion_mysql.php");

    $query = "SELECT * from Branchs";
    $resultado = mysql_query($query) or die(mysql_error());

    $marcas = array();
    while ($row = mysql_fetch_array($resultado)){
    $marcas[] = $row;
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
                        <h3>Listado de Marcas</h3>
                        <!--<form action="marcas.php" method="get">
                        <p>Buscar canci&oacute;n: <input value="<?php echo $buscar ?>" type="search" name="buscar" placeholder="Ingrese su b&uacute;squeda" autofocus/> <input type="submit" value="Buscar"/> </p>
                         </form> -->
                        <br/>
                        <table class="sortable" id="sorter">
                        <tr>
                            <th>ID Marca</th>
                            <th>Nombre de Marca</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                        <?php foreach ($marcas as $m){?>
                        <tr>
                        <td> <?php echo $m['branchID']?></td>
                        <td> <?php echo $m['branch']?></td>
                        <td> <?php echo $m['description']?></td>
                        <td> <?php echo $m['status']?'ACTIVO':'INACTIVO'?></td>
                        <td>    
                            <form action="<?php echo $base_productos; ?>/controllers/borrar_marca.php" method="post">
                                <input value="<?php echo $m['branchID']?>" type="hidden" name="id" /> 
                                <input type="image" alt="boton borrar" src="<?php echo $base_images; ?>/delete.png" title="Eliminar"/>
                            </form>
                        </td>
                        <td>
                        <form action="<?php echo $base_productos; ?>/views/editar_marca.php" method="get">
                            <input value="<?php echo $m['branchID']?>" type="hidden" name="id" />
                            <input type="image" alt="boton editar" src="<?php echo $base_images; ?>/edit.png" title="Editar"/>
                        </form>
                    <!--     <a href="editar_marca.php?id=<?php echo $m['branchID']?>"><img src="images/edit.png"></a> -->
                            </td>
                        </tr>
                        <?php }?>
                        </table>
                    <br/>
                    <a class="button-1" href="<?php echo $base_productos; ?>/views/agregar_marca.php">Agregar Marca</a>      
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
</body>
</html>