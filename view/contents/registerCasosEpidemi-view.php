        <!-- Page Heading -->
 
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 mb-2 text-gray-800">Seguridad</h1>
              </div>

 <h1 class="h3 mb-4 text-gray-800">Registrar Caso Epidemiologico</h1>
 
   <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="POST" data-form="register" autocomplete="off">
            

    <input type="hidden" name="urlAjax" id="urlAjax"  class='form-control' value='<?php echo SERVERURL; ?>ajax/cie10DataAjax.php'>


       <span alt="¿La person ya ha sido registrada como paciente o usuario?">¿person ya registrada?<input type="checkbox" name="siExistPerson" id="siExistPerson" class="form-control form-control-user" value="1">  
        </span>



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

    <input type="text" name="searchCIE10" id="searchCIE10" class="form-control" placeholder="Buscar Nombre del Caso CIE-10">
  
    <select name='catalogKeyCIE10' id='catalogKeyCIE10' class="form-control" autocomplete='on' class="form-control" >

            <option value="">Selecionar Capitulo  o CIE-10 Buscar Nombre </option>

        </select>

<?php 
   // los casos no pueden se registrados con fecha dia de manana
   // osea lo maximo es el dia de hpy

          $currentDate = date("d-m-Y");

// Esta vendira siendo la fecha de hoy
           $todayDate = date("Y-m-d",strtotime($currentDate));
 ?>

	Fecha de Registro
  	<br>
    <input type="date" name="dateRegisterCasoEpidemi" id="dateRegisterCasoEpidemi" class="form-control" placeholder="Fecha de Registro" max="<?php echo $todayDate; ?>">

  	<br>
    <input type="text" name="nombres" id="" class="form-control form-control-person" placeholder="Nombres" value="">

  	<br>
    <input type="text" name="apellidos" id="" class="form-control form-control-person" placeholder="Apellidos">
<br>
        <select name='id_nacionalidad' id='' class="form-control" autocomplete='on' class="form-control" >
            <option  value=''>Nacionalidad</option>
            <option  value='1'>V</option>
            <option value='2'>E</option>
        </select>

  	<br>
    <input type="number" name="doc_identidad" id="" class="form-control" placeholder="Cedula">
  <br>
    <select name='id_genero' id='' class="form-control form-control-person">
       <option value=''>Genero</option>
       <option value='1'>Masculino</option>
       <option value='2'>Femenino</option>
    </select>
<br>
Fecha de Nacimiento
  	<input type="date" name="fecha_nacimiento" id="" class="form-control form-control-person" placeholder="">

<br>
                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">

                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"  placeholder="0000">
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2"  placeholder="0000">
                  </div>

                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3"  placeholder="000">
                  </div>
                </div>
<br>
  	<input type="number" name="id_parroquia" id="" class="form-control" placeholder="Parroquia">
<br>
    <textarea rows="3" cols="40" name="direccion" id="" class="form-control" placeholder="Direccion"></textarea>
<br>

     <button class="btn btn-primary btn-user btn-block" type="submit" value="registerCasoEpidemi" name="registerCasoEpidemi">Registrar</button>

     <div class="responseProcessAjax"></div>
              </form>

              </div>
            </div>
          </div>
        </div>
      </div>


  <script src="<?php echo SERVERURL; ?>view/js/scriptsRequestDataFromBakend.js"></script>

      <script type="text/javascript">

          $( document ).ready(function() {

      // Establecer fecha de registro en input
      
      // la fecha recomendada de registro de casos, es del dia de ayer, pero e ocaciones puede ser cambiada  
      var todayDate = new Date;


      var dateRegisterDefault = addOrRemoveDaysToDate(todayDate,1,false);

      var dateRegisterDefaultPHP = dateRegisterDefault.toISOString().split('T')[0];

      $('#dateRegisterCasoEpidemi').val(dateRegisterDefaultPHP);


      var rangeDateRegisterMax = addOrRemoveDaysToDate(todayDate,1,true);

  });

  // Al seleccionar un capitulo CIE10 se mostraran los casos CIE10 correspondientes en el select dinamico


      $('#idCapituloCIE10').on('change',function(){

          var urlAjax = $('#urlAjax').val();

          var idCapituloCIE10 = $(this).val();

          if(idCapituloCIE10 != ''){
          getCasesCIE10ByidCapitulo(idCapituloCIE10,urlAjax);
          }
      });

  
  // Al escribir en el input buscador se mostraran los casos CIE10 correspondientes en el select dinamico
   
  $(document).on('keyup', '#searchCIE10', function()
{

  var urlAjax = $('#urlAjax').val();

  var idCapituloCIE10 = $('#idCapituloCIE10').val();


  var valueSearch=$(this).val();

    if (valueSearch!="")
    {
      getCasesCIE10BySearchPattern(valueSearch,idCapituloCIE10,urlAjax)
    }
    else
    {
      // si esta vacio llenamos con el cap seleccionado
      getCasesCIE10ByidCapitulo();
    }


});

</script>

