<?php 

	if($requestAjax){
		require_once "../model/casoEpidemiologicoModel.php";
	}else{
		require_once "./model/casoEpidemiologicoModel.php";
	}

	class casoEpidemiologicoController extends casoEpidemiologicoModel{

		public function addCasoEpidemiologicoController($dataCasoEpidemi){

		 $docIdentidad = mainModel::cleanStringSQL($dataCasoEpidemi['docIdentidad']);
		 $CATALOG_KEY_CIE10 = mainModel::cleanStringSQL($dataCasoEpidemi['CATALOG_KEY_CIE10']);
		 $idParroquia = mainModel::cleanStringSQL($dataCasoEpidemi['idParroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasoEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($dataCasoEpidemi['telefono']);

		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($dataCasoEpidemi['dateRegisterCasoEpidemi']);

		if (mainModel::isDataEmtpy(
		 $docIdentidad,
		 $CATALOG_KEY_CIE10,
		 $idParroquia,
		 $direccion,
		 $telefono,
		 $dateRegisterCasoEpidemi)){

			echo "Algo Vacio";

		}else{


		 $dataCasoEpidemi = array();

		 $dataCasoEpidemi['docIdentidad'] = $docIdentidad;
		 $dataCasoEpidemi['CATALOG_KEY_CIE10'] = $CATALOG_KEY_CIE10;
		 $dataCasoEpidemi['idParroquia'] = $idParroquia;
		 $dataCasoEpidemi['direccion'] = $direccion;
		 $dataCasoEpidemi['telefono'] = $telefono;
		 $dataCasoEpidemi['fecha'] = $dateRegisterCasoEpidemi;

			echo "<h1>REGISTRADO</h1>";

			var_dump($dataCasoEpidemi);

			 casoEpidemiologicoModel::addCasoEpidemiologicoModel($dataCasoEpidemi);


				 	}
				 }



		public function updateCasoEpidemiologicoController($dataCasoEpidemi){


		 $idCasoEpidemiologico = mainModel::cleanStringSQL($dataCasoEpidemi['idCasoEpidemiologico']);
		 $docIdentidad = mainModel::cleanStringSQL($dataCasoEpidemi['docIdentidad']);
		 $CATALOG_KEY_CIE10 = mainModel::cleanStringSQL($dataCasoEpidemi['CATALOG_KEY_CIE10']);
		 $idParroquia = mainModel::cleanStringSQL($dataCasoEpidemi['idParroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasoEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($dataCasoEpidemi['telefono']);
		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($dataCasoEpidemi['dateRegisterCasoEpidemi']);


		if (mainModel::isDataEmtpy(
		 $docIdentidad,
		 $CATALOG_KEY_CIE10,
		 $idParroquia,
		 $direccion,
		 $telefono,
		 $dateRegisterCasoEpidemi)){

			echo "Algo Vacio";

		}else{


		 $dataCasoEpidemi = array();
		 $dataCasoEpidemi['docIdentidad'] = $docIdentidad;
		 $dataCasoEpidemi['idCasoEpidemiologico'] = $idCasoEpidemiologico;
		 $dataCasoEpidemi['CATALOG_KEY_CIE10'] = $CATALOG_KEY_CIE10;
		 $dataCasoEpidemi['idParroquia'] = $idParroquia;
		 $dataCasoEpidemi['direccion'] = $direccion;
		 $dataCasoEpidemi['telefono'] = $telefono;
		 $dataCasoEpidemi['fecha'] = $dateRegisterCasoEpidemi;

			echo "<h1>Actualizado</h1>";

			var_dump($dataCasoEpidemi);

			 casoEpidemiologicoModel::updateCasoEpidemiologicoModel($dataCasoEpidemi);


				 	}
				 }
		public function deleteCasoEpidemiologicoController($dataCasoEpidemi){
			
		 $idCasoEpidemiologico = mainModel::cleanStringSQL($dataCasoEpidemi['idCasoEpidemiologico']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $idCasoEpidemiologico)) {
			 		echo "<h1>idCasoEpidemiologico VACIO</h1>";
				 	}else{


		 $dataCasoEpidemi = array();

		 $dataCasoEpidemi['idCasoEpidemiologico'] = $idCasoEpidemiologico;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($dataCasoEpidemi);

			 casoEpidemiologicoModel::deleteCasoEpidemiologicoModel($dataCasoEpidemi);

				 	}

				 }


				}
								
 ?>