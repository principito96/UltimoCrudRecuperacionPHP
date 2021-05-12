<?php
session_start();

require "../vendor/autoload.php";
require "../clases/Departamentos.php";

use Clases\Departamentos;

if(!isset($_POST['codigo'])){
    header("Location:index.php");
    die();
}

$departamento = new Departamentos();
$departamento->setId($_POST['codigo']);
$departamento->borrar();
$departamento = null;
$_SESSION['mensaje']="Departamento Borrado Correctamente";
header("Location:indexd.php");