<?php


        $requestAjax =  false;


    require_once "./config/app.php";


    require_once "./controller/cie10DataController.php";

            $cie10DataController = new cie10DataController();


    require_once "./controller/casosEpidemiController.php";
    

            $casosEpidemiController = new casosEpidemiController();


  $queryGetCasesCie10 = "SELECT catalog_key FROM data_cie10";

    // obtnener data por captulos


    $queryGetCasesCie10 = $casosEpidemiController->connectDB()->query($queryGetCasesCie10." WHERE consecutivo BETWEEN  0 and 100");



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
  "bitacora_fecha"=> "2021-02-21",
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
  "bitacora_fecha"=> "2021-02-21",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "11:38:31 am",
  "id_tipo_operacion"=>"1"];


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
  "bitacora_fecha"=> "2021-02-21",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "11:38:31 am",
  "id_tipo_operacion"=>"1"];

    $count = 0;

for ($nroRegister=0; $nroRegister < 100; $nroRegister++) { 


$date_now = date('d-m-Y');

$dayToRegister = mt_rand(0, 7);

$dateRegister = strtotime("-$dayToRegister day", strtotime($date_now));

$dateRegister = date('Y-m-d', $dateRegister);



$selectCIE10 = mt_rand(0,100);

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


//echo $cie10[$i].' - '.$dataCasosEpidemi["fecha_registro"];

    $casosEpidemiController->addcasosEpidemiModel($dataCasosEpidemi);

    $count++;


}

var_dump($count);


