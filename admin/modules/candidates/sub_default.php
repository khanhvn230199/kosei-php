<?
/**
 *  Default Action
 * @author        : Tran Anh Tuan (tuantavnu@gmail.com)
 * @date        : 2007/04/01
 * @version        : 1.0.0
 */
function oauth_filter($c, $value, $pval, $row)
{
    return ($value) ? $value : "Trực tiếp";
}

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $lang_code;
    global $core, $clsModule, $clsButtonNav;
    require_once DIR_COMMON . "/clsDatePicker.php";
    $classTable = "Candidates";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsTrialTest = new TrialTest();
    $clsLevel = new Level();

    //get _GET, _POST
    $level_id = isset($_REQUEST["level_id"]) ? getPOST('level_id') : 0;
    $tt_id = isset($_REQUEST["tt_id"]) ? getPOST('tt_id') : 0;
    $from_date = isset($_REQUEST["from_date"]) ? strtotime(getPOST('from_date')) : strtotime(date("m/d/Y", time() - 1 * 30 * 24 * 60 * 60));
    $to_date = isset($_REQUEST["to_date"]) ? strtotime(getPOST('to_date')) : strtotime(date("m/d/Y"));
    $clsFromDate = new DatePicker("from_date", $from_date, "%m/%d/%Y", 0);
    $clsToDate = new DatePicker("to_date", $to_date, "%m/%d/%Y", 0);
    $curPage = isset($_GET["page"]) ? $_GET["page"] : 0;
    $btnSave = isset($_POST["btnSave"]) ? $_POST["btnSave"] : "";
    $rowsPerPage = 40;

    //init Button
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    //################### CHANGE BELOW CODE ###################
    $baseUrl = "?mod=$mod";
    $cond = "";
    if ($level_id > 0) {
        $cond .= " AND a.level_id=$level_id";
    }
    if ($tt_id > 0) {
        $cond .= " AND a.tt_id=$tt_id";
    }
    if ($from_date != "") {
        $cond .= " AND a.reg_date>'$from_date'";
    }
    if ($to_date != "") {
        $to_date_full = $to_date + 24 * 60 * 60;
        if ($cond != "") {
            $cond .= " AND ";
        }

        $cond .= " a.reg_date<'$to_date_full'";
    }
    $query = "SELECT a.*, t.name as test_name, t.start_date, t.end_date, l.name AS level_name, l.code, u.user_name, u.fullname, u.email, u.phone, u.mobile, u.oauth_provider FROM $tableName AS a INNER JOIN _trial_test AS t ON a.tt_id = t.tt_id INNER JOIN _level AS l ON a.level_id = l.level_id INNER JOIN _users AS u ON a.user_id = u.user_id WHERE u.is_active = 1 $cond";
    $queryC = "SELECT count(*) as totalRows FROM $tableName AS a INNER JOIN _trial_test AS t ON a.tt_id = t.tt_id INNER JOIN _users AS u ON a.user_id = u.user_id INNER JOIN _level AS l ON a.level_id = l.level_id WHERE u.is_active = 1 $cond";

    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbQuery($query, $queryC);
    $clsDataGrid->setOrderBy("a.reg_date DESC");
    $clsDataGrid->showEditLink = 0;
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("FeedbackNews"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("user_name", "Tên đăng nhập", "width='10%' align='center'");
    $clsDataGrid->addColumnLabel("oauth_provider", "Hình thức ĐK", "width='10%' align='center'");
    $clsDataGrid->addColumnLabel("fullname", "FullName", "width='10%'");
    $clsDataGrid->addColumnLabel("level_name", "Level", "width='10%'");
    $clsDataGrid->addColumnLabel("email", "Email", "width='10%'");
    $clsDataGrid->addColumnLabel("test_name", "Kỳ thi", "width='10%'");
    $clsDataGrid->addColumnDate("start_date", "Ngày bắt đầu", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
    $clsDataGrid->addColumnDate("end_date", "Ngày kết thúc", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
    $clsDataGrid->addColumnDate("reg_date", "Đăng ký lúc", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
    $clsDataGrid->addFilter("oauth_provider", "oauth_filter");

    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        header("location: ?mod=$mod");
    }

    $base_url1 = preg_replace("/\&status=(\w*)/", "", $_SERVER['QUERY_STRING']);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["clsFromDate"] = $clsFromDate;
    $assign_list["clsToDate"] = $clsToDate;
    $assign_list["tt_id"] = $tt_id;
    $assign_list["level_id"] = $level_id;
    $assign_list["arrListTrialTest"] = $clsTrialTest->getAll("is_online=1 AND lang_code = '$lang_code'");
    $assign_list["arrListLevel"] = $clsLevel->getAll("is_online=1 AND lang_code = '$lang_code'");
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Candidates";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    $btnSave = isset($_POST["btnSave"]) ? $_POST["btnSave"] : "";
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    //init Button
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?mod=$mod");

    //################### CHANGE BELOW CODE ###################
    $clsCountry = new Country();
    $arrListCountry = $clsCountry->getAll();
    $arrOptionsCountry = array();
    if (is_array($arrListCountry)) {
        foreach ($arrListCountry as $key => $val) {
            $arrOptionsCountry[$val["country_id"]] = $val["name"];
        }
    }

    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("FeedbackNews"));
    $clsForm->setTextAreaType("none");
    $clsForm->addInputEmail("user_id", "", "UserID", 255, 0, "style='width:200px'");
    $clsForm->addInputText("fullname", "", "Full Name", 255, 1, "style='width:200px'");
    $clsForm->addInputText("email", "", "Email", 255, 1, "style='width:200px'");
    $clsForm->addInputTextArea("content", "", "Content", 255, 30, 5, 0, "style='width:100%'");
    $clsForm->addInputDate("reg_date", "", "Posted_at", "%m/%d/%Y %H:%M");
    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                header("location: ?mod=$mod");
            }
        }
    }

    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

/**
 *  Show detail an Item
 * @author        : Tran Anh Tuan (tuantavnu@gmail.com)
 * @date        : 2007/04/01
 * @version        : 1.0.0
 */
function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Candidates";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    //################### CAN NOT MODIFY BELOW CODE ###################
    $clsTable = new $classTable();
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "email", "FeedbackNews");
        //End RecycleBin
        $clsTable->deleteOne($pval);
        header("location: ?mod=$mod");
    }
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        foreach ($checkList as $key => $val) {
            //Begin RecycleBin
            $clsRecycleBin = new RecycleBin();
            $clsRecycleBin->AddNew($classTable, $val, "email", "FeedbackNews");
            //End RecycleBin
            $clsTable->deleteOne($val);
        }
        header("location: ?mod=$mod");
    }
    unset($clsTable);
}
