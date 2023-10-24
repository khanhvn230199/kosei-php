<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=lanugage
 * Display Manage Language Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_language(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : 1;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	$cur_lang_code = $_CONFIG['language_id'];
	//init Button
	$clsForm = new Form();
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	$arrListKey = array("language_id");

	$clsLanguage = new Language();
	$arrListLanguage1 = $clsLanguage->getAll("1=1 ORDER BY lang_code");
	if (is_array($arrListLanguage1))
		foreach ($arrListLanguage1 as $key => $val){
		$arrListLanguage[$val['lang_id']] = $val['name']." [".$val['lang_code'].":".$val['charset']."]";
		if (isset($_POST['language_id']) && ($val['lang_id']==$_POST['language_id'])){
			$language_id = $val['lang_code'];
		}
		if ($val['lang_code']==$cur_lang_code){
			$language_id_default = $val['lang_id'];
		}
	}

	if ($btnSave!=""){
		foreach ($arrListKey as $key => $val){
			$clsClassTable->setValue($val, ${$val});
		}
		header("location: ?mod=$mod&act=$act");
	}
	$language_id_arr = array("colname"=>"language_id", "value"=>$language_id_default, "coltitle"=>"", "coltype"=>"select", "attr"=>"style=''", "arrOptions" => $arrListLanguage);
	$language_id_html = $clsForm->showInputSelect($language_id_arr);

	foreach ($arrListKey as $key => $val){
		$assign_list[$val] = ${$val};
	}
	$assign_list["language_id_html"] = $language_id_html;
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>