<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nuevo Empleado</title>
	</head>
	<body>
		<div class="">
			<div class="row">
				<h3 style="text-align:center">Nuevo Empleado</h3>
			</div>
			<form class="" method="POST" action="guardar.php">
					<label>Nombre</label>
						<input type="text" name="nombreemp" placeholder="Nombre" required>
					<label>Pais</label>
						<input type="text" name="paisemp" placeholder="Pais" required>
					<label>Salario</label>
						<input type="number" name="salario" placeholder="Salario" required>
						<a href="index.php">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
			</form>
		</div>
	</body>
</html>
