<?php 

	$requestAjax = TRUE;

	require_once "../config/app.php";

		require_once "../controller/casoEpidemiologicoController.php";

		$casoEpidemiologicoController = new casoEpidemiologicoController();
	
if (isset($_POST['operationType']) && $_POST['operationType'] == "register"){

	 	$casoEpidemiologicoController->addCasoEpidemiologicoController($_POST);

}elseif ($_POST['operationType'] === "delete") {
	 	$casoEpidemiologicoController->deleteCasoEpidemiologicoController($_POST);
	
		//$personaController = new personaController();
	 	//$personaController->getPersonaController($_POST);
	} else { 
		/*
		session_start(["name"=> "dptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
		*/
	}
	


 ?>   
