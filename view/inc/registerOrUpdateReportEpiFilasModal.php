<!-- Modal -->
<div class="modal modalAjax fade" id="registerOrUpdateReportEpiFilasModal" tabindex="-1" role="dialog" aria-labelledby="registerOrUpdateReportEpiFilasModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerOrUpdateReportEpiFilasModal">Registrar: Fila Reporte EPI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">

   <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/reportsEpiAjax.php" method="POST" data-form="register" autocomplete="off" enctype="multipart/form-data" id="registerOrUpdateReportEpiFilas"	>

                    <div class="form-group">

                  <input type="hidden" class="form-control" id="nro_fila_report_original" name="nro_fila_report_original" placeholder="Nro de Fila"
                  required
                  >

                  <input type="text" class="form-control" id="nro_fila_report" name="nro_fila_report" placeholder="Nro de Fila"
                  required
                  >
                  <br>
                  <input type="text" class="form-control" id="enfermedad_evento" name="enfermedad_evento" placeholder="Enfermedad Evento"
                  required
                  minlength = '2' maxlength = '100'  
                  >
                    </div>

     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="registerOrupdateReportEpiFilasCancel" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="btnRegisterOrupdateReportEpiFilas" id="btnRegisterOrupdateReportEpiFilas" name="btnRegisterOrupdateReportEpiFilas">Registrar</button>
      </div>
     </form>

    </div>
  </div>
</div>
