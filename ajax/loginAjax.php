<?php 

		$requestAjax = TRUE;

		require_once "../config/app.php";

		require_once "../controller/loginController.php";

		$loginController = new loginController();

if (isset($_POST['operationType']) && $_POST['operationType'] === "login") {


		 $loginController->loginUserController($_POST);


	}elseif (isset($_GET['operationType']) && $_GET['operationType'] === "closeSession") {
		$loginController->closeSessionController($_GET);

		}elseif(isset($_POST['operationType']) && $_POST['operationType'] === "forgotPassUser") {

		$loginController->forgotPassUserController($_POST);

		}elseif(isset($_POST['operationType']) && $_POST['operationType'] === "restart") {

		$loginController->addDataForUserRestartController($_POST);

	}else{	
/*
		$loginController->loginUserController($closeSession);

		session_start(["name"=> "dptoEpidemi"]);
		session_unset();
		session_destroy();
		header("Location: ".SERVERURL."login/");
*/
}


 ?>