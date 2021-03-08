
<!-- Modal -->
<div class="modal fade" id="backupClouConfig" tabindex="-1" role="dialog" aria-labelledby="backupClouConfigLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="backupClouConfigLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="form-group row">
             <div class="col-sm-4 mb-3 mb-sm-0">


              <select name='typeCloudFor' id='typeCloudFor' class="form-control" class="form-control" required>
                  <option  value=''>Tipo de Nube</option>
                  <option value='2'>Cloud Storage | Google Cloud</option>
                  <option value='2'>Secure cloud storage - Dropbox -v2</option>
                  <option  value='3'>Amazon Simple Storage Service</option>
              </select>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  
        <button class="btn btn-primary btn-user btn-block" type="submit" value="saveCloudBackup" name="save">Actualizar</button>
      </div>
    </div>
  </div>
</div>
