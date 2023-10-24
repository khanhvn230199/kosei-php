<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrDiscountTypeOptions;
    global $lang_code;
    $classTable = "Promotion";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $rowsPerPage = 20;
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    //init Button
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$parent_id&$returnExp", 1);
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
    $clsButtonNav->set("Clone", "/icon/copy.png", "Clone", 1, "confirmClone", "$mod,$returnExp");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
    if ($parent_id != 0) {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    } else {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    }
    //################### CHANGE BELOW CODE ###################
    $baseUrl = "?mod=$mod";
    //init Grid
    $query = "SELECT a.*,c.image, c.name FROM _promotion as a INNER JOIN _category as c ON a.course_id = c.cat_id where a.lang_code = '$lang_code' ORDER BY a.reg_date DESC";
    $query_c = "SELECT count(*) as totalRows FROM _promotion as a INNER JOIN _category as c ON a.course_id = c.cat_id where a.lang_code = '$lang_code' ORDER BY a.reg_date DESC";
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbQuery($query, $query_c);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Khuyến mại"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("course_name", "Course", "width='5%'");
    $clsDataGrid->addColumnLabel("title", "Tiêu đề", "width='5%'");
    $clsDataGrid->addColumnImage("image", "Image", "width=100px height=70px border=0", "width=5%' align='center'");
    $clsDataGrid->addColumnSelect("discount_type", "Loại chiết khấu", "width='5%'", $arrDiscountTypeOptions,0,1);
    $clsDataGrid->addColumnLabel("discount_value", "Chiết khấu cơ bản", "width='5%'");
    $clsDataGrid->addColumnDate("start_date", "Ngày bắt đầu", "width='2%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnDate("end_date", "Ngày kết thúc", "width='2%' align='center'", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnDate("reg_date", "Ngày tạo", "width='2%' align='center'");
    $clsDataGrid->addColumnSelect("is_start", "Bắt đầu?", "width='5%' align='center'", $arrYesNoOptions);
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        $query = $_SERVER['QUERY_STRING'];
        header("location: ?$query");
        exit();
    }
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $arrDiscountTypeOptions;
    global $core, $clsModule, $clsButtonNav;
    global $lang_code, $arrYesNoOptions;
    $classTable = "Promotion";
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
    //init Button
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    if ($mode == "Edit") {
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add", 1);
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Khuyến mại"));
    $clsForm->setTextAreaType("full");
    $clsForm->addInputText("title", "", "Tiêu đề", 255, 0, "style='width:50%', autocomplete='off'");
    $clsForm->addInputText("course_name", "", "Course", 255, 0, "style='width:50%' autocomplete='off'");
    $clsForm->addInputText("course_id", "", " ", 255, 1, "style='width:30%; display:none;'");
    $clsForm->addAttachInput("course_name", "course_id");
    $clsForm->addInputSelect("discount_type", 0, "Loại chiết khấu", $arrDiscountTypeOptions, 0, "style='font-size:12px'");
    $clsForm->addInputText("discount_value", 0, "Chiết khấu cơ bản", 255, 0, "style='width:100px'");
    $clsForm->addAttachInput("discount_type", "discount_value");
    $clsForm->addInputTextArea("des", "", "Description", 9999999999, 10, 5, 1, "style='width:100%; height:100px'");
    $clsForm->addInputDate("start_date", "", "Ngày bắt đầu", "%d/%m/%Y %H:%M", 1, 0);
    $clsForm->addInputDate("end_date", "", "Ngày kết thúc", "%d/%m/%Y %H:%M", 1, 0);
    $clsForm->addAttachInput("start_date", "end_date");
    $clsForm->addInputRadio("is_start", 1, "Bắt đầu?", $arrYesNoOptions, 0, "style='font-size:12px'");
    //####################### ENG CHANGE ######################
    //do Action
    if ($mode == "New") {
        $clsForm->addInputHidden('lang_code', $lang_code);
        $clsForm->addInputHidden('reg_date', time());
    }
    if ($btnSave != "") {
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                if ($btnSave == "Save" || $mode == "New") {
                    header("location: ?$return");
                    exit();
                } else {
                    $query = $_SERVER['QUERY_STRING'];
                    header("location: ?$query");
                    exit();
                }
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
    $classTable = "Promotion";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_page_template = $core->getLangArray($_arr_page_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Promotion");
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
            $clsRecycleBin->AddNew($classTable, $val, "name", "Promotion");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    }
    unset($clsClassTable);
}

function default_clone()
{
    global $core;
    $core->_Clone("Promotion");
}


?>