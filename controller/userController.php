	<?php 
	
	$requestAjax = TRUE;

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	}

	class userController extends userModel{

		public function addUserController(){
			
			
			$usuario_dni = mainModel::cleanStringSQL($_POST["usuario_dni_reg"])
			
			alias =>mainModel::cleanStringSQL($alias
			
			docIdentidad =>mainModel::cleanStringSQL($docIdentidad
			
			idNivelPermiso =>mainModel::cleanStringSQL($idNivelPermiso
			
			idEstado =>mainModel::cleanStringSQL($idEstado
			
			passEncypt =>mainModel::cleanStringSQL($passEncypt
			
			correoElectronico =>mainModel::cleanStringSQL($correoElectronico;

			$usuario_nombre = mainModel::cleanStringSQL($_POST["usuario_nombre_reg"]);

			$usuario_apellido = mainModel::cleanStringSQL($_POST["usuario_apellido_reg"]);

			$usuario_telefono = mainModel::cleanStringSQL($_POST["usuario_telefono_reg"]);

			$usuario_direccion = mainModel::cleanStringSQL($_POST["usuario_direccion_reg"]);

			$usuario_email = mainModel::cleanStringSQL($_POST["usuario_email_reg"]);

			$usuario_usuario = mainModel::cleanStringSQL($_POST["usuario_usuario_reg"]);

			$usuario_clave = mainModel::cleanStringSQL($_POST["usuario_clave_1_reg"]);

			$usuario_clave_confirm = mainModel::cleanStringSQL($_POST["usuario_clave_2_reg"]);

			$usuario_email = mainModel::cleanStringSQL($_POST["usuario_email_reg"]);

//			$usuario_estado = mainModel::cleanStringSQL($_POST["usuario_estado_reg"]);

			$usuario_privilegio = mainModel::cleanStringSQL($_POST["usuario_privilegio_reg"]);		 	

	

			if (mainModel::isDataEmtpy($usuario_dni,
				 	$usuario_nombre,
				 	$usuario_apellido,
				 	$usuario_telefono,
				 	$usuario_direccion,
				 	$usuario_email,
				 	$usuario_usuario,
				 	$usuario_clave,
				 	$usuario_clave_confirm,/*
				 	$usuario_estado,*/
				 	$usuario_privilegio)) {

				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
					"Tipo"=>"error"
				];

				echo json_encode($alerta);
				?>

				<script> var data = <?php echo json_encode($alerta); ?>;

				alertas_ajax(data);

				</script>;

				<?php

				echo "<script>alertas_ajax(".json_encode($alerta).";</script>";
 

			}
		}
}


 ?>
