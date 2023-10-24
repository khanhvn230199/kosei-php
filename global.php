<?
// error_reporting(0);
/******************************************************
 * Vars&Conts Definition
 *
 * Define some variables & contants
 * Require some files and init some class
 * Refine input from POST, GET
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  global.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name          Chng  Req   No    Remarks
 * 1.0           20/01/2018        banglcb          -          -     -     -
 *
 ********************************************************/
//=================================================================================
//Definition constants
//=================================================================================
//Set default timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (!isset($_SERVER['REQUEST_SCHEME'])) {
    $_SERVER['REQUEST_SCHEME'] = ($_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
}

if ($_SITE_ROOT == "admin") {
    define("VNCMS_DIR", $_SERVER['DOCUMENT_ROOT'] . trim(dirname(" " . dirname(" " . $_SERVER['SCRIPT_NAME']))));
    define("VNCMS_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . trim(dirname(" " . dirname(" " . $_SERVER['SCRIPT_NAME']))));
} else {
    define("VNCMS_DIR", $_SERVER['DOCUMENT_ROOT'] . trim(dirname(" " . $_SERVER['SCRIPT_NAME'])));
    define("VNCMS_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . trim(dirname(" " . $_SERVER['SCRIPT_NAME'])));
}
#Common Directory Definition
define("DIR_INCLUDES", VNCMS_DIR . "/includes");
define("DIR_CONFIGS", VNCMS_DIR . "/configs");
define("DIR_CACHE", VNCMS_DIR . "/cache");
define("DIR_CACHE_FILES", VNCMS_DIR . "/cache/files");
define("DIR_CACHE_SQL", VNCMS_DIR . "/cache/sql");
define("DIR_LANG", VNCMS_DIR . "/lang");
define("DIR_LOGS", VNCMS_DIR . "/logs");
define("DIR_THEMES", VNCMS_DIR . "/themes");
define("DIR_TMP", VNCMS_DIR . "/tmp");
define("DIR_CLASSES", DIR_INCLUDES . "/classes");
define("DIR_COMMON", DIR_INCLUDES . "/common");
define("DIR_SMARTY", DIR_INCLUDES . "/smarty3");
define("DIR_ADODB", DIR_INCLUDES . "/adodb5");
define("DIR_LIB", DIR_INCLUDES . "/lib");
define("DIR_SHORTCODE", DIR_INCLUDES . "/shortcode");
define('DIR_FACEBOOK', DIR_INCLUDES . '/Facebook/');
define('DIR_GOOGLE', DIR_INCLUDES . '/Google/');
define('DIR_VENDOR', VNCMS_DIR . '/vendor');

#Define LogFile
define("LOG_SYSTEM_FILE", DIR_LOGS . "/system.log");
define("LOG_MAIL_FILE", DIR_LOGS . "/mail.log");

#Define Language default
define("LANG_DEFAULT", "vn");

#Define Cookie vars
$COOKIE_NAME = "kosei";
$COOKIE_TIME_OUT = 5 * 24 * 3600; //5 days
$COOKIE_PREFIX = "dvs_";
$COOKIE_USER = $COOKIE_PREFIX . "UID";
$COOKIE_PASS = $COOKIE_PREFIX . "PKEY";

#Define Session vars
$SESSION_NAME = "kosei";
$SESSION_PATH = "/tmp";
$SESSION_COOKIE = 1; //1: user cookie, 0: no cookie
$SESSION_TIME_OUT = 5 * 3600; //5h
//=================================================================================
//Include needle file

$urgent = $_SERVER['HTTP_USER_AGENT'];
$isMobile = (strpos($urgent, "Mobile")>0)? 1: 0;
$isTestSpeed = (strpos($urgent, "Lighthouse")>0)? 1: 0; //Lighthouse


//=================================================================================
//Include database & contant file
require_once DIR_CONFIGS . "/contants.inc.php";
require_once DIR_CONFIGS . "/database.inc.php";

//Include handling & logging file
require_once DIR_COMMON . "/clsLogging.php";
require_once DIR_COMMON . "/vnErrorHandler.php";

//Include session controller file
require_once DIR_COMMON . "/vnSession.php";

//Setup a session
if (!vnSessionSetup()) {
    trigger_error('Session setup failed', E_USER_ERROR);
    exit();
}

//Initialize a session
if (!vnSessionInit()) {
    trigger_error('Session initiation failed', E_USER_ERROR);
    exit();
}

//Include cookie controller file
require_once DIR_COMMON . "/clsCookie.php";

//Setup a cookie
$clsCookie = new VnCookie($COOKIE_NAME, $COOKIE_TIME_OUT);

//Include Std In/Out file
require_once DIR_COMMON . "/clsStdio.php";
//Refine variables: $_GET, $_POST
$stdio = new Stdio();
$_GET = $stdio->parse_incoming(true);
$_POST = $stdio->parse_incoming(false);

//Initialize an array globally which contain all variables to assigning to Smarty
$assign_list = array();
$shortcode_tags = array();

$assign_list['isMobile'] = $isMobile;
$assign_list['isTestSpeed'] = $isTestSpeed;


function vd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}
