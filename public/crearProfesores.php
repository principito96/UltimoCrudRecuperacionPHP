<?php
session_start();
require '../vendor/autoload.php';
require '../clases/Profesores.php';

use Clases\Profesores;

$departamento = new Profesores();
$mostrar = $departamento->mostrarDepartamentos();
$departamento = null;

if (isset($_POST['crear'])) {
    $nombre = trim($_POST['nom_prof']);
    $sueldo = trim($_POST['sueldo']);
    $fecha = trim($_POST['fecha_prof']);
    $dep = trim($_POST['dep']);

    $profesor = new Profesores();
    if (!$profesor->existeProfesor(ucwords($nombre))) {
        $profesor->setNom_prof(ucwords($nombre));
        $profesor->setSueldo(ucwords($sueldo));
        $profesor->setFecha_prof(ucwords($fecha));
        $profesor->setDep(ucwords($dep));
        $profesor->create();
        $profesor = null;
        $_SESSION['mensaje'] = "Profesor creado correctamente";
        header("Location:index.php");
    } else {
        $_SESSION['mensaje'] = "El profesor ya existe";
        $profesor = null;
        header("Location:{$_SERVER['PHP_SELF']}");
        die();
    }
} else {
    //pintamos el form

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>Crear Profesor</title>
    </head>

    <body style="background-color:bisque">
        <h3 class="text-center mt-3">Crear Profesor</h3>
        <div class="container mt-3 text-center">
            <?php
            //llamamos a la clase mensaje para mostrar los mensajes
            require 'resources/mensaje.php';
            ?>
            <form name="nt" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mt-2">
                    <input type="text" name="nom_prof" placeholder="Nombre" required />
                </div>
                <div class="mt-2">
                    <input type="number" name="sueldo" placeholder="Sueldo" required />
                </div>
                <div class="mt-2">
                    <input type="date" name="fecha_prof" placeholder="Fecha" required />
                </div>
                <div class="mt-2">
                    <select name="dep" class="mt-2" required>
                        <option selected>Departamentos</option>
                        <?php
                        while ($item = $mostrar->fetch(PDO::FETCH_OBJ)) {
                            echo "<option value='{$item->id}'>{$item->nom_dep}</option>";
                        };
                        ?>
                    </select>
                </div>
                <div class="mt-2">
                    <input type="submit" name="crear" placeholder="Crear" class="btn btn-success mr-2" />
                    <input type="reset" value="Limpiar" class="btn btn-warning mr-2">
                    <a href="index.php" class="btn btn-primary">Volver</a>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php } ?>