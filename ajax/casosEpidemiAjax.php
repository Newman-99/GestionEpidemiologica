<?php 

	$requestAjax = TRUE;

	require_once "../config/app.php";

		require_once "../controller/casoEpidemiController.php";

		$casoEpidemiController = new casoEpidemiController();
	
if (isset($_POST['operationType']) && $_POST['operationType'] == "register"){

	 	$casoEpidemiController->addcasoEpidemiController($_POST);

}elseif (isset($_POST['operationType']) && $_POST['operationType'] === "delete") {
	 	$casoEpidemiController->deletecasoEpidemiController($_POST);

}elseif ($_POST['getParroquias']) {
	 	$casoEpidemiController->getParroquias();
	
		} else { 
		/*
		session_start(["name"=> "dptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		*/
	}
	


 ?>   
