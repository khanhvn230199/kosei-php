<?
function mail_attachment($mailto, $subject, $message, $from_mail, $from_name, $replyto, $filename, $path)
{
    $file = $path;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = 'MIME-Version: 1.0' . "\r\n";
    $header .= "From: " . $from_name . " <" . $from_mail . ">\r\n";
    $header .= "Reply-To: " . $replyto . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message . "\r\n\r\n";
    $header .= "--" . $uid . "\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
    $header .= $content . "\r\n\r\n";
    $header .= "--" . $uid . "--";
    if (mail($mailto, $subject, $message, $header)) {
        return 1;
    } else {
        return 0;
    }
}

function mail2($to = "", $subject = "", $html = "", $from = "", $cc = "", $bcc = "", $attach = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: ' . $_CONFIG['site_name'] . " <" . $_CONFIG['webmaster_email'] . ">\r\n";

    $smtp_host = ($_CONFIG['smtp_server'] != '') ? $_CONFIG['smtp_server'] : "smtp.gmail.com";
    $smtp_port = ($_CONFIG['smtp_port'] != '') ? $_CONFIG['smtp_port'] : 465;
    $smtp_user = ($_CONFIG['smtp_user'] != '') ? $_CONFIG['smtp_user'] : "noreply@dichvuso.vn";
    $smtp_pass = ($_CONFIG['smtp_pass']) ? $_CONFIG['smtp_pass'] : "DVS@@20082020";

    $from = $_CONFIG['webmaster_email'];
    $site_name = $_CONFIG['site_name'];
    //Begin write log
    $log = "Log date: " . date("d/m/Y H:i", time()) . " To: $to | Subject: $subject | From: $from | CC: $cc | BCC: $bcc | Attach: $attach";
    file_put_contents(LOG_MAIL_FILE, $log . "\n", FILE_APPEND);
    //End write log
    //BEGIN SEND MAIL
    $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";
    if ($smtp_host == "" || $smtp_user == "" || $smtp_pass == "") {
        if ($attach != "") {
            return mail_attachment($to, $subject, $html, $from, $site_name, $from, "Invoice.pdf", $attach);
        }
        if ($cc != "") {
            return mail($cc, $subject, $html, $headers);
        } else
            if ($bcc != "") {
                $headers .= "Bcc: $bcc" . "\r\n";
                return mail($to, $subject, $html, $headers);
            } else
                return mail($to, $subject, $html, $headers);
    }
    require_once(DIR_COMMON . '/class.PHPMailer.php');
    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP();
    //GMAIL config
    if ($smtp_port == 465) {
        $mail->SMTPAuth = true;                // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                // sets the prefix to the server
    }
    //$mail->SMTPDebug  = true;
    $mail->Host = $smtp_host;            // sets GMAIL as the SMTP server
    $mail->Port = $smtp_port;            // set the SMTP port for the GMAIL server
    $mail->Username = $smtp_user;        // GMAIL username
    $mail->Password = $smtp_pass;            // GMAIL password
    //End Gmail config
    $mail->From = $from;
    $mail->FromName = $site_name;
    if ($cc != "") {
        if (strpos($cc, ',') !== false) {
            $arrCC = explode(',', $cc);
            if (is_array($arrCC)) {
                foreach ($arrCC as $k => $v) {
                    $mail->AddCC($v);
                }
            }
        } else {
            $mail->AddCC($cc);
        }
    }
    if ($bcc != "") {
        if (strpos($bcc, ',') !== false) {
            $arrBCC = explode(',', $bcc);
            if (is_array($arrBCC)) {
                foreach ($arrBCC as $k => $v) {
                    $mail->AddBCC($v);
                }
            }
        } else {
            $mail->AddBCC($bcc);
        }
    }
    $mail->Subject = $subject;
    $mail->MsgHTML($html);
    $mail->AddAddress($to);
    if ($attach != "") {
        $mail->AddAttachment($attach, "Invoice.pdf", "base64", "application/pdf");
    }
    $mail->IsHTML(true); // send as HTML
    if (!$mail->Send()) {//to see if we return a message or a value bolean
        file_put_contents(LOG_MAIL_FILE, "Message: $mail->ErrorInfo \n", FILE_APPEND);
        return 0;
    }
    return 1;
    //END SEND MAIL
}

/**
 * Send mail by form
 * @param string $template
 * @param string $to
 * @param $post
 * @return bool|int|void
 */
function send_mail_form($template = "mail_register", $to = "", $post="", $bcc="")
{
    // $fullname="", $user_name="", $user_pass="", $active_link=""){
    global $_CONFIG, $_LANG_ID;
    if ($_CONFIG['mail_configs'][$template] == 0) return;
    $html = readMailTemplate(DIR_CONFIGS . "/" . $_LANG_ID . "_" . $template . ".txt", $subject);
    $html = str_replace("%SITE_TITLE%", $_CONFIG['site_title'], $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    $html = str_replace("%SITE_HOTLINE%", $_CONFIG['site_hotline'][0], $html);
    if (is_array($post)) {
        foreach ($post as $key => $val) {
            $html = str_replace("%" . strtoupper($key) . "%", $val, $html);
        }
    }

    return @mail2($to, $subject, $html, "", "", $bcc);
}

function send_mail_register($to = "", $fullname = "", $user_name = "", $user_pass = "", $active_link = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $html = readMailTemplate(DIR_CONFIGS . "/mail_register.txt", $subject);
    $html = str_replace("%TITLE%", $_CONFIG['site_name'], $html);
    $html = str_replace("%FULL_NAME%", $fullname, $html);
    $html = str_replace("%USER_NAME%", $user_name, $html);
    $html = str_replace("%USER_PASS%", $user_pass, $html);
    $html = str_replace("%URL_ACTIVE%", $active_link, $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    return mail2($to, $subject, $html);
}

function send_mail_register_success($to = "", $fullname = "", $user_name = "", $user_pass = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $html = readMailTemplate(DIR_CONFIGS . "/mail_register_success.txt", $subject);
    $html = str_replace("%TITLE%", $_CONFIG['site_name'], $html);
    $html = str_replace("%FULL_NAME%", $fullname, $html);
    $html = str_replace("%USER_NAME%", $user_name, $html);
    $html = str_replace("%USER_PASS%", $user_pass, $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    return mail2($to, $subject, $html);
}

function send_mail_forgot($to = "", $fullname = "", $forgot_link = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $html = readMailTemplate(DIR_CONFIGS . "/mail_forgot.txt", $subject);
    $html = str_replace("%TITLE%", $_CONFIG['site_name'], $html);
    $html = str_replace("%FULL_NAME%", $fullname, $html);
    $html = str_replace("%URL_FORGOT%", $forgot_link, $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    return mail2($to, $subject, $html);
}

function send_mail_resetpass($to = "", $fullname = "", $user_name = "", $user_pass = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $html = readMailTemplate(DIR_CONFIGS . "/mail_resetpass.txt", $subject);
    $html = str_replace("%TITLE%", $_CONFIG['site_name'], $html);
    $html = str_replace("%FULL_NAME%", $fullname, $html);
    $html = str_replace("%USER_NAME%", $user_name, $html);
    $html = str_replace("%USER_PASS%", $user_pass, $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    return mail2($to, $subject, $html);
}

function send_mail_request($to = "", $fullname = "", $link = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    $html = readMailTemplate(DIR_CONFIGS . "/mail_request_bds.txt", $subject);
    $html = str_replace("%TITLE%", $_CONFIG['site_name'], $html);
    $html = str_replace("%FULL_NAME%", $fullname, $html);
    $html = str_replace("%LINK%", $link, $html);
    $html = str_replace("%SITE_NAME%", $_CONFIG['site_name'], $html);
    return mail2($to, $subject, $html);
}

function send_mass_email($send_type = "HTML", $arrListEmail, $cc_email = "", $subject = "", $body = "")
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core;
    include(DIR_COMMON . '/nomad_mimemail.inc.php');
    $mimemail = new nomad_mimemail();
    $smtp_host = $_CONFIG['smtp_server'];
    $smtp_port = $_CONFIG['smtp_port'];
    $smtp_user = $_CONFIG['smtp_user'];
    $smtp_pass = $_CONFIG['smtp_pass'];
    $from = $_CONFIG['webmaster_email'];
    $html = $body;
    $mimemail->set_from($from, $_CONFIG['site_name']);
    $to = $arrListEmail[0];
    $mimemail->set_to($to);
    foreach ($arrListEmail as $k => $v)
        if ($k > 0) {
            $mimemail->add_to($v);
        }
    if ($cc_email != "") {
        $mimemail->set_cc($cc_email);
    }
    $mimemail->set_subject($subject);
    $body = htmlspecialchars_decode($body);
    if ($send_type == "HTML") {
        $mimemail->set_html($body);
    } else {
        $mimemail->set_text($body);
    }
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $mimemail->mail_header = $headers;
    $mimemail->set_smtp_host($smtp_host, $smtp_port);
    $mimemail->set_smtp_auth($smtp_user, $smtp_pass);
    return $mimemail->send();
}






/**
 * Send mail test purpose
 *
 * @param string $to
 * @param string $subject
 * @param string $html
 * @return boolean|number
 */
function mail3($to="", $subject="", $html=""){
    global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
    global $core;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: '.$_CONFIG['site_name']." <".$_CONFIG['webmaster_email'].">\r\n";
    
    $smtp_host  = $_CONFIG['smtp_server'];
    $smtp_port  = $_CONFIG['smtp_port'];
    $smtp_user  = $_CONFIG['smtp_user'];
    $smtp_pass  = $_CONFIG['smtp_pass'];
    
    $from = $_CONFIG['webmaster_email'];
    $site_name = $_CONFIG['site_name'];
    //BEGIN SEND MAIL
    $subject = "=?utf-8?b?".base64_encode($subject)."?=";
    if ($smtp_host=="" || $smtp_user=="" || $smtp_pass==""){
        return @mail($to, $subject, $html, $headers);
    }
    require_once (DIR_COMMON.'/class.PHPMailer.php');
    $mail  = new PHPMailer();
    $mail->CharSet = "UTF-8";
    $mail->IsSMTP();
    //GMAIL config
    if ($smtp_port==465){
        $mail->SMTPAuth   = true;               // enable SMTP authentication
        $mail->SMTPSecure = "ssl";              // sets the prefix to the server
    }
    $mail->SMTPDebug  = false;
    $mail->Host       = $smtp_host;         // sets GMAIL as the SMTP server
    $mail->Port       = $smtp_port;         // set the SMTP port for the GMAIL server
    $mail->Username   = $smtp_user;         // GMAIL username
    $mail->Password   = $smtp_pass;         // GMAIL password
    //End Gmail config
    $mail->From       = $from;
    $mail->FromName   = $site_name;
    $mail->Subject    = $subject;
    $mail->MsgHTML($html);
    $mail->AddAddress($to);
    $mail->AddReplyTo($mail->From, $mail->FromName);
    $mail->IsHTML(true); // send as HTML
    if(!$mail->Send()) {//to see if we return a message or a value bolean
        return $mail->ErrorInfo;
    }
    return 1;
    //END SEND MAIL
}




?>