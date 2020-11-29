
<!-- Modal -->
<div class="modal modalAjax fade" id="importCasosEpidemiModal" tabindex="-1" role="dialog" aria-labelledby="importCasosEpidemiModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importCasosEpidemiModal">Importar Casos Epidemiologicos</h5>
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

   <form class="formAjax formFileCSVImportCaseEpidemi form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="files" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group" id="importCasosEpidemiModal">
                  <label for="">Elegir Archivo CSV:</label>
                    <input type="file" class="form-control input-files" id="fileCSVImportCaseEpidemi" name="fileCSVImportCaseEpidemi" accept=".csv">
              </div>

      
     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

    <div id="btnInsertCancelAjax"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="importCasosEpidemiCancel" class=" buttonCancelAjax btn btn-secondary" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="import" name="import">Importar</button>
      </div>
     </form>

    </div>
  </div>
</div>
