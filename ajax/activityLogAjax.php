<?php 
			$requestAjax = TRUE;

		require_once "../config/app.php";

	require_once "../controller/activityLogController.php";
	
			$activityLogController = new activityLogController();
	if ($_POST['operationType'] === "query" || TRUE) {
               $activityLogController->paginateActivityLogUserController($_POST);
		}
 ?>