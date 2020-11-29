<?php 
	if ($requestAjax) {
		require_once "../config/server.php";

	} else {
		require_once "./config/server.php";
	}
	

	class mainModel{

	public static $stringQuerydisableForeingDB = "select 'ALTER TABLE DISABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public'";


	public static $stringQueryEnableForeingDB = "select 'ALTER TABLE ENABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';";

	public static $stringQueryDeleteBitacora = "DELETE FROM usuario_bitacora WHERE  usuario_alias = :usuario_alias;";

	function __construct(){
    date_default_timezone_set("America/Caracas");
    	}


		public static function connectDB(){


		try {			

$db = (function(){
    $parts = (parse_url(getenv('DATABASE_URL') ?: 'postgres://ilsmpwdzrresby:7879db47bd3be54c574eab3a81a1bc2db477bc890a756eccc406992832a0fd8e@ec2-54-246-87-132.eu-west-1.compute.amazonaws.com:5432/d4hub5gh1m9jjj'));
    extract($parts);
    $path = ltrim($path, "/");
    return new PDO("pgsql:host={$host};port={$port};dbname={$path}", $user, $pass);
})();

return $db;

		} catch (PDOException $e) {
		    error_log("Failed to connect to database: ".$e->getMessage());
		}				
/*


		try {			
	$DB = new PDO("pgsql:host=".SERVER_PATH.";port=".PORT.";dbname=".DB."",USER,PASS, array(
				PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $DB;

		} catch (PDOException $e) {
		    error_log("Failed to connect to database: ".$e->getMessage());
		}				
/**/
	}

		protected static function runSimpleQuery($stringQuery){

		$requestedSimpleQuery = self::connectDB()->prepare($stringQuery);
		return $requestedSimpleQuery->execute();
	}

		public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

	protected function generateRandomCode($Codeletter,$lenghtCode,$identifierNumber){

	for ($i=1; $i <=$lenghtCode ; $i++) { 
		$numberRandom = rand(0,9);
		$Codeletter.=$numberRandom;
	}
	$RamdonCode = "";
	$RamdonCode.=$Codeletter.$identifierNumber;
	return $RamdonCode;

}

public static function cleanStringSQL($string){

	$string = trim($string);
	$string = stripcslashes($string);
	$string = str_ireplace("<script>","",$string);
	$string = str_ireplace("</script>","",$string);
	$string = str_ireplace("<script src","",$string);
	$string = str_ireplace("<script type =","",$string);
	$string = str_ireplace("SELECT * FROM","",$string);
	$string = str_ireplace("DELETE FROM","",$string);
	$string = str_ireplace("INSERT INTO","",$string);
	$string = str_ireplace("DROP TABLE","",$string);
	$string = str_ireplace("DROP DATABASE","",$string);
	$string = str_ireplace("TRUNCATE TABLE","",$string);
	$string = str_ireplace("SHOW TABLES","",$string);
	$string = str_ireplace("<?php","",$string);
	$string = str_ireplace("?>","",$string);
	$string = str_ireplace("--","",$string);
	$string = str_ireplace("^","",$string);
	$string = str_ireplace("<","",$string);
	$string = str_ireplace(">","",$string);
	$string = str_ireplace("]","",$string);
	$string = str_ireplace("]","",$string);
	$string = str_ireplace("==","",$string);
	$string=str_ireplace("{","",$string);
    $string=str_ireplace("}","",$string);
    $string=str_ireplace("´","",$string);
    $string=str_ireplace("*","",$string);
    $string=str_ireplace(";","",$string);
	$string = stripcslashes($string);
	$string = trim($string);

	return $string;
}


protected static function checkPatterns($pattern,$string){

	if (preg_match("/^".$pattern."$/",$string)) {
		return false;

	} else {
		return true;
		// Si hay errors
	}
}
	

	protected static function checkDate ($date){

		$values = explode("-", $date);

		if (count($values) == 3 && checkdate($values[1],$values[2],$values[0])) {
			return TRUE;
		} else {
			return FALSE;
			// Si hay errors
		}
	}
	

	protected static function dateIsValidAccordingToformat($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
	

	protected static function paginateTables ($currentPage,$nroMaxPages,$linksForButtons,$nroButtons){

		$table = '<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">';

		if ($currentPage == 1) {
			$table.= '
		<li class=" page-item"> <a class="page-link disabled" >  <i class="fas fa-angle-double-left"></i></a>
						</li>';
		} else {
			$table.= '
		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.'1/">  <i class="fas fa-angle-double-left"></i></a>
						</li>

		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.($currentPage-1).'/">Anterior</a>
						</li>';

		}


		$countBotons = 0;

		for ($i=$currentPage; $i <= $nroButtons ; $i++) { 
			if ($countBotons >= $nroButtons ) {
				break;
			}

			if ($currentPage == $i) {
				$table.= '<li class=" page-item"> <a class="page-link active" href = "'.$linksForButtons.$i.'/">'.$i.'<i class="fas fa-angle-double-left"></i></a>
						</li>';
			} else {						}
									
			$countBotons ++;
		}
		
		if ($currentPage == $nroMaxPages) {
			$table.= '
		<li class=" page-item disabled"> <a class="page-link"><i class="fas fa-angle-double-right"></i></a>
						</li>';
		} else {
			$table.= '
		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.($currentPage-1).'/">Anterior</a>
						</li>

		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.$nroMaxPages.'/">  <i class="fas fa-angle-double-right"></i></a>
						</li>';


		}

		$table .= '</ul></nav>';
		return $table;
	}


		public static function isDataEmtpy(...$data){

		foreach ($data as $value) {
		    
		    if(empty($value) || is_null($value) || self::isStringOnlyHasSpaces($value)){        
		        return true;
		    }
		}

		return false;
		}

		public static function isStringOnlyHasSpaces($str){
		        $count_arr=0;
		        $count_str=strlen($str);

		        $arr=str_split($str);

		          foreach ($arr as $pos){

		                if (preg_match_all('/\s/',$pos)) {
		                    $count_arr++;
		                }
		            }
		        if ($count_arr==$count_str)  {
		            return TRUE;
		        }else{
		            return FALSE;
		        }
		}

protected static function disableForeingDB(){

self::runSimpleQuery("select 'ALTER TABLE DISABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';");

}

protected static function enableForeingDB(){
self::runSimpleQuery("select 'ALTER TABLE ENABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';");
}



protected static function isDateGreaterCurrentDate($dateReviewed){
	
	$currentDate =  self::getDateCurrentSystem();
    
    $dateReviewed = strtotime($dateReviewed);
        if($dateReviewed > $currentDate){
            return TRUE;
        }else{
            return FALSE;

        }                   
}

protected static function getDateCurrentSystem(){
      
    date_default_timezone_set("America/Caracas");

     return $currentDate = strtotime(date("Y-m-d H:i:s"));

} 	

protected static function isValidNroTlf(...$nrosTlfs){
    foreach ($nrosTlfs as $nroTlf) {

    if(preg_match("/^[0-9]{11}$/",$nroTlf)){
        return true;
    }
}

return false;
}

// Para caracteres que usuarios usualmente usam para separar en un input
public static function ClearUserSeparatedCharacters($inputString){
    $inputString=preg_replace("/\.|-|\s/", "",$inputString);
   
    return $inputString;
	}


public static function isValidSelectionTwoOptions($idOption){

    if (strcmp($idOption,"1") == 0 || strcmp($idOption,"2") == 0) {
		return TRUE;
	}	
	else FALSE;
}


public static function isTwoValuesEquals($value1,$value2){
    if(strcmp($value1,$value2)){
        return true;
    }else{
        return false;
    }
}


protected static function  isStringInRange($string,$rangeMin,$rangeMax){
    
    if(strlen($string)<$rangeMin or strlen($string)>$rangeMax){
        return false;
    }else{
        return true;
    }
}

// funciones para la bitacora

protected function  addUsuarioBitacora($dataUserBitacora){

	$sqlQuery = self::connectDB()->prepare("INSERT INTO usuario_bitacora(
		usuario_alias
		,bitacora_codigo
		,bitacora_fecha
		,bitacora_hora_inicio
		,bitacora_hora_final
		,bitacora_nivel_usuario
		,bitacora_year) VALUES (
		:usuario_alias, 
		:bitacora_codigo, 
		:bitacora_fecha, 
		:bitacora_hora_inicio, 
		:bitacora_hora_final, 
		:bitacora_nivel_usuario, 
		:bitacora_year)");

			return $sqlQuery->execute(array(
		"usuario_alias"=>$dataUserBitacora['usuario_alias'],
		"bitacora_codigo"=>$dataUserBitacora['bitacora_codigo'],
		"bitacora_fecha"=>$dataUserBitacora['bitacora_fecha'],
		"bitacora_hora_inicio"=>$dataUserBitacora['bitacora_hora_inicio'],
		"bitacora_hora_final"=>$dataUserBitacora['bitacora_hora_final'],
		"bitacora_nivel_usuario"=>$dataUserBitacora['bitacora_nivel_usuario'],
		"bitacora_year"=>$dataUserBitacora['bitacora_year']));

}

protected function updateUsuarioBitacora($dataUserBitacora){

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {

$sqlQuery = $DB_transacc->prepare("UPDATE usuario_bitacora SET 
		bitacora_hora_final=:bitacora_hora_final WHERE bitacora_codigo = :bitacora_codigo");

			$sqlQuery->execute(array(
		"bitacora_hora_final"=>$dataUserBitacora['bitacora_hora_final'],
		"bitacora_codigo"=>$dataUserBitacora['bitacora_codigo']));

		$sqlQuery->closeCursor();

			$DB_transacc->commit();

				$alert=[
				"Alert"=>"simpleReload",
				];

				session_unset();
				session_destroy();
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"No se pudo cerrar la sesion en el sistema <br>
					Error".$e->getMessage()."",
					"Type"=>"error"

				];

		}

		 return json_encode($alert);

	}	



protected static function deleteBitacora($usuario_alias){

	self::disableForeingDB();
 	
 	$sqlQuery = self::connectDB()->prepare(self::$stringQueryDeleteBitacora); 
	
	$resultQuery = $sqlQuery->execute(array("usuario_alias"=>$usuario_alias));

	self::enableForeingDB();

	return $resultQuery;
}
	
// Comrpueba que un conjuntos de campos enviados tienen los mismo valores a los registrados en la base de datos

protected static function isFieldsEqualToThoseInTheDatabase($queryToGet,$fieldstoCompare){

		$matchCounterFieldsToCompare = count($fieldstoCompare);

 		$queryToGet->execute();

		$records = $queryToGet->fetch(PDO::FETCH_BOTH);

 		$matchCounterDatabaseFields = 0;
		 
		foreach ($fieldstoCompare as $keyToCompare => $valueToCompare) {

 		foreach ($records as $databaseKey => $databaseValue) {
			if (strcmp($databaseKey,$keyToCompare)==0) {
				if (strcmp($databaseValue,$valueToCompare)==0) {
				$matchCounterDatabaseFields++;
				}
			
			}

			}
		}

		if ($matchCounterFieldsToCompare == $matchCounterDatabaseFields) {
			return true;
			}
			
			return false;
		}

	protected static function getDataTableServerSideModel($table, $index_column, $columnsTable,$columnsPrintDataTable='',$ifPersonalizedPrint=false) {


		if (empty($columnsPrintDataTable)) {
			$columnsPrintDataTable = $columnsTable;

		}

		// Paging
    /*
     * Script:    DataTables server-side script for PHP and PostgreSQL
     * Copyright: 2010 - Allan Jardine
     * License:   GPL v2 or BSD (3-point)
     */
     
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
     
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
    $aColumns = $columnsTable;
     
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = $index_column;
     
    /* DB table to use */
    $sTable = $table;

    /* Database connection information */
    $gaSql['user']       = USER;
    $gaSql['password']   = PASS;
    $gaSql['db']         = DB;
    $gaSql['server']     = SERVER_PATH;
  
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
     
    /*
     * DB connection
     

    $gaSql['link'] = pg_connect(
        " host=".$gaSql['server'].
        " dbname=".$gaSql['db'].
        " user=".$gaSql['user'].
        " password=".$gaSql['password']
    ) or die('Could not connect: ' . pg_last_error());


/**/

 $db_url = getenv("DATABASE_URL") ?: "postgres://ilsmpwdzrresby:7879db47bd3be54c574eab3a81a1bc2db477bc890a756eccc406992832a0fd8e@ec2-54-246-87-132.eu-west-1.compute.amazonaws.com:5432/d4hub5gh1m9jjj";

$gaSql['link'] = pg_connect($db_url);
     
    /*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayLength'] )." OFFSET ".
            intval( $_GET['iDisplayStart'] );
    }
     
     
    /*
     * Ordering
     */
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc').", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
     
     
    /*
     * Filtering
     * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
     * on which ILIKE can be used). Boolean fields etc will need a modification here.
     */
    $sWhere = "";
    if ( $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($columnsPrintDataTable) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= $columnsPrintDataTable[$i]."::text ILIKE '%".pg_escape_string( $_GET['sSearch'] )."%' OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ")";
    }
     

    /* Individual column filtering */
    for ( $i=0 ; $i<count($columnsPrintDataTable) ; $i++ )
    {
        if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
        {
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .= $columnsPrintDataTable[$i]." ILIKE '%".pg_escape_string($_GET['sSearch_'.$i])."%' ";
        }
    }

     
    if (!empty($_GET['minDateRange']) AND !empty($_GET['maxDateRange']) ) {

     $minDateRange = mainModel::cleanStringSQL($_GET['minDateRange']);

     $maxDateRange = mainModel::cleanStringSQL($_GET['maxDateRange']);

     $nameDateFieldDB = mainModel::cleanStringSQL($_GET['nameDateFieldDB']);

            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
      $sWhere.= $nameDateFieldDB." BETWEEN '$minDateRange' AND '$maxDateRange'";      
       }

          // Script para solictar la data del CIE10 por capitulos
 	if (isset($_GET['idCapitulo'] ) && !self::isDataEmtpy($_GET['idCapitulo'] )) {
      		$idCapitulo = self::cleanStringSQL($_GET['idCapitulo']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" CLAVE_CAPITULO = '$idCapitulo' ";    	
		}

		// para paginar en base a un usuario especifico

 	if (isset($_GET['requestedAliasUser']) && !self::isDataEmtpy($_GET['requestedAliasUser'] )) {
      		$requestedAliasUser = self::cleanStringSQL($_GET['requestedAliasUser']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" alias = '$requestedAliasUser' ";    	
		}

 	if (isset($_GET['requestedPersonEpidemi']) && !self::isDataEmtpy($_GET['requestedPersonEpidemi'])) {
      		$requestedPersonEpidemi = self::cleanStringSQL($_GET['requestedPersonEpidemi']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" alias = '$requestedPersonEpidemi' ";    	
		}

     
    $sQuery = "
        SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";

    $rResult = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
     
    $sQuery = "
        SELECT $sIndexColumn
        FROM   $sTable
    ";
    $rResultTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
    $iTotal = pg_num_rows($rResultTotal);
    pg_free_result( $rResultTotal );
     
    if ( $sWhere != "" )
    {
        $sQuery = "
            SELECT $sIndexColumn
            FROM   $sTable
            $sWhere
        ";

        $rResultFilterTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
        $iFilteredTotal = pg_num_rows($rResultFilterTotal);
        pg_free_result( $rResultFilterTotal );
    }
    else
    {
        $iFilteredTotal = $iTotal;
    }

    // solo retronaremos los valores si queremos armar una impresion personalizada
    if ($ifPersonalizedPrint) {
		    return $output = array(
		        "sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => array(),
		        "sTable" => $sTable,
		        "sWhere" => $sWhere,
		        "sOrder" => $sOrder,
		        "sLimit" => $sLimit,

		    );
     } 



    /*
     * Output
     */
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
     
    while ( $aRow = pg_fetch_array($rResult, null, PGSQL_ASSOC) )
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $aColumns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
            }
            else if ( $aColumns[$i] != ' ' )
            {
                /* General output */
                $row[] = $aRow[ $aColumns[$i] ];
            }
        }
        $output['aaData'][] = $row;
    }

    echo json_encode( $output );
     
    // Free resultset
    pg_free_result( $rResult );
     
    // Closing connection
    pg_close( $gaSql['link'] );

    	}


    	public static function arrayInsert($array,$arrayInsert,$pos){
            $arrayResult = array_merge(
            array_slice($array, 0, $pos),
            $arrayInsert,
            array_slice($array, $pos));
            
            return $arrayResult;
		}


}
