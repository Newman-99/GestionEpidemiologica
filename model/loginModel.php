<?php 	require_once "mainModel.php";

	/**
	 * 
	 */
class userModel extends mainModel
{
	protected function closeSessionModel($dataSession){
		if (!empty($dataSession["aliasUser"]) && $dataSession["tokenCurrentUser"] == $dataSession["token_dptoEpidemi"]) {

			$updateBitacota = mainModel::updateBitacota($dataSession);
			
			if ($updateBitacota->rowCount()) {
				session_unset();
				session_destroy();
				return true;
			} else {
			return false;
			}
		}else{
			return false;
		}
	}	
}
 ?>