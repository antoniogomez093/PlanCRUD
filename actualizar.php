<?php
// Incluimos el archivo de conexion.
require_once 'conexion.php';
// Definimos las variables con valores vacios.
$nombre = $pais = $salario = "";
// Procesamos la informacion cuando el formulario es presentado.
if(isset($_POST["idemp"]) && !empty($_POST["idemp"])){
    $idemp = $_POST["idemp"];
    // Seteamos el dato.
    $input_nombre = trim($_POST["nombreemp"]);//Limpiamos la cadena de algun espacio en blanco con la funcion trim.
        $nombre = $input_nombre;
    // Seteamos el dato.
    $input_pais = trim($_POST["paisemp"]);
        $pais = $input_pais;
    // Seteamos el dato.
    $input_salario = trim($_POST["salario"]);
        $salario = $input_salario;
        // Preparamos la sentencia.
        $sql = "UPDATE empleado SET nombreemp=?, paisemp=?, salario=? WHERE idemp=?";
        if($stmt = $mysqli->prepare($sql)){
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bind_param("sssi", $param_nombre, $param_pais, $param_salario, $param_idemp);
            // Seteamos los parametros.
            $param_nombre = $nombre;
            $param_pais = $pais;
            $param_salario = $salario;
            $param_idemp = $idemp;
            // Intentamos ejecutar la sentencia previamente preparada.
            if($stmt->execute()){// Si tiene exito entonces actualiza y redirige a la lista general.
                header("location: view_todos.php");
                exit();
            } else{
                echo "Algo malo ocurrio. Favor intentar mas tarde.";
            }
        }
        // Cerramos sentencia.
        $stmt->close();
    // Cerramos conexion.
    $mysqli->close();
} else{ // En caso que el id sea valido, que lo es, entonces procedemos a recuperar la info de la base de datos.
    // Comprobamos la existencia del parámetro id antes de seguir procesando.
    if(isset($_GET["idemp"]) && !empty(trim($_GET["idemp"]))){
        // Obtenemos el parametro URL
        $idemp =  trim($_GET["idemp"]);
        // Preparamos una sentencia de seleccion.
        $sql = "SELECT * FROM empleado WHERE idemp = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Vinculamos las variables a la declaración preparada como parámetros.
            $stmt->bind_param("i", $param_idemp);
            // Seteamos parametros.
            $param_idemp = $idemp;
            // Intentamos ejecutar la sentencia previamente preparada.
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows == 1){
                    /* Obtenemos la fila de resultados como una matriz asociativa. Desde el conjunto de resultados
                    contiene solo una fila entonces no necesitamos usar while. */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    // Recuperamos valores individuales.
                    $nombre = $row["nombreemp"];
                    $pais = $row["paisemp"];
                    $salario = $row["salario"];
                } else{
                    //Si la url no contiene un id valido entonces redirige a una pagina de error.
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Algo ocurrio, por favor intente mas tarde. ";
            }
        }
        // Cerramos la sentencia.
        $stmt->close();
        // Cerramos la conexion.
        $mysqli->close();
    }  else{
        //En caso que el url no contenta un parametro id valido redirigimos a la pagina de error.
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Registro</title>
</head>
<body>
  <div class="row">
    <h2>Actualizar el registro</h2>
    <p>Por favor edite los datos del registro.</p>
    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
      <b>Nombre: </b>
      <input type="text" name="nombreemp" class="form-control" value="<?php echo $nombre; ?>">
      <br>
      <b>Pais: </b>
      <input type="text" name="paisemp" class="form-control" value="<?php echo $pais; ?>">
      <br>
      <b>Salario: </b>
      <input type="number" name="salario" class="form-control" value="<?php echo $salario; ?>">
      <br>
      <input type="hidden" name="idemp" value="<?php echo $idemp; ?>"/>
      <input type="submit" class="btn btn-primary" value="Actualizar">
      <a href="view_todos.php" class="btn btn-default">Cancelar</a>
    </form>
  </div>
</body>
</html>
