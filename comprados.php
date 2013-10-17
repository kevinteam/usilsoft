<?php
	session_start();
	if( ($_SERVER['REQUEST_METHOD']!='GET') || (!isset($_SESSION['usuario'])) || (!isset($_SESSION['nombre_usuario'])) )
	{
		header("Location: index.php?fallo=isset");
		exit();
	}
	$userid=$_SESSION['usuario'];
	/* ARREGLO LETRA INICIAL DE LOS ARTISTAS */
	$names=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$size=count($names);
	/* FIN ARREGLO LETRA INICIAL DE LOS ARTISTAS */

	/* CONEXION BASE DE DATOS */
	include_once("modulo/conexion.php");
	mysql_connect($server,$mysqllogin,$mysqlpass) or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	/* FIN CONEXION BASE DE DATOS */

	/* LISTA GENEROS */
	$query="SELECT GENREID,GENRE FROM genre ORDER BY GENRE ASC";
	$resultado=mysql_query($query) or die(mysql_error());
	$genero=array();
	while ($row=mysql_fetch_array($resultado))
	{
		$genero[] = $row;
	}
	/* FIN LISTA GENEROS */

	/* PAGINADO */
		// maximo por pagina
		$limit = 5;

		// pagina pedida
		if(isset($_GET["pag"]))
		{
			$pag = (int) $_GET["pag"];
			if ($pag < 1)
			{
			 $pag = 1;
			}
		}
		else
		{
			$pag=1;
		}
		$offset = ($pag-1) * $limit;
		/* TABLA DE RESULTADOS */
		$muestra=array();
		$query="SELECT SQL_CALC_FOUND_ROWS DISTINCT s.SONGID,s.SONG,s.TRACK,s.PRICE,a.NAME AS ARTIST,b.NAME AS ALBUM FROM song s, album b, artist a, userfavorites u, `order` o WHERE u.USERID='$userid' AND u.USERID=o.USERID AND o.SONGID=s.SONGID AND s.ALBUMID=b.ALBUMID AND s.ARTISTID=a.ARTISTID ORDER BY o.DATE ASC LIMIT $offset, $limit";
		$sqlTotal = "SELECT FOUND_ROWS() as total";
		$resultado=mysql_query($query) or die(mysql_error());
		$rsTotal = mysql_query($sqlTotal) or die(mysql_error());
		while ($row=mysql_fetch_array($resultado))
		{
			$muestra[]=$row;
		}
		// Total de registros sin limit
		$rowTotal = mysql_fetch_assoc($rsTotal);
		$total = $rowTotal["total"];
		/* FIN TABLA DE RESULTADOS */
	/* FIN PAGINADO */
?>
<!doctype html>
<html lang="es">
	<head>
		<title>AUDIONET</title>
		<meta charset="UTF-8">
		<link href='css/css.css' type='text/css' rel='stylesheet'>
		<script src="jquery-1.8.3.js"></script>
		<script>
			$(document).on("ready",evento);
			function evento(ev)
			{
				var id = 0;
				var newid = 2;
				var status = 0;// 0 pausado 1 tocando
				$('.play').on("click", function(event){
					event.preventDefault();
					newid=parseInt($(this).attr("id"));
					if(newid != id)
					{
						$('audio').attr("src","songs/"+newid+".mp3");
						if (id != 0)
						{
							$('#'+id).attr("src","images/play.jpg");
						}
						id = newid;
						status = 0; 
					}
					if(status == 0)
					{
						$(this).attr("src","images/pause.jpg");
						$('audio').get(0).play();
						status = 1;
					}
					else
					{
						$(this).attr("src","images/play.jpg");
						$('audio').get(0).pause();
						status = 0;
					}
				});
				$('audio').on("ended", function(){
					if(id != 0)
					{
						$('#'+id).attr("src","images/play.jpg");
						$.post("modulo/procesartimes.php", { songid: id } );
						//si inicio sesion Aqui debe incrementar en 1 TIMES de la tabla userfavorites; 
					}
					//incrementar en 1 times de la tabla userfavorites
				});
			}
		</script>
	</head>
	<body>
		<div id='container'>
			<div id='header'>
				<img src='images/logo.jpg' alt="logo"/>
			    <ul id="menu-top" >
					<li><a href="index.php">Inicio</a></li>
					<li> | </li>
					<li><a  href="logout.php">Logout</a></li>
					<li> | </li>
					<li><?php if(isset($_SESSION['nombre_usuario'])) echo $_SESSION['nombre_usuario']; ?></li>
					<li> | </li>
					<li><a  href="comprados.php">Mis Compras</a></li>
					<li> | </li>
					<li><a href="editar_datos.php"><img src="images/lapiz.jpg" alt="comprar" ></a></li>	
				</ul>
			</div>
			<?php include_once("modulo/seccion_busqueda.html") ?>
			<audio>
				<source src="songs/song.mp3" type="audio/mpeg">			
			</audio>
			<div id='main'>
			<!-- CAMBIOS -->
				<div id="defaultPane" class="content contentText">
					<table border="1" style="width:100%">
						<thead>
							<tr>
								<th>REPRODUCIR</th>
								<th>CANCI&Oacute;N</th>
								<th>TRACK</th>
								<th>ALBUM</th>
								<th>ARTISTA</th>
							</tr>
						</thead>
						<tbody>
<?php					foreach ($muestra as $r)
						{ ?>
							<tr>
								<td><img src="images/play.jpg" alt="play" class="play" id="<?php echo $r['SONGID']; ?>" style="width:30px;height:30px;"></td>
								<td><?php echo $r['SONG']; ?></td>
								<td><?php echo $r['TRACK']; ?></td>
								<td><?php echo $r['ALBUM']; ?></td>
								<td><?php echo $r['ARTIST']; ?></td>
							</tr>
<?php					} ?>
						</tbody>
						<tfoot>
						    <tr>
							  	<td colspan="5">
<?php   				 	   		$totalPag = ceil($total/$limit);//ceil redondea al siguiente valor mas alto
							       	$links = array();
							       	for( $i=1; $i<=$totalPag; $i++)
							       	{
							      			$links[] = "<a href=\"?pag=$i\">$i</a>";
							       	}
							       	echo implode(" - ", $links); ?>
							   	</td>
						    </tr>
						</tfoot>
					</table>				
				</div>		
				<!-- MENU VAR -->
				<!-- var-leftside-->
				<aside>
					<div id="left-upside">ARTISTAS
					    <ul class="nav">
<?php		    	 	for($i=0;$i<$size;$i++)
			     		{
			     			$query_string="inicial=".$names[$i]; ?>
					     	<li><a class="<?php echo $names[$i]; ?>" href="artistas.php?<?php echo $query_string;?>" <?php if($i%5){echo ' style="clear:left;"';} ?>><?php echo $names[$i]; ?></a></li>	
<?php 					} ?>
					    </ul>	
					</div>
					<div id="left-downside">GENEROS
						<ul class="nav">
<?php 			     		foreach($genero AS $g)
				     		{
				     			$query_string="genero=".$g['GENREID'];	?>
					     		<li><a class="<?php echo $g['GENRE']; ?>" href="generos.php?<?php echo $query_string;?>"><?php echo $g['GENRE']; ?></a></li>	
<?php 						} ?>
						</ul>	
					</div>
				</aside>
			</div>
			<div id='footer'>
			</div>	
		</div>
	</body>
</html>