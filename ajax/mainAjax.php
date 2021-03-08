<?php 	
				ini_set('memory_limit','1024M');


	require_once "../config/app.php";

		$requestAjax =  TRUE;

	require_once "../model/mainModel.php";
		
			$mainModel = new mainModel();

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

	if (isset($_POST['operationType']) && $_POST['operationType'] == "backup") {


			$mainModel->backupDatabase();

	}elseif (isset($_FILES['restore'])) {

			$mainModel->restoreDatabase($_FILES);
				
 	}elseif (isset($_POST['operationType']) && $_POST['operationType'] == "config"){

			$mainModel->backupClouConfig($_POST);
				
 }else { 
		
			$loginController->forceClosureController();
			}
	


 ?>   
