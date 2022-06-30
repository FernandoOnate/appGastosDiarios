<?php
try {
    require_once '../../Logic/conexion.php';
    $query = "CALL getEgresos()";
    $consulta = $enlace->query($query);
    $filas = $consulta->fetch_all(MYSQLI_ASSOC);
    mysqli_close($enlace);
} catch (\Throwable $th) {
    //throw $th;
    echo 'No se pudo traer a los egresos'.$th;
}
