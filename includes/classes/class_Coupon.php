<?

class Coupon extends dbBasic
{
    function Coupon()
    {
        $this->pkey = "coupon_id";
        $this->tbl = "_coupon";
    }

    function isExists($coupon)
    {
        global $dbconn;
        $now = time();
        $sql = "SELECT * FROM $this->tbl WHERE code = '$coupon' AND is_online=1 AND start_date <= $now AND expire_date >= $now AND quantity > 0";
        $arr = $dbconn->getAll($sql);
        return (is_array($arr) && count($arr) > 0) ? 1 : 0;
    }

    function useCoupon($coupon = "")
    {
        if ($coupon == "") return 0;
        global $dbconn;
        $sql = "UPDATE _coupon SET used=used+1,quantity=quantity-1 WHERE code='$coupon'";
        $dbconn->Execute($sql);
        return 1;
    }

    function getDiscount($coupon, $cat_id)
    {
        if ($coupon == "") return 0;
        $now = time();
        $arrOneCoupon = $this->getByCond("code = '$coupon' AND is_online=1 AND start_date <= $now AND expire_date >= $now AND quantity > 0");
        if (is_array($arrOneCoupon)) {
            $clsCategory = new Category();
            $arrCourse = $clsCategory->getOne($cat_id);
            if (is_array($arrCourse)) {
                $arrData = array(
                    'price_vn' => ($arrCourse['price_vn'] - $arrOneCoupon['price_vn']),
                    'price_jp' => ($arrCourse['price_jp'] - $arrOneCoupon['price_jp']),
                );
                return $arrData;
            }
        }
        return 0;
    }
}

function makeArrayListCounpon(&$ret, $cond = "")
{
    global $dbconn, $lang_code;
    $now = time();
    $arr_ctype = array("%", "₫");
    $sql = "SELECT coupon_id, code, price FROM _coupon WHERE is_online=1 AND start_date <= $now AND expire_date >= $now AND quantity > 0";
    if ($cond != "") $sql .= " AND $cond";
    $arrListCoupon = $dbconn->GetAll($sql);
    if (is_array($arrListCoupon)) {
        foreach ($arrListCoupon as $k => $v) {
            $value = $v["coupon_id"];
            $option = $v["code"] . " -" . number_format($v["price"]) . $arr_ctype[$v["ctype"]];
            $ret["$value"] = str_repeat("&brvbar;--- ", 0) . $option;
        }
        unset($arrListCoupon);
        return "";
    }
    unset($arrListCoupon);
    return "";
}

?>