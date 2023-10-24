<?

/******************************************************
 * Class Core
 *
 * Kernel class of application, start Session and do special actions
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  clsCore.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        2014/02/10        TuanTA          -        -     -     -
 *
 ********************************************************/
class Core
{
    var $_REMOTE_ADDR = "";
    var $_PERMISS = array();
    var $_USER = array();
    var $_SESS = "";
    var $_version = "CMS Version 2.0";
    var $_copyright = "&copy; 2007-%YEAR% All Rights Reserved.";
    var $_webmaster = "tuantavnu@gmail.com";

    //init
    function Core()
    {
        // echo 2222;
        // die();
        global $mod, $_SITE_ROOT;
        //check module $mod
        if (!file_exists(DIR_MODULES . "/$mod")) {
            trigger_error("ModuleFile is not found!", E_USER_ERROR);
            exit();
        }
        $this->_REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
        //session management
        $this->_SESS = new Session();
        $this->_SESS->setup();
        if ($this->_SESS->loggedin == 1) {
            $clsUsers = new Users();
            $this->_USER = $clsUsers->getOne($this->_SESS->user_id);
            if ($this->_USER['extrafield'] != "") {
                $this->_USER['extrafield'] = @unserialize($this->_USER['extrafield']);
            }
            if ($this->_USER["admin_permiss"] != "") {
                $this->_PERMISS = @unserialize($this->_USER["admin_permiss"]);
            }
            unset($clsUsers);
        } else {
            $this->_USER = array();
        }
    }

    function getLang($key)
    {
        global $_LANG;
        if (strpos($key, " ") !== false) {
            $arr = str_word_count($key, 1, '_');
            foreach ($arr as $k => $v) {
                $val = trim($v, "'?,");
                $trans = (isset($_LANG[$val])) ? $_LANG[$val] : $val;
                $key = str_replace($val, $trans, $key);

            }
            return $key;
        } else {
            $val = trim($key, "'?,");
            $trans = (isset($_LANG[$val])) ? $_LANG[$val] : $val;
            $key = str_replace($val, $trans, $key);
            return $key;
        }
        return $key;
    }

    function template_exists($template)
    {
        global $smarty;
        return $smarty->templateExists($template);
    }

    function call_func()
    {
        $numargs = func_num_args();
        $func_name = func_get_arg(0);
        $param_arr = array();
        for ($i = 1; $i < $numargs; $i++)
            $param_arr[] = func_get_arg($i);
        return call_user_func_array($func_name, $param_arr);
    }

    function callfunc()
    {
        $numargs = func_num_args();
        $func_name = func_get_arg(0);
        $param_arr = array();
        for ($i = 1; $i < $numargs; $i++)
            $param_arr[] = func_get_arg($i);
        return call_user_func_array($func_name, $param_arr);
    }

    //echo sidebar
    function echoSideBar($sidebar = '')
    {
        global $_arr_sidebar_type;
        if ($sidebar == '' || !isset($_arr_sidebar_type[$sidebar])) return "";
        $clsWidget = new Widget();
        $arrListWidget = $clsWidget->getListOn($sidebar);
        $html = "";
        if (is_array($arrListWidget))
            foreach ($arrListWidget as $key => $val) {
                $html .= $clsWidget->render($val);
            }
        echo $html;
        unset($clsWidget);//free memory
        return;
    }

    //echo menu
    function echoMenu($mtype = 'top')
    {
        global $_arr_menu_type, $smarty;
        if ($mtype == '' || !isset($_arr_menu_type[$mtype])) return "";
        $clsMenu = new Menu();
        $arrListMenu = $clsMenu->getAllMenuLink(0, $mtype);
        $smarty->assign("arrListMenu", $arrListMenu);
        $html = $smarty->fetch("_menu/_" . $mtype . ".tpl");
        echo $html;
        unset($clsMenu);//free memory
        return;
    }

    //echo slider
    function echoSlider($slider_type = 'main')
    {
        global $_arr_slider_type, $smarty;
        if ($slider_type == '' || !isset($_arr_slider_type[$slider_type])) return "";
        $clsSliders = new Sliders();
        $arrListSlider = $clsSliders->getListOn($slider_type);
        if (is_array($arrListSlider))
            foreach ($arrListSlider as $key => $val) {
                $arrListSlider[$key]['vars'] = unserialize($val['vars']);
            }
        $smarty->assign("arrListSlider", $arrListSlider);
        $html = $smarty->fetch("_slider/_" . $slider_type . ".tpl");
        echo $html;
        unset($clsSliders);//free memory
        return;
    }

    //echo advertisment
    function echoAdver($position = "R1", $tem = 'adver', $default_tem = '', $cond = '')
    {
        global $smarty, $stdio;
        $mod = $stdio->GET("mod", "home");
        $sub = $stdio->GET("sub", "default");
        $act = $stdio->GET("act", "default");
        $mod_sub_act = $mod . '_' . $sub . '_' . $act;
        $clsAdver = new Adver();
        $arrListAdver = $clsAdver->getByPosition($position, $mod_sub_act, $cond);
        $smarty->assign("arrListAdver", $arrListAdver);
        $caching = $smarty->caching;
        $smarty->caching = false;
        $html = (is_array($arrListAdver) && count($arrListAdver) > 0) ? $smarty->fetch("_adver/_" . $tem . ".tpl") : "";
        $smarty->assign("arrListAdver", array());
        if ($html == "" && $default_tem != "") $html = $smarty->fetch($default_tem . ".tpl");
        $smarty->caching = $caching;
        echo $html;
        unset($clsAdver, $arrListAdver);//free memory
        return;
    }


    //echo advertisment
    function echoAdverNonTime($position = "R1", $tem = 'adver', $default_tem = '', $cond = '')
    {
        global $smarty, $stdio;
        $mod = $stdio->GET("mod", "home");
        $sub = $stdio->GET("sub", "default");
        $act = $stdio->GET("act", "default");
        $mod_sub_act = $mod . '_' . $sub . '_' . $act;
        $clsAdver = new Adver();
        $arrListAdver = $clsAdver->getByPositionNonTime($position, $mod_sub_act, $cond);
        $smarty->assign("arrListAdver", $arrListAdver);
        $caching = $smarty->caching;
        $smarty->caching = false;
        $html = (is_array($arrListAdver) && count($arrListAdver) > 0) ? $smarty->fetch("_adver/_" . $tem . ".tpl") : "";
        $smarty->assign("arrListAdver", array());
        if ($html == "" && $default_tem != "") $html = $smarty->fetch($default_tem . ".tpl");
        $smarty->caching = $caching;
        echo $html;
        unset($clsAdver, $arrListAdver);//free memory
        return;
    }

    function radio_selected($arr, $seleted)
    {
        if (is_array($arr) && count($arr) != 0) {
            foreach ($arr as $value) {
                if (trim($value) == trim($seleted)) {
                    return "checked";
                }
            }
        }
    }
}

//
class Session extends DbBasic
{
    var $session_id = "";
    var $user_id = 0;
    var $ip_address = "";
    var $running_time = "";
    var $loggedin = "";
    var $timeout = 0;

    function Session()
    {
        $this->tbl = "_session";
        $this->pkey = "session_id";
    }

    function setup()
    {
        global $SESSION_TIME_OUT, $_SITE_ROOT;
        $clsUsers = new Users();
        $clsStats = new Stats();
        $this->session_id = session_id();
        $this->ip_address = $_SERVER['REMOTE_ADDR'];
        $this->running_time = time();
        $this->loggedin = 0;
        $this->user_id = 0;
        if (vnSessionExist("LOGGEDIN")) {
            $this->loggedin = vnSessionGetVar("LOGGEDIN");
        }
        $arrSession = $this->getOne($this->session_id);
        if (is_array($arrSession) && $arrSession["loggedin"] == 1 && $arrSession["running_time"] + $SESSION_TIME_OUT < $this->running_time) {
            $this->timeout = 1;
            $this->loggedin == 0;
            vnSessionSetVar("LOGGEDIN", 0);
            vnSessionSetVar("NVC_USERNAME", "");
            vnSessionSetVar("NVC_PASSWORD", "");
            vnSessionSetVar("UID", "");
            vnSessionSetVar("PROVIDER", "");
            vnSessionSetVar("EMAIL", "");
            $this->updateOne($this->session_id, "loggedin=0");
            echo "<script language='javascript'>alert('Your session has expired!');window.location.href='?mod=_login';</script>";
            exit();
        }
        if ($this->loggedin == 1) {
            $clsUsers = new Users();
            $user_name = vnSessionGetVar("NVC_USERNAME");
            $oauth_uid = vnSessionGetVar("UID");
            $oauth_provider = vnSessionGetVar("PROVIDER");
            if ($oauth_uid != "") $user_name = $oauth_uid;
            $encrypt_password = vnSessionGetVar("NVC_PASSWORD");
            if ($oauth_uid != "") {
                $arrUser = $clsUsers->getByCond("oauth_uid='$oauth_uid' AND oauth_provider='$oauth_provider'");
                if (!is_array($arrUser)) {
                    $this->loggedin == 0;
                    vnSessionSetVar("LOGGEDIN", 0);
                    vnSessionSetVar("UID", "");
                    vnSessionSetVar("PROVIDER", "");
                    vnSessionSetVar("EMAIL", "");

                    unset($_SESSION['facebook_access_token']);
                    unset($_SESSION['google_access_token']);
                    if (is_array($arrSession))
                        $this->updateOne($this->session_id, "loggedin=0");
                } else {
                    $this->user_id = $arrUser["user_id"];
                }
            } else {
                $arrUser = $clsUsers->getByCond("user_name='$user_name' AND user_pass='$encrypt_password'");

                if (!is_array($arrUser) || strtolower($arrUser["user_name"]) != $user_name) {
                    $this->loggedin == 0;
                    vnSessionSetVar("LOGGEDIN", 0);
                    vnSessionSetVar("NVC_USERNAME", "");
                    vnSessionSetVar("NVC_PASSWORD", "");
                    if (is_array($arrSession))
                        $this->updateOne($this->session_id, "loggedin=0");
                } else {
                    $this->user_id = $arrUser["user_id"];
                }
                unset($clsUsers);
            }
            if (!is_array($arrSession) || $arrSession["session_id"] != $this->session_id) {
                $fields = "session_id, user_id, ip_address,running_time, loggedin";
                $values = "'" . $this->session_id . "', '" . $this->user_id . "', '" . $this->ip_address . "', '" . $this->running_time . "', '" . $this->loggedin . "'";
                $this->insertOne($fields, $values);
            } else {
                $set = "user_id='" . $this->user_id . "', ip_address='" . $this->ip_address . "', running_time='" . $this->running_time . "', loggedin='" . $this->loggedin . "'";
                $this->updateOne($this->session_id, $set);
            }
            $clsUsers = new Users();
            $clsUsers->updateOne($this->user_id, "last_visit='" . time() . "'");
            unset($clsUsers);
        } else {
            if (!is_array($arrSession) || $arrSession["session_id"] != $this->session_id) {
                $fields = "session_id, user_id, ip_address,running_time, loggedin";
                $values = "'" . $this->session_id . "', '" . $this->user_id . "', '" . $this->ip_address . "', '" . $this->running_time . "', '" . $this->loggedin . "'";
                $this->insertOne($fields, $values);
                $clsStats->incVisitor();
            } else {
                $set = "user_id='" . $this->user_id . "', ip_address='" . $this->ip_address . "', running_time='" . $this->running_time . "', loggedin='" . $this->loggedin . "'";
                $this->updateOne($this->session_id, $set);
            }
        }
        $clsUsers = new Users();
        $clsUsers->updateOne($this->user_id, "last_activity='" . time() . "'");
        $this->killTimeOut();
        unset($clsUsers, $clsStats);
    }

    //
    function doLogin($user)
    {
        $clsUsers = new Users();
        vnSessionSetVar("LOGGEDIN", 1);
        vnSessionSetVar("NVC_USERNAME", $user['user_name']);
        vnSessionSetVar("NVC_PASSWORD", $user['user_pass']);
        unset($clsUsers);
    }

    //
    function doOauthLogin($user_profile, $oauth_provider)
    {
        $oauth_uid = $user_profile['id'];         // To Get Oauth ID
        $fullname = $user_profile['name']; // To Get Oauth full name
        $email = $user_profile['email'];    // To Get Oauth email
        vnSessionSetVar("LOGGEDIN", 1);
        vnSessionSetVar("UID", $oauth_uid);
        vnSessionSetVar("PROVIDER", $oauth_provider);
        vnSessionSetVar("EMAIL", $email);
        vnSessionSetVar("FULLNAME", $fullname);
        return 1;
    }

    //
    function doLogout()
    {
        vnSessionDelVar("LOGGEDIN");
        vnSessionDelVar("NVC_USERNAME");
        vnSessionDelVar("NVC_PASSWORD");

        vnSessionDelVar("UID");
        vnSessionDelVar("PROVIDER");
        vnSessionDelVar("EMAIL");
        vnSessionDelVar("FULLNAME");

        unset($_SESSION['facebook_access_token']);
        unset($_SESSION['google_access_token']);
    }

    //
    function killTimeOut()
    {
        global $SESSION_TIME_OUT;
        $timeout = $this->running_time - $SESSION_TIME_OUT;
        $this->deleteByCond("running_time < $timeout");
    }

    //
    function isLoggedin()
    {
        return $this->loggedin;
    }

    //
    function checkUser($user_name = "", $user_pass = "")
    {
        if ($user_name != "" && $user_pass != "") {
            $clsUsers = new Users();
            $encrypt_password = $clsUsers->encrypt($user_pass, $user_name);
            $arrUser = $clsUsers->getByCond("user_name='$user_name' AND user_pass='$encrypt_password'");
            unset($clsUsers);
            return (is_array($arrUser) && $arrUser["user_name"] == $user_name);
        }
        return 1;
    }
}

?>
