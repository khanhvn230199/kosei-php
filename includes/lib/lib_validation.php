<?
/******************************************************
 * Library Validation
 *
 * Contain validate functions for project
 *
 * Project Name               :  ClientWebsite
 * Package Name            		:
 * Program ID                 :  lib_validation.php
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
define("ERROR_NULL", 1);
define("ERROR_LENGTH", 2);
define("ERROR_FORMAT", 3);
//  Description	: Check a string is number
function isNumber($st, $allowAZ=false, $allowPlus=false){
	$strRegular = '0-9|\.';
	if ($allowAZ==true){
		$strRegular .= '|a-z|A-Z';
	}
	if ($allowPlus==true){
		$strRegular .= '|\-';
	}
	if (preg_match('/^['.$strRegular.']+$/', $st))
		return 1;
	return 0;
 }
//  Description	: Check a string is aphabet
function isAphabet($ch){
	if (($ch>'a' && $ch<'z')||($ch>'A' && $ch<'Z')){
		return 1;
	}
	return 0;
}
//  Description	: Check a string is aphabet-number
function isAlphabetNumber($st){
	if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9_]+$/', $st)){
		return 1;
	}else{
		return 0;
	}
}
//  Description	: Check empty
function isEmpty($str){
	if ($str=="" || $str==null){
		return 1;
	}
	return 0;
 }
//  Description	: Check url
function isUrl($url, $maxlen = 256){
	if (strlen($url) > $maxlen) {
		return 0;
	}
	if(ereg("(h{0,1}t{0,2}p{0,1}:{0,1}/{0,1}/{0,1})(w{0,3}\.{0,1})([aA-zZ]+)?\.{1}([aA-zZ]{2,3})(.*)", $url)){
		return 1;
	}
	return 0;
}
//  Description	: Check color
function isColor($col){
	if (ereg("#[A-Fa-f0-9]{6}$",$col))
		return 1;
	elseif (ereg("^[A-Fa-f0-9]{6}",$col))
		return 0;
	else
		return 0;
}
//  Description	: Check email
function isEmail($strEmail){
	$strRegular = "^[A-Za-z0-9_\.\-]+@[A-Za-z0-9_\.\-]+\.";
	$strRegular = $strRegular . "[A-Za-z0-9_\-][A-Za-z0-9_\-]+$";
	if (!preg_match("/".$strRegular."/", $strEmail)) {
		return 0;
	}
	return 1;
}
function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
//  Description	: Check the email address is valid
function checkValidEmail($strEmail, $length, &$errNo)
 {
	$errNo = null;
	if ($strEmail=="" || $strEmail==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($strEmail)>$length){
		$errNo = 2;//error length
		return 0;
	}
	// Use regular expression to check valid email address
	$strRegular = "^[A-Za-z0-9_\.\-]+@[A-Za-z0-9_\.\-]+\.";
	$strRegular = $strRegular . "[A-Za-z0-9_\-][A-Za-z0-9_\-]+$";
	if (!preg_match("/".$strRegular."/", $strEmail)) {
		$errNo = 3;//error format
		return 0;
	}

	return 1;
 }
//  Description	: Check the Url is valid
 function checkValidUrl($strUrl, $length, &$errNo)
 {
	$errNo = null;
	if ($strUrl=="" || $strUrl==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($strUrl)>$length){
		$errNo = 2;//error length
		return 0;
	}
	// Use regular expression to check valid email address
	if(!ereg("(h{0,1}t{0,2}p{0,1}:{0,1}/{0,1}/{0,1})(w{0,3}\.{0,1})([aA-zZ]+)?\.{1}([aA-zZ]{2,3})(.*)", $strUrl)){
		$errNo = 3;//error format
		return 0;
	}

	return 1;
 }
// Description	: Check zipcode is valid
function checkValidZipCode($str, $length, &$errNo){
	$errNo = null;
	if ($str=="" || $str==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($str)>$length){
		$errNo = 2;//error length
		return 0;
	}
	if (!isNumber($str)){
		$errNo = 3;//error format
		return 0;
	}
	return 1;
 }
//  Description	: Check telephone is valid
function checkValidTel($str, $length, &$errNo){
	$errNo = null;
	if ($str=="" || $str==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($str)>$length){
		$errNo = 2;//error length
		return 0;
	}
	if(!eregi("^[0-9]{2,3}[.-][0-9]{2,3}[.-][0-9]{4}$", $str ) ) {
		$errNo = 3;//error format
		return 0;
	}
	return 1;
 }
//  Description	: Check telephone is valid
function isValidMobile($str){
	$len = strlen($str);
	if ($len<8 || $len>12) return 0;
	if(preg_match('/^[0-9.\-]+$/', $str)){
		return 1;
	}else{
		return 0;
	}
}
function checkValidMobile($str, $length, &$errNo){
	$errNo = null;
	if ($str=="" || $str==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($str)>$length){
		$errNo = 2; //error length
		return 0;
	}
	if (!isNumber($str)){
		$errNo = 3;
		return 0;//error format
	}
	return 1;
 }
//  Description	: Check datetime is valid
function checkValidDateTime($strDatetime)//month, day, year
{
	if ($strDatetime[2]<1900 || $strDatetime[2]>date('Y')){
		return 0;
	}
	if(!checkdate($strDatetime[0], $strDatetime[1], $strDatetime[2]))
	{
		return 0;
	}
	if (gmmktime(0, 0, 0, $strDatetime[0], $strDatetime[1], $strDatetime[2])>time()){
		return 0;
	}
	return 1;	//if nothing wrong
}
//  Description	: Check input Text is valid
function checkValidText($strName, $length, &$errNo){
	$errNo = null;
	if ($strName=="" || $strName==null){
		$errNo = 1;//error null
		return 0;
	}
	if (strlen($strName)>$length){
		$errNo = 2;//error length
		return 0;
	}
	return 1;
}
//  Description	: Check $_FILE, type IMGAGE
function checkValidImageFile($imgfile, $max_file_size="", $allowExt="", &$errNo){
	if ($max_file_size==""){
		$max_file_size = 10485760;
	}
	if ($allowExt==""){
		$allowExt="jpeg, jpg, png, gif";
	}
	$allowExt = strtolower($allowExt);
	$allowExt = str_replace("php3", "", $allowExt);
	$allowExt = str_replace("php", "", $allowExt);
	$allowExt = str_replace("asp", "", $allowExt);
	$allowExt = str_replace("aspx", "", $allowExt);
	$allowExt = str_replace("exe", "", $allowExt);
	$file_tmp = $imgfile['tmp_name'];
	$file_name = $imgfile["name"];
	$extension = strtolower(substr(strrchr($file_name,"."),1));
	//check extension
	if (strpos($allowExt, $extension)===false){
		$errNo = 1;//extension is not allow

		return 0;
	}
	//check size
	$size = @filesize($file_tmp);
	if ($size>$max_file_size){
		$errNo = 2;//size is not allow
		return 0;
	}
	//else
	return 1;
}
//  Description	: set focus to ControlName
function setFocus($controlName)
{
	global $setFocusControl;
	if ($controlName=="") return;
	$setFocusControl=
			"<script language='javascript'>
				var obj = document.getElementById('$controlName');
				if (obj==null){
					obj = document.theForm.$controlName;
				}
				obj.focus();
			</script>";
}
function getErrorWarningBox($error_title, $error_msg){
	if (defined("ADMIN_URL_IMAGES")) $url_images = ADMIN_URL_IMAGES;
	else $url_images = URL_IMAGES;
	$e = "<div style='background-color:#FFFFCC; color:#C60000; border:#FFCC00 2px solid;   width:auto; font-size:13px; margin:0pt 0pt 10px; background-image:url(".$url_images."/warning.gif);background-repeat:no-repeat;background-position:20px 14px;padding-left:80px; padding-top:5px; font-family:Tahoma' >";
	$e.= $error_title;
	$e.= "<ul style='min-height:50px; margin-left:15px'>";
	$e.= $error_msg;
	$e.= "</ul>";
	$e.= "</div>";
	return $e;
}
function getErrorFatalBox($error_title, $error_msg){
	if (defined("ADMIN_URL_IMAGES")) $url_images = ADMIN_URL_IMAGES;
	else $url_images = URL_IMAGES;
	$e = "<div style='background-color:#FFFFCC; color:#FF0000; border:#FF0000 2px solid;   width:auto; font-size:13px; margin:0pt 0pt 10px; background-image:url(".$url_images."/stop.png);background-repeat:no-repeat;background-position:20px 14px;padding-left:80px; padding-top:5px; font-family:Tahoma' >";
	$e.= $error_title;
	$e.= "<ul style='min-height:50px; margin-left:15px'>";
	$e.= $error_msg;
	$e.= "</ul>";
	$e.= "</div>";
	return $e;
}
function showErrorWarningBox($type="permiss"){
	if ($type=="permiss"){
		$html = getErrorWarningBox(
		"<b>Alert: You don't have permission to access this section!</b>",
"<li>Please email to: <a href='mailto:tuantavnu@gmail.com'>tuantavnu@gmail.com</a></li>"
		);
		echo $html;
	}
	return 1;
}
function showErrorFatalBox($type="notfound"){
	if ($type=="notfound"){
		$query_string = $_SERVER['QUERY_STRING'];
		$html = getErrorFatalBox(
		"<b>Fatal Error: Not found $query_string</b>",
"<li>This Page was not found on this server.!</li>
 <li>More detail, this error was encountered while trying to request an inactive URL, <a href='javascript:history.go(-1)'>Go back</a> pls.</li>"
		);
		echo $html;
	}
	return 1;
}
?>