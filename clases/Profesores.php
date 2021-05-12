<?php

namespace Clases;

require "../clases/Conexion.php";

use Clases\Conexion;
use PDO;
use PDOException;

class Profesores extends Conexion
{
    private $id;
    private $nom_prof;
    private $sueldo;
    private $fecha_prof;
    private $dep;

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $i = "insert into profesores(nom_prof,sueldo,fecha_prof,dep) values(:n,:s,:f,:d)";
        $stmt = parent::$conexion->prepare($i);
        try {
            $stmt->execute([
                ':n' => $this->nom_prof,
                ':s' => $this->sueldo,
                ':f' => $this->fecha_prof,
                ':d' => $this->dep
                ]);
        } catch (PDOException $ex) {
            die("Error al crear un articulo:" . $ex->getMessage());
        }
    }

    public function mostrarDatos(){
        $con = "select * from profesores";
        $stmt = parent::$conexion->prepare($con);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al mostrar todos los profesores" . $ex->getMessage());
        }
        return $stmt;
    }

    public function borrar(){
        $c = "delete from profesores where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar los profesores:" . $ex->getMessage());
        }
    }

    public function leerDatos()
    {
        $c = "select * from profesores where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al leer un profesor:" . $ex->getMessage());
        }
        $obj = $stmt->fetch(PDO::FETCH_OBJ);
        return $obj;
    }

    public function existeProfesor($nom_prof)
    {
        $c = "select * from profesores   where nom_prof=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $nom_prof
            ]);
        } catch (PDOException $ex) {
            die("Error al comprobar existencia de profesores:" . $ex->getMessage());
        }
        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        return ($fila == null) ? false : true;
    }

    public function update()
    {
        $u = "update profesores set nom_prof=:n,sueldo=:s,fecha_prof=:f,dep=:d where id=:i";
        $stmt = parent::$conexion->prepare($u);
        try {
            $stmt->execute([
                ':n' => $this->nom_prof,
                ':s' => $this->sueldo,
                ':f' => $this->fecha_prof,
                ':d' => $this->dep,
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al editar un profesor:" . $ex->getMessage());
        }
    }

    public function mostrarDepartamentos(){
        $m = "select * from departamentos";
        $stmt = parent::$conexion->prepare($m);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al mostrar los departamentos:" . $ex->getMessage());
        }

        return $stmt;
    }
    //GETTERS Y SETTERS
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

    /**
     * Get the value of nom_prof
     */ 
    public function getNom_prof()
    {
        return $this->nom_prof;
    }

    /**
     * Set the value of nom_prof
     *
     * @return  self
     */ 
    public function setNom_prof($nom_prof)
    {
        $this->nom_prof = $nom_prof;

        return $this;
    }

    /**
     * Get the value of sueldo
     */ 
    public function getSueldo()
    {
        return $this->sueldo;
    }

    /**
     * Set the value of sueldo
     *
     * @return  self
     */ 
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    /**
     * Get the value of fecha_prof
     */ 
    public function getFecha_prof()
    {
        return $this->fecha_prof;
    }

    /**
     * Set the value of fecha_prof
     *
     * @return  self
     */ 
    public function setFecha_prof($fecha_prof)
    {
        $this->fecha_prof = $fecha_prof;

        return $this;
    }

    /**
     * Get the value of dep
     */ 
    public function getDep()
    {
        return $this->dep;
    }

    /**
     * Set the value of dep
     *
     * @return  self
     */ 
    public function setDep($dep)
    {
        $this->dep = $dep;

        return $this;
    }
}
