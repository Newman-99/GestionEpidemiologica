 <?php 
require_once "./model/viewsModel.php";
class viewsController extends viewsModel{

	public function getTemplateController(){
		return require_once "./view/template.php";
	}

	public function getViewsController(){
		 if (isset($_GET['views'])) {
		 	$route=explode("/",$_GET["views"]);
		 	$answer = viewsModel::getViewModel($route[0]);
		 } else {
		 	$answer = "login";
		 }
	return $answer;	 
	} 

}


 ?>