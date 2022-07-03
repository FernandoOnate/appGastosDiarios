<?php
try {
    require_once '../../Logic/conexion.php';
    $id_user = random_int(1, 3);
    // $query = "CALL addEgreso('$descripcion','$gasto','$id_user')";
    $query = "CALL addEgreso(?,?,?)";
    $stmt = $enlace->prepare($query);
    $stmt->bind_param("sdi", $descripcion, $gasto, $id_user);
    $consulta_add = $stmt->execute();
    mysqli_close($enlace);
    $stmt->close();
} catch (\Throwable $th) {
    //throw $th;
    echo 'No se pudo insertar en la base de datos'.$th;
}
