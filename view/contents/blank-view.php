
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

   <form class="formAja form-group text-center user" action="<?php echo SERVERURL; ?>ajax/cie10DataAjax.php" method="POST" data-form="getCasesCIE10" autocomplete="off">

          <select name='idCapituloCIE10' id='idCapituloCIE10' class="form-control" autocomplete='on' class="form-control" >

            <option value="">Seleccionar Capitulos CIE-10</option>

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

            <!--<option  value='00'>Todos</option>-->

        </select>


     <button class="btn btn-primary btn-user btn-block" type="submit" value="registercasoEpidemi" name="registercasoEpidemi">Registrar</button>

     <div class="responseProcessAjax"></div>
              </form>
