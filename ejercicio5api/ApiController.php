<?php
require_once "./Model/clienteModel.php";
require_once "./Model/actividadModel.php";
require_once "./Model/tarjetaModel.php";
require_once "./View/ApiView.php";

class ApiTaskController{

    private $model;
    private $actividadModel;
    private $tarjetaModel;
    private $view;

    public function __construct(){
        $this->model = new clienteModel();
        $this->tarjetaModel = new tarjetaModel();
        $this->actividadModel = new actividadModel();
        $this->view = new ApiView();
    }

    public function obtenerListadoTarjetas(){
        $tarjetas = $this->tarjetaModel->obtenertarjetas();
        return $this->view->response($tarjetas, 200);
    }


    public function dardebajatarjeta($params = null) {
        $idTarjeta = $params[":ID"];
        $tarjeta = $this->tarjetaModel->obtenertarjeta($idTarjeta);

        if ($tarjeta) {
            $this->tarjetaModel->eliminartarjeta($idTarjeta);
            return $this->view->response("La tarea con el id=$idTarjeta fue borrada", 200);
        } else {
            return $this->view->response("La tarea con el id=$idTarjeta no existe", 404);
        }
    }
     
    public function obteneractividad($params = null){
        $idActividad = $params[":ID"];
        $fecha = $this->actividadModel->obtenerfecha($idActividad);
        if ($fecha) {
            $this->actividadModel->obteneractividad($idActividad);
        }elseif($fecha){
            $this->actividadModel->obteneractividad($idActividad);
        }

    }
    


    private function getBody() {
        $bodyString = file_get_contents("php://input");
        return json_decode($bodyString);
    }

}