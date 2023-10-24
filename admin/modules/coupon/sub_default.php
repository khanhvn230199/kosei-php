<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Coupon";
	$clsClassTable = new $classTable; //$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$curPage = isset($_GET["page"])? $_GET["page"] : 0;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod&$pkeyTable=0";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	$rowsPerPage = 20;
	
	$for_user = getPOST("for_user", 0);

	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$pvalTable&lang_code=$lang_code&$returnExp",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
	if ($pvalTable==0){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?", 0);
	}
	//################### CHANGE BELOW CODE ###################
	$arrYesNoOptions = array("Không", "Có");
	$arrUser = array(0 => "Tất cả mọi người");
	makeArrayListUser($arrUser, "", 1);
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$baseUrl = "?mod=$mod";	
	if ($_GET["return"]!=""){
		$baseUrl.= "&return=".$_GET["return"];
	}	
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setReturnExp($returnExp);
	$clsDataGrid->setDbTable($tableName);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle("Coupon");
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');	
	$clsDataGrid->addColumnLabel("code", "Mã KM", "width='10%' align='center'");
	$clsDataGrid->addColumnLabel("price_vn", "Giá giảm VN", "width='5%' align='center'");
	$clsDataGrid->addColumnLabel("price_jp", "Giá giảm JP", "width='5%' align='center'");
	$clsDataGrid->addColumnLabel("quantity", "Số lượng", "width='5%' align='center'");
	$clsDataGrid->addColumnLabel("used", "Đã sử dụng", "width='5%' align='center'");
	$clsDataGrid->addColumnDate("start_date", "Bắt đầu", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
	$clsDataGrid->addColumnDate("expire_date", "Kết thúc", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
	$clsDataGrid->addColumnDate("reg_date", "Ngày tạo", "width='5%' align='center' nowrap ", "%m/%d/%Y");
	$clsDataGrid->addColumnSelect("is_online", "Hoạt động?", "width='5%' align='center'", $arrYesNoOptions, 0, 0);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		if ($clsDataGrid->saveData()){
			header("location: $baseUrl");
		}
	}	
	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["for_user"] = $for_user;
}
function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Coupon";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	$for_user = getPOST("for_user", 0);
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	$returnExp = "return=".base64_encode($return);
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	if ($mode=="Edit"){
		$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
		$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
	}
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	
	//################### CHANGE BELOW CODE ###################
	$arr_ctype = array("%", "₫");
	$arrYesNoOptions = array("Không", "Có");
	$start_date = time();
	$expire_date = $start_date + 30*24*3600;
	
	$arrUser = array(0 => "Tất cả mọi người",'-1'=> "Tất cả tài khoản");
	makeArrayListUser($arrUser, "", 1);
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle("Coupon");
	$clsForm->setTextAreaType("none");
	// if ($mode=='Edit'){
	// 	$readonly = 'readonly';
	// }else{
	// 	$readonly = '';
	// }
	$clsForm->addInputText("code", "", "Mã KM", 255, 0, "style='width:40%' $readonly");
	$clsForm->addInputText("price_vn", "", "Giá giảm VN", 255, 0, "style='width:20%' $readonly");
	$clsForm->addInputText("price_jp", "", "Giá giảm JP", 255, 0, "style='width:20%' $readonly");
	$clsForm->addInputText("quantity", "1", "Số lượng mã", 255, 0, "style='width:20%' $readonly");
	$clsForm->addInputText("used", "0", "SL đã sử dụng", 6, 1, "style='width:10%' readonly");
	$clsForm->addInputDate("start_date", $start_date , "Thời gian bắt đầu", "%m/%d/%Y %H:%M", 1, 0, "style='width:150px'");
	$clsForm->addInputDate("expire_date", $expire_date, "Thời gian kết thúc", "%m/%d/%Y %H:%M", 1, 0, "style='width:150px'");	
	$clsForm->addInputTextArea("des", "", "Mô tả", 9999999999, 10, 5, 1,  "style='width:100%; height:100px'");
	$clsForm->addInputSelect("is_online", 1, "Hoạt động?", $arrYesNoOptions, 0, "style=''");
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
            $clsForm->addInputHidden("reg_date", time());
			if ($mode=='New' && $clsClassTable->isExists($_POST['code'])==1){
				$clsForm->isValid = 0;
				$clsForm->errorStr = "<li>Mã này đã tồn tại rồi</li>";
			}else
			if ($clsForm->saveData($mode)){				
				header("location: ?$return");
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
	$assign_list["for_user"] = $for_user;
}
function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Coupon";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pval!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Coupon");
		//End RecycleBin
		$clsTable->deleteOne($pvalTable);
		header("location: ?$return");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "name", "Coupon");
			//End RecycleBin
			$clsTable->deleteOne($val);
		}
		header("location: ?$return");
	}
	unset($clsTable);
}
?>