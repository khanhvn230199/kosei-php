<?
/**
*  Default Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_default(){
	global $assign_list, $_CONFIG, $smarty;
	
	if (isset($_GET["clearCache"]) && $_GET["clearCache"]==1){
		// clear out all cache files
		$smarty->cache_dir = VNCMS_DIR."/cache";
		$smarty->clear_all_cache();		
	}
	
	/* $clsProvince = new Province();
	$arrTmp = $clsProvince->getAll();
	foreach ($arrTmp as $key => $val){
		$name_en = utf8_nosign($val['name']);
		$set = "name_en='$name_en'";
		$clsProvince->updateOne($val['province_id'], $set);
	} */
}
/**
*  License Action
*  @author		: Tran Anh Tuan ()
*  @date		: 2007/04/01
*  @version		: 1.0.0
*/
function default_license(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	if (!$core->isSuper() || !$core->isRoot()){
		showErrorWarningBox();
		die();
		exit();
	}
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");		
	if ($btnSave!="" && $_POST["newkey"]!=""){
		$newkey = br2nl($_POST["newkey"]);
		@save_file(VNCMS_DIR."/license.dat", $newkey);
		header("location: ?act=license");
	}
	$license_status = $core->validLicense();
	$currentkey = @read_file(VNCMS_DIR."/license.dat");	
	$assign_list["currentkey"] = $currentkey;
	$assign_list["license_status"] = $license_status;
}
?>