<?
/**
*  Default Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_default(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $default_permiss_array, $default_permiss_key, $default_permiss_name;
	$classTable = "User";
	$clsClassTable = new $classTable;
	//$clsClassTable->SetDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$pvalTable = isset($_POST["user_id"])? $_POST["user_id"] : "";
	if ($pvalTable=="")
		$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	$user_id = $pvalTable;
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save..", "/icon/disks.png", "Save", 1, "save");
	if ($_GET[$pkeyTable]!=""){
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=adminmanager&act=add&user_id=".$_GET[$pkeyTable]);	
	}else{
		$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	}
	//################### CHANGE BELOW CODE ###################
	if ($core->isSuper() && $pvalTable==$core->_USER['user_id']){
		header("location: ?mod=$mod");
		exit();
	}

	$clsUser = new User();
	$cond = "user_id!=1";
	if ($core->isSuper() && $core->_USER['user_id']!=1){
		$cond .= " && user_id!='".$core->_USER['user_id']."'";
	}
	$arrListUser = $clsUser->getAll($cond);
	if ($user_id==""){
		$user_id = $arrListUser[0]["user_id"];
	}
	$arrOptionsUser = array();
	$permiss_str = "";
	if (is_array($arrListUser))
	foreach ($arrListUser as $key => $val)
	if ($val["user_group_id"]=='6'){
		$arrOptionsUser[$val["user_id"]] = $val["user_name"]."/".$val["fullname"];
		if ($val["user_id"]==$user_id){
			$permiss_str = $val["admin_permiss"];
		}
	}
	$permiss_array = @unserialize($permiss_str);
	if (is_array($permiss_array)){
	
	}else{
		$permiss_array = $default_permiss_array;
	}
	//print_r($permiss_array);
	//init Form
	$arrPositionOptions = array("L"=>"LEFT", "R"=>"RIGHT", "B"=>"BOTTOM", "T"=>"TOP");
	$arrYesNoOptions = array("NO", "YES");
	$arrGenderOptions = array("Male", "Female");
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("AdminPermission"));
	$clsForm->addInputSelect("user_id", $user_id, "Admin Name", $arrOptionsUser, 0, "style='font-size:10px' onChange='document.theForm.submit()'");
	 
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		$new_permiss_array = $_POST["permiss_array"];
		foreach ($default_permiss_key as $k => $v){
			if ($new_permiss_array[$v]==1){
				$permiss_array[$v] = 1;
			}else{
				$permiss_array[$v] = 0;
			}
		}
		$admin_permiss = @serialize($permiss_array);
		$clsUser->updateOne($user_id, "admin_permiss='$admin_permiss'");
		if ($_GET[$pkeyTable]!=""){
			header("location: ?mod=adminmanager&act=add&user_id=".$_GET[$pkeyTable]);
		}
	}

	$assign_list["default_permiss_key"] = $default_permiss_key;
	$assign_list["default_permiss_name"] = $default_permiss_name;
	$assign_list["permiss_array"] = $permiss_array;
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}

?>