<?php 
			$requestAjax = TRUE;

		require_once "../config/app.php";

	require_once "../controller/activityLogController.php";
	
			$activityLogController = new activityLogController();
	if (isset($_GET['activityLogSessions'])) {
               $activityLogController->getTableDataActivityLogSessionsController();
		}
 ?>