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