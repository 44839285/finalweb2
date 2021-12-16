<?php

class clienteModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=PYF;charset=utf8', 'root', '');
    }
    //Ejercicio 1 
    public function addcliente($id,$nombre,$dni,$telefono,$direccion,$ejecutivo) {
        $sentencia = $this->db->prepare('INSERT INTO cliente (nombre,dni,telefono,direccion,ejecutivo) VALUES (?,?,?,?,?)');
        $sentencia->execute(array($id,$nombre,$dni,$telefono,$direccion,$ejecutivo));
    }
    public function clienteconelmismodni($dni,$id) {
        $sentencia = $this->db->prepare("SELECT dni FROM cliente WHERE id=?");
        $sentencia->execute(array($dni,$id));
    }
    //ejercicio 2
    public function getNombre($id) {
        $sentencia = $this->bd->prepare("SELECT nombre FROM cliente WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    public function obtenerdni($id){
        $sentencia = $this->bd->prepare("SELECT dni FROM cliente WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    //ejercicio 3
    public function clienteexista($id){
        $sentencia = $this->bd->prepare("SELECT * FROM cliente WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }


}
