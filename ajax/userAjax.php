<?php 
	$requestAjax = true;

	require_once "../config/app.php";
	
	if (isset($_POST['registerUser'])) {


		require_once "../controller/userController.php";
		
		require_once "../controller/personaController.php";

		$personaController = new personaController();
	
		$personaController->addPersonaController($_POST);

		$userController = new userController();
	
		$userController->getUserController($_POST);


	} else { 

/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
