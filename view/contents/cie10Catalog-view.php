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


   <div class='input-table'>
        <div class="form-row">
           
        <div class="col-md-3">
          <input type='text' placeholder = 'Clave Catalogo Minima' class='form-control input-add-table' id='minKeyCIE10' name='minKeyCIE10' value=''>

          <input type='text' placeholder = 'Clave Catalogo Maxima' class='form-control input-add-table' id='maxKeyCIE10' name='maxKeyCIE10' value=''>
            <br>
        </div>

      </div>


        <div class="form-row">

          <div class="col-md-6">


            <!-- start form to limit query-->
          <select name='idCapitulo' id='idCapitulo' class="form-control input-add-table" autocomplete='on' >

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

            <option  value='NO'>OTRAS CAUSAS DE CONSULTA</option>

            <option value="">TODOS</option>
        </select>
            <!-- Final form to limit query-->
  </div>

</div>

   </div>



              <div class='table-responsive-disabled'>

                <table class='table table-bordered table-striped table-striped' id='dataTable' width='100%' cellspacing='0'>

    
    <div class="dt-buttons btn-group flex-wrap"> 

      <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" type="button" id="button-xlsx" value="xlsx"><span>Excel</span>

      <span id="icon-load-xlsx" class="input-group-addon">
      <i class="fas fa-circle-notch fa-spin"></i>
      </span>

      </button> 

      <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" type="button" id="button-csv" value="csv"><span>CSV</span>

      <span id="icon-load-csv" class="input-group-addon">
      <i class="fas fa-circle-notch fa-spin"></i>
      </span>

      </button>

    </div>

    <div class="float-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".moreInfoCatalogCie10">Mas Informacion</button>
    </div>
<br>
    
<br><br>
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
                      <th>NOTIFICACION INMEDIATA</th>
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
                      <th>NOTIFICACION INMEDIATA</th>
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
                      <th>NOTIFICACION INMEDIATA</th>
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

                    <div class="msgBackendProcessDatatable"></div>

                    </tbody>
                </table>
              </div>
           </div>
      </div>
        
      <div>
    <!-- Inicio Modal-->
    
    <!-- Large modal -->

<div class="modal fade moreInfoCatalogCie10" tabindex="-1" role="dialog" aria-labelledby="moreInfoCatalogCie10" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5>INFORMACION DE LOS ATRIBUTOS</h5>
      </div>
    <!-- Inicio de tabla Modal-->

    <table class="table table-bordered table-striped table-striped data-table" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Tipo de Dato</th>
                      <th>Largo</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Tipo de Dato</th>
                      <th>Largo</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>consecutivo</td>
                      <td>Numeros enteros</td>
                      <td>Indefinido</td>
                    </tr>
                    <tr>
                      <td>letra</td>
                      <td>Caracteres de texto</td>
                      <td>1</td>
                    </tr>
                    <tr>
                      <td>llave catalogo</td>
                      <td>Caracteres de texto</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>nombre</td>
                      <td>Caracteres de texto</td>
                      <td>300</td>
                    </tr>
                    <tr>
                      <td>codigox</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>lsex</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>linf</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>lsup</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>trivial</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>

                    <tr>
                      <td>Notificacion Inmediata</td>
                      <td>Compuesto</td>
                      <td>erradicado, n_inter, nin, ninmtobs, notdiaria, sistema_especial, es_suive_notin, es_suive_est_epi, es_suive_est_brote</td>
                    </tr>

                    <tr>
                      <td>erradicado</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>n_inter</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>nin</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>ninmtobs</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>cod_sit_lesion</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>no_cbd</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>cbd</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>no_aph</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>af_prin</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>dia_sis</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>clave_programa_sis</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>cod_complemen_morbi</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>def_fetal_cm</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>def_fetal_cbd</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>clave_capitulo</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>capitulo</td>
                      <td>Caracteres de texto</td>
                      <td>200</td>
                    </tr>
                    <tr>
                      <td>lista1</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>grupo1</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>lista5</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>rubrica_type</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>year_modifi</td>
                      <td>Caracteres de texto</td>
                      <td>150</td>
                    </tr>
                    <tr>
                      <td>year_aplicacion</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>valid</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>prinmorta</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>primorbi</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>lm_morbi</td>
                      <td>Caracteres de texto</td>
                      <td>4</td>
                    </tr>
                    <tr>
                      <td>lm_morta</td>
                      <td>Caracteres de texto</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>lgbd165</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>lomsbeck</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>lgbd190</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>notdiaria</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>notsemanal</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>sistema_especial</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>birmm</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>cve_causa_type</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>causa_type</td>
                      <td>Caracteres de texto</td>
                      <td>50</td>
                    </tr>
                    <tr>
                      <td>epi_morta</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>edas_e_iras_en_m5</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>csve_maternas_seed_epid</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>epi_morta_m5</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>epi_morbi</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>def_maternas</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>es_causes</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>num_causes</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>es_suive_morta</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>es_suive_morb</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>epi_clave</td>
                      <td>Caracteres de texto</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>epi_clave_desc</td>
                      <td>Caracteres de texto</td>
                      <td>120</td>
                    </tr>
                    <tr>
                      <td>es_suive_notin</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>es_suive_est_epi</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>es_suive_est_brote</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>sinac</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>prin_sinac</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>prin_sinac_grupo</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>descripcion_sinac_grupo</td>
                      <td>Caracteres de texto</td>
                      <td>180</td>
                    </tr>
                    <tr>
                      <td>prin_sinac_subgrupo</td>
                      <td>Caracteres de texto</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>descripcion_sinac_subgrupo</td>
                      <td>Caracteres de texto</td>
                      <td>180</td>
                    </tr>
                    <tr>
                      <td>daga</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    <tr>
                      <td>asterisco</td>
                      <td>Caracteres de texto</td>
                      <td>2</td>
                    </tr>
                    
                  </tbody>
                </table>

                        </div>
          </div>

  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

<script type="text/javascript">

 var load_csv  = document.getElementById("icon-load-csv");
load_csv.style.display = "none";

 var load_xlsx  = document.getElementById("icon-load-xlsx");
load_xlsx.style.display = "none";
  

    var url = $('#actionForAjax').val();

  $( document ).ready(function() {


requestQueryByActionToAction();

function TimerGetDataCIE10CatalogForDataTables(url,parameterPreGetDataTables){

let timerID;

  window.clearTimeout(timerID);
  
  return timerID = setTimeout(() => {
   console.log(parameterPreGetDataTables);
   getDataCIE10CatalogForDataTables(url,parameterPreGetDataTables);

  window.clearTimeout(timerID);

  }, 1500);
}

async function requestQueryByActionToAction(){


    var url = $('#urlToRequestQuery').val();


$('#minKeyCIE10,#maxKeyCIE10').on('keyup', function () {


    var minKeyCIE10  = $('#minKeyCIE10').val();
    var maxKeyCIE10 = $('#maxKeyCIE10').val();
    var idCapitulo  = $('#idCapitulo').val();


   var parameterPreGetDataTables =
    '&minKeyCIE10='+minKeyCIE10+
    '&maxKeyCIE10='+maxKeyCIE10+
    '&idCapitulo='+idCapitulo;

      var valueSearch=$(this).val();

if (!isBlank(minKeyCIE10) && !isBlank(maxKeyCIE10) && minKeyCIE10.length > 2 && maxKeyCIE10.length > 2  || isBlank(minKeyCIE10) && isBlank(maxKeyCIE10)) {

  return TimerGetDataCIE10CatalogForDataTables(url,parameterPreGetDataTables);

}  

});


$('#idCapitulo').change(function() {

    var minKeyCIE10  = $('#minKeyCIE10').val();
    var maxKeyCIE10 = $('#maxKeyCIE10').val();
    var idCapitulo  = $('#idCapitulo').val();

   var parameterPreGetDataTables =
    '&minKeyCIE10='+minKeyCIE10+
    '&maxKeyCIE10='+maxKeyCIE10+
    '&idCapitulo='+idCapitulo;

return setTimeout(function(){getDataCIE10CatalogForDataTables(url,parameterPreGetDataTables);}, 1000);


});


    var idCapitulo  = $('#idCapitulo').val();

   var parameterPreGetDataTables =
    '&idCapitulo='+idCapitulo;

    return getDataCIE10CatalogForDataTables(url,parameterPreGetDataTables);

}




    let buttons_export = document.getElementsByClassName("buttons-html5");

    for(let  btn of buttons_export) {
      btn.addEventListener("click", exportCatalogCIE10);
    }

  async function exportCatalogCIE10(e){


  var method = "POST";
  var action = server_url+'ajax/cie10DataAjax.php';

var typeArchive = this.value;

var data = 
  'exportCatalogCIE10=true&typeArchive='+typeArchive;

 var load_archive  = document.getElementById("icon-load-"+typeArchive);
load_archive.style.display = "inline";

 await $.ajax({
      type:'POST',
      url: server_url+'ajax/cie10DataAjax.php',
      data:{
      'exportCatalogCIE10':true,
      'typeArchive':typeArchive},

        success:function(response) {
                console.log(response);
        
              var fileData = JSON.parse(response);
            var a = document.createElement('a');
            var url = fileData.filePath;
            a.href = url;
            a.download = fileData.fileName;
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
  
          }

    });

// await sendDataAjax(action,data,method);

load_archive.style.display = "none";

  }

  });

$.fn.dataTable.ext.errMode = 'none';

</script>