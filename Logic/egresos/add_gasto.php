<?php
function ValidarGastoVacio($gasto)
{
    $vacio = true;
    if (empty($gasto)) {
        $vacio = true;
    } else {
        $vacio = false;
    }
    return $vacio;
}
function ValidarGastoNumerico($gasto)
{
    $valido = false;
    if (!is_numeric($gasto)) {
        // critico
        return false;
    } else {
        return true;
    }
    return $valido;
}
$gasto = null;
$descripcion = null;
// var_dump($gasto);
if (isset($_POST['agregar'])) {
    // echo 'el boton agregar existe';
    if (isset($_POST['gasto'])) {
        // echo "el campo gasto SI existe <br>";
        if (!ValidarGastoVacio($_POST['gasto'])) {
            // echo 'el campo gasto si trajo un valor';
            if (ValidarGastoNumerico($_POST['gasto'])) {
                $gasto = (float)$_POST['gasto'];
            } else {
                // critico
                header('location:../../Vistas/Gastos/add_gastos.php?cd=1100');
                die();
            }
        } else {
            // critico
            // echo 'el campo gasto no trajo un valor';
            header('location:../../Vistas/Gastos/add_gastos.php?cd=1110');
            die();
        }
    } else {
        // critico
        // echo 'el campo gasto NO existe';
        header('location:../../Vistas/Gastos/add_gastos.php?cd=1111');
        die();
    }
    if (isset($_POST['descripcion'])) {
        // echo "el campo descripcion SI existe <br>";
        if (empty($_POST['descripcion'])) {
            // critico
            // echo 'La descripcion no puede ir vacia ';
            header('location:../../Vistas/Gastos/add_gastos.php?cd=1200');
            die();
        } else {
            if (!is_string($_POST['descripcion'])) {
                // critico
                // echo 'El campo descripcion no es un string';
                header('location:../../Vistas/Gastos/add_gastos.php?cd=1201');
                die();
            } else {
                if (strlen($_POST['descripcion']) >= 105) {
                    //sobrepasa los 105 caracteres
                    header('location:../../Vistas/Gastos/add_gastos.php?cd=1211');
                    die();
                } else {
                    $descripcion = (string)$_POST['descripcion'];
                }
            }
        }
    } else {
        // critico
        // echo 'el campo descripcion no existe';
        header('location:../../Vistas/Gastos/add_gastos.php?cd=1212');
        die();
    }
} else {
    // critico
    // echo 'el boton agregar no existe';
    header('location:../../Vistas/Gastos/add_gastos.php?cd=1001');
    die();
}
//agregar el registro a la db
if ($gasto and $descripcion) {
    try {
        require_once './call_addEgreso.php';
        if ($consulta_add) {
            // echo 'agregado correctamente';
            header('location:../../Vistas/Gastos/add_gastos.php?cd=1311');
        }
    } catch (\Throwable $th) {
        //throw $th;
        header('location:../../Vistas/Gastos/add_gastos.php?cd=1300');
        die();
        // echo 'no agregado correctamente ' . $enlace->errno . ' ' . $enlace->error;
    }
} else {
    // echo 'Las variables son null';
    header('location:../../Vistas/Gastos/add_gastos.php?cd=1301');
    die();
}
