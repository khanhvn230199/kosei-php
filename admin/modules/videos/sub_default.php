<?
/**
*  Default Action
*  @author		: Tran Anh Tuan (tuantavnu@gmail.com)
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $_max_category_level, $lang_code;
	$classTable = "Video";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$rowsPerPage = 20;	

	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?admin&mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?admin&mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	$arrOptionsCategory = array();
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype=".CTYPE_VIDEO);
	makeArrayListAuthor($arrAuthor, 1);
	$baseUrl = "?mod=$mod";
	$cond = "lang_code='$lang_code'";
	if ($_GET["return"]!=""){
		$baseUrl.= "&return=".$_GET["return"];
	}
	//Begin Added 20080704
	$clsCategory = new Category();
	$clsCategory->getParentArray();
	$skeyword = isset($_REQUEST["skeyword"])? $_REQUEST["skeyword"] : "";
	$scatid = isset($_REQUEST["scatid"])? $_REQUEST["scatid"] : "";
	$scatid_options = "";
	if (is_array($arrOptionsCategory))
		foreach ($arrOptionsCategory as $k => $v){
		$selected = ($k==$scatid)? "selected" : "";
		$scatid_options.= "<option value='$k' $selected >$v</option>";
	}
	if ($skeyword!=""){
		$cond.= " AND (name LIKE '%$skeyword%')";
		$baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
		$baseUrl.= "&skeyword=$skeyword";
		$rowsPerPage = 100;
	}
	if ($scatid!="" && $scatid!="0"){
		$strcatid = $clsCategory->getAllCatStr($scatid)."$scatid";
		$cond.= " AND cat_id in ($strcatid)";
		$baseUrl = preg_replace("/\&scatid=(\w+)/e", "", $baseUrl);
		$baseUrl.= "&scatid=$scatid";
		$rowsPerPage = 100;
	}
	$assign_list["skeyword"] = $skeyword;
	$assign_list["scatid_options"] = $scatid_options;
	//End
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);	
	$clsDataGrid->setBaseURL($baseUrl);	
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle("Video");
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='15%'");
	$clsDataGrid->addColumnImage("image", "Image", "width=100px height=70px border=0", "width='5%' align='center'");
	$clsDataGrid->addColumnLabel("des", "Description", "width='25%'");
	$clsDataGrid->addColumnLabel("total_view", "Lượt xem", "width='5%' align='center'");
	$clsDataGrid->addColumnDate("reg_date", "Posted_at", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
	$clsDataGrid->addColumnSelect("user_id", "Author", "width='5%' align='center'", $arrAuthor, 0, 1);
	$clsDataGrid->addColumnSelect("is_online", "Display?", "width='5%' align='center'", $arrYesNoOptions);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	
	$assign_list["base_url1"] = "?mod=video";
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $_max_category_level, $lang_code;
	$classTable = "Video";
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
		//$clsButtonNav->set("New", "/icon/add2.png", "?admin&mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?admin&mod=$mod&act=delete&$pkeyTable=$pvalTable");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	
	$arrYesNoOptions = array("NO", "YES");
	//################### CHANGE BELOW CODE ###################
	$arrOptionsCategory = array();
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype=".CTYPE_VIDEO);
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle("Video");
	$clsForm->setTextAreaType("none");
	$clsForm->addInputSelect("cat_id", 1, "Category", $arrOptionsCategory, 0, "style='font-size:12px'");
	$clsForm->addInputText("name", "", "Title", 255, 0, "style='width:99%'");
	$clsForm->addInputFile("image", "", "Ảnh đại diện<br>(nếu không nhập sẽ tự lấy ảnh từ Youtube) ", "jpg, jpeg, gif, png", 1, "style='width:300px'");
	$clsForm->addInputText("des", "", "Description", 255, 1,  "style='width:99%'");
	$clsForm->addInputText("yb_id", "", "Youtube Video ID<br>vd: https://www.youtube.com/watch?v=<b>ycGfvA1vkR8</b>", 255, 0,  "style='width:50%' onchange='show_preview_video(this);' onblur='show_preview_video(this);'");
	$clsForm->addInputSelect("is_online", 1, "IsOnline", $arrYesNoOptions, 0, "style='font-size:10px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		$clsForm->addInputHidden("slug", utf8_nosign_noblank($_POST["name"]));
		$clsForm->addInputHidden("reg_date", time());
		$clsForm->addInputHidden("user_id", $core->_USER['user_id']);
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				if ($mode=="Edit") $return = $_SERVER['QUERY_STRING'];
				header("location: ?$return");
				exit();
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}

function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Video";
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
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Video");
		//End RecycleBin
		$clsTable->deleteOne($pvalTable);
		header("location: ?$return");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Video");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsTable);
}
?>