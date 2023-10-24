<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=activeacc
 * Display activation page
 *
 */
function default_activeacc()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $clsRewrite;
    global $core, $_LANG_ID;
    if ($core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_home());
    }
    $clsUsers = new Users();
    $active_key = base64_decode($_GET["k"]);
    $e = base64_decode($_GET["e"]);
    $arr = $clsUsers->getByCond("email='$e' AND active_key='$active_key' AND is_active=0");
    if (is_array($arr) && $arr['user_id'] > 0) {
        if ($clsUsers->doActive($arr['user_id'])) {
            /*
             Begin Send Mail to user to notice that activation has been successfully
             %SITE_NAME% : tên của website
             %SITE_TITLE% : tiêu đề của website
             %SITE_HOTLINE% : hotline của website
             %FULL_NAME% : họ tên người đăng ký
             %USER_NAME% : tên đăng nhập
             */
            $post = array("FULL_NAME" => $arr['fullname'], "USER_NAME" => $arr['user_name']);
            send_mail_form("mail_register_success", $e, $post);
            //End Send Mail
            $success = 1;
        } else {
            $success = -1;
        }
    } else {
        $success = 0;
    }
    $assign_list["success"] = $success;
    //Begin SeoMoz
    $page_title = $core->getLang("Activation_account");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}