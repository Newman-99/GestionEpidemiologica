
    async function setCIE10ToFormRegisterCaseEpidemBySearchPatternAsync(valueSearch,idCapituloCIE10,actionAjaxForCie10) {
  try {

        await  setEventCIE10BySearchPatternToFormCaseEpidemi(valueSearch,idCapituloCIE10,actionAjaxForCie10);

        getEspecialAttributesCIE10();
  }catch (e) {
    alert(e);
  }
} 

       server_url = $('#server_url').val();

      function getDataActivityLogSessionsForDataTables(requestedAliasUser,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
             //fixedHeader: true,
            keys: true,
        "scrollX": true,
        "scrollCollapse": true,
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


async      function getDataCIE10CatalogForDataTables(url,parameterPreGetDataTables){

            let elementMsgBackendProcess=$('.msgBackendProcessDatatable');

            elementMsgBackendProcess.html("</p>Procesando...<p>");

    var hour = getHourForFileExport();

    $('#dataTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input style="width:100%" class="search-column" type="text" placeholder="Buscar" />' );
    } );


    var table = await $('#dataTable').DataTable({
        ////fixedHeader: true,
            keys: true,
        "scrollX": true,
        "scrollCollapse": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        'orderCellsTop': true,

        "sAjaxSource": url+"?cie10listCatalog=view"+parameterPreGetDataTables,
        "columnDefs": [
            ],

          
      lengthMenu: [
            [ 10, 25, 50,100,200,500, 1000 ],
            [ '10', '25', '50','100','200', '500','1000']
        ]
           ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true

    });
  
      var timer;

/*
$('#dataTable thead tr:eq(1) th').each(function () {
            $('input',this).on('keyup change', function () {
      window.clearTimeout(timer);
      
      timer = window.setTimeout(() => {
                table.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
      }, 1000);


        });

        });


  window.clearTimeout(timer);
*/
  table.columns.adjust().draw();


//$( "#dataTable thead tr:eq(1) th:eq(0)").removeClass( "sorting_asc");

    $(document).ajaxStop(function() {
    
             elementMsgBackendProcess.html("");

           });

}

  

    async function setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,valueSearch,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow) {
  try {    

  var server_url = $('#server_url').val();
  
    var actionAjax = server_url+'ajax/cie10DataAjax.php';


      iconLoadselectcatalog_key_cie10.css("display", "block");

  await $.ajax({
      type:'POST',
      url: actionAjax,
      data:{'valueSearch': valueSearch,'columnsSearch':columnsSearch,'columnsShow':columnsShow,'getCasesCIE10':true},
      success:function(casesCIE10Json){
//     console.log(casesCIE10Json);
      casesCIE10 = JSON.parse(casesCIE10Json);
      selectcatalog_key_cie10.empty();
      
      casesCIE10.forEach(function(casesCIE10){
        selectcatalog_key_cie10.append('<option value='+casesCIE10.consecutivo+'>'+casesCIE10.consecutivo+' - '+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        });
          
      }
    });

      iconLoadselectcatalog_key_cie10.css("display", "none");      

  }catch (e) {
    console.log(e);
  }
}



 function getEspecialAttributesCIE10FormConfigReport(iconLoadSelectAtribEspecialEpi,
  selectAtribEspecialEpi,typeSearch = 'all',atribsSearchCie10 = '',valuesSearchCie10 = ''){
  
      $(iconLoadSelectAtribEspecialEpi).css("display", "block");
  
   var server_url = $('#server_url').val();

 $.ajax({
      type:'POST',
      url: server_url+'ajax/casosEpidemiAjax.php',
      data:{'valuesSearchCie10':valuesSearchCie10,'atribsSearchCie10':atribsSearchCie10,
            'getEspecialAttributes':true,'typeSearch':typeSearch},

     success:function(JsonEspecialAttributes){
//     console.log(JsonEspecialAttributes);

//     $('#id_atrib_especial').append("<option value="+0+">Atributo Especial: Ninguno</option>");
       count = 0;


      $(selectAtribEspecialEpi).empty();

      especialAttributes = JSON.parse(JsonEspecialAttributes);
            especialAttributes.forEach(function(attributes){
    
          count = 1;

     $(selectAtribEspecialEpi).append('<option value='+attributes.id_atrib_especial+'>'+''+attributes.id_atrib_especial+' - '+attributes.descripcion + '</option>')

        });
   
         $(iconLoadSelectAtribEspecialEpi).css("display", "none");
    
      }
    });

  }

async function setCIE10ToFormUpdateReportEpiFilasConfigAsync(inputSearchCIE10,valueKeyCie10) {


    var inputsGroupCie10 = inputSearchCIE10.parent('div.inputs-group-cie10');

    var selectcatalog_key_cie10 = inputsGroupCie10.find('select:eq(0)'); 

    var selectAtribEspecialEpi = inputsGroupCie10.find('select:eq(1)'); 

    var iconLoadselectcatalog_key_cie10 = inputsGroupCie10.find('.input-group-addon:eq(0)'); 

    var iconLoadSelectAtribEspecialEpi = inputsGroupCie10.find('.input-group-addon:eq(1)'); 

    var columnsSearch = ['consecutivo'];

    var columnsShow = ['catalog_key','nombre','consecutivo'];

//    console.log(selectcatalog_key_cie10);

  try {
      

     setCIE10FormReportEpiFilasModalBySearchPatternAsync(inputsGroupCie10,valueKeyCie10,selectcatalog_key_cie10,iconLoadselectcatalog_key_cie10,columnsSearch,columnsShow);

    //await setTimeout(function(){ $(selectcatalog_key_cie10).val(valueKeyCie10);}, 800);

  }catch (e) {
    alert('error: '+e+'<br> en la Linea: '+e.stack);
  }
} 


// devolvera datos para el select dinamico
function setEventCIE10BySearchPatternToFormCaseEpidemi(valueSearch,idCapituloCIE10,actionForAjax){


var load  = document.getElementById("icon-load");
  
  $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'valueSearch': valueSearch,
          'idCapituloCIE10':idCapituloCIE10,'getCasesCIE10':true},
     success:function(casesCIE10){
//      console.log(casesCIE10);
      casesCIE10 = JSON.parse(casesCIE10);
      $('#catalog_key_cie10').empty();
      casesCIE10.forEach(function(casesCIE10){
        $('#catalog_key_cie10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })
                  load.style.display = "none";
      }
    });
  }


// devolvera datos para el select dinamico
async function setEventCIE10ByidCapituloToFormCaseEpidemi(idCapituloCIE10){

//alert(idCapituloCIE10);

  var load  = document.getElementById("icon-load");

   let actionForAjax = server_url+'ajax/cie10DataAjax.php';

   await $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'idCapituloCIE10':
      idCapituloCIE10,'getCasesCIE10':true,'searchByChapter':true},
      success:function(jsonCasesCIE10){
 //     console.log(jsonCasesCIE10);
      casesCIE10 = JSON.parse(jsonCasesCIE10);
      $('#catalog_key_cie10').empty();
      casesCIE10.forEach(function(casesCIE10){
     $('#catalog_key_cie10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })

        load.style.display = "none";

    }
     });

          load.style.display = "none";


}

// para ciertos eventos cie-10 con caractaeristicas Especials

function getEspecialAttributesCIE10(){
  
  var catalog_key = $('#catalog_key_cie10').val();

if (catalog_key != 0 && !isBlank(catalog_key)) {

var load_atrib_especial  = document.getElementById("icon-load-atrib-especial");

load_atrib_especial.style.display = "block";
  
   var server_url = $('#server_url').val();

  $.ajax({
      type:'POST',
      url: server_url+'ajax/casosEpidemiAjax.php',
      data:{'catalog_key': catalog_key,'getEspecialAttributes':true},
     success:function(JsonEspecialAttributes){
//     console.log(JsonEspecialAttributes);

//     $('#id_atrib_especial').append("<option value="+0+">Atributo Especial: Ninguno</option>");
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

async function  getDataActivityLogCasosEpidemiForDataTables(requestedUser,minDateRange,maxDateRange,action){


            let elementMsgBackendProcess=$('.msgBackendProcessDatatable');

            elementMsgBackendProcess.html("</p>Procesando...<p>");


    var table = await $('#dataTable').DataTable({
       "aaSorting": [[ 1, "asc" ]], // Sort by first column descending
        //fixedHeader: true,
        keys: true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "scrollX": true,
        "scrollCollapse": true,        
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
    $(document).ajaxStop(function() {
    
             elementMsgBackendProcess.html("");

           });

}





function getDataReportsEpiFilasConfigsDataTables(requestedIdFilasReport){
         server_url = $('#server_url').val();

    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 0, "asc" ]], // Sort by first column descending       
        bProcessing: true,
        bDeferRender: true,
        bServerSide: true,
        //fixedHeader: true,
            keys: true,
        "scrollX": true,
        "scrollCollapse": true,
        "sAjaxSource":server_url+"ajax/reportsEpiAjax.php?getDataReportsEpiFilasConfigsDataTables="+true+'&nro_fila_report='+requestedIdFilasReport,
    "aoColumnDefs": [      
      {
      targets: [ 5,6,7,8,9],
      visible: false,
              searchable: false ,
        orderable: false

      },
        
         {
        searchable: false ,
        orderable: false,
            "class": "index",
            targets: 0
        },

      {
        mData: null,
        sDefaultContent: '<button name= "deleteReportEpiFilasConfig" id= "deleteReportEpiFilasConfig" value="deleteReportEpiFilasConfig" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></button>&nbsp;<button value = "updateReportEpiFilasconfig" name = "updateReportEpiFilasconfig" id = "updateReportEpiFilasconfig" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></i></button>',

        aTargets: [10],
        searchable: false ,
        orderable: false
        ,sWidth: '7%'
        }

      ]
        ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true
    });

        table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}


function getDataReportsEpiFilasDataTables(){
         server_url = $('#server_url').val();

    var table = $('#dataTableReportEpiFilas').DataTable({
        //fixedHeader: true,
        keys: true,
        "paging":   true,
        "info":     true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
         //"fixedHeader": true,
        "sAjaxSource":server_url+"ajax/reportsEpiAjax.php?getDataReportsEpiFilasDataTables="+true,
        columnDefs: [ {
            sortable: false,
            "class": "index",
            targets: 0
        },

      {
        mData: null,
        sDefaultContent: '<button name= "deleteReportEpiFilas" id= "deleteReportEpiFilas" value="deleteReportEpiFilas" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></button><button value = "updateReportEpiFilas" name = "updateReportEpiFilas" id = "updateReportEpiFilas" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></i></button><button value = "configFilasReports" name = "configFilasReport" id = "configFilasReport" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-plus"></i></i></button>',
        aTargets: [3],
        searchable: false ,
        orderable: false,
        "width": "100px"
        }
      ],

            "order": [[ 1, 'asc' ]]

        ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true
    });

 
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function getDataAtribsEspecialsEpiDataTables(){

         server_url = $('#server_url').val();
        
    var table = $('#dataTableAtribsEspecialsEpi').DataTable({
        //fixedHeader: true,
        keys: true,
        "paging":   true,
        "info":     true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
         //"fixedHeader": true,
        "sAjaxSource":server_url+"ajax/reportsEpiAjax.php?getDataAtribsEspecialsEpiDataTables="+true,
        columnDefs: [ {
            sortable: false,
            "class": "index",
            targets: 0
        },

        {
        mData: null,
        sDefaultContent: '<button name= "deleteAtribsEspecialsEpi" id= "deleteAtribsEspecialsEpi" value="deleteAtribsEspecialsEpi" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></button><button value = "updateAtribsEspecialsEpi" name = "updateAtribsEspecialsEpi" id = "updateAtribsEspecialsEpi" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></i></button><button value = "configAtribsEspecialsEpi" name = "configAtribsEspecialsEpi" id = "configAtribsEspecialsEpi" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-plus"></i></i></button>',
        aTargets: [3],
        searchable: false ,
        orderable: false,
        "width": "100px"
        }
      ],

            "order": [[ 3, 'asc' ]]

        ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true
    });

 
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}

function getDataAtribsEspecialsEpiConfigsDataTables(id_atrib_especial){
         server_url = $('#server_url').val();

    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 0, "asc" ]], // Sort by first column descending       
        bProcessing: true,
        bDeferRender: true,
        bServerSide: true,
        //fixedHeader: true,
            keys: true,
        "sAjaxSource":server_url+"ajax/reportsEpiAjax.php?getDataAtribsEspecialsEpiConfigsDataTables="+true+'&id_atrib_especial='+id_atrib_especial,
    "aoColumnDefs": [      
      {
      targets: [0,3,4,5],
      visible: false,
              searchable: false ,
        orderable: false,
            sortable: false,
      },
        
         {
        searchable: false ,
        orderable: false,
            "class": "index",
            targets: 0
        },

      {
        mData: null,
        sDefaultContent: '<button name= "deleteAtribEspecialEpiConfig" id= "deleteAtribEspecialEpiConfig" value="deleteAtribEspecialEpiConfig" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></button>&nbsp;<button value = "updateAtribEspecialEpiconfig" name = "updateAtribEspecialEpiconfig" id = "updateAtribEspecialEpiconfig" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></i></button>',

        aTargets: [6],
        searchable: false ,
        orderable: false
        ,sWidth: '7%',
         sortable: false
        }

      ]
        ,'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,
    });

        table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}


async function getDataCasosEpidemiForDataTables(parameterPreGetDataTables,action){

            let elementMsgBackendProcess=$('.msgBackendProcessDatatable');

            elementMsgBackendProcess.html("</p>Procesando...<p>");

 var hour = getHourForFileExport();

    var minDateRange  = $('#minDateRange').val();
    var maxDateRange = $('#maxDateRange').val();

//    $('#dataTable thead tr').clone(true).appendTo( '#dataTable thead' );



    $('#dataTable thead tr:eq(1) th').not(':eq(33)').each( function () {
        var title = $(this).text();
        $(this).html( '<input style="width:100%" class="search-column" type="text" placeholder="Buscar" />' );
    } );

    $('#dataTable thead tr:eq(1)  th:eq(0)').html('');

    $('#dataTable thead tr:eq(1)  th:eq(33)').html('');
    


    var table;

    table = await $('#dataTable').DataTable({
        "aaSorting": [[ 1, "desc" ]], // Sort by first column descending
        //fixedHeader: true,
        orderCellsTop: true,
        keys: true,
"scrollX": true,
"scrollCollapse": true,
        bProcessing: true,
        bDeferRender: true,
        bServerSide: true,
      sAjaxSource: action+'?'+parameterPreGetDataTables+'&viewCasosEpidemi=true&nameDateFieldDB='+'fecha_registro',
    aoColumnDefs: [
      
      {
       searchable : false,
       orderable : false,
       targets : 0
      },


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
      {

        // para los botnes var to y ver menos
      targets: [ 2, 8, 13,14,19, 22, 17, 25, 26, 27, 28, 29 ,32,31],
      visible: false
      },
    

      {
        mData: null,
        sDefaultContent: '<button name= "delete" id= "delete" value="delete" class="btn btn-danger btn-circle btn-sm delete"><i class="fas fa-trash"></i></button>&nbsp;<button value = "update" name = "update" id = "update" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pencil-alt"></i></i></button>',

        aTargets: [33],
        searchable: false ,
        sortable: false,
        orderable: false,
        sWidth: '7%'

      }
        ],
 //       dom: 'Bfrtip',

        dom: 'lBfrtip',

//       dom: 'Qlfrtip',

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
 --> <th>Nro. </th>
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
           <!-- 16 --> <th>id atributo especial</th>
           <!-- 17 --> <th>Atributo Especial</th>
           <!-- 18 --> <th>Id Tipo  Caso </th>
           <!-- 19 --> <th>Tipo de Entrada</th>
           <!-- 20 --> <th>Notificacion Inmediata</th>
           <!-- 21 --> <th>is hospital</th>
           <!-- 22 --> <th>Hospitalizado o Referido</th>
           <!-- 23 --> <th>Fecha de Registro</th>
           <!-- 24 --> <th>id Parroquia</th>
           <!-- 25 --> <th>Parroquia</th>
           <!-- 26 --> <th>Direccion</th>
           <!-- 27 --> <th>Telefono</th>
           <!-- 28 --> <th>Usuario</th>
           <!-- 29 --> <th>Documento de Identidad</th>
           <!-- 30 --> <th>Anio de Operacion</th>
           <!-- 31 --> <th>Fecha de Operacion</th>
           <!-- 32 --> <th>Hora de Operacion</th>
           <!-- 33 --> <th class="remove-item-child"> </th>
*/
        },



        {
       extend: 'excelHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour+'_full',
        text: 'Excel Full',
        },

        {
       extend: 'csvHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour,
        exportOptions: {
        columns:[0,1,2,4,7,8,9,10,11,13,14,15,17,19,20,22,23,25,26,27,28,29,31,32]
        }
        },

        {
       extend: 'pdfHtml5',
        filename: 'Casos_Epidemiologicos_' + minDateRange + '_' + maxDateRange + '_' + hour,        
         orientation: 'landscape',
         pageSize: 'TABLOID',
        exportOptions: {
        columns:[0,1,2,4,7,8,9,10,11,14,17,19,20,22,23,25,26,27]
        }
         },

      /*  {
       extend: 'copyHtml5',
            text: 'Copiar',
                    exportOptions: {
        columns:[0,1,2,4,7,8,9,10,11,13,14,15,17,19,20,22,23,25,26,27,28,29,31,32]
        }
        },*/

        {
          extend: 'colvisGroup',
          text: 'Ver Todo',
          show : [ 2, 8, 13,14,19, 22, 17, 25, 26, 27, 28, 29 ,32,31],          
                attr:  {
                id: 'btn-ver-todo'
            }

        },

        {
          extend: 'colvisGroup',
          text: 'Ver Menos',
          hide : [ 2, 8, 13,14,19, 22, 17, 25, 26, 27, 28, 29 ,32,31],
                attr:  {
                id: 'btn-ver-menos'
            }
        },

        ],
        language: LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
    var timer;



await table.columns.adjust().draw();

$( "#dataTable thead tr:eq(1) th:eq(0)").removeClass( "sorting_asc");

createEmunrationForDatatable(table);

    $(document).ajaxStop(function() {

             elementMsgBackendProcess.html("");

           });


  }


function createEmunrationForDatatable(table){
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}



function createBarProcessForAjax(xhr,elementForShowProccesAjax,elementMsgBackendProcess){ 
                xhr.upload.addEventListener("progress", function(evt) {
                   if (evt.lengthComputable) {
                     var percentComplete = evt.loaded / evt.total;
                     percentComplete = parseInt(percentComplete * 100);
                       if(percentComplete<100){
                          elementForShowProccesAjax.html('<p class="text-center">Enviando... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                          elementForShowProccesAjax.html('<p class="text-center"></p>');
                //mensaje cuando el bakend este procesando datos de ajax

             elementMsgBackendProcess.html("</p>Procesando...<p>");

             // termine el proceso esconde el button de cancelar
              $(document).ajaxStop(function() {

             elementMsgBackendProcess.html("");

              });
             }
                      }
                    }, false);
                    return xhr;

}


function getParroquias(actionForAjax){
  $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'getParroquias':true},
      success:function(dataJson){
      var parroquias = JSON.parse(dataJson);
//      console.log(parroquias);
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

     var id_person = document.getElementById('id_person').value;

     var fecha_registro = document.getElementById('fecha_registro').value;

     var id_parroquia = document.getElementById('id_parroquia').value;

     var direccion = document.getElementById('direccion').value;
        
     var telefonoPart1 = document.getElementById('telefonoPart1').value;

     var telefonoPart2 = document.getElementById('telefonoPart1').value;

     var telefonoPart3 = document.getElementById('telefonoPart3').value;

    var catalog_key = document.getElementById("catalog_key_cie10").value;

  var ifIdentityDocumentIsRepeatedInOtherPersons = 0;

//  alert(getElementById('ifNotHaveIdentityDocument').checked);

    var id_nacionalidad = '';

    var doc_identidad = '';

  if (!document.getElementById('ifNotHaveIdentityDocument').checked) {
    var id_nacionalidad = document.getElementById('id_nacionalidad').value;

    var doc_identidad = document.getElementById('doc_identidad').value;

  }




 if (!isBlank(id_nacionalidad) && !isBlank(doc_identidad) && type =='update' && !document.getElementById('ifNotHaveIdentityDocument').checked) {

   server_url = $('#server_url').val();

 await $.ajax({
      type:'POST',
      url: server_url+'ajax/casosEpidemiAjax.php',
      data:{
      'id_person':id_person,
      'id_nacionalidad':id_nacionalidad,
      'doc_identidad':doc_identidad,
      'operationType':'ifIdentityDocumentIsRepeatedInOtherPersons'},

      success:function(dataJsonifIdentityDocumentIsRepeatedInOtherPersons){


      var dataifIdentityDocumentIsRepeatedInOtherPersons = JSON.parse(dataJsonifIdentityDocumentIsRepeatedInOtherPersons);
      
         ifIdentityDocumentIsRepeatedInOtherPersons = dataifIdentityDocumentIsRepeatedInOtherPersons[0];

        return ifIdentityDocumentIsRepeatedInOtherPersons;

 }
});

}

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


//console.log(isBlankBasicPerson,isBlankDataCaseEpidemi,isBlankDocIdentidad);

if (/*isBlankBasicPerson || isBlankDataCaseEpidemi || isBlankDocIdentidad*/isBlank(catalog_key)) {

        var alert = {'Alert': 'simple','Title':'Campos Vacios', 'Text':'Todos los campos del caso epidemiologico son obligatorios','Type':'error'};

        await ajaxSweetAlerts(alert);

              confirmSendAjax = false;
              return confirmSendAjax


}
/**/

var dataEventCIE10 = await getAttributesEventCIE10(catalog_key);

var msgWarningAttributesEventCIE10 = await getMsgWarningAttributesEventCIE10(dataEventCIE10);

if (msgWarningAttributesEventCIE10 != 0) {

  await Swal.fire({
    title: '¿Estás seguro?',
    html: '<span style="color: red;"><b>Este evento CIE 10 se considera:</b><br>'+msgWarningAttributesEventCIE10 + '<br><br><b>¿Desea continuar?</b></span>',
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



if (ifIdentityDocumentIsRepeatedInOtherPersons > 0) {

  await Swal.fire({
    title: '¿Estás seguro?',
    html: '<span style="color: red;"> Esta cedula la posee otra persona<br> si procede, se le asinaran los casos epidemiologicos a la persona entrante, y la anterior sera elminada. <br>¿Desea continuar?</b></span>',
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

}


if(confirmSendAjax){
       sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess);
}

}

}catch (e) {
    console.log(e);
  }


}
