<?php 

		$requestAjax =  TRUE;

	require_once "../config/app.php";

//var_dump($_POST);
	require_once "../controller/cie10DataController.php";
	
			$cie10DataController = new cie10DataController();

	if (isset($_FILES['fileCSVCIE10'])) {
		$cie10DataController->updateCie10DataController($_FILES);			

		}elseif(isset($_GET['cie10listCatalog'])) {

		$cie10DataController->paginatecie10DataController(/*$_POST*/);						
 }else { 
/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
