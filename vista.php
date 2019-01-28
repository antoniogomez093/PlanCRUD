<?php
// Verificamos la existencia del id del registro antes de procesarlo.
if(isset($_GET["idemp"]) && !empty(trim($_GET["idemp"]))){
    // Incluimos la conexion.
    require_once 'conexion.php';
    // Preparamos la sentencia select.
    $sql = "SELECT * FROM empleado WHERE idemp = ?";
    if($stmt = $mysqli->prepare($sql)){
        // Vincular variables a la declaración preparada como parámetros.
        $stmt->bind_param("i", $param_id);
        // Establacemos los parametros.
        $param_id = trim($_GET["idemp"]);
        // Intentamos ejecutar la sentencia previamente preparada.
        if($stmt->execute()){
            $result = $stmt->get_result();
            //Si encontramos registros.
            if($result->num_rows == 1){
                /* Obtenemos la fila de resultados como una matriz asociativa. Desde que
                el conjunto de resultados contiene solo una fila, no necesitamos usar while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                // Recuperamos el valor de los campos individualmente.
                $name = $row["nombreemp"];
                $address = $row["paisemp"];
                $salary = $row["salario"];
            } else{
                // Si la URL no contiene un parametro id valido. Redirige a la pagina de errores.
                header("location: error.php");
                exit();
            }
        } else{
            echo "Algo salio mal. Por favor pruebe de nuevo mas tarde. ";
        }
    }
    // Cerramos la declaracion.
    $stmt->close();
    // Cerramos la conexion.
    $mysqli->close();
} else{
    // Si la URL no contiene un parametro id valido entonces redirigimos a una pagina de error.
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Registro</title>
</head>
<body>
    <div class="wrapper" align="center">
      <h1>Ver Registro</h1>
        <b>Nombre:</b>
        <i class="form-control-static"><?php echo $row["nombreemp"]; ?></i>
        <br><br>
        <b>Pais:</b>
        <i class="form-control-static"><?php echo $row["paisemp"]; ?></i>
        <br><br>
        <b>Salario:</b>
        <i class="form-control-static"><?php echo $row["salario"]; ?></i>
      <p><a href="view_todos.php" class="btn btn-primary">Regresar</a></p>
    </div>
</body>
</html>
