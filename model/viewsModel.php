<?php 
class viewsModel{

	protected static function getViewModel($requestedView){
					$whileList=["utilities-other","utilities-color","cie10DataUpdate","utilities-border","utilities-animation","tables","dashboard","charts","cards","buttons","blank","userList",'dataAccount',"userSettings",'activityLogSessions','activityLogCasosEpidemi','registerCasosEpidemi','cie10Catalog','casosEpidemiList','reportEPI','reportEpiFilasConfig','atribsEspecialEpiConfig'];

					if (in_array($requestedView, $whileList)) {  

						if (is_file("./view/contents/".$requestedView."-view.php")) {
							$content = "view/contents/".$requestedView."-view.php";

						}else{
							$content = "404";

						}

					}elseif($requestedView=="login" || $requestedView == "index" ){
						$content = "login";

					}elseif ($requestedView=="registerUser" || $requestedView=="forgotPassword" || $requestedView=="restoreUser"){
					   $content = $requestedView;

					}else{
						$content = "404";

					}
				return $content;
			
		}
	}
 ?>
