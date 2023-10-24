<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=logout
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
function default_logout()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;
    $return = isset($_GET["return"]) ? base64_decode($_GET["return"]) : $clsRewrite->url_home();
    $core->_SESS->doLogout();
    header("location:" . $return);
    exit();
}