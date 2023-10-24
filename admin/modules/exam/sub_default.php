<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrTemplateOption, $_max_category_level;
    global $lang_code;
    $classTable = "Exam";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $rowsPerPage = 20;
    $test_id = GET("test_id", 0);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");
    if ($test_id > 0) {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&test_id=$test_id&$returnExp", 1);
    } else {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp", 1);
    }
    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone", "$mod,$returnExp");
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Sửa", 1, "confirmEdit");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "Xóa", 1, "confirmDelete");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrOptionCourse = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    $arrOptionSkills = array();
    makeArrayListSkills($arrOptionSkills);
    //init Grid
    $baseUrl = "?mod=$mod";
    $cond = "lang_code='$lang_code'";
    if ($test_id > 0) {
        $cond .= " AND test_id=$test_id AND cat_id=0";
        $baseUrl .= "&test_id=$test_id";
    } else {
        $cond .= "AND cat_id != 0 AND test_id=0";
    }
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = getPOST("skeyword", "");
    $scatid = getPOST("scatid", "");
    $sskillsid = getPOST("sskillsid", "");
    $scatid_options = "";
    $sskillsid_options = "";
    if (is_array($arrOptionCourse))
        foreach ($arrOptionCourse as $k => $v) {
            $selected = ($k == $scatid) ? "selected" : "";
            $scatid_options .= "<option value='$k' $selected >$v</option>";
        }
    if (is_array($arrOptionSkills))
        foreach ($arrOptionSkills as $k => $v) {
            $selected = ($k == $sskillsid) ? "selected" : "";
            $sskillsid_options .= "<option value='$k' $selected >$v</option>";
        }
    if ($skeyword != "") {
        $cond .= " AND (name LIKE '%$skeyword%' OR slug LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&skeyword=$skeyword";
    }
    if ($scatid != "" && $scatid != "0") {
        $strcatid = $clsCategory->getAllCatStr($scatid) . "$scatid";
        $cond .= " AND cat_id in ($strcatid)";
        $baseUrl = preg_replace("/\&scatid=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&scatid=$scatid";
    }
    if ($sskillsid != "" && $sskillsid != "0") {
        $strcatid = $clsCategory->getAllCatStr($sskillsid) . "$sskillsid";
        $cond .= " AND skill_id in ($strcatid)";
        $baseUrl = preg_replace("/\&sskillsid=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&sskillsid=$sskillsid";
    }
    $assign_list["skeyword"] = $skeyword;
    $assign_list["scatid_options"] = $scatid_options;
    $assign_list["sskillsid_options"] = $sskillsid_options;
    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    if ($test_id > 0) {
        $clsDataGrid->setOrderBy("exam_id ASC");
    }else{
        $clsDataGrid->setOrderBy("reg_date DESC");
    }
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Exam"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='20%'");
    if ($test_id == 0) {
        $clsDataGrid->addColumnSelect("cat_id", "Course", "width='5%' align='center'", $arrOptionCourse, "", 1);
    }
    $clsDataGrid->addColumnSelect("skill_id", "Skills", "width='5%' align='center'", $arrOptionSkills, "", 1);
    $clsDataGrid->addColumnLabel("des", "Description", "width='20%'");
    $clsDataGrid->addColumnLabel("time_end", "Thời gian thi (phút)", "width='auto'");
    $clsDataGrid->addColumnLabel("pass_score", "Điểm đạt tối thiểu", "width='auto'");
    $clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%' align='center'");
    $clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='10%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
    if ($test_id == 0) {
        $clsDataGrid->addColumnUrl($pkeyTable, "Quản lý câu hỏi", "width='3%' align='center' nowrap", "<a href='?mod=questions&exam_id=%1%&$returnExp' class='abutton1'>Danh sách câu hỏi &raquo;</a>");
        $clsDataGrid->addColumnUrl($pkeyTable, "Xem trước", "width='3%' align='center' nowrap", "<a target='_blank' href='" . VNCMS_URL . "/exams/preview-e%1%' class='abutton1'><img src='" . ADMIN_URL_IMAGES . "/preview_on.gif' align='left'></a>");
    }else{
        $clsDataGrid->addColumnUrl($pkeyTable, "Quản lý câu hỏi", "width='3%' align='center' nowrap", "<a href='?mod=questions&exam_id=%1%&test_id=$test_id&$returnExp' class='abutton1'>Danh sách câu hỏi &raquo;</a>");
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
    $base_url1 = preg_replace("/\&sskillid=(\w*)/i", "", $base_url1);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $arrTemplateOption, $_max_category_level;
    $classTable = "Exam";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsTrialTest = new TrialTest();

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
    $test_id = GET("test_id", 0);
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
    $arrOptionCourse = array('' => 'Chọn Khoá học');
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    $arrOptionSkills = array('' => 'Chọn Skill');
    makeArrayListSkills($arrOptionSkills);
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Exam"));
    $clsForm->setTextAreaType("full");
    if ($test_id > 0) {
        $clsForm->addInputHidden('test_id', $test_id);
    } else {
        $clsForm->addInputSelect("cat_id", "", "Course", $arrOptionCourse, 0, "style='font-size:12px'", 0);
    }
    $clsForm->addInputSelect("skill_id", "", "Skills", $arrOptionSkills, 0, "style='font-size:12px'", 0);
    $clsForm->addAttachInput("cat_id", "skill_id");
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%' onblur='ajax_get_exam_slug($modeInt)'");
    $clsForm->addInputText("slug", "", "Slug URL", 255, 1, "style='width:300px; color:#666666' onchange='ajax_check_exam_slug($modeInt)'");
//    $clsForm->addInputFile("attachment", "", "Tập tin đính kèm<br>Định dạng <b>.mp3 hoặc .mp4.</b>", "mp3,mp4", 1, "style='width:300px'");
//    $clsForm->addInputText("video_id", "", "Youtube Video ID<br>vd: https://www.youtube.com/watch?v=<b>ycGfvA1vkR8</b>", 255, 1, "style='width:23%' placeholder='ycGfvA1vkR8'");
    $clsForm->addInputTextArea("des", "", "Description", 9999999999, 0, 0, 1, "style='width:100%; height:150px'", "SMALL");
    $clsForm->addInputNumber("time_end", "", "Thời gian thi (phút)", 255, 1, "style='width:99%' placeholder='20'");
    $clsForm->addInputNumber("pass_score", "", "Điểm đạt tối thiểu", 255, 0, "style='width:99%' placeholder='20'");
    $clsForm->addInputText("order_no", "99999", "OrderNo", 5, 0, "style='width:60px'");
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
    $classTable = "Exam";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Exam");
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
            $clsRecycleBin->AddNew($classTable, $val, "name", "Exam");
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
    $core->_Clone("Exam");
}

?>