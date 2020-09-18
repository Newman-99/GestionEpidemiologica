<?php 	require_once "mainModel.php";

	class casoEpidemiologicoModel extends mainModel
	{

			protected static function addCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO casos_epidemiologicos(
		 doc_identidad,
		 catalog_key_cie10,
		 id_parroquia,
		 direccion,
		 telefono,
		 fecha) VALUES (		
		 :doc_identidad,
		 :catalog_key_cie10,
		 :id_parroquia,
		 :direccion,
		 :telefono,
		 :fecha);");

			$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasoEpidemi['doc_identidad'],
		 "catalog_key_cie10"=>$dataCasoEpidemi['catalog_key_cie10'],
		 "id_parroquia"=>$dataCasoEpidemi['id_parroquia'],
		 "direccion"=>$dataCasoEpidemi['direccion'],
		 "telefono"=>$dataCasoEpidemi['telefono'],
		 "fecha"=>$dataCasoEpidemi['fecha']));

			return $sqlQuery;
		}	
	
	protected static function updateCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE casos_epidemiologicos  SET 
		 doc_identidad = :doc_identidad,
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha = :fecha WHERE id_caso_epidemiologico = :id_caso_epidemiologico;");

			$sqlQuery->execute(array(
		 "id_caso_epidemiologico" => $dataCasoEpidemi['id_caso_epidemiologico'],
		 "doc_identidad" => $dataCasoEpidemi['doc_identidad'],
		 "catalog_key_cie10" => $dataCasoEpidemi['catalog_key_cie10'],
		 "id_parroquia" => $dataCasoEpidemi['id_parroquia'],
		 "direccion" => $dataCasoEpidemi['direccion'],
		 "telefono" => $dataCasoEpidemi['telefono'],
		 "fecha" => $dataCasoEpidemi['fecha']));

			return $sqlQuery;

		}


			protected static function deleteCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM casos_epidemiologicos WHERE id_caso_epidemiologico = :id_caso_epidemiologico;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "id_caso_epidemiologico"=>$dataCasoEpidemi['id_caso_epidemiologico']));

			return $sqlQuery;
		}



	}
