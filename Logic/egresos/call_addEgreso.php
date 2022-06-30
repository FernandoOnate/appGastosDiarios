<?php
try {
    require_once '../../Logic/conexion.php';
    $id_user = random_int(1, 3);
    $query = "CALL addEgreso('$descripcion','$gasto','$id_user')";
    $consulta = $enlace->query($query);
    mysqli_close($enlace);
    if($consulta){
        echo 'agregado correctamente';
    }else{
        echo 'Error al agregar';
    }
} catch (\Throwable $th) {
    //throw $th;
    echo 'No se pudo insertar en la base de datos'.$th;
}
