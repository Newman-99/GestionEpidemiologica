<?php 

  	$requestAjax = TRUE;


	require_once "../config/app.php";

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

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

	 	echo $casosEpidemiController->importCasosEpidemiController($_FILES);

}elseif (isset($_POST['importCaseEpidemiConfirm'])) {

	 	$casosEpidemiController->importCasosEpidemiController($_POST);

		}elseif(isset($_POST['getEspecialAttributes'])) {
	
		$casosEpidemiController->getEspecialAttributesCIE10($_POST);		

		}elseif($_POST['operationType'] == "report") {

     $casosEpidemiController->getReportCompleteEPIController($_POST);



		} else { 
			self::forceClosureController();
	}

	
 ?>   
