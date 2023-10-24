<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $lang_code;
	$classTable = "Advisory";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;

	//get _GET, _POST
	$curPage = GET("page", 0);
	$btnSave = POST("btnSave", "");
	$rowsPerPage = 20;	
	$parent_id = GET("parent_id", 0);
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");	
//	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$cond = "lang_code='$lang_code' ";
	$baseUrl = "?mod=$mod";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setOrderBy("reg_date DESC");
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Đăng ký tư vấn"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='10%'");
	$clsDataGrid->addColumnLabel("phone", "Điện thoại", "width='10%'");
	$clsDataGrid->addColumnLabel("email", "Email", "width='10%'");
	$clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='10%' align='center'");
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	global $lang_code, $arrYesNoOptions;
	$classTable = "Advisory";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$parent_id = GET("parent_id", 0);
	$pvalTable = GET($pkeyTable, "");
	$btnSave = POST("btnSave", "");
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($return);
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	//################### CHANGE BELOW CODE ###################
	$arrParent = array();
	if ($parent_id>0){
		$arrParent = $clsClassTable->getOne($parent_id);
	}
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Page"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("name", "", "Họ và tên", 255, 0, "style='width:99%' maxlength='50'");
	$clsForm->addInputText("phone", "", "Điện thoại", 255, 0, "style='width:99%' maxlength='50'");
	$clsForm->addInputText("email", "", "Email", 255, 0, "style='width:99%' maxlength='50'");
	$clsForm->addInputTextArea("content", "", "Content", 9999999999, 0, 0, 1, "style='width:100%;'");
	$clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");

	$clsForm->addInputHidden("reg_date", time());
	if ($mode=="New"){
		$clsForm->addInputHidden("lang_code", $lang_code);
	}
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($mode=="Edit" && $pvalTable==$_POST["parent_id"]){
			$_POST["parent_id"] = 0;
		}
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				if ($mode=="Edit") $return = $_SERVER['QUERY_STRING'];
				header("location: ?$return");
				exit();
			}
		}
	}
	
	$assign_list["arrParent"] = $arrParent;
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Advisory";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$_arr_page_template = $core->getLangArray($_arr_page_template);
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Advisory");
		//End RecycleBin
		$clsClassTable->deleteOne($pvalTable);
		header("location: ?$return");
		exit();
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Advisory");
			//End RecycleBin
			$clsClassTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsClassTable);
}
?>