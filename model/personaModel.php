<?php 	require_once "mainModel.php";

	class personaModel extends mainModel
	{

			protected static function addPersonaModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO personas(
		 doc_identidad,
		 nombres,
		 apellidos,
		 fecha_nacimiento,
		 id_nacionalidad,
		 id_genero) VALUES (
		 :doc_identidad,
		 :nombres,
		 :apellidos,
		 :fecha_nacimiento,
		 :id_nacionalidad,
		 :id_genero);");

			return $sqlQuery->execute(array(
		 "doc_identidad"=>$dataPersona['doc_identidad'],
		 "nombres"=>$dataPersona['nombres'],
		 "apellidos"=>$dataPersona['apellidos'],
		 "fecha_nacimiento"=>$dataPersona['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataPersona['id_nacionalidad'],
		 "id_genero"=>$dataPersona['id_genero']));

		}

			protected static function updatePersonaModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE personas SET
		 nombres = :nombres,
		 apellidos = :apellidos,
		 fecha_nacimiento = :fecha_nacimiento,
		 id_genero = :id_genero WHERE doc_identidad = :doc_identidad AND id_nacionalidad = :id_nacionalidad;");

			return $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataPersona['id_nacionalidad'],
		 "doc_identidad"=>$dataPersona['doc_identidad'],
		 "nombres"=>$dataPersona['nombres'],
		 "apellidos"=>$dataPersona['apellidos'],
		 "fecha_nacimiento"=>$dataPersona['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataPersona['id_nacionalidad'],
		 "id_genero"=>$dataPersona['id_genero']));

		}


			protected static function deletePersonaModel($dataPersona){

		mainModel::disableForeingDB();
		
		$sqlQuery = mainModel::connectDB()->prepare("DELETE FROM personas WHERE id_nacionalidad =:id_nacionalidad AND doc_identidad = :doc_identidad;");

		 $resultQuery = $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataPersona['id_nacionalidad'],
		 "doc_identidad"=>$dataPersona['doc_identidad']));
	
		mainModel::enableForeingDB();

		return $resultQuery;


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