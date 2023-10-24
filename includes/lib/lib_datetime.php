<?
/******************************************************
 * Library DateTime
 *
 * Contain datetime functions for project
 * 
 * Project Name               :  ClientWebsite
 * Package Name            		:  
 * Program ID                 :  lib_datetime.php
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
/** 		
* Convert string to array if delimiter is : or ' '
*  
* @param 				: string $str
* @return 			: array
*/
function convertDateTime($date="1/1/1970", $time="0:0:0"){
	$timeArr = explode(':', $time);
	$dateArr = explode('/', $date);
	return mktime($timeArr[0], $timeArr[1], 0, $dateArr[1], $dateArr[0], $dateArr[2]);
}
function _getdatetime($str=""){
	$arr = array();
	if (strpos($str, ':')!==false && strpos($str, ' ')!==false){
		$arr = explode(' ', $str);
	}else{
		$arr[0] = $str;
	}
	return $arr;
}
/** 		
* Return total day between $start & $end
*  
* @param 				: string $str
* @return 			: array
*/
function getdayin($start, $end){//type Integer
	return round(($end-$start)/(24*60*60));
}
/** 		
* Return timestamp from string with a format
*  
* @param 			: string $str, string $format
* @return 			: interger
*/
function mystrtotime($str="", $format="%m/%d/%Y %H:%M"){
	$str = trim($str);
	$format = trim($format);
	$arr1 = _getdatetime($str);
	$arr2 = _getdatetime($format);
	
	$date = array('m' => 0, 'd' => 0, 'Y' => 0);
	$a = (strpos($arr1[0], '/')!==false)? @explode('/', $arr1[0]) : @explode('/', $arr1[1]);
	$b = (strpos($arr2[0], '/')!==false)? @explode('/', $arr2[0]) : @explode('/', $arr2[1]);
	if (is_array($b))
	foreach ($b as $k => $v){ $v = str_replace('%', '', $v); $date[$v] = $a[$k]; }

	$time = array('H' => 0, 'M' => '0');
	$a = (strpos($arr1[1], ':')!==false)? @explode(':', $arr1[1]) : @explode(':', $arr1[0]);
	$b = (strpos($arr2[1], ':')!==false)? @explode(':', $arr2[1]) : @explode(':', $arr2[0]);
	if (is_array($b))
	foreach ($b as $k => $v){ $v = str_replace('%', '', $v); $time[$v] = $a[$k]; }

	return @mktime($time['H'], $time['M'], 0, $date['m'], $date['d'], $date['Y']);
}
/** 		
* Return microtime of current
*  
* @param 				: no
* @return 			: float
*/
function microtime_float(){
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
/** 		
* Show date time by language
*  
* @param 				: no
* @return 			: float
*/
function dateformat($datetime){
	global $_LANG_ID;
	if ($_LANG_ID=='jp'){
		return date("Y/m/d", $datetime);
	}else
	if ($_LANG_ID=='en'){
		return date("m/d/Y", $datetime);
	}
	return date("d/m/Y", $datetime);
}

function mkDayTime($str='02/10/2014', $format='dd/mm/YY', $hour=1, $minute=0){/*dd/mm/YY*/
	$a = array();
	if (is_numeric($str) && $format!=='YYmmdd'){
		$a[0] = date('d', $str);
		$a[1] = date('m', $str);
		$a[2] = date('Y', $str);
	}else{
		if ($format=='dd/mm/YY'){
			$a = explode('/', $str);
		}else
		if ($format=='YYmmdd'){
			$a[2] = intval(substr($str, 0, 4));
			$a[1] = intval(substr($str, 4, 2));
			$a[0] = intval(substr($str, -2));
		}
	}	
	return mktime($hour, $minute, 0, $a[1], $a[0], $a[2]);
}
function date2text($date=""){
	if ($date=="") $date = time();
	$s = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$r = array("Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ nhật");
	return $text = str_replace($s, $r, date("l, d\/m\/Y", $date));
}
function inGioGD(){
	$hour = date('H');
	return ($hour>7 && $hour<16);		
}
?>