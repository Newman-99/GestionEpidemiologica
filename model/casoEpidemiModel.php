<?php 	require_once "mainModel.php";

	class casoEpidemiModel extends mainModel
	{

			protected static function addCasoEpidemiModel($datacasoEpidemi){

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();


	try {
		//si no existe la persona
	if(isset($datacasoEpidemi['registerPerson'])){
		// registrar como person
		$sqlQuery  = personModel::stringQueryAddPersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		$sqlQuery->execute(array(
		 "doc_identidad"=>$datacasoEpidemi['doc_identidad'],
		 "nombres"=>$datacasoEpidemi['nombres'],
		 "apellidos"=>$datacasoEpidemi['apellidos'],
		 "fecha_nacimiento"=>$datacasoEpidemi['fecha_nacimiento'],
		 "id_nacionalidad"=>$datacasoEpidemi['id_nacionalidad'],
		 "id_genero"=>$datacasoEpidemi['id_genero']));

		$sqlQuery->closeCursor();
		}		

		//registrar caso epidemiologico
		
		$sqlQuery = $DB_transacc->prepare("INSERT INTO casos_epidemi(
		 doc_identidad,
		 id_nacionalidad,
		 catalog_key_cie10,
		 id_parroquia,
		 direccion,
		 telefono,
		 fecha_registro) VALUES (		
		 :doc_identidad,
		 :id_nacionalidad,
		 :catalog_key_cie10,
		 :id_parroquia,
		 :direccion,
		 :telefono,
		 :fecha_registro);");

			$sqlQuery->execute(array(
		 "doc_identidad"=>$datacasoEpidemi['doc_identidad'],
		 "id_nacionalidad"=>$datacasoEpidemi['id_nacionalidad'],
		 "catalog_key_cie10"=>$datacasoEpidemi['catalog_key_cie10'],
		 "id_parroquia"=>$datacasoEpidemi['id_parroquia'],
		 "direccion"=>$datacasoEpidemi['direccion'],
		 "telefono"=>$datacasoEpidemi['telefono'],
		 "fecha_registro"=>$datacasoEpidemi['fecha_registro']));

		$sqlQuery->closeCursor();

			$DB_transacc->commit();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Caso Epidemiologico Registrado",
				"Type"=>"success"
			];

			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ha ocurrido un error inesperado",
				"Text"=>"No se ha podido registar el Caso Epidemiologico en el sistema <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

		 return json_encode($alert);

	}	
	
	protected static function updatecasoEpidemiModel($datacasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE casos_epidemi  SET 
		 doc_identidad = :doc_identidad,
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha_registro = :fecha_registro WHERE id_caso_epidemi = :id_caso_epidemi;");

			$sqlQuery->execute(array(
		 "id_caso_epidemi" => $datacasoEpidemi['id_caso_epidemi'],
		 "doc_identidad" => $datacasoEpidemi['doc_identidad'],
		 "catalog_key_cie10" => $datacasoEpidemi['catalog_key_cie10'],
		 "id_parroquia" => $datacasoEpidemi['id_parroquia'],
		 "direccion" => $datacasoEpidemi['direccion'],
		 "telefono" => $datacasoEpidemi['telefono'],
		 "fecha_registro" => $datacasoEpidemi['fecha_registro']));

			return $sqlQuery;

		}


			protected static function deletecasoEpidemiModel($datacasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM casos_epidemi WHERE id_caso_epidemi = :id_caso_epidemi;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "id_caso_epidemi"=>$datacasoEpidemi['id_caso_epidemi']));

			return $sqlQuery;
		}



	}
