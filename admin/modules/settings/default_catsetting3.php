<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=catsetting3
 * Display Front End Setting 3 Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_catsetting3(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code, $_max_category_level;
	$classTable = "Settings";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, 1);
	$btnSave = POST("btnSave", "");
	//init Button
	$clsButtonNav->set("Save", "/icon/disks2.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	$arrOptionsPage = array( "0"=> "" );
	makeArrayListPage(0, $arrOptionsPage);
	$arrOptionsCategory = array("0"=>"");
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory);
	$arrOptionsCategoryBV = array("0"=>"");
	makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategoryBV, "ctype=".CTYPE_BV);

	$arrListKey = array("cat_id3"=>1); //"cat_id1"=>1, "cat_id2" => 1, "cat_id3"=>1, "cat_id4" => 1, "cat_id11" => 1, "cat_id21" => 1, "cat_id31" => 1, "cat_id41" => 1,
	foreach ($arrListKey as $key => $val){
		${$key} = POST($key, "");
	}
	if ($btnSave!=""){
		//$cat_id1 = serialize($cat_id1);
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
		//$arr_cat_id1 = @unserialize($cat_id1);
	}

	$clsForm = new Form();
	$clsForm->setTextAreaType("full");
	$clsForm->addInputText("cat_id3[youtube]", $cat_id3['youtube'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputText("cat_id3[rss]", $cat_id3['rss'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputText("cat_id3[twitter]", $cat_id3['twitter'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputText("cat_id3[facebook]", $cat_id3['facebook'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputText("cat_id3[googleplus]", $cat_id3['googleplus'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputText("cat_id3[zalo]", $cat_id3['zalo'], "", 255, 0, "style='width:99%'");
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>