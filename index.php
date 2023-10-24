<?
/******************************************************
 * Index File
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  index.php
 * Environment                :  PHP  version version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name          Chng  Req   No    Remarks
 * 1.0           20/01/2018        banglcb          -          -     -     -
 *
 ********************************************************/
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    ob_start("ob_gzhandler");
} else {
    ob_start();
}

//Setup site root & module dir
$_SITE_ROOT = "root";

//Include Global file
require_once "global.php";

$WWW = "www";
require_once DIR_CACHE . "/category.config.php";

//Include Class Rewrite for control URL Friendly
require_once "url_rewrite.php";

//Include SubIndex
require_once VNCMS_DIR . "/$WWW/index.php";
