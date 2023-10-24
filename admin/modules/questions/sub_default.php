<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrTemplateOption, $_max_category_level, $arrTestOptions;
    global $lang_code;
    $classTable = "Questions";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $rowsPerPage = 20;
    $parent_id = GET("parent_id", 0);
    $exam_id = GET("exam_id", 0);
    $test_id = GET("test_id", 0);
    $lesson_id = GET("lesson_id", 0);
    $cat_id = GET("cat_id", 0);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    //count level
    $level = $clsClassTable->cur_level($parent_id);
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");
    if ($lesson_id != 0) {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&lesson_id=$lesson_id&parent_id=$parent_id&$returnExp", 1);
    } elseif ($exam_id != 0) {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&exam_id=$exam_id&parent_id=$parent_id&$returnExp", 1);
    } else {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&cat_id=$cat_id&parent_id=$parent_id&$returnExp", 1);
    }

    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone", "$mod,$returnExp");
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Sửa", 1, "confirmEdit");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "Xóa", 1, "confirmDelete");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrOptionExam = array();
    makeArrayListExam($arrOptionExam);
    //init Grid
    $baseUrl = "?mod=$mod";
    if ($exam_id > 0) {
        $baseUrl .= "&exam_id=$exam_id";
    }
    if ($parent_id > 0) {
        $baseUrl .= "&parent_id=$parent_id";
    }
    if ($lesson_id > 0) {
        $baseUrl .= "&lesson_id=$lesson_id";
    }
    if ($cat_id > 0) {
        $baseUrl .= "&cat_id=$lesson_id";
    }
    $cond = "lang_code='$lang_code' AND parent_id=$parent_id";
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = getPOST("skeyword", "");
    if ($skeyword != "") {
        $cond .= " AND (name LIKE '%$skeyword%' OR slug LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&skeyword=$skeyword";
    }
    if ($lesson_id != 0) {
        $cond .= " AND lesson_id = $lesson_id";
    }
    if ($exam_id != 0) {
        $cond .= " AND exam_id = $exam_id";
    }
    if ($cat_id != 0) {
        $cond .= " AND cat_id = $cat_id";
    }
    $assign_list["skeyword"] = $skeyword;
    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setOrderBy("questions_id ASC");
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Questions"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='20%'");
    $clsDataGrid->addColumnLabel("point", "Point", "width='20%'");
    if ($level == 1) {
        $clsDataGrid->addColumnLabel("question_limit", "Giới hạn câu hỏi", "width='20%'");
    }
    $clsDataGrid->addColumnLabel("question", "Question", "width='auto'");
    $clsDataGrid->addColumnLabel("translate", "Translate", "width='auto'");
    if ($lesson_id == 0) {
        $clsDataGrid->addColumnSelect("exam_id", "Exam", "width='5%' align='center'", $arrOptionExam, "", 1);
    }
    if ($test_id > 0) {
        $clsDataGrid->addColumnSelect("ctype", "Câu hỏi", "width='5%' align='center'", $arrTestOptions, "", 1);
    }
    $clsDataGrid->addColumnDate("reg_date", "AddedDate", "width='10%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnSelect("is_online", "Display?", "width='2%' align='center'", $arrYesNoOptions);
    if ($level < 3) {
        if ($exam_id != 0) {
            if ($test_id > 0) {
                $clsDataGrid->addColumnUrl($pkeyTable, "Nhóm câu hỏi nhỏ", "width='3%' align='center' nowrap", "<a href='?mod=$mod&exam_id=$exam_id&test_id=$test_id&parent_id=%1%&$returnExp' class='abutton1'>" . $core->getLang('Quản lý câu hỏi nhỏ') . " &raquo;</a>");
            } else {
                $clsDataGrid->addColumnUrl($pkeyTable, "Nhóm câu hỏi nhỏ", "width='3%' align='center' nowrap", "<a href='?mod=$mod&exam_id=$exam_id&parent_id=%1%&$returnExp' class='abutton1'>" . $core->getLang('Quản lý câu hỏi nhỏ') . " &raquo;</a>");
            }
        } else {
            $clsDataGrid->addColumnUrl($pkeyTable, "Nhóm câu hỏi nhỏ", "width='3%' align='center' nowrap", "<a href='?mod=$mod&lesson_id=$lesson_id&parent_id=%1%&$returnExp' class='abutton1'>" . $core->getLang('Quản lý câu hỏi nhỏ') . " &raquo;</a>");
        }
    }
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        $query = $_SERVER['QUERY_STRING'];
        header("location: ?$query");
        exit();
    }
    $base_url1 = preg_replace("/\&skeyword=(\w*)/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $arrTemplateOption, $_max_category_level, $arrTestOptions;
    $classTable = "Questions";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = GET($pkeyTable, "");
    $parent_id = GET("parent_id", 0);
    $exam_id = GET("exam_id", 0);
    $lesson_id = GET("lesson_id", 0);
    $cat_id = GET("cat_id", 0);
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    //count level
    $level = $clsClassTable->cur_level($parent_id);
    //init Button
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    if ($mode == "Edit") {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Questions"));
    $clsForm->setTextAreaType("SMALL");
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:100%'");
    $clsForm->addInputSelect("ctype", "", 'Loại câu hỏi', $arrTestOptions);
    if ($level == 3) {
        $clsForm->addInputText("point", "", "Point", 255, 1, "style='width:100%'");
    } else {
        $clsForm->addInputText("point", "", "Point", 255, 0, "style='width:100%'");
        if ($level == 1) {
            $clsForm->addInputText("question_limit", "", "Giới hạn câu hỏi", 255, 0, "style='width:100%'");
        }
    }
    if ($lesson_id != 0) {
        if ($parent_id == 0) {
            $clsForm->addInputFile("attachment", "", "Tập tin đính kèm<br>Định dạng <b>.mp3</b>", "mp3,wma", 1, "style='width:300px'");
        }
    } else {
        $clsForm->addInputFile("attachment", "", "Tập tin đính kèm<br>Định dạng <b>.mp3</b>", "mp3,wma", 1, "style='width:300px'");
    }
    $clsForm->addInputTextArea("question", "", "Question", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    $clsForm->addInputTextArea("translate", "", "Dịch nghĩa", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    $clsForm->addInputTextArea("answer_a", "", "Đáp án A", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    $clsForm->addInputTextArea("answer_b", "", "Đáp án B", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    $clsForm->addInputTextArea("answer_c", "", "Đáp án C", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    $clsForm->addInputTextArea("answer_d", "", "Đáp án D", 9999999999, 0, 0, 1, "style='width:100%; height:150px'");
    if ($level == 3) {
        $clsForm->addInputText("correct_answer", "", "Đáp án đúng", 255, 0, "style='width:100%' placeholder='A'");
    } else {
        $clsForm->addInputText("correct_answer", "", "Đáp án đúng", 255, 1, "style='width:100%' placeholder='A'");
    }
    $clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputHidden("reg_date", time());
    if ($mode == "New") {
        if ($lesson_id != 0) {
            $clsForm->addInputHidden("lesson_id", $lesson_id);
        } elseif ($exam_id != 0) {
            $clsForm->addInputHidden('exam_id', $exam_id);
        } else {
            $clsForm->addInputHidden('cat_id', $cat_id);
        }
        $clsForm->addInputHidden("parent_id", $parent_id);
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
                if ($mode == "Edit" && $btnSave == "SaveContinue") {
                    $return = $_SERVER['QUERY_STRING'];
                }

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
    $classTable = "Questions";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_Questions_template = $core->getLangArray($_arr_Questions_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Questions");
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
            $clsRecycleBin->AddNew($classTable, $val, "name", "Questions");
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
    $core->_Clone("Questions");
}
