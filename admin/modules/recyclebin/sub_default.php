<?
/**
*  Default Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "RecycleBin";
	$clsClassTable = new $classTable;
	//$clsClassTable->SetDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	$clsButtonNav->set("Restore", "/icon/restore.jpg", "Restore", 1, "store");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	$btnRestore = isset($_POST["btnRestore"])? $_POST["btnRestore"] : "";
	$btnDelete = isset($_POST["btnDelete"])? $_POST["btnDelete"] : "";
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if ($btnRestore!=""){
		if (is_array($checkList)){
			foreach ($checkList as $key => $val){
				$clsClassTable->Restore($val);
			}
			header("location: ?mod=recyclebin");
			exit();
		}
	}	
	if ($btnDelete!=""){
		if (is_array($checkList)){
			foreach ($checkList as $key => $val){
				$clsClassTable->RemoveForever($val);
			}
			header("location: ?mod=recyclebin");
			exit();
		}
	}	
	$itemPerPage = 20;
	$page = (isset($_GET["page"]))? $_GET["page"] : 1;
	$totalItem = (isset($_GET["totalItem"]))? $_GET["totalItem"] : 0;
	if ($totalItem==0){
		$totalItem = $clsClassTable->Count();
	}
	$totalPage = ceil($totalItem/$itemPerPage);
	$currenturl = "?mod=$mod&page=$page";
	$nexturl = ($page<$totalPage)? "?mod=$mod&page=".($page+1) : "";
	$prevurl = ($page>1)? "?mod=$mod&page=".($page-1) : "";
	$startInt = ($page-1)*$itemPerPage;
	$arrListItem = $clsClassTable->getAll("1=1 ORDER BY del_date DESC LIMIT $startInt, $itemPerPage");	
	$assign_list["itemPerPage"] = $itemPerPage;
	$assign_list["page"] = $page;
	$assign_list["nexturl"] = $nexturl;
	$assign_list["prevurl"] = $prevurl;
	$assign_list["totalItem"] = $totalItem;
	$assign_list["arrListItem"] = $arrListItem;
	$assign_list["icon_recyclebin"] = $clsClassTable->getIcon($totalItem);
}
/**
*  Default Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_detail(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "RecycleBin";
	$clsClassTable = new $classTable;
	//$clsClassTable->SetDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");
	$id = (isset($_GET["id"]))? $_GET["id"] : 1;
	$arrOneObject = $clsClassTable->getOne($id);
	$objvalue = @unserialize($arrOneObject["objvalue"]);
	$htmlobjvalue = "";
	foreach ($objvalue as $key => $val)
	if (!is_numeric($key)){
$htmlobjvalue.= "<tr>
	<td height='25' class='gridrow'>$key &nbsp;</td>
	<td class='gridrow1'>$val &nbsp;</td>
</tr>";
	}
	$assign_list["objname"] = $arrOneObject['objname'];
	$assign_list["tblpkey"] = $arrOneObject['tblpkey'];
	$assign_list["tblpval"] = $arrOneObject['tblpval'];
	$assign_list["del_date"] = $arrOneObject['del_date'];
	$assign_list["user_name"] = $arrOneObject['user_name'];
	$assign_list["htmlobjvalue"] = $htmlobjvalue;
	$assign_list["icon_recyclebin"] = $clsClassTable->getIcon($totalItem);
}
?>