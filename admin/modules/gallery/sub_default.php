<?
function list_images_filter($c, $value, $pval, $row){
	$arr_value = explode(',', $value);
	$html = "";
	if (is_array($arr_value)){
		foreach ($arr_value as $k => $v){
			$html.= "<img src='".URL_UPLOADS."/$v' align=left style='width:50px; height:50px; margin-right:5px; margin-bottom:5px;'>";
		}
	}
	return $html;
}
function slug_filter($c, $value, $pval, $row){
	$gallery_id = $row->gallery_id;
	$html = "<input value=\"[gallery id='$gallery_id' column='3' type='grid' height='300']\" style='width:98%' onclick='this.select();return false;'>";
	return $html;
}
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $lang_code;
	$classTable = "Gallery";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	//get _GET, _POST
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$rowsPerPage = 20;	
	$sgallery_type = POST("sgallery_type", 'main');

	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	$cond = "lang_code='$lang_code'";
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL("?mod=$mod");
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setOrderBy("order_no, gallery_id DESC");
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Gallery"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("name", "Name", "width='auto'");
	$clsDataGrid->addColumnLabel("slug", "Mã Shortcode", "width='auto'");
	$clsDataGrid->addColumnLabel("list_images", "Danh sách Ảnh", "width='50%'");
	$clsDataGrid->addColumnText("order_no", "OrderNo", "width='10%' align='center' nowrap");
	$clsDataGrid->addColumnSelect("is_online", "Active?", "width='10%' align='center'", $arrYesNoOptions);
	$clsDataGrid->addFilter("list_images", "list_images_filter");
	$clsDataGrid->addFilter("slug", "slug_filter");
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query");
			exit();
		}
	}	
	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["htmlOptionsGalleryType"] = $htmlOptionsGalleryType;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
	global $lang_code;
	$classTable = "Gallery";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	$_arr_gallery_type = $core->getLangArray($_arr_gallery_type);
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "savecontinue");
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
		$arrOneGallery = $clsClassTable->getOne($pvalTable);
		$tmp = $arrOneGallery['list_images'];
		$arr_list_images = @unserialize($tmp);
	}else{
		$arr_list_images = array();
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	//################### CHANGE BELOW CODE ###################
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Gallery"));
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%' placeholder='Ví dụ: gallery 1, gallery 2'");
	$clsForm->addInputFile("list_images", "", "Danh sách ảnh", "jpg, jpeg, gif, png", 1, "style='width:300px'", "", 1);//multi files
	$clsForm->addInputText("order_no", "99999", "OrderNo", 5, 1, "style='width:100px' placeholder='Số thứ tự'");
	$clsForm->addInputRadio("is_online", 1, "Active?", $arrYesNoOptions, 0, "style='font-size:12px'");
	$clsForm->addInputHidden("lang_code", $lang_code);
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				if ($btnSave=="SaveContinue"){
					$query = $_SERVER['QUERY_STRING'];
					header("location: ?$query");
					exit();
				}else{
					header("location: ?mod=$mod");
					exit();
				}
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
	$classTable = "Gallery";
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
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Gallery");
		//End RecycleBin
		$clsTable->deleteOne($pvalTable);
		header("location: ?$return");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Gallery");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsTable);
}
?>