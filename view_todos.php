<!DOCTYPE html>
<html lang="es">
	<head><!-- -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lista Empleados</title>
</head>
<body>
	<div class="container">
			<h2 style="text-align:center">Lista de Empleados </h2><br><br>
			<a href="index.php" class="btn btn-primary" >Menu Principal</a><br>
			<div class=""><a href="nuevo.php" class="btn btn-primary" >Nuevo </a></div><br>
		<div class="">
			<?php
	                    // Incluir el archivo de conexion
	                    require_once 'conexion.php';
	                    // Attempt select query execution
	                    $sql = "SELECT * FROM empleado";
	                    if($result = $mysqli->query($sql)){
	                        if($result->num_rows > 0){
	                            echo "<table class='table table-bordered table-striped'>";
	                                echo "<thead>";
	                                    echo "<tr>";
	                                        echo "<th>#</th>";
	                                        echo "<th>Nombre</th>";
	                                        echo "<th>Pais</th>";
	                                        echo "<th>Salario</th>";
	                                        echo "<th>Action</th>";
	                                    echo "</tr>";
	                                echo "</thead>";
	                                echo "<tbody>";
	                                while($row = $result->fetch_array()){
	                                    echo "<tr>";
	                                        echo "<td>" . $row['idemp'] . "</td>";
	                                        echo "<td>" . $row['nombreemp'] . "</td>";
	                                        echo "<td>" . $row['paisemp'] . "</td>";
	                                        echo "<td>" . $row['salario'] . "</td>";
	                                        echo "<td>";
	                                            echo "<a href='vista.php?idemp=". $row['idemp'] ."' title='Ver registro'> <label class=''>Ver</label>  </a>";
	                                            echo "<a href='actualizar.php?idemp=". $row['idemp'] ."' title='Actualizar registro'> <label class=''>Actualizar</label> </a>";
	                                            echo "<a href='borrar.php?idemp=". $row['idemp'] ."' title='Borrar registro'> <label class=''>Borrar</label> </a>";
	                                        echo "</td>";
	                                    echo "</tr>";
	                                }
	                                echo "</tbody>";
	                            echo "</table>";
	                            // Free result set
	                            $result->free();
	                        } else{
	                            echo "<p class='lead'><em>No se encontraron registros.</em></p>";
	                        }
	                    } else{
	                        echo "Error: No se pudo ejecutar $sql. " . $mysqli->error;
	                    }
	                    // Close connection
	                    $mysqli->close();
	                    ?>
		</div>
</body>
</html>
