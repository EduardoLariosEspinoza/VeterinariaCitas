<?php

//header('Access-Control-Allow-Origin: *');

require_once('./php/login.php');
include('./php/connection.php');

$sql = 'SELECT COUNT(*) as total FROM citas_admins WHERE numero_cuenta = "' . $atributos['uCuenta'][0] . '"';
$result = $conn->query($sql);
$result = $result->fetch_all(MYSQLI_ASSOC);

$rol = 0;

if ($result[0]["total"] == "1") {
    // Si hay un registro en la tabla de admins, entonces es admin
    $rol = 1;
} else {
    $sql = 'SELECT COUNT(*) as total FROM citas_lectores WHERE numero_cuenta = "' . $atributos['uCuenta'][0] . '"';
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);

    if ($result[0]["total"] == "1") {
        // Si hay un registro en la tabla de lectores, entonces es lector
        header('Location: ./lectores.php');
    } else {
        $rol = 3;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador de Pacientes Universitario</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://www.ucol.mx/favicon.ico" rel="shortcut icon" />

    <script>
        var SECTION_SUPERIOR = true;
        var CONTAINER_MODE = 'container';
        var BREADCRUMB_SESSION = [{
                title: "<?php echo $atributos["uNombre"][0] ?>",
                tooltip: true
            },
            {
                title: "Salir",
                link: "./inicio2.php"
            }
        ];
    </script>
</head>

<body>
    <h2 class="text-center my-5 titulo">Administrador de Pacientes de Veterinaria Universitario</h2>
    <div class="container mt-5 p-5">
        <div id="contenido" class="row">
            <div class="col-md-6 agregar-cita">
                <form id="nueva-cita">
                    <legend class="mb-4">Datos del Paciente</legend>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Nombre Mascota:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="text" id="mascota" name="mascota" class="form-control" placeholder="Nombre Mascota">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Propietario:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="text" id="propietario" name="propietario" class="form-control" placeholder="Nombre Dueño de la Mascota">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Teléfono:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Número de Teléfono">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Fecha:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="date" id="fecha" name="fecha" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Hora:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="time" id="hora" name="hora" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Sintomas:</label>
                        <div class="col-sm-8 col-lg-8">
                            <textarea id="sintomas" name="sintomas" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-100 d-block">Crear Cita</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h2 id="administra" class="mb-4">Administra tus Citas</h2>
                <ul id="citas" class="list-group lista-citas"></ul>
            </div>
        </div> <!--.row-->
    </div><!--.container-->

    <script>
        <?php
        echo 'let cuenta = "' . $atributos['uCuenta'][0] . '";';
        echo 'let rol = "' . $rol . '";';
        ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.ucol.mx/cms/apps/assets/js/apps.min.js"></script>
    <script src="js/app.js"></script>

</body>

</html>