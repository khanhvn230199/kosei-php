<?php
/******************************************************
 * Error Handling & Logging
 *
 * 
 * Project Name               :  ClientWebsite
 * Package Name            		:  
 * Program ID                 :  vnErrorHandler.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  20/01/2018
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	20/01/2018    	banglcb          -  		-     -     -
 *
 ********************************************************/
#we will do our own error handling
if (defined("HANDLE_ERROR") && HANDLE_ERROR==1){
	error_reporting(0);
}
if (!defined("LOG_SYSTEM_FILE")){
	define("LOG_SYSTEM_FILE", DIR_LOGS."/system.log");
}
/**
 * Set error handling
 */
function vnErrorHandler ($Code, $String, $File, $Line) {
	if (HANDLE_ERROR){
		$Log = new VnLogging(L_STDERR, LOG_SYSTEM_FILE);
	}else{
		$Log = new VnLogging();
	}

	$ErrorString = '['.$File.' (Line '.$Line.')] '.$String;
	$stopApp = false;
	$error = false;

	switch($Code) {
		case 0:
			$OLT = $Log->setLogType(L_STDERR);
			if ($OLT != L_STDERR) {
				$Log->Notice('{@} '.$ErrorString);
			}
			$Log->setLogType($OLT);
			break;
		case E_ERROR:
		case E_USER_ERROR:
		//case E_CORE_ERROR:
		//case E_COMPILE_ERROR:
			$Log->Error($ErrorString);
			$error = true;
			$stopApp = true;
			break;
		case E_WARNING:
		case E_USER_WARNING:
		//case E_CORE_WARNING:
		//case E_COMPILE_WARNING:
			$error = true;
			$Log->Warning($ErrorString);
			break;
		case E_PARSE:
			//$Log->Fatal($ErrorString);
			break;
		case E_NOTICE:
		case E_USER_NOTICE:
			//$error = true;
			//$Log->Notice($ErrorString);
			break;
		case E_STRICT:
			//$Log->Strict($ErrorString);
			break;
		default:
			$Log->_doWrite('PHP ERROR: '.$Code, $ErrorString);
			break;
	};
	if ((STOP_APP_IF_ERROR && $error) || $stopApp){
		echo "<b>(^.^) System Notice: $ErrorString
		<hr size=0>
		<font color=red>Error has occured. Application has stoped.</font></b>";
		die("<br>More detail, see log file '".LOG_SYSTEM_FILE."'.");
	}
}
//handle error and logging to logfile
if (defined("HANDLE_ERROR") && HANDLE_ERROR==1){
	set_error_handler("vnErrorHandler");
}
?>