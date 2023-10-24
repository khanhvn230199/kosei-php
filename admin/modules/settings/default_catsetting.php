<?php 
/**
 * Module: [settings]
 * Home function with $sub=default, $act=catsetting
 * Display Front End Setting Page
 *
 * @param 				: no params
 * @return 				: no need return
 * @exception
 * @throws
 */
function default_catsetting(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $lang_code, $_max_category_level, $arrYesNoOptions;
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

	$arrListKey = array("home_section1"=>1, "home_section2"=>1, "home_section3"=>1, "home_section4"=>1, "home_section5"=>1, "home_section6"=>1,
			"footer_widget1"=>1, "footer_widget2"=>1, "footer_widget3"=>1, "home_cache" => 0
	);
	/* $footer_widget1_content = POST("footer_widget1_content", "");
	 $_POST["footer_widget1"]['content'] = br2nl($footer_widget1_content);

	 $home_section5_map = POST("home_section5_map", "");
	$_POST["home_section5"]['map'] = br2nl($home_section5_map); */
	for ($i=1; $i<=5; $i++){
		$_POST["home_section1"]["content".$i] = br2nl(POST("home_section1_content".$i, ""));
	}

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
	$clsForm->setTextAreaType("none");
	$clsForm->addInputSelect("home_cache", $home_cache, "Label", $arrYesNoOptions, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section1[title]", $home_section1['title'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputText("home_section1[button]", $home_section1['button'], "Label", 255, 0, "style='width:99%'");
	//$clsForm->addInputText("home_section1[blink]", $home_section1['blink'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section1[blink]", $home_section1['blink'], "Label", $arrOptionsPage, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section1[title1]", $home_section1['title1'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section1[cat_id1]", $home_section1['cat_id1'], "Label", $arrOptionsCategoryBV, 0, "style='font-size:12px;'");

	$clsForm->addInputText("home_section1[tab1]", $home_section1['tab1'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputText("home_section1[tab2]", $home_section1['tab2'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputText("home_section1[tab3]", $home_section1['tab3'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputText("home_section1[tab4]", $home_section1['tab4'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputText("home_section1[tab5]", $home_section1['tab5'], "Label", 255, 0, "style='width:99%'");
	$clsForm->addInputTextArea("home_section1_content1", $home_section1['content1'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");
	$clsForm->addInputTextArea("home_section1_content2", $home_section1['content2'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");
	$clsForm->addInputTextArea("home_section1_content3", $home_section1['content3'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");
	$clsForm->addInputTextArea("home_section1_content4", $home_section1['content4'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");
	$clsForm->addInputTextArea("home_section1_content5", $home_section1['content5'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");


	$clsForm->addInputText("home_section2[title]", $home_section2['title'], "LabelLabel", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section2[cat_id]", $home_section2['cat_id'], "Label", $arrOptionsCategoryCN, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section2[title1]", $home_section2['title1'], "LabelLabel", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section2[cat_id1]", $home_section2['cat_id1'], "Label", $arrOptionsCategoryCN, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section2[title2]", $home_section2['title2'], "LabelLabel", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section2[cat_id2]", $home_section2['cat_id2'], "Label", $arrOptionsCategoryCN, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section2[title3]", $home_section2['title3'], "LabelLabel", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section2[cat_id3]", $home_section2['cat_id3'], "Label", $arrOptionsCategoryCN, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section2[title4]", $home_section2['title4'], "LabelLabel", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section2[cat_id4]", $home_section2['cat_id4'], "Label", $arrOptionsCategoryCN, 0, "style='font-size:12px;'");

	$clsForm->addInputText("home_section3[title]", $home_section3['title'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section3[cat_id]", $home_section3['cat_id'], "Label", $arrOptionsCategoryDA, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section3[title1]", $home_section3['title1'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section3[cat_id1]", $home_section3['cat_id1'], "Label", $arrOptionsCategoryDA, 0, "style='font-size:12px;'");
	$clsForm->addInputText("home_section3[title2]", $home_section3['title2'], "", 255, 0, "style='width:99%'");
	$clsForm->addInputSelect("home_section3[cat_id2]", $home_section3['cat_id2'], "Label", $arrOptionsCategoryDA, 0, "style='font-size:12px;'");
	$clsForm->addInputSelect("home_section3[blink]", $home_section3['blink'], "Label", $arrOptionsPage, 0, "style='font-size:12px;'");

	/* $clsForm->addInputText("home_section4[title]", $home_section4['title'], "Label", 255, 0, "style='width:99%'");
	 $clsForm->addInputText("home_section4[sub_title]", $home_section4['sub_title'], "Label", 255, 0, "style='width:99%'");
	 $clsForm->addInputSelect("home_section4[cat_id]", $home_section4['cat_id'], "Label", $arrOptionsCategory, 0, "style='font-size:12px;'");
	 $clsForm->addInputText("home_section4[limit]", $home_section4['limit'], "Label", 255, 0, "style='width:99%'");

	$clsForm->addInputTextArea("home_section5_map", $home_section5['map'], "", 1000, 10, 5, 1,  "style='width:99%; height:100px'", "none"); */

	/*
	 $clsForm->addInputText("home_section5[title]", $home_section5['title'], "Label", 255, 0, "style='width:99%'");
	 $clsForm->addInputSelect("home_section5[cat_id]", $home_section5['cat_id'], "Label", $arrOptionsCategory, 0, "style='font-size:12px;'");

	 $clsForm->addInputText("home_section6[title]", $home_section6['title'], "Label", 255, 0, "style='width:99%'");
	 $clsForm->addInputMSelect("home_section6[list_cat_id]", $home_section6['list_cat_id'], "Label", $arrOptionsCategory, 0, "style='font-size:12px; height:100px'");

	 $clsForm->addInputText("footer_widget1[title]", $footer_widget1['title'], "", 255, 0, "style='width:99%'");
	 $clsForm->addInputTextArea("footer_widget1_content", $footer_widget1['content'], "", 1000, 10, 5, 1,  "style='width:100%; height:100px'", "SMALL");
	 $clsForm->addInputText("footer_widget1[link]", $footer_widget1['link'], "", 255, 0, "style='width:99%'");

	 $clsForm->addInputText("footer_widget2[title]", $footer_widget2['title'], "", 255, 0, "style='width:99%'");

	 $clsForm->addInputText("footer_widget3[title]", $footer_widget3['title'], "", 255, 0, "style='width:99%'");
	 $clsForm->addInputTextArea("footer_widget3_map", $footer_widget3['map'], "", 1000, 10, 5, 1,  "style='width:99%; height:100px'", "none");
	*/
	//####################### ENG CHANGE ######################
	foreach ($arrListKey as $key => $val){
		$assign_list[$key] = ${$key};
	}
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}
?>