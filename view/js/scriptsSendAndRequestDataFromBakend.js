
    
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
    
    var hour = getHourForFileExport();

    var table = $('#dataTable').DataTable({

        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": url+"?cie10listCatalog=view&idCapitulo="+idCapitulo, 
        "columnDefs": [
            ],

          dom: 'Bfrtip',

      lengthMenu: [
            [ 10, 25, 50,100,200,500, -1 ],
            [ '10', '25', '50','100','200', '500', 'Todo' ]
        ],
        
        buttons: [
        {
       extend: 'excelHtml5',
        filename: 'catalago_cie10_' + hour
        },

        {
       extend: 'csvHtml5',

        filename: 'catalago_cie10_' + hour
      }
        ]
            ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};

// devolvera datos para el select dinamico
function setEventCIE10BySearchPatternToFormCaseEpidemi(valueSearch,idCapituloCIE10,actionForAjax){


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
function setEventCIE10ByidCapituloToFormCaseEpidemi(idCapituloCIE10,actionForAjax){


var load  = document.getElementById("icon-load");
    $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'idCapituloCIE10':
      idCapituloCIE10,'getCasesCIE10':true,'searchByChapter':true},
      success:function(jsonCasesCIE10){
      casesCIE10 = JSON.parse(jsonCasesCIE10);

      $('#catalogKeyCIE10').empty();
      casesCIE10.forEach(function(casesCIE10){
     $('#catalogKeyCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })

        load.style.display = "none";

    }
     }); 

}

// para ciertos eventos cie-10 con caractaeristicas especiales

function getEspecialAttributesCIE10(){

  
  var catalog_key = $('#catalogKeyCIE10').val();


if (catalog_key != 0 && !isBlank(catalog_key)) {

var load_atrib_especial  = document.getElementById("icon-load-atrib-especial");

load_atrib_especial.style.display = "block";
  
   var server_url = $('#server_url').val();


  $.ajax({
      type:'POST',
      url: server_url+'ajax/casosEpidemiAjax.php',
      data:{'catalog_key': catalog_key,'getEspecialAttributes':true},
     success:function(JsonEspecialAttributes){
      console.log(JsonEspecialAttributes); 

      especialAttributes = JSON.parse(JsonEspecialAttributes);      
            especialAttributes.forEach(function(attributes){
      if (attributes.id_atrib_especial == 0) {
      $('#id_atrib_especial').empty();
     }

     $('#id_atrib_especial').append('<option value='+attributes.id_atrib_especial+'>'+attributes.descripcion + '</option>')

        });      
        load_atrib_especial.style.display = "none";
    
      }
    }); 
  }

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

var hour = getHourForFileExport();
 
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
      visible: false,
      searchable: false                

      },

      {
        // doc_identidad_caso
      targets: [ 5 ],
      visible: false,
       searchable: false                
    
      },

      {
        // comlumn clave_capitulo_cie10
      targets: [11],
      visible: false,
      searchable: false                

      },

      {

        // comlumn id_atrib_especial
      targets: [15],
      visible: false,
      searchable: false                

      },


      {
        // comlumn is_hospital
      
      targets: [18],
      visible: false,
      searchable: false                

      },

      
      {
        //id_parroquia
      targets: [ 21 ],
      visible: false,
      searchable: false                
      },     
  
      {
        //id_nacionalidad_usuario
      targets: [ 26 ],
      visible: false,
      searchable: false                

      },
        
      {
        //doc_identidad_usuario
      targets: [ 27 ],
      visible: false,
      searchable: false                

      },

      {
        // Documento de Identidad (usuario-comoleto)
      targets: [ 28 ],
      visible: false,
      searchable: false                

      },

      {
        //year_registro
      targets: [ 29 ],
      visible: false,
      searchable: false                

      },

      //Fecha de Operacion
      {
      targets: [ 30 ],
      visible: false,
      searchable: false                

      },
      // Hora de Operacion
      {
      targets: [ 31 ],
      visible: false,
      searchable: false                

      },

      {
        // para los botnes var to y ver menos
      targets: [ 7, 12, 16, 19 ,20, 22, 23, 24, 25],
      visible: false
      },
    

      {
        mData: null,
        sDefaultContent: '<button name= "delete" id= "delete" value="delete" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i> </button> <button value = "update" name = "update" id = "update" class="btn btn-info btn-circle btn-sm"><i class="fas fa-plus"></i></i></button>',

        aTargets: [32],
        searchable: false ,
        orderable: false              
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
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour,
        exportOptions: {
          // exportacion simple, no inculye lo inicializados como visible:false
          // pero si las columnas de ver mas y menos
        columns:[0,1,3,6,7,8,9,10,12,13,14,16,17,19,20,22,23,24,25]
        }

        },

        {
       extend: 'excelHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour+'_full',
        text: 'Excel Full',
        },

        {
       extend: 'csvHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour
        },

        {
          extend: 'colvisGroup',
          text: 'Ver Todo',
          show : [ 7, 12, 16, 19 ,20, 22, 23, 24, 25],
                
                attr:  {
                id: 'btn-ver-todo'
            }

        },

        {
          extend: 'colvisGroup',
          text: 'Ver Menos',
          hide : [ 7, 12, 16, 19 ,20, 22, 23, 24, 25],
                attr:  {
                id: 'btn-ver-menos'
            }
        },

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

async function sendFormToRegisterOrUpdateCasesEpidemi(e){

try{
//try{
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

     var fecha_registro = document. getElementById('fecha_registro').value;

     var id_parroquia = document. getElementById('id_parroquia').value;

     var direccion = document. getElementById('direccion').value;
        
     var telefonoPart1 = document. getElementById('telefonoPart1').value;

     var telefonoPart2 = document. getElementById('telefonoPart1').value;

     var telefonoPart3 = document. getElementById('telefonoPart3').value;

    var catalog_key = document.getElementById("catalogKeyCIE10").value;



var isBlankDocIdentidad = false;

if (type =='register') {

  // osea es es el form register
    var id_nacionalidad = document.getElementById('id_nacionalidad').value;

    var doc_identidad = document.getElementById('doc_identidad').value;

      isBlankDocIdentidad = (isBlank(id_nacionalidad) || isBlank(doc_identidad));
}


var isBlankBasicPerson = false;

if (!$('#siExistPerson').prop('checked')) {

    var nombre = document.getElementById('nombres').value;

    var apellidos = document.getElementById('apellidos').value;

    var id_genero = document.getElementById("id_genero").value;

    var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;

      isBlankBasicPerson = (isBlank(nombre) || isBlank(apellidos) || isBlank(id_genero) || isBlank(fecha_nacimiento));
}

         var isBlankDataCaseEpidemi = (isBlank(catalog_key) || isBlank(fecha_registro) || isBlank(id_parroquia) || isBlank(direccion) || isBlank(telefonoPart1) || isBlank(telefonoPart2) || isBlank(telefonoPart3));


var confirmSendAjax = false;

await   Swal.fire({
    title: '¿Estás seguro?',
    html: 'Los datos quedaran guardados en el sistema <br>',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if(result.value){
                          
              confirmSendAjax = true;
              return confirmSendAjax

            }else{
              confirmSendAjax = false;
              return confirmSendAjax
            }

    });



if(confirmSendAjax) {

console.log(isBlankBasicPerson,isBlankDataCaseEpidemi,isBlankDocIdentidad);

if (isBlankBasicPerson || isBlankDataCaseEpidemi || isBlankDocIdentidad) {

        var alert = {'Alert': 'simple','Title':'Campos Vacios', 'Text':'Todos los campos del caso epidemiologico son obligatorios','Type':'error'};

        await ajaxSweetAlerts(alert);

              confirmSendAjax = false;
              return confirmSendAjax

}


var dataEventCIE10 = await getAttributesEventCIE10(catalog_key);

var msgWarningAttributesEventCIE10 = await getMsgWarningAttributesEventCIE10(dataEventCIE10);

console.log(msgWarningAttributesEventCIE10);

if (msgWarningAttributesEventCIE10 != 0) {

  await Swal.fire({
    title: '¿Estás seguro?',
    html: '<span style="color: red;"><b>Este evento CIE 10 de notificacion inmediata, se considera:</b><br>'+msgWarningAttributesEventCIE10 + '<br><br><b>¿Desea continuar?</b></span>',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if(result.value){
              confirmSendAjax = true;
              return confirmSendAjax
            }else{

              confirmSendAjax = false;
              return confirmSendAjax              
            }


    });

}

if(confirmSendAjax){
       sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess);
}

}

}catch (e) {
    alert(e);
  }


}
