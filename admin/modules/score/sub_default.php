<?php

/**
 * Hiển thị điểm và thông tin học viên
 * Lọc theo các kỳ thi và bài thi cụ thể
 */
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $lang_code;
    global $core, $clsModule, $clsButtonNav;

    $clsCandidate = new Candidates();
    $clsTrialTest = new TrialTest();
    $clsTest = new Test();

    // Get Trial Test List
    $trialTests = $clsTrialTest->getAll("is_online=1 ORDER BY tt_id DESC");

    // print_r($trialTests);

    $defaultTrialId = is_array($trialTests) && count($trialTests) ? $trialTests[0]['tt_id'] : 0;
    $tt_id = getPOST('tt_id', $defaultTrialId);
    $old_tt_id = getPOST('old_tt_id', 0);

    // Get Test List
    $tests = $clsTest->getAll("tt_id=$tt_id ORDER BY name");

   // print_r( $tests);

    if ($tt_id == $old_tt_id) {
        $test_id = getPOST('test_id', 0);
    } else {
        $defaultTestId = is_array($tests) && count($tests) ? $tests[0]['test_id'] : 0;
        $test_id = $defaultTestId;
    }

    $curPage = getPOST("page", 0);
    // echo $curPage;


    $btnSave = POST("btnSave", "");
    $rowsPerPage = 40;

    //init Button
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");

    //################### CHANGE BELOW CODE ###################
    $baseUrl = "?mod=$mod";

    // Lấy bài test hiện tại
    $currentTest = $clsTest->getOne($test_id);
    $currentLevel = 0;

    if (is_array($currentTest)) {
    // Lấy level_id
        $currentLevel = $currentTest['level_id'];

        // echo $currentLevel;

    }

    // Top học viên đạt điểm cao
    $sql = "
        SELECT
            a.*,
            b.*,
            c.fullname, c.avatar, c.email, c.mobile, c.address,
            (a.vocabulary_score + a.reading_score) as n5_score
        FROM
            _candidates a
        INNER JOIN
            (
                SELECT
                    user_id, MAX(total_score) as max_score
                FROM
                    _candidates
                WHERE
                test_id = $test_id
                GROUP BY user_id
            ) AS b
        INNER JOIN
            _users c
        WHERE
            a.test_id = $test_id AND
            a.user_id = b.user_id AND
            a.user_id = c.user_id AND
            a.total_score = b.max_score AND
            a.total_score > 0
        GROUP BY
            a.user_id
        ORDER BY
            b.max_score DESC";

    $sqlCount = "
        SELECT sum(rows) totalRows
        FROM (
            SELECT
                count(a.id) as rows
            FROM
                _candidates a
            INNER JOIN
                (
                    SELECT
                        user_id, MAX(total_score) as max_score
                    FROM
                        _candidates
                    WHERE
                    test_id = $test_id
                    GROUP BY user_id
                ) AS b
            INNER JOIN
                _users c
            WHERE
                a.test_id = $test_id AND
                a.user_id = b.user_id AND
                a.user_id = c.user_id AND
                a.total_score = b.max_score AND
                a.total_score > 0
            GROUP BY
                a.user_id
            ORDER BY
                b.max_score DESC
        ) src";

    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbQuery($sql, $sqlCount);
    // $clsDataGrid->setOrderBy("a.reg_date DESC");
    $clsDataGrid->showEditLink = 0;
    $clsDataGrid->setPkey($clsCandidate->pkey);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle("Bảng điểm");
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("fullname", "Thí sinh", "width='10%'");
    if ($currentLevel == 9 || $currentLevel == 4) {
        $clsDataGrid->addColumnLabel("n5_score", "Vocab + Reading", "width='2%'");
    }
    else {
        $clsDataGrid->addColumnLabel("vocabulary_score", "Vocab", "width='2%'");
        $clsDataGrid->addColumnLabel("reading_score", "Reading", "width='2%'");
    }
    $clsDataGrid->addColumnLabel("listening_score", "Listening", "width='2%'");
    $clsDataGrid->addColumnLabel("total_score", "Total score", "width='3%'");
    $clsDataGrid->addColumnDate("reg_date", "Thời gian làm bài", "width='2%' align='center' nowrap ", "%m/%d/%Y %H:%M");
    $clsDataGrid->addColumnLabel("mobile", "Mobile", "width='10%'");
    $clsDataGrid->addColumnLabel("email", "Email", "width='10%'");
    $clsDataGrid->addColumnLabel("address", "Địa chỉ", "width='10%'");

    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        header("location: ?mod=$mod");
    }

    $assign_list["base_url"] = "?mod=score";
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["trialTests"] = $trialTests;
    $assign_list["tt_id"] = $tt_id;
    $assign_list["tests"] = $tests;
    $assign_list["test_id"] = $test_id;

    // vd($trialTests);
    // vd($tt_id);
    // dd($test_id);
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
