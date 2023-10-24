<?
/**
*  Default Action
*  @author		: Tran Anh Tuan (tuantavnu@gmail.com)
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/

function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Language";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	$rowsPerPage = 20;	
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
	if ($pvalTable!=""){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=setting&act=language");
	}
	//################### CHANGE BELOW CODE ###################
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$cond = "";
	$baseUrl = "?mod=$mod";
	if ($_GET["return"]!=""){
		$baseUrl.= "&return=".$_GET["return"];
	}
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setReturnExp($returnExp);
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setOrderBy("lang_code");
	$clsDataGrid->setTitle($core->getLang("Language"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("lang_code", "LangCode", "width='15%'");
	$clsDataGrid->addColumnLabel("name", "LangName", "width='15%'");
	$clsDataGrid->addColumnLabel("charset", "Charset", "width='25%'");
	$clsDataGrid->addColumnSelect("is_online", "IsOnline?", "width='5%' align='center'", array("NO", "YES"));
	
	$clsLanguage = new Language();
	$lang_name = $clsLanguage->getByField($lang_code, "name");
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			header("location: $baseUrl");
		}
	}	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["lang_name"] = $lang_name;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Language";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($return);
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	
	//################### CHANGE BELOW CODE ###################
	$arrYesNoOptions = array("NO", "YES");
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Language"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("lang_code", "", "Lang Code", 255, 0, "style='width:200px'");
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:200px'");
	$clsForm->addInputText("charset", "", "Charset", 255, 0, "style='width:200px'");
	$clsForm->addInputSelect("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:10px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){				
				header("location: ?$return");
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
/**
*  Show detail an Item
*  @author		: Tran Anh Tuan (tuantavnu@gmail.com)
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Language";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Language");
		//End RecycleBin
		$clsTable->deleteOne($pvalTable);
		header("location: ?$return");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Language");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsTable);
}
?>