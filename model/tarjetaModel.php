<?php

class tarjetaModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=PYF;charset=utf8', 'root', '');
    }
    //ejercicio2
    public function obtenertarjetas($id) {
        $sentencia = $this->bd->prepare("SELECT * FROM tarjeta WHERE id_cliente=?");
        $sentencia->execute(array($id));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //ejercicio5
    function eliminartarjeta($id){
        $sentencia = $this->db->prepare("DELETE fecha_alta FROM tarjeta  WHERE id_cliente=?");
        $sentencia = $sentencia->execute(array($id));
    }
    public function obtenertarjeta ($id) {
        $sentencia = $this->bd->prepare("SELECT tarjeta FROM tarjeta WHERE id=?");
        $sentencia->execute(array($id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }

}