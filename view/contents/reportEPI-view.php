
<script src="<?php echo SERVERURL; ?>libraries/sheetjs-master/dist/xlsx.full.min.js" type="text/javascript"></script>
<script>
function exportFile(){

          var startDateRange = $('#startDateRange').val();

        var endDateRange = $('#endDateRange').val();

        var  today = new Date();

        var hour = 'H'+today.getHours() + '-' + today.getMinutes();


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
                          <th class='' rowspan="2" >Orden</th>
                          <th class='' rowspan="2">Enfermedad / Evento</th>

                          <th class='' colspan='2'>&lt; 1 año</th>
                          <th class='' colspan='2'>1 a 4 años</th>
                          <th class='' colspan='2'>5 a 6 años</th>
                          <th class='' colspan='2'>7 a 9 años</th>
                          <th class='' colspan='2'>10 a 11 años</th>
                          <th class='' colspan='2'>12 a 14 años</th>
                          <th class='' colspan='2'>15 a 19 años</th>
                          <th class='' colspan='2'>20 a 24 años</th>
                          <th class='' colspan='2'>25 a 44 años</th>
                          <th class='' colspan='2'>45 a 59 años</th>
                          <th class='' colspan='2'>60 a 64 años</th>
                          <th class='' colspan='2'>65 años y más</th>
                          <th class='' colspan='2'>Total</th>

                          <th class='' rowspan="2">Total General</th>
                  </tr>
                  

                  <tr>

              <?php for ($i=0; $i < 12; $i++) { ?>
                       
                          <th>H</th>
                          <th>M</th>
              <?php } ?>

                            <th class='column26 style21 s'>Hombres</th>
                             <th class='column27 style22 s' >Mujeres</th>

                  </tr>


                          </thead>

              <tbody id="tbody">

          <tr>
            <td >00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
            <td>00</td>
          </tr>

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
