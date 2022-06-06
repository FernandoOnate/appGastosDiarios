<?php
try {
    $enlace = mysqli_connect("127.0.0.1", "root", "", "gastos");
    // echo 'Conectado!';
} catch (\Throwable $th) {
    //throw $th;
    echo 'No conectado!'.$th;
    exit;
}