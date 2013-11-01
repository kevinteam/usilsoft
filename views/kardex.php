<?php
    session_start();
    include_once("../modulo/logeado.php");
	/* CONEXION BASE DE DATOS */
    include_once("../modulo/conexion.php");
    include_once("../modulo/conexion_mysql.php");
    /* FIN CONEXION BASE DE DATOS */

	$query = "SELECT * FROM FilaK";
	$result = mysql_query($query) or die(mysql_error());
	$datos = array();

	while ($row = mysql_fetch_array($result))
	{
		$datos[] = $row;
	}
?>

<!doctype html>
<html>

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
	</head>
	
	<body>
		
		<h1> KARDEX </h1>
		
		<table border = "1" width = "1255" bgcolor = "black" bordercolor = "silver">	

			<tr align = center>
				<td colspan = "2" width = "315" align = center> S/. </td>
				<td colspan = "3" width = "315"> ENTRADAS </td>
				<td colspan = "3" width = "315"> SALIDAS </td>
				<td colspan = "3" width = "315"> SALDOS </td>
			</tr>
			
			<tr align = center>
				<td width = "110"> Fecha </td>
				<td width = "200"> Producto </td>
				<td width = "105"> Unidades </td>
				<td width = "105"> Costo Unitario </td>
				<td width = "105"> Total </td>		
				
				<td width = "105"> Unidades </td>
				<td width = "105"> Costo Unitario </td>
				<td width = "105"> Total </td>
				
				
				<td width = "105"> Unidades </td>
				<td width = "105"> Costo Unitario </td>
				<td width = "105"> Total </td>
			</tr>
			
			<?php foreach($datos as $p){?>
			<tr align = center>
				<td> <?=$p[1];?> </td>
				<td width = "200"> <?=$p[2];?> </td>
				
				<td width = "105"> <?=$p[3];?> </td>
				<td width = "105"> <?=$p[4];?> </td>
				<td width = "105"> <?=$p[5];?> </td>		
				
				<td width = "105"> <?=$p[6];?> </td>
				<td width = "105"> <?=$p[7];?> </td>
				<td width = "105"> <?=$p[8];?> </td>
				
				
				<td width = "105"> <?=$p[9];?> </td>
				<td width = "105"> <?=$p[10];?> </td>
				<td width = "105"> <?=$p[11];?> </td>
			</tr>	
			<?php }?>
		</table>
		<p>
		<a href="index.php">Volver a inicio</a>
		<p>
		<a href="agregar_kardex.php">Insertar entrada o salida de productos</a>
	</body>
</html>
		