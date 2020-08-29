<?php 

	require_once "../config/app.php";

		$requestAjax =  TRUE;

	require_once "../controller/userController.php";
	
			$userController = new userController();

	if ($_POST['operationType'] === "save") {
		$userController->addUserController($_POST);
	}elseif ($_POST['operationType'] === "delete") {
		$userController->deleteUserController($_POST);

	}elseif ($_POST['operationType'] === "update") {

		$userController->updateUserController($_POST);

	}elseif ($_POST['operationType'] === "config") {

	$userController->modifyUserSafetyDataController($_POST);

	}elseif ($_POST['operationType'] === "restart") {
		
	$userController->reloadUserController($_POST);		
				
 }else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
