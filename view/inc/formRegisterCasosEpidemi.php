 
 <!-- Modal For New Refister -->

<div class="modal fade" id="registerCasosEpidemiModal" tabindex="-1" role="dialog" aria-labelledby="registerCasosEpidemiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerCasosEpidemiModalLabel">Registrar Caso epidemiologico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

   <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="register" autocomplete="off" name="formAjax" id="formAjax">
            
    <input type="hidden" name="actionAjaxForCie10" id="actionAjaxForCie10"  class='form-control' value='<?php echo SERVERURL; ?>ajax/cie10DataAjax.php'>

    <input type="hidden" name="id_caso_epidemi" id="id_caso_epidemi"  class='form-control' value=''>

    <input type="hidden" name="id_nacionalidad_update" id="id_nacionalidad_update"  class='form-control' value=''>

    <input type="hidden" name="doc_identidad_update" id="doc_identidad_update"  class='form-control' value=''>

    <div id="si-exist-person">

       <span alt="¿La person ya ha sido registrada como paciente o usuario?">¿person ya registrada?<input type="checkbox" name="siExistPerson" id="siExistPerson" class="form-control form-control-user" value="1">  
        </span>

  </div>


    <br>
        <select name='id_nacionalidad' id='id_nacionalidad' class="form-control" autocomplete='on' class="form-control" >
            <option  value=''>Nacionalidad</option>
            <option  value='1'>V</option>
            <option value='2'>E</option>
        </select>

    <br>
    <input type="number" name="doc_identidad" id="doc_identidad" class="form-control" placeholder="Cedula">

	<!-- Solo valido para el form de actualizar // solo test -->	
  	<br>
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

    <br>

    <input type="text" name="searchCIE10" id="searchCIE10" class="form-control" placeholder="Buscar Nombre del Caso CIE-10">

    <br>
  
    <select name='catalogKeyCIE10' id='catalogKeyCIE10' class="form-control" autocomplete='on' class="form-control" >

            <option value="">Selecionar Capitulo  o CIE-10 Buscar Nombre </option>

        </select>

<?php 
   // los casos no pueden se registrados con fecha dia de manana
   // osea lo maximo es el dia de hpy
        $currentDate = date("d-m-Y");

// Esta vendira siendo la fecha de hoy

       $maxDateAllowed = date("Y-m-d",strtotime($currentDate."- 1 days"));

       $minDateAllowed = date("Y-m-d",strtotime($maxDateAllowed."- 7 days"));
          
 ?>

	Fecha de Registro
  	<br>
    <input type="date" name="fecha_registro" id="fecha_registro" class="form-control" placeholder="Fecha de Registro" max="<?php echo $maxDateAllowed; ?>" min="">

  	<br>
    <input type="text" name="nombres" id="nombres" class="form-control form-control-person" placeholder="Nombres" value="">

  	<br>
    <input type="text" name="apellidos" id="apellidos" class="form-control form-control-person" placeholder="Apellidos">
  <br>

    <select name='id_genero' id='id_genero' class="form-control form-control-person" autocomplete='on'>
       <option value=''>Genero</option>
       <option value='1'>Masculino</option>
       <option value='2'>Femenino</option>
    </select>
<br>
Fecha de Nacimiento
  	<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-person">

<br>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">

                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"placeholder="0000">
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2" placeholder="0000">
                  </div>

                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3" placeholder="000">
                  </div>
                </div>
<br>
        <select name='id_parroquia' id='id_parroquia' class="form-control" autocomplete='on' class="form-control" >
            <option  value=''>Seleccionar Parroquia</option>
        </select>
<br>

    <textarea rows="3" cols="40" name="direccion" id="direccion" class="form-control" placeholder="Direccion"></textarea>
<br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

     <button class="btn btn-primary btn-user btn-caso-epidemi btn-block" type="submit" value="btn-caso-epidemi" name="btn-caso-epidemi">Registrar</button>

     <div class="responseProcessAjax"></div>
             
       </form>

      </div>
    </div>
  </div>
</div>
  



  <script src="<?php echo SERVERURL; ?>view/js/scriptsRequestDataFromBakend.js"></script>

      <script type="text/javascript">

          $( document ).ready(function() {

  
//      var actionAjaxForCie10 = $('#formAjax').getAttribute("action");

      $('#idCapituloCIE10').on('change',function(){

          var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

          var idCapituloCIE10 = $(this).val();

          if(idCapituloCIE10 != ''){
          getCasesCIE10ByidCapitulo(idCapituloCIE10,actionAjaxForCie10);
          }

  });


  // Al seleccionar un capitulo CIE10  los casos correspondientes en el select

      $('#idCapituloCIE10').on('change',function(){

          var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

          var idCapituloCIE10 = $(this).val();

          if(idCapituloCIE10 != ''){
          getCasesCIE10ByidCapitulo(idCapituloCIE10,actionAjaxForCie10);
          }
      });



  // Al escribir en el input buscador se mostraran los casos CIE10 correspondientes en el select
  
var timeForRequestSearch = "";

  $(document).on('keyup', '#searchCIE10', function(){

    clearTimeout(timeForRequestSearch);   

  var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

  var idCapituloCIE10 = $('#idCapituloCIE10').val();

  var valueSearch=$(this).val();

    if (valueSearch!="")
    {
        timeForRequestSearch = setTimeout(function(){ getCasesCIE10BySearchPattern(valueSearch,idCapituloCIE10,actionAjaxForCie10); }, 2000);
    }
    else
    {
      // si esta vacio llenamos con el cap seleccionado
             getCasesCIE10ByidCapitulo();
    }


});

        // llenar select parroquia
  
        var selectParroquia = document.getElementById("id_parroquia");
        var form = document.getElementById('formAjax');
        var actionAjaxForCie10 = form.getAttribute("action");
        selectParroquia.addEventListener("focus",getParroquias(actionAjaxForCie10), true);


      });



</script>

