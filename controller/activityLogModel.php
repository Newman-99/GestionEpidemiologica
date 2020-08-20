	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	}

	class activityLogModel extends userModel
	{
			public static function activityLogList ($nroRecordsShown){

		 $aliasUser = mainModel::cleanStringSQL($nroRecordsShown);

		$queryGetRecordsActivityLog = mainModel::runSimpleQuery("SELECT * FROM `bitacora` ORDER BY idBitacora Desc LIMIT $nroRecordsShown");

		$queryGetRecordsActivityLog->execute();

		$countRecordsActivityLog = 1;

			}
			while($recordsActivityLog=$queryGetRecordsActivityLog->fetch()){ 
		$queryGetRecordsUser = mainModel::runSimpleQuery("SELECT * FROM `usuarios` WHERE alias ='".$recordsActivityLog['aliasUsuario']."'");
		$recordsUser = $queryGetRecordsUser->fetch();
		}	
?>