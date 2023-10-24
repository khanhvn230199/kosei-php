<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $sub;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	$classTable = "Province";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$clsLanguage = new Language();

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$s_region_id = getPOST("s_region_id", 0);
	$s_keyword = POST("s_keyword", "");
	$rowsPerPage = 100;	
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);

	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	//$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");

	//################### CHANGE BELOW CODE ###################
	$htmlOptionRegion = makeListRegion($s_region_id);
	$cond = "";
	if ($s_region_id>0){
		$cond = "region_id=$s_region_id";
	}else{
		$arrOptionsRegion = array();
		makeArrayListRegion($arrOptionsRegion);
	}
	if ($s_keyword!="") $cond.= ($cond=="")? "name LIKE '%$s_keyword%'" : " AND name LIKE '%$s_keyword%'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setOrderBy("order_no ASC, slug ASC");
	$clsDataGrid->setTitle($core->getLang("Province"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='15%'");
	$clsDataGrid->addColumnLabel("name_en", "Tiếng Anh", "width='15%'");
	$clsDataGrid->addColumnLabel("name_kr", "Tiếng Hàn", "width='15%'");
	$clsDataGrid->addColumnLabel("name_jp", "Tiếng Nhật", "width='15%'");
	$clsDataGrid->addColumnLabel("slug", "Slug", "width='15%'");
	$clsDataGrid->addColumnLabel("code", "Code", "width='5%'  align='center'");
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' nowrap align='center'");
	$clsDataGrid->addColumnSelect("is_online", "IsOnline?", "width='5%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addColumnUrl($pkeyTable, "", "width='3%' align='center' nowrap", "<a href='?mod=district&s_province_id=%1%&$returnExp'>DS Quận/Huyện &raquo;</a>");
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
	}
	
	$assign_list["s_keyword"] = $s_keyword;
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionRegion"] = $htmlOptionRegion;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $sub;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	$classTable = "Province";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		//$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	//################### CHANGE BELOW CODE ###################
	$arrOptionsRegion = array();
	makeArrayListRegion($arrOptionsRegion);
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable, 0);
	$clsForm->setTitle($core->getLang("Province"));
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:50%'");
	$clsForm->addInputRadio("region_id", 1, "Region", $arrOptionsRegion, 0, "style='font-size:12px'");
	$clsForm->addInputText("name_en", "", "Tên tiếng Anh", 255, 1, "style='width:50%'");
	$clsForm->addInputText("name_kr", "", "Tên tiếng Hàn", 255, 1, "style='width:50%'");
	$clsForm->addInputText("name_jp", "", "Tên tiếng Nhật", 255, 1, "style='width:50%'");
	$clsForm->addInputText("slug", "", "Slug", 255, 1, "style='width:50%'");
	$clsForm->addInputText("code", "", "Code", 255, 1,  "style='width:200px'");
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:200px'");
	$clsForm->addInputRadio("is_online", 1, "IsOnline", $arrYesNoOptions, 0, "style='font-size:12px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($_POST['slug']=="")
			$clsForm->addInputHidden("slug", utf8_nosign_noblank($_POST["name"]));
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?mod=$mod");
				exit();
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $sub;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Province";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Province");
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
			$clsRecycleBin->AddNew($classTable, $val, "name", "Province");
			//End RecycleBin
			$clsClassTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsClassTable);
}
?>