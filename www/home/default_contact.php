<?
/******************************************************
 * Child Module of module [home]
 *
 * Contain functions of child module: [default], each function has prefix is 'default_'
 *
 * Project Name               :  ClientWebsite
 * Package Name                    :
 * Program ID                 :  index.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        20/01/2018        banglcb          -        -     -     -
 *
 ********************************************************/

/**
 * Module: [home]
 * Home function with $sub=default, $act=default
 * Display Home Page
 *
 * @param                : no params
 * @return                : no need return
 * @exception
 * @throws
 */
global $mod;
function default_contact()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;

    $clsFeedbacks = new FeedBacks();
    $_CONFIG['site_title'] = 'Liên hệ';

    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $address = isset($_POST["address"]) ? $_POST["address"] : '';
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $title = isset($_POST["title"]) ? $_POST["title"] : '';
    $content = isset($_POST["content"]) ? $_POST["content"] : '';
    $btnSend = isset($_POST["btnSend"]) ? $_POST["btnSend"] : "";

    if ($btnSend != "") {
        if ($name != "" && $content != "" && $phone != '') {
            $reg_date = time();
            $fields = "title, name, address, phone, email, content, lang_code, reg_date";
            $values = "'$title','$name', '$address', '$phone', '$email','$content','$_LANG_ID', $reg_date";
            if ($clsFeedbacks->insertOne($fields, $values)) {
                echo "<script>alert('Hệ thống đã lưu thành công yêu cầu của bạn !');</script>";
                //Begin Send Mail
                $post = array(
                    "PHONE"		=>	$phone,
                    "EMAIL"		=>	$email,
                    "SENT_DATE"	=>	date("d/m/Y"),
                    "CONTENT"	=>	$content,
                );
                send_mail_form('mail_feedback_client', $email, $post);
                if ($_CONFIG['webmaster_email']!=""){
                    send_mail_form('mail_feedback_admin', $_CONFIG['webmaster_email'], $post);
                }
            } else {
                echo "<script>alert('Có lỗi xảy ra. Vui lòng thủ lại sau !');</script>";
            }
        } else {
            echo "<script>alert('Có lỗi xảy ra. Vui lòng kiểm tra lại quá trình điền thông tin!');</script>";
        }

    }
    //End Comment

    $page_title = $core->getLang('Contact');
    $_CONFIG['page_title'] = $page_title;
    unset($tags, $des);
    //End SEOmoz
}

?>