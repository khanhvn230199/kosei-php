<?
/******************************************************
 * Class CoreAdmin
 *
 * Kernel class of application, start Session and do special actions
 * For admin page purpose
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:
 * Program ID                 :  clsCoreAdmin.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	TuanTA          -  		-     -     -
 *
 ********************************************************/
class Core{
	var $_REMOTE_ADDR   	= 	"";
	var $_PERMISS					=		array();
	var $_USER						= 	array();
	var $_SESS						=		"";
	var	$_version					=		"CMS Version 2.0";
	var $_copyright 			=		"&copy; 2007-%YEAR% All Rights Reserved.";
	var $_webmaster				=		"tuantavnu@gmail.com";
	//init
	function Core(){
		global $mod, $_SITE_ROOT;
		//check module $mod
		if (!file_exists(DIR_MODULES."/$mod")){
			trigger_error("ModuleFile is not found!", E_USER_ERROR);
			exit();
		}

		$this->_REMOTE_ADDR   = 	$_SERVER['REMOTE_ADDR'];
		//session management
		$this->_SESS = new Session();
		$this->_SESS->setup();
		if ($this->_SESS->loggedin==1){
			$clsUsers = new Users();
			$this->_USER = $clsUsers->getOne($this->_SESS->user_id);
			$this->_PERMISS = @unserialize($this->_USER["admin_permiss"]);
			unset($clsUsers);
		}else{
			$this->_USER = array();
		}
		if ($_SITE_ROOT=="admin" && !$this->_SESS->loggedin && $mod!="_login"){
			$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
			header("location: ?mod=_login&$returnExp");
			die();
			exit();
		}

	}
	function hasPermiss($module){
		if ($this->isSuper()) return 1;
		return ($this->_PERMISS[$module]==1);
	}
	function getLang($key){
		global $_LANG, $array_lang;
		if (strpos($key, " ")!==false){
			$arr = str_word_count($key, 1, ' ');
			foreach ($arr as $k => $v)
			if ($v!=''){
				$val = trim($v, "'?, ");
				$trans= (isset($_LANG[$val]))? $_LANG[$val] : $val;
				/*if (!isset($_LANG[$val])){
					$array_lang[$val] = "";
				}*/
				$key = str_replace($val, $trans, $key);

			}
			return $key;
		}else{
			$val = trim($key, "'?,");
			$trans= (isset($_LANG[$val]))? $_LANG[$val] : $val;
			/*if (!isset($_LANG[$val])){
				$array_lang[$val] = "";
			}*/
			$key = str_replace($val, $trans, $key);
			return $key;
		}
		return $key;
	}
	function getLangArray($arr){
		if (is_array($arr)){
			foreach ($arr as $k => $v){
				$arr[$k] = $this->getLang($v);
			}
			return $arr;
		}
		return;
	}
	function isSuper(){
		return ($this->_USER["user_group_id"]==6 && $this->_USER["is_super"]==1);
	}
	function isAdmin(){
		return ($this->_USER["user_group_id"]==6);
	}
	function isRoot(){
		return ($this->_USER["user_group_id"]==6 && $this->_USER['user_id']==1 && $this->_USER['user_name']=='admin');
	}
	function isBanned(){
		return ($this->_USER["user_group_id"]==8);
	}
	function template_exists($template){
		global $smarty;
		return $smarty->templateExists($template);
	}
	function call_func(){
		$numargs = func_num_args();
		$func_name = func_get_arg(0);
		$param_arr = array();
		for ($i=1; $i<$numargs; $i++)
			$param_arr[] = func_get_arg($i);
		return call_user_func_array($func_name, $param_arr);
	}
	function callfunc(){
		$numargs = func_num_args();
		$func_name = func_get_arg(0);
		$param_arr = array();
		for ($i=1; $i<$numargs; $i++)
			$param_arr[] = func_get_arg($i);
		return call_user_func_array($func_name, $param_arr);
	}
    //Clone
    function _Clone($classTable = "Articles")
    {
        global $mod;
        $clsClassTable = new $classTable;
        $pkeyTable = $clsClassTable->pkey;
        $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
        if ($return == "") $return = "mod=$mod";
        //################### CAN NOT MODIFY BELOW CODE ###################
        $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
        $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
        if (is_array($checkList)) {
            foreach ($checkList as $key => $val) {
                $clsClassTable->cloneOne($val);
            }
            header("location: ?$return");
            exit();
        } else
            if ($pvalTable != "") {
                $clsClassTable->cloneOne($pvalTable);
                header("location: ?$return");
                exit();
            }
        unset($clsTable);
    }
}
//
class Session extends DbBasic{
	var $session_id		=	"";
	var $user_id		=	0;
	var $ip_address		=	"";
	var $running_time	=	"";
	var $loggedin		=	"";
	var $timeout		=	0;
	function Session(){
		$this->tbl 	= "_session";
		$this->pkey = "session_id";
	}
	//
	function setup(){
		global $SESSION_TIME_OUT, $_SITE_ROOT;
		$this->session_id 	= 	session_id();
		$this->ip_address 	= 	$_SERVER['REMOTE_ADDR'];
		$this->running_time	=	time();
		$this->loggedin		=	0;
		$this->user_id		=	0;
		if (vnSessionExist("LOGGEDIN")){
			$this->loggedin = vnSessionGetVar("LOGGEDIN");
		}
		$arrSession = $this->getOne($this->session_id);
		if (is_array($arrSession) && $arrSession["loggedin"]==1 && $arrSession["running_time"]+$SESSION_TIME_OUT<$this->running_time){
			$this->timeout = 1;
			$this->loggedin==0;
			vnSessionSetVar("LOGGEDIN", 0);
			vnSessionSetVar("NVC_USERNAME", "");
			vnSessionSetVar("NVC_PASSWORD", "");
			$this->updateOne($this->session_id, "loggedin=0");
			echo "<script language='javascript'>alert('Your session has expired!');window.location.href='?mod=_login';</script>";
			exit();
		}
		if ($this->loggedin==1){
			$user_name = vnSessionGetVar("NVC_USERNAME");
			$encrypt_password = vnSessionGetVar("NVC_PASSWORD");
			$clsUsers = new Users();
			$arrUser = $clsUsers->getByCond("user_name='$user_name' AND user_pass='$encrypt_password'");

			if (!is_array($arrUser) || $arrUser["user_name"]!=$user_name){
				$this->loggedin==0;
				vnSessionSetVar("LOGGEDIN", 0);
				vnSessionSetVar("NVC_USERNAME", "");
				vnSessionSetVar("NVC_PASSWORD", "");
				if (is_array($arrSession))
					$this->updateOne($this->session_id, "loggedin=0");
			}else{
				$this->user_id = $arrUser["user_id"];
			}
			unset($clsUsers);
			if (!is_array($arrSession) || $arrSession["session_id"]!=$this->session_id){
				$fields = "session_id, user_id, ip_address,running_time, loggedin";
				$values = "'".$this->session_id."', '".$this->user_id."', '".$this->ip_address."', '".$this->running_time."', '".$this->loggedin."'";
				$this->insertOne($fields, $values);
			}else{
				$set = "user_id='".$this->user_id."', ip_address='".$this->ip_address."', running_time='".$this->running_time."', loggedin='".$this->loggedin."'";
				$this->updateOne($this->session_id, $set);
			}
			$clsUsers = new Users();
			$clsUsers->updateOne($this->user_id, "last_visit='".time()."'");
			unset($clsUsers);
		}else{
			$arrSession = $this->getOne($this->session_id);
			if (!is_array($arrSession) || $arrSession["session_id"]!=$this->session_id){
				$fields = "session_id, user_id, ip_address,running_time, loggedin";
				$values = "'".$this->session_id."', '".$this->user_id."', '".$this->ip_address."', 
							'".$this->running_time."', '".$this->loggedin."'";
				$this->insertOne($fields, $values);
			}else{
				$set = "user_id='".$this->user_id."', ip_address='".$this->ip_address."', 
							running_time='".$this->running_time."', loggedin='".$this->loggedin."'";
				$this->updateOne($this->session_id, $set);
			}
		}
		$clsUsers = new Users();
		$clsUsers->updateOne($this->user_id, "last_activity='".time()."'");
		unset($clsUsers);
		$this->killTimeOut();
	}
	//
	function doLogin($user_name="", $user_pass=""){
		$clsUsers = new Users();
		vnSessionSetVar("LOGGEDIN", 1);
		vnSessionSetVar("NVC_USERNAME", $user_name);
		vnSessionSetVar("NVC_PASSWORD", $clsUsers->encrypt($user_pass, $user_name));
	}
	//
	function doLogout(){
		vnSessionDelVar("LOGGEDIN");
		vnSessionDelVar("NVC_USERNAME");
		vnSessionDelVar("NVC_PASSWORD");
	}
	//
	function killTimeOut(){
		global $SESSION_TIME_OUT;
		$this->deleteByCond("running_time+15*60<".$this->running_time."");
	}
	//
	function isLoggedin(){
		return $this->loggedin;
	}
	//
	function checkUser($user_name="", $user_pass=""){
		$ok = 1;
		if (isset($_POST["txtSecureCode"])){
			$ok = (intval($_POST["txtSecureCode"])==2032);
			if (!$ok) return 0;
		}
		if ($user_name!="" && $user_pass!=""){
			$clsUsers = new Users();
			$encrypt_password = $clsUsers->encrypt($user_pass, $user_name);
			$arrUser = $clsUsers->getByCond("user_name='$user_name' AND user_pass='$encrypt_password'");
			unset($clsUsers);
			return (is_array($arrUser) && $arrUser["user_name"]==$user_name);
		}
		return 1;
	}
}
?>