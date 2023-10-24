<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	global $arrCtypeOptions, $arrYesNoOptions, $arrTemplateOption;
	global $clsLanguage, $lang_code;
	$classTable = "Filter";
	$clsClassTable = new $classTable;//$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;	

	//get _GET, _POST
	$view_type = getPOST("view_type", 'group');
	$pvalTable = GET($pkeyTable, "");
	$curPage = GET("page", 0);
	$btnSave = POST("btnSave", "");
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	$rowsPerPage = 20;	
	if (isset($_GET["view_type"])){
		header("location:?mod=$mod");
		exit();
	}
	//count level
	$catPathAdmin = $clsClassTable->getCatPathAdmin($pvalTable);
	$level = substr_count($catPathAdmin, "&rarr;");
	$assign_list["catPathAdmin"] = $catPathAdmin;
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");	
	if ($level <= MAX_LEVEL_CATEGORY-1){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$pvalTable&$returnExp",1);
	}
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
	if ($pvalTable!=0){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	}
	//################### CHANGE BELOW CODE ###################
	$cond_lang = "lang_code='$lang_code'";
    $arrOptionsFilter = array("0" => "- Root Level -");
    makeArrayListFilter(0, 0, MAX_LEVEL_CATEGORY, $arrOptionsFilter, "");
    $arrOptionsCategory = array("0" => "- Root Level -");
    makeArrayListCategory(0, 0, MAX_LEVEL_CATEGORY, $arrOptionsCategory, " ctype=" . CTYPE_KH);
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$cond = "$cond_lang";
	if ($view_type=="all"){
	}else{
		$cond.= " AND parent_id='$pvalTable'";
	}
	$baseUrl = '?'.$_SERVER['QUERY_STRING'];
    $baseUrl = preg_replace("/\&page=(\w*)/i", "", $baseUrl);
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setReturnExp($returnExp);
	if ($view_type=="all"){
		$clsDataGrid->setDbTable($tableName, $cond, "parent_id");
		$clsDataGrid->setOrderBy("order_no ASC");		
	}elseif ($view_type=="tree"){
		$arrCatTree = $clsClassTable->getCatTree(0, "");
		$assign_list["arrCatTree"] = $arrCatTree;
		$x = countLeaf($arrCatTree);
		$assign_list["x"] = $x;
	}else{
		$clsDataGrid->setDbTable($tableName, $cond);
	}
	//begin DataGrid
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Filter"));
	$clsDataGrid->setOrderBy("order_no ASC, filter_id DESC");
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='10%'");
	$clsDataGrid->addColumnSelect("cat_id", "Bộ lọc dành cho danh mục", "width='10%' align='left'", $arrOptionsCategory, 0, 0);
	if ($view_type=='all'){
		$clsDataGrid->addColumnSelect("parent_id", "Nhóm cha", "width='10%' align='left'", $arrOptionsFilter, 0, 1);
	}
	// $clsDataGrid->addColumnImage("image", "Image", "width=100px height=100px border=0", "width='5%' align='center'");
	// $clsDataGrid->addColumnLabel("slug", "Slug", "width='25%'");
	// $clsDataGrid->addColumnLabel("des", "Description", "width='20%'");
	$clsDataGrid->addColumnLabel("total_item", "SL item", "width='3%' align='center' nowrap");
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center'", 5);
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center' nowrap", $arrYesNoOptions);
	if ($view_type=='group' && $level <= 1){
		$clsDataGrid->addColumnUrl($pkeyTable, "", "width='3%' align='center' nowrap", "<a href='?mod=$mod&filter_id=%1%&$returnExp' class='abutton1'>Nhóm con &raquo;</a>");
	}
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			$clsClassTable->fixSnake();
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query");
			exit();
		}
	}
	$assign_list["arrOptionsFilter"] = $arrOptionsFilter;	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["view_type"] = $view_type;
	$assign_list["returnExp"] = $returnExp;
	$assign_list["arrCatTree"] = $arrCatTree;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	global $arrCtypeOptions, $arrYesNoOptions;
	global $clsLanguage, $lang_code;
	$classTable = "Filter";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$ctype = getPOST("ctype", 0);
	$pvalTable = GET($pkeyTable, "");
	$parent_id_def = GET("parent_id", 0);
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($return);
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	$modeInt = 0;
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		//$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
		$modeInt = 1;
		$arrCurCategory = $clsClassTable->getOne($pvalTable);
	}else{
		$arrCurCategory = array();
		$arrCurCategory['slug'] = "";
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	
	//################### CHANGE BELOW CODE ###################
	$arrOptionsFilter = array("0"=>"- Root Level -");
	makeArrayListFilter(0, 0, MAX_LEVEL_CATEGORY, $arrOptionsFilter, "");
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Lọc"));
	$clsForm->setTextAreaType("small");
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:300px' onblur='ajax_get_cat_slug($modeInt)'");
	$clsForm->addInputSelect("parent_id", $parent_id_def, "ParentGroup", $arrOptionsFilter, 0, "style='font-size:12px'");
	$clsForm->addAttachInput("name", "parent_id");
	$clsForm->addInputText("slug", "", "Slug URL", 255, 1, "style='width:300px; color:#666666' onchange='ajax_check_cat_slug($modeInt)'");
	$clsForm->addInputFile("image", "", "ThumbImage", "jpg, jpeg, png, gif", 1, "style='width:300px'");
	$clsForm->addInputTextArea("des", "", "Description", 1000, 10, 5, 1,  "style='width:100%; height:200px'");
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:100px'");
	$clsForm->addInputSelect("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputHidden("lang_code", $lang_code);
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			$slug = $_POST["slug"];
			if ($slug==""){
				$exists = $clsClassTable->isExistsSlug($slug, $arrCurCategory['slug']);
				if ($exists){
					$slug.= intval($exists) + 1;
				}
			}
			$is_child = ($mode=='Edit')? $clsClassTable->isParentChild($arrCurCategory['filter_id'], $arrCurCategory['parent_id'], $_POST["parent_id"]) : 0;
			if ($is_child==1){
				$clsForm->isValid = 0;
				$clsForm->errorStr = "<li>Nhóm cha không thể là chính nhóm này hoặc 1 nhóm con nhỏ hơn được</li>";
			}else
			if ($clsForm->saveData($mode)){
				$clsClassTable->fixSnake();
				header("location: ?$return");
				exit();
			}
		}
	}	
	$assign_list["ctype"] = $ctype;
	$assign_list["arrCtypeOptions"] = $arrCtypeOptions;
	$assign_list["lang_code_name"] = $clsLanguage->getName($lang_code);
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list["mode"] = $mode;
	$assign_list[$pkeyTable] = $pvalTable;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Filter";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Filter");
			//End RecycleBin
			$clsClassTable->deleteOne($val);
		}
		header("location: ?$return");
		exit();
	}else{
		$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
		if ($pvalTable!=""){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Filter");
			//End RecycleBin
			$clsClassTable->deleteOne($pvalTable);
			header("location: ?$return");
			exit();
		}
	}
	
	unset($clsClassTable);
}
?>