<?
/******************************************************
 * SubIndex File
 *
 * Run after index.php at root directory /
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  index.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        Tuanta          -        -     -     -
 *
 ********************************************************/

//Prevent run alone
if (!defined("VNCMS_DIR")) {
    die("Access denied!");
}

//Define Debug vars
define("SMARTY_DEBUG", false); //smarty debug or not
define("COMPILE_CHECK", true); //smarty compile check
define("ADODB_DEBUG", false); //adodb debug or not
define("HANDLE_ERROR", 0); //system error handling, 0: no, 1: yes
define("STOP_APP_IF_ERROR", 1); //application with stop if error happen? 0: no, 1: yes

//Define var: Root & Modules
define("DIR_ROOT", VNCMS_DIR . "/$WWW"); //Root dir is Module dir
define("DIR_MODULES", DIR_ROOT);

//Include core file
require_once DIR_COMMON . "/clsDbBasic.php";
require_once DIR_COMMON . "/clsCore.php";
require_once DIR_COMMON . "/clsModule.php";
require_once DIR_COMMON . "/Adapter.php";
require_once VNCMS_DIR . "/vendor/autoload.php";
require_once VNCMS_DIR . "/vendor/vimeo/vimeo-api/autoload.php";
require_once VNCMS_DIR . "/vendor/facebook/graph-sdk/src/Facebook/autoload.php";
//=================================================================================
//Include needle file
//=================================================================================
//Include all Function in lib directory
if (is_dir(DIR_LIB)) {
    $arrLibCustom = array();
    if ($dh = opendir(DIR_LIB)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, -3) == 'php') {
                array_push($arrLibCustom, $file);
            }

        }
        closedir($dh);
    }
    foreach ($arrLibCustom as $file) {
        require_once DIR_LIB . "/" . $file;
    }
}
//Include all Classes in class directory
if (is_dir(DIR_CLASSES)) {
    $arrClsCustom = array();
    if ($dh = opendir(DIR_CLASSES)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, -3) == 'php') {
                array_push($arrClsCustom, $file);
            }

        }
        closedir($dh);
    }
    foreach ($arrClsCustom as $file) {
        require_once DIR_CLASSES . "/" . $file;
    }
}
//Include all Shortcode in shortcode directory
if (is_dir(DIR_SHORTCODE)) {
    $arrShortcodeCustom = array();
    if ($dh = opendir(DIR_SHORTCODE)) {
        while (($file = readdir($dh)) !== false) {
            if (substr($file, -3) == 'php') {
                array_push($arrShortcodeCustom, $file);
            }

        }
        closedir($dh);
    }
    foreach ($arrShortcodeCustom as $file) {
        require_once DIR_SHORTCODE . "/" . $file;
    }
}
//Initiation Driver ADODB
require_once DIR_ADODB . "/adodb.inc.php";
$GLOBALS['ADODB_CACHE_DIR'] = DIR_CACHE_SQL;
$dbconn = &ADONewConnection(DB_TYPE);
$dbconn->debug = ADODB_DEBUG;
$dbconn->SetFetchMode(ADODB_FETCH_ASSOC);
if (isset($dbinfo) && is_array($dbinfo)) {
    $dbconn->PConnect($dbinfo['host'], $dbinfo['user'], $dbinfo['pass'], $dbinfo['db']);
} else {
    $dbconn->PConnect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}
$dbconn->Execute("SET NAMES utf8");

//Config Site Theme
$_SITE_THEME = "template";
/*
 * =====================================================================
 * INITIATION SECTION
 * =====================================================================
 */
//Get main vars: $mod, $act
$mod = GET("mod", "home");
$act = GET("act", "default");

//Initialize class Core
$core = new Core();

//Define some vars
define("SITE_THEME", $_SITE_THEME);
define("DIR_TEMPLATES_C", VNCMS_DIR . "/www_c/" . SITE_THEME); //compiled directory of smarty
define("DIR_TEMPLATES", DIR_THEMES . "/" . SITE_THEME); //template directory of smarty
define("DIR_IMAGES", DIR_THEMES . "/" . SITE_THEME . "/images"); //images directory
define("DIR_CSS", DIR_THEMES . "/" . SITE_THEME . "/css"); //css directory
define("DIR_JS", DIR_THEMES . "/" . SITE_THEME . "/js"); //javascript directory
define("DIR_UPLOADS", VNCMS_DIR . "/uploads"); //upload directory

//Define some URL vars with absolute path
define("URL_THEMES", VNCMS_URL . "/themes"); //full url of themes
define("URL_UPLOADS", VNCMS_URL . "/uploads"); //full url of uploads
define("URL_IMAGES", URL_THEMES . "/" . SITE_THEME . "/images"); //full url of images
define("URL_SOUND", URL_THEMES . "/" . SITE_THEME . "/audio"); //full url of images
define("URL_CSS", URL_THEMES . "/" . SITE_THEME . "/css"); //full url of css
define("URL_VENDOR", URL_THEMES . "/" . SITE_THEME . "/vendor"); //full url of vendor
define("URL_JS", URL_THEMES . "/" . SITE_THEME . "/js"); //full url of js
define("URL_ASSETS", URL_THEMES . "/" . SITE_THEME . "/assets"); //full url of assets

//Include Smarty core & initialize Smarty
require_once DIR_SMARTY . "/Smarty.class.php";
$smarty = new Smarty;
$smarty->compile_check = COMPILE_CHECK;
$smarty->debugging = SMARTY_DEBUG;
$smarty->template_dir = DIR_TEMPLATES;
$smarty->compile_dir = DIR_TEMPLATES_C;
$smarty->config_overwrite = true;

//Initialize vars $_LANG_ID for multi language purpose
$_LANG_ID = isset($_GET["lang"]) ? $_GET["lang"] : "";
if ($_LANG_ID != "") {
    vnSessionSetVar("DSI_LANG_ID", $_LANG_ID);
} else
if (vnSessionExist("DSI_LANG_ID")) {
    $_LANG_ID = vnSessionGetVar("DSI_LANG_ID");
} else {
    $_LANG_ID = LANG_DEFAULT;
}
$lang_code = $_LANG_ID;
$smarty->assign("_LANG_ID", $_LANG_ID);

/*
 * =====================================================================
 * CONTROL SECTION
 * =====================================================================
 */
/*Load Configuration START*/
$_CONFIG = array();
$clsSettings = new Settings();
$_CONFIG = $clsSettings->getAllSettings($lang_code);
if ($_CONFIG['is_close_site'] == 1) {
    $smarty->assign('close_site_notice', htmlDecode($_CONFIG['close_site_notice']));
    $smarty->display("website_close.tpl");
    exit();
}
unset($clsSettings);
/*Setting Loader END*/

/*Load Language START*/
$_LANG = array();
require_once DIR_LANG . "/$_LANG_ID/lang_frontend.php";
/*Load Language END*/

$my_cache_id = "";
if ($mod == "home11") {
    $smarty->setCacheDir(DIR_CACHE . "/tpl");
    // retain current cache lifetime for each specific display call
    $smarty->setCaching(Smarty::CACHING_LIFETIME_SAVED);
    // set the cache_lifetime 1 day
    $smarty->setCacheLifetime(1 * 24 * 3600);
    //$smarty->setCompileCheck(false);
    $my_cache_id = utf8_nosign_noblank($_SERVER['REQUEST_URI']);
}

//Include module by $mod (call modulde file)
$indextpl = ($smarty->templateExists("$mod.tpl")) ? "$mod.tpl" : "index.tpl";

if (!$smarty->isCached($indextpl, $my_cache_id)) {

    $clsTrialTest = new TrialTest();
    $now = time();
    $arrOneLatestTest = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
    if (!is_array($arrOneLatestTest)) {
        $arrOneLatestTest = $clsTrialTest->getByCond("start_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
    }
    $assign_list['arrOneLatestTest'] = $arrOneLatestTest;

//Include module by $mod (call modulde file)
    require_once DIR_MODULES . "/$mod/index.php";
//Assign vars to $assign_list
    $assign_list["VNCMS_URL"] = VNCMS_URL;
    $assign_list["URL_UPLOADS"] = URL_UPLOADS;
    $assign_list["URL_IMAGES"] = URL_IMAGES;
    $assign_list["URL_SOUND"] = URL_SOUND;
    $assign_list["URL_CSS"] = URL_CSS;
    $assign_list["URL_VENDOR"] = URL_VENDOR;
    $assign_list["URL_JS"] = URL_JS;
    $assign_list["SID"] = session_id();
    $assign_list["mod"] = $mod;
    $assign_list["act"] = $act;
    $assign_list["stdio"] = $stdio;
    $assign_list["core"] = $core;
    $assign_list["social"] = unserialize($_CONFIG['cat_id3']);

    $assign_list["Rewrite"] = $clsRewrite;
}

$assign_list["_CONFIG"] = $_CONFIG;
$assign_list["isLogin"] = $core->_SESS->isLoggedin();

//Assign $assign_list to Smarty & output
$smarty->assign($assign_list);

$smarty->display($indextpl, $my_cache_id);

$dbconn->Close();
//Free memory
unset($clsSettings, $core, $stdio, $smarty, $assign_list, $_CONFIG);
