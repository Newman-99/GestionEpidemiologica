<?php 

  require_once "mainModel.php";

  class reportsEpiModel extends mainModel{

protected static  $queryCreateViewReportsEpi = "
CREATE OR REPLACE VIEW report_epi_filas_view  AS SELECT DISTINCT ON (nro_fila_report) nro_fila_report, ROW_NUMBER() OVER(ORDER BY enfermedad_evento DESC), enfermedad_evento 

  FROM report_epi_filas;";



protected static  $queryCreateViewAtribsEspecialsEpi = "

CREATE OR REPLACE VIEW atribs_especials_epi_view  
AS SELECT ROW_NUMBER() 
OVER(), id_atrib_especial, descripcion

  FROM atribs_especials_epi
 
  ORDER BY id_atrib_especial ASC;";

      public static function queryCreateViewAtribsEspecialsConfigsEpi($id_atrib_especial){

 return $queryCreateViewAtribsEspecialsConfigsEpi = "

    CREATE OR REPLACE VIEW atribs_especials_configs_epi_view  
    AS SELECT DISTINCT ON (id_config) id_config,ROW_NUMBER() 
    OVER(),               
        atr_esp.descripcion descrip_atrib_especial,

    (coalesce(get_key_cie10(atr_esp_conf.consecutivo_cie10_inicio),'Ninguno')) as key_cie10_inicio,

    (coalesce(get_key_cie10(atr_esp_conf.consecutivo_cie10_final),'Ninguno')) as key_cie10_final,

    atr_esp_conf.consecutivo_cie10_inicio, atr_esp_conf.consecutivo_cie10_final

      FROM atribs_especials_epi_configs atr_esp_conf, atribs_especials_epi atr_esp
      
      WHERE 
      
      atr_esp.id_atrib_especial = atr_esp_conf.id_atrib_especial 
      AND
      atr_esp_conf.id_atrib_especial = $id_atrib_especial ::integer

      ORDER BY id_config ASC;";

}
      public static function queryCreateViewConfigsReportsEpi($nro_fila_report){

 return $queryCreateViewConfigsReportsEpi = "
CREATE OR REPLACE VIEW report_epi_filas_configs_view  
AS SELECT DISTINCT ON (id_config_epi) id_config_epi,ROW_NUMBER() 
OVER(), /*edad_inicio, edad_final, */
id_atrib_especial_inicio, id_atrib_especial_final,

get_atrib_especial_epi(id_atrib_especial_inicio) descrip_atrib_especial_inicio, get_atrib_especial_epi(id_atrib_especial_final) descrip_atrib_especial_final,


(coalesce(get_key_cie10(consecutivo_cie10_inicio),'Ninguno')) as key_cie10_inicio,

(coalesce(get_key_cie10(consecutivo_cie10_final),'Ninguno')) as key_cie10_final,

consecutivo_cie10_inicio, consecutivo_cie10_final/*,
 
get_descrip_hospital(is_hospital_inicio,is_hospital_final) hospital,

get_descrip_tipo_entrada(id_tipo_entrada_inicio,id_tipo_entrada_final) tipo_entrada
*/
  FROM report_epi_filas_configs
  
  WHERE nro_fila_report = $nro_fila_report ::integer

  ORDER BY id_config_epi ASC;";
}


      public static function addReportEpiFilaModel($dataReportEpi){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();


  try {

    $sqlQuery = $DB_transacc->prepare("INSERT INTO report_epi_filas(
         nro_fila_report,
         enfermedad_evento
         ) VALUES (   
         :nro_fila_report,
         :enfermedad_evento
       )");

      $sqlQuery->execute(array(
     "nro_fila_report"=>$dataReportEpi['nro_fila_report'],
     "enfermedad_evento"=>$dataReportEpi['enfermedad_evento']));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"clean",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Fila Reporte EPI Registrado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTableReportEpiFilas"
      ];
/**/
      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Registrar La Fila Reporte EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);
/**/
  }



        public static function addReportEpiConfigsModel($dataReportEpiConfig){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  
  try {


    $sqlQuery = $DB_transacc->prepare("INSERT INTO public.report_epi_filas_configs(nro_fila_report, id_atrib_especial_inicio, id_atrib_especial_final, consecutivo_cie10_inicio, consecutivo_cie10_final
  )
  VALUES (:nro_fila_report, :id_atrib_especial_inicio, :id_atrib_especial_final, :consecutivo_cie10_inicio, :consecutivo_cie10_final);");


            $sqlQuery->execute(array(
          'nro_fila_report' => $dataReportEpiConfig['nro_fila_report'],
       /*   'is_hospital_inicio' => $dataReportEpiConfig['is_hospital_inicio'],
          'is_hospital_final' => $dataReportEpiConfig['is_hospital_final'],
          'edad_inicio' => $dataReportEpiConfig['edad_inicio'],
          'edad_final' => $dataReportEpiConfig['edad_final'],*/
          'id_atrib_especial_inicio' => $dataReportEpiConfig['id_atrib_especial_inicio'],
          'id_atrib_especial_final' => $dataReportEpiConfig['id_atrib_especial_final'],
          'consecutivo_cie10_inicio' => $dataReportEpiConfig['consecutivo_cie10_inicio'],
          'consecutivo_cie10_final' => $dataReportEpiConfig['consecutivo_cie10_final']/*,
          'id_tipo_entrada_inicio' => $dataReportEpiConfig['id_tipo_entrada_inicio'],
          'id_tipo_entrada_final' => $dataReportEpiConfig['id_tipo_entrada_final']*/));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"clean",
        "Title"=>"Operacion Exitosa",
        "Text"=>"La Fila Reporte EPI ha sido Registrado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTable",
      ];
/**/
      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Registrar el Reporte EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);
/**/
  } 
 

         public static function updateReportEpiFilasModel($dataReportEpi){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

    $sqlQuery = $DB_transacc->query("ALTER TABLE report_epi_filas_configs DISABLE TRIGGER ALL;");

    $sqlQuery = $DB_transacc->prepare("
      UPDATE report_epi_filas_configs SET 
      nro_fila_report = :nro_fila_report
      WHERE nro_fila_report = :nro_fila_report_original;
      ");

      $sqlQuery->execute(array(
     "nro_fila_report"=>$dataReportEpi['nro_fila_report'],
     "nro_fila_report_original"=>$dataReportEpi['nro_fila_report_original']));

      $sqlQuery->closeCursor();


    $sqlQuery = $DB_transacc->prepare("UPDATE report_epi_filas SET 
     nro_fila_report = :nro_fila_report,
     enfermedad_evento = :enfermedad_evento
     WHERE nro_fila_report = :nro_fila_report_original;");

      $sqlQuery->execute(array(
      "nro_fila_report_original"=>$dataReportEpi['nro_fila_report_original'],
      "nro_fila_report"=>$dataReportEpi['nro_fila_report'],
      "enfermedad_evento"=>$dataReportEpi['enfermedad_evento']));

      $sqlQuery->closeCursor();

    $sqlQuery = $DB_transacc->query("ALTER TABLE report_epi_filas_configs ENABLE TRIGGER ALL;");

        $alert=[
        "reloadDataTableSpecify"=>"dataTableReportEpiFilas",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"La Fila Reporte EPI ha sido Actualizado",
        "Type"=>"success"
      ];

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"Error en la Actualizacion del Reporte EPI<br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }


         public static function deleteReportEpiFilasModel($dataReportEpi){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

//    var_dump($DB_transacc);

  try {


    $sqlQuery = $DB_transacc->query("ALTER TABLE report_epi_filas_configs DISABLE TRIGGER ALL;");

    $sqlQuery = $DB_transacc->prepare("DELETE FROM report_epi_filas_configs WHERE nro_fila_report = :nro_fila_report;");

      $sqlQuery->execute(array(
     "nro_fila_report"=>$dataReportEpi['nro_fila_report']));

      $sqlQuery->closeCursor();
    
    $sqlQuery = $DB_transacc->prepare("DELETE FROM report_epi_filas WHERE nro_fila_report = :nro_fila_report;");

      $sqlQuery->execute(array(
     "nro_fila_report"=>$dataReportEpi['nro_fila_report']));

      $sqlQuery->closeCursor();


        $alert=[
        "reloadDataTableSpecify"=>"dataTableReportEpiFilas",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"La Fila Reporte EPI ha sido eliminado",
        "Type"=>"success"
      ];

    $sqlQuery = $DB_transacc->query("ALTER TABLE report_epi_filas_configs ENABLE TRIGGER ALL;");

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"Error en la eliminacion del Reporte EPI<br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }


        public static function updateReportEpiConfigsModel($dataReportEpiConfig){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();


  try {


    $sqlQuery = $DB_transacc->prepare("UPDATE public.report_epi_filas_configs SET
      id_atrib_especial_inicio = :id_atrib_especial_inicio,
      id_atrib_especial_final = :id_atrib_especial_final,
      consecutivo_cie10_inicio = :consecutivo_cie10_inicio,
      consecutivo_cie10_final = :consecutivo_cie10_final
      /* 
      edad_inicio = :edad_inicio,
      edad_final = :edad_final,
      is_hospital_inicio = :is_hospital_inicio,
      is_hospital_final = :is_hospital_final,
      id_tipo_entrada_inicio = :id_tipo_entrada_inicio,
      id_tipo_entrada_final = :id_tipo_entrada_final*/
      WHERE id_config_epi = :id_config_epi 
      ");

            $sqlQuery->execute(array(
          'id_config_epi' => $dataReportEpiConfig['id_config_epi'],
          /*'is_hospital_inicio' => $dataReportEpiConfig['is_hospital_inicio'],
          'is_hospital_final' => $dataReportEpiConfig['is_hospital_final'],
          'edad_inicio' => $dataReportEpiConfig['edad_inicio'],
          'edad_final' => $dataReportEpiConfig['edad_final'],
        */'id_atrib_especial_inicio' => $dataReportEpiConfig['id_atrib_especial_inicio'],
          'id_atrib_especial_final' => $dataReportEpiConfig['id_atrib_especial_final'],
          'consecutivo_cie10_inicio' => $dataReportEpiConfig['consecutivo_cie10_inicio'],
          'consecutivo_cie10_final' => $dataReportEpiConfig['consecutivo_cie10_final'],
          /*'id_tipo_entrada_inicio' => $dataReportEpiConfig['id_tipo_entrada_inicio'],
          'id_tipo_entrada_final' => $dataReportEpiConfig['id_tipo_entrada_final']*/));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"La Fila Reporte EPI ha sido Actualizado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTable",
      ];
/**/
      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Actualizar el Reporte EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);
/**/
  } 

         public static function deleteReportEpiFilaConfigsModel($dataReportEpi){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

//    var_dump($DB_transacc);

  try {

    $sqlQuery = $DB_transacc->prepare("DELETE FROM report_epi_filas_configs WHERE id_config_epi = :id_config_epi;");

      $sqlQuery->execute(array(
     "id_config_epi"=>$dataReportEpi['id_config_epi']));

      $sqlQuery->closeCursor();


        $alert=[
        "reloadDataTableSpecify"=>"dataTable",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"La Configuracion Fila Reporte EPI ha sido eliminado",
        "Type"=>"success"
      ];

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"Error en la eliminacion del la Configuracion Reporte Fila EPI<br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }


      public static function addAtribEspecialReportEpiModel($dataAtribEspecial){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

    $sqlQuery = $DB_transacc->prepare("INSERT INTO atribs_especials_epi(
         id_atrib_especial,
         descripcion
         ) VALUES (   
         :id_atrib_especial,
         :descripcion
       )");

      $sqlQuery->execute(array(
     "id_atrib_especial"=>$dataAtribEspecial['id_atrib_especial'],
     "descripcion"=>$dataAtribEspecial['descrip_atrib_especial']));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"clean",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Atributo Especial EPI Registrado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTableAtribsEspecialsEpi"
      ];

      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Registrar El Atributo Especial EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);

  }

         public static function updateAtribEspecialReportEpiModel($dataAtribEspecial){


    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {


    $sqlQuery = $DB_transacc->query("ALTER TABLE atribs_especials_epi_configs DISABLE TRIGGER ALL;");


    $sqlQuery = $DB_transacc->prepare("UPDATE atribs_especials_epi_configs SET 
     id_atrib_especial = :id_atrib_especial
     WHERE id_atrib_especial = :id_atrib_especial_original;");

      $sqlQuery->execute(array(
     "id_atrib_especial_original"=>$dataAtribEspecial['id_atrib_especial_original'],
     "id_atrib_especial"=>$dataAtribEspecial['id_atrib_especial']));

      $sqlQuery->closeCursor();


    $sqlQuery = $DB_transacc->prepare("UPDATE atribs_especials_epi SET 
     descripcion = :descrip_atrib_especial,
     id_atrib_especial = :id_atrib_especial
     WHERE id_atrib_especial = :id_atrib_especial_original;");

      $sqlQuery->execute(array(
     "id_atrib_especial_original"=>$dataAtribEspecial['id_atrib_especial_original'],
     "id_atrib_especial"=>$dataAtribEspecial['id_atrib_especial'],
     "descrip_atrib_especial"=>$dataAtribEspecial['descrip_atrib_especial']));

      $sqlQuery->closeCursor();

    $sqlQuery = $DB_transacc->query("ALTER TABLE atribs_especials_epi_configs ENABLE TRIGGER ALL;");

        $alert=[
        "reloadDataTableSpecify"=>"dataTableAtribsEspecialsEpi",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Atributo Especial EPI Actualizado",
        "Type"=>"success"
      ];

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"No se ha podido Actualizar El Atributo Especial EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }

         public static function deleteAtribEspecialReportEpiModel($dataReportEpi){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

//    var_dump($DB_transacc);

  try {

    $sqlQuery = $DB_transacc->prepare("DELETE FROM atribs_especials_epi WHERE id_atrib_especial = :id_atrib_especial;");

      $sqlQuery->execute(array(
     "id_atrib_especial"=>$dataReportEpi['id_atrib_especial']));

      $sqlQuery->closeCursor();


        $alert=[
        "reloadDataTableSpecify"=>"dataTableAtribsEspecialsEpi",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Atributo Especial EPI Eliminado",
        "Type"=>"success"
      ];

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"Error en la eliminacion de la El Atributo Especial EPI<br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }

    // operaciones para AtribEspecialReportEpi Config
    // 

      public static function addAtribEspecialReportEpiConfigModel($dataAtribEspecialConfig){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

    $sqlQuery = $DB_transacc->prepare("INSERT INTO public.atribs_especials_epi_configs(
  id_atrib_especial, consecutivo_cie10_inicio, consecutivo_cie10_final)
  VALUES (:id_atrib_especial,:consecutivo_cie10_inicio, :consecutivo_cie10_final);");

      $sqlQuery->execute(array(
     "id_atrib_especial"=>$dataAtribEspecialConfig['id_atrib_especial'],
     "consecutivo_cie10_inicio"=>$dataAtribEspecialConfig['consecutivo_cie10_inicio'],
     "consecutivo_cie10_final"=>$dataAtribEspecialConfig['consecutivo_cie10_final']));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"clean",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Atributo Especial EPI Registrado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTable"
      ];

      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Registrar El Atributo Especial EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);

  }


      public static function updateAtribEspecialReportEpiConfigModel($dataAtribEspecialConfig){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

    $sqlQuery = $DB_transacc->prepare("UPDATE atribs_especials_epi_configs SET 
     id_atrib_especial = :id_atrib_especial,
     consecutivo_cie10_inicio = :consecutivo_cie10_inicio,
     consecutivo_cie10_final = :consecutivo_cie10_final
     WHERE id_config = :id_config_atrib_especial;");


      $sqlQuery->execute(array(
     "id_config_atrib_especial"=>$dataAtribEspecialConfig['id_config_atrib_especial'],
     "id_atrib_especial"=>$dataAtribEspecialConfig['id_atrib_especial'],
     "consecutivo_cie10_inicio"=>$dataAtribEspecialConfig['consecutivo_cie10_inicio'],
     "consecutivo_cie10_final"=>$dataAtribEspecialConfig['consecutivo_cie10_final']));

      $sqlQuery->closeCursor();

      $DB_transacc->commit();

      $alert=[
        "Alert"=>"clean",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Atributo Especial EPI Actualizado",
        "Type"=>"success",
        "reloadDataTableSpecify"=>"dataTable"
      ];

      }catch (Exception $e) {

      $DB_transacc->rollBack();

      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ha ocurrido un error inesperado",
        "Text"=>"No se ha podido Actualizar El Atributo Especial EPI en el sistema <br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];


    }

    echo json_encode($alert);


      }
   
            public static function deleteAtribEspecialReportEpiConfigModel($dataAtribEspecialConfig){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

    $sqlQuery = $DB_transacc->prepare("DELETE FROM atribs_especials_epi_configs WHERE id_config = :id_config_atrib_especial;;");

      $sqlQuery->execute(array(
     "id_config_atrib_especial"=>$dataAtribEspecialConfig['id_config_atrib_especial']));

      $sqlQuery->closeCursor();


        $alert=[
        "reloadDataTableSpecify"=>"dataTable",
        "Alert"=>"simple",
        "Title"=>"Operacion Exitosa",
        "Text"=>"Configuracion del Atributo Especial EPI Eliminado",
        "Type"=>"success"
      ];

      // en variable para eviatr error de doble cierre de transacc
      $DB_transacc->commit();
      
      }catch (Exception $e) {

      $DB_transacc->rollBack();


      $alert=[
        "Alert"=>"simple",
        "Title"=>"Ocurrio un error inesperado",
        "Text"=>"Error en la eliminacion de la Configuracion del Atributo Especial EPI<br>
          Error".$e->getMessage()."",
        "Type"=>"error"
      ];

    }

    echo json_encode($alert);


    }
   


    }

 ?>