<?php 


		$requestAjax =  TRUE;

	require_once "../config/app.php";

	require_once "../controller/cie10DataController.php";
	
			$cie10DataController = new cie10DataController();

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

	
	if (isset($_FILES['fileCSVCIE10'])) {

		$cie10DataController->updateCie10DataController($_FILES);			


		}elseif(isset($_GET['cie10listCatalog'])) {

		$cie10DataController->paginatecie10DataController();						

		}elseif(isset($_POST['getCasesCIE10'])) {
	
		$cie10DataController->getCasesCIE10($_POST);		

		}elseif(isset($_POST['exportCatalogCIE10'])) {
	
		$cie10DataController->exportCatalogCIE10($_POST['typeArchive']);		

 }else {

 /*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
