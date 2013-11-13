
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
		<h1>ENTRADA</h1>	
		<form action="../controllers/procesar_kardex.php" method="post">
			Producto: <input type="text" name="producto" value=""><br>
			Fecha: <input type="text" name="fecha" value=""><br>
			Numero de Unidades: <input type="text" name="eUnid" value=""><br>
			Costo por Unidad: <input type="text"name="eCosto" value=""><br>
			<input type="submit" value = "Entrada">
		</form>
		
		<h1>SALIDA</h1>	
		<form action="insertar.php" method="post">
			Producto: <input type="text" name="producto" value=""><br>
			Fecha: <input type="text" name="fecha" value=""><br>
			Numero de Unidades: <input type="text" name="sUnid" value=""><br>
			<input type="submit" value = "Salida">
		</form>
	</body>
	
	<a href="kardex.php">Ver Kardex</a>
	
</html>