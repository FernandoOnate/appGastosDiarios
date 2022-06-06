<?php
require_once '../../Logic/conexion.php';
$id_user = random_int(1, 3);
$query = "CALL addEgreso('$descripcion','$gasto','$id_user')";
$consulta = $enlace->query($query);
mysqli_close($enlace);
