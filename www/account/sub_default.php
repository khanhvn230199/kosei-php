<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=default
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;
    if (!$core->_SESS->isLoggedin()) {
        redirectURL($clsRewrite->url_login());
    }
    $current_user_id = $core->_USER['user_id'];
    $clsUsers = new Users();
    $btnSubmit = POST("btnSubmit", "");
    $province_id = isset($_POST["province_id"]) ? $_POST["province_id"] : 0;
    //Update Account Infos
    if ($btnSubmit == "UpdateAccount") {
        $avatar = $_FILES["avatar"];
        $error = FALSE;
        extract($_POST);
        $_POST['birthday'] = strtotime("$thang/$ngay/$nam");
        if (is_array($avatar) && $avatar['size'] != 0) {
            $new_avatar = "";
            $ftmp_name = $avatar["tmp_name"];
            $fname = $avatar["name"];
            $errNo = 0;
            if (checkValidImageFile($avatar, "", "", $errNo)) {
                if ($errNo == 0) {
                    $dir = DIR_UPLOADS . "/avatar/";
                    if (!file_exists($dir)) {
                        mkdir($dir);
                    }
                    $to_file = $current_user_id . "_" . $fname;
                    $ok = @move_uploaded_file($ftmp_name, $dir . $to_file);
                    if ($ok) {
                        $new_avatar = $to_file;
                        if ($core->_USER['avatar'] != "avatar/" . $to_file) {
                            unlink(DIR_UPLOADS . "/" . $core->_USER['avatar']);
                        }
                    }
                }
            }
            if ($new_avatar != "") {
                $clsUsers->doUpdateNewAvatar($current_user_id, $new_avatar);
            }
        }
        $valid = $clsUsers->validateEditProfile($error);
        if ($valid) {
            $ok = $clsUsers->doUpdateProfile($current_user_id);
            if ($ok) {
                $arr_error = array('status' => 'success', 'message' => $core->getLang('Update_successfully'), 'location' => $clsRewrite->url_account());
            } else {
                $arr_error = array('status' => 'error', 'message' => $core->getLang('Update_failed'));
            }
        } else {
            $arr_error = array('status' => 'error', 'message' => $core->getLang('Update_failed'));
        }
    }
    $assign_list['arr_error'] = $arr_error;
    $assign_list['error'] = $error;
    $assign_list['htmlOptionKhuvuc'] = makeListProvince($province_id, "", "province_id");
    //Begin SeoMoz
    $page_title = $core->getLang('Account');
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}