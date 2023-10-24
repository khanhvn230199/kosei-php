<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=resetpass
 * Display reset password page
 *
 */
function default_changeinfo()
{
    global $assign_list, $_CONFIG, $clsRewrite, $mod;
    global $core;
    if (!$core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_home());
    }
    $current_user_id = $core->_USER['user_id'];
    $current_user_name = $core->_USER['user_name'];
    $clsUsers = new Users();
    $btnChangeEmail = POST("btnChangeEmail", "");
    $btnChangePhone = POST("btnChangePhone", "");
    $btnChangePass = POST("btnChangePass", "");
    //Update Account Info
    if (is_array($_POST)) extract($_POST);
    if ($btnChangeEmail == "save") {
        if ($clsUsers->checkValidUserPass($current_user_name, $user_pass) == 1) {
            $valid = $clsUsers->validateEmail($email, "", $msg_error);
            if ($valid) {
                $ok = $clsUsers->updateByCond("user_id=$current_user_id", "email='$email'");
                if ($ok) {
                    $arr_error = array('status' => 'success', 'message' => $core->getLang('Cập nhật thông tin thành công!'), 'location' => $clsRewrite->url_account());
                } else {
                    $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
                }
            }
        } else {
            $msg_error['user_pass1'] = "Mật khẩu đã nhập không chính xác!";
        }
    } elseif ($btnChangePhone == "save") {
        if ($clsUsers->checkValidUserPass($current_user_name, $user_pass) == 1) {
            $valid = $clsUsers->validatePhone($phone, $msg_error);
            if ($valid) {
                $ok = $clsUsers->updateByCond("user_id=$current_user_id", "mobile='$phone'");
                if ($ok) {
                    $arr_error = array('status' => 'success', 'message' => $core->getLang('Cập nhật thông tin thành công!'), 'location' => $clsRewrite->url_account());
                } else {
                    $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
                }
            }
        } else {
            $msg_error['user_pass2'] = "Mật khẩu đã nhập không chính xác!";
        }
    } elseif ($btnChangePass == "save") {
        $valid = $clsUsers->validateChangePass($msg_error);
        if ($valid) {
            $ok = $clsUsers->updatePassword($current_user_id);
            if ($ok) {
                $arr_error = array('status' => 'success', 'message' => $core->getLang('Cập nhật thông tin thành công!'), 'location' => $clsRewrite->url_account());
            } else {
                $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
            }
        }
    }
    $assign_list['arr_error'] = $arr_error;
    $assign_list['msg_error'] = $msg_error;
    //Begin SeoMoz
    $page_title = $core->getLang('Account');
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}
