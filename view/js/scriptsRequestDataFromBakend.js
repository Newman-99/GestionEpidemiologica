
      function queryFieldsToDataTablesActivityLog(requestedAliasUser,minDateRange,maxDateRange,action){
    var table = $('#dataTable').DataTable({
       "aaSorting": [[ 1, "asc" ]], // Sort by first column descending
        "bProcessing": true,
        "bDeferRender": true, 
        "bServerSide": true,
        "sAjaxSource": action+"?activityLogSessions=view&minDateRange="+minDateRange+"&maxDateRange="+maxDateRange+"&requestedAliasUser="+requestedAliasUser, 
        "columnDefs": [ 
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false                
            }
          ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};


      function queryFieldsToDataTablesCie10Catalog(url,idCapitulo){
    
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
function getCasesCIE10BySearchPattern(valueSearch,idCapituloCIE10,urlAjax){

  $.ajax({
      type:'POST',
      url: urlAjax,
      data:{'valueSearch': valueSearch,
          'idCapituloCIE10':idCapituloCIE10,'getCasesCIE10':true},
     success:function(casesCIE10){
      console.log(casesCIE10); 
      casesCIE10 = JSON.parse(casesCIE10);
      $('#casesCIE10').empty();
      casesCIE10.forEach(function(casesCIE10){
        $('#casesCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })                   
      }
    }); 
  }

// devolvera datos para el select dinamico
function getCasesCIE10ByidCapitulo(idCapituloCIE10,urlAjax){
  $.ajax({
      type:'POST',
      url: urlAjax,
      data:{'idCapituloCIE10':
      idCapituloCIE10,'getCasesCIE10':true,'searchByChapter':true},
      success:function(casesCIE10){
      console.log(casesCIE10);
      casesCIE10 = JSON.parse(casesCIE10);
      $('#casesCIE10').empty();
      casesCIE10.forEach(function(casesCIE10){
        $('#casesCIE10').append('<option value='+casesCIE10.catalog_key+'>'+casesCIE10.catalog_key + ' - ' + casesCIE10.nombre + '</option>')
        })
       }
     }); 
}

