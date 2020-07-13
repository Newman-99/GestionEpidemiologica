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
		 idGenero) VALUES (
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

			protected static function updatePersonaModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE personas SET
		 docIdentidad = :docIdentidad,
		 nombres = :nombres,
		 apellidos = :apellidos,
		 fechaNacimiento = :fechaNacimiento,
		 idNacionalidad = :idNacionalidad,
		 idGenero = :idGenero WHERE docIdentidad = :docIdentidad;");

			$sqlQuery->execute(array(
		 "docIdentidad"=>$dataPersona['docIdentidad'],
		 "nombres"=>$dataPersona['nombres'],
		 "apellidos"=>$dataPersona['apellidos'],
		 "fechaNacimiento"=>$dataPersona['fechaNacimiento'],
		 "idNacionalidad"=>$dataPersona['idNacionalidad'],
		 "idGenero"=>$dataPersona['idGenero']));


			return $sqlQuery;
		}


			protected static function deletePersonaModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM personas WHERE docIdentidad = :docIdentidad;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "docIdentidad"=>$dataPersona['docIdentidad']));

			return $sqlQuery;
		}

			protected static function getPersonaModel($personAttributesFilter,$filterValues){
 
		    $sqlQuery="SELECT * FROM personas ";                  

		 // Recoger y anadir campos para filtracion de resultado
		  if (!empty($personAttributesFilter)) {
		    $sqlQuery .= ' WHERE ' . implode(' AND ', $personAttributesFilter);
		  }

			$sqlQuery = mainModel::connectDB()->prepare($sqlQuery);

		  foreach($filterValues as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }

		    return $sqlQuery;

			}
	}




 ?>