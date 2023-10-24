<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=editlang
 * Display Edit Language Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_editlang(){
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
	if ($btnSave!=""){
		$lang = $_POST["lang"];
		$fout = DIR_LANG."/$lang_code/lang_frontend.php";
		$content = "<?\n";
		foreach ($lang as $key => $val){
			$value = str_replace('"', "'", $val);
			$value = htmlDecode($value);
			$content.= '$_LANG["'.$key.'"] = "'.$value.'";'."\n";
		}
		$content.= "?>";
		file_put_contents($fout, $content);
	}
	require_once(DIR_LANG."/__/lang_frontend.php");
	$arrLang = $_LANG;
	unset($_LANG);
	require_once(DIR_LANG."/$lang_code/lang_frontend.php");
	$arrValue = $_LANG;
	unset($_LANG);

	$assign_list["arrLang"] = $arrLang;
	$assign_list["arrValue"] = $arrValue;
	//####################### ENG CHANGE ######################
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>