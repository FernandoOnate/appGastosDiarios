<?php
$dtz = new DateTimeZone("America/Bogota");
$dt = new DateTime("now", $dtz);

if (isset($_GET['cd'])) {
    if (empty($_GET['cd'])) {
        echo ':)';
    }
} else {
    echo 'Todo bien?';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos | Agregar</title>
</head>

<body>
    <header>
        <nav>
            <a href="./ver_gastos.php">Ver tus gastos</a>
            <a href="../index.php">Inicio</a>
        </nav>
        <h1>Por favor en esta sección debes ingresar los campos requeridos.</h1>
    </header>
    <main>
        <form action="../../Logic/egresos/add_gasto.php" method="post">
            <fieldset>
                <legend>Añadir nuevo gasto</legend>
                <h3>Fecha y hora actuales:
                    <?php
                    // echo $dt->format('m-d-Y G:i:s');
                    // echo ' <br>';
                    echo $dt->format('F j, Y, g:i A')
                    ?>
                </h3>
                <p>
                    <label for="gasto">Monto del gasto: $</label>
                    <input type="number" step="any" id="gasto" name="gasto" placeholder="Números sin comas ni puntos">
                </p>
                <p>
                    <label for="desc">Descripción o motivo del gasto:</label>
                    <textarea name="descripcion" id="desc" placeholder="Detalle" cols="30" rows="1"></textarea>
                </p>
                <button type="submit" name="agregar">Agregar</button>
                <button type="reset">Limpiar formulario</button>
            </fieldset>
        </form>
    </main>
    <?php include_once '../includes/footer.php' ?>
</body>

</html>