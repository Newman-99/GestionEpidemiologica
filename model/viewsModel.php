<?php 
class viewsModel{

	protected static function getViewModel($requestedView){
					$whileList=["registrar-caso-epidemi","utilities-other","utilities-color","utilities-border","utilities-animation","tables","dashboard","charts","cards","buttons","blank","userList",'dataAccount',"userSettings",'activityLogUser','registerCasosEpidemi'];

					if (in_array($requestedView, $whileList)) {  

						if (is_file("./view/contents/".$requestedView."-view.php")) {
							$content = "view/contents/".$requestedView."-view.php";
						}else{
							$content = "404";
						}

					}elseif($requestedView=="login" || $requestedView == "index" ){
						$content = "login";

					}elseif ($requestedView=="register-user" || $requestedView=="forgot-password" || $requestedView=="restartUser"){
					   $content = $requestedView;
					}else{
						$content = "404";
					}

				return $content;
			
		}
	}
 ?>
