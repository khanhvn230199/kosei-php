<?
/**
 * Module: [settings]
 * Home function with $sub=default, $act=default
 * Display Default Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $lang_code;
	$classTable = "Settings";
	$clsClassTable = new $classTable;//$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$rowsPerPage = 50;	

	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$cond = "lang_code='$lang_code'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$arrTypeOptions = array("text"=>"Text", "ftext"=>"FlexText", "textarea"=>"Text Area", "boolean"=>"Boolean", "array"=>"Array");
	$clsDataGrid->setOrderBy("skey ASC");
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle("Settings");
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("skey", "Key", "width='10%'");
	$clsDataGrid->addColumnLabel("svalue", "Value", "width='40%'", 0);
	$clsDataGrid->addColumnLabel("stitle", "Title", "width='15%' align='center'");
	$clsDataGrid->addColumnSelect("ftype", "Type", "width='5%'  align='center'", $arrTypeOptions);
	$clsDataGrid->addColumnLabel("order_no", "Order No", "width='5%'  align='center'");
	$clsDataGrid->addColumnSelect("is_online", "Online?", "width='5%' align='center'", array("NO", "YES"));
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		header("location: ?mod=$mod");
	}
	
	$assign_list["clsDataGrid"] = $clsDataGrid;
}
/**
 * Module: [settings]
 * Home function with $sub=default, $act=add
 * Display Add setting Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	if ($_POST["ftype"]=="boolean" || $_POST["ftype"]=="text"){
		$_POST["svalue"] = trim(strip_tags(htmlspecialchars_decode($_POST["svalue"])));
	}
	//################### CHANGE BELOW CODE ###################
	//init Form
	$arrTypeOptions = array("text"=>"Text", "ftext"=>"FlexText", "textarea"=>"Text Area", "boolean"=>"Boolean", "array"=>"Array");
	$arrYesNoOptions = array("NO", "YES");
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle("Settings");
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("skey", "", "Key Name", 100, 0, "style='width:200px'");
	$clsForm->addInputTextArea("svalue", "", "Value", 9999999999, 10, 5, 1,  "style='width:80%;height:200px'");
	$clsForm->addInputText("stitle", "", "Title", 255, 0, "style='width:80%'");
	$clsForm->addInputSelect("ftype", "", "Type", $arrTypeOptions, 0, "style=''");
	$clsForm->addInputText("order_no", "99", "Order No", 3, 1, "style='width:200px'");
	$clsForm->addInputSelect("is_online", 1, "Is Online?", $arrYesNoOptions, 0, "style='font-size:10px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?mod=$mod");
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
/**
 * Module: [settings]
 * Home function with $sub=default, $act=delete
 * Delete setting
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pval = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pval!=""){
		$clsTable->deleteOne($pval);
		header("location: ?mod=$mod");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			$clsTable->deleteOne($val);
		}
		header("location: ?mod=$mod");
	}
	unset($clsTable);
}
?>