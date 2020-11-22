<?php 
require_once "./config/app.php";

require_once "./controller/viewsController.php";

 $template = new viewsController();
 $template->getTemplateController();

 ?>