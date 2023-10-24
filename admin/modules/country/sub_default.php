<?
function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
    $classTable = "Country";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsLanguage = new Language();

    //get _GET, _POST
    $curPage = isset($_GET["page"]) ? $_GET["page"] : 0;
    $btnSave = isset($_POST["btnSave"]) ? $_POST["btnSave"] : "";
    $rowsPerPage = 100;
    $skeyword = isset($_REQUEST["skeyword"]) ? $_REQUEST["skeyword"] : "";
    //init Button
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?admin&mod=$mod&act=add", 1);
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "?admin&mod=$mod&act=delete", 1, "confirmDelete");
    if ($pvalTable != "") {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    } else {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    }
    $cond = "is_online>=0";
    if ($skeyword != "") {
        $cond .= " AND (name LIKE '%$skeyword%' OR iso_code_2 LIKE '%$skeyword%' OR iso_code_3 LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&skeyword=$skeyword";
    }
    $assign_list["skeyword"] = $skeyword;
    //################### CHANGE BELOW CODE ###################
    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL("?mod=$mod");
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Country"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='15%'");
    $clsDataGrid->addColumnLabel("name_en", "Tiếng Anh", "width='15%'");
    $clsDataGrid->addColumnLabel("name_kr", "Tiếng Hàn", "width='15%'");
    $clsDataGrid->addColumnLabel("name_jp", "Tiếng Nhật", "width='15%'");
    $clsDataGrid->addColumnLabel("iso_code_2", "Iso Code 2", "width='10%'  align='center'");
    $clsDataGrid->addColumnLabel("iso_code_3", "Iso Code 3", "width='10%'  align='center'");
    $clsDataGrid->addColumnText("order_no", "OrderNo", "width='6%'  align='center'");
    $clsDataGrid->addColumnSelect("is_online", "IsOnline?", "width='5%' align='center'", $arrYesNoOptions);
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        header("location: ?mod=$mod");
    }

    $assign_list["clsDataGrid"] = $clsDataGrid;
}
function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
    $classTable = "Country";
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
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    if ($mode == "Edit") {
        $clsButtonNav->set("New", "/icon/add2.png", "?admin&mod=$mod&act=add", 1);
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?admin&mod=$mod&act=delete&$pkeyTable=$pvalTable");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?admin&mod=$mod");
    //################### CHANGE BELOW CODE ###################
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Country"));
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:50%'");
    $clsForm->addInputText("name_en", "", "Tên tiếng Anh", 255, 1, "style='width:50%'");
    $clsForm->addInputText("name_kr", "", "Tên tiếng Hàn", 255, 1, "style='width:50%'");
    $clsForm->addInputText("name_jp", "", "Tên tiếng Nhật", 255, 1, "style='width:50%'");
    $clsForm->addInputText("iso_code_2", "", "Iso Code 2", 255, 1, "style='width:50%'");
    $clsForm->addInputText("iso_code_3", "", "Iso Code 3", 255, 1, "style='width:50%'");
    $clsForm->addInputText("order_no", "999", "OrderNo", 3, 0, "style='width:200px'");
    $clsForm->addInputSelect("is_online", 1, "IsOnline", $arrYesNoOptions, 0, "style='font-size:12px'");
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

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $sub;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Country";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    //################### CAN NOT MODIFY BELOW CODE ###################
    $clsTable = new $classTable();
    $pval = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pval != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Country");
        //End RecycleBin
        $clsTable->deleteOne($pval);
        header("location: ?mod=$mod");
        exit();
    }
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        foreach ($checkList as $key => $val) {
            //Begin RecycleBin
            $clsRecycleBin = new RecycleBin();
            $clsRecycleBin->AddNew($classTable, $val, "name", "Country");
            //End RecycleBin
            $clsTable->deleteOne($val);
        }
        header("location: ?mod=$mod");
        exit();
    }
    unset($clsTable);
}
