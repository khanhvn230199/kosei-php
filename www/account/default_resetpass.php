<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=resetpass
 * Display reset password page
 *
 */
function default_resetpass()
{
    global $assign_list, $_CONFIG, $clsRewrite, $mod;
    global $core;
    if ($core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_home());
    }
    $clsUsers = new Users();
    $clsPublicKey = new PublicKey();
    $btnReset = POST("btnReset", "");
    $reset = GET("k", "");
    $email = GET("e", "");
    if ($reset != "") {
        $keyid = base64_decode($reset);
        $email = base64_decode($email);
        $existskey = $clsPublicKey->isExists($keyid);
    } else {
        $existskey = 0;
    }
    $success = 0;
    $valid = -1;
    if ($btnReset != "" && $existskey == 1) {
        $valid = $clsUsers->validateResetPass($msg_error);
        if ($valid) {
            $ok = $clsUsers->doResetPass();
            if ($ok) {
                $url = $clsRewrite->url_resetpass() . "?success=1";
                header("location:$url");
                exit();
            } else {
                $valid = 0;
                $msg_error['insertdb'] = $core->getLang("Cannot_insert_db");
            }
        }
    }
    $assign_list["valid"] = $valid;
    $assign_list["msg_error"] = $msg_error;
    $assign_list["success"] = $success;
    $assign_list["existskey"] = $existskey;
    //Begin SeoMoz
    $page_title = $core->getLang("Reset_password");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}