<?php


        $queryGetDataDocIdentidadPerson = mainModel::connectDB()->query("select doc_identidad,id_nacionalidad from personas where id_person = '$id_person'");

        $dataDocIdentidadPerson = $queryGetDataDocIdentidadPerson->fetchAll(PDO::FETCH_ASSOC);

        if (mainModel::isDataEmtpy($dataDocIdentidadPerson['doc_identidad'],$dataDocIdentidadPerson['id_nacionalidad'])) {
            $alert=[
              "Alert"=>"simple",
              "Title"=>"Datos Invalidos",
              "Text"=>"La persona ya posee documento de identidad".$indicatorPersonError,
              "Type"=>"error"
            ];

              echo json_encode($alert);

              exit();         
        }

        $requestAjax =  false;


    require_once "./config/app.php";


    require_once "./controller/cie10DataController.php";

            $cie10DataController = new cie10DataController();


    require_once "./controller/casosEpidemiController.php";
    

            $casosEpidemiController = new casosEpidemiController();


  $queryGetCasesCie10 = "SELECT catalog_key FROM data_cie10";

    // obtnener data por captulos


    $queryGetCasesCie10 = $casosEpidemiController->connectDB()->query($queryGetCasesCie10." WHERE consecutivo BETWEEN  100 and 110");



    while($recordsCasesCie10=$queryGetCasesCie10->fetch(PDO
      ::FETCH_NUM)){ 

      $cie10[] = $recordsCasesCie10[0];
    }


    $count = 0;
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
  "is_hospital"=>1,
  "id_atrib_especial"=>"0",
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_nacionalidad_usuario"=>1,
  "doc_identidad_usuario"=>"28117206",
  "usuario_alias"=>"newman206",
  "bitacora_fecha"=> "2021-01-04",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "05:38:31 pm",
  "id_tipo_operacion"=>"1"];
/*

$dataCasosEpidemi = 
  ["id_nacionalidad"=>"2",
  "doc_identidad"=>"10304251",
  "nombres"=> "Maria Elena",
  "apellidos"=>"Sanchez Ramirez",
  "fecha_nacimiento"=> "1990-08-02",
  "id_genero"=>"2",
  "telefono"=> "04242495339",
  "indicatorPersonError"=>"",
  "id_parroquia"=>"1118",
  "direccion"=> "Calle Miranda Edif 33 apto 120",
  "ifExistPerson"=>0,
  "is_hospital"=>false,
  "id_atrib_especial"=>'0',
  "indicatorEpidemiCaseError"=>"",
  "year_registro"=>"2021",
  "id_nacionalidad_usuario"=>1,
  "doc_identidad_usuario"=>"28117206",
  "usuario_alias"=>"newman206",
  "bitacora_fecha"=> "2021-01-04",
  "bitacora_year"=>"2021",
  "bitacora_hora"=> "05:38:31 pm",
  "id_tipo_operacion"=>"1"];
*/

for ($i2=0; $i2 < 5; $i2++) { 


$date_now = date('d-m-Y');


$dateRegister = strtotime("-$i2 day", strtotime($date_now));



$dateRegister = date('Y-m-d', $dateRegister);



for ($i=0; $i < count($cie10); $i++) { 

if ($i > 0) {
  $dataCasosEpidemi["ifExistPerson"]=1;
}
  $dataCasosEpidemi["fecha_registro"]=$dateRegister;

  $dataCasosEpidemi["catalog_key_cie10"]=$cie10[$i];


//echo $cie10[$i].' - '.$dataCasosEpidemi["fecha_registro"];

    $casosEpidemiController->addcasosEpidemiModel($dataCasosEpidemi);

    $count++;
}


}

var_dump($count);


