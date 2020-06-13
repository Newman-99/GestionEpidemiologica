<?php 

var_dump($_POST);

	$requestAjax = TRUE;

	require_once "../config/app.php";
	
	if (isset($_POST['docIdentidad'])) {

		require_once "../controller/personaController.php";

		require_once "../controller/casoEpidemiologicoController.php";


		//$personaController = new personaController();
	 	//$personaController->getPersonaController($_POST);
echo "<br><br>";		
		$casoEpidemiologicoController = new casoEpidemiologicoController();
	 	$casoEpidemiologicoController->deleteCasoEpidemiologicoController($_POST);
	} else { 
		/*
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
	*/}
	


 ?>   
