<?php

namespace Clases;

require "../clases/Conexion.php";

use Clases\Conexion;
use PDO;
use PDOException;

class Departamentos extends Conexion
{
    private $id;
    private $nom_dep;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $i = "insert into departamentos(nom_dep) values(:n)";
        $stmt = parent::$conexion->prepare($i);
        try {
            $stmt->execute([
                ':n' => $this->nom_dep,
                ]);
        } catch (PDOException $ex) {
            die("Error al crear un departamento:" . $ex->getMessage());
        }
    }

    public function mostrarDatos(){
        $con = "select * from departamentos";
        $stmt = parent::$conexion->prepare($con);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al mostrar todos los departamentos" . $ex->getMessage());
        }
        return $stmt;
    }

    public function existeDepartamento($nom_dep)
    {
        $c = "select * from departamentos where nom_dep=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $nom_dep
            ]);
        } catch (PDOException $ex) {
            die("Error al comprobar existencia de departamentos:" . $ex->getMessage());
        }
        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        return ($fila == null) ? false : true;
    }

    public function borrar(){
        $c = "delete from departamentos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar los departamentos:" . $ex->getMessage());
        }
    }

    public function leerDatos()
    {
        $c = "select * from departamentos where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al leer un departamento:" . $ex->getMessage());
        }
        $obj = $stmt->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function update()
    {
        $u = "update departamentos set nom_dep=:n where id=:i";
        $stmt = parent::$conexion->prepare($u);
        try {
            $stmt->execute([
                ':n' => $this->nom_dep,
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al editar un profesor:" . $ex->getMessage());
        }
    }
    /**
     * Get the value of nom_dep
     */ 
    public function getNom_dep()
    {
        return $this->nom_dep;
    }

    /**
     * Set the value of nom_dep
     *
     * @return  self
     */ 
    public function setNom_dep($nom_dep)
    {
        $this->nom_dep = $nom_dep;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}