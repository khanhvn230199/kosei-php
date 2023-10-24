<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=admintool
 * Display Admin Tool Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_admintool(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;

	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, 1);
	$btnSave = POST("btnSave", "");
	$pkeyTable = "skey";
	$pvalTable = "google_analytics";
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	$arrListKey = array("google_analytics"=>0, "jscode_head"=>0, "jscode_openbody"=>0, "jscode_closebody"=>0);

	foreach ($arrListKey as $key => $val){
		${$key} = br2nl(POST($key, ""));
	}
	//echo $jscode_openbody;
	if ($btnSave!=""){
		foreach ($arrListKey as $key => $val){
			$v = ${$key};
			if ($val==1 && is_array($v)){//if is array
				$v = serialize($v);
			}
			$clsClassTable->setValue($key, $v, $lang_code);
		}
		header("location: ?mod=$mod&act=$act");
		exit();
	}else{
		foreach ($arrListKey as $key => $val){
			$v = $clsClassTable->getValue($key, $lang_code);
			if ($val==1){//if is array
				$v = @unserialize($v);
			}
			${$key} = $v;
		}
	}
	//init Form
	$clsForm = new Form();
	$clsForm->setTextAreaType("none");
	$clsForm->addInputTextArea("jscode_head", $jscode_head, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:150px'");
	$clsForm->addInputTextArea("jscode_openbody", $jscode_openbody, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:150px'");
	$clsForm->addInputTextArea("google_analytics", $google_analytics, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:150px'");
	$clsForm->addInputTextArea("jscode_closebody", $jscode_closebody, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:150px'");
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}

?>