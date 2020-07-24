<?php 

		$requestAjax = true;

	require_once "../config/app.php";
	
	if (/*$_POST['operationType'] === "save"*/ true) {

		require_once "../controller/userController.php";
		
		$userController = new userController();
	
		$userController->addUserController($_POST);


	} else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
