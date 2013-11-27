        <header>
            <div class="top-row">
                <div class="main">
                    <div class="wrapper">
                        <h1><a href="<?php echo $base_inicial; ?>/views/index.php">Administracion de restaurantes - Area de Logistica</a></h1>
                        <ul class="pagination">
                            <li class="current"><a href="<?php echo $base_images; ?>/bg-img1.jpg">1</a></li>
                            <li><a href="<?php echo $base_images; ?>/bg-img2.jpg">2</a></li>
                            <li><a href="<?php echo $base_images; ?>/bg-img3.jpg">3</a></li>
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
                                <li><a <?php if($pag === 1){ ?> class="active"<?php } ?> href="<?php echo $base_inicial; ?>/views/index.php">Inicio</a></li>
                                <li><a <?php if($pag === 2){ ?> class="active"<?php } ?> href="<?php echo $base_ordenes; ?>/views/orders_lists.php">Lista de Ordenes</a></li>
                                <li><a <?php if($pag === 3){ ?> class="active"<?php } ?> href="<?php echo $base_ordenes; ?>/views/recepcion.php">Recepcion de Pedidos</a></li>
                                <li><a <?php if($pag === 4){ ?> class="active"<?php } ?> href="<?php echo $base_contabilidad; ?>/views/kardex.php">Kardex</a></li>
                                <li><a <?php if($pag === 5){ ?> class="active"<?php } ?> href="<?php echo $base_inicial; ?>/views/datos.php">Datos</a></li>
                                <li class="last"><a href="<?php echo $base_general; ?>/controllers/logout.php">Logout</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>