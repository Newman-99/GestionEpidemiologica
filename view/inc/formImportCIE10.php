
<!-- Modal -->
<div class="modal modalAjax fade" id="importCIE10Modal" tabindex="-1" role="dialog" aria-labelledby="importCIE10Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importCIE10Modal">Importar Catalogo CIE-10</h5>
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

                    <p class="mb-4">El catalogo CIE-10 que se subira sobreescribira al actual, por lo se debe verificar los datos correctamente y debe asegurarse si este proceso es necesario.
                    </p>

                    <p class="mb-4">Asegurese de convertir solo una hoja del archivo de Hojas de Calculo con los casos CIE-10 a un archivo CSV. 
                    </p>

                    <p class="mb-4">La Primera fila del archivo se obviara ya que deberia ser un encabezado. 
                    </p>

   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/cie10DataAjax.php" method="POST" data-form="files" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group" id="importCIE10Modal">
                  <label for="">Elegir Archivo CSV:</label>
                    <input type="file" class="form-control input-files" id="fileCSVCIE10" name="fileCSVCIE10" accept=".csv">
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
        <button type="button" id="importCIE10Modal" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-block" type="submit" value="updateCIE10" name="update">Importar</button>
      </div>
     </form>

    </div>
  </div>
</div>
