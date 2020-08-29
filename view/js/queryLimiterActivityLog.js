
      function queryLimiterActivityLog(requestedAliasUser,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
          "bSort": true,    
          "processing": true,
            "ajax":{
            'url' :action, // json datasource
            'type': "post",  // method  , by default get
          'data': {
          'minDateRange': minDateRange,
          'maxDateRange': maxDateRange,
          'operationType' :'btnQueryLimiter',   
          'requestedAliasUser':requestedAliasUser},
          "dataSrc":"",         
            },
            "columns":[
          {'data': 'recordsCount'},
          {'data': 'genero'},
          {'data': 'docIdentidad'},
          {'data': 'aliasUsuario'},
          {'data': 'nombres'},
          {'data': 'apellidos'},
          {'data': 'descripNivelPermisoBitacora'},
          {'data': 'bitacoraFecha'},
          {'data': 'bitacoraHoraInicio'},
          {'data': 'bitacoraHoraFinal'}
          ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};

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

//            "bDestroy": true,
