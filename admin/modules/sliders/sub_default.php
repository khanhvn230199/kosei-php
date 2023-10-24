<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $_arr_slider_format, $_arr_slider_type;
	global $lang_code;
	$classTable = "Sliders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	$_arr_slider_type = $core->getLangArray($_arr_slider_type);

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$rowsPerPage = 20;	
	$sslider_type = GET("sslider_type", key($_arr_slider_type));

	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save...", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone");
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	$cond = "slider_type='$sslider_type' AND lang_code='$lang_code'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setOrderBy("order_no, slider_id DESC");
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Sliders"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="99%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='10%'");
	$clsDataGrid->addColumnImage("image", "Image", "border='0' style='width:100%;max-height:300px'", "width='40%' align='center'");
	$clsDataGrid->addColumnArray("vars", "Content", "width='30%'", $_arr_slider_format);
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center' nowrap");
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='5%' align='center'", $arrYesNoOptions);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query");
			exit();
		}
	}	
	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsSliderType"] = $htmlOptionsSliderType;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $_arr_slider_format, $_arr_slider_type;
	global $lang_code;
	$classTable = "Sliders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	$_arr_slider_type = $core->getLangArray($_arr_slider_type);
	
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
	//################### CHANGE BELOW CODE ###################
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Sliders"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%' placeholder='Vd: slide 1, slide 2'");
	$clsForm->addInputFile("image", "", "Image", "jpg, jpeg, png", 0, "style='width:300px'");
	$clsForm->addInputArray("vars", "", "Content (optional)", "style='width:99%'", $_arr_slider_format);
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 1, "style='width:100px' placeholder='Số thứ tự'");
	$clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputHidden("lang_code", $lang_code);
	$clsForm->addInputHidden("slider_type", key($_arr_slider_type));
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
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
/**
 * Clone the selected records
 */
function default_clone(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Sliders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$_arr_page_template = $core->getLangArray($_arr_page_template);
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			$clsClassTable->cloneOne($val);
		}
		header("location: ?$return");
		exit();
	}
	unset($clsClassTable);
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Sliders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Sliders");
		//End RecycleBin
		$clsTable->deleteOne($pvalTable);
		header("location: ?$return");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Sliders");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsTable);
}
?>