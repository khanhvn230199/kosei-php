<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=trialtestregister
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
function default_trialtestregister ()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;

    $clsUsers = new Users();
    $btnRegister = POST("btnRegister", "");
    $success = GET("success", "");
    $valid = -1;
    $arr_error = array();

    $clsTrialTest = new TrialTest();

    $now = time();
    $arrOneLatestTest = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");

    if (!is_array($arrOneLatestTest)) {
        $arrOneLatestTest = $clsTrialTest->getByCond("start_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
    }

    if (!$core->_SESS->isLoggedin()) {
        if ($btnRegister != "" && $success == "") {
            $valid = $clsUsers->validateRegister($arr_error);
            if ($valid) {
                $ok = $clsUsers->doRegister();
                if ($ok) {
                    $url = $clsRewrite->url_trialtestregister() . "?success=1";
                    header("location:$url");
                    exit();
                } else {
                    $valid = 0;
                    $arr_error['insertdb'] = $core->getLang("Cannot_insert_db");
                }
            }
        }
        foreach ($_POST as $key => $val) {
            $assign_list[$key] = $val;
        }
        if ($success != "") {
            $sent_email = base64_decode($success);
        }
    } else {
        $user_id = $core->_USER['user_id'];
        $clsCandidates = new Candidates();
        $arrOneCandidates = $clsCandidates->getByCond("user_id=$user_id AND tt_id = $arrOneLatestTest[tt_id]");
        if (is_array($arrOneCandidates) && count($arrOneCandidates) > 0) {
            redirectURL($clsRewrite->url_trialtest());
        }
        if ($btnRegister != "" && $success == "") {
            extract($_POST);
            $reg_date = time();
            $valid = $clsUsers->validateAgree($agree, $arr_error['agree']);
            if ($valid) {
                $ok = $clsCandidates->insertOne("user_id,tt_id,level_id,reg_date", "$user_id,$arrOneLatestTest[tt_id],$level_id,$reg_date");
                if ($ok) {
                    $url = $clsRewrite->url_trialtestregister() . "?success=1";
                    header("location:$url");
                    exit();
                } else {
                    $valid = 0;
                    $arr_error = array(
                        'status'  => 'error',
                        'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'),
                    );
                }
            }
        }
    }

    $assign_list["success"] = $success;
    $assign_list["sent_email"] = $sent_email;
    $assign_list["valid"] = $valid;
    $assign_list["arr_error"] = $arr_error;
    $assign_list["optionLevel"] = makeListLevel($assign_list['level_id']);

    //Begin SeoMoz
    $page_title = $core->getLang("Register");
    $_CONFIG["page_title"] = $page_title . " - " . $_CONFIG["site_title"];
    $_CONFIG["page_description"] = $_CONFIG["site_description"];
    //End SeoMoz
}
