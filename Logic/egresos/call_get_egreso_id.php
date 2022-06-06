<?php
try {
    require_once '../../Logic/conexion.php';
    $query = "CALL getEgresoById('$id')";
    $consulta = $enlace->query($query);
    $filas = $consulta->fetch_assoc();
    mysqli_close($enlace);
} catch (\Throwable $th) {
    //throw $th;
    echo 'no se pudo obtener egreso por id'.$th;
}

