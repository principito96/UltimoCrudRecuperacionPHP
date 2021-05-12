<?php
session_start();

require "../vendor/autoload.php";
require "../clases/Profesores.php";

use Clases\Profesores;

if(!isset($_POST['codigo'])){
    header("Location:index.php");
    die();
}

$profesor = new Profesores();
$profesor->setId($_POST['codigo']);
$profesor->borrar();
$profesor = null;
$_SESSION['mensaje']="Profesor Borrado Correctamente";
header("Location:index.php");