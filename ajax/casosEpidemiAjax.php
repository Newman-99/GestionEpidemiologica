<?php 

var_dump($_POST);

	$requestAjax = TRUE;

	require_once "../config/app.php";
	
	if (isset($_POST['docIdentidad'])) {

		require_once "../controller/pacienteController.php";
		//Hacer el regist con echo
		$pacienteController = new pacienteController();
	 		 //$pacienteController->addPacienteController($_POST);

	} else { 
		/*
		session_start(["name"=> "systemDptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
	*/}
	


 ?>   
