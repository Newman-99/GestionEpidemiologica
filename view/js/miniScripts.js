//Funcionalidades cortas personlizadas para el sistema

// My scripts

function addOrRemoveDaysToDate(date, days, typeOperation){

 // true para sumar y false para restar
if (typeOperation) {
  date.setDate(date.getDate() + days);
  console.log(date);
  return date;
  }else{
  date.setDate(date.getDate() - days);
  return date;    
  }

}

function isBlank(str) {
    return (str.length === 0 || !str.trim());

}

function isBlanks(data) {
data.forEach(function(str) {

   if (isBlank(str)){
    return true;
   }else{
    return false;    
   }

});
}


// Control de funcionalidades de formularios

// si el checkbox de la person ya existe se active, inabilita los campos innecesarios

    $( document ).ready(function() {

$('#siExistPerson').change(function() {

	$(".form-control-person").prop('disabled', this.checked);

});

});


function cancelRequestAjax(){        

          var msgBackendProcess = $("#msgBackendProcess");

            msgBackendProcess.html("Abortando Proceso...");
             
            ajax.abort();
            ajax = null;    
      
    };

function getHourForFileExport(){

        var hours = document.getElementById('hours').textContent;
        var minutes = document.getElementById('minutes').textContent; 
        var seconds = document.getElementById('seconds').textContent;
        var day = document.getElementById('day').textContent; 
        var month = document.getElementById('nroMonth').textContent; 
        var year = document.getElementById('year').textContent;

  var hour = '('+day+'-'+month+'-'+year+'_'+hours+'-'+minutes+')' ;

  return hour;


}

async function setCIE10ToFormUpdateCaseEpidemiAsync(clave_capitulo_cie10,catalog_key_cie10,actionAjaxForCie10,id_atrib_especial) {
  try {
    
    await setEventCIE10ByidCapituloToFormCaseEpidemi(clave_capitulo_cie10,actionAjaxForCie10);

    await setTimeout(function(){ $("#catalogKeyCIE10").val(catalog_key_cie10);}, 500);

    await $('#id_atrib_especial').empty();

    await $('#id_atrib_especial').append('<option value=0>Seleccionar Atributo Especial</option>')

    await getEspecialAttributesCIE10();

   await setTimeout(function(){ getEspecialAttributesCIE10()}, 500);

  setTimeout(function(){ $("#id_atrib_especial").val(id_atrib_especial);}, 1000);

  }catch (e) {
    alert('error: '+e);
  }
} 

async function setCIE10ToFormRegisterCaseEpidemByidCapituloAsync(idCapituloCIE10,actionAjaxForCie10) {
  try {

        await  setEventCIE10ByidCapituloToFormCaseEpidemi(idCapituloCIE10,actionAjaxForCie10);

          getEspecialAttributesCIE10();
  }catch (e) {
    alert(e);
  }
} 

async function setCIE10ToFormRegisterCaseEpidemBySearchPatternAsync(valueSearch,idCapituloCIE10,actionAjaxForCie10) {
  try {

        await  setEventCIE10BySearchPatternToFormCaseEpidemi(valueSearch,idCapituloCIE10,actionAjaxForCie10);

          getEspecialAttributesCIE10();
  }catch (e) {
    alert(e);
  }
} 

async function getDataCasosEpidemiForDataTablesAsync(requestedPersonEpidemi,minDateRange,maxDateRange,url) {
  try {
        await  getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRange,maxDateRange,url);

  document.getElementById("btn-ver-menos").style.display = "none";

  

document.getElementById('btn-ver-todo').addEventListener('click', function() {
  document.getElementById("btn-ver-menos").style.display = "block";
  document.getElementById("btn-ver-todo").style.display = "none";
});

document.getElementById('btn-ver-menos').addEventListener('click', function() {
  document.getElementById("btn-ver-todo").style.display = "block";
  document.getElementById("btn-ver-menos").style.display = "none";
});

  }catch (e) {
    alert(e);
  }
} 

function getMsgWarningAttributesEventCIE10(dataEventCIE10){



        var warningAttributesEventCIE10 = '';

          if (dataEventCIE10.erradicado == 'SI') {
            warningAttributesEventCIE10+=" <br>Causas erradicadas o no existentes.";
                    
          }
          if (dataEventCIE10.n_inter == 'SI') {
            warningAttributesEventCIE10+= "<br>- Notificación Internacional.";
            }

          if (dataEventCIE10.nin == 'SI') {
            warningAttributesEventCIE10+= "<br>- Notificación inmediata de vigilancia epidemiológica de morbilidad.";
            }

          if (dataEventCIE10.ninmtobs == 'SI') {
            warningAttributesEventCIE10+= "<br>- Notificación inmediata de mortalidad obstétrica.";
            }

          if (dataEventCIE10.notdiaria == 'SI') {
            warningAttributesEventCIE10+= "<br>- Vigilancia epidemiológica mobilidad notificación diaria.";
            }

          if (dataEventCIE10.sistema_especial == 'SI') {
            warningAttributesEventCIE10+= "<br>- Vigilancia epidemiológica mobilidad notificación especial.";
            }

          if (dataEventCIE10.es_suive_notin == 'SI') {
            warningAttributesEventCIE10+= "<br>- Padecimiento de notificación epidemiológica inmediata.";
            }

          if (dataEventCIE10.es_suive_est_epi == 'SI') {
            warningAttributesEventCIE10+= "<br>- Padecimiento que requiere estudio epidemiológico de caso.";
            }


          if (dataEventCIE10.es_suive_est_brote  == 'SI') {
            warningAttributesEventCIE10+= "<br>- Padecimiento que requiere estudio de brote.";
            }


            if (isBlank(warningAttributesEventCIE10)) {
                      return false;
            }else{
                      return warningAttributesEventCIE10;
            }
}

 async function getAttributesEventCIE10(catalog_key){

  var dataEventCIE10 = '';

   server_url = $('#server_url').val();

 await $.ajax({
      type:'POST',
      url: server_url+'ajax/cie10DataAjax.php',
      data:{
      'catalog_key':catalog_key,
      'getCasesCIE10':true,
      'getFullDataCie10':true},

      success:function(dataJsonEventsCIE10){


      var eventsCIE10 = JSON.parse(dataJsonEventsCIE10);
      
      dataEventCIE10 = eventsCIE10[0];

 }
});

return dataEventCIE10;

}
