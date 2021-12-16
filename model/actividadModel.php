<?php

class actividadModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=PYF;charset=utf8', 'root', '');
    }
    //ejercicio 1
    public function depositarcuenta($id) {
        $sentencia = $this->db->prepare("SELECT kms FROM actividad WHERE id_cliente=?");
        $sentencia->execute(array($id));
    }
    //ejercicio 2
    public function obtenerkilometros($id) {
        $sentencia = $this->bd->prepare("SELECT * FROM actividad WHERE id_cliente=?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerkilometro ($id) {
        $sentencia = $this->bd->prepare("SELECT kms FROM actividad WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    //ejercicio3
    public function fondossuficientes($id) {
        $sentencia = $this->db->prepare("SELECT kms FROM actividad WHERE id_cliente=?");
        $sentencia->execute(array($id));
    }
    public function tranferencia($id) {
        $sentencia = $this->db->prepare("SELECT tipo_operación FROM actividad WHERE id_cliente=?");
        $sentencia->execute(array($id));
    }
    public function obtenerfecha($id) {
        $sentencia = $this->bd->prepare("SELECT fecha FROM actividad WHERE id_cliente=?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    public function obteneractividad ($id) {
        $sentencia = $this->bd->prepare("SELECT actividad FROM avtividad WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    


}