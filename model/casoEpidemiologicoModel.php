<?php 	require_once "mainModel.php";

	class casoEpidemiologicoModel extends mainModel
	{

			protected static function addCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO casosEpidemiologicos(
		 docIdentidad,
		 CATALOG_KEY_CIE10,
		 idParroquia,
		 direccion,
		 telefono,
		 fecha) VALUES (		
		 :docIdentidad,
		 :CATALOG_KEY_CIE10,
		 :idParroquia,
		 :direccion,
		 :telefono,
		 :fecha);");

			$sqlQuery->execute(array(
		 "docIdentidad"=>$dataCasoEpidemi['docIdentidad'],
		 "CATALOG_KEY_CIE10"=>$dataCasoEpidemi['CATALOG_KEY_CIE10'],
		 "idParroquia"=>$dataCasoEpidemi['idParroquia'],
		 "direccion"=>$dataCasoEpidemi['direccion'],
		 "telefono"=>$dataCasoEpidemi['telefono'],
		 "fecha"=>$dataCasoEpidemi['fecha']));

			return $sqlQuery;
		}	
	
	protected static function updateCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE casosEpidemiologicos  SET 
		 docIdentidad = :docIdentidad,
		 CATALOG_KEY_CIE10 = :CATALOG_KEY_CIE10,
		 idParroquia = :idParroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha = :fecha WHERE idCasoEpidemiologico = :idCasoEpidemiologico;");

			$sqlQuery->execute(array(
		 "idCasoEpidemiologico" => $dataCasoEpidemi['idCasoEpidemiologico'],
		 "docIdentidad" => $dataCasoEpidemi['docIdentidad'],
		 "CATALOG_KEY_CIE10" => $dataCasoEpidemi['CATALOG_KEY_CIE10'],
		 "idParroquia" => $dataCasoEpidemi['idParroquia'],
		 "direccion" => $dataCasoEpidemi['direccion'],
		 "telefono" => $dataCasoEpidemi['telefono'],
		 "fecha" => $dataCasoEpidemi['fecha']));

			return $sqlQuery;

		}


			protected static function deleteCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM casosEpidemiologicos WHERE idCasoEpidemiologico = :idCasoEpidemiologico;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "idCasoEpidemiologico"=>$dataCasoEpidemi['idCasoEpidemiologico']));

			return $sqlQuery;
		}



	}
