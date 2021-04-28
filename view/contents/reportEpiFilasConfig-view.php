          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Configuracion: Reportes EPI</h1>
          
        <div class='card shadow mb-4'>
            <div class='card-header py-3'>

<?php 

  if($_SESSION['id_nivel_permiso'] > 2  || $_SESSION['id_estado'] != 1){
    echo $loginController->forceClosureController();
    exit();

  }

            $msjError = $loginController::$msjErrorRequestData404;

            $dataUrl= explode("/",$_GET['views']);

                if (!isset($dataUrl[1]) || empty($dataUrl[1]) || !is_numeric($dataUrl[1])){

                  echo $msjError;

                  exit;

                }

    $requestedIdFilasReport = mainModel::cleanStringSQL($dataUrl[1]);     



          $requestAjax = FALSE;
          
          require_once "./controller/reportsEpiController.php";
          

          $reportsEpiController= new reportsEpiController();

          $mainModel= new mainModel();

          $querydataSimpleReportEpiFila = $reportsEpiController->getDataSimpleReportEpiFila($requestedIdFilasReport);

          $isExistReportEpiFila = $querydataSimpleReportEpiFila->rowCount() > 0 ? true : false; 

          $dataSimpleReportEpiFila = $querydataSimpleReportEpiFila->fetchAll(PDO::FETCH_ASSOC);

?>


              <?php


              if (!$requestedIdFilasReport || empty($requestedIdFilasReport) || 
                $mainModel->isDataEmtpyPermitedZero($isExistReportEpiFila)){

                echo $msjError;

                exit;

              }

              ?>

              <h6 class='m-0 font-weight-bold text-primary'>Configuracion de la Fila Reporte: <?php echo $dataSimpleReportEpiFila[0]['enfermedad_evento']; ?></h6>
            </div>


            <div class='card-body'>
  
  <div class='table-responsive-disabled'>



          <div class='form-row'>
          <br>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary registerOrUpdateReportEpiFilasConfigModal" data-toggle="modal" data-target="#registerOrUpdateReportEpiFilasConfigModal">
                Registrar
              </button>
          </div>

          <input type='hidden' class='form-control' id='requestedIdFilasReport' name='requestedIdFilasReport' value='<?php echo $requestedIdFilasReport; ?>'>
          </div>
<br>          

              
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->

                <table class='table table-striped display' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>Nro.</th>
                      <th>Incio Catalogo CIE-10</th>
                      <th>Final Catalogo CIE-10</th>
                      <th>Inicio Atributo Especial</th>
                      <th>Final Atributo Especial</th>
<!--                  <th>Edad Inicio</th>
                      <th>Edad Final</th>
                      <th>Hospitalizado o Referido?</th>
                      <th>Primerizo o Sucesivo?</th>
-->                      <th>id_config_epi</th>
                      <th>consecutivo_cie10_inicio</th>
                      <th>consecutivo_cie10_final</th>
                      <th>id_atrib_especial_inicio</th>
                      <th>id_atrib_especial_final</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nro.</th>
                      <th>Incio Catalogo CIE-10</th>
                      <th>Final Catalogo CIE-10</th>
                      <th>Inicio Atributo Especial</th>
                      <th>Final Atributo Especial</th>
<!--                      <th>Edad Inicio</th>
                      <th>Edad Final</th>
                      <th>Hospitalizado o Referido?</th>
                      <th>Primerizo o Sucesivo?</th>
-->                      <th>id_config_epi</th>
                      <th>consecutivo_cie10_inicio</th>
                      <th>consecutivo_cie10_final</th>
                      <th>id_atrib_especial_inicio</th>
                      <th>id_atrib_especial_final</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>


                    </tbody>
                </table>
              </div>
           </div>
        </div>



  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>


<script type="text/javascript">

  $( document ).ready(function() {
 
    $('.input-group-addon').css("display", "none");


      $('#searchCIE10Inicio,#searchCIE10Final').on('keyup',async function(){

  var timer;
/*
  window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
  timer = window.setTimeout(() => {
*/
      var valueSearch=$(this).val();

    if (valueSearch!="" && valueSearch.length > 2){


    var inputsGroupCie10 = $(this).parent('div.inputs-group-cie10');

    var valueSearch=$(this).val();

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var selectAtribEspecialEpi = inputsGroupCie10.find('select:eq(1)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var iconLoadSelectAtribEspecialEpi = inputsGroupCie10.find('.input-group-addon:eq(1)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];

     await setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,valueSearch,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);
    }


    // preparacion del input atributos espciales cie-10



    if ($('#consecutivo_cie10_inicio').val() != "" && $('#consecutivo_cie10_final').val() != ""){
    

        var consecutivo_cie10_inicio = $('#consecutivo_cie10_inicio').val();
         var consecutivo_cie10_final = $('#consecutivo_cie10_final').val();



      let valuesSearchCie10 = [consecutivo_cie10_inicio, consecutivo_cie10_final]

      let atribsSearchCie10 = ['consecutivo','consecutivo'];

    var selectAtribEspecialEpi = $('.rango_atrib_especial'); 

    var iconLoadSelectAtribEspecialEpi = $('.icon-load-atrib-especial'); 

      return getEspecialAttributesCIE10FormConfigReport(iconLoadSelectAtribEspecialEpi,
      selectAtribEspecialEpi,'range',atribsSearchCie10,valuesSearchCie10);


    }


});


$('#consecutivo_cie10_inicio,#consecutivo_cie10_final').on('change',function(){


    if ($('#consecutivo_cie10_inicio').val() != "" && $('#consecutivo_cie10_final').val() != ""){
    

        var consecutivo_cie10_inicio = $('#consecutivo_cie10_inicio').val();
         var consecutivo_cie10_final = $('#consecutivo_cie10_final').val();



      let valuesSearchCie10 = [consecutivo_cie10_inicio, consecutivo_cie10_final]

      let atribsSearchCie10 = ['consecutivo','consecutivo'];

      var selectAtribEspecialEpi = $('.rango_atrib_especial'); 

      var iconLoadSelectAtribEspecialEpi = $('.icon-load-atrib-especial'); 

      return getEspecialAttributesCIE10FormConfigReport(iconLoadSelectAtribEspecialEpi,
      selectAtribEspecialEpi,'range',atribsSearchCie10,valuesSearchCie10);


    }



      });
  
  


    var requestedIdFilasReport = $('#requestedIdFilasReport').val();

    getDataReportsEpiFilasConfigsDataTables(requestedIdFilasReport);  


    var table = $('#dataTable');


    $('#nro_fila_report_for_configs').val(requestedIdFilasReport);

  $('button.registerOrUpdateReportEpiFilasConfigModal').on('click',function(){


    $("#registerOrUpdateReportEpiFilasConfigModal.modal-title").text("Registrar Configuracion Filas EPI");

    $("#btnRegisterOrupdateReportEpiFilasConfig").text("Registrar");

    document.getElementById("formReportEpiFilasConfigModal").setAttribute("data-form", 'register');

  });


  $(table).on('click','button#deleteReportEpiFilasConfig',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    deleteReportEpiFilasConfigs(data);
  
  });


function deleteReportEpiFilasConfigs(data){
/*
                     0 <th>Nro.</th>
                    1 <th>Final Catalogo CIE-10</th>
                    2  <th>Incio Catalogo CIE-10</th>
                    3  <th>Inicio Atributo Especial</th>
                    4  <th>Final Atributo Especial</th>
                    5  <th>Edad Inicio</th>
                    6  <th>Edad Final</th>
                    7  <th>Hospitalizado o Referido?</th>
                    8  <th>Primerizo o Sucesivo?</th>
                    9  <th>id_config_epi</th>
                   10   <th>consecutivo_cie10_inicio</th>
                   11   <th>consecutivo_cie10_final</th>
                   12   <th>id_atrib_especial_inicio</th>
                   13   <th>id_atrib_especial_final</th>
                   14  <th></th>

*/
    var id_config_epi = data[5];


    var textMsjAlert = 'Los datos del la configuracion Fila Reporte Epi seran elimnados del sistema';
  
  
  var dataReportEpiFilasConfig =
  'nro_fila_report_for_configs='+requestedIdFilasReport+
  '&id_config_epi='+id_config_epi+
  '&operationType='+'delete';

    var server_url = $('#server_url').val();

          Swal.fire({
            title: '¿Estás seguro?',
            text: textMsjAlert,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if(result.value){

  let responseProcess=table.find('.responseProcessAjax');
  let msgBackendProcess=table.find('.msgBackendProcess');

      sendDataAjax(server_url+'ajax/reportsEpiAjax.php',dataReportEpiFilasConfig,'POST',responseProcess,msgBackendProcess);

//      $('#dataTable').DataTable().ajax.reload( null, false );

              }
        });

}


console.log($('#updateReportEpiFilasconfig'));

  $(table).on('click','button#updateReportEpiFilasconfig',function(e){

  e.preventDefault();

    var tr = $(this).parents('tr');
   
    var data = $(table).DataTable().row(tr).data();
  


    updateReportEpiFilasConfigs(data);


  });


async function updateReportEpiFilasConfigs(data){

    document.getElementById("formReportEpiFilasConfigModal").setAttribute("data-form", 'update');

    var key_cie10_inicio = data[1];

    var key_cie10_final = data[2];
/*

    var edad_inicio = data[5];

    var edad_final = data[6];

    var hospital = data[7];

    var tipo_entrada = data[8];
*/
    var id_config_epi = data[5];

    var consecutivo_cie10_inicio = data[6];

    var consecutivo_cie10_final = data[7];

    var id_atrib_especial_inicio = data[8];

    var id_atrib_especial_final = data[9];

/*
  if (hospital == 'Todos') {

    var is_hospital = 3;

  }else if(hospital == 'SI'){
    
    var is_hospital = 0;

  }else if(hospital == 'NO'){

    var is_hospital = 1;

  }else{
    var is_hospital = 0;    
  }

  if (tipo_entrada == 'Ambos') {

    var id_tipo_entrada = 3;

  }else if(tipo_entrada == 'Primerizo'){
    
    var id_tipo_entrada = 1;

  }else if(tipo_entrada == 'Sucesivo'){

    var id_tipo_entrada = 2;

  }else{
    var id_tipo_entrada = 1;    
  }

console.log(is_hospital,id_tipo_entrada);

$("#is_hospital_report_epi").val(is_hospital);

$("#id_tipo_entrada_report_epi").val(id_tipo_entrada);

    */
/*
    $("#edad_inicio").val(edad_inicio);

    $("#edad_final").val(edad_final);
*/
    //$("#id_tipo_entrada").val(id_tipo_entrada);






await setTimeout(function(){

    var inputsGroupCie10 = $('#searchCIE10Inicio').parent('div.inputs-group-cie10');

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var selectAtribEspecialEpi = inputsGroupCie10.find('select:eq(1)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var iconLoadSelectAtribEspecialEpi = inputsGroupCie10.find('.input-group-addon:eq(1)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];

//    var  valueSearch = $('#searchCIE10Inicio').val();

      setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,key_cie10_inicio,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);

}, 0);
      

await setTimeout(function(){


    var inputsGroupCie10 = $('#searchCIE10Final').parent('div.inputs-group-cie10');

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var selectAtribEspecialEpi = inputsGroupCie10.find('select:eq(1)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var iconLoadSelectAtribEspecialEpi = inputsGroupCie10.find('.input-group-addon:eq(1)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];
      
//    var  valueSearch = $('#searchCIE10Final').value();

      setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,key_cie10_final,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);

}, 0);


// set atributos espeicales 
    
    
    var selectAtribEspecialEpi = $('.rango_atrib_especial'); 

  await $(selectAtribEspecialEpi).empty();

    await   selectAtribEspecialEpi.empty().append("<option value='0'>Atributo Especial: Ninguno</option>");

    var iconLoadSelectAtribEspecialEpi = $('.icon-load-atrib-especial'); 

      let valuesSearchCie10 = [consecutivo_cie10_inicio, consecutivo_cie10_final];

      let atribsSearchCie10 = ['consecutivo','consecutivo'];

   await setTimeout(function(){ getEspecialAttributesCIE10FormConfigReport(iconLoadSelectAtribEspecialEpi,
      selectAtribEspecialEpi,'range',atribsSearchCie10,valuesSearchCie10);},0);

    setTimeout(function(){ $("#id_atrib_especial_inicio").val(id_atrib_especial_inicio);}, 1000);


    setTimeout(function(){ $("#id_atrib_especial_final").val(id_atrib_especial_final);}, 1000);


    var textMsjAlert = 'La Configuracion de la Fila del Eeporte Epi seran Modificados';
    
        $("#registerOrUpdateReportEpiFilasConfigModal.modal-title").text("Editar Configuracion Filas EPI");

    $("#btnRegisterOrupdateReportEpiFilasConfig").text("Editar");

    await $('#registerOrUpdateReportEpiFilasConfigModal').modal('show');

await setTimeout(function(){

    $("#id_config_epi").val(id_config_epi);

    $("#consecutivo_cie10_inicio").val(consecutivo_cie10_inicio);

    $("#consecutivo_cie10_final").val(consecutivo_cie10_final);

    $("#id_atrib_especial_inicio").val(id_atrib_especial_inicio);

    $("#id_atrib_especial_final").val(id_atrib_especial_final);
  
  }, 800);


  
}


    $("#registerOrUpdateReportEpiFilasConfigModal").on('hidden.bs.modal', function () {

    var selectAtribEspecialEpi = $('.rango_atrib_especial'); 

    var consecutivo_cie10 = $('.consecutivo_cie10'); 


    var data_form = document.getElementById("formReportEpiFilasConfigModal").getAttribute("data-form");
    
    if (data_form == 'update') {

  selectAtribEspecialEpi.empty().append("<option value='0'>Atributo Especial:  Ninguno</option>");
  
  consecutivo_cie10.empty().append("<option value=''>Seleccionar Evento CIE 10 Final</option>");

  $('#formReportEpiFilasConfigModal').trigger("reset");
  
    }
  });

  




  });




</script>

