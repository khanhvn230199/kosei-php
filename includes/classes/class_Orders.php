<?
class Orders extends dbBasic{
	function Orders(){
		$this->pkey = "order_id";
		$this->tbl 	= "_orders";
	}
	//SELECT
	/**
	 * Get 1 Order
	 * 
	 * @param string $order_code
	 */
	function getOneOrder($order_id=""){
		if (is_numeric($order_id)){
			$arr = $this->getOne($order_id);
		}else{
			$arr = $this->getByCond("order_code='$order_id'");
		}
		if (!is_array($arr)) return 0;
		$arrItem = unserialize($arr['array_item']);
		$arr['arrItem'] = $arrItem;
		return $arr;
	}
	/**
	 * Get List Orders
	 * 
	 * @param unknown $totalItem
	 * @param number $start
	 * @param number $limit
	 * @param string $cond
	 * @param string $orderby
	 */
	function getList(&$totalItem, $start=0, $limit=10, $cond="", $orderby="a.order_date DESC"){
		global $dbconn;
		$totalItem = 0;
		$totalItem = $this->countItem($cond);
		if ($orderby!="") $orderby = " ORDER BY $orderby";
		$cond.= " $orderby LIMIT $start, $limit";
		$sql ="SELECT a.* FROM _order AS WHERE $cond";
		return $dbconn->GetAll($sql);
	}
	/**
	 * Get list products of order_code
	 *
	 * @param number $order_code
	 */
	function getListProduct($order_code=""){
		global $dbconn;
		$sql = "SELECT a.product_id, a.slug, a.code, a.name, a.image, b.quantity, b.price, b.discount_type, b.discount_value  FROM _product AS a
				INNER JOIN _order_item AS b ON a.product_id = b.product_id
				WHERE b.order_code='$order_code'";
		return $dbconn->GetAll($sql);
	}
	/**
	 * Get list log order
	 */
	function getOrderLog($order_id=0){
		global $dbconn;
		global $paymentMethodList, $transportMethodList, $orderStatusList, $payStatusList;
		$sql = "SELECT a.*, b.user_name, b.fullname FROM _order_log AS a
				LEFT JOIN _user AS b ON a.user_id = b.user_id
				WHERE a.order_id=$order_id ORDER BY a.reg_date DESC";
		$arr = $dbconn->GetAll($sql);
		if (is_array($arr)){
			foreach ($arr as $key => $val){
				$tmp = @unserialize($val['log']);
				$tmp['shipcompany_name'] = (isset($tmp['shipcompany']))? $transportMethodList[$tmp['shipcompany']] : "";
				$tmp['payment_method_name'] = (isset($tmp['payment_method']))? $paymentMethodList[$tmp['payment_method']] : "";
				$tmp['status_name'] = (isset($tmp['status']))? $orderStatusList[$tmp['status']] : "";
				$tmp['payed'] = (isset($tmp['payed']))? $tmp['payed'] : "";
					$tmp['tracking_code'] = (isset($tmp['tracking_code']))? $tmp['tracking_code'] : "";
				$tmp['status_txt'] = (isset($tmp['status_txt']))? $tmp['status_txt'] : "";
				$tmp['admin_note'] = (isset($tmp['admin_note']))? $tmp['admin_note'] : "";
				$tmp['reg_date'] = $val['reg_date'];
					$tmp['user_name'] = $val['user_name'];
					$tmp['fullname'] = $val['fullname'];
					$tmp['shipfee'] = (isset($tmp['shipfee']))? $tmp['shipfee'] : "";
				$tmp['receive_date'] = $tmp['receive_date'];
				$arr[$key] = $tmp;
			}
		}else
			$arr = array();
		return $arr;
	}
	/**
	 * Create new order code
	 */
	function genOrderCode($num=12){
		$i = round($num/2, 0);
		$now = time();
		return date("YmdHi", $now).simpleRandString($i, "ABCDEFGHIJKLMNPQRSTUVWXYZ");
	}
	//VALIDATE
	function validateFullName($fullname="", &$msg_error, $min=3, $max=30){
		if ($fullname==""){ $msg_error = "Họ tên không được trống"; return 0;}
		if (strlen($fullname)<$min || strlen($fullname)>$max){ $msg_error= "Họ tên phải ít nhất 3 ký tự và tối đa 30 ký tự"; return 0;}
		return 1;
	}
	function validateEmail($email="", $email_old="", &$msg_error){
		if ($email==""){ $msg_error = "Email không được trống"; return 0;}
		if (!isValidEmail($email)){ $msg_error = "Không đúng định dạng email"; return 0;}		
		return 1;
	}
	function validateAddress($address="", &$msg_error){
		if ($address==""){ $msg_error = "Địa chỉ không được trống"; return 0;}
		return 1;
	}
	function validatePhone($phone="", &$msg_error){		
		if (strlen($phone)<9){ $msg_error= "Số điện thoại phải ít nhất 9 ký tự"; return 0;}
		if (!isValidMobile($phone)) { $msg_error= "Số điện thoại không đúng định dạng"; return 0;}
		return 1;
	}
	function validateMobile($mobile="", &$msg_error){
		if ($mobile==""){ $msg_error = "Số di động không được trống"; return 0;}
		if (strlen($mobile)<10){ $msg_error= "Số di động phải 10 hoặc 11 ký tự bắt đầu bằng 09 hoặc 01"; return 0;}
		if (!isValidMobile($mobile)) { $msg_error= "Số di động không đúng định dạng"; return 0;}
		return 1;
	}
	/**
	 * Validate Checkout
	 *
	 * @param unknown $arr_error
	 * @return boolean
	 */
	function validateCheckout(&$arr_error){
		extract($_POST);
		$ok1 = $this->validateFullName($fullname, $arr_error['fullname'], 3, 30);
		$ok11 = $this->validateEmail($email, "", $arr_error['email']);
		$ok2 = $this->validatePhone($phone, $arr_error['phone']);
		$ok3 = $this->validateAddress($address, $arr_error['address']);
		$ok4 = 1;
		if ($province_id==0){ $ok4 = 0; $arr_error['province_id'] = "Hãy chọn tỉnh/tp"; }
		if ($district_id==0){ $ok4 = 0; $arr_error['district_id'] = "Hãy chọn quận/huyện"; }
		$ok5 = $this->validateFullName($fullname2, $arr_error['fullname2'], 3, 30);
		$ok6 = $this->validatePhone($phone2, $arr_error['phone2']);
		$ok7 = $this->validateAddress($address2, $arr_error['address2']);
		$ok8 = 1;
		if ($province_id2==0){ $ok8 = 0; $arr_error['province_id2'] = "Hãy chọn tỉnh/tp"; }
		if ($district_id2==0){ $ok8 = 0; $arr_error['district_id2'] = "Hãy chọn quận/huyện"; }
		
		$ok = ($ok1 && $ok11 && $ok2 && $ok3 && $ok4 && $ok5 && $ok6 && $ok7 && $ok8);
		return $ok;
	}
	/**
	 * Validate Create Order from
	 *
	 * @param unknown $arr_error
	 * @return boolean
	 */
	function validateCreateOrder(&$arr_error){
		global $core;
		extract($_POST);
		if ($user_id>0 && $core->_SESS->isLoggedin()){
			return 1;
		}
		$ok1 = $this->validateFullName($fullname, $arr_error['fullname'], 3, 30); if ($ok1) unset($arr_error['fullname']);
		$ok2 = $this->validateEmail($email, "", $arr_error['email']); if ($ok2) unset($arr_error['email']);
		$ok3 = $this->validatePhone($phone, $arr_error['phone']); if ($ok3) unset($arr_error['phone']);
		$ok4 = $this->validateAddress($address, $arr_error['address']); if ($ok4) unset($arr_error['address']);
		$ok = ($ok1 && $ok2 && $ok3 && $ok4);
		return $ok;
	}
	//INSERT
	/**
	 * Create new order
	 */
	function createNewOrder(){
		global $core, $clsCart, $_CONFIG;
		extract($_POST);		
		$order_code = $this->genOrderCode();
		if ($user_id>0 && $core->_SESS->isLoggedin()){
			$c_fullname = $core->_USER['fullname'];
			$c_phone = $core->_USER['phone'];
			$c_address = $core->_USER['address'];
			$c_email = $core->_USER['email'];
			$c_note = "";
		}
		$arrListItem = $clsCart->getAllItem();
		$total_cost = $clsCart->getTotalPrice(FALSE);
		$total_item = $clsCart->getTotalQuantity();
		$order_date = time();
		$orderdate = date("Ymd", $order_date);
		$array_item = serialize($arrListItem);
		
		$ok = 1;
		foreach ($arrListItem as $key => $item){
			$this->addOrderItem($order_code, $item->itemId, $item->quantity, $item->price, $item->date, $order_date);
		}
		if ($ok){
			$fields = "user_id, order_code, payment_method, total_cost, total_item, orderdate, order_date, c_fullname, c_phone, c_address, c_email, c_note, array_item";
			$values = "$user_id, '$order_code', '$payment_method', $total_cost, $total_item, $orderdate, $order_date, '$fullname', '$phone', '$address', '$email', '$note', '$array_item'";
			$this->insertOne($fields, $values);

			//Begin Send Mail
			$order_list = $this->getHtmlOrderList($arrListItem);
			$vars = array(
				"site_name"		=>	$_CONFIG["site_name"],						
				"site_title"	=>	$_CONFIG["site_title"],
				"site_hotline"	=>	$_CONFIG["site_hotline"],
				"c_fullname"	=>	$fullname,
				"c_phone"		=>	$phone,
				"c_email"		=>	$email,
				"c_address"		=>	$address,
				"c_note"		=>	$note,
				"order_code"	=>	$order_code,
				"payment_method"=>	$payment_method,
				"total_cost"	=>	$total_cost,
				"total_item"	=>	$total_item,
				"order_date"	=>	$order_date,
				"order_list"	=>	$order_list					
			);			
			//$this->sendMailNewOrder(0, $vars);
			//$this->sendMailNewOrder(1, $vars);
			//End Send Mail
			//Clear all cart
			$clsCart->clearCart();
		}
		
		return $order_code;
	}
	/**
	 * Send mail to client or admin
	 * 
	 * @param number $to_admin
	 * @return Ambigous <number, boolean>
%SITE_NAME% : tên của website
%SITE_TITLE% : tiêu đề của website
%SITE_HOTLINE% : hotline của website
%C_FULLNAME% : tên người đặt hàng
%C_PHONE% : điện thoại người đặt hàng
%C_EMAIL% : email người đặt hàng
%C_ADDRESS% : địa chỉ người đặt hàng
%C_NOTE% : ghi chú đặt hàng
%ORDER_CODE% : mã đặt hàng
%PAYMENT_METHOD% : phương thức chọn thanh toán
%TOTAL_COST% : tổng giá trị đơn hàng
%TOTAL_ITEM% : tổng số sản phẩm đã đặt
%ORDER_DATE% : ngày giờ đặt hàng
%ORDER_LIST% : danh sách sản phẩm đã đặt 	 
	 */	
	function sendMailNewOrder($to_admin=0, $vars){
		global $core, $clsCart, $_CONFIG, $_LANG_ID;
		if ($to_admin==0 && $_CONFIG['mail_configs']['allow_send_client']==0) return 0;
		if ($to_admin==1 && $_CONFIG['mail_configs']['allow_send_admin']==0) return 0;
		$subject = "";
		$file_mail = ($to_admin==1)? DIR_CONFIGS."/".$_LANG_ID."_mail_order_success_admin.txt" :  DIR_CONFIGS."/".$_LANG_ID."_mail_order_success_client.txt";
		$html = htmlDecode(readMailTemplate($file_mail, $subject));
		
		$to = ($to_admin==1)? $_CONFIG['webmaster_email'] : $vars['c_email'];		
		$subject = $this->replaceVarNewOrder($subject, $vars);
		$html = $this->replaceVarNewOrder($html, $vars);
					
		
		return @mail2($to, $subject, $html);
	}
	/**
	 * Get HTML of Order List
	 * 
	 * @param unknown $arrListItem
	 */
	function getHtmlOrderList($arrListItem){		
		$tdstyle = "style='border: 1px solid black;'";
		$html= "<table style='border-collapse: collapse; border: 1px solid black;' width='100%'>";		
		$html.= "<tr>";
		$html.= "<th $tdstyle>STT</th $tdstyle><th $tdstyle>Hạng mục</th><th $tdstyle>Đơn giá</th>";
		$html.= "</tr>";
		if (is_array($arrListItem)){
			foreach ($arrListItem as $key => $item){
				$price = getPriceByDiscount($item->price, $item->price, $item->discount_type, $item->discount_value);
				$txt_price = number_format1($price);
				$html.= "<tr>";
				$html.= "<td $tdstyle>".($key+1)."</td>";
				$html.= "<td $tdstyle>{$item->name}<br>Note: {$item->note}</td>";
				$html.= "<td $tdstyle>$txt_price</td>";
				$html.= "</tr>";				
			}
		}		
		$html .= "</table>";
		return $html;
	}
	/**
	 * Replace Vars of New Order Mail
	 * 
	 * @param unknown $html
	 * @param unknown $vars
	 * @return mixed
	 */
	function replaceVarNewOrder($html, $vars){
		$html = str_replace("%SITE_NAME%", $vars['site_name'], $html);
		$html = str_replace("%SITE_TITLE%", $vars['site_title'], $html);
		$html = str_replace("%SITE_HOTLINE%", $vars['site_hotline'], $html);
		$html = str_replace("%C_FULLNAME%", $vars['c_fullname'], $html);
		$html = str_replace("%C_PHONE%", $vars['c_phone'], $html);
		$html = str_replace("%C_EMAIL%", $vars['c_email'], $html);
		$html = str_replace("%C_ADDRESS%", $vars['c_address'], $html);
		$html = str_replace("%C_NOTE%", $vars['c_note'], $html);
		$html = str_replace("%ORDER_CODE%", $vars['order_code'], $html);
		$html = str_replace("%PAYMENT_METHOD%", $vars['payment_method'], $html);
		$html = str_replace("%TOTAL_COST%", $vars['total_cost'], $html);
		$html = str_replace("%TOTAL_ITEM%", $vars['total_item'], $html);
		$html = str_replace("%ORDER_DATE%", date("d/m/Y", $vars['order_date']), $html);
		$html = str_replace("%ORDER_LIST%", $vars['order_list'], $html);
		return $html;
	}
	/**
	 * Add new order item
	 *
	 * @param string $order_code
	 * @param number $product_id
	 * @param number $quantity
	 * @param number $price
	 * @param number $order_date
	 */
	function addOrderItem($order_code="", $product_id=0, $quantity=0, $price=0, $date="", $order_date=0){
		global $dbconn;
		$fields = "order_code, product_id, quantity, price, `date`, order_date";
		$values = "'$order_code', $product_id, $quantity, $price, '$date', $order_date";
		return $dbconn->Execute("INSERT INTO _order_item($fields) VALUES($values)");
	}
	/**
	 * Write log
	 *
	 */
	function writeOrderLog($order_id=0, $log=""){
		global $dbconn, $core;
		$reg_date = time();
		$user_id = $core->_USER['user_id'];
		$sql = "INSERT INTO _order_log SET order_id=$order_id, log='$log', reg_date='$reg_date', user_id=$user_id";
		return $dbconn->Execute($sql);
	}
	//UPDATE
	/**
	 * Update an Order (may be after payed)
	 * 
	 * @param number $order_id
	 * @param string $payerID
	 * @param string $paymentID
	 * @param string $paymentToken
	 * @return number
	 */
	function updatePayedOrder($order_id=0,  $payerID="", $paymentID="", $paymentToken=""){
		$set = "payed=1, payerID='$payerID', paymentID='$paymentID', paymentToken='$paymentToken', status_txt='Prepayed'";
		$this->updateOne($order_id, $set);
		return 1;
	}
	//DELETE
	function deleteOneOrder($order_id=0){
		global $dbconn;
		$arrOneOrder = $this->getOne($order_id);
		$order_code = $arrOneOrder['order_code'];
		$dbconn->Execute("DELETE FROM _order_item WHERE order_code='$order_code'");
		$dbconn->Execute("DELETE FROM _order_log WHERE order_id=$order_id");
		$this->deleteOne($order_id);
	}
}
?>