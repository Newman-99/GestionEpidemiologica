 
 <!-- Modal For New Refister -->

<div class="modal fade" id="formCasosEpidemiModal" tabindex="-1" role="dialog" aria-labelledby="formCasosEpidemiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formCasosEpidemiModalLabel">Registrar Caso epidemiologico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

   <form class="formAja form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="register" autocomplete="off" name="form_caso_epidemi" id="form_caso_epidemi">
            
    <input type="hidden" name="actionAjaxForCie10" id="actionAjaxForCie10"  class='form-control' value='<?php echo SERVERURL; ?>ajax/cie10DataAjax.php'>

    <input type="hidden" name="id_caso_epidemi" id="id_caso_epidemi"  class='form-control' value=''>

    <input type="hidden" name="id_person_update" id="id_person_update"  class='form-control' value='' >

    <input type="hidden" name="id_nacionalidad_update" id="id_nacionalidad_update"  class='form-control' value='' >

    <input type="hidden" name="doc_identidad_update" id="doc_identidad_update"  class='form-control' value=''>

    <div id="si-exist-person">
       <span>¿Persona Registrada?<input type="checkbox" name="ifExistPerson" id="ifExistPerson" class="form-control form-control-user" value="1">
        </span>
  </div>

    <div id="person_not_ci">
       <span>¿Sin Cedula?<input type="checkbox" name="ifNotHaveIdentityDocument" id="ifNotHaveIdentityDocument" class="form-control form-control-user ifNotHaveIdentityDocument" value="1">
        </span>

  </div>


    <input type="number" name="id_person" id="id_person" class="form-control" placeholder="Id Persona"  required>

    <br>
        <select name='id_nacionalidad' id='id_nacionalidad' class="form-control" required >
            <option  value=''>Nacionalidad</option>
            <option  value='1'>V</option>
            <option value='2'>E</option>
        </select>

    <br>
    <input type="text" name="doc_identidad" id="doc_identidad" class="form-control" placeholder="Cedula"
    pattern="[0-9]{7,9}"
    title="El campo debe poseer entre 7 y 9 cifras numericas"
    required 
    >

	<!-- Solo valido para el form de actualizar // solo test -->
  	<br>
          <select name='idCapituloCIE10' id='idCapituloCIE10' class="form-control" class="form-control">

            <option value="">SELECCIONAR CAPITULOS CIE-10</option>

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

            <!--<option  value='00'>Todos</option>-->

        </select>

    <br>



        <input type="text" name="searchCIE10" id="searchCIE10" class="form-control" placeholder="Buscar (Nombre/Clave) Evento CIE-10">

    <br>

<div class="input-group">
  
    <select name='catalog_key_cie10' id='catalog_key_cie10' class="form-control" class="form-control" required>

            <option value="">Seleciona Capitulo o CIE-10 Buscar Nombre </option>

        </select>

<span id="icon-load" class="input-group-addon">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>


    <br>

<div class="input-group">

    <select name='id_atrib_especial' id='id_atrib_especial' class="form-control" class="form-control" >

            <option value="0">Atributo Especial:  Ninguno </option>

        </select>

<span id="icon-load-atrib-especial" class="input-group-addon">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>

<br>

                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">


       <span>¿Hospitalizada o Referida?<input type="checkbox" name="is_hospital" id="is_hospital" class="form-control" value="1">
        </span>
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">

          <select name='id_tipo_entrada' id='id_tipo_entrada' class="form-control" required>

               <option value=''>Tipo de Entrada</option>
               <option value='1'>Primerizo</option>
               <option value='2'>Susecivo</option>

          </select>
                  </div>
                  
                  </div>                    



<?php
   // los casos no pueden se registrados con fecha dia de manana
   // osea lo maximo es el dia de hpy
        $currentDate = date("Y-m-d");

// Esta vendira siendo la fecha de hoy

       $maxDateAllowed = date("Y-m-d",strtotime($currentDate."- 1 days"));
       //
 ?>

	Fecha de Registro

  	<br>
  	<input type="date" name="fecha_registro" id="fecha_registro" class="form-control" value="<?php //echo $maxDateAllowed; ?>" required>
  	<br>
    <input type="text" name="nombres" id="nombres" class="form-control form-control-person" placeholder="Nombres"  minlength = '2' maxlength = '40' required>

  	<br>
    <input type="text" name="apellidos" id="apellidos" class="form-control form-control-person" placeholder="Apellidos"  minlength = '2' maxlength = '40' required>
  <br>

    <select name='id_genero' id='id_genero' class="form-control form-control-person" required>
       <option value=''>Genero</option>
       <option value='1'>Masculino</option>
       <option value='2'>Femenino</option>
    </select>
<br>
Fecha de Nacimiento
  	<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-person" required>

<br>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">

                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"placeholder="0000" pattern="[0-9]{4}"  title="El campo debe poseer 4 cifras numericas" required >
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2" placeholder="0000" pattern="[0-9]{4}"  title="El campo debe poseer 4 cifras numericas" required  >
                  </div>

                  <div class="col-sm-3">
                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3" placeholder="000" pattern="[0-9]{3}" title="El campo debe poseer 3 cifras numericas" required >
                  </div>
                </div>
<br>
        <select name='id_parroquia' id='id_parroquia' class="form-control" class="form-control" required>
            <option  value=''>Seleccionar Parroquia</option>
        </select>
<br>

    <textarea rows="3" cols="40" name="direccion" id="direccion" class="form-control" placeholder="Direccion" required minlength = '3' maxlength = '200'></textarea>
<br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

     <button class="btn btn-primary btn-user btn-caso-epidemi btn-block" type="submit" value="btn-register-caso-epidemi" name="btn-register-caso-epidemi">Registrar</button>

     <div class="responseProcessAjax"></div>
             
       </form>

      </div>
    </div>
  </div>
</div>
  




  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

      <script type="text/javascript">


        document.getElementById("form_caso_epidemi").addEventListener("submit", sendFormToRegisterOrUpdateCasesEpidemi );

          $( document ).ready(function() {


var load_atrib_especial  = document.getElementById("icon-load-atrib-especial");
load_atrib_especial.style.display = "none";

var load  = document.getElementById("icon-load");
load.style.display = "none";


      $('#idCapituloCIE10').on('change',function(){

load.style.display = "block";

          var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

          var idCapituloCIE10 = $(this).val();

          if(idCapituloCIE10 != ''){
          setCIE10ToFormRegisterCaseEpidemByidCapituloAsync(idCapituloCIE10);
          }else{
       load.style.display = "none";
}

  });


  // Al escribir en el input buscador se mostraran los casos CIE10 correspondientes en el select
  

document.getElementById('searchCIE10').addEventListener('keyup', searchCIE10forPattern);


function searchCIE10forPattern(){

  var timer;

  window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
  timer = window.setTimeout(() => {

  var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

  var idCapituloCIE10 = $('#idCapituloCIE10').val();

  var valueSearch=$('#searchCIE10').val();

//  console.log(valueSearch);


    if (valueSearch!="" && valueSearch.length > 1)
    {
      setCIE10ToFormRegisterCaseEpidemBySearchPatternAsync(valueSearch,idCapituloCIE10,actionAjaxForCie10);
    }
    else{
     load.style.display = "none";

      // si esta vacio llenamos con el cap seleccionado
             setCIE10ToFormRegisterCaseEpidemByidCapituloAsync(idCapituloCIE10);
    }

    load.style.display = "block";

  }, 1000);

}




      $('#catalog_key_cie10').on('change',function(){
      setTimeout(function(){ getEspecialAttributesCIE10()}, 500);

      });
        // llenar select parroquia
  
        var selectParroquia = document.getElementById("id_parroquia");
        var form = document.getElementById('form_caso_epidemi');
        var actionAjaxForCie10 = form.getAttribute("action");
        selectParroquia.addEventListener("focus",getParroquias(actionAjaxForCie10), true);


      });



</script>

