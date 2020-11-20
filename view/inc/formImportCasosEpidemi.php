
<!-- Modal -->
<div class="modal fade" id="importCasosEpidemiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Casos Epidemiologicos</h5>
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

   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="files" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group" id="update-cie-10">
                  <label for="">Elegir Archivo CSV:</label>
                    <input type="file" class="form-control" id="fileCSVImportCaseEpidemi" name="fileCSVImportCaseEpidemi" accept=".csv">
              </div>

      
     <div class="responseProcessAjax"></div>

    <div id="msgBackendProcessAjaxData"></div>

              </form>
    <div id="btnInsertCancelAjax"></div>


              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="updateCIE10" name="update">Actualizar</button>
      </div>
    </div>
  </div>
</div>