<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        session_start();
        $logeado = (isset($_SESSION['usuario']) && isset($_SESSION['nombre_usuario'])) ? true : false;
        if($logeado)
        {
            $userid = (int)($_SESSION['usuario']);
            date_default_timezone_set('America/Lima');
            $date = date('d/m/Y h:i:s a');

            /* CONEXION BASE DE DATOS */
            include_once("../modulo/conexion.php"); 
            mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
            mysql_select_db($db) or die(mysql_error());
            /* FIN CONEXION BASE DE DATOS */

            /* LISTA PROVEEDORES */
            $query = "SELECT supplierID,supplier FROM Suppliers";
            $resultado = mysql_query($query) or die(mysql_error());
            $listaproveedores = array();
            while($row = mysql_fetch_array($resultado))
            {
                $listaproveedores[] = $row;
            }
            /* FIN LISTA PROVEEDORES */

            /* LISTA ORDENES */
            $query = "SELECT * FROM OrdersLists, Orders, Suppliers, States WHERE OrdersLists.orderListID = Orders.orderListID AND Orders.supplierID = Suppliers.supplierID AND Orders.stateID = States.stateID";
            $resultado = mysql_query($query) or die(mysql_error());
            mysql_close();
            $lista = array();
            while($row = mysql_fetch_array($resultado))
            {
                $lista[] = $row;
            }
            /* FIN LISTA ORDENES */
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/orderslists-creation-style.css" type="text/css" media="screen">    
    <link rel="stylesheet" href="css/jquery-ui-timepicker-addon.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/reveal.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" media="screen">    
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script>
        jquery2 = jQuery.noConflict( true );
    </script>
    <script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
    <script src="js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
    <script src="js/easyTooltip.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/bgSlider.js" type="text/javascript"></script>
    <script src="js/jquery.reveal.js" type="text/javascript"></script>
    <script>
        var lista_json = {items:[]};
        var orden_json = {items:[]};
        var proveedor = "";
        var ruc = "";
        var cont = 0;
        (jquery2)(document).on("ready", evento);
        function evento (ev)
        {
            (jquery2)('#proveedores').on("change",function(){
                proveedor=$("#proveedores option:selected").text();
                (jquery2).ajax({
                    type: "post",
                    url: "../controllers/process_ajax_suppliers.php",
                    data: { code: (jquery2)(this).val() }
                }).done(function(data) {
                    (jquery2)('#rucs').val(data);
                    if(proveedor == "Elija un Proveedor")
                    {
                        document.getElementById('crearorden').setAttribute("data-reveal-id", " ");
                        (jquery2)("#prinerror").html("Debe Seleccionar un Proveedor");
                    }
                    else
                    {    
                        document.getElementById('crearorden').setAttribute("data-reveal-id", "myModal");
                        (jquery2)("#prinerror").html("");
                    }
                    ruc=data;
                });
            });
            (jquery2)("#tprincipal").on("click",".borrar",function(e){
                e.preventDefault();
                this.parentNode.parentNode.parentNode.removeChild( this.parentNode.parentNode );
                var ref = parseInt($(this).attr("ref"));
                for(var i = 0; i<lista_json.items.length;i++)
                {
                    if(lista_json.items[i].id == ref)
                        lista_json.items.splice(i,1);                
                }
            });
            (jquery2)("#tpop").on("click",".borrar",function(e){
                e.preventDefault();
                this.parentNode.parentNode.parentNode.removeChild( this.parentNode.parentNode );
                var ref = parseInt($(this).attr("ref"));
                for(var i = 0; i<orden_json.items.length;i++)
                {
                    if(orden_json.items[i].id == ref)
                        orden_json.items.splice(i,1);                
                }
            });
            (jquery2)('#crearorden').on("click",function(e){
                if($("#proveedores option:selected").text() == "Elija un Proveedor")
                {
                    (jquery2)("#prinerror").html("Debe Seleccionar un Proveedor");
                }
                else
                {
                    (jquery2)("#prinerror").html("");
                }
            });
            (jquery2)('#agregarorden').on("click",function(e){
                e.preventDefault();
                t1=$("#popmarca option:selected").text();
                t2=$("#popproducto option:selected").text();
                t3=$("#popcantidad").val()+" "+$("#popunidad option:selected").text();
                t4=$("#popmoneda option:selected").text()+" "+$("#popcosto").val();
                t5=$("#popfechaentrega").val();
                
                v1=$("#proveedores option:selected").val();//valor de proveedor
                v2=$("#popproducto option:selected").val();//valor de producto
                v3=$("#popcantidad").val();//valor de cantidad
                v4=$("#popunidad option:selected").val();//valor de unidad
                v5=$("#popcosto").val();//valor de costo
                v6=$("#popmoneda option:selected").val();//valor de moneda
                v7=$("#popfechaentrega").val();//valor de fecha de entrega
                if($("#proveedores option:selected").text() == "Elija un Proveedor")
                {
                    (jquery2)("#poperror").html("Debe Seleccionar un Proveedor");
                }
                else if($("#popcantidad").val().trim() == "" || $("#popcosto").val().trim() == "" || t2 == "Elija un producto" || t1 == "Elija una marca" || $("#popunidad option:selected").text() == "Elija una Unidad" || t5.trim() == "")
                {   
                    (jquery2)("#poperror").html("No puede dejar datos en blanco");
                }
                else
                {
                    /*DENTRO DE ORDENES*/
                    var orden_array = [];
                    var val_array = [];
                    orden_array.push(t1);//marca
                    orden_array.push(t2);//producto
                    orden_array.push(t3);//cantidad+unidad
                    orden_array.push(t4);//moneda+costo
                    orden_array.push(t5);//fecha de entrega
                    addRow("tpop",orden_array,cont);

                    val_array.push(v1);//proveedor
                    val_array.push(v2);//producto
                    val_array.push(v3);//cantidad
                    val_array.push(v4);//unidad
                    val_array.push(v5);//costo
                    val_array.push(v6);//moneda
                    val_array.push(v7);//fecha de entrega
                    orden_json.items.push({id:cont,orden:orden_array,orderval:val_array});
                    cont++;
                    (jquery2)("#poperror").html("");
                }
            });
            (jquery2)('#agregarlista').on("click",function(e){
                e.preventDefault();
                /*t1=$("#popproducto option:selected").text();
                t2=$("#popmarca option:selected").text();
                t3=proveedor;
                t4=$("#popcantidad").val()+" "+$("#popunidad option:selected").text();
                t5=$("#popmoneda option:selected").text()+" "+$("#popcosto").val();
                t6=ruc;
                t7=$("#popfechaentrega").val();
                t8="En Proceso";*/
                /*orden_array.push(t1);
                orden_array.push(t2);
                orden_array.push(t3);
                orden_array.push(t4);
                orden_array.push(t5);
                orden_array.push(t6);
                orden_array.push(t7);
                orden_array.push(t8);*/
                //addRow("tprincipal",orden_array);
                $("#tpop tbody").empty();
                document.getElementById('login-contact-form').reset();
                var cantidad = orden_json.items.length;
                for(var i=0;i<cantidad;i++)
                {
                    var orden_array = [];
                    orden_array.push(orden_json.items[i].orden[1]);
                    orden_array.push(orden_json.items[i].orden[0]);
                    orden_array.push(proveedor);
                    orden_array.push(orden_json.items[i].orden[2]);
                    orden_array.push(orden_json.items[i].orden[3]);
                    orden_array.push(ruc);
                    orden_array.push(orden_json.items[i].orden[4]);                    
                    orden_array.push("En proceso");
                    addRow("tprincipal",orden_array,orden_json.items[i].id);

                    var val_array = [];
                    val_array.push(orden_json.items[i].orderval[0]);
                    val_array.push(orden_json.items[i].orderval[1]);
                    val_array.push(orden_json.items[i].orderval[2]);
                    val_array.push(orden_json.items[i].orderval[3]);
                    val_array.push(orden_json.items[i].orderval[4]);
                    val_array.push(orden_json.items[i].orderval[5]);
                    val_array.push(orden_json.items[i].orderval[6]);
                    lista_json.items.push({id:orden_json.items[i].id,orden:orden_array,orderval:val_array});
                }
                orden_json = {items:[]};
            });
            function addRow(tableID,arreglo,ref)
            {
                var table = document.getElementById(tableID);
                var tbody = table.getElementsByTagName('tbody')[0];
                var rowCount = 0;//(jquery2)('#'+tableID).find('tbody > tr').length;
                var row = tbody.insertRow(tbody.rows.length);
                var cell1 = row.insertCell(0);
                var element1 = document.createElement('a');
                element1.setAttribute("href", "#");
                element1.setAttribute("ref",ref);
                element1.setAttribute("class", "borrar");
                element1.innerHTML = "Borrar";
                cell1.appendChild(element1);
                var arregloCount = arreglo.length;
                for(var i=0;i<arregloCount;i++)
                {
                    var cell = row.insertCell(i+1);
                    cell.innerHTML = arreglo[i];
                }
            }
            $('#popfechaentrega').datetimepicker({
                dateFormat: "d/m/yy",
                timeFormat: "hh:mm:ss tt"
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
        <header>
        	<div class="top-row">
            	<div class="main">
                	<div class="wrapper">
                        <h1><a href="index.html">Creacion de Lista de Ordenes</a></h1>
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
                                <li><a href="index.php">Inicio</a></li>
                                <li><a class="active" href="orders_lists.php">Lista de Ordenes</a></li>
                                <li><a href="#">Kardex</a></li>
                                <li><a href="#">Datos</a></li>
                                <li><a href="#">Ayuda</a></li>
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
                    <div class="indent">
                        <div class="wrapper">
                            <article class="col-1">
                                <p id="prinerror" style="color:red;"></p>
                                <div class="indent-left">
                                    <div class="orderslist-col1">
                                        <h3>AGREGAR LISTA</h3>    
                                        <h6>Proveedor</h6>
                                        <p>
                                            <select name="proveedores" id="proveedores">
                                                <option value="0">Elija un Proveedor</option>
<?php                                       foreach ($listaproveedores as $p)
                                            { ?>
                                                <option value="<?php echo $p['supplierID']; ?>"><?php echo $p['supplier']; ?></option>
<?php                                       } ?>
                                            </select>
                                        </p>
                                        <h6>RUC</h6>
                                        <p>
                                            <input type="text" id="rucs" name="rucs" value="" disabled>
                                        </p>
                                    </div>
                                    <div class="orderslist-col2">
                                        <div class="relative relative-center">
                                            <a class="button-2" id="crearorden" data-reveal-id="myModal" href="#">Agregar a la Lista</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-2">
                                <h3 class="border-bot">Fecha de Creacion</h3>
                                <div class="img-indent-bot">
                                    <h6>Fecha de Creacion </h6>
                                    <p class="p1"><?php echo $date; ?></p>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="wrapper p3">
                        <table id="tprincipal" border="1" style="width:100%">
                            <thead class="align-center">
                                <tr>
                                    <th>#</th>
                                    <th>PRODUCTO</th>
                                    <th>MARCA</th>
                                    <th>PROVEEDOR</th>
                                    <th>CANTIDAD</th>
                                    <th>COSTO</th>
                                    <th>RUC</th>
                                    <th>F. ENTREGA</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody class="align-center">
                            </tbody>
                            <tfoot>                         
                            </tfoot>
                        </table>
                    </div>
                    <div class="wrapper p3 align-right">
                        <div class="relative margen-derecho">
                            <a class="button-2" href="#">Generar Lista de Ordenes</a>
                        </div>
                    </div>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
    <div id="myModal" class="reveal-modal">
        <p>Orden de Compra</p>
        <div class="p3">
            <form id="login-contact-form" action="../controllers/process_login.php" method="post" enctype="multipart/form-data">                    
                <fieldset>
                    <p id="poperror" style="color:red;"></p>
                    <label class="login-label">
                        <span class="login-text-form">Marca:</span>
                        <select name="popmarca" id="popmarca">
                            <option value="0">Elija una Marca</option>
                            <option value="1">Gloria</option>
                            <option value="1">Nestle</option>
                            <option value="2">Inca Kola</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Producto:</span>
                        <select name="popproducto" id="popproducto">
                            <option value="0">Elija un Producto</option>
                            <option value="1">Leche descremada</option>
                            <option value="1">Yogurt</option>
                            <option value="2">Mantequilla</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Cantidad:</span>
                        <input name="popcantidad" id="popcantidad" type="text" />
                        <select name="popunidad" id="popunidad">
                            <option value="0">Elija una Unidad</option>
                            <option value="1">Botella</option>
                            <option value="1">Caja</option>
                            <option value="2">Bolsa</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Costo:</span>
                        <input name="popcosto" id="popcosto" type="text" />
                        <select name="popmoneda" id="popmoneda">
                            <option value="0">Elija una Moneda</option>
                            <option value="1">S/.</option>
                            <option value="1">$</option>
                            <option value="2">€</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Fecha de Entrega:</span>
                        <input name="popfechaentrega" id="popfechaentrega" type="text" />
                    </label>
                    <div class="wrapper">
                        <div class="extra-wrap">
                            <div class="clear"></div>
                            <div class="login-buttons">
                            <a class="button-2" href="#" onClick="document.getElementById('login-contact-form').reset()">Limpiar</a>
                            <a class="button-2" id="agregarorden" href="#">Agregar</a>
                        </div>
                    </div>
                    <table id="tpop" border="1" style="width:100%">
                        <thead class="align-center">
                            <tr>
                                <th>#</th>
                                <th>MARCA</th>
                                <th>PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>COSTO</th>
                                <th>FECHA DE ENTREGA</th>
                            </tr>
                        </thead>
                        <tbody class="align-center">
                        </tbody>
                        <tfoot>                         
                        </tfoot>
                    </table>
                            <a class="button-2 close-reveal-modal" id="agregarlista" href="#">Agregar a Lista</a>
                </div>                            
            </fieldset>                     
        </form>
        </div>
        <a class="close-reveal-modal x-close-reveal-modal">&#215;</a>
    </div>
	<!--==============================footer=================================-->
    <footer>
    	<div class="padding">
        	<div class="main">
                <div class="wrapper">
                	<div class="fleft footer-text">
                    	<span>Administrador de Restaurantes - Logistica </span> &copy; 2013
                        <strong>Desarrollado por <a rel="nofollow" class="link" target="_blank" href="#">Usilsoft</a></strong>
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
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>