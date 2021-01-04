<?php



        $requestAjax =  false;

    require_once "./config/app.php";

    require_once "./controller/cie10DataController.php";
    
            $cie10DataController = new cie10DataController();



    $queryGetCatalogCIE10 = "SELECT consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco FROM data_cie10 ORDER BY consecutivo asc ";

        $queryGetCatalogCIE10 = $cie10DataController::connectDB()->query($queryGetCatalogCIE10);

$dataForWrite = [];

        while($rows=$queryGetCatalogCIE10->fetch(PDO
            ::FETCH_NUM)){           

    $encodedRows = $cie10DataController::utf8_converter($rows);
var_dump($encodedRows);

exit();

         }

?>