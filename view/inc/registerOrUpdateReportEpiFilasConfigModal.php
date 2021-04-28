<!-- Modal -->
<div class="modal modalAjax fade" id="registerOrUpdateReportEpiFilasConfigModal" tabindex="-1" role="dialog" aria-labelledby="registerOrUpdateReportEpiFilasConfigModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerOrUpdateReportEpiFilasConfigModal">Registrar Configuracion Reporte EPI</h5>
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

   <form class="formAjax form-group text-center" action="<?php echo SERVERURL; ?>ajax/reportsEpiAjax.php" method="POST" data-form="register" autocomplete="off" name="formReportEpiFilasConfigModal" id="formReportEpiFilasConfigModal">
            
    <input type="hidden" name="nro_fila_report_for_configs" id="nro_fila_report_for_configs"  class='form-control' value=''>

    <input type="hidden" name="id_config_epi" id="id_config_epi"  class='form-control' value=''>

<div class="inputs-group-cie10">
         
          Datos CIE-10 Inicio

      <!--
          <select name='idCapituloCIE10Inicio' id='idCapituloCIE10Inicio' class="form-control">

            <option value="">SELECCIONAR CAPITULOS CIE-10 Inicio</option>

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
    <br>
-->


              <input type="text" name="searchCIE10Inicio" id="searchCIE10Inicio" class="form-control" placeholder="Buscar (Clave) Evento CIE-10 Final Inicio">

          <br>

      <div class="input-group">
        
          <select name='consecutivo_cie10_inicio' id='consecutivo_cie10_inicio' class="form-control consecutivo_cie10" requireds >

                  <option value="">Seleccionar Evento CIE 10 Inicio</option>

              </select>

      <span id="icon-load-inicio" class="input-group-addon">
      <i class="fas fa-circle-notch fa-spin"></i>
      </span>

      </div>


          <br>

      <div class="input-group">

          <select name='id_atrib_especial_inicio' id='id_atrib_especial_inicio' class="form-control rango_atrib_especial" >

                  <option value="0">Atributo Especial: Ninguno </option>

              </select>

      <span id="icon-load-atrib-especial-inicio" class="input-group-addon icon-load-atrib-especial">
      <i class="fas fa-circle-notch fa-spin"></i>
      </span>

      </div>

</div>


    <br>

<div class="inputs-group-cie10">

          Datos CIE-10 FINAL
    
    <br>
        <input type="text" name="searchCIE10Final" id="searchCIE10Final" class="form-control" placeholder="Buscar (Clave) Evento CIE-10 Final Final">

    <br>

<div class="input-group">
  
    <select name='consecutivo_cie10_final' id='consecutivo_cie10_final' class="form-control consecutivo_cie10" requireds >

            <option value="">Seleccionar Evento CIE 10 Final </option>

        </select>

<span id="icon-load-final" class="input-group-addon">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>


    <br>

<div class="input-group">

    <select name='id_atrib_especial_final' id='id_atrib_especial_final' class="form-control rango_atrib_especial" >

            <option value="0">Atributo Especial: Ninguno </option>

        </select>

<span id="icon-load-atrib-especial-final" class="input-group-addon icon-load-atrib-especial">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>

</div>

<br>


                  <!--

          Otros Datos EPI
          
    <br>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name='is_hospital_report_epi' id='is_hospital_report_epi' class="form-control" requireds >
                         <option value=''>¿Hospitalizada o Referida?</option>
                         <option value='0'>Si</option>
                         <option value='1'>No</option>
                         <option value='3'>Ambos</option>

                    </select>
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select name='id_tipo_entrada_report_epi' id='id_tipo_entrada_report_epi' class="form-control" requireds >
                         <option value=''>Tipo de Entrada</option>
                         <option value='1'>Primerizo</option>
                         <option value='2'>Susecivo</option>
                         <option value='3'>Ambos</option>

                    </select>
                  </div>
                  <br>
                  <br>
                  <br>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name='edad_inicio' id='edad_inicio' class="form-control" placeholder="Edad Inicio" requireds >
                  </div>



                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name='edad_final' id='edad_final' class="form-control" placeholder="Edad Final" requireds >
                  </div>

                  </div>                    

                  -->

     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="registerOrupdateReportEpiFilasConfigCancel" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="btnRegisterOrupdateReportEpiFilasConfig" id="btnRegisterOrupdateReportEpiFilasConfig" name="btnRegisterOrupdateReportEpiFilasConfig">Registrar</button>
      </div>
     </form>

    </div>
  </div>
</div>

  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

      <script type="text/javascript">



          $( document ).ready(function() {



      });





</script>

