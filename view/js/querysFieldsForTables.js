
      function queryFieldsToDataTablesActivityLog(requestedAliasUser,minDateRange,maxDateRange,action){
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


      function queryFieldsToDataTablesCie10Catalog(url,idCapitulo){
    
    var table = $('#dataTable').DataTable({
          "bSort": true,    
          "processing": true,
            "ajax":{
            'url' :url, // json datasource
            'type': "post",  // method  , by default get
          'data': {
          'cie10listCatalog':true,
          'idCapitulo':idCapitulo
        },
          "dataSrc":"",         
            },
            "columns":[
{'data' : 'CONSECUTIVO'},
{'data' : 'LETRA'},
{'data' : 'CATALOG_KEY'},
{'data' : 'NOMBRE'},
{'data' : 'CODIGOX'},
{'data' : 'LSEX'},
{'data' : 'LINF'},
{'data' : 'LSUP'},
{'data' : 'TRIVIAL'},
{'data' : 'ERRADICADO'},
{'data' : 'N_INTER'}, 
{'data' : 'NIN'}, 
{'data' : 'NINMTOBS'}, 
{'data' : 'COD_SIT_LESION'}, 
{'data' : 'NO_CBD'}, 
{'data' : 'CBD'}, 
{'data' : 'NO_APH'}, 
{'data' : 'AF_PRIN'}, 
{'data' : 'DIA_SIS'}, 
{'data' : 'CLAVE_PROGRAMA_SIS'}, 
{'data' : 'COD_COMPLEMEN_MORBI'}, 
{'data' : 'DEF_FETAL_CM'}, 
{'data' : 'DEF_FETAL_CBD'}, 
{'data' : 'CLAVE_CAPITULO'}, 
{'data' : 'CAPITULO'}, 
{'data' : 'LISTA1'}, 
{'data' : 'GRUPO1'}, 
{'data' : 'LISTA5'}, 
{'data' : 'RUBRICA_TYPE'}, 
{'data' : 'YEAR_MODIFI'}, 
{'data' : 'YEAR_APLICACION'}, 
{'data' : 'VALID'}, 
{'data' : 'PRINMORTA'}, 
{'data' : 'PRINMORBI'}, 
{'data' : 'LM_MORBI'}, 
{'data' : 'LM_MORTA'}, 
{'data' : 'LGBD165'}, 
{'data' : 'LOMSBECK'}, 
{'data' : 'LGBD190'}, 
{'data' : 'NOTDIARIA'}, 
{'data' : 'NOTSEMANAL'}, 
{'data' : 'SISTEMA_ESPECIAL'}, 
{'data' : 'BIRMM'}, 
{'data' : 'CVE_CAUSA_TYPE'}, 
{'data' : 'CAUSA_TYPE'}, 
{'data' : 'EPI_MORTA'}, 
{'data' : 'EDAS_E_IRAS_EN_M5'}, 
{'data' : 'CSVE_MATERNAS_SEED_EPID'}, 
{'data' : 'EPI_MORTA_M5'}, 
{'data' : 'EPI_MORBI'}, 
{'data' : 'DEF_MATERNAS'}, 
{'data' : 'ES_CAUSES'}, 
{'data' : 'NUM_CAUSES'}, 
{'data' : 'ES_SUIVE_MORTA'}, 
{'data' : 'ES_SUIVE_MORB'}, 
{'data' : 'EPI_CLAVE'}, 
{'data' : 'EPI_CLAVE_DESC'}, 
{'data' : 'ES_SUIVE_NOTIN'}, 
{'data' : 'ES_SUIVE_EST_EPI'}, 
{'data' : 'ES_SUIVE_EST_BROTE'}, 
{'data' : 'SINAC'}, 
{'data' : 'PRIN_SINAC'}, 
{'data' : 'PRIN_SINAC_GRUPO'}, 
{'data' : 'DESCRIPCION_SINAC_GRUPO'}, 
{'data' : 'PRIN_SINAC_SUBGRUPO'}, 
{'data' : 'DESCRIPCION_SINAC_SUBGRUPO'}, 
{'data' : 'DAGA'}, 
{'data' : 'ASTERISCO'}
          ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};

