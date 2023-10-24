<?
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $paymentMethodList, $transportMethodList;
	require_once DIR_COMMON."/clsDatePicker.php";
	$classTable = "Orders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	$clsLanguage = new Language();
	//get _GET, _POST
	$status = POST("status", -1);	
	$btnSave = POST("btnSave", "");
	$rowsPerPage = 50;	
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	/*$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");*/
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	$from_date = isset($_REQUEST["from_date"])? strtotime($_REQUEST["from_date"]) : strtotime(date("m/d/Y", time()-1*30*24*60*60));
	$to_date = isset($_REQUEST["to_date"])? strtotime($_REQUEST["to_date"]) : strtotime(date("m/d/Y"));	
	$clsFromDate = new DatePicker("from_date", $from_date, "%m/%d/%Y", 0);
	$clsToDate = new DatePicker("to_date", $to_date, "%m/%d/%Y", 0);
	//################### CHANGE BELOW CODE ###################
	global $orderstatusList; $arrStatusOptions = array();
	foreach ($orderstatusList as $k =>$v){		
		switch($k){
			case 0: 
				$arrStatusOptions[$k] = "<span class='text-secondary'>".$v."</span>"; break;
			case 1:
				$arrStatusOptions[$k] = "<span class='text-warning'>".$v."</span>"; break;
			case 2:
				$arrStatusOptions[$k] = "<span class='text-success'>".$v."</span>"; break;
			default:
				$arrStatusOptions[$k] = "<span>".$v."</span>"; break;
		}
	}
	$baseUrl = "?mod=$mod";
	if ($status!="" && $status>-1){
		//$baseUrl.= "&status=$status";
		$cond.= "status='$status'";
	}
	if ($from_date!=""){		
		//$baseUrl.= "&from_date=$from_date";
		if ($cond!="") $cond.= " AND ";
		$cond.= " order_date>'$from_date'";
	}
	if ($to_date!=""){
		$to_date_full = $to_date + 24*60*60;
		//$baseUrl.= "&to_date=$to_date";
		if ($cond!="") $cond.= " AND ";
		$cond.= " order_date<'$to_date_full'";
	}
	//echo $cond;		
	$arrYesNoOptions = array( 0 => "Chưa", 1 => "<span class='text-success'>Đã trả tiền</span>");
	//init Grid
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL($baseUrl);
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setOrderBy("order_date DESC");
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setTitle($core->getLang("Orders"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("order_code", "Order_code", "width='auto'");
	$clsDataGrid->addColumnMoney("total_cost", "Total_cost", "width='10%' align='center' style='color:red;'");
	$clsDataGrid->addColumnLabel("total_item", "Total_products", "width='10%' align='center'");
	$clsDataGrid->addColumnDate("order_date", "Ordered_date", "width='10%' align='center'", "%H:%M %d/%m/%Y");
	$clsDataGrid->addColumnSelect("payment_method", "Loại TT", "width='10%' align='center' nowrap", $paymentMethodList, 0, 1);
	$clsDataGrid->addColumnSelect("payed", "Thanh toán?", "width='10%' align='center'", $arrYesNoOptions, 0, 1);
	$clsDataGrid->addColumnSelect("status", "Status", "width='5%' align='center' nowrap", $arrStatusOptions, 0, 1);
	//####################### ENG CHANGE ######################
	if ($btnSave!=""){	
		$clsDataGrid->saveData();
		header("location: ?mod=$mod");
	}
	
	$base_url1 = preg_replace("/\&status=(\w*)/e", "", $_SERVER['QUERY_STRING']);
	$assign_list["clsFromDate"] = $clsFromDate;
	$assign_list["clsToDate"] = $clsToDate;
	$assign_list["base_url1"] = "?".$base_url1;
	$assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["status"] = $status;
	$assign_list["arrStatusOptions"] = $arrStatusOptions;
}
ini_set('unserialize_callback_func', 'mycallback'); // set your callback_function

function mycallback($classname) 
{
	require_once DIR_COMMON."/clsCart.php";
}

function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $paymentMethodList, $transportMethodList;
	$classTable = "Orders";
	$clsClassTable = new $classTable; //$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;	
	$clsItem = new Projects();
	// $clsCountry = new Country();
	
	$order_id = GET("order_id",0);
	$btnPayed = POST("btnPayed", "");
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "";
	if ($return=="") $return = "mod=$mod";
	
	// $clsButtonNav->set("TạoHóaĐơn", "/icon/add2.png", "?mod=hoadon&act=add&order_id=$order_id",1);
	$clsButtonNav->set("Save..", "/icon/disks.png", "Save", 1, "save");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete2");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");

	//################### CHANGE BELOW CODE ###################
	global $orderstatusList;								
	$arrStatusOptions = $orderstatusList;	
								
	$btnSave = POST("btnSave", "");
	$btnDelete = POST("btnDelete", "");
	$status = POST("status", "");
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($btnPayed!=""){
		$clsClassTable->updateOne($pvalTable, "payed=1");
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}
	if ($btnSave!=""){
		$status_txt = isset($_POST["status_txt"])? $_POST["status_txt"] : "";
		$admin_note = isset($_POST["admin_note"])? $_POST["admin_note"] : "";
		$set = "status='$status'";
		if ($status==1 || $status==2 || $status==3) $set.= ", payed=1";
		if ($status==0 || $status==4 || $status==5) $set.= ", payed=0";
		$set.= ", status_txt='$status_txt', admin_note='$admin_note'";
		$clsClassTable->updateOne($order_id, $set);
	}
	$arrOneOrder = $clsClassTable->getOneOrder($order_id);
	//Nếu trạng thái là đã giao hàng thành công thì 
	if ($btnSave!="" && $status==2){
		$clsItem->processOrderSuccess($arrOneOrder);
	}
	
	$totalCostReal = $arrOneOrder['total_cost'] - $arrOneOrder['discount'];
	if ($btnDelete=="Delete"){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "order_code", "Order");
		//End RecycleBin
		$clsClassTable->deleteOne($pvalTable);
		header("location: ?mod=$mod&return=$return");
	}	
	//init Form
	$clsForm = new Form();	
	$clsForm->setTitle($core->getLang("Orders"));
	//####################### ENG CHANGE ######################
	$assign_list["status"] = $arrOneOrder['status'];
	$assign_list["status_name"] = $arrStatusOptions[$arrOneOrder['status']];
	$assign_list["clsItem"] = $clsItem;
	$assign_list["arrStatusOptions"] = $arrStatusOptions;
	$assign_list["arrOneOrder"] = $arrOneOrder;
	$assign_list["arrOneOrderInfo"] = $arrOneOrderInfo;		
	$assign_list["arrListPro"] = $arrListPro;		
	$assign_list["totalCostReal"] = $totalCostReal;		
	$assign_list["paymentMethodList"] = $paymentMethodList;		
	$assign_list["transportMethodList"] = $transportMethodList;
	$assign_list["clsForm"] = $clsForm;
}
function default_go(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$clsItem = new Projects();
	$item_id = GET("item_id", 0);
	if ($item_id==0){
		echo "Error ID";		
	}
	$arrOneItem = $clsItem->getOne($item_id);
	redirectURL(url_project($arrOneItem));
	exit();
}

function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Orders";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$clsTable = new $classTable();
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pvalTable!=""){
		//Begin RecycleBin
		$clsRecycleBin = new RecycleBin();
		$clsRecycleBin->AddNew($classTable, $pvalTable, "order_id", "Order");
		//End RecycleBin
		$clsTable->deleteOneOrder($pvalTable);
		
		header("location: ?mod=$mod");
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			//Begin RecycleBin
			$clsRecycleBin = new RecycleBin();
			$clsRecycleBin->AddNew($classTable, $val, "order_id", "Order");
			//End RecycleBin
			$clsTable->deleteOneOrder($val);
		}
		header("location: ?mod=$mod");
	}
	unset($clsTable);
}
?>