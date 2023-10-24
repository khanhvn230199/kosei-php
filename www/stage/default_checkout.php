<?php

function default_checkout()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $clsRewrite;
    global $core, $_LANG_ID;

    $clsCategory = new Category();
    $clsTransactions = new Transactions();
    $clsPayment = new Payment();
    $clsCoupon = new Coupon();
    $clsUsers = new Users();

    // Success page
    if ($_GET['success'] == 1) {
        $_CONFIG['page_title'] = $core->getLang('Sign_up_course_successful');

        return 1;
    }

    // Login required
    if (!is_array($_POST) || count($_POST) == 0) {
        if (!$core->_SESS->isLoggedin()) {
            redirectURL($clsRewrite->url_login());
        }
    }

    $cat_id = GET('cid', 0);

    $arrListPaymentMethod = $clsPayment->getAll("is_online = 1 AND lang_code = '$_LANG_ID' ORDER BY order_no ASC, reg_date DESC");

    extract($_POST);

    if ($core->_SESS->isLoggedin()) {
        $user_id = $core->_USER['user_id'];
        $arrOneUser = $clsUsers->getOne($user_id);
    } else {
        $user_id = $clsUsers->getByFieldByCond("email='$email'", "user_id");
    }

    $arrOneCourse = $clsCategory->getOneSimple($cat_id);

    if ($btnCheckout == 'checkout') {
        $reg_date = time();

        if (!isset($user_id) && empty($user_id) || $user_id == 0) {
            $user_name = $clsUsers->generate_username($fullname);
            $random_pass = $clsUsers->generate_password(6);
            $users_pass = $clsUsers->encrypt($random_pass);
            $user_group_id = 2;
            $active_key = simpleRandString(16);
            $is_active = 0;
            if ($clsUsers->insertOne("user_name,fullname,user_pass,email,mobile,address,user_group_id,active_key,is_active,reg_date", "'$user_name','$fullname','$users_pass','$email','$mobile','$address',$user_group_id,'$active_key',$is_active,$reg_date")) {
                $user_id = $clsUsers->get_users_id($user_name);
            }
        }

        $expired_time = strtotime("+$arrOneCourse[duration] month", $reg_date);
        $price_vn = $arrOneCourse['price_vn'];
        $price_jp = $arrOneCourse['price_jp'];

        $arrDiscoutPrice = $clsCoupon->getDiscount($coupon, $cat_id);

        if ($coupon != "" && is_array($arrDiscoutPrice)) {
            $price_vn = $arrDiscoutPrice['price_vn'];
            $price_jp = $arrDiscoutPrice['price_jp'];
        }

        if ($user_id != 0) {
            $field = "user_id, price_vn, price_jp, expired_time, reg_date, lang_code, status";
            $value = "$user_id, $price_vn, $price_jp, $expired_time, $reg_date, '$_LANG_ID',0";

            foreach ($_POST as $key => $val) {
                if ($key != 'btnCheckout' && $key != 'fullname' && $key != 'mobile' && $key != 'email' && $key != 'address') {
                    $field .= ",$key";
                    $value .= ",'$val'";
                    if ($key == "payment_id") {
                        $field .= ",payment_method";
                        $value .= ",'" . $clsPayment->getByField($val, 'ctype') . "'";
                    }
                }
            }

            $arrOneTransaction = $clsTransactions->getByCond("user_id=$user_id AND cat_id=$cat_id");

            if (!is_array($arrOneTransaction) || count($arrOneTransaction) == 0 || $arrOneTransaction['expired_time'] < time()) {
                if ($clsTransactions->insertOne($field, $value)) {
                    $clsCoupon->useCoupon($coupon);
                    if (isset($active_key) && !empty($active_key) && $active_key != "") {
                        $active_link = $clsRewrite->url_active() . "?k=" . base64_encode($active_key) . "&e=" . base64_encode($email) . "&lang=" . $_LANG_ID;
                        $post = array("FULL_NAME" => $fullname, "USER_NAME" => $user_name, "USER_PASS" => $random_pass, "URL_ACTIVE" => $active_link);
                        if ($_CONFIG['mail_configs']["mail_register"] == 1) {
                            send_mail_form("mail_register", $email, $post);
                        } elseif ($_CONFIG['mail_configs']["mail_register_success"] == 1) {
                            send_mail_form("mail_register_success", $email, $post);
                        }
                    }
                    redirectURL($clsRewrite->url_checkout() . "?success=1");
                } else {
                    $arr_error = array('status' => 'error', 'message' => $core->getLang('An_error_occurred_Please_check_the_filling_process'));
                }
            } elseif ($arrOneTransaction['status'] == '2') {
                $arr_error = array('status' => 'error', 'message' => $core->getLang('You_have_already_registered_for_this_course'));
                // if ($clsTransactions->insertOne($field, $value)) {
                //     redirectURL($clsRewrite->url_checkout() . "?success=1");
                // }
            } elseif ($arrOneTransaction['status'] != '0' || $arrOneTransaction['status'] == '1') {
                $arr_error = array('status' => 'error', 'message' => "Bạn đã đăng ký khoá học này. Vui lòng thanh toán để hoàn tất đăng ký.");
            }
        } else {
            $arr_error = array('status' => 'error', 'message' => $core->getLang('An_error_occurred_Please_check_the_filling_process'));
        }
    }

    // Save all post value to smarty
    foreach ($_POST as $key => $value) {
        $assign_list[$key] = $value;
    }

    $assign_list['arr_error'] = $arr_error;
    $assign_list['arrListPaymentMethod'] = $arrListPaymentMethod;
    $assign_list['arrOneCourse'] = $arrOneCourse;
    $assign_list['arrOneUser'] = $arrOneUser;

    $page_title = $core->getLang('Payment');

    //Begin SEOmoz
    $page_title .= " - " . $_CONFIG['site_title'];
    $_CONFIG['page_title'] = $page_title;
    //End SEOmoz
}
