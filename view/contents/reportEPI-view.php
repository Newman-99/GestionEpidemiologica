
<script src="<?php echo SERVERURL; ?>libraries/sheetjs-master/dist/xlsx.full.min.js" type="text/javascript"></script>
<script>
function exportFile(){

          var startDateRange = $('#startDateRange').val();

        var endDateRange = $('#endDateRange').val();

var hour = getHourForFileExport();

  var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'));
  XLSX.writeFile(wb, 'reporte_EPI_'+startDateRange+'_'+endDateRange+'_'+hour+'.xlsx');
  return false;
}
</script>


<?php 


  if($_SESSION['id_nivel_permiso']>2){
    echo $loginController->forceClosureController();
    exit();
  }

 
          $requestAjax = FALSE;
             require_once "./controller/casosEpidemiController.php";
            $casosEpidemiController= new casosEpidemiController();

          $currentDate = date("Y-m-d");

            //es la feha con el registro mas viejo
            $minDateValueAvailable = $casosEpidemiController-> getFirstDateRecordscasosEpidemiController();
             ?>


  <script src="<?php echo SERVERURL; ?>view/js/changeLanguageDatatables.js">

  </script>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Casos Epidemiologicos</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->
General
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Reportes EPI</h6>

            </div>
           
            <div class='form-group col-sm-2'>

            <input type='date' class='form-control' id='startDateRange' name='startDateRange'
            min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'
            >

            <input type='date' class='form-control' id='endDateRange' name='endDateRange' min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'>

            <input type="hidden" name="actionForAjax" id="actionForAjax"  class='form-control' value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>

           
            <button type="button" class="btn btn-primary" name="requestReportEpi" id="requestReportEpi" value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>
              Ver Reporte
            </button>

            </div>
        

          </div>
          

            <div class="card-body" id="card-body">

              <div class='table-responsive'>
                
                <table class='table display table-striped' id='dataTable' width='100%' cellspacing='0'>
                  
            <button type="button" class="btn" name="btnExportXls" id="btnExportXls" value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>
              Excel
            </button>
                  <thead>
                  <tr>
                          <th class='' rowspan="2" >NRO.</th>
                          <th class='' rowspan="2">ENFERMEDADES</th>

                          <th class='' colspan='3'>MENOR DE 1 AÑO</th>
                          <th class='' colspan='3'>1 - 4 AÑOS</th>
                          <th class='' colspan='3'>5 - 6 AÑOS</th>
                          <th class='' colspan='3'>7 - 9 AÑOS</th>
                          <th class='' colspan='3'>10 - 11 AÑOS</th>
                          <th class='' colspan='3'>12 - 14 AÑOS</th>
                          <th class='' colspan='3'>15 - 19 AÑOS</th>
                          <th class='' colspan='3'>20 - 24 AÑOS</th>
                          <th class='' colspan='3'>25 - 44 AÑOS</th>
                          <th class='' colspan='3'>45 - 59 AÑOS</th>
                          <th class='' colspan='3'>60 - 64 AÑOS</th>
                          <th class='' colspan='3'>65 AÑOS Y MAS</th>
                          <th class='' colspan='3'>TOTAL</th>
                  </tr>
                  

                  <tr>

              <?php for ($i=0; $i < 13; $i++) { ?>
                       
                          <th>FEM.</th>
                          <th>MASC.</th>

                          <th>TOTAL</th>

              <?php } ?>

                  </tr>


                          </thead>

              <tbody id="tbody">

                </tbody>

              </table>
              </div>
          </div>



  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

<script type="text/javascript">
  
    $( document ).ready(function() {

    $('#dataTable').DataTable({
      "searching": false,
      "bSort" : false,
      "paging": false,
      "ordering": false,
      "info": false,
     'language': LANGUAGE_SPANISH_DATATABLES,
                     "bDestroy": true

    });

  $('button#btnExportXls').on('click',function(){
          
return exportFile();

    });


  $('button#requestReportEpi').on('click',function(){

        var startDateRange = $('#startDateRange').val();

        var endDateRange = $('#endDateRange').val();

        var actionAjax = $(this).val();

  $.ajax({
      type:'POST',
      url: actionAjax,
      data:{
      'startDateRange':startDateRange,
      'endDateRange':endDateRange,
      'validDataToReportEpi':true},
       success:function(response){

// si no hay ninguna alerta mostramos la tabla
      let operationResult = JSON.parse(response);

      if (typeof operationResult.Alert != 'undefined') {    
      ajaxSweetAlerts(operationResult);
      }else{

    var dataRequestEpi = 
      'startDateRange='+startDateRange+
      '&endDateRange='+endDateRange+
      '&viewReportEpi='+'true';

          var table = $('#dataTable').DataTable({
      "searching": false,
      "bSort" : false,
      "paging": false,
      "ordering": false,
      "info": false,
        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": actionAjax+"?"+dataRequestEpi,
        'language': LANGUAGE_SPANISH_DATATABLES,
        "bDestroy": true

    });

      }

      }

    }); 

  
});

});

</script>
