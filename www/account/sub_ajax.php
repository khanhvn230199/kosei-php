<?
function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

function ajax_login()
{
    global $core;
    $clsUsers = new Users();
    $btnLogin = isset($_POST["btnLogin"]) ? $_POST["btnLogin"] : "";
    $user_name = isset($_POST["user_name"]) ? $_POST["user_name"] : "";
    $user_pass = isset($_POST["user_pass"]) ? $_POST["user_pass"] : "";

    if ($btnLogin != "") {
        $user = $clsUsers->checkValidUserPass($user_name, $user_pass);
        if ($user) {
            $core->_SESS->doLogin($user);
            echo 1;
        } else {
            echo 0;
        }
    }
    exit();
}

function ajax_forgot()
{
    global $core;
    $arr_error = array('status' => 'error', 'message' => 'Bạn không thể thực hiện thao tác này!');
    if (!$core->_SESS->isLoggedin()) {
        $clsUsers = new Users();
        $btnForgot = POST("btnForgot", "");
        $msg_error = array();
        if ($btnForgot != "") {
            $valid = $clsUsers->validateForgot($msg_error);
            if ($valid) {
                $ok = $clsUsers->doForgot();
                if ($ok) {
                    $arr_error = array('status' => 'success', 'message' => 'Chúng tôi đã gửi liên kết thay đổi mật khẩu vào email của bạn!');
                } else {
                    $arr_error = array('status' => 'error', 'message' => 'Vui lòng nhập đúng thông tin đã đăng ký để có thể khôi phục mật khẩu!');
                }
            } else {
                if (is_array($msg_error) && count($msg_error) > 0) {
                    foreach ($msg_error as $e => $error) {
                        $message = $error;
                    }
                    $arr_error = array('status' => 'error', 'message' => $message);
                }
            }
        }
    }
    echo json_encode($arr_error);
    exit();
}
