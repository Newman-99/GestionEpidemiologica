<?php 	require_once "mainModel.php";

	class casoEpidemiologicoModel extends mainModel
	{

			protected static function addCasoEpidemiologicoModel($dataCasoEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO casosEpidemiologicos(
		 idCasoEpidemilologico,
		 docIdentidad,
		 CATALOG_KEY_CIE10,
		 idParroquia,
		 direccion,
		 fecha) VALUES (		
		 idCasoEpidemilologico,
		 docIdentidad,
		 CATALOG_KEY_CIE10,
		 idParroquia,
		 direccion,
		 fecha);");

			$sqlQuery->execute(array(
		 "idCasoEpidemilologico"=>$dataCasoEpidemi['idCasoEpidemilologico'],
		 "docIdentidad"=>$dataCasoEpidemi['docIdentidad'],
		 "CATALOG_KEY_CIE10"=>$dataCasoEpidemi['CATALOG_KEY_CIE10'],
		 "idParroquia"=>$dataCasoEpidemi['idParroquia'],
		 "direccion"=>$dataCasoEpidemi['direccion'],
		 "fecha"=>$dataCasoEpidemi['fecha']));


			return $sqlQuery;

	}	
	}
