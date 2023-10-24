<?
/******************************************************
 * Class FeedBacks (Tour + Contact + ...)
 *
 * FeedBack Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:
 * Program ID                 :  class_FeedBack.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	Banglcb          -  		-     -     -
 *
 ********************************************************/
class FeedBacks extends dbBasic{
	function FeedBacks(){
		$this->pkey = "feedback_id";
		$this->tbl = "_feedbacks";
	}
	//SELECT
	/**
	 * Validate feedback form Email
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAddEmail(&$arr_error){
		global $core;
		$email = POST("email", "");
		$content = POST("content", "");		
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		if ($valid && $email==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập email";
			$valid = 0;
		}
		return $valid;
	}
	/**
	 * Validate feedback form CallLater
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAddShort(&$arr_error){
		global $core;
		$content = POST("content", "");
		if ($core->_SESS->isLoggedin()){
			$fullname = $core->_USER['fullname'];
			$email = $core->_USER['email'];
			$phone = $core->_USER['phone'];
			$user_id = $core->_USER['user_id'];
		}else{
			$fullname = POST("fullname", "");
			$email = POST("email", "");
			$phone = POST("phone", "");
			$user_id = 0;
		}
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		if ($valid && $fullname==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập họ tên";
			$valid = 0;
		}
		if ($valid && $email==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập email";
			$valid = 0;
		}
		if ($valid && $phone==""){
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = "Chưa nhập SĐT";
			$valid = 0;
		}
		return $valid;
	}
	/**
	 * Validate feedback form
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAdd(&$arr_error){
		global $core;
		extract($_POST);
		$content = POST("content", "");
		if ($core->_SESS->isLoggedin()){
			$fullname = $core->_USER['fullname'];
			$email = $core->_USER['email'];
			$phone = $core->_USER['phone'];
			$user_id = $core->_USER['user_id'];
		}else{
			$fullname = POST("fullname", "");
			$email = POST("email", "");
			$phone = POST("phone", "");			
			$user_id = 0;
		}
		$country_id = POST("country_id", 0);
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		$arr_error['errors'] = array();
		$arr_error['message'] = "";
		if ($fullname==""){
			$err = $core->getLang("Input_full_name");
			$arr_error['errors']["fullname"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($country_id==0){
			$err = $core->getLang("Input_country");
			$arr_error['errors']["country_id"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($phone==""){
			$err = $core->getLang("Input_phone");
			$arr_error['errors']["phone"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($email==""){
			$err = $core->getLang("Input_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}elseif (!isValidEmail($email)){
			$err = $core->getLang("Input_correct_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($content=="" || ($is_type>0 && $obj_id==0) ){
			$err = $core->getLang("Input_content");
			$arr_error['errors']["content"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		$msg_error = "";
		if ($this->validateSecurityCode($securitycode, $msg_error)==0){
			$arr_error['errors']["securitycode"] = $msg_error;
			$arr_error['message'] .= $msg_error."<BR>";
			$valid = 0;
		}
		if (!$valid){
			$arr_error['status'] = "ERROR";
		}
		
		return $valid;
	}
	/**
	 * Validate feedback form Appointment
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAddAppointment(&$arr_error){
		global $core;
		extract($_POST);		
		$country_id = POST("country_id", 0);
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		$arr_error['errors'] = array();
		$arr_error['message'] = "";
		if ($arr_fields['t_participant']==""){
			$err = $core->getLang("Input_participant");
			$arr_error['errors']["t_participant"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($arr_fields['t_language']==""){
			$err = $core->getLang("Input_language");
			$arr_error['errors']["t_language"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($fullname==""){
			$err = $core->getLang("Input_full_name");
			$arr_error['errors']["fullname"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($job_title==""){
			$err = $core->getLang("Input_job_title");
			$arr_error['errors']["job_title"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($address==""){
			$err = $core->getLang("Input_address");
			$arr_error['errors']["address"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($comname==""){
			$err = $core->getLang("Input_company_name");
			$arr_error['errors']["comname"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($country_id==0){
			$err = $core->getLang("Input_country");
			$arr_error['errors']["country_id"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($phone==""){
			$err = $core->getLang("Input_phone");
			$arr_error['errors']["phone"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($email==""){
			$err = $core->getLang("Input_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}elseif (!isValidEmail($email)){
			$err = $core->getLang("Input_correct_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}		
		$msg_error = "";
		if ($this->validateSecurityCode($securitycode, $msg_error)==0){
			$arr_error['errors']["securitycode"] = $msg_error;
			$arr_error['message'] .= $msg_error."<BR>";
			$valid = 0;
		}
		if (!$valid){
			$arr_error['status'] = "ERROR";
		}
	
		return $valid;
	}
	/**
	 * Validate feedback form Free Post
	 *
	 * @param unknown $arr_error
	 * @return number
	 */
	function validateAddFreePost(&$arr_error){
		global $core;
		extract($_POST);		
		$country_id = POST("country_id", 0);
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$valid = 1;
		$arr_error['errors'] = array();
		$arr_error['message'] = "";
		/* if ($arr_fields['t_phone1']==""){
			$err = $core->getLang("Input_telephone");
			$arr_error['errors']["t_phone1"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($arr_fields['t_phone2']==""){
			$err = $core->getLang("Input_telephone");
			$arr_error['errors']["t_phone2"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		} */
		if ($province_name==""){
			$err = $core->getLang("Input_province_name");
			$arr_error['errors']["province_name"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($arr_fields['t_productservice']==""){
			$err = $core->getLang("Input_product_service");
			$arr_error['errors']["t_productservice"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($job_title==""){
			$err = $core->getLang("Input_job_title");
			$arr_error['errors']["job_title"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($address==""){
			$err = $core->getLang("Input_address");
			$arr_error['errors']["address"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($comname==""){
			$err = $core->getLang("Input_company_name");
			$arr_error['errors']["comname"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($country_id==0){
			$err = $core->getLang("Input_country");
			$arr_error['errors']["country_id"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($phone==""){
			$err = $core->getLang("Input_phone");
			$arr_error['errors']["phone"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($email==""){
			$err = $core->getLang("Input_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}elseif (!isValidEmail($email)){
			$err = $core->getLang("Input_correct_email");
			$arr_error['errors']["email"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		if ($content=="" || ($is_type>0 && $obj_id==0) ){
			$err = $core->getLang("Input_detailed_proposal");
			$arr_error['errors']["content"] = $err;
			$arr_error['message'] .= $err."<BR>";
			$valid = 0;
		}
		$msg_error = "";
		if ($this->validateSecurityCode($securitycode, $msg_error)==0){
			$arr_error['errors']["securitycode"] = $msg_error;
			$arr_error['message'] .= $msg_error."<BR>";
			$valid = 0;
		}
		if (!$valid){
			$arr_error['status'] = "ERROR";
		}
	
		return $valid;
	}
	/**
	 * Validate security code
	 * 
	 * @param string $securitycode
	 * @param unknown $msg_error
	 * @return number
	 */
	function validateSecurityCode($securitycode="", &$msg_error){
		global $core;
		if ($securitycode==""){ $msg_error = $core->getLang("Input_security_code"); return 0;}
		require_once(DIR_COMMON."/class.Securimage.php");
		$si = new Securimage(session_id());
		if (!$si->check($_POST['securitycode'])){ $msg_error = $core->getLang("Input_correct_security_code"); return 0;}
		return 1;
	}
	/**
	 * Get List feedback by type and obj
	 * 
	 * @param number $is_type
	 * @param number $obj_id
	 * @param number $limit
	 * @param number $start
	 */
	function getList($is_type=0, $obj_id=0, $orderby='reg_date DESC', $limit=10, $start=0){
		$cond = "is_type=$is_type AND is_online=1 AND obj_id=$obj_id";
		$cond.= " ORDER BY $orderby";
		$cond.= " LIMIT $start, $limit";
		return $this->getAll($cond);
	}
	//INSERT
	/**
	 * Add appointment to database
	 *
	 * @param unknown $arr_error
	 */
	function addAppointment(&$arr_error){
		global $core, $_CONFIG, $_LANG_ID;
		extract($_POST);
		$clsCategory = new Category();
		//print_r($_POST);
		$arr_fields1 = @serialize($arr_fields); 
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		$user_id = ($core->_SESS->isLoggedin()==1)? $core->_USER['user_id'] : 0;
		$reg_date = time();
		$fields = "is_type, obj_id, user_id, fullname, job_title, email, phone, address, content, country_id, province_name, comname, reg_date, arr_fields, lang_code";
		$values = "'$is_type', $obj_id, $user_id, '$fullname', '$job_title', '$email', '$phone', '$address', '$content', $country_id, '$province_name', '$comname', $reg_date, '$arr_fields1', '$_LANG_ID'";		
		$ok = $this->insertOne($fields, $values);
		
		if ($ok) {
			$arr_error['status'] = "OK";
			$arr_error['message'] = $core->getLang("Your_request_sent_successfully");
			
			$s_tod_id = $arr_fields['s_tod_id'];
			$tod = ($s_tod_id>0)? $clsCategory->getName($s_tod_id) : "";
				
			//Begin Send Mail
			$post = array(					
					"JOB_TITLE"	=>	$job_title,
					"FULL_NAME"	=>	$fullname,
					"PHONE"		=>	$phone,
					"EMAIL"		=>	$email,
					"SENT_DATE"	=>	date("d/m/Y"),
					"COMPANY_NAME" => $comname,
					"CONTENT"	=>	$content,
					"TOD"		=>	$tod,
			);
			$template_client = ($is_type==2)? "mail_appointment_client" : "mail_freepost_client";
			$template_admin = ($is_type==2)? "mail_appointment_admin" : "mail_freepost_admin";
			
			send_mail_form($template_client, $email, $post);
			if ($_CONFIG['webmaster_email']!=""){
				send_mail_form($template_admin, $_CONFIG['webmaster_email'], $post);
			}
			//End Send Mail
		}else{
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = $core->getLang("Cannot_insert_database");
		}
		return $ok;
	}
	/**
	 * Add feedback to database
	 *
	 * @param unknown $arr_error
	 */
	function addFeedBack(&$arr_error){
		global $core ,$_CONFIG;
		$content = POST("content", "");
		$is_type = POST("is_type", 0);
		$obj_id = POST("obj_id", 0);
		if ($core->_SESS->isLoggedin()){
			$fullname = $core->_USER['fullname'];
			$email = $core->_USER['email'];
			$phone = $core->_USER['phone'];
			$user_id = $core->_USER['user_id'];
		}else{
			$fullname = POST("fullname", "");
			$email = POST("email", "");
			$phone = POST("phone", "");
			$user_id = 0;
		}
		$country_id = POST("country_id", 0);
		$comname = POST("comname", "");
		$address = POST("address", "");
		$ok = $this->insertF($is_type, $obj_id, $user_id, $fullname, $email, $phone, $content, $country_id, $comname, $address);
		if ($ok) {
			$arr_error['status'] = "OK";
			$arr_error['message'] = $core->getLang("Your_request_sent_successfully");
			
			//Begin Send Mail
			$post = array(					
					"FULL_NAME"	=>	$fullname,
					"PHONE"		=>	$phone,
					"EMAIL"		=>	$email,
					"SENT_DATE"	=>	date("d/m/Y"),
					"COMPANY_NAME" => $comname,
					"CONTENT"	=>	$content
			);
			$template_client = "mail_feedback_client";
			$template_admin = "mail_feedback_admin";
				
			send_mail_form($template_client, $email, $post);
			if ($_CONFIG['webmaster_email']!=""){
				send_mail_form($template_admin, $_CONFIG['webmaster_email'], $post);
			}
			//End Send Mail
		}else{
			$arr_error['status'] = "ERROR";
			$arr_error['message'] = $core->getLang("Cannot_insert_database");
		}
		return $ok;
	}
	/**
	 * Insert feedback to DB
	 *
	 * @param unknown $obj_id
	 * @param unknown $user_id
	 * @param unknown $fullname
	 * @param unknown $email
	 * @param unknown $content
	 * @param number $is_online
	 * @return number
	 */
	function insertF($is_type=0, $obj_id=0, $user_id=0, $fullname="", $email="", $phone="", $content="", $country_id=0, $comname="", $address=""){
		global $_LANG_ID;
		$reg_date = time();
		$fields = "is_type, obj_id, user_id, fullname, email, phone, content, country_id, comname, address, reg_date, lang_code";
		$values = "'$is_type', $obj_id, $user_id, '$fullname', '$email', '$phone', '$content', $country_id, '$comname', '$address', $reg_date, '$_LANG_ID'";
		return $this->insertOne($fields, $values);
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
	 */
	function sendMailF($to_admin=0, $vars){
		global $core, $clsCart, $_CONFIG, $_LANG_ID;
		if ($to_admin==0 && $_CONFIG['mail_configs']['allow_send_client']==0) return 0;
		if ($to_admin==1 && $_CONFIG['mail_configs']['allow_send_admin']==0) return 0;
		
		$subject = "";
		$file_email = $_LANG_ID."_mail_newsletter_admin.txt";
		$file_mail = ($to_admin==1)? DIR_CONFIGS."/".$file_email :  DIR_CONFIGS."/".$file_email;
		$html = htmlDecode(readMailTemplate($file_mail, $subject));
		
		$to = ($to_admin==1)? $_CONFIG['webmaster_email'] : $vars['c_email'];
		$subject = $this->replaceVarMailF($subject, $vars);
		$html = $this->replaceVarMailF($html, $vars);
			
		
		return @mail2($to, $subject, $html);
	}
	/**
	 * Replace Vars of New Order Mail
	 * 
	 * @param unknown $html
	 * @param unknown $vars
	 * @return mixed
	 */
	function replaceVarMailF($html, $vars){
		$html = str_replace("%SITE_NAME%", $vars['site_name'], $html);
		$html = str_replace("%SITE_TITLE%", $vars['site_title'], $html);
		$html = str_replace("%SITE_HOTLINE%", $vars['site_hotline'], $html);
		$html = str_replace("%C_FULLNAME%", $vars['c_fullname'], $html);
		$html = str_replace("%C_PHONE%", $vars['c_phone'], $html);
		$html = str_replace("%C_EMAIL%", $vars['c_email'], $html);
		$html = str_replace("%C_ADDRESS%", $vars['c_address'], $html);
		$html = str_replace("%C_NOTE%", $vars['c_note'], $html);
		return $html;
	}
	//UPDATE
	/**
	 * Set a feedback is Show
	 *
	 * @param unknown $feedback_id
	 * @return Ambigous <void, number>
	 */
	function setOn($feedback_id){
		return $this->updateOne($feedback_id, "is_online=1");
	}
	/**
	 * Set a feedback is Hidden
	 *
	 * @param unknown $feedback_id
	 * @return Ambigous <void, number>
	 */
	function setOff($feedback_id){
		return $this->updateOne($feedback_id, "is_online=0");
	}
	
	//DELETE
	/**
	 * Remove a feedback from DB
	 * 
	 * @param unknown $feedback_id
	 * @return number
	 */
	function removeF($feedback_id){
		return $this->deleteOne($feedback_id);
	}
}
?>