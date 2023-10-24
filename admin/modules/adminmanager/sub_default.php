<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrStaffOptions, $arrYesNoOptions, $arrGenderOptions, $arrActiveOptions;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$s_staff_id = getPOST("s_staff_id", '');
	$rowsPerPage = 50;	
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	if (isset($_GET["reset"])){
		$arrVars = array("s_staff_id");
		foreach ($arrVars as $key => $val){ getPost_remove($val); }
		unset($arrVars);
	}

	//init Button
	//$clsButtonNav->set("Save..", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");

	//################### CHANGE BELOW CODE ###################
		//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$cond = "user_group_id='6'" ;
	if ($core->_USER['user_id']!=1){ $cond.= " AND user_id!=1"; }
	if ($s_staff_id!=""){ $cond.= " AND staff_id='$s_staff_id'"; }
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Admin"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("user_name", "UserName", "width='10%' align='center'");
	$clsDataGrid->addColumnLabel("user_id", "ID", "width='10%' align='center'");
	$clsDataGrid->addColumnLabel("fullname", "FullName", "width='15%' align='center'");
	$clsDataGrid->addColumnLabel("email", "Email", "width='15%' align='center'");
	$clsDataGrid->addColumnSelect("is_super", "SuperAdmin?", "width='10%' align='center' nowrap", $arrYesNoOptions, 0, 1);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query");
			exit();
		}
	}
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsStaff"] = makeHTMLOptions($arrStaffOptions, $s_staff_id);
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $default_permiss_array, $default_permiss_key, $default_permiss_name;
	global $core, $clsModule, $clsButtonNav, $arrStaffOptions, $arrYesNoOptions, $arrGenderOptions, $arrActiveOptions;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$s_staff_id = getPOST("s_staff_id", '');
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	//################### CHANGE BELOW CODE ###################
	if ($pvalTable==1 && $pvalTable!=$core->_USER['user_id']){
		header("location: ?mod=$mod");
		exit();
	}
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable, 0);
	$clsForm->setTitle($core->getLang("Admin"));
	$clsForm->addInputText("user_name", "", "UserName", 32, 0, "style='width:300px'");	
	if ($mode=="Edit"){
		$clsForm->addInputPassword("user_pass", "", "NewPassword", 255, 0,  "style='width:300px'");
	}else{
		$clsForm->addInputPassword("user_pass", "", "Password", 255, 0,  "style='width:300px'");
	}
	$password_hint = ($mode=="Edit")? "Leave if no change password" : "";
	$clsForm->addHint("user_pass", $password_hint);
	$clsForm->addInputText("fullname", "", "FullName", 255, 0, "style='width:300px'");
	$clsForm->addInputEmail("email", "", "Email", 255, 0, "style='width:300px'");
	$clsForm->addInputHidden("reg_date", time());
	$clsForm->addInputHidden("user_group_id", 6);
	$clsForm->addInputRadio("gender", 0, "Gender?", $arrGenderOptions, 0, "style='font-size:12px'");
	$clsForm->addInputRadio("is_super", 0, "<b>Super Admin?</b>", $arrYesNoOptions, 0, "style='font-size:12px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?mod=$mod");
				exit();
			}
		}
	}
	
	$assign_list["arrOneSite"] = $arrOneSite;
	$assign_list["default_permiss_key"] = $default_permiss_key;
	$assign_list["default_permiss_name"] = $default_permiss_name;
	$assign_list["admin_permiss"] = @unserialize($clsForm->record["admin_permiss"]);
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		if ($pvalTable!=1){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $pvalTable, "user_name", "Admin");
			//End RecycleBin
			$clsTable->deleteOne($pvalTable);
		}
		header("location: ?mod=$mod");
		exit();
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val)
		if ($val!=1){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "user_name", "Admin");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?mod=$mod");
	}
	unset($clsTable);
}
?>