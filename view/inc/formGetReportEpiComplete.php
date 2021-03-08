
<!-- Modal -->
<div class="modal modalAjax fade" id="getReportEpiCompleteModal" tabindex="-1" role="dialog" aria-labelledby="getReportEpiCompleteModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="getReportEpiCompleteModal">Reporte EPI Completo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">


   <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="report" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group" id="">

                  <label for="">Fecha inicial del año:</label>
                
          <input type='date' class='form-control' id='initialDate' name='initialDate'>

              </div>

                  <a href="#" target="" class="btn btn-secondary btn-icon-split" id="reportEpiComplete" name="reportEpiComplete" download="">
                    <span class="icon text-white-50">
                      <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Obtener Reporte EPI</span>
                  </a>

     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        
       <button class="btn btn-primary btn-block" type="submit" value="btnReportEpiComplete" name="btnReportEpiComplete" id="btnReportEpiComplete">Solicitar</button>

        <button type="button" id="btnReportEpiCancel" class=" buttonCancelAjax btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>

    </form>
  </div>
</div>

<script type="text/javascript">


  document.getElementById("btnReportEpiComplete").addEventListener("click", function( event ) {

      $('#reportEpiComplete').removeClass('btn-success');

      $('#reportEpiComplete').addClass('btn-secondary');

    var elementAtribute = document.getElementById('reportEpiComplete');
    
    elementAtribute.setAttribute('href',''); 

  }, false);

    $("#getReportEpiComplete").on('hidden.bs.modal', function () {

      $('#reportEpiComplete').removeClass('btn-success');

      $('#reportEpiComplete').addClass('btn-secondary');

    var elementAtribute = document.getElementById('reportEpiComplete');
    
    elementAtribute.setAttribute('href',''); 

    elementAtribute.setAttribute('download',''); 

      });

  document.getElementById("btnReportEpiCancel").addEventListener("click", function( event ) {

      $('.formAjax').trigger("reset");
  }, false);


</script>