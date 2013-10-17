<?php 
session_start();
	$names = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$size= count($names);
	$genero = array("BALADA","ROCK","POP","LATIN","LATIN-POP","MERENGUE","SALSA","CUMBIA");
	$esize= count($genero);
?>
<!doctype html>
<html lang="es">
	<head>
		<title>USUARIO</title>
		<meta charset="UTF-8">
		<link href='css/css.css' type='text/css' rel='stylesheet'/>
		<link rel="stylesheet" href="css/waterwheel-carousel.css" charset="utf-8" />
    	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    	<script type="text/javascript" src="js/jquery.waterwheelCarousel.min.js"></script>
		<script>

			 $(document).ready(function () {
        		$("#waterwheel-carousel-default").waterwheelCarousel();
        	});
		</script>
	</head>
	<body>
		<div id='container'>
			<div id='header'>
			<img src='images/logo.jpg' alt=""/>
			     <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="logout.php">Logout</a></li>
					<li> | </li>
					<li><a href="usuario.php"><?php if(isset($_SESSION['nombre_usuario'])){?>
												<?php echo $_SESSION['nombre_usuario'] ?>
												<?php }?></a></li>
					<li> | </li>
					<li><a href="editar_datos.php"><img src="images/lapiz.jpg" alt="comprar" ></a></li>						
				</ul>
			</div>
			<div id="busqueda">

						<form action='buscar.php' method='post'>
							<input  type='radio' name='artista' value="1">Album
							<input type='radio' name='cancion' value="2">Artista
							<input  type='radio' name='genero' value="3">Canción
							<input id="buscar" type='text' name='busqueda' size="55">
							<input type='submit'  value="Buscar">
						</form>
			
			
			</div>
			
			<!-- CAROUSEL -->
	    <div id="waterwheel-carousel-default">
	    	<div class="carousel-controls">
	      		<div class="carousel-prev"><a href="#">&lt; previous</a></div>
	      		<div class="carousel-next"><a href="#">&gt; next</a></div>
	    	</div>
	    	<div class="carousel-images">
		        <img src="images/albums/images(1).jpg" alt="Test Image 1" />
		        <img src="images/albums/images(2).jpg" alt="Test Image 2" />
		        <img src="images/albums/images(3).jpg" alt="Test Image 3" />
		        <img src="images/albums/images(4).jpg" alt="Test Image 4" />
		        <img src="images/albums/images(5).jpg" alt="Test Image 5" />
		        <img src="images/albums/images(6).jpg" alt="Test Image 6" />
		        <img src="images/albums/images(7).jpg" alt="Test Image 7" />
		        <img src="images/albums/images(8).jpg" alt="Test Image 8" />
		        <img src="images/albums/images(10).jpg" alt="Test Image 10" />
		        <img src="images/albums/images(13).jpg" alt="Test Image 13" />
	    	</div>
	    </div>
	    <!-- CAROUSEL -->
	    
	    <br />
		
		<!--AUDIO-->
			<audio controls autoplay>
			<source src="song.mp3" type="audio/mpeg">
			</audio>
			<!--FIN AUDIO-->
			<div id='main'>
			<!-- CAMBIOS -->
				<div id="defaultPane" class="content contentText">
					agregar modificaiones
					<div id="album">
						<table>				
							<tr>
								<td><a id="0" href="autos.html" class="autos"><img src="images/albums/images(1).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="4" href="autos.html" class="autos"><img src="images/albums/images(2).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="8" href="autos.html" class="minivan"><img src="images/albums/images(3).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="12" href="autos.html" class="hino"><img src="images/albums/images(4).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="16" href="autos.html" class="hino"><img src="images/albums/images(5).jpg" alt="m1"/><br><span>title-song</span></a></td>
							</tr>
							<tr>
								<td><a id="1" href="autos.html" class="autos"><img src="images/albums/images(6).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="5" href="autos.html" class="autos"><img src="images/albums/images(7).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="9" href="autos.html" class="minivan"><img src="images/albums/images(8).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="13" href="autos.html" class="minivan"><img src="images/albums/images(9).jpg" alt="m1"/><br><span>title-song</span></a></td>
								<td><a id="17" href="autos.html" class="hino"><img src="images/albums/images(10).jpg" alt="m1"/><br><span>title-song</span></a></td>	
							</tr>
						</table>
					</div>		
				</div>					
				<!-- MENU VAR -->
				<!-- var-leftside-->
				<aside>
					<div id="left-upside">ARTISTAS
					    <ul class="nav">
						   	<?php 
					    	 	for($i=0;$i<$size;$i++)
					     		{
					     			$query_string="inicial=".$names[$i];
					     	?>
					     	<li><a class="<?php echo $names[$i]; ?>" href="artistas.php?<?php echo $query_string;?>" <?php if($i%5){echo 'style="clear:left;"';} ?>><?php echo $names[$i]; ?></a></li>	
							<?php } ?>
					    </ul>	
					</div>
					<div id="left-downside">GENEROS
						<ul class="nav">
							<?php 
					     		for($i=0;$i<$esize;$i++)
					     		{
					     			$query_string="genero=".$genero[$i];
					     	?>
					     	<li><a class="<?php echo $genero[$i]; ?>" href="generos.php?<?php echo $query_string;?>"><?php echo $genero[$i]; ?></a></li>	
							<?php } ?>
						</ul>	
					</div>
				</aside>
			</div>
			<div id='footer'>
			</div>	
		</div>
	</body>
</html>