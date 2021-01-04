<?php 
			$requestAjax = TRUE;

		require_once "../config/app.php";

		  require_once "../controller/loginController.php";

		  $loginController = new loginController();

	require_once "../controller/activityLogSessionsController.php";
	
			$activityLogSessionsController = new activityLogSessionsController();
	if (isset($_GET['activityLogSessions'])) {
               $activityLogSessionsController->paginateActivityLogSessionsController();
		}
 ?>