        <header>
        	<div class="top-row">
            	<div class="main">
                	<div class="wrapper">
                        <h1><a href="<?php echo $base_inicial; ?>/views/index.php">Gestion de Restaurantes-Area de Logistica</a></h1>
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
                                <li><a <?php if($pag === 1){ ?> class="active"<?php } ?> href="<?php echo $base_usuarios; ?>/views/login.php">Login</a></li>
                                <li><a <?php if($pag === 2){ ?> class="active"<?php } ?> href="<?php echo $base_usuarios; ?>/views/registration.php">Registrarse</a></li>
                                <li class="last"><a <?php if($pag === 3){ ?> class="active"<?php } ?> href="<?php echo $base_usuarios; ?>/views/password_recovery.php">Recuperar Contraseña</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>			
        </header>