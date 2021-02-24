
    
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

          
      lengthMenu: [
            [ 10, 25, 50,100,200,500, -1 ],
            [ '10', '25', '50','100','200', '500', 'Todo' ]
        ]/*,
        
        dom: 'Bfrtip',

        buttons: [
        {
       extend: 'excelHtml5',
        filename: 'catalago_cie10_' + hour
        },

        {
       extend: 'csvHtml5',

        filename: 'catalago_cie10_' + hour
      }
        ]*/
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

//     $('#id_atrib_especial').append("<option value="+0+">Seleccionar Atributo Especial</option>");
       count = 0;

      $('#id_atrib_especial').empty();

      especialAttributes = JSON.parse(JsonEspecialAttributes);
            especialAttributes.forEach(function(attributes){
    
          count = 1;

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


function addColumnsFilteringDatatables(table){

    $('#dataTable thead tr').clone(true).appendTo( '#dataTable thead' );
    $('#dataTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input style="width:100%" class="not_order" type="text" placeholder="Buscar" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    
        } );
}

 function getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRange,maxDateRange,action){

 var hour = getHourForFileExport();

//    $('#dataTable thead tr').clone(true).appendTo( '#dataTable thead' );

    $('#dataTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input style="width:100%" class="not_orders" type="text" placeholder="Buscar" />' );
    } ); 

    $('#dataTable thead tr:eq(1)  th:eq(0)').html('');

    $('#dataTable thead tr:eq(1)  th:eq(33)').html('');

//<span>'+title+'<span><br>
    var table = $('#dataTable').DataTable({
//       "aaSorting": [[ 0, "asc" ]], // Sort by first column descending
        bProcessing: true,
        bDeferRender: true,
        bServerSide: true,
        orderCellsTop: true,
        sAjaxSource: action+'?viewCasosEpidemi=true&minDateRange='+minDateRange+'&maxDateRange='+maxDateRange+'&requestedPersonEpidemi='+requestedPersonEpidemi+'&nameDateFieldDB='+'fecha_registro',
    aoColumnDefs: [
      {
        // row clumn
      targets: [ 0 ],
       searchable: false
      },

      {
        // id_genero
      targets: [ 3 ],
      visible: false,
       searchable: false
      },

      {
        // id_nacionalidad_caso
      targets: [ 5 ],
      visible: false,
      searchable: false

      },

      {
        // doc_identidad_caso
      targets: [ 6 ],
      visible: false,
       searchable: false
    
      },

      {
        // comlumn clave_capitulo_cie10
      targets: [12],
      visible: false,
      searchable: false

      },

      {
                // comlumn id_atrib_especial

      targets: [16],
      visible: false,
      searchable: false

      },

        // comlumn id_tipo_entrada

      {

      targets: [18],
      visible: false,
      searchable: false

      },


      {
        // comlumn is_hospital
      
      targets: [21],
      visible: false,
      searchable: false

      },

      
      {
        //id_parroquia
      targets: [ 24 ],
      visible: false,
      searchable: false
      },
  

      {
        // Documento de Identidad (usuario-comoleto)
      targets: [ 29 ],
      visible: false,
      },

      {
        //year_registro
      targets: [ 30 ],
      visible: false,
      searchable: false

      },

      //Fecha de Operacion
      {
      targets: [ 31 ],
      visible: false,

      },
      // Hora de Operacion
      {
      targets: [ 32 ],
      visible: false,
      },

      {
        // para los botnes var to y ver menos
      targets: [ 2, 8, 13,14,19, 22, 17 ,23, 25, 26, 27, 28],
      visible: false
      },
    

      {
        mData: null,
        sDefaultContent: '<button name= "delete" id= "delete" value="delete" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i> </button> <button value = "update" name = "update" id = "update" class="btn btn-info btn-circle btn-sm"><i class="fas fa-plus"></i></i></button>',

        aTargets: [33],
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
        columns:[0,1,2,4,7,8,9,10,11,13,14,15,17,19,20,22,23,25,26,27,28,29,31,32]
        }
/*
           <!--  0 --> <th>Nro. </th>
           <!--  1 --> <th >id Caso</th>
           <!--  2 --> <th >id Persona</th>
           <!--  3 --> <th>id Genero</th>
           <!--  4 --> <th>Genero</th>
           <!--  5 --> <th>id Nacionalidad (Caso)</th>
           <!--  6 --> <th>Nro. Documento de Identidad (Caso)</th>
           <!--  7 --> <th>Documento de Identidad</th>
           <!--  8 --> <th>Fecha de Nacimiento</th>
           <!--  9 --> <th>Edad</th>
           <!--  10 --> <th>Nombres</th>
           <!-- 11 --> <th>Apellidos</th>
           <!-- 12 --> <th>Clave Capitulo CIE-10</th>
           <!-- 13 --> <th>Capitulo</th>
           <!-- 14 --> <th>Codigo CIE-10</th>
           <!-- 15 --> <th>Nombre CIE-10</th>
           <!-- 16 --> <th>Id Tipo  Caso </th>
           <!-- 17 --> <th>Tipo de Entrada</th>
           <!-- 18 --> <th>id atributo especial</th>
           <!-- 19 --> <th>Atributo Especial</th>
           <!-- 20 --> <th>Notificacion Inmediata</th>
           <!-- 21 --> <th>is hospital</th>
           <!-- 22 --> <th>Hospitalizado o Referido</th>
           <!-- 23 --> <th>Fecha</th>
           <!-- 24 --> <th>id Parroquia</th>
           <!-- 25 --> <th>Parroquia</th>
           <!-- 26 --> <th>Direccion</th>
           <!-- 27 --> <th>Telefono</th>
           <!-- 28 --> <th>Usuario</th>
           <!-- 29 --> <th>Documento de Identidad</th>
           <!-- 30 --> <th>Anio de Operacion</th>
           <!-- 31 --> <th>Fecha de Operacion</th>
           <!-- 32 --> <th>Hora de Operacion</th>
           <!-- 33 --> <th></th>
*/
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
       extend: 'copyHtml5',
            text: 'Copiar',
        },

        {
          extend: 'colvisGroup',
          text: 'Ver Todo',
          show : [ 2, 8, 13, 14, 17, 19, 22 ,23, 25, 26, 27, 28],
                
                attr:  {
                id: 'btn-ver-todo'
            }

        },

        {
          extend: 'colvisGroup',
          text: 'Ver Menos',
          hide : [ 2, 8, 13, 14, 17, 19, 22 ,23, 25, 26, 27, 28],
                attr:  {
                id: 'btn-ver-menos'
            }
        },

        ]
        ,
        
        language: LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
$('#dataTable thead tr:eq(1) th').each(function () {
        $('input',this).on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();

        });
    });

//    $('#dataTable thead tr:eq(1)  th:eq(33) :input').remove();

//  var filteringHeader $('#dataTable thead tr:eq(1) th');
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

/*

var isBlankDocIdentidad = false;

if (type =='register') {

  // osea es es el form register

  if (document. getElementById('ifExistPerson').checked) {

    var id_person = document.getElementById('id_person').value;

      isBlankDocIdentidad = (isBlank(id_person));

}else{
 
    var id_nacionalidad = document.getElementById('id_nacionalidad').value;

    var doc_identidad = document.getElementById('doc_identidad').value;


      isBlankDocIdentidad = (isBlank(id_nacionalidad) || isBlank(doc_identidad));
}

}
*/

var isBlankBasicPerson = false;

if (!$('#ifExistPerson').prop('checked')) {

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

/*

console.log(isBlankBasicPerson,isBlankDataCaseEpidemi,isBlankDocIdentidad);

if (isBlankBasicPerson || isBlankDataCaseEpidemi || isBlankDocIdentidad) {

        var alert = {'Alert': 'simple','Title':'Campos Vacios', 'Text':'Todos los campos del caso epidemiologico son obligatorios','Type':'error'};

        await ajaxSweetAlerts(alert);

              confirmSendAjax = false;
              return confirmSendAjax


}
*/

var dataEventCIE10 = await getAttributesEventCIE10(catalog_key);

var msgWarningAttributesEventCIE10 = await getMsgWarningAttributesEventCIE10(dataEventCIE10);

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
