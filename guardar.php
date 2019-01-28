<?php
	require 'conexion.php';
	$nombreemp = $_POST['nombreemp'];
	$paisemp = $_POST['paisemp'];
	$salario = $_POST['salario'];
	$sql = "INSERT INTO empleado (nombreemp, paisemp, salario) VALUES ('$nombreemp', '$paisemp', '$salario')";
	$resultado = $mysqli->query($sql);
?>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
				<div class="row" style="text-align:center">
					<?php if($resultado) {
						 header("location: view_todos.php");
						 } else {
						echo "<h3>Hubo un error al registrar. </h3>";
					 	}
					?>
					<a href="index.php" class="btn btn-primary">Back</a>
				</div>
	</body>
</html>
