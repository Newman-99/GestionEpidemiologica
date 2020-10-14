
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

  $.ajax({
      type:'POST',
      url: actionForAjax,
      data:{'valueSearch': valueSearch,
          'idCapituloCIE10':idCapituloCIE10,'getCasesCIE10':true},
     success:function(casesCIE10){
      console.log(casesCIE10); 
      casesCIE10 = JSON.parse(casesCIE10);
      $('#catalogKeyCIE10').empty();
      casesCIE10.forEach(function(casesCIE10){
        $('#catalogKeyCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })                   
      }
    }); 
  }

// devolvera datos para el select dinamico
function getCasesCIE10ByidCapitulo(idCapituloCIE10,actionForAjax){
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
       }
     }); 
}


function getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 1, "asc" ]], // Sort by first column descending
        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": action+"?viewCasosEpidemi=true&minDateRange="+minDateRange+"&maxDateRange="+maxDateRange+"&requestedPersonEpidemi="+requestedPersonEpidemi+"&nameDateFieldDB="+'fecha_registro'/*, 
        "columnDefs": [ 
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false                
            }
          ]*/,'language': LANGUAGE_SPANISH_DATATABLES,
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


