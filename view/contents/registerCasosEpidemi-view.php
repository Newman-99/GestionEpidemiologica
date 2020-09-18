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
            

       <span alt="¿La persona ya ha sido registrada como paciente o usuario?">¿Persona ya registrada?<input type="checkbox" name="siExistPerson" id="siExistPerson" class="form-control form-control-user" value="1">  
        </span>



	<!-- Solo valido para el form de actualizar // solo test -->	
  	<br>
          <select name='idCapitulo' id='' class="form-control" autocomplete='on' class="form-control" >

            <option value="">Capitulos</option>

            <option  value='01'>I CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS</option>

            <option  value='02'>III ENFERMEDADES DE LA SANGRE Y DE LOS ORGANOS HEMATOPOYETICOS, Y CIERTOS TRASTORNOS QUE AFECTAN EL MECANISMO DE LA INMUNIDAD</option>

            <option  value='03'>IV   ENFERMEDADES ENDOCRINAS, NUTRICIONALES Y METABOLICAS</option>

            <option  value='04'>V TRASTORNOS MENTALES Y DEL COMPORTAMIENTO</option>

            <option  value='05'>VI ENFERMEDADES DEL SISTEMA NERVIOSO</option>

            <option  value='06'>VII ENFERMEDADES DEL OJO Y SUS ANEXOS</option>

            <option  value='07'>VIII ENFERMEDADES DE OIDO Y DE LA APOFISIS MASTOIDES</option>

            <option  value='08'>IX ENFERMEDADES DEL SISTEMA CIRCULATORIO</option>

            <option  value='09'>X  ENFERMEDADES DEL SISTEMA RESPIRATORIO</option>

            <option  value='10'>XI ENFERMEDADES DEL SISTEMA DIGESTIVO</option>

            <option  value='11'>XII ENFERMEDADES DE LA PIEL Y DEL TEJIDO SUBCUTANEO</option>

            <option  value='12'>XIII ENFERMEDADES DEL SISTEMA OSTEOMUSCULAR Y DEL TEJIDO CONJUNTIVO</option>

            <option  value='13'>XIV ENFERMEDADES DEL SISTEMA GENITOURINARIO</option>

            <option  value='14'>XV EMBARAZO, PARTO Y PUERPERIO</option>

            <option  value='15'>XVI CIERTAS AFECCIONES ORIGINADAS EN EL PERIODO PERINATAL</option>

            <option  value='16'>XVII MALFORMACIONES CONGENITAS, DEFORMIDADES Y ANOMALIAS CROMOSOMICAS</option>

            <option  value='17'>XVIII SINTOMAS, SIGNOS Y HALLAZGOS ANORMALES CLINICOS Y DE LABORATORIO, NO CLASIFICADOS EN OTRA PARTE</option>

            <option  value='18'>XIX TRAUMATISMOS, ENVENENAMIENTOS Y ALGUNAS OTRAS CONSECUENCIAS DE CAUSAS EXTERNAS</option>

            <option  value='19'>XXII CAUSAS PARA PROPOSITOS ESPECIALES</option>

            <option  value='20'>XXI FACTORES QUE INFLUYEN EN EL ESTADO DE SALUD Y CONTACTO CON LOS SERVICIOS DE SALUD</option>

            <option  value='21'>XX CAUSAS EXTERNAS DE MORBILIDAD Y MORTALIDAD</option>

        </select>

    <input type="text" name="searchName" id="searchName" class="form-control" placeholder="Buscar Nombre">

          <select name='CATALOG_KEY' id='' class="form-control" autocomplete='on' class="form-control" >

            <option value="">Selecionar Nombre</option>

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
  	<input type="text" name="catalogKeyCIE10" id="" class="form-control" placeholder="Codigo: CIE-10" value="A000">
<br>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="registerCasoEpidemi" name="registerCasoEpidemi">Registrar</button>

     <div class="responseProcessAjax"></div>
              </form>

              </div>
            </div>
          </div>
        </div>
      </div>


      <script type="text/javascript">

          $( document ).ready(function() {

      // la fecha recomendad de registro de casos, es del dia de ayer, pero e ocaciones puede ser cambiada  
      var todayDate = new Date;


      var dateRegisterDefault = addOrRemoveDaysToDate(todayDate,1,false);

      var dateRegisterDefaultPHP = dateRegisterDefault.toISOString().split('T')[0];

      $('#dateRegisterCasoEpidemi').val(dateRegisterDefaultPHP);


      var rangeDateRegisterMax = addOrRemoveDaysToDate(todayDate,1,true);

  });



      </script>

