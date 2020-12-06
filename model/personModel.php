<?php 	require_once "mainModel.php";

	class personModel extends mainModel
	{

			public static function stringQueryAddPersonModel(){
		
		return $sqlQuery = "INSERT INTO personas(
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
		 :id_genero)";
		}

			protected static function stringQueryUpdatePersonModel(){
		return $sqlQuery = "UPDATE personas SET
		 nombres = :nombres,
		 apellidos = :apellidos,
		 fecha_nacimiento = :fecha_nacimiento,
		 id_genero = :id_genero WHERE doc_identidad = :doc_identidad AND id_nacionalidad = :id_nacionalidad ";
		}


			protected static function stringQueryDeletePersonModel(){
		
		return $sqlQuery = "DELETE FROM personas WHERE id_nacionalidad =:id_nacionalidad AND doc_identidad = :doc_identidad";

		}

			protected static function getPersonModel($personttributesFilter,$filterValues){
 
		    $sqlQuery="SELECT * FROM personas ";                  

		 // Recoger y anadir campos para filtracion de resultado
		  if (!empty($personttributesFilter)) {
		    $sqlQuery .= ' WHERE ' . implode(' AND ', $personttributesFilter);
		  }

			$sqlQuery = mainModel::connectDB()->prepare($sqlQuery);

		  foreach($filterValues as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }

		    return $sqlQuery;

			}
	}




 ?>