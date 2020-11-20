<?php 

	$requestAjax = TRUE;

	require_once "../config/app.php";

		require_once "../controller/casosEpidemiController.php";

		$casosEpidemiController = new casosEpidemiController();
	
if (isset($_POST['operationType']) && $_POST['operationType'] == "register"){

	 	$casosEpidemiController->addcasosEpidemiController($_POST);

}elseif (isset($_POST['operationType']) && $_POST['operationType'] === "delete") {
	
	 	$casosEpidemiController->deleteCasosEpidemiController($_POST);

}elseif (isset($_POST['operationType']) && $_POST['operationType'] === "update") {
	 	$casosEpidemiController->updateCasosEpidemiController($_POST);

}elseif (isset($_POST['getParroquias'])) {
	 	$casosEpidemiController->getParroquias();

}elseif (isset($_GET['viewCasosEpidemi'])) {
	 	$casosEpidemiController->getDataTablesCasosEpidemiController();

}elseif (isset($_POST['validDataToReportEpi'])) {

	 	$casosEpidemiController->validDatatoGetDataTablesEPIController($_POST);	
}elseif (isset($_GET['viewReportEpi'])) {

	 	$casosEpidemiController->getDataTablesEPIController($_GET);

}elseif (isset($_FILES['fileCSVImportCaseEpidemi'])) {

		ini_set('memory_limit','512M');
	

		} else { 
		/*
		session_start(["name"=> "dptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		*/
	}

	
 ?>   
