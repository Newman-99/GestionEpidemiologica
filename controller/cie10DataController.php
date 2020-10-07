
<?php 
		$requestAjax =  TRUE;

	if($requestAjax){
		require_once "../model/mainModel.php";
	}else{
		require_once "./model/mainModel.php";
	}


class cie10DataController extends mainModel
{



	public function updateCie10DataController($files){
			
			ini_set('memory_limit','512M');

if ($files['fileCSVCIE10']['type'] !='text/csv' || mainModel::isDataEmtpy($files['fileCSVCIE10']['size'])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo es invalido o esta vacio <br> debe poseer la extension .CSV",
					"Type"=>"error"
				];	

				echo json_encode($alert);

				exit();
	}


if ($files['fileCSVCIE10']['size'] >20000000){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo no puede ser mayor a 20 Megabytes(MB)",
					"Type"=>"error"
				];	

				echo json_encode($alert);

				exit();
	}



// Se llamara la libreria para procesar e insetrar los valores del .csv


require_once "../view/inc/spout.php";

$filePath = $files['fileCSVCIE10']['tmp_name'];

$reader = $ReaderEntityFactory::createCSVReader();

$reader->open($filePath);


// se recolectan los valores del CSV
 
    $count = 0;

    $dataForQuery = array();

    foreach ($reader->getSheetIterator() as $sheet) {   
        foreach ($sheet->getRowIterator() as $row) {

			foreach($row->getCells() as $key => $cell){
			
			$ceilUTF8=utf8_encode($cell);
				
			$dataForQuery[$count][$key]=$ceilUTF8;

			        }
			  $count++;
			}   
    }


// iniciamos la transaccion sql

$DB_transacc = mainModel::connectDB();

$DB_transacc->beginTransaction();

try {

$DB_transacc->query(mainModel::$stringQuerydisableForeingDB);

$queryDeleteAll = $DB_transacc->prepare('DELETE FROM data_cie10;');

$queryDeleteAll->execute();

$queryDeleteAll->closeCursor();

$sqlQuery = $DB_transacc->prepare("INSERT INTO data_cie10(CONSECUTIVO,
 LETRA,
 CATALOG_KEY,
 NOMBRE,
 CODIGOX,
 LSEX,
 LINF,
 LSUP,
 TRIVIAL,
 ERRADICADO,
 N_INTER,
 NIN,
 NINMTOBS,
 COD_SIT_LESION,
 NO_CBD,
 CBD,
 NO_APH,
 AF_PRIN,
 DIA_SIS,
 CLAVE_PROGRAMA_SIS,
 COD_COMPLEMEN_MORBI,
 DEF_FETAL_CM,
 DEF_FETAL_CBD,
 CLAVE_CAPITULO,
 CAPITULO,
 LISTA1,
 GRUPO1,
 LISTA5,
 RUBRICA_TYPE,
 YEAR_MODIFI,
 YEAR_APLICACION,
 VALID,
 PRINMORTA,
 PRINMORBI,
 LM_MORBI,
 LM_MORTA,
 LGBD165,
 LOMSBECK,
 LGBD190,
 NOTDIARIA,
 NOTSEMANAL,
 SISTEMA_ESPECIAL,
 BIRMM,
 CVE_CAUSA_TYPE,
 CAUSA_TYPE,
 EPI_MORTA,
 EDAS_E_IRAS_EN_M5,
 CSVE_MATERNAS_SEED_EPID,
 EPI_MORTA_M5,
 EPI_MORBI,
 DEF_MATERNAS,
 ES_CAUSES,
 NUM_CAUSES,
 ES_SUIVE_MORTA,
 ES_SUIVE_MORB,
 EPI_CLAVE,
 EPI_CLAVE_DESC,
 ES_SUIVE_NOTIN,
 ES_SUIVE_EST_EPI,
 ES_SUIVE_EST_BROTE,
 SINAC,
 PRIN_SINAC,
 PRIN_SINAC_GRUPO,
 DESCRIPCION_SINAC_GRUPO,
 PRIN_SINAC_SUBGRUPO,
 DESCRIPCION_SINAC_SUBGRUPO,
 DAGA,
 ASTERISCO) VALUES (
:CONSECUTIVO,
:LETRA,
:CATALOG_KEY,
:NOMBRE,
:CODIGOX,
:LSEX,
:LINF,
:LSUP,
:TRIVIAL,
:ERRADICADO,
:N_INTER,
:NIN,
:NINMTOBS,
:COD_SIT_LESION,
:NO_CBD,
:CBD,
:NO_APH,
:AF_PRIN,
:DIA_SIS,
:CLAVE_PROGRAMA_SIS,
:COD_COMPLEMEN_MORBI,
:DEF_FETAL_CM,
:DEF_FETAL_CBD,
:CLAVE_CAPITULO,
:CAPITULO,
:LISTA1,
:GRUPO1,
:LISTA5,
:RUBRICA_TYPE,
:YEAR_MODIFI,
:YEAR_APLICACION,
:VALID,
:PRINMORTA,
:PRINMORBI,
:LM_MORBI,
:LM_MORTA,
:LGBD165,
:LOMSBECK,
:LGBD190,
:NOTDIARIA,
:NOTSEMANAL,
:SISTEMA_ESPECIAL,
:BIRMM,
:CVE_CAUSA_TYPE,
:CAUSA_TYPE,
:EPI_MORTA,
:EDAS_E_IRAS_EN_M5,
:CSVE_MATERNAS_SEED_EPID,
:EPI_MORTA_M5,
:EPI_MORBI,
:DEF_MATERNAS,
:ES_CAUSES,
:NUM_CAUSES,
:ES_SUIVE_MORTA,
:ES_SUIVE_MORB,
:EPI_CLAVE,
:EPI_CLAVE_DESC,
:ES_SUIVE_NOTIN,
:ES_SUIVE_EST_EPI,
:ES_SUIVE_EST_BROTE,
:SINAC,
:PRIN_SINAC,
:PRIN_SINAC_GRUPO,
:DESCRIPCION_SINAC_GRUPO,
:PRIN_SINAC_SUBGRUPO,
:DESCRIPCION_SINAC_SUBGRUPO,
:DAGA,
:ASTERISCO);");


for ($indiceFila = 1; $indiceFila < count($dataForQuery); $indiceFila++) {

$CONSECUTIVO = $dataForQuery[$indiceFila][0]; 
$LETRA = $dataForQuery[$indiceFila][1]; 
$CATALOG_KEY = $dataForQuery[$indiceFila][2]; 
$NOMBRE = $dataForQuery[$indiceFila][3]; 
$CODIGOX = $dataForQuery[$indiceFila][4]; 
$LSEX = $dataForQuery[$indiceFila][5]; 
$LINF = $dataForQuery[$indiceFila][6]; 
$LSUP = $dataForQuery[$indiceFila][7]; 
$TRIVIAL = $dataForQuery[$indiceFila][8]; 
$ERRADICADO = $dataForQuery[$indiceFila][9]; 
$N_INTER = $dataForQuery[$indiceFila][10]; 
$NIN = $dataForQuery[$indiceFila][11]; 
$NINMTOBS = $dataForQuery[$indiceFila][12]; 
$COD_SIT_LESION = $dataForQuery[$indiceFila][13]; 
$NO_CBD = $dataForQuery[$indiceFila][14]; 
$CBD = $dataForQuery[$indiceFila][15]; 
$NO_APH = $dataForQuery[$indiceFila][16]; 
$AF_PRIN = $dataForQuery[$indiceFila][17]; 
$DIA_SIS = $dataForQuery[$indiceFila][18]; 
$CLAVE_PROGRAMA_SIS = $dataForQuery[$indiceFila][19]; 
$COD_COMPLEMEN_MORBI = $dataForQuery[$indiceFila][20]; 
$DEF_FETAL_CM = $dataForQuery[$indiceFila][21]; 
$DEF_FETAL_CBD = $dataForQuery[$indiceFila][22]; 
$CLAVE_CAPITULO = $dataForQuery[$indiceFila][23]; 
$CAPITULO = $dataForQuery[$indiceFila][24]; 
$LISTA1 = $dataForQuery[$indiceFila][25]; 
$GRUPO1 = $dataForQuery[$indiceFila][26]; 
$LISTA5 = $dataForQuery[$indiceFila][27]; 
$RUBRICA_TYPE = $dataForQuery[$indiceFila][28]; 
$YEAR_MODIFI = $dataForQuery[$indiceFila][29]; 
$YEAR_APLICACION = $dataForQuery[$indiceFila][30]; 
$VALID = $dataForQuery[$indiceFila][31]; 
$PRINMORTA = $dataForQuery[$indiceFila][32]; 
$PRINMORBI = $dataForQuery[$indiceFila][33]; 
$LM_MORBI = $dataForQuery[$indiceFila][34]; 
$LM_MORTA = $dataForQuery[$indiceFila][35]; 
$LGBD165 = $dataForQuery[$indiceFila][36]; 
$LOMSBECK = $dataForQuery[$indiceFila][37]; 
$LGBD190 = $dataForQuery[$indiceFila][38]; 
$NOTDIARIA = $dataForQuery[$indiceFila][39]; 
$NOTSEMANAL = $dataForQuery[$indiceFila][40]; 
$SISTEMA_ESPECIAL = $dataForQuery[$indiceFila][41]; 
$BIRMM = $dataForQuery[$indiceFila][42]; 
$CVE_CAUSA_TYPE = $dataForQuery[$indiceFila][43]; 
$CAUSA_TYPE = $dataForQuery[$indiceFila][44]; 
$EPI_MORTA = $dataForQuery[$indiceFila][45]; 
$EDAS_E_IRAS_EN_M5 = $dataForQuery[$indiceFila][46]; 
$CSVE_MATERNAS_SEED_EPID = $dataForQuery[$indiceFila][47]; 
$EPI_MORTA_M5 = $dataForQuery[$indiceFila][48]; 
$EPI_MORBI = $dataForQuery[$indiceFila][49]; 
$DEF_MATERNAS = $dataForQuery[$indiceFila][50]; 
$ES_CAUSES = $dataForQuery[$indiceFila][51]; 
$NUM_CAUSES = $dataForQuery[$indiceFila][52]; 
$ES_SUIVE_MORTA = $dataForQuery[$indiceFila][53]; 
$ES_SUIVE_MORB = $dataForQuery[$indiceFila][54]; 
$EPI_CLAVE = $dataForQuery[$indiceFila][55]; 
$EPI_CLAVE_DESC = $dataForQuery[$indiceFila][56]; 
$ES_SUIVE_NOTIN = $dataForQuery[$indiceFila][57]; 
$ES_SUIVE_EST_EPI = $dataForQuery[$indiceFila][58]; 
$ES_SUIVE_EST_BROTE = $dataForQuery[$indiceFila][59]; 
$SINAC = $dataForQuery[$indiceFila][60]; 
$PRIN_SINAC = $dataForQuery[$indiceFila][61]; 
$PRIN_SINAC_GRUPO = $dataForQuery[$indiceFila][62]; 
$DESCRIPCION_SINAC_GRUPO = $dataForQuery[$indiceFila][63]; 
$PRIN_SINAC_SUBGRUPO = $dataForQuery[$indiceFila][64]; 
$DESCRIPCION_SINAC_SUBGRUPO = $dataForQuery[$indiceFila][65]; 
$DAGA = $dataForQuery[$indiceFila][66]; 
$ASTERISCO = $dataForQuery[$indiceFila][67];


$sqlQuery->execute(array("CONSECUTIVO"=>$CONSECUTIVO,
"LETRA"=>$LETRA, 
"CATALOG_KEY"=>$CATALOG_KEY, 
"NOMBRE"=>$NOMBRE, 
"CODIGOX"=>$CODIGOX, 
"LSEX"=>$LSEX, 
"LINF"=>$LINF, 
"LSUP"=>$LSUP, 
"TRIVIAL"=>$TRIVIAL, 
"ERRADICADO"=>$ERRADICADO, 
"N_INTER"=>$N_INTER, 
"NIN"=>$NIN, 
"NINMTOBS"=>$NINMTOBS, 
"COD_SIT_LESION"=>$COD_SIT_LESION, 
"NO_CBD"=>$NO_CBD, 
"CBD"=>$CBD, 
"NO_APH"=>$NO_APH, 
"AF_PRIN"=>$AF_PRIN, 
"DIA_SIS"=>$DIA_SIS, 
"CLAVE_PROGRAMA_SIS"=>$CLAVE_PROGRAMA_SIS, 
"COD_COMPLEMEN_MORBI"=>$COD_COMPLEMEN_MORBI, 
"DEF_FETAL_CM"=>$DEF_FETAL_CM, 
"DEF_FETAL_CBD"=>$DEF_FETAL_CBD, 
"CLAVE_CAPITULO"=>$CLAVE_CAPITULO, 
"CAPITULO"=>$CAPITULO, 
"LISTA1"=>$LISTA1, 
"GRUPO1"=>$GRUPO1, 
"LISTA5"=>$LISTA5, 
"RUBRICA_TYPE"=>$RUBRICA_TYPE, 
"YEAR_MODIFI"=>$YEAR_MODIFI, 
"YEAR_APLICACION"=>$YEAR_APLICACION, 
"VALID"=>$VALID, 
"PRINMORTA"=>$PRINMORTA, 
"PRINMORBI"=>$PRINMORBI, 
"LM_MORBI"=>$LM_MORBI, 
"LM_MORTA"=>$LM_MORTA, 
"LGBD165"=>$LGBD165, 
"LOMSBECK"=>$LOMSBECK, 
"LGBD190"=>$LGBD190, 
"NOTDIARIA"=>$NOTDIARIA, 
"NOTSEMANAL"=>$NOTSEMANAL, 
"SISTEMA_ESPECIAL"=>$SISTEMA_ESPECIAL, 
"BIRMM"=>$BIRMM, 
"CVE_CAUSA_TYPE"=>$CVE_CAUSA_TYPE, 
"CAUSA_TYPE"=>$CAUSA_TYPE, 
"EPI_MORTA"=>$EPI_MORTA, 
"EDAS_E_IRAS_EN_M5"=>$EDAS_E_IRAS_EN_M5, 
"CSVE_MATERNAS_SEED_EPID"=>$CSVE_MATERNAS_SEED_EPID, 
"EPI_MORTA_M5"=>$EPI_MORTA_M5, 
"EPI_MORBI"=>$EPI_MORBI, 
"DEF_MATERNAS"=>$DEF_MATERNAS, 
"ES_CAUSES"=>$ES_CAUSES, 
"NUM_CAUSES"=>$NUM_CAUSES, 
"ES_SUIVE_MORTA"=>$ES_SUIVE_MORTA, 
"ES_SUIVE_MORB"=>$ES_SUIVE_MORB, 
"EPI_CLAVE"=>$EPI_CLAVE, 
"EPI_CLAVE_DESC"=>$EPI_CLAVE_DESC, 
"ES_SUIVE_NOTIN"=>$ES_SUIVE_NOTIN, 
"ES_SUIVE_EST_EPI"=>$ES_SUIVE_EST_EPI, 
"ES_SUIVE_EST_BROTE"=>$ES_SUIVE_EST_BROTE, 
"SINAC"=>$SINAC, 
"PRIN_SINAC"=>$PRIN_SINAC, 
"PRIN_SINAC_GRUPO"=>$PRIN_SINAC_GRUPO, 
"DESCRIPCION_SINAC_GRUPO"=>$DESCRIPCION_SINAC_GRUPO, 
"PRIN_SINAC_SUBGRUPO"=>$PRIN_SINAC_SUBGRUPO, 
"DESCRIPCION_SINAC_SUBGRUPO"=>$DESCRIPCION_SINAC_SUBGRUPO, 
"DAGA"=>$DAGA, 
"ASTERISCO"=>$ASTERISCO));

}

$sqlQuery->closeCursor();

		$DB_transacc->query(mainModel::$stringQueryEnableForeingDB);

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Catalogo CIE-10 Actualizado",
				"Type"=>"success"
			];


    $DB_transacc->commit();


}catch (Exception $e) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la Actualizacion del Catalogo CIE-10 <br> Error: ". $e->getMessage()."",
				"Type"=>"error"
			];

    $DB_transacc->rollBack();

}

				echo json_encode($alert);

}

	public static function paginatecie10DataController(){

mainModel::getTableData('data_cie10', 'consecutivo',
	array('consecutivo',
'letra',
'catalog_key',
'nombre',
'codigox',
'lsex',
'linf',
'lsup',
'trivial',
'erradicado',
'n_inter', 
'nin', 
'ninmtobs', 
'cod_sit_lesion', 
'no_cbd', 
'cbd', 
'no_aph', 
'af_prin', 
'dia_sis', 
'clave_programa_sis', 
'cod_complemen_morbi', 
'def_fetal_cm', 
'def_fetal_cbd', 
'clave_capitulo', 
'capitulo', 
'lista1', 
'grupo1', 
'lista5', 
'rubrica_type', 
'year_modifi', 
'year_aplicacion', 
'valid', 
'prinmorta', 
'prinmorbi', 
'lm_morbi', 
'lm_morta', 
'lgbd165', 
'lomsbeck', 
'lgbd190', 
'notdiaria', 
'notsemanal', 
'sistema_especial', 
'birmm', 
'cve_causa_type', 
'causa_type', 
'epi_morta', 
'edas_e_iras_en_m5', 
'csve_maternas_seed_epid', 
'epi_morta_m5', 
'epi_morbi', 
'def_maternas', 
'es_causes', 
'num_causes', 
'es_suive_morta', 
'es_suive_morb', 
'epi_clave', 
'epi_clave_desc', 
'es_suive_notin', 
'es_suive_est_epi', 
'es_suive_est_brote', 
'sinac', 
'prin_sinac', 
'prin_sinac_grupo', 
'descripcion_sinac_grupo', 
'prin_sinac_subgrupo', 
'descripcion_sinac_subgrupo', 
'daga', 
'asterisco'));

	}

	// funcion para mostrar datos en el select dinamico y buscador del cie-10
	public static function getCasesCIE10($dataGetCIE10){
	$queryGetCasesCie10 = "SELECT catalog_key,nombre FROM data_cie10";

	$idCapituloCIE10 = mainModel::cleanStringSQL($dataGetCIE10['idCapituloCIE10']);

	if(isset($dataGetCIE10['searchByChapter'])) {

		// todos los captulos


		$queryGetCasesCie10 = mainModel::connectDB()->prepare($queryGetCasesCie10." WHERE clave_capitulo = '$idCapituloCIE10'");
		
		 $queryGetCasesCie10->execute();

		$dataJsonCasesCIE10=[];

		 if (!$queryGetCasesCie10->rowCount()) {
			$dataJsonCasesCIE10[] = array('nombre' =>'Casos epidemologicos no encontrados','catalog_key'=>'');

		echo json_encode($dataJsonCasesCIE10);
		exit();

		 }

		while($recordsCasesCie10=$queryGetCasesCie10->fetch(PDO
			::FETCH_ASSOC)){ 

			$dataJsonCasesCIE10[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonCasesCIE10);
		exit();
	}


	if(isset($dataGetCIE10['valueSearch'])) {

	$columnsSearch = array('catalog_key','nombre');

		// buscar patron en las columnas

        $where = "WHERE (";
        for ( $i=0 ; $i<count($columnsSearch) ; $i++ )
        {
                $where .= 'UNACCENT('.$columnsSearch[$i]."::text) ILIKE '%".mainModel::cleanStringSQL($dataGetCIE10['valueSearch'])."%' OR ";
        }
        $where = substr_replace( $where, "", -3 );
        $where .= ")";
	
		// si ha selecionado un capitulo
	 	if (!mainModel::isDataEmtpy($idCapituloCIE10)) {
                $where .= " AND ";

				$where.=" clave_capitulo = '$idCapituloCIE10' ";    	
		}

	// armar query


	$querySearchPatternCIE10 = "
        SELECT ".str_replace(" , ", " ", implode(", ",$columnsSearch))."
        FROM   data_cie10
        $where";

		$querySearchPatternCIE10 = mainModel::connectDB()->prepare($querySearchPatternCIE10);
		
		 $querySearchPatternCIE10->execute();
	
			$dataJsonCasesCIE10=[];
			
			// verficar resultado query
		 if (!$querySearchPatternCIE10->rowCount()) {

			$dataJsonCasesCIE10[] = array('nombre' =>'Casos epidemologicos no encontrados','catalog_key'=>'');

		echo json_encode($dataJsonCasesCIE10);
		exit();

		 }

		 // recoger data de la query
		 
		while($recordsCasesCie10=$querySearchPatternCIE10->fetch(PDO::FETCH_ASSOC)){ 

			$dataJsonCasesCIE10[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonCasesCIE10);
		exit();
	}

	}
}
 ?>