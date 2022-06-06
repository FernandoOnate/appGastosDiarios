<?php 
require_once '../../Logic/conexion.php';
$query = "CALL getEgresos()";
$consulta = $enlace->query($query);
$filas = $consulta->fetch_all(MYSQLI_ASSOC);
mysqli_close($enlace);
