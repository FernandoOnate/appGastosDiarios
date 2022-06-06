<?php
require_once '../../Logic/egresos/call-get_egresos.php';
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
                <th colspan="2">Acción</th>
            </tr>
            <?php
            if ($filas) :
                $v = 1;
                foreach ($filas as $valor) : ?>
                    <tr>
                        <td><?= $v ?></td>
                        <td><?= $valor['monto'] ?></td>
                        <td><?= $valor['detalle'] ?></td>
                        <td><?= $valor['creado'] ?></td>
                        <td><?= $valor['modificado'] ?></td>
                        <td><a href="./edit_gasto.php?edit=<?= $valor['id_egreso'] ?>">Editar</a></td>
                        <td><a href="./delete_gasto.php?delete=<?= $valor['id_egreso'] ?>">Eliminar</a></td>
                    </tr>
                <?php $v++;
                endforeach;
            else :
                ?>
                <td colspan="7">No se hallaron gastos</td>
            <?php endif; ?>
        </table>
    </main>
    <?php include_once '../includes/footer.php' ?>
</body>

</html>