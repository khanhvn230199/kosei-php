<?
function ajax_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $_LANG_ID;

    exit();
}

function ajax_trial_registration()
{
    global $_LANG_ID, $core;
    $clsCategory = new Category();
    $clsTransactions = new Transactions();

    $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
    if (is_array($_POST)) {
        extract($_POST);
        $arrOneCourse = $clsCategory->getOneSimple($cat_id);
        $reg_date = time();
        $expired_time = strtotime("+$arrOneCourse[duration] month", $reg_date);
        $price_vn = $arrOneCourse['price_vn'];
        $price_jp = $arrOneCourse['price_jp'];

        if ($arrOneCourse['start_date'] <= time() && $arrOneCourse['end_date'] >= time() && $arrOneCourse['is_start'] == 1) {
            if ($arrOneCourse['discount_type'] == 1) {
                $price = $arrOneCourse['discount_value'];
                $price = $arrOneCourse['discount_value'];
            } else {
                $price = $arrOneCourse['price'] - (($arrOneCourse['price'] * $arrOneCourse['discount_value']) / 100);
            }
        }

        $field = "user_id, cat_id, price_vn, price_jp, expired_time, reg_date, lang_code, status";
        $value = "$user_id, $cat_id, $price_vn, $price_jp, $expired_time, $reg_date, '$_LANG_ID',0";

        $arrOneTransaction = $clsTransactions->getByCond("user_id=$user_id AND cat_id=$cat_id");
        if (!is_array($arrOneTransaction) || count($arrOneTransaction) == 0) {
            if ($clsTransactions->insertOne($field, $value)) {
                $arr_error = array('status' => 'success', 'message' => $core->getLang('Đăng ký học thử thành công!'));
            } else {
                $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi xảy ra vui lòng thử lại!'));
            }
        }
    }
    echo json_encode($arr_error);
    exit();
}

function ajax_get_discount()
{
    global $core;
    $coupon = $_POST['coupon'];
    $cat_id = $_POST['cat_id'];
    if ($coupon == "") {
        return 0;
    }

    $clsCoupon = new Coupon();

    $now = time();
    $arrOneCoupon = $clsCoupon->getByCond("code = '$coupon' AND is_online=1 AND start_date <= $now AND expire_date >= $now AND quantity > 0");
    $arr_error = array('status' => 'error', 'message' => $core->getLang('Mã khuyến mại không khả dụng!'));
    if (is_array($arrOneCoupon)) {
        $clsCategory = new Category();
        $arrCourse = $clsCategory->getOne($cat_id);
        if (is_array($arrCourse)) {
            $arrData = array(
                'save_vn' => $arrOneCoupon['price_vn'],
                'total_vn' => ($arrCourse['price_vn'] - $arrOneCoupon['price_vn']),
                'save_jp' => $arrOneCoupon['price_jp'],
                'total_jp' => ($arrCourse['price_jp'] - $arrOneCoupon['price_jp']),
            );
            $arr_error = array('status' => 'success', 'data' => $arrData);
        } else {
            $arr_error = array('status' => 'error', 'message' => $core->getLang('Có lỗi sảy ra, vui lòng thử lại sau!'));
        }
    }
    echo json_encode($arr_error);
    exit;
}
