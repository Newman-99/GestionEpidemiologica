<?php 	require_once "mainModel.php";

	class personaModel extends mainModel
	{

			protected static function addPersonaModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO personas(
		 docIdentidad,
		 nombres,
		 apellidos,
		 fechaNacimiento,
		 idNacionalidad,
		 idGenero,
		 telefono) VALUES (
		 :docIdentidad,
		 :nombres,
		 :apellidos,
		 :fechaNacimiento,
		 :idNacionalidad,
		 :idGenero);");

			$sqlQuery->execute(array(
		 "docIdentidad"=>$dataPersona['docIdentidad'],
		 "nombres"=>$dataPersona['nombres'],
		 "apellidos"=>$dataPersona['apellidos'],
		 "fechaNacimiento"=>$dataPersona['fechaNacimiento'],
		 "idNacionalidad"=>$dataPersona['idNacionalidad'],
		 "idGenero"=>$dataPersona['idGenero']));


			return $sqlQuery;

	}	

			protected static function addPersonaTlfModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO telefonos(
		 telefono,
		 docIdentidad) VALUES (
		 :docIdentidad,
		 :telefono);");

			$sqlQuery->execute(array(
		 "docIdentidad"=>$dataPersona['docIdentidad'],
		 "telefono"=>$dataPersona['telefono']));

			return $sqlQuery;

		}
	}


 ?>