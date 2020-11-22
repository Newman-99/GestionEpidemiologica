  <script src="<?php echo SERVERURL; ?>view/js/changeLanguageDatatables.js">

  </script>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Catalogo CIE-10</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->


        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>Lista de Casos CIE-10</h6>
            </div>

          <input type="hidden" name="urlToRequestQuery" id="urlToRequestQuery"  class='form-control' value='<?php echo SERVERURL; ?>ajax/cie10DataAjax.php'>

            <div class='card-body'>
              <div class='table-responsive'>

                <table class='table table-bordered table-striped table-striped' id='dataTable' width='100%' cellspacing='0'>

            <!-- start form to limit query-->
          <select name='idCapitulo' id='idCapitulo' class="form-control" autocomplete='on' class="form-control" >

            <option  value='01'>I CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS</option>

            <option  value='02'>II TUMORES (NEOPLASIAS)</option>

            <option  value='03'>III ENFERMEDADES DE LA SANGRE Y DE LOS ORGANOS HEMATOPOYETICOS, Y CIERTOS TRASTORNOS QUE AFECTAN EL MECANISMO DE LA INMUNIDAD</option>

            <option  value='04'>IV ENFERMEDADES ENDOCRINAS, NUTRICIONALES Y METABOLICAS</option>

            <option  value='05'>V TRASTORNOS MENTALES Y DEL COMPORTAMIENTO</option>

            <option  value='06'>VI ENFERMEDADES DEL SISTEMA NERVIOSO</option>

            <option  value='07'>VII ENFERMEDADES DEL OJO Y SUS ANEXOS</option>

            <option  value='08'>VIII ENFERMEDADES DE OIDO Y DE LA APOFISIS MASTOIDES</option>

            <option  value='09'>IX ENFERMEDADES DEL SISTEMA CIRCULATORIO</option>

            <option  value='10'>X  ENFERMEDADES DEL SISTEMA RESPIRATORIO</option>

            <option  value='11'>XI ENFERMEDADES DEL SISTEMA DIGESTIVO</option>

            <option  value='12'>XII ENFERMEDADES DE LA PIEL Y DEL TEJIDO SUBCUTANEO</option>

            <option  value='13'>XIII ENFERMEDADES DEL SISTEMA OSTEOMUSCULAR Y DEL TEJIDO CONJUNTIVO</option>

            <option  value='14'>XIV ENFERMEDADES DEL SISTEMA GENITOURINARIO</option>

            <option  value='15'>XV EMBARAZO, PARTO Y PUERPERIO</option>

            <option  value='16'>XVI CIERTAS AFECCIONES ORIGINADAS EN EL PERIODO PERINATAL</option>

            <option  value='17'>XVII MALFORMACIONES CONGENITAS, DEFORMIDADES Y ANOMALIAS CROMOSOMICAS</option>

            <option  value='18'>XVIII SINTOMAS, SIGNOS Y HALLAZGOS ANORMALES CLINICOS Y DE LABORATORIO, NO CLASIFICADOS EN OTRA PARTE</option>

            <option  value='19'>XIX TRAUMATISMOS, ENVENENAMIENTOS Y ALGUNAS OTRAS CONSECUENCIAS DE CAUSAS EXTERNAS</option>

            <option  value='22'>XXII CAUSAS PARA PROPOSITOS ESPECIALES</option>

            <option  value='20'>XX CAUSAS EXTERNAS DE MORBILIDAD Y MORTALIDAD</option>

            <option  value='21'>XXI FACTORES QUE INFLUYEN EN EL ESTADO DE SALUD Y CONTACTO CON LOS SERVICIOS DE SALUD</option>
            <option  value='N/A'>N/A</option>

            <option  value='NO'>NO</option>

            <option value="">Todos</option>
        </select>
            <!-- Final form to limit query-->
<br>
    
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

  <script src="<?php echo SERVERURL; ?>view/js/scriptsRequestDataFromBakend.js"></script>

<script type="text/javascript">
  
    $( document ).ready(function() {

//return getDataCIE10CatalogForDataTables();    

});


  $( document ).ready(function() {
 
requestQueryByActionToAction();

function requestQueryByActionToAction(){

    var url = $('#urlToRequestQuery').val();

$('#idCapitulo').change(function() {
    var idCapitulo  = $('#idCapitulo').val();

      return getDataCIE10CatalogForDataTables(url,idCapitulo);


})

// si no se dio click pero si se actualizo;

    var idCapitulo  = $('#idCapitulo').val();

      return getDataCIE10CatalogForDataTables(url,idCapitulo);

}

  });


</script>