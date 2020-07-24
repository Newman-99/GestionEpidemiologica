<?php 
		$requestAjax = true;

		require_once "../config/app.php";

		require_once "../controller/loginController.php";

if (/*$_POST['operationType'] === "login"*/ TRUE) {

		$loginController = new loginController();

		$loginController->loginUserController($_POST);

	}

 ?>