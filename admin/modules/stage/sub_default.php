<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrTemplateOption, $_max_category_level;
    global $lang_code;
    $classTable = "Stage";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $rowsPerPage = 20;
    $parent_id = GET("parent_id", 0);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$parent_id&$returnExp", 1);
    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone", "$mod,$returnExp");
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Sửa", 1, "confirmEdit");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "Xóa", 1, "confirmDelete");
    if ($parent_id != 0) {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    } else {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    }
    $arrParent = array();
    if ($parent_id > 0) {
        $arrParent = $clsClassTable->getOne($parent_id);
    }
    //################### CHANGE BELOW CODE ###################
    $arrOptionCourse = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    //init Grid
    $arrOptionStage = array("0" => "- Root Level -");
    makeArrayListStage(0, 0, MAX_LEVEL_CATEGORY, $arrOptionStage, '');
    $cond = "lang_code='$lang_code' AND parent_id=$parent_id";
    $baseUrl = "?mod=$mod";
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = getPOST("skeyword", "");
    $scatid = getPOST("scatid", "");
    $scatid_options = "";
    if (is_array($arrOptionCourse))
        foreach ($arrOptionCourse as $k => $v) {
            $selected = ($k == $scatid) ? "selected" : "";
            $scatid_options .= "<option value='$k' $selected >$v</option>";
        }
    if ($skeyword != "") {
        $cond .= " AND (name LIKE '%$skeyword%' OR slug LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&skeyword=$skeyword";
    }
    if ($scatid != "" && $scatid != "0") {
        $strcatid = $clsCategory->getAllCatStr($scatid) . "$scatid";
        $cond .= " AND cat_id in ($strcatid)";
        $baseUrl = preg_replace("/\&scatid=(\w+)/", "", $baseUrl);
        $baseUrl .= "&scatid=$scatid";
    }
    $assign_list["skeyword"] = $skeyword;
    $assign_list["scatid_options"] = $scatid_options;
    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setOrderBy("order_no ASC, reg_date DESC");
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Stage"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='auto'");
    $clsDataGrid->addColumnLabel("slug", "Slug", "width='20%'");
    $clsDataGrid->addColumnImage("image", "Image", "max-width='100px' border=0", "width='10%' align='center'");
    if ($parent_id == 0) {
        $clsDataGrid->addColumnSelect("cat_id", "Course", "width='15%' align='center'", $arrOptionCourse);
    } else {
        $clsDataGrid->addColumnSelect("cat_id", "Course", "width='15%' align='center'", $arrOptionCourse, 0, 1);
    }
    $clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='10%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center'");
    $clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
    if ($parent_id == 0) {
        $clsDataGrid->addColumnUrl($pkeyTable, "Options", "width='3%' align='center' nowrap", "<a href='?mod=$mod&parent_id=%1%&$returnExp' class='abutton1'>" . $core->getLang('Child_stage') . " &raquo;</a>");
    }
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        $query = $_SERVER['QUERY_STRING'];
        header("location: ?$query");
        exit();
    }
    $base_url1 = preg_replace("/\&skeyword=(\w*)/i", "", $_SERVER['QUERY_STRING']);
    $base_url1 = preg_replace("/\&scatid=(\w*)/i", "", $base_url1);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
    $assign_list["arrParent"] = $arrParent;
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $arrTemplateOption, $_max_category_level;
    $classTable = "Stage";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $parent_id = GET("parent_id", 0);
    $pvalTable = GET($pkeyTable, "");
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "savecontinue");
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    if ($mode == "Edit") {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrParent = array();
    if ($parent_id > 0) {
        $arrParent = $clsClassTable->getOne($parent_id);
    }
    $arrOptionCourse = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Stage"));
    $clsForm->setTextAreaType("full");
    if ($parent_id == 0) {
        $clsForm->addInputSelect("cat_id", "", "Course", $arrOptionCourse, 0, "style='font-size:12px'");
    }
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%' onblur='getSlug(this, \"slug\");'");
    $clsForm->addInputText("slug", "", "Slug", 255, 0, "style='width:99%' maxlength='50'");
    $clsForm->addInputFile("image", "", "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");
    $clsForm->addInputTextArea("des", "", "SAPO", 9999999999, 0, 0, 1, "style='width:100%; height:150px'", "SMALL");
    $clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:60px'");
    $clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputText("page_title", "", "[SEOmoz] PageTitle", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_keywords", "", "[SEOmoz] MetaKeywords", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_des", "", "[SEOmoz] MetaDescription", 255, 1, "style='width:99%'");
    $clsForm->addInputHidden("reg_date", time());
    if ($mode == "New") {
        if ($parent_id > 0) {
            $clsForm->addInputHidden('cat_id', $arrParent['cat_id']);
        }
        $clsForm->addInputHidden('parent_id', $parent_id);
        $clsForm->addInputHidden("lang_code", $lang_code);
    }
    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        if ($mode == "Edit" && $pvalTable == $_POST["parent_id"]) {
            $_POST["parent_id"] = 0;
        }
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                if ($mode == "Edit" && $btnSave == "SaveContinue") $return = $_SERVER['QUERY_STRING'];
                header("location: ?$return");
                exit();
            }
        }
    }
    $assign_list["arrParent"] = $arrParent;
    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Stage";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_Stage_template = $core->getLangArray($_arr_Stage_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Stage");
        //End RecycleBin
        $clsClassTable->deleteOne($pvalTable);
        header("location: ?$return");
        exit();
    }
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        foreach ($checkList as $key => $val) {
            //Begin RecycleBin
            $clsRecycleBin = new RecycleBin();
            $clsRecycleBin->AddNew($classTable, $val, "name", "Stage");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    }
    unset($clsClassTable);
}

//gọi function clone
function default_clone()
{
    global $core;
    $core->_Clone("Stage");
}

?>