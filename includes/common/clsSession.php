<?php
/******************************************************
 * Class Session
 *
 * Session Handling
 *
 * Project Name               :  dichvuso.com
 * Package Name            	  :
 * Program ID                 :  /includes/common/clsSession.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  DVS
 * Version                    :  1.0
 * Creation Date              :  2015/09/01
 *
 * Modification History       :
 * Version    Date            Person Name  		Chng  	Req   No    Remarks
 * 1.0        2015/09/01   	  Tuanta          	-  		-     -     -
 *
 ********************************************************/
class Session extends DbBasic{
	var $session_id		=	"";
	var $user_id		=	0;
	var $ip_address		=	"";
	var $running_time	=	"";
	var $loggedin		=	"";
	var $timeout		=	0;
	/**
	 * Init class
	 */
	function Session(){
		$this->tbl 	= "_session";
		$this->pkey = "session_id";
	}
	/**
	 * Setup session: write to database
	 */
	function setup(){
		global $SESSION_TIME_OUT, $_SITE_ROOT, $_SITE_ID;
		$this->session_id 	= 	session_id();
		$this->ip_address 	= 	$_SERVER['REMOTE_ADDR'];
		$this->running_time	=	time();
		$this->loggedin		=	0;
		$this->user_id		=	0;
		$clsUsers = new Users();
		//get loggedin from session
		if (vnSessionExist("LOGGEDIN")){
			$this->loggedin = vnSessionGetVar("LOGGEDIN");
		}
		//get current session from database
		$curSession = $this->getOne($this->session_id);
		//check if session really expired?
		if (is_array($curSession) && $curSession["loggedin"]==1 && $curSession["running_time"]+$SESSION_TIME_OUT<$this->running_time){
			$this->timeout = 1;
			$this->doLogout();
			$this->updateOne($this->session_id, "loggedin=0");
			echo "<script language='javascript'>alert('Your session has expired.');window.location.href='?mod=_login';</script>";
			exit();
		}
		//check fake session
		if ($this->loggedin==1){
			$user_name = vnSessionGetVar("NVC_USERNAME");
			$encrypt_password = vnSessionGetVar("NVC_PASSWORD");
			$arrUser = $clsUsers->getByCond("user_name='$user_name' AND user_pass='$encrypt_password'");
			if (!is_array($arrUser) || $arrUser["user_name"]!=$user_name){
				$this->doLogout();
				echo "<script language='javascript'>alert('Your session has expired!!!');window.location.href='?mod=_login';</script>";
				exit();
			}else{
				$this->user_id = $arrUser['user_id'];
				//update last activity
				$clsUsers->updateOne($this->user_id, "last_activity='".time()."'");
			}
		}
		//insert session to database
		if (!is_array($curSession) || $curSession["session_id"]!=$this->session_id){
			$fields = "session_id, user_id, ip_address,running_time, loggedin";
			$values = "'".$this->session_id."', '".$this->user_id."', '".$this->ip_address."', '".$this->running_time."', '".$this->loggedin."'";
			$this->insertOne($fields, $values);
		}else{
			$set = "user_id='".$this->user_id."', ip_address='".$this->ip_address."', running_time='".$this->running_time."', loggedin='".$this->loggedin."'";
			$this->updateOne($this->session_id, $set);
		}
		//kill all timeout session
		$this->killTimeOut();
		//release memory
		unset($clsUsers);
	}
	/**
	 * Do action login to system
	 *
	 * @param string $user_name
	 * @param string $user_pass
	 */
	function doLogin($user_name="", $user_pass=""){
		$this->loggedin = 1;
		$clsUsers = new Users();
		//update last_visit
		$clsUsers->updateByCond("user_name='$user_name'", "last_visit='".time()."'");
		//write to session
		vnSessionSetVar("LOGGEDIN", 1);
		vnSessionSetVar("NVC_USERNAME", $user_name);
		vnSessionSetVar("NVC_PASSWORD", $clsUsers->encrypt($user_pass, $user_name));
		$this->updateOne($this->session_id, "loggedin=1");
		unset($clsUsers);
		return 1;
	}
	/**
	 * Do action logout system
	 */
	function doLogout(){
		$this->loggedin = 0;
		vnSessionDelVar("LOGGEDIN");
		vnSessionDelVar("NVC_USERNAME");
		vnSessionDelVar("NVC_PASSWORD");
		$this->updateOne($this->session_id, "loggedin=0");
	}
	/**
	 * Kill all session which timeout
	 */
	function killTimeOut(){
		global $SESSION_TIME_OUT;
		$timeout = $this->running_time-$SESSION_TIME_OUT;
		$this->deleteByCond("running_time < $timeout");
	}
	/**
	 * Check current session is logged in or not?
	 */
	function isLoggedin(){
		return $this->loggedin;
	}
}
?>