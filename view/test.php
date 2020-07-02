<?php 	
$requestAjax = true;

	require_once "../config/app.php";


		require_once "../controller/userController.php";
		
		require_once "../controller/personaController.php";

	/*	$personaController = new personaController();
	
		$personaController->addPersonaController($_POST);
*/
		$personaController = new personaController();

			$dataUser['docIdentidad']="Migue122";

		
	var_dump($personaController->getPersonaController($dataUser));
 ?>