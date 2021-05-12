<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location:index.php");
}

require '../vendor/autoload.php';
require '../clases/Departamentos.php';

use Clases\Departamentos;

$id = $_GET['id'];
$departamento = new Departamentos();
$departamento->setId($id);
$obj = $departamento->leerDatos();



if (isset($_POST['editar'])) {
    //procesamos el formulario
    $nombre = trim($_POST['nom_dep']);

    $departamento->setNom_dep(ucwords($nombre));
    $departamento->update();
    $profe = null;
    $_SESSION['mensaje'] = "Departamento editado correctamente";
    header("Location:indexd.php");
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
        <title>Editar Articulos</title>
    </head>

    <body style="background-color:bisque">
        <h3 class="text-center mt-3">Editar Articulo</h3>
        <div class="container mt-3">
            <!-- NECESITAMOS PASARLE EL ID PARA QUE SEPA CUAL ES EL ID Y NO NOS VUELVA A CARGAR TAGS.PHP POR EL HEADER AL NO ENCONTRAR LA VARIABLE-->
            <form name="nt" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
                <div class="mt-2">
                    <input type="text" name="nom_dep" required value="<?php echo $obj->nom_dep; ?>" class="form-control" />
                </div>
                <div class="mt-2">
                    <input type="submit" name="editar" value="Editar" class="btn btn-success mr-2" />
                    <a href="indexd.php" class="btn btn-primary">Volver</a>
                </div>
            </form>
        </div>
    </body>

    </html>

<?php } ?>