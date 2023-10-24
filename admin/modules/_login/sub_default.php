<?
/**
 * Module: [_login]
 * Home function with $sub=default, $act=default
 * Display Login Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	//check logged in
	if ($core->_SESS->isLoggedin()){
		header("location: ?");
		exit();
	}
	$btnLogin = isset($_POST["btnLogin_x"])? $_POST["btnLogin_x"] : "";
	$txtUsername = isset($_POST["txtUsername"])? $_POST["txtUsername"] : "";
	$txtPassword = isset($_POST["txtPassword"])? $_POST["txtPassword"] : "";
	$isValid = 1;
	if ($btnLogin!=""){
		$isValid = ($txtUsername!="" && $txtPassword!="");
		if ($isValid){
			if ($core->_SESS->checkUser($txtUsername, $txtPassword)){
				$isValid = 1;
				$core->_SESS->doLogin($txtUsername, $txtPassword);
				header("location: ?$return");
				exit();
			}else{
				$isValid = 0;
			}
		}
	}
	
	$assign_list["btnLogin"] = $btnLogin;
	$assign_list["txtUsername"] = $txtUsername;
	$assign_list["isValid"] = $isValid;
}

function default_logout(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	if ($core->_SESS->isLoggedin()){
		$core->_SESS->doLogout();		
	}
	header("location: ?mod=_login");
}
?>