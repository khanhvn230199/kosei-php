<?php

function default_login()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;

    $return = isset($_GET["return"]) ? base64_decode($_GET["return"]) : $clsRewrite->url_home();

    if ($core->_SESS->isLoggedin()) {
        header("location:" . $return);
    }

    $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : "";
    $user_pass = isset($_POST["user_pass"]) ? $_POST["user_pass"] : "";
    $btnLogin = isset($_POST["btnLogin"]) ? $_POST["btnLogin"] : "";

    $clsUsers = new Users();

    if ($btnLogin != "") {
        $user = $clsUsers->checkValidUserPass($user_name, $user_pass);

        if ($user) {
            $core->_SESS->doLogin($user);
            header("location:" . $return);
        } else {
            $arr_error['user_pass'] = "Tài khoản hoặc mật khẩu không đúng";
        }
    }

    foreach ($_POST as $key => $val) {
        $assign_list[$key] = $val;
    }

    $assign_list["valid"] = $valid;
    $assign_list["arr_error"] = $arr_error;

    //Begin SeoMoz
    $page_title = $core->getLang("Login");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}
