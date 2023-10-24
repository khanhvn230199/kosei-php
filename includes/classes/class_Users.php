<?

/******************************************************
 * Class Users
 *
 * User Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_User.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        2014/02/10        Banglcb          -        -     -     -
 *
 ********************************************************/
class Users extends DbBasic
{
    public $user_id = "";
    public $user_name = "";
    public $user_pass = "";
    public $user_group_id = "";
    public $fullname = "";
    public $valid = 0;

    /**
     * Init class
     */
    public function Users()
    {
        $this->pkey = "user_id";
        $this->tbl = "_users";
    }

    //SELECT
    public static function encrypt($password)
    {
        return md5(md5($password));
    }

    public function get_user_name($user_id)
    {
        global $dbconn;
        $sql = "SELECT user_name, user_id FROM $this->tbl WHERE user_id=$user_id";
        $res = $dbconn->GetRow($sql, false, 0);
        if (is_array($res) && count($res) > 0) {
            return $res['user_name'];
        }
        return "";
    }

    public function get_users_id($user_name)
    {
        global $dbconn;
        $sql = "SELECT user_name, user_id FROM $this->tbl WHERE user_name='$user_name'";
        $res = $dbconn->GetRow($sql);
        if (is_array($res) && count($res) > 0) {
            return $res['user_id'];
        }
        return 0;
    }

    /**
     * Get list members by department
     *
     * @param number $department_id
     * @param number $limit
     * @param number $start
     * @return Ambigous <multitype:, number, unknown>
     */
    public function getListMembers($department_id = 0, $limit = 10, $start = 0)
    {
        $cond = "user_group_id=2 AND is_active=1";
        if ($department_id > 0) {
            $cond .= " AND department_id=$department_id";
        }

        $arr = $this->getAll($cond);

        if (is_array($arr)) {
            $arrDepartmentOptions = $arrPositionOptions = array();
            makeArrayListCategory(0, 0, 1, $arrDepartmentOptions, "ctype=" . CTYPE_PB); //Phòng ban
            makeArrayListCategory(0, 0, 1, $arrPositionOptions, "ctype=" . CTYPE_CV); //Chức vụ
            foreach ($arr as $key => $val) {
                $arr[$key]['department_name'] = $arrDepartmentOptions[$val['department_id']];
                $arr[$key]['position_name'] = $arrPositionOptions[$val['position_id']];
            }
        } else {
            $arr = array();
        }
        return $arr;
    }
    //UPDATE

    /**
     * Update new avatar
     *
     * @param unknown $pkey
     * @param string $new_avatar
     * @return Ambigous <void, number>
     */
    public function doUpdateNewAvatar($pkey, $new_avatar = "")
    {
        extract($_POST);
        $set = "avatar='avatar/$new_avatar'";
        return $this->updateOne($pkey, $set);
    }

    /**
     * Update edit profile form
     *
     * @param number $user_id
     * @return Ambigous <void, number>
     */
    public function doUpdateProfile($user_id = 0)
    {
        $gender = 0;
        extract($_POST);
        $birthday = ($birthday != "") ? mkDayTime($birthday) : "";
        $set = "fullname='$fullname', gender=$gender, email='$email', birthday='$birthday', phone='$phone', mobile='$mobile', address='$address'";
        return $this->updateOne($user_id, $set);
    }

    /**
     * Update password form
     *
     * @param number $user_id
     * @param string $new_pass
     * @return number
     */
    public function updatePassword($user_id = 0)
    {
        global $core;
        extract($_POST);
        $set = "user_pass='" . $this->encrypt($user_pass) . "'";
        $cond = "user_id=$user_id";

        $ok = $this->updateByCond($cond, $set);
        $core->_SESS->doLogout();
        return $ok;
    }

    /**
     *
     * @param unknown $user_id
     * @return Ambigous <void, number>
     */
    public function doActive($user_id)
    {
        return $this->updateOne($user_id, "is_active=1");
    }

    /**
     *
     * @param unknown $user_id
     * @return Ambigous <void, number>
     */
    public function doReject($user_id)
    {
        return $this->updateOne($user_id, "is_active=0");
    }

    //VALIDATE
    public function checkValidLogin($_user_name = "", $_users_pass = "")
    {
        $_users_pass = $this->encrypt($_users_pass);
        $res = $this->getByCond("user_name='$_user_name' AND is_active=1");
        if (is_array($res) && count($res) > 0) {
            if ($res["user_pass"] == $_users_pass) {
                return 1;
            } else {
                return -1;
            }
        }
        return 0;
    }

    /**
     * Check Oauth_uid is exists or not?
     *
     * @param $oauth_uid
     * @param $oauth_provider
     * @return int
     */
    public function check_authid($oauth_uid, $oauth_provider)
    {
        $cond = "oauth_uid='$oauth_uid' AND oauth_provider='$oauth_provider'";
        $res = $this->getByCond($cond);
        if (is_array($res) && count($res) > 0) {
            return 1;
        }
        return 0;
    }

    public function checkValidUserPass($_user_name = "", $_users_pass = "")
    {
        $_users_pass = $this->encrypt($_users_pass);
        $res = $this->getByCond("user_name='$_user_name' OR email='$_user_name' OR mobile='$_user_name'");

        if (is_array($res) && count($res) > 0) {
            if ($res["user_pass"] == $_users_pass) {
                return $res;
            }
        }

        return 0;
    }

    //Begin Added 06/04/2014
    public function validateUserName($user_name = "", $user_name_old = "", &$msg_error)
    {
        global $core;
        if ($user_name == "") {
            $msg_error = $core->getLang("User_name_is_not_empty");
            return 0;
        }
        if (strlen($user_name) < 6 || strlen($user_name) > 16) {
            $msg_error = $core->getLang("User_name_min_max_length_error");
            return 0;
        }
        if (!isAlphabetNumber($user_name)) {
            $msg_error = $core->getLang("User_name_allow_character_error");
            return 0;
        }
        if ($this->check_user_name($user_name, $user_name_old)) {
            $msg_error = $core->getLang("User_name_used_for_other");
            return 0;
        }
        return 1;
    }

    public function validatePassword($user_pass = "", $user_pass_confirm = "", &$msg_error)
    {
        global $core;
        $msg_error = array('', '');
        if ($user_pass == "") {
            $msg_error[0] = $core->getLang("Password_is_not_empty");
            return 0;
        }
        if (strlen($user_pass) < 6 || strlen($user_pass) > 32) {
            $msg_error[0] = $core->getLang("Password_min_max_length_error");
            return 0;
        }
        if ($user_pass_confirm == "") {
            $msg_error[1] = $core->getLang("Confirm_password_is_not_empty");
            return 0;
        }
        if ($user_pass != $user_pass_confirm) {
            $msg_error[1] = $core->getLang("Confirm_password_must_same_password");
            return 0;
        }
        return 1;
    }

    public function validateFullName($fullname = "", &$msg_error, $min = 3, $max = 30)
    {
        global $core;
        if ($fullname == "") {
            $msg_error = $core->getLang("Fullname_is_not_empty");
            return 0;
        }
        if (strlen($fullname) < $min || strlen($fullname) > $max) {
            $msg_error = $core->getLang("Fullname_min_max_length_error");
            return 0;
        }
        return 1;
    }

    public function validateEmail($email = "", $email_old = "", &$msg_error)
    {
        global $core;
        if ($email == "") {
            $msg_error = $core->getLang("Email_is_not_empty");
            return 0;
        }
        if (!isValidEmail($email)) {
            $msg_error = $core->getLang("Email_is_not_correct");
            return 0;
        }
        if ($this->check_email_exists($email, $email_old)) {
            $msg_error = $core->getLang("Email_used_for_other");
            return 0;
        }
        return 1;
    }

    public function validateAddress($address = "", &$msg_error)
    {
        global $core;
        if ($address == "") {
            $msg_error = $core->getLang("Address_is_not_empty");
            return 0;
        }
        return 1;
    }

    public function validatePhone($phone = "", &$msg_error)
    {
        global $core;
        if (strlen($phone) < 10) {
            $msg_error = $core->getLang("Phone_min_max_length_error");
            return 0;
        }
        if (!isValidPhone($phone)) {
            $msg_error = $core->getLang("Phone_is_not_correct");
            return 0;
        }
        return 1;
    }

    public function validateMobile($mobile = "", &$msg_error)
    {
        global $core;
        if ($mobile == "") {
            $msg_error = $core->getLang("Mobile_is_not_empty");
            return 0;
        }
        if (strlen($mobile) < 10) {
            $msg_error = $core->getLang("Mobile_min_max_length_error");
            return 0;
        }
        if (!isValidMobile($mobile)) {
            $msg_error = $core->getLang("Mobile_is_not_correct");
            return 0;
        }
        if ($this->check_mobile_exists($mobile)) {
            $msg_error = $core->getLang("Mobile_used_for_other");
            return 0;
        }
        return 1;
    }

    public function validateSecurityCode($securitycode = "", &$msg_error)
    {
        global $core;
        if ($securitycode == "") {
            $msg_error = $core->getLang("Security_code_is_not_empty");
            return 0;
        }
        require_once DIR_COMMON . "/class.Securimage.php";
        $si = new Securimage(session_id());
        if (!$si->check($_POST['securitycode'])) {
            $msg_error = $core->getLang("Security_code_is_not_correct");
            return 0;
        }
        return 1;
    }

    public function validateAgree($f = "", &$msg_error)
    {
        global $core;
        if (!isset($_POST[$f])) {
            $msg_error = $core->getLang("You_must_agree_terms");
            return 0;
        }
        return 1;
    }

    //validate register form
    public function validateRegister(&$arr_error)
    {
        extract($_POST);
        $ok1 = $this->validateUserName($user_name, "", $arr_error['user_name']);
        if ($ok1) {
            unset($arr_error['user_name']);
        }

        $ok2 = $this->validatePassword($user_pass, $user_pass_confirm, $arr_error['user_pass']);
        if ($ok2) {
            unset($arr_error['user_pass']);
        }

        $ok3 = $this->validateFullName($fullname, $arr_error['fullname'], 3, 30);
        $ok4 = $this->validateEmail($email, "", $arr_error['email']);
        if ($ok4) {
            unset($arr_error['email']);
        }

        $ok5 = $this->validateMobile($mobile, $arr_error['mobile']);
        $ok6 = 1; //$this->validateSecurityCode($securitycode, $arr_error['securitycode']);
        $ok7 = $this->validateAgree($agree, $arr_error['agree']);
        $ok = ($ok1 && $ok2 && $ok3 && $ok4 && $ok5 && $ok6 && $ok7);
        return $ok;
    }

    //validate edit profile form
    public function validateEditProfile(&$arr_error)
    {
        global $core;
        extract($_POST);
        $ok0 = 1; //if ($company_name==""){ $arr_error['company_name'] = $core->getLang("Company_is_not_empty"); $ok0 = 0;}
        $ok1 = $this->validateFullName($fullname, $arr_error['fullname'], 3, 30);
        if ($ok1) {
            unset($arr_error['fullname']);
        }

        $ok2 = 1; //$this->validateEmail($email, $email_old, $arr_error['email']); if ($ok2) unset($arr_error['email']);
        $ok3 = 1; //$this->validateMobile($mobile, $arr_error['mobile']); if ($ok3) unset($arr_error['mobile']);
        $ok4 = 1; //$this->validateSecurityCode($securitycode, $arr_error['securitycode']);
        $ok = ($ok0 && $ok1 && $ok2 && $ok3 && $ok4);
        return $ok;
    }

    //validate change password form
    public function validateChangePass(&$arr_error)
    {
        global $core;
        extract($_POST);
        $ok1 = ($this->encrypt($user_pass_old) == $core->_USER['user_pass']);
        if (!$ok1) {
            $arr_error['user_pass_old'] = $core->getLang("Current_password_is_not_correct");
        }

        $ok2 = $this->validatePassword($user_pass, $user_pass_confirm, $arr_error['user_pass']);
        $ok3 = 1;
        if ($user_pass_old == $user_pass) {
            $ok3 = 0;
            $arr_error['user_pass'] = $core->getLang("New_password_must_different_current");
        }
        $ok4 = 1; //$this->validateSecurityCode($securitycode, $arr_error['securitycode']);
        $ok = ($ok1 && $ok2 && $ok3 && $ok4);
        return $ok;
    }

    //validate reset/create new password form
    public function validateResetPass(&$arr_error)
    {
        global $core;
        extract($_POST);
        $ok1 = 1;
        $ok2 = $this->validatePassword($user_pass, $user_pass_confirm, $arr_error['user_pass']);
        $ok3 = 1;
        if ($user_pass_old == $user_pass) {
            $ok3 = 0;
            $arr_error['user_pass'][0] = $core->getLang("New_password_must_different_current");
        }
        $ok4 = 1; //$this->validateSecurityCode($securitycode, $arr_error['securitycode']);
        $ok = ($ok1 && $ok2 && $ok3 && $ok4);
        return $ok;
    }

    //validate login form
    public function validateLogin(&$arr_error)
    {
        global $core;
        extract($_POST);
        $ok1 = 1;
        if ($user_name == "") {
            $arr_error['user_name'] = $core->getLang("User_name_is_not_empty");
            $ok1 = 0;
        } else {
            if (!$this->check_user_name($user_name)) {
                $arr_error['user_name'] = $core->getLang("User_name_is_not_exists");
                $ok1 = 0;
            }
        }
        $ok2 = 1;
        if ($user_pass == "") {
            $arr_error['user_pass'] = $core->getLang("Password_is_not_empty");
            $ok2 = 0;
        } else {
            $i = $this->checkValidLogin($user_name, $user_pass);
            if ($i == -1) {
                $arr_error['user_pass'] = $core->getLang("Password_is_not_correct");
                $ok2 = 0;
            } elseif ($i == 0) {
                $arr_error['user_name'] = $core->getLang("User_name_is_not_exists");
                $ok1 = 0;
            }
        }
        $ok = ($ok1 && $ok2);
        return $ok;
    }

    //validate forgot form
    public function validateForgot(&$arr_error)
    {
        global $core;
        extract($_POST);
        $ok1 = $this->check_user_name($user_name);
        if (!$ok1) {
            $arr_error["user_name"] = $core->getLang("Input_user_name");
        }
        $ok2 = $this->check_email_exists($email);
        if (!$ok2) {
            $arr_error['email'] = $core->getLang("Input_correct_email");
        }
        $ok = $ok1 * $ok2;
        return $ok;
    }
    //Check user_name is exists or not?
    //return 1 is exists, 0 is not
    public function check_user_name($_user_name, $_user_name_old = "")
    {
        if (isEmpty($_user_name)) {
            return 0;
        }

        $cond = "user_name='$_user_name'";
        if ($_user_name_old != "") {
            $cond .= " AND user_name!='$_user_name_old'";
        }

        $res = $this->getByCond($cond);
        if (is_array($res) && count($res) > 0) {
            return 1;
        }
        return 0;
    }

    public function check_user_name2($site_id, $_user_name, $_user_name_old = "")
    {
        if (isEmpty($_user_name)) {
            return 0;
        }

        $cond = "site_id=$site_id AND user_name='$_user_name'";
        if ($_user_name_old != "") {
            $cond .= " AND user_name!='$_user_name_old'";
        }

        $res = $this->getByCond($cond, 0);
        if (is_array($res) && count($res) > 0) {
            return 1;
        }
        return 0;
    }
    //Check email is exists or not? Email must be unique
    //return 1 is exists, 0 is not
    public function check_email_exists($_email, $email_old = "")
    {
        if (isEmpty($_email)) {
            return 0;
        }

        $cond = "email='$_email'";
        if ($email_old != "") {
            $cond .= " AND email!='$email_old'";
        }

        $res = $this->getByCond($cond, 0);
        if (is_array($res) && count($res) > 0) {
            return 1;
        }
        return 0;
    }
    //Check mobile is exists or not? Mobile must be unique
    //return 1 is exists, 0 is not
    public function check_mobile_exists($mobile)
    {
        if (isEmpty($mobile)) {
            return 0;
        }

        $res = $this->getByCond("mobile='$mobile'", 0);
        if (is_array($res) && count($res) > 0) {
            return 1;
        }
        return 0;
    }
    //INSERT

    /**
     * Register new User from Form
     *
     * @return number
     */
    public function doRegister()
    {
        global $_CONFIG, $_LANG_ID, $clsRewrite;
        extract($_POST);
        $user_group_id = 2;
        $reg_date = time();
        if (!isset($user_name) || $user_name == "" && !isset($user_pass) || $user_pass == "") {
            $user_name = $this->generate_username($fullname);
            $user_pass = $this->generate_password(6);
        }
        $md5_users_pass = $this->encrypt($user_pass);
        if ($fullname == "") {
            $fullname = ucfirst($user_name);
        }

        $active_key = simpleRandString(16);
        $is_active = 1; //0: inactive; 1: active
        $fields = "user_name, user_pass, fullname, gender, user_group_id, email, mobile, is_active, active_key, reg_date";
        $values = "'" . strtolower($user_name) . "', '$md5_users_pass', '$fullname', $gender, $user_group_id, '$email', '$mobile', $is_active, '$active_key', $reg_date";
        if ($this->insertOne($fields, $values) == 1) {
            /*
            Begin Send Mail to user the activation link
            %SITE_NAME% : tên của website
            %SITE_TITLE% : tiêu đề của website
            %SITE_HOTLINE% : hotline của website
            %FULL_NAME% : họ tên người đăng ký
            %USER_NAME% : tên đăng nhập
            %USER_PASS% : mật khẩu
            %URL_ACTIVE% : link kích hoạt tài khoản
             */
            $active_link = $clsRewrite->url_active() . "?k=" . base64_encode($active_key) . "&e=" . base64_encode($email) . "&lang=" . $_LANG_ID;
            $post = array("FULL_NAME" => $fullname, "USER_NAME" => $user_name, "USER_PASS" => $user_pass, "URL_ACTIVE" => $active_link);
            if ($_CONFIG['mail_configs']["mail_register"] == 1) {
                send_mail_form("mail_register", $email, $post);
            } elseif ($_CONFIG['mail_configs']["mail_register_success"] == 1) {
                send_mail_form("mail_register_success", $email, $post);
            }
            $clsCandidates = new Candidates();

            $user_id = $this->getByCond("user_name = '$user_name'")['user_id'];
            if ($level_id) {
                $clsTrialTest = new TrialTest();
                $now = time();
                $arrOneLatestTest = $clsTrialTest->getByCond("start_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
                if (!is_array($arrOneLatestTest)) {
                    $arrOneLatestTest = $clsTrialTest->getByCond("start_date<=$now AND end_date>=$now AND lang_code='$_LANG_ID' ORDER BY reg_date ASC LIMIT 1");
                }
                $clsCandidates->insertOne("user_id,tt_id,level_id,reg_date", "$user_id,$arrOneLatestTest[tt_id],$level_id,0,$reg_date");
            }
            return 1;
        }
        return 0;
    }

    /**
     * Register new user when login with Oauth
     * @param $user
     * @param $oauth_provider
     * @param int $user_group_id
     * @return int
     */
    public function doOauthRegister($user, $oauth_provider, $user_group_id = 2)
    {
        $user_name = $user['id'];
        $first_name = ($user['first_name'] != "") ? $user['first_name'] : $user['given_name'];
        $last_name = ($user['last_name'] != "") ? $user['last_name'] : $user['family_name'];
        $fullname = $first_name . " " . $last_name;
        $avatar = $user['picture'];
        $email = $user['email'];
        $gender = $user['gender'];
        $is_active = 1;
        $reg_date = time();
        $user_pass = "";
        $last_visit = $last_activity = $reg_date;
        $oauth_uid = $user['id'];
        $fields = "user_name, user_pass, fullname, avatar, email, gender, user_group_id, reg_date, is_active, oauth_provider, oauth_uid, last_visit, last_activity";
        $values = "'$user_name', '$user_pass', '$fullname', '$avatar', '$email', '$gender', '$user_group_id', $reg_date, $is_active, '$oauth_provider', '$oauth_uid', $last_visit, $last_activity";
        if ($this->check_user_name($user_name) == 0 && $this->check_authid($oauth_uid, $oauth_provider) == 0) {
            $this->insertOne($fields, $values);
        } else {
            $set = "fullname='$fullname', email='$email', avatar='$avatar', oauth_provider='$oauth_provider', gender='$gender', oauth_uid='$oauth_uid', last_visit=$last_visit, last_activity=$last_activity";
            $this->updateByCond("user_name='$user_name' OR (oauth_uid='$oauth_uid' AND oauth_provider='$oauth_provider')", $set);
        }
        return 1;
    }

    /**
     * Resend activation email if lost mail
     *
     * @param number $user_id
     * @return number
     */
    public function resendActivationMail($user_id = 0)
    {
        $arrOneUser = $this->getOne($user_id);
        if ($arrOneUser['is_active'] == 1) {
            return 1;
        }

        extract($arrOneUser);
        $active_link = VNCMS_URL . "/activeacc?k=" . base64_encode($active_key) . "&e=" . base64_encode($email) . "&lang=" . $_LANG_ID;
        send_mail_register($email, $fullname, $user_name, "******", $active_link);
        return 1;
    }
    //OTHER

    /**
     * Forgot password: send forgot link to email of user
     *
     * @return number
     */
    public function doForgot()
    {
        global $_CONFIG, $_LANG_ID, $clsRewrite;
        extract($_POST);
        $clsPublicKey = new PublicKey();
        //Get a user
        $arrOneUser = $this->getByCond("email='$email'");
        $forgotkey = $clsPublicKey->getForgotKey();
        /*
        Begin Send Mail to user to notice that activation has been successfully
        %SITE_NAME% : tên của website
        %SITE_TITLE% : tiêu đề của website
        %SITE_HOTLINE% : hotline của website
        %FULL_NAME% : họ tên người đăng ký
        %USER_NAME% : tên đăng nhập
         */
        $forgot_link = $clsRewrite->url_resetpass() . "?k=" . base64_encode($forgotkey) . "&e=" . base64_encode($email) . "&lang=" . $_LANG_ID;
        $post = array("FULL_NAME" => $arrOneUser['fullname'], "USER_NAME" => $arrOneUser['user_name'], "URL_FORGOT" => $forgot_link);
        send_mail_form("mail_forgot", $email, $post);
        //End Send Mail
        return 1;
    }

    /**
     * Create new password after forgot action
     *
     * @return number
     */
    public function doResetPass()
    {
        global $_CONFIG, $_LANG_ID;
        extract($_POST);
        $clsPublicKey = new PublicKey();
        $reset = GET("k", "");
        $email = GET("e", "");
        $keyid = base64_decode($reset);
        $email = base64_decode($email);
        //Get a user
        $arrOneUser = $this->getByCond("email='$email'");
        $newpass = $this->encrypt($_POST["user_pass"]);
        $set = "user_pass='$newpass'";
        if ($this->updateOne($arrOneUser['user_id'], $set) == 1) {
            /*
            Begin Send Mail to user to notice that new password was created successfully
            %SITE_NAME% : tên của website
            %SITE_TITLE% : tiêu đề của website
            %SITE_HOTLINE% : hotline của website
            %FULL_NAME% : họ tên người đăng ký
            %USER_NAME% : tên đăng nhập
            %USER_PASS% : mật khẩu
             */
            $post = array("FULL_NAME" => $arrOneUser['fullname'], "USER_NAME" => $arrOneUser['user_name'], "USER_PASS" => $user_pass);
            send_mail_form("mail_forgot_success", $email, $post);
            //Delete public key
            $clsPublicKey->deleteKey($keyid);
            //End Send Mail
        }
        return 1;
    }

    /**
     * Generate a unique username using Database
     * @param string $string
     * @return string
     */
    public function generate_username($string = "")
    {
        $arr_name = explode(' ', strtolower(utf8_nosign($string)));
        $total = count($arr_name);
        $username = $arr_name[$total - 1];
        if ($total > 1) {
            foreach ($arr_name as $i => $value) {
                if ($i < $total - 1) {
                    $username .= substr($value, 0, 1);
                }
            }
        } else {
            $username .= rand(0, 999);
        }
        $user_id = $this->get_users_id($username); //check username in database
        if (!$user_id) {
            return $username;
        }
        return $this->generate_username($username);
    }

    /**
     * Generate a unique password
     * @param integer $length
     * @return string
     */
    public function generate_password($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    // Static functions
    public static function checkLoggedIn()
    {
        global $core;

        $user_id = $core->_USER['user_id'];

        if (empty($user_id)) {
            return false;
        }

        $user = (new Users)->getOne($user_id);

        if (!is_array($user)) {
            return false;
        }

        return $user['user_id'];
    }



    
       //EXPORT
       function exportUser($is_active="", $limit=''){
        global $dbconn, $_LANG_ID;

      
        $sql = "SELECT * FROM $this->tbl ";
        if (is_numeric($is_active)){
            $sql.= " WHERE is_active=$is_active";
        }
        $sql.= " ORDER BY reg_date DESC";

      


        if( $limit!='' ) $sql.= " LIMIT $limit";
        $arrListUserExport = $dbconn->GetAll($sql);

        

        // echo $sql;
        // print_r($arrListUserExport);die();

        // echo $sql;

        /** Error reporting */
        error_reporting(0);
        /** PHPExcel */
        require_once DIR_INCLUDES.'/PHPExcel.php';
        /** PHPExcel_IOFactory */
        require_once DIR_INCLUDES.'/PHPExcel/IOFactory.php';
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'USER ID')
                    ->setCellValue('C1', 'Họ Tên')
                    ->setCellValue('D1', 'Email')
                    ->setCellValue('E1', 'Phone')
                    ->setCellValue('F1', 'Ngày đăng ký')

                    


                    // ->setCellValue('AD1', 'Mã ngôn ngữ')
        ;
        // product_id,cat_id,name,trademark, code, input_price, price,image, list_image, sale, des, detail, reg_date, total_view, is_online, in_stock,is_hot, tags, order_no, page_title, meta_keywords, meta_des, lang_code
       

        if(is_array($arrListUserExport))

        foreach($arrListUserExport as $k => $v){

            $v['reg_date'] = ($v['reg_date']>0)? date("d/m/Y", $v['reg_date']) : "";
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($k+2), $k+1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($k+2), $v[user_id]);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.($k+2), $v[fullname]);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.($k+2), $v[email]);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.($k+2), $v[mobile]);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.($k+2), $v[reg_date]);
            

        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray(
                array(
                    'font'    => array(
                        'bold'      => true
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                        'top'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    ),
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFFFFFFF'
                        )
                    )
                )
        );
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client's web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        //freeing memory
        unset($arrListUserExport);
        unset($clsCategory);
        unset($objPHPExcel);
        exit;
    }








}

function makeListUser($selectedid = "", $cond = "", $field = "user_name")
{
    global $dbconn, $lang_code;
    $sql = "SELECT * FROM _users WHERE user_group_id=2 OR user_group_id=4";
    if ($cond != "") {
        $sql .= " AND $cond";
    }

    $arrListUser11 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListUser11)) {
        foreach ($arrListUser11 as $k => $v) {
            $value = $v["user_id"];
            $option = $v[$field];
            $selected = ($value == $selectedid) ? "selected" : "";
            $html .= "<option value=\"$value\" $selected>" . $option . "</option>";
        }
        return $html;
    } else {
        return "";
    }
}

function makeArrayListUser(&$ret, $cond = "", $field = "user_name")
{
    global $dbconn;
    $sql = "SELECT * FROM _users WHERE user_group_id=2 OR user_group_id=4";
    if ($cond != "") {
        $sql .= " AND $cond";
    }

    $sql .= " ORDER BY user_name";
    $arrListUser11 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListUser11)) {
        foreach ($arrListUser11 as $k => $v) {
            $value = $v["user_id"];
            $option = $v[$field];
            $ret["$value"] = $option;
        }
        unset($arrListUser11);
        return "";
    }
    unset($arrListUser11);
    return "";
}

function makeArrayListAuthor(&$ret, $short = 0)
{
    global $dbconn;
    $sql = "SELECT * FROM _users WHERE user_group_id!=2";
    $sql .= " ORDER BY user_group_id DESC, user_name";
    $arrListUser11 = $dbconn->GetAll($sql);
    $html = "";
    if (is_array($arrListUser11)) {
        foreach ($arrListUser11 as $k => $v) {
            $value = $v["user_id"];
            $option = ($short == 0) ? $v["user_name"] . " &lt;" . $v["fullname"] . "&gt;" : $v["user_name"];
            $ret["$value"] = $option;
        }
        unset($arrListUser11);
        return "";
    }
    unset($arrListUser11);
    return "";
}
