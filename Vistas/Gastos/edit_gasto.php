<?php
$dtz = new DateTimeZone("America/Bogota");
$dt = new DateTime("now", $dtz);

if (isset($_GET['edit']) and !empty($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    include_once '../../Logic/egresos/call_get_egreso_id.php';
} else {
    header('location:./ver_gastos.php?cd=2000');
    die();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar gasto</title>
</head>

<body>
    <header>
        <nav>
            <a href="./ver_gastos.php">Ver tus gastos</a>
            <a href="../index.php">Inicio</a>
        </nav>
        <h1>Por favor en esta sección debes modificar el dato que desees.</h1>
    </header>
    <main>
        <form action="../../Logic/egresos/add_gasto.php" method="post">
            <fieldset>
                <legend>Editar gasto</legend>
                <p>
                    <label for="gasto">Monto del gasto: $</label>
                    <input type="number" step="any" id="gasto" name="gasto" placeholder="Números sin comas ni puntos" value="<?= $filas['monto'] ?>">
                </p>
                <p>
                    <label for="desc">Descripción o motivo del gasto:</label>
                    <input name="descripcion" id="desc" placeholder="Detalle" type="text" value="<?php echo $filas['detalle'] ?>">
                </p>
                <p>
                    <label for="f_creado">Fecha de creado:</label>
                    <input name="descripcion" id="f_creado" placeholder="Fecha de creado" value="<?php echo (new DateTime($filas['creado']))->format('Y-m-d\TH:i:s'); ?>" type="datetime-local">
                </p>
                <button type="submit" name="agregar">Modificar</button>
            </fieldset>
        </form>
    </main>
    <?php include_once '../includes/footer.php' ?>
</body>

</html>