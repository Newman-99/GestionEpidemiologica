<?php 

$requestAjax = TRUE;

	if($requestAjax){
		require_once "../controller/personController.php";
	}else{
		require_once "./controller/personController.php";
	}

	class pacienteController extends personController{

		public function addPacienteController($dataPaciente){
			return personController::addPersonControllerr($dataPaciente);
		}
	}

 ?>