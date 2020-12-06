<?php 
	
	require_once "../config/app.php";

		$requestAjax =  TRUE;

	require_once "../model/mainModel.php";
		
			$mainModel = new mainModel();

	if (isset($_POST['operationType']) && $_POST['operationType'] == "backup") {


			$mainModel->backupDatabase();

	}elseif (isset($_FILES['restore'])) {

			$mainModel->restoreDatabase($_FILES);
				
 }else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
