<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=seosetting
 * Display Seo Setting Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_seosetting(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : 1;
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	//init Button
	$clsForm = new Form();
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$arrListKey = array("site_title" => 0, "site_description"=>0, "meta_keywords"=>0, "enable_urlrewrite"=>0, "seo_configs"=>1);

	foreach ($arrListKey as $key => $val){
		${$key} = POST($key, "");
	}
	if ($btnSave!=""){
		foreach ($arrListKey as $key => $val){
			$v = ${$key};
			if ($val==1 && is_array($v)){//if is array
				$v = serialize($v);
			}
			$clsClassTable->setValue($key, $v, $lang_code);
		}
		header("location: ?mod=$mod&act=$act");
		exit();
	}else{
		foreach ($arrListKey as $key => $val){
			$v = $clsClassTable->getValue($key, $lang_code);

			if ($val==1){//if is array
				$v = @unserialize($v);
			}
			${$key} = $v;
		}
	}

	$clsForm = new Form();
	$clsForm->setTextAreaType("none");
	$clsForm->addInputText("site_title", $site_title, "", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("enable_urlrewrite", $enable_urlrewrite, "Label", $arrYesNoOptions, 0, "style='font-size:12px;'");
	$clsForm->addInputTextArea("site_description", $site_description, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:100px' onkeypress='return noAcceptEnter(event);'");
	$clsForm->addInputTextArea("meta_keywords", $meta_keywords, "Label", 9999999999, 10, 5, 1,  "style='width:98%;height:60px' onkeypress='return noAcceptEnter(event);'");
	$clsForm->addInputSelect("seo_configs[allow_append]", $seo_configs['allow_append'], "Label", $arrYesNoOptions, 0, "style='font-size:12px;'");
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>