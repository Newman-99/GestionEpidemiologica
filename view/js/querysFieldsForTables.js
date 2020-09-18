
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
          {'data': 'doc_identidad'},
          {'data': 'usuario_alias'},
          {'data': 'nombres'},
          {'data': 'apellidos'},
          {'data': 'descripcion_nivel_permiso'},
          {'data': 'bitacora_fecha'},
          {'data': 'bitacora_hora_inicio'},
          {'data': 'bitacora_hora_final'}
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
{'data' : 'consecutivo'},
{'data' : 'letra'},
{'data' : 'catalog_key'},
{'data' : 'nombre'},
{'data' : 'codigox'},
{'data' : 'lsex'},
{'data' : 'linf'},
{'data' : 'lsup'},
{'data' : 'trivial'},
{'data' : 'erradicado'},
{'data' : 'n_inter'}, 
{'data' : 'nin'}, 
{'data' : 'ninmtobs'}, 
{'data' : 'cod_sit_lesion'}, 
{'data' : 'no_cbd'}, 
{'data' : 'cbd'}, 
{'data' : 'no_aph'}, 
{'data' : 'af_prin'}, 
{'data' : 'dia_sis'}, 
{'data' : 'clave_programa_sis'}, 
{'data' : 'cod_complemen_morbi'}, 
{'data' : 'def_fetal_cm'}, 
{'data' : 'def_fetal_cbd'}, 
{'data' : 'clave_capitulo'}, 
{'data' : 'capitulo'}, 
{'data' : 'lista1'}, 
{'data' : 'grupo1'}, 
{'data' : 'lista5'}, 
{'data' : 'rubrica_type'}, 
{'data' : 'year_modifi'}, 
{'data' : 'year_aplicacion'}, 
{'data' : 'valid'}, 
{'data' : 'prinmorta'}, 
{'data' : 'prinmorbi'}, 
{'data' : 'lm_morbi'}, 
{'data' : 'lm_morta'}, 
{'data' : 'lgbd165'}, 
{'data' : 'lomsbeck'}, 
{'data' : 'lgbd190'}, 
{'data' : 'notdiaria'}, 
{'data' : 'notsemanal'}, 
{'data' : 'sistema_especial'}, 
{'data' : 'birmm'}, 
{'data' : 'cve_causa_type'}, 
{'data' : 'causa_type'}, 
{'data' : 'epi_morta'}, 
{'data' : 'edas_e_iras_en_m5'}, 
{'data' : 'csve_maternas_seed_epid'}, 
{'data' : 'epi_morta_m5'}, 
{'data' : 'epi_morbi'}, 
{'data' : 'def_maternas'}, 
{'data' : 'es_causes'}, 
{'data' : 'num_causes'}, 
{'data' : 'es_suive_morta'}, 
{'data' : 'es_suive_morb'}, 
{'data' : 'epi_clave'}, 
{'data' : 'epi_clave_desc'}, 
{'data' : 'es_suive_notin'}, 
{'data' : 'es_suive_est_epi'}, 
{'data' : 'es_suive_est_brote'}, 
{'data' : 'sinac'}, 
{'data' : 'prin_sinac'}, 
{'data' : 'prin_sinac_grupo'}, 
{'data' : 'descripcion_sinac_grupo'}, 
{'data' : 'prin_sinac_subgrupo'}, 
{'data' : 'descripcion_sinac_subgrupo'}, 
{'data' : 'daga'}, 
{'data' : 'asterisco'}
          ],'language': LANGUAGE_SPANISH_DATATABLES,
                "bDestroy": true,

    });
  
};

