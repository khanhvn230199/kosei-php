<?php
/**
 * Module: [account]
 * Home function with $sub=default, $act=forgot
 * Display Home Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
global $mod;
function default_forgot(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $_LANG_ID;
	if ($core->_SESS->isLoggedin()){
		redirectURL(url_home());
	}
	$clsUsers = new Users();
	$btnForgot = POST("btnForgot", "");
	$success = GET("success", "");
	$error_login = 0;
	$arr_error = array();
	if ($btnForgot!="" && $success==""){
		$valid = $clsUsers->validateForgot($arr_error);
		if ($valid){
			$ok = $clsUsers->doForgot();
			if ($ok) {						
				$url = url_forgot()."?success=1";
				header("location:$url");
				exit();
			}else{
				$valid = 0;
				$arr_error['insertdb'] = $core->getLang("Cannot_insert_db");
			}
		}
	}	
	foreach ($_POST as $key => $val) {
		$assign_list[$key] = $val;
	}
	$assign_list["valid"] = $valid;
	$assign_list["arr_error"] = $arr_error;
	$assign_list["success"] = $success;	
	//Begin SeoMoz
	$page_title = $core->getLang("Forgot");
	$_CONFIG["page_title"] = $page_title." - ".$_CONFIG["site_title"];
	$_CONFIG["page_description"] = $_CONFIG["site_description"];
	//End SeoMoz
}