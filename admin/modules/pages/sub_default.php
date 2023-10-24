<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrTemplateOption;
	global $lang_code;
	$classTable = "Pages";
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
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$parent_id&$returnExp",1);
	$clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone");
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Sửa", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Xo", 1, "confirmDelete");
	if ($parent_id!=0){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	}
	$arrParent = array();
	if ($parent_id>0){
		$arrParent = $clsClassTable->getOne($parent_id);
	}
	//################### CHANGE BELOW CODE ###################
	$arrOptionsPage = array("0"=>"- Root Level -");
	makeArrayListPage(0, $arrOptionsPage, "parent_id=0");
	$cond = "lang_code='$lang_code' AND parent_id=$parent_id";
	$baseUrl = "?mod=$mod";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setReturnExp($returnExp);
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setOrderBy("order_no ASC, reg_date DESC");
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Page"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='auto'");
	$clsDataGrid->addColumnLabel("slug", "Slug", "width='20%'");
	$clsDataGrid->addColumnImage("image", "Image", "width='150px' border=0", "width='10%' align='center'");
	$clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='10%' align='center'", "%d/%m/%Y %H:%M");
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center'");
	$clsDataGrid->addColumnSelect("at_home", "Hiển thị trang chủ?", "width='10%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
	if ($parent_id==0){
		$clsDataGrid->addColumnUrl($pkeyTable, "", "width='3%' align='center' nowrap", "<a href='?mod=$mod&parent_id=%1%&$returnExp' class='abutton1'>".$core->getLang('Child_page')." &raquo;</a>");
	}
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	$assign_list["arrParent"] = $arrParent;
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $arrTemplateOption;
	$classTable = "Pages";
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
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "savecontinue");
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	//################### CHANGE BELOW CODE ###################
	$arrParent = array();
	if ($parent_id>0){
		$arrParent = $clsClassTable->getOne($parent_id);
	}
	$arrOptionsPage = array("0"=>"- Root Level -");
	makeArrayListPage(0, $arrOptionsPage, "parent_id=0");
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Page"));
	$clsForm->setTextAreaType("full");
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%' onblur='getSlug(this, \"slug\");'");
	$clsForm->addInputText("slug", "", "Slug", 255, 0, "style='width:99%' maxlength='50'");
	$clsForm->addInputFile("image", $arrNewsOrginal['image'], "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");
	$clsForm->addInputTextArea("sapo", "", "SAPO", 9999999999, 0, 0, 1, "style='width:100%; height:150px'", "SMALL");
	$clsForm->addInputTextArea("content", "", "Content", 9999999999, 0, 0, 1, "style='width:100%;'");
	$clsForm->addInputSelect("parent_id", $parent_id, "Parent_page", $arrOptionsPage, 0, "style='font-size:12px'");
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:60px'");
	$clsForm->addInputRadio("at_home", 1, "Hiển thị trang chủ?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputText("page_title", "", "[SEOmoz] PageTitle", 255, 1, "style='width:99%'");
	$clsForm->addInputText("meta_keywords", "", "[SEOmoz] MetaKeywords", 255, 1, "style='width:99%'");
	$clsForm->addInputText("meta_des", "", "[SEOmoz] MetaDescription", 255, 1, "style='width:99%'");
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
				if ($mode=="Edit" && $btnSave=="SaveContinue") $return = $_SERVER['QUERY_STRING'];
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
/**
 * Clone the selected records
 */
function default_clone(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Pages";
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
	$classTable = "Pages";
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
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Page");
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
			$clsRecycleBin->AddNew($classTable, $val, "name", "Page");
			//End RecycleBin
			$clsClassTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsClassTable);
}
?>