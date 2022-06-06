<?php
require_once '../../Logic/conexion.php';
$query = "CALL getEgresos()";
$consulta = $enlace->query($query);
$filas = $consulta->fetch_all(MYSQLI_ASSOC);
mysqli_close($enlace);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver egresos</title>
</head>

<body>
    <header>
        <nav>
            <a href="./add_gastos.php">Añadir un gasto nuevo</a>
            <a href="../index.php">Inicio</a>
        </nav>
        <h1>Bienvenido a su página de egresos</h1>
    </header>
    <main>
        <table border="1">
            <caption>Tabla con egresos</caption>
            <tr>
                <th>#</th>
                <th>Valor</th>
                <th>Motivo</th>
                <th>Creado en</th>
                <th>Modificado en</th>
            </tr>
            <?php $v = 1;
            foreach ($filas as $valor) : ?>
                <tr>
                    <td><?= $v ?></td>
                    <td><?= $valor['monto'] ?></td>
                    <td><?= $valor['detalle'] ?></td>
                    <td><?= $valor['creado'] ?></td>
                    <td><?= $valor['modificado'] ?></td>
                </tr>
            <?php $v++;
            endforeach
            ?>
        </table>
    </main>
    <?php include_once '../includes/footer.php' ?>
</body>

</html>