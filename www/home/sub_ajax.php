<?
function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;
    exit();
}

function ajax_advisory()
{
    global $_LANG_ID, $_CONFIG;
    $clsAdvisory = new Advisory();
    if (is_array($_POST) && count($_POST) > 0) {
        extract($_POST);
        if ($name != "" && $phone != "" && $email != "") {
            $reg_date = time();
            $ok = $clsAdvisory->insertOne("name,phone,email,address,reg_date,lang_code,is_online", "'$name','$phone','$email','$address',$reg_date,'$_LANG_ID',1");
            if ($ok) {
                $arr_error = array('status' => 'success', 'message' => 'Cảm ơn bạn đã gửi thông tin, chúng tôi sẽ gọi lại cho bạn sớm nhất có thể!');
                $arrEmail = explode(";", $_CONFIG['site_email']);
                foreach ($arrEmail as $e => $value) {
                    send_mail_form("mail_advisory", $value, array("FULL_NAME" => $name, "PHONE" => $phone, "EMAIL" => $email, "SENT_DATE" => date("d/m/Y")));
                }
            } else {
                $arr_error = array('status' => 'error', 'message' => 'Có lỗi sảy ra vui lòng thử lại!');
            }
        } else {
        }
    } else {
        $arr_error = array('status' => 'error', 'message' => 'Vui lòng nhập đầy đủ thông tin!');
    }
    echo json_encode($arr_error);
    exit();
}

function ajax_trial()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;

    $_name = isset($_POST['name']) ? $_POST['name'] : '';
    $_phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $_email = isset($_POST['email']) ? $_POST['email'] : '';
    $_level_id = isset($_POST['level_id']) ? $_POST['level_id'] : '';
    $_user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

   

    $reg_date = time();
    $clsTrial = new Trial();
        
    // $clsTrial->setDebug();
    if ($_email !='' && isEmail($_email) && $clsTrial->insertOne(
        'name,phone,email,level_id,user_id,reg_date', 
        "'$_name','$_phone','$_email','$_level_id','$_user_id',$reg_date")

){

          $contentmail = "
                    <ul style='padding-left: 0;'>
                       
                        <li>Name: $_name</li>
                        <li>Số điện thoại: $_phone</li>
                        <li>Email: $_email</li>
                        <li>Trình độ: $_phone</li>
                        
                    </ul>
                ";

        // $mail = mail2($_CONFIG['webmaster_email'], 'Học Viên ' . $_name . ' Đăng ký thi thử', $contentmail);

        echo 1;

    }  else {
        echo 0;
    }
    exit();
}







/*get search company*/
/**
 * Lấy khóa học
 */
function ajax_getcourses()
{
    global $dbconn, $lang_code;
    $keyword = utf8_nosign(POST("keyword", ""));
    $html = "";
    if ($keyword != "") {
        $slug = utf8_nosign_noblank($keyword);
        $sql = "SELECT name,cat_id,image FROM _category WHERE is_online=1 AND lang_code='$lang_code' AND ctype=" . CTYPE_KH . " AND (name LIKE '%$keyword%' or slug LIKE '%$slug%') ORDER BY name LIMIT 0,20";
        $arr = $dbconn->GetAll($sql);
        if ($arr) {
            $html = "<ul>";
            foreach ($arr as $key => $val) {
                $html .= "<li class='cat_id' tag-title='{$val['name']}' tag-value='{$val['cat_id']}' onclick='return selectTag(this);'><img src='" . URL_UPLOADS . "/{$val['image']}'>{$val['name']}</li>";
            }
            $html .= "</ul>";
        }
    }
    echo $html;
    $dbconn->Close();
    exit();
}

/*get Send Mail*/
/**
 * Gửi mail thông báo
 */
function ajax_send_notify()
{
    $clsCandidates = new Candidates();
    $clsTrialTest = new TrialTest();
    $clsSender = new Sender();
    $reg_date = time();
//    $clsTrialTest->setDebug();
    $arrListTrialTest = $clsTrialTest->getAll("start_date <= UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 1 DAY)) AND end_date > UNIX_TIMESTAMP(NOW())");
    if (is_array($arrListTrialTest)) {
        foreach ($arrListTrialTest as $t => $value) {
            $arrListCandidates = $clsCandidates->getAllSimple("a.tt_id=$value[tt_id]");
            if (is_array($arrListCandidates)) {
                foreach ($arrListCandidates as $r => $reg) {
                    if ($reg['email'] != "" && isEmail($reg['email'])) {
                        $arrOneSender = $clsSender->getByCond("user_id=$reg[user_id] AND reg_date <= DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY reg_date DESC");
                        $content = array(
                            "CONTENT" => "Kỳ thi thử sẽ diễn ra từ ngày " . date("H:i d/m/Y", $value['start_date']) . " đến ngày " . date("H:i d/m/Y", $value['end_date']),
                            "SENT_DATE" => date("d/m/Y"),
                        );
                        if (!is_array($arrOneSender)) {
                            $ok = send_mail_form("mail_notify", $reg['email'], $content);
                            $clsSender->insertOne("user_id,retry,reg_date,status", "$reg[user_id],0,$reg_date,$ok");
                        } else if ($arrOneSender['status'] == 0 && $arrOneSender['retry'] <= 3) {
                            $ok = send_mail_form("mail_notify", $reg['email'], $content);
                            $clsSender->updateOne($arrOneSender['id'], "retry=retry+1,reg_date=$reg_date,status=$ok");
                        }
                    }
                }
            }
        }
    }
    exit();
}

function ajax_searchlesson()
{
    global $_LANG_ID, $clsRewrite, $dbconn;

    $clsStage = new Stage();
    $clsLessons = new Lessons();
    $clsCategory = new Category();

    $cat_id = POST("cat_id");
    $key = POST("key");

    $keyLower = strtolower($key);
    $keySlug = utf8_nosign_noblank($key);
    $cat = $clsCategory->getOne($cat_id);

    if (!$key || !$cat) {
        echo json_encode(false);
        exit();
    }

    $catIdList = array();

    $stages = $clsStage->getAll("lang_code='$_LANG_ID' AND is_online=1 AND parent_id = 0 AND cat_id=$cat_id ORDER BY order_no, reg_date ASC");

    foreach ($stages as &$stage) {
        $cats = $clsStage->getAll("parent_id = {$stage[stage_id]} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");

        if (is_array($cats)) {
            foreach ($cats as &$cat) {
                $lessons = $clsLessons->getAll("lang_code = '$_LANG_ID' AND is_online=1 AND stage_id={$cat['stage_id']} AND parent_id=0");

                if (is_array($lessons)) {
                    foreach ($lessons as $lesson) {
                        $catIdList[] = $lesson['lesson_id'];
                        // $lessons[$k]['sublessons'] = $clsLessons->getAll("parent_id = {$v[lesson_id]} AND lang_code = '$_LANG_ID' AND is_online = 1 ORDER BY order_no, reg_date ASC");
                    }
                }
            }
        }
    }

    $catIdList = implode(",", $catIdList);

    // Search khoá học
    $lessons = $clsLessons->getAll("LOWER(name) LIKE '%{$keyLower}%' OR slug LIKE '%{$keySlug}%' AND parent_id in ($catIdList) ORDER BY name ASC LIMIT 10");

    if (!is_array($lessons)) {
        echo json_encode(false);
        exit();
    }

    $results = array();

    foreach ($lessons as $lesson) {
        $results[] = [
            "name" => $lesson['name'],
            "url" => $clsRewrite->url_lesson($lesson),
        ];
    }

    echo json_encode($results);
    exit();
}

function ajax_payment()
{
    global $core, $_LANG_ID;

    $clsCoupon = new Coupon();
    $clsTransactions = new Transactions();

    $cat_id = POST("cat_id", 1);
    $payment_method = POST("payment_method", 0);
    $note = POST("note");
    $coupon = POST("coupon");

    $res = [
        'status' => 0,
        'cat_id' => $cat_id,
    ];

    // Check user
    if (!$core->_SESS->isLoggedin()) {
        $res['message'] = "Bạn chưa đăng nhập";
        echo json_encode($res);
        exit();
    }

    $user_id = $core->_USER['user_id'];

    // Get course info
    $course = (new Category)->getOne($cat_id);
    $price_vn = $course['price_vn'];
    $price_jp = $course['price_jp'];
    $expired_time = strtotime("+$course[duration] month");

    // Check coupon info
    $discount = $clsCoupon->getDiscount($coupon, $cat_id);

    if ($coupon != "" && is_array($discount)) {
        $price_vn = $discount['price_vn'];
        $price_jp = $discount['price_jp'];
    }

    // Check is exists?
    $reg_date = time();
    $transaction = $clsTransactions->getByCond("user_id = $user_id AND cat_id = $cat_id AND expired_time > $reg_date");

    if (is_array($transaction)) {
        $res['sql'] = "user_id = $user_id AND cat_id = $cat_id AND expired_time > $reg_date";
        $res['expire_time'] = date("d-m-Y", $expired_time);
        $res['reg_date'] = date("d-m-Y", $reg_date);
        $res['message'] = "Khoá học đã được đăng ký, vui lòng tải lại trang web.";
        echo json_encode($res);
        exit();
    }

    // Insert
    $field = "user_id, cat_id, coupon, payment_id, payment_method, price_vn, price_jp, expired_time, reg_date, lang_code, status, note";
    $value = "$user_id, $cat_id, '$coupon', $payment_method, $payment_method, $price_vn, $price_jp, $expired_time, $reg_date, '$_LANG_ID', 0, '$note'";

    if (!$clsTransactions->insertOne($field, $value)) {
        $res['message'] = "Có lỗi xảy ra. Vui lòng thử lại sau.";
        echo json_encode($res);
        exit();
    }

    $clsCoupon->useCoupon($coupon);

    $res['status'] = 1;
    $res['message'] = "Gửi đăng ký thành công!";

    echo json_encode($res);
    exit();
}

function ajax_check_coupon()
{
    $clsCoupon = new Coupon();

    $code = POST('code');

    $res = [
        "status" => 0,
        "message" => "Mã khuyến mại không đúng",
        "code" => $code,
    ];

    $coupon = $clsCoupon->getByCond("is_online = 1 AND code = '$code'");

    if (!is_array($coupon)) {
        echo json_encode($res);
        exit();
    }

    $reg_date = time();

    if ($coupon['used'] >= $coupon['quantity'] || $coupon['start_date'] > $reg_date || $coupon['expire_date'] < $reg_date) {
        $res['message'] = "Mã khuyến mại hiện không khả dụng";
        echo json_encode($res);
        exit();
    }

    $res['status'] = 1;
    $res['message'] = "Mã khuyến mại hợp lệ";
    $res['price_vn'] = number_format($coupon['price_vn']);
    $res['price_jp'] = number_format($coupon['price_jp']);

    echo json_encode($res);
    exit();
}
