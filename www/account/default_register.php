<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=register
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
function default_register()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;
    if ($core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_account());
    }
    $clsUsers = new Users();
    $btnRegister = POST("btnRegister", "");
    $success = GET("success", "");
    $valid = -1;
    $arr_error = array();
    if ($btnRegister != "" && $success == "") {
        $valid = $clsUsers->validateRegister($arr_error);
        if ($valid) {
            $ok = $clsUsers->doRegister();
            if ($ok) {
                $url = $clsRewrite->url_register() . "?success=1";
                header("location:$url");
                exit();
            } else {
                $valid = 0;
                $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
            }
        }
    }
    foreach ($_POST as $key => $val) {
        $assign_list[$key] = $val;
    }
    if ($success != "") {
        $sent_email = base64_decode($success);
    }
    $assign_list["success"] = $success;
    $assign_list["sent_email"] = $sent_email;
    $assign_list["valid"] = $valid;
    $assign_list["arr_error"] = $arr_error;

    //Begin SeoMoz
    $page_title = $core->getLang("Register");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}