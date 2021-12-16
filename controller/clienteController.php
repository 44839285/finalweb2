<?php
require_once "./model/clienteModel.php";
require_once "./model/actividadModel.php";
require_once "./model/tarjetaModel.php";
require_once "./view/View.php";
class clienteController {

    private $view;
    private $model;
    private $actividadmodel;
    private $tarjetamodel;
    private $authHelper;


    public function __construct() {
        $this->view = new View();
        $this->model = new clienteModel();
        $this->actividadmodel = new actividadModel();
        $this->tarjetamodel = new tarjetaModel();
        $this->authHelper = new AuthHelper();
    }
   //Ejercicio 1
    public function altacliente(){
        $this->authHelper->checkAdmin();
			if (isset($_POST["id"],$_POST["nombre"],$_POST["dni"],$_POST["telefono"],$_POST["direccion"],$_POST["ejecutivo"])) {
				$id = $_POST["id"];
                $nombre = $_POST["nombre"];
				$dni = $_POST["dni"];
                $telefono = $_POST["telefono"];
				$direccion = $_POST["direccion"];
                $ejecutivo = $_POST["ejecutivo"];

				if (empty($this->model->clienteconelmismodni($dni,$id))) {
					if (empty($this->actividadmodel->depositarcuenta($id))) {                        
                        $this->model->addcliente($id,$nombre,$dni,$telefono,$direccion,$ejecutivo);      
					}
					else {
						$this->view->sendError("un usuario no puede tener el mismo dni ");	
					}

				}
				else {
					$this->view->sendError("el usuario ya fue creado");
				}
			}

			else {
				$this->view->sendError("faltan completar datos");
			}
    }
    //Ejercicio 2
    public function resumendelacuenta($id){
        $nombrecliente = $this->model->getNombre($id);
        $dnicliente = $this->model->obtenerdni($id);
        $actividades = $this->actividadmodel->obtenerkilometros($id);
        $tarjetasasociadas= $this->tarjetamodel->obtenertarjetas($id);
        
        $sumaksm = 0;
        $cantValordeksm = 0;
        foreach ($actividades as $actividad) {
            $sumaksm += $this->actividadmodel->obtenerkilometro($actividad->id);
            $cantValordeksm++;
        }
        $operacionesdekms = $sumaksm / $cantValordeksm;

        $this->view->showTable($nombrecliente, $dnicliente, $actividades,$tarjetasasociadas,$operacionesdekms);
    }
    //ejercicio 3
    public function tranferenciarapida($id){
        $this->authHelper->checkLoggedIn();
        if (empty($this->actividadmodel->fondossuficientes($id))) {
            if (empty($this->model->clienteexista($id))) {
                $this->actividadmodel->tranferencia($id);
            }else{
                $this->view->sendError("la tranferencia fue enviada");
            }
        }else {
            $this->view->sendError("no tiene fondos suficientes");
        }
    }
    



}