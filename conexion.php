<?php
ini_set('display_errors', 'On');

	$mysqli = new mysqli("localhost", "root", "myfenix28","empleado");
	if($mysqli->connect_error){
		die('Hubo un error en la conexion' . $mysqli->connect_error);
	}
?>
