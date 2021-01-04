<?php 
	
	require_once "../config/app.php";

		$requestAjax =  TRUE;

	require_once "../controller/userController.php";
		
			$userController = new userController();

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

	if ($_POST['operationType'] === "save") {
		$userController->addUserController($_POST);
	}elseif ($_POST['operationType'] === "delete") {
		$userController->deleteUserController($_POST);

	}elseif ($_POST['operationType'] === "update") {

		$userController->updateUserController($_POST);

	}elseif ($_POST['operationType'] === "config") {

	$userController->modifyUserSafetyDataController($_POST);

	}elseif ($_POST['operationType'] === "restart") {
	$userController->restartUserController($_POST);		
				
 }else { 
		
			$loginController->forceClosureController();
			}
	


 ?>   
