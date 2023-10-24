<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $sub;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	$classTable = "District";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$clsLanguage = new Language();
	
	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$s_province_id = getPOST("s_province_id", 0);
	$s_keyword = POST("s_keyword", "");
	$rowsPerPage = ($s_province_id>0)? 100 : 50;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");

	//################### CHANGE BELOW CODE ###################
	$htmlOptionProvince = makeListProvince($s_province_id);
	$cond = "";
	if ($s_province_id>0){
		$cond = "province_id=$s_province_id";
	}else{
		$arrOptionsProvince = array();
		makeArrayListProvince($arrOptionsProvince);	
	}
	if ($s_keyword!="") $cond.= ($cond=="")? "name LIKE '%$s_keyword%'" : " AND name LIKE '%$s_keyword%'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setOrderBy("slug ASC");
	$clsDataGrid->setTitle($core->getLang("District"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='20%'");
	$clsDataGrid->addColumnLabel("name_en", "Tên tiếng Anh", "width='15%'");
	$clsDataGrid->addColumnLabel("name_kr", "Tiếng Hàn", "width='15%'");
	$clsDataGrid->addColumnLabel("name_jp", "Tiếng Nhật", "width='15%'");
	$clsDataGrid->addColumnLabel("slug", "Slug", "width='15%'");
	if ($s_province_id==0){
		$clsDataGrid->addColumnSelect("province_id", "Province", "width='10%' align='center'", $arrOptionsProvince, 0, 1);
	}
	//$clsDataGrid->addColumnSelect("internal", "Nội thành?", "width='5%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%'  align='center' nowrap");
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	
	$assign_list["s_keyword"] = $s_keyword;
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionProvince"] = $htmlOptionProvince;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $sub;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	$classTable = "District";
	$clsClassTable = new $classTable; //$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, "");
	$btnSave = POST("btnSave", "");
	$s_province_id = getPOST("s_province_id", 0);
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
	$arrOptionsProvince = array();
	makeArrayListProvince($arrOptionsProvince);
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable, 0);
	$clsForm->setTitle($core->getLang("District"));
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:50%'");
	$clsForm->addInputText("name_en", "", "Tên tiếng Anh", 255, 1, "style='width:50%'");
	$clsForm->addInputText("name_kr", "", "Tên tiếng Hàn", 255, 1, "style='width:50%'");
	$clsForm->addInputText("name_jp", "", "Tên tiếng Nhật", 255, 1, "style='width:50%'");
	$clsForm->addInputText("slug", "", "Slug", 255, 1, "style='width:50%'");
	$clsForm->addInputSelect("province_id", $s_province_id, "Province", $arrOptionsProvince, 0, "style='font-size:12px'");
	//$clsForm->addInputRadio("internal", 1, "Nội thành?", $arrYesNoOptions, 0, "style=''");
	$clsForm->addInputText("order_no", "99999", "OrderNo", 10, 0, "style='width:100px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($_POST["slug"]==""){
			$_POST["slug"] =  utf8_nosign_noblank($_POST["name"]);
		}
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
	$classTable = "District";
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
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "District");
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
			$clsRecycleBin->AddNew($classTable, $val, "name", "District");
			//End RecycleBin
			$clsClassTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsClassTable);
}
?>