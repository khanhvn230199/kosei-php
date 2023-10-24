<?
/******************************************************
 * Admin Header File
 * Load after module file called
 * 
 * Project Name               :  Shopping Themes DVS
 * Package Name            		:  
 * Program ID                 :  footer.php
 * Environment                :  PHP  version version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	TuanTA          -  		-     -     -
 *
 ********************************************************/
$assign_list["VNCMS_DIR"] = VNCMS_DIR;
$assign_list["VNCMS_URL"] = VNCMS_URL;
$assign_list["_SITE_ROOT"] = $_SITE_ROOT;

$assign_list["clsButtonNav"] = $clsButtonNav;
$assign_list["ADMIN_URL_IMAGES"] = ADMIN_URL_IMAGES;
$assign_list["ADMIN_URL_CSS"] = ADMIN_URL_CSS;
$assign_list["ADMIN_URL_JS"] = ADMIN_URL_JS;
$assign_list["URL_UPLOADS"] = URL_UPLOADS;

$assign_list["_CONFIG"] = $_CONFIG;

$assign_list["lang_code"] = $lang_code;
$assign_list["lang_code_name"] = $lang_code_name;
$assign_list["_LANG_ID_NAME"] = $_LANG_ID_NAME;
$assign_list["htmlOptionsLang"] = makeListLang($lang_code);
?>