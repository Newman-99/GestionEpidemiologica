  <script src="<?php echo SERVERURL; ?>view/js/changeLanguageDatatables.js">

  </script>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Catatlogo CIE-10</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->


        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>Lista de Usuarios</h6>
            </div>

          <input type="hidden" name="urlToRequestQuery" id="urlToRequestQuery"  class='form-control' value='<?php echo SERVERURL; ?>ajax/cie10DataAjax.php'>

            <div class='card-body'>
              <div class='table-responsive'>

                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>CONSECUTIVO</th>
                      <th>LETRA</th>
                      <th>CATALOG_KEY</th>
                      <th>NOMBRE</th>
                      <th>CODIGOX</th>
                      <th>LSEX</th>
                      <th>LINF</th>
                      <th>LSUP</th>
                      <th>TRIVIAL</th>
                      <th>ERRADICADO</th>
                      <th>N_INTER</th> 
                      <th>NIN</th> 
                      <th>NINMTOBS</th> 
                      <th>COD_SIT_LESION</th> 
                      <th>NO_CBD</th> 
                      <th>CBD</th> 
                      <th>NO_APH</th> 
                      <th>AF_PRIN</th> 
                      <th>DIA_SIS</th> 
                      <th>CLAVE_PROGRAMA_SIS</th> 
                      <th>COD_COMPLEMEN_MORBI</th> 
                      <th>DEF_FETAL_CM</th> 
                      <th>DEF_FETAL_CBD</th> 
                      <th>CLAVE_CAPITULO</th> 
                      <th>CAPITULO</th> 
                      <th>LISTA1</th> 
                      <th>GRUPO1</th> 
                      <th>LISTA5</th> 
                      <th>RUBRICA_TYPE</th> 
                      <th>YEAR_MODIFI</th> 
                      <th>YEAR_APLICACION</th> 
                      <th>VALID</th> 
                      <th>PRINMORTA</th> 
                      <th>PRINMORBI</th> 
                      <th>LM_MORBI</th> 
                      <th>LM_MORTA</th> 
                      <th>LGBD165</th> 
                      <th>LOMSBECK</th> 
                      <th>LGBD190</th> 
                      <th>NOTDIARIA</th> 
                      <th>NOTSEMANAL</th> 
                      <th>SISTEMA_ESPECIAL</th> 
                      <th>BIRMM</th> 
                      <th>CVE_CAUSA_TYPE</th> 
                      <th>CAUSA_TYPE</th> 
                      <th>EPI_MORTA</th> 
                      <th>EDAS_E_IRAS_EN_M5</th> 
                      <th>CSVE_MATERNAS_SEED_EPID</th> 
                      <th>EPI_MORTA_M5</th> 
                      <th>EPI_MORBI</th> 
                      <th>DEF_MATERNAS</th> 
                      <th>ES_CAUSES</th> 
                      <th>NUM_CAUSES</th> 
                      <th>ES_SUIVE_MORTA</th> 
                      <th>ES_SUIVE_MORB</th> 
                      <th>EPI_CLAVE</th> 
                      <th>EPI_CLAVE_DESC</th> 
                      <th>ES_SUIVE_NOTIN</th> 
                      <th>ES_SUIVE_EST_EPI</th> 
                      <th>ES_SUIVE_EST_BROTE</th> 
                      <th>SINAC</th> 
                      <th>PRIN_SINAC</th> 
                      <th>PRIN_SINAC_GRUPO</th> 
                      <th>DESCRIPCION_SINAC_GRUPO</th> 
                      <th>PRIN_SINAC_SUBGRUPO</th> 
                      <th>DESCRIPCION_SINAC_SUBGRUPO</th> 
                      <th>DAGA</th> 
                      <th>ASTERISCO</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>CONSECUTIVO</th>
                      <th>LETRA</th>
                      <th>CATALOG_KEY</th>
                      <th>NOMBRE</th>
                      <th>CODIGOX</th>
                      <th>LSEX</th>
                      <th>LINF</th>
                      <th>LSUP</th>
                      <th>TRIVIAL</th>
                      <th>ERRADICADO</th>
                      <th>N_INTER</th> 
                      <th>NIN</th> 
                      <th>NINMTOBS</th> 
                      <th>COD_SIT_LESION</th> 
                      <th>NO_CBD</th> 
                      <th>CBD</th> 
                      <th>NO_APH</th> 
                      <th>AF_PRIN</th> 
                      <th>DIA_SIS</th> 
                      <th>CLAVE_PROGRAMA_SIS</th> 
                      <th>COD_COMPLEMEN_MORBI</th> 
                      <th>DEF_FETAL_CM</th> 
                      <th>DEF_FETAL_CBD</th> 
                      <th>CLAVE_CAPITULO</th> 
                      <th>CAPITULO</th> 
                      <th>LISTA1</th> 
                      <th>GRUPO1</th> 
                      <th>LISTA5</th> 
                      <th>RUBRICA_TYPE</th> 
                      <th>YEAR_MODIFI</th> 
                      <th>YEAR_APLICACION</th> 
                      <th>VALID</th> 
                      <th>PRINMORTA</th> 
                      <th>PRINMORBI</th> 
                      <th>LM_MORBI</th> 
                      <th>LM_MORTA</th> 
                      <th>LGBD165</th> 
                      <th>LOMSBECK</th> 
                      <th>LGBD190</th> 
                      <th>NOTDIARIA</th> 
                      <th>NOTSEMANAL</th> 
                      <th>SISTEMA_ESPECIAL</th> 
                      <th>BIRMM</th> 
                      <th>CVE_CAUSA_TYPE</th> 
                      <th>CAUSA_TYPE</th> 
                      <th>EPI_MORTA</th> 
                      <th>EDAS_E_IRAS_EN_M5</th> 
                      <th>CSVE_MATERNAS_SEED_EPID</th> 
                      <th>EPI_MORTA_M5</th> 
                      <th>EPI_MORBI</th> 
                      <th>DEF_MATERNAS</th> 
                      <th>ES_CAUSES</th> 
                      <th>NUM_CAUSES</th> 
                      <th>ES_SUIVE_MORTA</th> 
                      <th>ES_SUIVE_MORB</th> 
                      <th>EPI_CLAVE</th> 
                      <th>EPI_CLAVE_DESC</th> 
                      <th>ES_SUIVE_NOTIN</th> 
                      <th>ES_SUIVE_EST_EPI</th> 
                      <th>ES_SUIVE_EST_BROTE</th> 
                      <th>SINAC</th> 
                      <th>PRIN_SINAC</th> 
                      <th>PRIN_SINAC_GRUPO</th> 
                      <th>DESCRIPCION_SINAC_GRUPO</th> 
                      <th>PRIN_SINAC_SUBGRUPO</th> 
                      <th>DESCRIPCION_SINAC_SUBGRUPO</th> 
                      <th>DAGA</th> 
                      <th>ASTERISCO</th>                    
                    </tr>
                  </tfoot>
                  <tbody>


                    </tbody>
                </table>
              </div>
           </div>
      </div>
        

                        </div>
          </div>

  <script src="<?php echo SERVERURL; ?>view/js/querysFieldsForTables.js"></script>

<script type="text/javascript">
  
    $( document ).ready(function() {

return queryFieldsToDataTablesCie10Catalog();    

});


</script>