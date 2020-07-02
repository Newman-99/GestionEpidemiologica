<?php 

error_reporting(0);

		$requestAjax = true;

	require_once "../config/app.php";
	
	if (/*$_POST['operationType'] == "save"||*/ TRUE) {

		require_once "../controller/userController.php";
		
		require_once "../controller/personaController.php";

		$personaController = new personaController();

		$personaController->addPersonaController($_POST);


	//	$userController = new userController();
	
//		$userController->addUserController($_POST);

	} else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
