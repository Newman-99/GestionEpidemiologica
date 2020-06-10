<?php 
class viewsModel{

	protected static function getViewModel($requestedView){

					$whileList=["registrar-caso-epidemi","utilities-other","utilities-color","utilities-border","utilities-animation","tables","register","login","forgot-password","dashboard","charts","cards","buttons","blank"];

					if (in_array($requestedView, $whileList)) {  

						if (is_file("./view/contents/".$requestedView."-view.php")) {
							$content = "view/contents/".$requestedView."-view.php";
						}else{
							$content = "404";
						}

						}elseif($requestedView=="login" || $requestedView == "index" ){
						$content = "login";
					}else{
					
						$content = "404"; 
					}		
				return $content;
			}
		}
 ?>
