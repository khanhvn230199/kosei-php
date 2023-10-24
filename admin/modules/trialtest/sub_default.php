<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrTemplateOption;
    global $lang_code;
    $classTable = "Trialtest";
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
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    //################### CHANGE BELOW CODE ###################
    //init Grid
    $baseUrl = "?mod=$mod";
    $cond = "lang_code='$lang_code'";
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = getPOST("skeyword", "");
    $assign_list["skeyword"] = $skeyword;
    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setOrderBy("reg_date DESC");
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Thi thử"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='15%'");
    $clsDataGrid->addColumnImage("image", "Image", "width='150px' border=0", "width='10%' align='center'");
    $clsDataGrid->addColumnDate("start_date", "Ngày bắt đầu", "width='5%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnDate("end_date", "Ngày kết thúc", "width='5%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='5%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
    $clsDataGrid->addColumnUrl($pkeyTable, "Quản lý đề thi", "width='3%' align='center' nowrap", "<a href='?mod=test&tt_id=%1%&$returnExp' class='abutton1'>Quản lý đề thi &raquo;</a>");
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        $query = $_SERVER['QUERY_STRING'];
        header("location: ?$query");
        exit();
    }
    $base_url1 = preg_replace("/\&skeyword=(\w*)/i", "", $_SERVER['QUERY_STRING']);
    $base_url1 = preg_replace("/\&sskillid=(\w*)/i", "", $base_url1);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $arrTemplateOption;
    $classTable = "Trialtest";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = GET($pkeyTable, "");
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    $modeInt = 0;
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "savecontinue");
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    if ($mode == "Edit") {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
        $modeInt = 1;
        $arrCurExam = $clsClassTable->getOne($pvalTable);
    } else {
        $arrCurExam = array();
        $arrCurExam['slug'] = "";
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrOptionsLevel = array('' => "- Trình độ -");
    makeArrayListLevel($arrOptionsLevel);
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Thi thử"));
    $clsForm->setTextAreaType("full");
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:40%' onblur='ajax_get_trialtest_slug($modeInt)'");
    $clsForm->addInputText("slug", "", "Slug URL", 255, 1, "style='width:300px; color:#666666' onchange='ajax_check_trialtest_slug($modeInt)'");
    $clsForm->addInputFile("image", "", "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");
    $clsForm->addInputTextArea("des", "", "Description", 9999999999, 0, 0, 1, "style='width:100%; height:150px'", "SMALL");
    $clsForm->addInputDate("start_date", "", "Ngày bắt đầu", "%d/%m/%Y %H:%M", 1, 0);
    $clsForm->addInputDate("end_date", "", "Ngày kết thúc", "%d/%m/%Y %H:%M", 1, 0);
    $clsForm->addAttachInput("start_date", "end_date");
    $clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputHidden("reg_date", time());
    if ($mode == "New") {
        $clsForm->addInputHidden("lang_code", $lang_code);
    }
    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        $slug = $_POST["slug"];
        if ($slug == "") {
            $exists = $clsClassTable->isExistsSlug($slug, $arrCurExam['slug']);
            if ($exists) {
                $slug .= intval($exists) + 1;
            } else {
                $_POST['slug'] = utf8_nosign_noblank($_POST["name"]);
            }
        }
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                if ($mode == "Edit" && $btnSave == "SaveContinue") $return = $_SERVER['QUERY_STRING'];
                header("location: ?$return");
                exit();
            }
        }
    }
    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Trialtest";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_Trialtest_template = $core->getLangArray($_arr_Trialtest_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Trialtest");
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
            $clsRecycleBin->AddNew($classTable, $val, "name", "Trialtest");
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
    $core->_Clone("Trialtest");
}

?>