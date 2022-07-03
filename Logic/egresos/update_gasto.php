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
$fecha = null;
// var_dump($gasto);
// die();

if (isset($_POST['modificar'])) {
    // validando el gasto
    if (isset($_POST['gasto'])) {
        // echo "el campo gasto SI existe <br>";
        if (!ValidarGastoVacio($_POST['gasto'])) {
            // echo 'el campo gasto si trajo un valor';
            if (ValidarGastoNumerico($_POST['gasto'])) {
                $gasto = (float)$_POST['gasto'];
            } else {
                // critico
                header('location:../../Vistas/Gastos/ver_gastos.php?cd=1100&edit=00');
                die();
            }
        } else {
            // critico
            // echo 'el campo gasto no trajo un valor';
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1110&edit=00');
            die();
        }
    } else {
        // critico
        // echo 'el campo gasto NO existe';
        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1111&edit=00');
        die();
    }

    // validando la descripcion
    if (isset($_POST['descripcion'])) {
        // echo "el campo descripcion SI existe <br>";
        if (empty($_POST['descripcion'])) {
            // critico
            // echo 'La descripcion no puede ir vacia ';
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1200&edit=00');
            die();
        } else {
            if (!is_string($_POST['descripcion'])) {
                // critico
                // echo 'El campo descripcion no es un string';
                header('location:../../Vistas/Gastos/ver_gastos.php?cd=1210&edit=00');
                die();
            } else {
                if (strlen($_POST['descripcion']) >= 105) {
                    //sobrepasa los 105 caracteres
                    header('location:../../Vistas/Gastos/ver_gastos.php?cd=1211&edit=00');
                    die();
                } else {
                    $descripcion = (string)$_POST['descripcion'];
                }
            }
        }
    } else {
        // critico
        // echo 'el campo descripcion no existe';
        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1211&edit=00');
        die();
    }

    // validando la fecha
    if (isset($_POST['fecha_creado'])) {
        if (empty($_POST['fecha_creado'])) {
            //critico fecha vacia
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1400&edit=00');
            die();
        } else {
            if (strlen($_POST['fecha_creado']) <= 0 or strlen($_POST['fecha_creado']) > 19) {
                //critico longitud timestamp invalida
                header('location:../../Vistas/Gastos/ver_gastos.php?cd=1401&edit=00');
                die();
            } else {
                if (!is_string($_POST['fecha_creado'])) {
                    //CRITICO no puede ser solo numeros
                    header('location:../../Vistas/Gastos/ver_gastos.php?cd=1402&edit=00');
                    die();
                } else {
                    try {
                        $fecha = $_POST['fecha_creado'];
                        $fecha = (new DateTime($fecha))->format('Y-m-d H:i:s');
                    } catch (\Throwable $th) {
                        //throw $th;
                        //la cadena de caracteres no tiene formato fecha
                        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1403&edit=00');
                        die();
                    }
                }
            }
        }
    } else {
        //no existe la fecha
        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1404&edit=00');
        die();
    }

    //validando el id del input oculto
    if (isset($_POST['r'])) {
        if (!empty($_POST['r'])) {
            if (is_numeric($_POST['r'])) {
                $id_fila = (int)$_POST['r'];
            } else {
                //r es un string
                header('location:../../Vistas/Gastos/ver_gastos.php?cd=1502&edit=00');
                die();
            }
        } else {
            //el id del registro no vino
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1500&edit=00');
            die();
        }
    } else {
        //no existe ese registro en base de datos
        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1501&edit=00');
        die();
    }
} else {
    // critico
    // echo 'el boton modificar no existe';
    header('location:../../Vistas/Gastos/ver_gastos.php?cd=1001&edit=00');
    die();
}

//agregar el registro a la db
if ($gasto and $descripcion and $fecha and $id_fila) {
    try {
        require_once './call_update_egreso.php';
        if ($result) {
            // echo 'Editado correctamente';
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1600&edit=00');
        } else {
            // echo 'No se pudo editar';
            header('location:../../Vistas/Gastos/ver_gastos.php?cd=1601&edit=00');
        }
    } catch (\Throwable $th) {
        //throw $th;
        header('location:../../Vistas/Gastos/ver_gastos.php?cd=1310&edit=00');
        die();
        // echo 'no agregado correctamente ' . $enlace->errno . ' ' . $enlace->error;
    }
} else {
    // echo 'Las variables son null';
    header('location:../../Vistas/Gastos/ver_gastos.php?cd=1122&edit=00');
    die();
}
