<?php 

		$requestAjax = true;

	require_once "../config/app.php";
	
	if ($_POST['operationType'] === "save") {

		require_once "../controller/userController.php";
		
		$userController = new userController();
	
		$userController->addUserController($_POST);


	}elseif ($_POST['operationType'] === "save")) {
		# code...
	} else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
