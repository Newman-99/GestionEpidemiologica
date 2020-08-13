<?php 
class viewsModel{

	protected static function getViewModel($requestedView){

					$whileList=["registrar-caso-epidemi","register-user","utilities-other","utilities-color","utilities-border","utilities-animation","tables","register","login","forgot-password","dashboard","charts","cards","buttons","blank","user-list",'dataAccount',"userSettings"];

					if (in_array($requestedView, $whileList)) {  

						if (is_file("./view/contents/".$requestedView."-view.php")) {
							$content = "view/contents/".$requestedView."-view.php";
						}else{
							$content = "404";
						}

						}elseif($requestedView=="login" || $requestedView == "index" ){
						$content = "login";
						}elseif($requestedView=="register-user"){
					   $content = "register-user";
					}else{
					
						$content = "404"; 
					}
				return $content;
			}
		}
 ?>
