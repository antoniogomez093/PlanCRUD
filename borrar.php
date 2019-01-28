<?php
//Procesamos la operacion de eliminar despues de la confirmacion.
if(isset($_POST["idemp"]) && !empty($_POST["idemp"])){
    // Incluimos el archivo de conexion.
    require_once 'conexion.php';
    // Preparamos una sentencia de eliminar.
    $sql = "DELETE FROM empleado WHERE idemp = ?";
    if($stmt = $mysqli->prepare($sql)){
        //Vinculamos variables a la declaración preparada como parámetros.
        $stmt->bind_param("i", $param_id);
        // Seteamos parametros.
        $param_id = trim($_POST["idemp"]);
        // Intentamos ejecutar la declaracion previamente preparada.
        if($stmt->execute()){
            header("location: view_todos.php");
            exit();
        } else{
            echo "Algo salio mal por favor intente mas tarde. ";
        }
    }
    // Cerramos sentencia.
    $stmt->close();
    // Cerramos conexion.
    $mysqli->close();
} else{
    // Chequeamos la existencia del parametro id.
    if(empty(trim($_GET["idemp"]))){
        // En caso que la url no contenta un parametro id valido redirigimos a una pagina de error.
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Registro</title>
</head>
<body>
    <div class="" align="center">
      <h1>Borrar Registro</h1>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <input type="hidden" name="idemp" value="<?php echo trim($_GET["idemp"]); ?>"/>
              <p>Esta seguro de eliminar el registro?</p><br>
              <input type="submit" value="Si" class="btn btn-danger">
              <a href="view_todos.php" class="btn btn-default">No</a>
      </form>
    </div>
</body>
</html>
