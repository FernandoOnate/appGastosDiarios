<?php
try {
    require_once '../../Logic/conexion.php';
    $query = "CALL getEgresoById('$id')";
    $consulta = $enlace->query($query);
    $filas = $consulta->fetch_assoc();
    mysqli_close($enlace);
    if($filas){

    }else{
        header('location:ver_gastos.php?edit=0&cd=1503');
        die();
    }
} catch (\Throwable $th) {
    //throw $th;
    echo 'no se pudo obtener egreso por id'.$th;
}