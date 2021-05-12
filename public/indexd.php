<?php
    session_start();

use Clases\Departamentos;

require '../vendor/autoload.php';
require '../clases/Departamentos.php';

$departamento = new Departamentos();
$datos = $departamento->mostrarDatos();
$departamento = null;
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
    <title>Index</title>
</head>

<body style="background-color: lightblue">
    <h3 class="text-center mt-3">CRUD Departamentos</h3>
    <div class="container mt-5 ">
        <?php
        require 'resources/mensaje.php';
        ?>
        <a href="crearDepartamento.php" class="btn btn-primary my-3">Nuevo departamento</a>
        <a href="index.php" class="btn btn-success my-3">CRUD Profesores</a>
        <table class="table table-success table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre Departamento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $datos->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>";
                    echo "<th scope='row'>{$fila->id}</th>";
                    echo "<td>{$fila->nom_dep}</td>";
                    echo "<td>";
                    echo "<form name='as' method='POST' class='form-inline' action='borrarDepartamentos.php'>\n";
                    echo "<a href='updateDepartamentos.php?id={$fila->id}' class='btn btn-warning'>Editar</a>";
                    echo "<input type='hidden' name='codigo' value='{$fila->id}'>";
                    echo "<button type='submit' class='ml-2 btn btn-danger'>Borrar</button>\n";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>