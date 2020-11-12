<?php 
  if($_SESSION['id_nivel_permiso']>2){
    echo $loginController->forceClosureController();
    exit();
  }
?>


  <script src="<?php echo SERVERURL; ?>view/js/changeLanguageDatatables.js">

  </script>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Reporte Epidemiologico</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Reporte EPI</h6>

            </div>
           
            <div class='form-group col-sm-2'>

            <?php  
              $requestAjax = FALSE;
             require_once "./controller/casosEpidemiController.php";
            $casosEpidemiController= new casosEpidemiController();

          $currentDate = date("Y-m-d");

            //es la feha con el registro mas viejo
            $minDateValueAvailable = $casosEpidemiController-> getFirstDateRecordscasosEpidemiController();
             ?>

            <input type='date' class='form-control' id='startDateRange' name='startDateRange'
            min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'
            >

            <input type='date' class='form-control' id='endDateRange' name='endDateRange' min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'>

            <input type="hidden" name="actionForAjax" id="actionForAjax"  class='form-control' value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>

           
            <button type="button" class="btn btn-primary" name="requestReportEpi" id="requestReportEpi" value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>
              Solicitar Reporte
            </button>

            </div>
        

          </div>
          

            <div class="card-body" id="card-body">
          </div>



  <script src="<?php echo SERVERURL; ?>view/js/scriptsRequestDataFromBakend.js"></script>

    <!-- para usar botones en datatables JS -->  
    <script src="<?php echo SERVERURL; ?>vendor/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="<?php echo SERVERURL; ?>vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="<?php echo SERVERURL; ?>vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="<?php echo SERVERURL; ?>vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="<?php echo SERVERURL; ?>vendor/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

<script type="text/javascript">
  
    $( document ).ready(function() {

  $('button#requestReportEpi').on('click',function(){
          
        var startDateRange = $('#startDateRange').val();

        var endDateRange = $('#endDateRange').val();

        var actionAjax = $(this).val();


    var dataRequestEpi = 
      'startDateRange='+startDateRange+
      '&endDateRange='+endDateRange+
      '&viewReportEpi='+'true';

              $.ajax({
                url : actionAjax,
                type: 'POST',
                data: dataRequestEpi,
                processData: false,
                contentType:'application/x-www-form-urlencoded',
                enctype: 'multipart/form-data',
                cache: true,

                  success: function (response) {

                  let operationResult = JSON.parse(response);

                 
                  if (typeof operationResult.Alert != 'undefined') {    
                   return ajaxSweetAlerts(operationResult);
                  }

              document.getElementById("card-body").innerHTML = operationResult;

                },error: function (e) {

                var alert = {"Alert":"simple","Title":"Ocurrió un error inesperado","Text":"Por favor recargue la página","Type":"error"};

                return ajaxSweetAlerts(alert);

                }

              });

      $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],'language': LANGUAGE_SPANISH_DATATABLES
  });




  
});

});

</script>