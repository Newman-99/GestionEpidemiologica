<?php  

/*

        $requestAjax =  false;


    require_once "./config/app.php";


    require_once "./controller/reportsEpiController.php";


  
      $dataEpi['minDateRange'] = '01-02-2020';

      $dataEpi['endDateRange'] = '21-04-2021';

            $reportsEpiController = new reportsEpiController();

//echo $reportsEpiController->getNroCasesEpidemiForEpiModel('','2021-04-20', '2021-04-19','','','');

            $reportsEpiController->getDataTablesEPIController($dataEpi);;

            exit();


    $queryGet = $loginController::connectDB()->query('select consecutivo_cie10,id_caso_epidemi,catalog_key_cie10
      FROM casos_epidemi');
    
    while($casos_epidemi=$queryGet->fetch(PDO
      ::FETCH_ASSOC)){

//       $queryGetCatalogKey = $loginController::connectDB()->query("SELECT catalog_key_cie10 from casos_epidemi where id_caso_epidemi = '".$casos_epidemi["id_caso_epidemi"]."' LIMIT 1");

       $queryGetCatalogKey = $loginController::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$casos_epidemi["catalog_key_cie10"]."' LIMIT 1");

      $consecutivoCIE10 = $queryGetCatalogKey->fetchColumn();

      $id_caso_epidemi = $casos_epidemi["id_caso_epidemi"];

       $insertConsecutivoInAgrupacionEpi = "UPDATE casos_epidemi
                SET consecutivo_cie10 = '$consecutivoCIE10'
                WHERE id_caso_epidemi = $id_caso_epidemi";

      $loginController::connectDB()->query($insertConsecutivoInAgrupacionEpi);
  }

exit();

    $queryGetAgrupacionEPI = $loginController::connectDB()->query('select enfermedad_evento_epi, key_cie10_Inicio, key_cie10_final, id_agrupacion 
      FROM agrupacion_epi');
    
    while($agrupacion_epi=$queryGetAgrupacionEPI->fetch(PDO
      ::FETCH_ASSOC)){


       $queryGetConsecutivoInicioCIE10 = $loginController::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$agrupacion_epi["key_cie10_inicio"]."' LIMIT 1");

       $queryGetConsecutivoFinalCIE10 = $loginController::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$agrupacion_epi["key_cie10_final"]."' LIMIT 1");


      $consecutivoInicioCIE10 = $queryGetConsecutivoInicioCIE10->fetchColumn();

      $consecutivoFinalCIE10 = $queryGetConsecutivoFinalCIE10->fetchColumn();

      $id_agrupacion = $agrupacion_epi["id_agrupacion"];

       $insertConsecutivoInAgrupacionEpi = "UPDATE agrupacion_epi
                SET consecutivo_cie10_inicio = '$consecutivoInicioCIE10', consecutivo_cie10_final = 
                '$consecutivoFinalCIE10'
                WHERE id_agrupacion = $id_agrupacion";

      $loginController::connectDB()->query($insertConsecutivoInAgrupacionEpi);
    }

exit();


/*
       $queryGetConsecutivoOfCatalogKey = mainModel::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$$agrupacion_epi["enfermedad_evento_epi"]."' LIMIT 1");

      $consecutivoCIE10 = $queryGetConsecutivoOfCatalogKey->fetchColumn();
*/

//libxml_disable_entity_loader(false); ?>
<?php




        $requestAjax =  false;


    require_once "./config/app.php";


    require_once "./controller/cie10DataController.php";

            $cie10DataController = new cie10DataController();


    require_once "./controller/casosEpidemiController.php";
    

            $casosEpidemiController = new casosEpidemiController();


  $queryGetCasesCie10 = "SELECT catalog_key FROM data_cie10";

    // obtnener data por captulos


    $queryGetCasesCie10 = $casosEpidemiController->connectDB()->query($queryGetCasesCie10."");



    while($recordsCasesCie10=$queryGetCasesCie10->fetch(PDO
      ::FETCH_NUM)){ 

      $cie10[] = $recordsCasesCie10[0];
    }


/*
$cie10 = ["A00", 
"A000", 
"A001", 
"A009", 
"A01", 
"A010", 
"A011", 
"A012", 
"A013", 
"A014",
"A02"];
*/

/*

$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"12394859",
  "nombres"=> "Fernanda Leticia",
  "apellidos"=>"Alvarado Sanchez",
  "fecha_nacimiento"=> "1982-08-02",
  "id_genero"=>"2",
  "telefono"=> "04140495639",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"650",
  "direccion"=> "Calle 22 casa 133",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "11:38:31 am",
  "id_tipo_operacion"=>"1"];



$dataCasosEpidemi = 
  ["id_nacionalidad"=>"2",
  "doc_identidad"=>"10304251",
  "nombres"=> "Maria Elena",
  "apellidos"=>"Sanchez Ramirez",
  "fecha_nacimiento"=> "2017-08-02",
  "id_genero"=>"2",
  "telefono"=> "04242495339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"1118",
  "direccion"=> "Calle Miranda Edif 33 apto 120",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-21",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "11:38:31 am",
  "id_tipo_operacion"=>"1"];
*/
$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"12304251",
  "nombres"=> "Tony Jose",
  "apellidos"=>"Fergunson Ramirez",
  "fecha_nacimiento"=> "1990-08-02",
  "id_genero"=>"2",
  "telefono"=> "04242495339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"1118",
  "direccion"=> "Calle Miranda Edif 33 apto 120",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "9:31:01 am",
  "id_tipo_operacion"=>"1"];

$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"20304251",
  "nombres"=> "Rosa Maria",
  "apellidos"=>"Namajunas Morales",
  "fecha_nacimiento"=> "1998-02-02",
  "id_genero"=>"2",
  "telefono"=> "04142423339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"651",
  "direccion"=> "Calle 12 Casa 120",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "10:31:01 am",
  "id_tipo_operacion"=>"1"];


$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"20304251",
  "nombres"=> "Frederica Miranda",
  "apellidos"=>"Rosal Guerra",
  "fecha_nacimiento"=> "2010-02-02",
  "id_genero"=>"2",
  "telefono"=> "02393422339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"612",
  "direccion"=> "Calle 21 Casa 201",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "10:31:01 am",
  "id_tipo_operacion"=>"1"];
  

$dataCasosEpidemi = 
  ["id_nacionalidad"=>"2",
  "doc_identidad"=>"38328032",
  "nombres"=> "Johana Prill",
  "apellidos"=>"Sheckenco Numagedov",
  "fecha_nacimiento"=> "1980-02-02",
  "id_genero"=>"2",
  "telefono"=> "02393422339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"612",
  "direccion"=> "Calle 21 Edif 12 Apto 221",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "10:31:01 am",
  "id_tipo_operacion"=>"1"];
  


$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"28328032",
  "nombres"=> "Andres Eduardo",
  "apellidos"=>"Morales Villabuena",
  "fecha_nacimiento"=> "2009-02-02",
  "id_genero"=>"1",
  "telefono"=> "04123431339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"612",
  "direccion"=> "Calle 212 casa 121",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "10:31:01 am",
  "id_tipo_operacion"=>"1"];
  

$dataCasosEpidemi = 
  ["id_nacionalidad"=>"1",
  "doc_identidad"=>"3328032",
  "nombres"=> "Carlos Eduardo",
  "apellidos"=>"Prada Villabuena",
  "fecha_nacimiento"=> "1950-02-02",
  "id_genero"=>"1",
  "telefono"=> "0416322339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"612",
  "direccion"=> "Calle Miranda casa 121",
  "ifExistPerson"=>0,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_person_usuario"=>67,
  "usuario_alias"=>"newman207",
  "bitacora_fecha"=> "2021-04-28",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "10:31:01 am",
  "id_tipo_operacion"=>"1"];

    $count = 0;

for ($nroRegister=0; $nroRegister < 15000; $nroRegister++) { 


$date_now = date('d-m-Y');

$dayToRegister = mt_rand(0, 365);

$dateRegister = strtotime("-$dayToRegister day", strtotime($date_now));

$dateRegister = date('Y-m-d', $dateRegister);



$selectCIE10 = mt_rand(0,14000);

$select_is_hospital = mt_rand(0,1);

$select_id_tipo_entrada = mt_rand(1,2);

  $dataCasosEpidemi["is_hospital"]=$select_is_hospital;

  $dataCasosEpidemi["id_tipo_entrada"]=$select_id_tipo_entrada;
    if ($cie10[$selectCIE10] == 'A08' || $cie10[$selectCIE10] == 'A09') {
      $dataCasosEpidemi["id_atrib_especial"]=mt_rand(1,2);
      
    }

if ($nroRegister > 0) {
  $dataCasosEpidemi["ifExistPerson"]=1;
    $dataCasosEpidemi['id_person'] = $casosEpidemiController::$personController->getIdPerson($dataCasosEpidemi['id_nacionalidad'],$dataCasosEpidemi['doc_identidad']);
}

  $dataCasosEpidemi["fecha_registro"]=$dateRegister;

  $dataCasosEpidemi["catalog_key_cie10"]=$cie10[$selectCIE10];

  $dataCasosEpidemi["consecutivo_cie10"]=$selectCIE10;


//echo $cie10[$i].' - '.$dataCasosEpidemi["fecha_registro"];

    $casosEpidemiController->addcasosEpidemiModel($dataCasosEpidemi);

    $count++;


}

var_dump($count);


?>