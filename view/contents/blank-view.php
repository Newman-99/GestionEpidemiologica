
<?php 


if ($loginController->isDataEmtpyPermitedZero('    ','0','colera')) {
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos de los eventos CIE-10 son obligatorios ",
				"Type"=>"error"
			];

				echo json_encode($alert);
}
//var_dump($loginController->isDataEmtpyPermitedZero(0));
 ?>