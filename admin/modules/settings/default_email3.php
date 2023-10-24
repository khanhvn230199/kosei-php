<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=email3
 * Display Email Setting 3 Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_email3(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, 1);
	$btnSave = POST("btnSave", "");
	$btnSubmit = POST("btnSubmit", "");
	$mode = GET("mode", "");
	//init Button
	$clsForm = new Form();
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$arrListKey = array("webmaster_email"=>0, "smtp_server"=>0, "smtp_port"=>0, "smtp_user"=>0, "smtp_pass"=>0);
	$arrListMails = array(
			"mail_register"				=>	"Mail kích hoạt đăng ký",
			"mail_register_success"		=>	"Mail kích hoạt thành công",
			"mail_forgot"				=>	"Mail gửi link forgot",
			"mail_forgot_success"		=>	"Mail thông báo đổi mật khẩu thành công",
			"mail_appointment_client"	=>	"Mail Appointment gửi Khách hàng",
			"mail_appointment_admin"	=>	"Mail Appointment gửi Quản trị",
			"mail_freepost_client"		=>	"Mail Freepost gửi Khách hàng",
			"mail_freepost_admin"		=>	"Mail Freepost gửi Quản trị",
			"mail_feedback_client"		=>	"Mail Feedback gửi Khách hàng",
			"mail_feedback_admin"		=>	"Mail Feedback gửi Quản trị",
	);

	if ($btnSubmit=="TestMail"){
		$choose_mail = POST("choose_mail", "");
		$to_email = POST("to_email", "");
		$arr_error = array('status'=>'ERROR', 'message'=>'Không thể thực hiện được hành động này', 'log' => "Có lỗi không gửi được email");
		if ($choose_mail!="" && $to_email!=""){
			$femail = DIR_CONFIGS."/".$lang_code."_".$choose_mail.".txt";
			$femail_title = $femail_body = "";
				
			$femail_body = @readMailTemplate($femail, $femail_title);
				
			$log = @mail3($to_email, $femail_title, $femail_body);
			if (intval($log)==1){
				$arr_error = array('status'=>'OK', 'message'=>'Đã gửi thành công', 'log' => "Sent successfully!");
			}else{
				$arr_error['log'] = $log;
			}
		}else{
			$arr_error['message'] = "Hãy chọn loại mail và nhập email muốn nhận";
		}

		if ($mode=="ajax"){
			echo json_encode($arr_error);
			exit();
		}
	}

	foreach ($arrListKey as $key => $val){
		if ($val==1){//if is array
			$oldvalue = $clsClassTable->getValue($key, $lang_code);
			$old[$key] = @unserialize($oldvalue);
		}

		${$key} = POST($key, "");
	}
	if ($btnSave!=""){
		foreach ($arrListKey as $key => $val){
			$v = ${$key};
			if ($val==1 && is_array($v)){//if is array
				if (is_array($old[$key])){
					foreach ($old[$key] as $k1 => $v1){
						if (!isset($v[$k1])){
							$v[$k1] = $v1;
						}
					}
				}

				$v = serialize($v);
			}
			$clsClassTable->setValue($key, $v, $lang_code);
		}
		header("location: ?mod=$mod&act=$act");
		exit();
	}else{
		foreach ($arrListKey as $key => $val){
			$v = $clsClassTable->getValue($key, $lang_code);

			if ($val==1){//if is array
				$v = @unserialize($v);
			}
			${$key} = $v;
		}
	}

	$clsForm = new Form();
	$clsForm->setTextAreaType("Full");
	$clsForm->setTitle($core->getLang("EmailConfigs"));
	$clsForm->addInputText("webmaster_email", $webmaster_email, "", 255, 0, "style='width:50%'");
	$clsForm->addInputText("smtp_server", $smtp_server, "", 255, 0, "style='width:50%'");
	$clsForm->addInputText("smtp_port", $smtp_port, "", 255, 0, "style='width:50px'");
	$clsForm->addInputText("smtp_user", $smtp_user, "", 255, 0, "style='width:50%'");
	$clsForm->addInputPassword("smtp_pass", $smtp_pass, "", 255, 0, "style='width:50%'");

	$clsForm->addInputSelect("choose_mail", "mail_register", "Label", $arrListMails, 0, "style='font-size:12px;'");
	$clsForm->addInputText("to_email", $to_email, "", 255, 0, "style='width:50%'");
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>