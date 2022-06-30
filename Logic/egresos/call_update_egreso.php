<?php
try {
    require_once '../../Logic/conexion.php';
    $id_user = 1;
    $query = "CALL updateEgresoByIdByUser(?, ?, ?, ?, ?)"; //bueno
    $stmt = $enlace->prepare($query); //bueno
    $stmt->bind_param("iisds", $id_fila, $id_user, $descripcion, $gasto, $fecha); //bueno
    $result = $stmt->execute(); //bueno
    if ($result) {
        echo 'Editado correctamente';
    } else {
        echo 'No se pudo editar';
    }
    mysqli_close($enlace);
    $stmt->close(); //bueno
} catch (\Throwable $th) {
    //throw $th;
    echo 'No se pudo editar en la base de datos -> ' . $th;
}
