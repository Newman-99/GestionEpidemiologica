<?php 
			$requestAjax = TRUE;

		require_once "../config/app.php";

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

	require_once "../controller/activityLogCasosEpidemiController.php";
	
			$activityLogCasosEpidemiController = new activityLogCasosEpidemiController();
			
	if (isset($_GET['activityLogCasosEpidemi'])) {
               $activityLogCasosEpidemiController->paginateActivityLogCasosEpidemiController();
		}
 ?>