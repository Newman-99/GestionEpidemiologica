
<!-- Modal -->
<div class="modal modalAjax fade" id="backupModal" tabindex="-1" role="dialog" aria-labelledby="backupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="backupModal">Respaldo de la Base de Datos</h5>
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

                  <a href="./model/dptoEmidemi.sql" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Obtener Copia de Seguridad</span>
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
        <button type="button" id="importBackup" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
      </div>
     </form>

    </div>
  </div>
</div>
