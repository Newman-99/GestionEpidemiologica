<?php 

const IF_LOCAL_SERVER =true;


//const SERVERURL="https://gestion-epidemiologica-paraiso.herokuapp.com/";

const SERVERURL = "http://localhost/gestionEpidemi/";

const ORGANIZATION = "Clinica Popular el Paraiso: Dpto de Epidemiologia";

const BASE_DIRECTORY = '/var/www/html/gestionEpidemi/';

date_default_timezone_set("America/Caracas");

error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors',1);
error_reporting(-1);

?>