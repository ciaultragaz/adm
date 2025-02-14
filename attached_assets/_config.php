<?php
session_start();
error_reporting(E_ALL);
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

//define
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

$a      = (isset($_REQUEST['a']))       ? $_REQUEST['a'] : null;
$action = (isset($_REQUEST['action']))  ? $_REQUEST['action'] : null;

$b = (isset($_REQUEST['b'])) ? $_REQUEST['b'] : null;
$c = (isset($_REQUEST['c'])) ? $_REQUEST['c'] : null;

$domain = 'http://' . $_SERVER['HTTP_HOST'] . '/';
$domainFolder = "attached_assets";
$localFolder = "";

$googleApiKey = "AIzaSyBU7p8sZfVLmH2rHV_Ix-9xaB39C26WrTw";
$idUser = (isset($_SESSION['idUser'])) ? $_SESSION['idUser'] : null;
$idCargo = (isset($_SESSION['idCargo'])) ? $_SESSION['idCargo'] : null;
$idsMenu = (isset($_SESSION['idsMenu'])) ? $_SESSION['idsMenu'] : null;
$loginNome = (isset($_SESSION['nome'])) ? $_SESSION['nome'] : null;
$modulePage = $a.'-'.$b;
$sessionLogin = (isset($_SESSION['cliente_logado'])) ? $_SESSION['cliente_logado'] : null;
$toggleMenu = (isset($_SESSION['toggleMenu'])) ? $_SESSION['toggleMenu'] : null;
$userCargo = (isset($_SESSION['cargo'])) ? $_SESSION['cargo'] : null;

if ($_SERVER['HTTP_HOST'] == 'adm.ultragaz24horas.com' || $_SERVER['HTTP_HOST'] == 'developer.ultragaz24horas.com') {
    define('CLASSESS', $_SERVER["DOCUMENT_ROOT"] . '/' . 'class' . DS);
    define('DB_SERVER', '165.227.91.84');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'A@UltraLeste');
    define('DB_DATABASE', 'base');
    define('DB_PORT', '3306');
    $localFolder = '';
}
function getFolder() {
    $folder = array_reverse(explode(DS, getcwd()));
    return $folder[0];
}
function calcHours($time1,$time2){
    $entrada = $time1;
    $saida = $time2;
    $hora1 = explode(":",$entrada);
    $hora2 = explode(":",$saida);
    $seconds = isset($hora1[2]) ? $hora1[2] : 0;
    $acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $seconds;
    $acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $seconds;
    $resultado = $acumulador2 - $acumulador1;
    $hora_ponto = floor($resultado / 3600);
    $resultado = $resultado - ($hora_ponto * 3600);
    $min_ponto = floor($resultado / 60);
    $resultado = $resultado - ($min_ponto * 60);
    $secs_ponto = $resultado;
    //Grava na variável resultado final
    return Util::lpad($hora_ponto).":".Util::lpad($min_ponto).":".Util::lpad($secs_ponto);
}
//echo $_SERVER['SCRIPT_FILENAME'];
//exit();
if (
    $sessionLogin == null
    && basename($_SERVER['SCRIPT_FILENAME']) != '_s.php'
    && basename($_SERVER['SCRIPT_FILENAME']) != 'serviceLogin.php'
    && $_SERVER['SCRIPT_FILENAME'] != '/var/www/html/'.$domainFolder.'/login/index.php'
) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . '/' . $localFolder . 'login');
}

# Autoload
require(dirname(__FILE__).'/vendor/autoload.php'); # Autoload Composer
require(dirname(__FILE__).'/vendor/adodb/adodb-php/adodb.inc.php');

spl_autoload_register(function ($class) {
    include  CLASSESS . $class . '.class.php';
});

if($a=='logout'){
    $Db = new Db('appUltraleste');
    $Db->idModule = 3;
    $Db->idAction = 9999;
    $Db->idRegister = $idUser;
    $Db->log();
    session_destroy();
    header('Location: /');
}