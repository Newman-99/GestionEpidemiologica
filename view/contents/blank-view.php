<?php 

  require_once './vendor_archives/autoload.php';

use PhpDbCloud\Compressors;

		$queryIsExistcasosEpidemi = $DB_transacc->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$fecha_registro'");

			if(!$queryIsExistcasosEpidemi->rowCount()){

				// si no existe persona se registra
				
		$queryIsExistPersons = $DB_transacc->query("SELECT doc_identidad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");


			if(!$queryIsExistPersons->rowCount()){

		$sqlQuery  = personModel::stringQueryAddPersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

	// si un dato de persona no es valido se dentdra cpn exitt, si esta bien devolvera los datos limpios
	
	$dataPerson = self::$personController->addPersonControllerr($dataCasosEpidemi);

	$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);

		$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		"id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));

			}

			// insertar casoEpidemi
			// 
		$sqlQuery = $DB_transacc->prepare(parent::$queryAddCasosEpidemi);
			
			$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia"=>$dataCasosEpidemi['id_parroquia'],
		 "direccion"=>$dataCasosEpidemi['direccion'],
		 "telefono"=>$dataCasosEpidemi['telefono'],
		 "fecha_registro"=>$dataCasosEpidemi['fecha_registro'],
		 "year_registro"=>$dataCasosEpidemi['year_registro']));

	// insertamos bitacora
	
           $queryGetIdEpidemiCaseToRegister = $DB_transacc->query("SELECT id_caso_epidemi FROM public.casos_epidemi ORDER BY id_caso_epidemi DESC limit 1;");

			$idEpidemiCaseToRegister = $queryGetIdEpidemiCaseToRegister->fetchColumn();

			$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToRegister;

		$sqlQuery = $DB_transacc->prepare(parent::$queryAddBitacoraCasoEpidemi);

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>1,
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario']));


			}else{

				// si existe persona

		$dataCasosEpidemi['operationImportCaseEpidemi'] = true;

		$dataPerson = self::$personController->updatePersonaController($dataCasosEpidemi);

		$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);


		$sqlQuery  = personModel::stringQueryUpdatePersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		 $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));

		// actualizar como caso epidemiologivo
		$sqlQuery = "UPDATE casos_epidemi  SET 
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha_registro = :fecha_registro,
		 year_registro = :year_registro 
		 WHERE catalog_key_cie10 = :catalog_key_cie10 AND id_nacionalidad = :id_nacionalidad AND doc_identidad = :doc_identidad;";

		$sqlQuery = $DB_transacc->prepare($sqlQuery);


			$sqlQuery->execute(array(
		 "doc_identidad" => $dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad" => $dataCasosEpidemi['id_nacionalidad'],
		 "catalog_key_cie10" => $dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia" => $dataCasosEpidemi['id_parroquia'],
		 "direccion" => $dataCasosEpidemi['direccion'],
		 "telefono" => $dataCasosEpidemi['telefono'],
		 "year_registro" => $dataCasosEpidemi['year_registro'],
		 "fecha_registro" => $dataCasosEpidemi['fecha_registro']));



			// obtner el id del caso en el sistema actual
           $queryGetIdEpidemiCaseToUpdate = $DB_transacc->query("SELECT id_caso_epidemi FROM public.casos_epidemi WHERE catalog_key_cie10 = '$catalog_key_cie10' AND id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' limit 1;");

			$idEpidemiCaseToUpdate = $queryGetIdEpidemiCaseToUpdate->fetchColumn();


			$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToUpdate;

		$sqlQuery = $DB_transacc->prepare(self::$queryAddBitacoraCasoEpidemi);

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>2,
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario']));

		}		
		
		}

 ?>



			if($queryIsExistcasosEpidemi->rowCount() == 0){

    $queryGetIdEpidemiCaseToRegister = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM public.casos_epidemi ORDER BY id_caso_epidemi DESC limit 1;");

	$idEpidemiCaseToRegister = $queryGetIdEpidemiCaseToRegister->fetchColumn();

	$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToRegister;

echo "register";	
	}else{

    $queryGetIdEpidemiCaseToUpdate = $DB_transacc->query("SELECT id_caso_epidemi FROM public.casos_epidemi WHERE catalog_key_cie10 = '$catalog_key_cie10' AND id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' limit 1;");

	$idEpidemiCaseToUpdate = $queryGetIdEpidemiCaseToUpdate->fetchColumn();
		
	$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToUpdate;
echo "update";	
}
