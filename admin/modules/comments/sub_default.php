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
	$classTable = "NewsComment";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$rowsPerPage = 20;	

	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");	
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName);
	$clsDataGrid->setOrderBy("reg_date DESC");
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("FeedbackNews"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("comment_id", "#ID", "width='5%'");
	$clsDataGrid->addColumnUrl("news_id", "News", "width='5%' align='center'", "<a href='../?mod=news&view_news_id=%1%' target='blank'>".$core->getLang("View_news")."</a>");
	$clsDataGrid->addColumnLabel("user_id", "UserID", "width='10%' align='center'");
	$clsDataGrid->addColumnLabel("fullname", "FullName", "width='10%'");
	$clsDataGrid->addColumnLabel("email", "Email", "width='10%'");
	$clsDataGrid->addColumnLabel("content", "Content", "width='20%' align='center'");
	$clsDataGrid->addColumnDate("reg_date", "Posted_at", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
	$clsDataGrid->addColumnSelect("is_online", "IsOnline?", "width='5%' align='center'", array("NO", "YES"));
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		header("location: ?mod=$mod");
	}
	
	$assign_list["clsDataGrid"] = $clsDataGrid;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "NewsComment";
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
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	
	//################### CHANGE BELOW CODE ###################
	$clsCountry = new Country();
	$arrListCountry = $clsCountry->getAll();
	$arrOptionsCountry = array();
	if (is_array($arrListCountry))
	foreach ($arrListCountry as $key => $val){
		$arrOptionsCountry[$val["country_id"]] = $val["name"];
	}
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("FeedbackNews"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputEmail("user_id", "", "UserID", 255, 0, "style='width:200px'");
	$clsForm->addInputText("fullname", "", "Full Name", 255, 1,  "style='width:200px'");
	$clsForm->addInputText("email", "", "Email", 255, 1,  "style='width:200px'");
	$clsForm->addInputTextArea("content", "", "Content", 255, 30, 5, 0, "style='width:100%'");
	$clsForm->addInputDate("reg_date", "", "Posted_at", "%m/%d/%Y %H:%M");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?mod=$mod");
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
	$classTable = "NewsComment";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "email", "FeedbackNews");
		//End RecycleBin
		$clsTable->deleteOne($pval);
		header("location: ?mod=$mod");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "email", "FeedbackNews");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?mod=$mod");
	}
	unset($clsTable);
}
?>