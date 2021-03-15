<?php 
	
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
				
 }else { 
		
			$loginController->forceClosureController();
			}
	


 ?>   
