<?php
    $base_general       = "../..";
    include_once($base_general."/views/variables.php");

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
            include_once($base_general."/data/conexion.php"); 
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
            $lista = array();
            while($row = mysql_fetch_array($resultado))
            {
                $lista[] = $row;
            }
            /* FIN LISTA ORDENES */

            /* LISTA MONEDAS */
            $query = "SELECT currencyID,symbol FROM Currencies";
            $resultado = mysql_query($query) or die(mysql_error());
            $listamonedas = array();
            mysql_close();
            while($row = mysql_fetch_array($resultado))
            {
                $listamonedas[] = $row;
            }
            /* FIN LISTA MONEDAS */
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
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/orderslists-creation-style.css" type="text/css" media="screen">    
    <link rel="stylesheet" href="<?php echo $base_css; ?>/jquery-ui-timepicker-addon.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $base_css; ?>/reveal.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" media="screen">    
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'>   
    <link rel="stylesheet" href="<?php echo $base_css; ?>/sortedtable.css" type="text/css" media="screen">    
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
    <script src="<?php echo $base_js; ?>/jquery.reveal.js" type="text/javascript"></script>
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
                    url: "<?php echo $base_ordenes; ?>/controllers/process_ajax_suppliers.php",
                    data: { code: (jquery2)(this).val() }
                }).done(function(data) {
                    (jquery2)('#rucs').val(JSON.parse(data).ruc);
                    (jquery2)('#popmarca')
                        .find('option')
                        .remove()
                        .end()
                    ;
                    (jquery2)('#popmarca').append((jquery2)('<option>', {
                        value: 0,
                        text: "Elija una Marca"
                    }));
                    var arreglo_marcas = JSON.parse(data).marcas;
                    for(var i=0; i<arreglo_marcas.length; i++)
                    {
                        (jquery2)('#popmarca').append((jquery2)('<option>', {
                            value: arreglo_marcas[i][0],
                            text: arreglo_marcas[i][1]
                        }));
                    }
                    if(proveedor == "Elija un Proveedor")
                    {
                        document.getElementById('crearorden').setAttribute("data-reveal-id", " ");
                        //(jquery2)("#prinerror").html("Debe Seleccionar un Proveedor");
                    }
                    else
                    {    
                        document.getElementById('crearorden').setAttribute("data-reveal-id", "myModal");
                        (jquery2)("#prinerror").html("");
                    }
                    ruc=JSON.parse(data).ruc;
                });
            });
            (jquery2)('#popmarca').on("change",function(){
                var marca=$("#popmarca option:selected").val();
                var prov=$("#proveedores option:selected").val();
                (jquery2).ajax({
                    type: "post",
                    url: "<?php echo $base_ordenes; ?>/controllers/process_ajax_branchs_orders.php",
                    data: { supplier: prov, branch: marca}
                }).done(function(data) {
                    (jquery2)('#popproducto')
                        .find('option')
                        .remove()
                        .end()
                    ;
                    (jquery2)('#popproducto').append((jquery2)('<option>', {
                        value: 0,
                        text: "Elija un producto"
                    }));
                    var arreglo_productos = JSON.parse(data).productos;
                    for(var i=0; i<arreglo_productos.length; i++)
                    {
                        (jquery2)('#popproducto').append((jquery2)('<option>', {
                            value: arreglo_productos[i][0],
                            text: arreglo_productos[i][1]
                        }));
                    }
                });
            });
            (jquery2)('#popproducto').on("change",function(){
                var marca=$("#popmarca option:selected").val();
                var prov=$("#proveedores option:selected").val();
                var producto=$("#popproducto option:selected").val();
                (jquery2).ajax({
                    type: "post",
                    url: "<?php echo $base_ordenes; ?>/controllers/process_ajax_products_orders.php",
                    data: { supplier: prov, branch: marca, product: producto}
                }).done(function(data) {
                    (jquery2)('#popunidad').val(data);
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
                e.preventDefault();
                if($("#proveedores option:selected").text() == "Elija un Proveedor")
                {
                    (jquery2)("#prinerror").html("Debe Seleccionar un Proveedor");
                }
                else
                {
                    (jquery2)("#prinerror").html("");
                }
            });
            (jquery2)('#enviar_lista').on("click",function(e){
                e.preventDefault();
                if(lista_json.items.length > 0)
                {
                    (jquery2)( "#json_lista_orden" ).val(JSON.stringify(lista_json));
                    (jquery2)( "#form_enviar_lista" ).submit();
                }
            });
            (jquery2)('#agregarorden').on("click",function(e){
                e.preventDefault();
                t1=$("#popmarca option:selected").text();
                t2=$("#popproducto option:selected").text();
                t3=$("#popcantidad").val()+" "+$("#popunidad").val();
                t4=$("#popmoneda option:selected").text()+" "+$("#popcosto").val();
                t5=$("#popfechaentrega").val();
                
                v1=$("#proveedores option:selected").val();//valor de proveedor
                v2=$("#popproducto option:selected").val();//valor de producto
                v3=$("#popcantidad").val();//valor de cantidad
                v4=$("#popcosto").val();//valor de costo
                v5=$("#popmoneda option:selected").val();//valor de moneda
                v6=$("#popfechaentrega").val();//valor de fecha de entrega
                if($("#proveedores option:selected").text() == "Elija un Proveedor")
                {
                    (jquery2)("#poperror").html("Debe Seleccionar un Proveedor");
                }
                else if($("#popcantidad").val().trim() == "" || $("#popcosto").val().trim() == "" || t2 == "Elija un producto" || t1 == "Elija una marca" || t5.trim() == "")
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
                    val_array.push(v2);//producto(producto ya tiene marca y cantidad)
                    val_array.push(v3);//cantidad
                    val_array.push(v4);//costo
                    val_array.push(v5);//moneda
                    val_array.push(v6);//fecha de entrega
                    orden_json.items.push({id:cont,orden:orden_array,orderval:val_array});
                    cont++;
                    (jquery2)("#poperror").html("");
                }
            });
            (jquery2)('#agregarlista').on("click",function(e){
                e.preventDefault();
                $("#tpop tbody").empty();
                document.getElementById('login-contact-form').reset();
                var cantidad = orden_json.items.length;
                for(var i=0;i<cantidad;i++)
                {
                    var orden_array = [];
                    orden_array.push(orden_json.items[i].orden[1]);
                    orden_array.push(orden_json.items[i].orden[0]);
                    orden_array.push(orden_json.items[i].orden[2]);
                    orden_array.push(orden_json.items[i].orden[3]);
                    orden_array.push(proveedor);
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
                    lista_json.items.push({id:orden_json.items[i].id,orden:orden_array,orderval:val_array,user:<?php echo $userid; ?>});
                }
                orden_json = {items:[]};
            });
            function addRow(tableID,arreglo,ref)
            {
                var table = document.getElementById(tableID);
                var tbody = table.getElementsByTagName('tbody')[0];
                var rowCount = 0;//(jquery2)('#'+tableID).find('tbody > tr').length;
                var row = tbody.insertRow(tbody.rows.length);
                var arregloCount = arreglo.length;
                for(var i=0;i<arregloCount;i++)
                {
                    var cell = row.insertCell(i);
                    cell.innerHTML = arreglo[i];
                }
                var lastcell = row.insertCell(arregloCount);
                var element1 = document.createElement('a');
                element1.setAttribute("href", "#");
                element1.setAttribute("ref",ref);
                element1.setAttribute("class", "borrar");
                var imgdel = document.createElement('img');
                imgdel.setAttribute("src","<?php echo $base_images; ?>/delete.png");
                imgdel.setAttribute("alt","Borrar");
                element1.appendChild(imgdel);
                //element1.innerHTML = "Borrar";
                lastcell.appendChild(element1);
            }
            $('#popfechaentrega').datetimepicker({
                dateFormat: "d/m/yy",
                minDate:0,
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
<?php   $pag=2;
        include_once($base_general."/views/header.php");?>
        <!--==============================content================================-->
        <div class="inner">
            <div class="main">
                <section id="content">
                    <fieldset id="fieldset1">
                    <legend>ORDENES DE COMPRA</legend>
                    <div class="indent">
                        <div class="wrapper">
                            <article class="col-1">
                                <p id="prinerror" style="color:red;"></p>
                                <div class="indent-left">
                                    <div class="orderslist-col1">
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
                                            <a class="button-2" id="crearorden" data-reveal-id="" href="#">Agregar Orden</a>
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
                                    <th>PRODUCTO</th>
                                    <th>MARCA</th>
                                    <th>CANTIDAD</th>
                                    <th>SUBTOTAL</th>
                                    <th>PROVEEDOR</th>
                                    <th>RUC</th>
                                    <th>F. ENTREGA</th>
                                    <th>ESTADO</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="align-center">
                            </tbody>
                            <tfoot>                         
                            </tfoot>
                        </table>
                    </div>
                    <form action="<?php echo $base_ordenes; ?>/controllers/process_lists_orders.php" id="form_enviar_lista" method="post">
                        <input type="hidden" name="json_lista_orden" id="json_lista_orden" value="">
                    </form>
                    <div class="wrapper p3 align-right">
                        <div class="relative margen-derecho">
                            <a class="button-2" href="#" id="enviar_lista">Generar Lista de Ordenes</a>
                        </div>
                    </div>
                    </fieldset>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>
    <div id="myModal" class="reveal-modal">
        <fieldset>
        <legend>Orden de Compra</legend>
        <div class="p3">
            <form id="login-contact-form" action="<?php echo $base_usuarios; ?>/controllers/process_login.php" method="post" enctype="multipart/form-data">                    
                    <p id="poperror" style="color:red;"></p>
                    <label class="login-label">
                        <span class="login-text-form">Marca:</span>
                        <select name="popmarca" id="popmarca">
                            <option value="0">Elija una Marca</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Producto:</span>
                        <select name="popproducto" id="popproducto">
                            <option value="0">Elija un Producto</option>
                        </select>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Cantidad:</span>
                        <input name="popcantidad" id="popcantidad" type="text" />
                        <input type="text" name="popunidad" id="popunidad" disabled>
                    </label>
                    <label class="login-label">
                        <span class="login-text-form">Costo:</span>
                        <input name="popcosto" id="popcosto" type="text" />
                        <select name="popmoneda" id="popmoneda">
<?php                       foreach ($listamonedas as $c)
                            { ?>
                                <option value="<?php echo $c['currencyID']; ?>"><?php echo $c['symbol']; ?></option>
<?php                       } ?>
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
                                <th>MARCA</th>
                                <th>PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>SUBTOTAL</th>
                                <th>FECHA DE ENTREGA</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody class="align-center">
                        </tbody>
                        <tfoot>                         
                        </tfoot>
                    </table>
                            <a class="button-2 close-reveal-modal" id="agregarlista" href="#">Agregar a Lista</a>
                </div>                            
        </form>
        </div>
        <a class="close-reveal-modal x-close-reveal-modal">&#215;</a>
            </fieldset>                     
    </div>
	<!--==============================footer=================================-->
    <?php include_once($base_general."/views/footer.php");?>
    <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>