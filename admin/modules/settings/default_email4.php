<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=email4
 * Display Email Setting 4 Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_email4(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, 1);
	$btnSave = POST("btnSave", "");
	//init Button
	$clsForm = new Form();
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$mail_appointment_client_file = DIR_CONFIGS."/".$lang_code."_mail_appointment_client.txt";
	$mail_appointment_admin_file = DIR_CONFIGS."/".$lang_code."_mail_appointment_admin.txt";

	$arrListKey = array("mail_configs"=>1);

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

		$mail_appointment_client_title = POST("mail_appointment_client_title", "");
		$mail_appointment_client_body = POST("mail_appointment_client_body", "");
		saveMailTemplate($mail_appointment_client_file, $mail_appointment_client_title, htmlentities_decode(htmlDecode($mail_appointment_client_body)), 0);

		$mail_appointment_admin_title = POST("mail_appointment_admin_title", "");
		$mail_appointment_admin_body = POST("mail_appointment_admin_body", "");
		saveMailTemplate($mail_appointment_admin_file, $mail_appointment_admin_title, htmlentities_decode(htmlDecode($mail_appointment_admin_body)), 0);

		header("location: ?mod=$mod&act=$act");
		exit();
	}else{
		$mail_appointment_client_body = @readMailTemplate($mail_appointment_client_file, $mail_appointment_client_title);
		$mail_appointment_admin_body = @readMailTemplate($mail_appointment_admin_file, $mail_appointment_admin_title);

		//$mail_appointment_client_body = br2nl($mail_appointment_client_body);
		//$mail_appointment_admin_body = br2nl($mail_appointment_admin_body);
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

	$clsForm->addInputSelect("mail_configs[mail_appointment_client]", $mail_configs[mail_appointment_client], "Label", $arrYesNoOptions, 0, "style='font-size:12px;'");
	$clsForm->addInputText("mail_appointment_client_title", $mail_appointment_client_title, "", 255, 0, "style='width:50%'");
	$clsForm->addInputTextArea("mail_appointment_client_body", $mail_appointment_client_body, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:300px'");

	$clsForm->addInputSelect("mail_configs[mail_appointment_admin]", $mail_configs[mail_appointment_admin], "Label", $arrYesNoOptions, 0, "style='font-size:12px;'");
	$clsForm->addInputText("mail_appointment_admin_title", $mail_appointment_admin_title, "", 255, 0, "style='width:50%'");
	$clsForm->addInputTextArea("mail_appointment_admin_body", $mail_appointment_admin_body, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:300px'");
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>