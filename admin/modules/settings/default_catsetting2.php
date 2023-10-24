<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=catsetting2
 * Display Front End 2 Setting Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_catsetting2(){
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

	$arrListKey = array("payment_terms" => 0, "list_banks" => 1);
	/* foreach ($arrListKey as $key => $val){
		${$key} = POST($key, "");
	} */
	$list_banks_0 = br2nl(POST("list_banks_0", ""));
	$list_banks_1 = br2nl(POST("list_banks_1", ""));
	$list_banks_2 = br2nl(POST("list_banks_2", ""));
	$payment_terms = br2nl(POST("payment_terms", ""));
	$_POST["list_banks"] = $list_banks = array($list_banks_0, $list_banks_1, $list_banks_2);
	
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
	$clsForm->addInputTextArea("payment_terms", $payment_terms, "", 1000, 10, 5, 1,  "style='width:99%; height:300px'", "SMALL");
	$clsForm->addInputTextArea("list_banks_0", $list_banks[0], "", 1000, 10, 5, 1,  "style='width:99%; height:200px'", "SMALL");
	$clsForm->addInputTextArea("list_banks_1", $list_banks[1], "", 1000, 10, 5, 1,  "style='width:99%; height:200px'", "SMALL");
	$clsForm->addInputTextArea("list_banks_2", $list_banks[2], "", 1000, 10, 5, 1,  "style='width:99%; height:200px'", "SMALL");

	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>