<?php 	require_once "mainModel.php";

	class casosEpidemiModel extends mainModel
	{
				protected static $queryInnerJoinCasosEpidemi = "SELECT DISTINCT ON (caso.id_caso_epidemi) caso.id_caso_epidemi, caso.telefono, caso.catalog_key_cie10,caso.id_parroquia,caso.fecha_registro,caso.direccion

			    parr.parroquia,
			        
			    casos_bit.id_bitacora, casos_bit.usuario_alias, casos_bit.bitacora_fecha, casos_bit.bitacora_hora,caso_bit.id_nacionalidad_caso,caso_bit.doc_identidad_caso,caso_bit.id_nacionalidad_usuario,caso_bit.doc_identidad_usuario, 

			    pers.nombres, pers.apellidos, pers.fecha_nacimiento, pers.descripcion_genero,
			    nacion.descripcion_nacionalidad,

			    gnro.descripcion_genero

			    FROM casos_epidemi caso

				INNER JOIN casos_epidemi_bitacora casos_bit ON caso.id_caso_epidemi = casos_bit.id_caso_epidemi 

				INNER JOIN personas pers ON caso.doc_identidad = pers.doc_identidad 
				AND caso.id_nacionalidad = pers.id_nacionalidad

				INNER JOIN parroquias parr ON caso.id_parroquia = parr.id_parroquia
				
				INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
				INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad
			    ";

protected static $queryCreateViewCasosEpidemi = "

CREATE OR REPLACE VIEW caso_epidemi_view  AS SELECT DISTINCT ON (caso.id_caso_epidemi) caso.id_caso_epidemi,  ROW_NUMBER() OVER(ORDER BY caso.id_caso_epidemi desc),
 caso.telefono, 
caso.catalog_key_cie10,caso.fecha_registro,caso.direccion,

			    parr.parroquia,
			        
			    casos_bit.id_bitacora, casos_bit.usuario_alias, casos_bit.bitacora_fecha, casos_bit.bitacora_hora, 
				casos_bit.id_nacionalidad_caso,casos_bit.doc_identidad_caso,casos_bit.id_nacionalidad_usuario,
				casos_bit.doc_identidad_usuario,

			    pers.nombres, pers.apellidos, pers.fecha_nacimiento,pers.id_genero,
			    nacion.descripcion_nacionalidad, 

			    gnro.descripcion_genero,

			    cie10.NOMBRE nombre_cie10

			    FROM casos_epidemi caso,casos_epidemi_bitacora casos_bit,personas pers,parroquias parr,generos gnro,
				nacionalidades nacion, usuarios usr, data_cie10 cie10

				WHERE caso.id_caso_epidemi = casos_bit.id_caso_epidemi 
				
				AND  caso.doc_identidad = pers.doc_identidad 
				AND caso.id_nacionalidad = pers.id_nacionalidad 

				AND caso.id_parroquia = parr.id_parroquia 
				
				AND pers.id_genero = gnro.id_genero 
				
				AND pers.id_nacionalidad = nacion.id_nacionalidad

				AND usr.alias = casos_bit.usuario_alias

				AND caso.catalog_key_cie10 = cie10.CATALOG_KEY";


			protected static function addcasosEpidemiModel($dataCasosEpidemi){


/*
			c $queryListcasosEpidemi ="	
				SELECT DISTINCT ON (caso.id_caso_epidemi) caso.id_caso_epidemi,caso.telefono, caso.catalog_key_cie10,caso.id_parroquia,caso.fecha_registro,caso.direccion

				parr.parroquia,
						
				casos_bit.id_bitacora, casos_bit.usuario_alias, casos_bit.bitacora_fecha, casos_bit.bitacora_hora, casos_bit.bitacora_year, 
				casos_bit.id_tipo_operacion, casos_bit.id_caso_epidemi, casos_bit.catalog_key_cie10, casos_bit.id_nacionalidad_caso, 
				casos_bit.doc_identidad_caso, casos_bit.id_nacionalidad_usuario, casos_bit.doc_identidad_usuario,
								
				pers.nombres, pers.apellidos, pers.fecha_nacimiento, pers.id_genero,

				nacion.descripcion_nacionalidad,

				gnro.descripcion_genero
								
								FROM casos_epidemi caso

								INNER JOIN casos_epidemi_bitacora casos_bit ON caso.id_caso_epidemi = casos_bit.id_caso_epidemi 

								INNER JOIN personas pers ON caso.doc_identidad = caso.doc_identidad 
								AND caso.id_nacionalidad = caso.id_nacionalidad

								INNER JOIN parroquias parr ON caso.id_parroquia = caso.id_parroquia
								
								INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
								INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad "
*/

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();


	try {
		//si no existe la persona
	if(isset($dataCasosEpidemi['registerPerson'])){
		// registrar como person
		$sqlQuery  = personModel::stringQueryAddPersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		"id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));

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
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia"=>$dataCasosEpidemi['id_parroquia'],
		 "direccion"=>$dataCasosEpidemi['direccion'],
		 "telefono"=>$dataCasosEpidemi['telefono'],
		 "fecha_registro"=>$dataCasosEpidemi['fecha_registro']));

		$sqlQuery->closeCursor();

		// registrar bitacora
		// 

           $queryGetIdEpidemiCaseToRegister = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM public.casos_epidemi ORDER BY id_caso_epidemi DESC limit 1;");

			$idEpidemiCaseToRegister = $queryGetIdEpidemiCaseToRegister->fetchColumn();


			$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToRegister;

		$sqlQuery = $DB_transacc->prepare("INSERT INTO casos_epidemi_bitacora(
					usuario_alias,
					 bitacora_fecha,
					 bitacora_hora,
					 bitacora_year,
					 id_tipo_operacion, id_caso_epidemi,
					 catalog_key_cie10,
					 id_nacionalidad_caso, 
					 doc_identidad_caso,
					 id_nacionalidad_usuario,
					 doc_identidad_usuario)
				VALUES (:usuario_alias,
				:bitacora_fecha,
				:bitacora_hora,
				:bitacora_year,
				:id_tipo_operacion,
				:id_caso_epidemi,
				:catalog_key_cie10,
				:id_nacionalidad_caso,
				:doc_identidad_caso,
				:id_nacionalidad_usuario,
				:doc_identidad_usuario);");

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>$dataCasosEpidemi['id_tipo_operacion'],
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario'],
		));

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
	
	protected static function updatecasosEpidemiModel($dataCasosEpidemi){
		
		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {
// si no son los mismos datos personales acualizamos
if (!$dataPerson['ifPersonDataUpdateIsSameDatabase']) {
		$sqlQuery  = personModel::stringQueryUpdatePersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		 $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataPerson['id_nacionalidad'],
		 "doc_identidad"=>$dataPerson['doc_identidad'],
		 "nombres"=>$dataPerson['nombres'],
		 "apellidos"=>$dataPerson['apellidos'],
		 "fecha_nacimiento"=>$dataPerson['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataPerson['id_nacionalidad'],
		 "id_genero"=>$dataPerson['id_genero']));

		$sqlQuery->closeCursor();
		}		


		$sqlQuery = "UPDATE casos_epidemi  SET 
		 doc_identidad = :doc_identidad,
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha_registro = :fecha_registro WHERE id_caso_epidemi = :id_caso_epidemi;";

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

			$sqlQuery->execute(array(
		 "id_caso_epidemi" => $dataCasosEpidemi['id_caso_epidemi'],
		 "doc_identidad" => $dataCasosEpidemi['doc_identidad'],
		 "catalog_key_cie10" => $dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia" => $dataCasosEpidemi['id_parroquia'],
		 "direccion" => $dataCasosEpidemi['direccion'],
		 "telefono" => $dataCasosEpidemi['telefono'],
		 "fecha_registro" => $dataCasosEpidemi['fecha_registro']));


		$sqlQuery->closeCursor();

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del Caso Epidemiologico actualizados",
				"Type"=>"success"
			];

		  	$DB_transacc->commit();
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del Caso Epidemiologico <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

			return json_encode($alert);


		}


			protected static function deletecasosEpidemiModel($dataCasosEpidemi){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM casos_epidemi WHERE id_caso_epidemi = :id_caso_epidemi;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi']));

			return $sqlQuery;
		}



	}
