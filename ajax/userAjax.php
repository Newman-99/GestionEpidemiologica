<?php 

var_dump($_POST);

	$requestAjax = true;

	require_once "../config/app.php";
	
	if (isset($_POST['registerUser'])) {

/*
		require_once "../controller/pacienteController.php";
		$pacienteController = new pacienteController();
	
		 $pacienteController->addpacienteController($_POST);

*/
	} else { 

/*		
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/	}
	


 ?>   
