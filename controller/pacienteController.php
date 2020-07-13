<?php 

$requestAjax = TRUE;

	if($requestAjax){
		require_once "../controller/personaController.php";
	}else{
		require_once "./controller/personaController.php";
	}

	class pacienteController extends personaController{

		public function addPacienteController($dataPaciente){
			return personaController::addPersonaController($dataPaciente);
		}
	}

 ?>