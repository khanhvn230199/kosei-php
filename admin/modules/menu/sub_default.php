<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $arrTargetOptions, $_arr_menu_type, $_max_category_level;
	global $lang_code;
	$classTable = "Menu";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	if (isset($_GET["reset"])){
		$arrVars = array("mtype");
		foreach ($arrVars as $key => $val){ getPost_remove($val); }
		unset($arrVars);
	}
	$arrTargetOptions = $core->getLangArray($arrTargetOptions);
	$arrYesNoOptions = $core->getLangArray($arrYesNoOptions);
	$_arr_menu_type = $core->getLangArray($_arr_menu_type);
	
	//get _GET, _POST
	$mtype = getPOST("mtype", key($_arr_menu_type));
	$pvalTable = GET($pkeyTable, "0");
	$curPage = GET("page", 0);
	$btnSave = POST("btnSave", "");
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	$rowsPerPage = 50;	
	//init Button
	$clsButtonNav->set("Repair", "/icon/apps_16.gif", "?mod=$mod&act=repair&parent_id=$pvalTable&$returnExp",1);
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$pvalTable&mtype=$mtype&$returnExp",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	if ($pvalTable==0){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	}

	//################### CHANGE BELOW CODE ###################
	$arrOptionsPage = array(	"0"=> "" );	
	makeArrayListPage(0, $arrOptionsPage);
	$arrOptionsCategory = array(""=>"");
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype IN(".CTYPE_BV.",".CTYPE_KH.",".CTYPE_GV.",".CTYPE_GT.")");
	$arrMegaMenuOptions = $arrYesNoOptions;
	$arrMegaMenuOptions[2] = "Có (Tin tức)";

	$cond = "lang_code='$lang_code'";
	if ($pvalTable!=""){
		$cond.= " AND parent_id='$pvalTable'";
		$baseUrl = "?mod=$mod&$pkeyTable=$pvalTable";
	}else{
		$baseUrl = "?mod=$mod";
	}
	if ($_GET["return"]!=""){
		$baseUrl.= "&return=".$_GET["return"];
	}
	$cond.= " AND mtype='$mtype'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setOrderBy("order_no ASC");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Menu"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "MenuName", "width='10%' nowrap");
	$clsDataGrid->addColumnImage("image", "Image", "width=100px height=70px border=0", "width='5%' align='center'");
	$clsDataGrid->addColumnSelect("page_id", "Page?", "width='10%' align='center'", $arrOptionsPage);
	$clsDataGrid->addColumnSelect("cat_id", "Category?", "width='10%' align='center'", $arrOptionsCategory);
	$clsDataGrid->addColumnLabel("custom_link", "CustomURL", "width='10%' align='center'");
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center'");
//	$clsDataGrid->addColumnSelect("allow_sub", "Lấy con?", "width='2%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addColumnSelect("is_megamenu", "MegaMenu?", "width='2%' align='center'", $arrMegaMenuOptions);
	$clsDataGrid->addColumnUrl($pkeyTable, "", "width='1%' align='center' nowrap", "<a href='?mod=menu&$pkeyTable=%1%&$returnExp'>Menu con</a>");
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["menuPathAdmin"] = $clsClassTable->getMenuPathAdmin($pvalTable, "return=".$_GET["return"]);
	$assign_list["htmlOptionsMenu"] = makeHTMLOptions($_arr_menu_type, $mtype);
	$assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $arrTargetOptions, $_arr_menu_type, $_max_category_level;
	global $lang_code;
	$classTable = "Menu";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;

	$arrTargetOptions = $core->getLangArray($arrTargetOptions);
	$arrYesNoOptions = $core->getLangArray($arrYesNoOptions);
	$_arr_menu_type = $core->getLangArray($_arr_menu_type);
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, "");
	$btnSave = POST("btnSave", "");
	$parent_id = GET("parent_id", 0);
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($return);
	$mtype = getPOST("mtype", "horizon");
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	//################### CHANGE BELOW CODE ###################
	$arrOptionsPage = array(	"0"=> "" );
	makeArrayListPage(0, $arrOptionsPage);
	$arrOptionsCategory = array("0"=>"");
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype IN(".CTYPE_BV.",".CTYPE_KH.")");
	$arrMegaMenuOptions = $arrYesNoOptions;
	$arrMegaMenuOptions[2] = "Có (Tin tức)";
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Menu"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("name", "", "MenuName", 255, 0, "style='width:50%' maxlength=50");
	$clsForm->addInputFile("image", "", "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");
	$clsForm->addInputSelect("page_id", 0, "[1]. Page", $arrOptionsPage, 0, "style='font-size:12px'");
	$clsForm->addInputSelect("cat_id", 0, "[2]. Category", $arrOptionsCategory, 0, "style='font-size:12px'");
	$clsForm->addInputText("custom_link", "", "[3]. URL", 255, 1, "style='width:50%'");
	$clsForm->addInputSelect("target", '_parent', "Target", $arrTargetOptions, 0, "style='font-size:12px'");
	$clsForm->addAttachInput("custom_link", "target");
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:60px'");
//	$clsForm->addInputSelect("allow_sub", 1, "Tự động lấy nhóm/trang con?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputSelect("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputSelect("is_megamenu", 0, "Là Mega Menu?", $arrMegaMenuOptions, 0, "style='font-size:12px'");
//	$clsForm->addInputText("cssclass", "", "CSS Clas", 50, 1, "style='width:300px'");
	if ($mode=="New"){
		$clsForm->addInputHidden("mtype", $mtype);
		$clsForm->addInputHidden("lang_code", $lang_code);
		$clsForm->addInputHidden("parent_id", $parent_id);
	}
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?$return");
				exit();
			}
		}
	}
	
	$assign_list["clsForm"] = $clsForm;
	$assign_list["menu_text"] = $_arr_menu_type[$mtype];
	$assign_list[$pkeyTable] = $pvalTable;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Menu";
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
			$clsRecycleBin->AddNew($classTable, $val, "name", "Menu");
			//End RecycleBin
			$clsClassTable->deleteMenu($val);
		}
		header("location: ?$return");
		die();
	}
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		$clsClassTable->deleteMenu($pvalTable);
		header("location: ?$return");
		die();
	}
	unset($clsClassTable);
}
//Begin Tuanta Added 23/07/2010
function default_repair(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Menu";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	$parent_id = isset($_GET["parent_id"])? $_GET["parent_id"] : 0;
	if ($return=="") $return = "mod=$mod";	
	echo "<p>[Start repair]</p>";
	$ok = $clsClassTable->repairMenuName($parent_id, 1);
	if ($ok==1) echo "Done!";
	echo "<p>[Finish repair]</p>";
	echo "Redirecting...";
	echo '<meta http-equiv="refresh" content="1;url=?'.$return.'">';
	die();
}
//End Tuanta Added 23/07/2010
?>