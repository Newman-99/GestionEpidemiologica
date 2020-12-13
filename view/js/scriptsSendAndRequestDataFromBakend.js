
    
       server_url = $('#server_url').val();

      function getDataActivityLogSessionsForDataTables(requestedAliasUser,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 1, "asc" ]], // Sort by first column descending
        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": action+"?activityLogSessions=view&minDateRange="+minDateRange+"&maxDateRange="+maxDateRange+"&requestedAliasUser="+requestedAliasUser+"&nameDateFieldDB="+'bitacora_fecha', 
        "columnDefs": [ 
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false                
            }
          ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
}


      function getDataCIE10CatalogForDataTables(url,idCapitulo){
    
    var table = $('#dataTable').DataTable({

        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": url+"?cie10listCatalog=view&idCapitulo="+idCapitulo, 
        "columnDefs": [
            ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};

// devolvera datos para el select dinamico
function getCasesCIE10BySearchPattern(valueSearch,idCapituloCIE10,actionForAjax){


var load  = document.getElementById("icon-load");
  
  $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'valueSearch': valueSearch,
          'idCapituloCIE10':idCapituloCIE10,'getCasesCIE10':true},
     success:function(casesCIE10){
      //console.log(casesCIE10); 
      casesCIE10 = JSON.parse(casesCIE10);
      $('#catalogKeyCIE10').empty();
      casesCIE10.forEach(function(casesCIE10){
        $('#catalogKeyCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })                         
                  load.style.display = "none";
      }
    }); 
  }

// devolvera datos para el select dinamico
function getCasesCIE10ByidCapitulo(idCapituloCIE10,actionForAjax){
var load  = document.getElementById("icon-load");
    $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'idCapituloCIE10':
      idCapituloCIE10,'getCasesCIE10':true,'searchByChapter':true},
      success:function(casesCIE10){
      casesCIE10 = JSON.parse(casesCIE10);
      $('#catalogKeyCIE10').empty();
      console.log(casesCIE10);
      casesCIE10.forEach(function(casesCIE10){
     $('#catalogKeyCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })
        load.style.display = "none";
    }
     }); 
}

function getDataActivityLogCasosEpidemiForDataTables(requestedUser,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 1, "asc" ]], // Sort by first column descending
        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": action+"?activityLogCasosEpidemi=true&minDateRange="+minDateRange+"&maxDateRange="+maxDateRange+"&requestedUser="+requestedUser+"&nameDateFieldDB="+'bitacora_fecha',
     "aoColumnDefs": [      {
        // id_genero
      "targets": [ 0 ],
      "visible": false,
                "searchable": false                
      }]
        ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,
    });
}

function getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRange,maxDateRange,action){

  var  today = new Date();

var hour = 'H'+today.getHours() + '-' + today.getMinutes();

    var table = $('#dataTable').DataTable({
//       "aaSorting": [[ 0, "asc" ]], // Sort by first column descending
        bProcessing: true,
        bDeferRender: true, 
        bServerSide: true,
        sAjaxSource: action+'?viewCasosEpidemi=true&minDateRange='+minDateRange+'&maxDateRange='+maxDateRange+'&requestedPersonEpidemi='+requestedPersonEpidemi+'&nameDateFieldDB='+'fecha_registro',
    aoColumnDefs: [

      {
        // id_genero
      targets: [ 2 ],
      visible: false,
                searchable: false                
      },

      {
        // id_nacionalidad_caso
      targets: [ 4 ],
      visible: false
      },

      {
        // doc_identidad_caso
      targets: [ 5 ],
      visible: false
      },

      {
        // comlumn clave_captitulo_cie10
      targets: [11],
      visible: false
      },

      {
        //id_parroquia
      targets: [ 15 ],
      visible: false,
      searchable: false                
      },     
  
      {
        //id_nacionalidad_usuario
      targets: [ 20 ],
      visible: false,
      searchable: false                

      },
        
      {
        //doc_identidad_usuario
      targets: [ 21 ],
      visible: false,
      searchable: false                

      },

      {
        // Documento de Identidad (usuario-comoleto)
      targets: [ 22 ],
      visible: false,
      searchable: false                

      },

      {
        //year_registro
      targets: [ 23 ],
      visible: false,
      searchable: false                

      },

      //Fecha de Operacion
      {
      targets: [ 24 ],
      visible: false,
      searchable: false                

      },
      // Hora de Operacion
      {
      targets: [ 25 ],
      visible: false,
      searchable: false                

      },

      {
        mData: null,
        sDefaultContent: '<button name= "delete" id= "delete" value="delete" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i> </button> <button value = "update" name = "update" id = "update" class="btn btn-info btn-circle btn-sm"><i class="fas fa-plus"></i></i></button>',

        aTargets: [26]
      }
        ],
        dom: 'lBfrtip',

      lengthMenu: [
            [ 10, 25, 50,100,200,500, -1 ],
            [ '10', '25', '50','100','200', '500', 'Todo' ]
        ],

        buttons: [
        {
       extend: 'excelHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour
        },

        {
       extend: 'csvHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour
        }
        ]
        ,
        
        language: LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  }

function getParroquias(actionForAjax){
  $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'getParroquias':true},
      success:function(dataJson){
      var parroquias = JSON.parse(dataJson);
      console.log(parroquias);
      parroquias.forEach(function(parroquias){
     $('#id_parroquia').append('<option value='+parroquias.id_parroquia+'>'+ parroquias.parroquia + '</option>')
        })
       }
     }); 
}


//const FORM_CASOS_EPIDEMI = document.querySelectorAll("#form_caso_epidemi");

function sendFormToRegisterOrUpdateCasesEpidemi(e){

  e.preventDefault();

  var form=$(this);

  let method = this.getAttribute("method");
  let action = this.getAttribute("action");
  let type = this.getAttribute("data-form");
  let responseProcess=form.children('.responseProcessAjax');
  let msgBackendProcess=form.children('.msgBackendProcess');
  
  let formFields = form.serialize();
  formFields+='&operationType='+type;





var fieldsFormForValidate = [];

if (type =='update') {

    var id_nacionalidad = document.getElementById('id_nacionalidad_update').value;

    var doc_identidad = document.getElementById('doc_identidad_update').value;

fieldsFormForValidate.push(doc_identidad,id_nacionalidad);

}else{
  // osea es es el form register
    var id_nacionalidad = document.getElementById('id_nacionalidad').value;

    var doc_identidad = document.getElementById('doc_identidad').value;
}


  fieldsFormForValidate.push(doc_identidad,id_nacionalidad);

var siExistPerson = document. getElementById('siExistPerson'). checked;

if(!siExistPerson){
     var fecha_nacimiento = document. getElementById('fecha_nacimiento').value;

     var nombres = document. getElementById('nombres').value;

     var apellidos = document. getElementById('apellidos').value;

     var id_genero = document. getElementById('id_genero').value;

  fieldsFormForValidate.push(fecha_nacimiento,nombres,apellidos,id_genero);

}

    var codigo_cie10 = document.getElementById("catalogKeyCIE10").value;

     var fecha_registro = document. getElementById('fecha_registro').value;

     var id_parroquia = document. getElementById('id_parroquia').value;

     var direccion = document. getElementById('direccion').value;
        
     var telefonoPart1 = document. getElementById('telefonoPart1').value;

     var telefonoPart2 = document. getElementById('telefonoPart1').value;

     var telefonoPart3 = document. getElementById('telefonoPart3').value;

  fieldsFormForValidate.push(codigo_cie10,fecha_registro,id_parroquia,direccion,telefonoPart1,telefonoPart2,telefonoPart3);

         if (isBlank(codigo_cie10) || isBlank(fecha_registro) || isBlank(id_parroquia) || isBlank(direccion) || isBlank(telefonoPart1) || isBlank(telefonoPart2) || isBlank(telefonoPart3) || isBlank(doc_identidad) || isBlank(id_nacionalidad)) {

        var alert = {'Alert': 'simple','Title':'Campos Vacios', 'Text':'Todos los campos del caso epidemiologico son obligatorios','Type':'error'};

        return ajaxSweetAlerts(alert);

         }

     // verificamos los datps del evento cie10 para asi enviar el form 
     // para un register or update

   server_url = $('#server_url').val();

  $.ajax({
      type:'POST',
      url: server_url+'ajax/cie10DataAjax.php',
      data:{'getCasesCIE10':true,'getFullDataCie10':true,'catalog_key':codigo_cie10},
      success:function(dataJsonCaseCIE10){

      let dataCaseCIE10 = JSON.parse(dataJsonCaseCIE10);
       
      var data = dataCaseCIE10[0];

      var confirmEventCIE10 = false;

        var warningAttributesEventCIE10 = '';

          if (data.erradicado == 'SI') {
            warningAttributesEventCIE10+=" <br>Erradicado";

                    
          }

          if (data.n_inter == 'SI') {
            warningAttributesEventCIE10+= "<br>De notificacion internacional";

          }

      var alertMessageText =  'Los datos quedaran guardados en el sistema <br>';

          var typeAlert = 'question';

          if (!isBlank(warningAttributesEventCIE10)) {

         var warningTextEventCIE10 = '<span style="color: red"> Este evento CIE 10 se considera '+warningAttributesEventCIE10 + "<br>¿desea continuar?</span>";
          
          alertMessageText = warningTextEventCIE10;
          
          typeAlert = 'warning';
         
         }


  Swal.fire({
    title: '¿Estás seguro?',
    html:  alertMessageText,
    type: typeAlert,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if(result.value){
        
       sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess);

            }
    });
  }
 })
}
