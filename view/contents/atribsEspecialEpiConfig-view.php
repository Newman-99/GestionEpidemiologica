          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Configuracion: Reportes EPI</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

        <div class='card shadow mb-4'>
            <div class='card-header py-3'>

<?php 

  if($_SESSION['id_nivel_permiso'] > 2  || $_SESSION['id_estado'] != 1){
    echo $loginController->forceClosureController();
    exit();

  }

            $msjError = $loginController::$msjErrorRequestData404;

           $dataUrl= explode("/",$_GET['views']);

                if (!isset($dataUrl[1]) || $loginController->isDataEmtpyPermitedZero($dataUrl[1]) || !is_numeric($dataUrl[1])){

                  echo $msjError;

                  exit;

                }


          $dataUrl= explode("/",$_GET['views']);

          $requestedIdAtribEspecialEpi = $dataUrl[1];

          $requestAjax = FALSE;
          
          require_once "./controller/reportsEpiController.php";
          

          $reportsEpiController= new reportsEpiController();

          $querydataSimpleAtribEspecialEpi= $reportsEpiController->getDataSimpleAtribEspecialEpi($requestedIdAtribEspecialEpi);


          $isExistAtribEspecialEpi = $querydataSimpleAtribEspecialEpi->rowCount() > 0 ? true : false; 


          $dataSimpleAtribEspecialEpi = $querydataSimpleAtribEspecialEpi->fetchAll(PDO::FETCH_ASSOC);




              if ($loginController->isDataEmtpyPermitedZero($requestedIdAtribEspecialEpi) || 
                $loginController->isDataEmtpyPermitedZero($isExistAtribEspecialEpi)){

                echo $msjError;

                exit;

              }


              ?>

              <h6 class='m-0 font-weight-bold text-primary'>Configuracion de Atributos Especiales EPI: <?php echo $dataSimpleAtribEspecialEpi[0]['descripcion']; ?></h6>
            </div>

            <div class='card-body'>
  
  <div class='table-responsive-disabled'>



          <div class='form-row'>
          <br>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary regOrUpdFormAtribsEspecialsEpiConfigModal" data-toggle="modal" data-target="#regOrUpdFormAtribsEspecialsEpiConfigModal">
                Registrar
              </button>
          </div>

          <input type='hidden' class='form-control' id='requestedIdAtribEspecialEpi' name='requestedIdAtribEspecialEpi' value='<?php echo $requestedIdAtribEspecialEpi; ?>'>
          </div>
<br>          

              
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->

                <table class='table table-striped display' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>Nro.</th>
                      <th>Incio Catalogo CIE-10</th>
                      <th>Final Catalogo CIE-10</th>
                      <th>id_config</th>
                      <th>consecutivo_cie10_inicio</th>
                      <th>consecutivo_cie10_final</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nro.</th>
                      <th>Incio Catalogo CIE-10</th>
                      <th>Final Catalogo CIE-10</th>
                      <th>id_config</th>
                      <th>consecutivo_cie10_inicio</th>
                      <th>consecutivo_cie10_final</th>
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


      $('#searchCIE10inicio_for_atribs_especial,#searchCIE10Final_for_atribs_especial').on('keyup',async function(){
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

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];

     setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,valueSearch,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);
    }setCIE10FormReportEpiFilasModalBySearchPatternAsync


    // preparacion del input atributos espciales cie-10

});
  


    var requestedIdAtribEspecialEpi = $('#requestedIdAtribEspecialEpi').val();

    getDataAtribsEspecialsEpiConfigsDataTables(requestedIdAtribEspecialEpi);  


    var table = $('#dataTable');


    $('#id_atrib_especial_for_configs').val(requestedIdAtribEspecialEpi);

  $('button.regOrUpdFormAtribsEspecialsEpiConfigModal').on('click',function(){


    $("#regOrUpdFormAtribsEspecialsEpiConfigModal.modal-title").text("Registrar: Configuracion Atributo Especial");

    $("#btnRegisterOrupdateAtribEspecialEpiConfig").text("Registrar");

    document.getElementById("formAtribEspecialEpiConfigModal").setAttribute("data-form", 'register');

  });


  $(table).on('click','button#deleteAtribEspecialEpiConfig',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    deleteAtribEspecialEpiConfigs(data);
  
  });


function deleteAtribEspecialEpiConfigs(data){


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
    var id_config_atrib_especial = data[3];


    var textMsjAlert = 'Los datos del la configuracion Fila Reporte Epi seran elimnados del sistema';
  
  var dataAtribEspecialEpiConfig =
  'id_atrib_especial_for_configs='+requestedIdAtribEspecialEpi+
  '&id_config_atrib_especial='+id_config_atrib_especial+
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

      sendDataAjax(server_url+'ajax/reportsEpiAjax.php',dataAtribEspecialEpiConfig,'POST',responseProcess,msgBackendProcess);

//      $('#dataTable').DataTable().ajax.reload( null, false );

              }
        });

}


  $(table).on('click','button#updateAtribEspecialEpiconfig',function(e){

  e.preventDefault();

    var tr = $(this).parents('tr');
   
    var data = $(table).DataTable().row(tr).data();
  


    updateAtribEspecialEpiConfigs(data);


  });


async function updateAtribEspecialEpiConfigs(data){

    document.getElementById("formAtribEspecialEpiConfigModal").setAttribute("data-form", 'update');

    var key_cie10_inicio = data[1];

    var key_cie10_final = data[2];

    var id_config_epi = data[3];

    var consecutivo_cie10_inicio = data[4];

    var consecutivo_cie10_final = data[5];


await setTimeout(function(){

    var inputsGroupCie10 = $('#searchCIE10inicio_for_atribs_especial').parent('div.inputs-group-cie10');

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];


     setCIE10FormReportEpiFilasModalBySearchPatternAsync($('#searchCIE10inicio_for_atribs_especial'),key_cie10_inicio,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);

}, 0);
      

await setTimeout(function(){


    var inputsGroupCie10 = $('#searchCIE10Final_for_atribs_especial').parent('div.inputs-group-cie10');

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var columnsSearch = ['catalog_key'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];

     setCIE10FormReportEpiFilasModalBySearchPatternAsync($('#searchCIE10Final_for_atribs_especial'),key_cie10_final,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);


}, 0);



    var textMsjAlert = 'La Configuracion del Atributo Especial Epi seran Modificados';
    
        $("#regOrUpdFormAtribsEspecialsEpiConfigModal.modal-title").text("Editar: Atributo Configuracion Reporte EPI");

    $("#btnRegisterOrupdateAtribEspecialEpiConfig").text("Editar");

    await $('#regOrUpdFormAtribsEspecialsEpiConfigModal').modal('show');

await setTimeout(function(){

    $("#id_config_atrib_especial").val(id_config_epi);

    $("#consecutivo_cie10_inicio_for_atribs_especial").val(consecutivo_cie10_inicio);

    $("#consecutivo_cie10_final_for_atribs_especial").val(consecutivo_cie10_final);
  
  }, 500);

}


    $("#regOrUpdFormAtribsEspecialsEpiConfigModal").on('hidden.bs.modal', function () {


    var consecutivo_cie10 = $('.consecutivo_cie10'); 

    var data_form = document.getElementById("formAtribEspecialEpiConfigModal").getAttribute("data-form");
    
    if (data_form == 'update') {
  
  consecutivo_cie10.empty().append("<option value=''>Seleccionar Evento CIE 10 Final</option>");

  $('#formAtribEspecialEpiConfigModal').trigger("reset");
  
    }
  });

  





  });




</script>

