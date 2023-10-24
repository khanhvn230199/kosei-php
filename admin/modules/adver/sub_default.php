<?
function filter_thumbnail($c, $value, $pval, $row)
{
    if ($value == "") return "N/A";
    global $arrAdsPositionOptionsSize;
    $size = $arrAdsPositionOptionsSize[$row->position];
    if ($size != "") {
        $arr_size = explode('x', $size);
        $html = "<img src='" . URL_UPLOADS . "/" . $value . "' style='width:" . $arr_size[0] . "px; height:" . $arr_size[1] . "px'>";
    } else {
        $html = "<img src='" . URL_UPLOADS . "/" . $value . "' style='width:100%'>";
    }
    return $html;
}

function filter_description($c, $value, $pval, $row)
{
    return htmlDecode($value);
}

function filter_start_date($c, $value, $pval, $row)
{
    $out = date("d/m/Y", $value);
    $now = time();
    if ($value > $now) {
        $out .= "<br><small class='red'>Chưa bắt đầu</small>";
    }
    return $out;
}

function filter_end_date($c, $value, $pval, $row)
{
    $out = date("d/m/Y", $value);
    $now = time();
    if ($value < $now) {
        $out = "<span class='underline'>" . $out . "</span>";
        $out .= "<br><small class='red'>Kết thúc</small>";
    } else {
        $out = "<span class='blue'>" . $out . "</span>";
    }
    return $out;
}

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $dbconn;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
    global $arrAdsPositionOptions, $arrFileExtOptions, $arrMod2Name, $arrMod2NamePosition;
    $classTable = "Adver";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $mod_sub_act = getPOST("mod_sub_act", "All");
    $position = getPOST("position", "");
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    $rowsPerPage = 100;

    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save...", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp", 1);
    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone");
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
    $clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    //################### CHANGE BELOW CODE ###################
    $htmlOptionsModSubAct = makeHTMLOptions($arrMod2Name, $mod_sub_act);
    $tmp = $arrAdsPositionOptions;
    $arrPosition = $arrMod2NamePosition[$mod_sub_act];
    foreach ($tmp as $key => $val) {
        if (!in_array($key, $arrPosition)) unset($tmp[$key]);
    }
    $htmlOptionsPosition = makeHTMLOptions($tmp, $position);
    //init Grid
    $cond = "mod_sub_act='$mod_sub_act'";
    if ($position != "") $cond .= " AND position='$position'";
    $baseUrl = "?mod=$mod";
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setOrderBy("order_no ASC");
    $clsDataGrid->setTitle($core->getLang("Advertisment"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("title", "Title", "width=''");
    $clsDataGrid->addColumnImage("image", "Image", "max-width='100%' border=0", "width='10%' align='center'");
    if($position != "CN") {
        $clsDataGrid->addColumnLabel("des", "Mô tả", "width='30%'", 1, "", 500);
        $clsDataGrid->addColumnUrl("link", "URL", "width='10%' align='center'");
    }
    $clsDataGrid->addColumnSelect("position", "Position", "style='width:10%;' width='5%' align='center'", $arrAdsPositionOptions, 0, 1);
    //$clsDataGrid->addColumnSelect("mod_sub_act", "Needed_Ads_Page", "style='width:10px;' width='15%' align='center'", $arrMod2Name);
    $clsDataGrid->addColumnText("order_no", "OrderNo", "width='5%'  align='center' nowrap");
    $clsDataGrid->addColumnSelect("is_online", "Display?", "width='5%' align='center'", $arrYesNoOptions);
    if($position != "CN" && $position !="CR"){
        $clsDataGrid->addColumnDate("start_date", "StartDate", "width='5%' align='center' nowrap ", "%d/%m/%Y");
        $clsDataGrid->addColumnDate("end_date", "EndDate", "width='5%' align='center' nowrap ", "%d/%m/%Y");
        $clsDataGrid->addFilter("start_date", "filter_start_date");
        $clsDataGrid->addFilter("end_date", "filter_end_date");
    }
    $clsDataGrid->addFilter("image", "filter_thumbnail");
    //$clsDataGrid->addFilter("des", "filter_description");
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        header("location: ?mod=$mod");
    }

    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsPosition"] = $htmlOptionsPosition;
    $assign_list["htmlOptionsModSubAct"] = $htmlOptionsModSubAct;
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $dbconn;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions;
    $classTable = "Adver";
    $clsClassTable = new $classTable;//$clsClassTable->setDebug();
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $mod_sub_act = getPOST("mod_sub_act", "All");
    $position = getPOST("position", "");
    $title = POST("title", "");
    $occupations = POST("occupations", "");
    $des1 = POST("des1", "");
    $des2 = POST("des2", "");
    $image = POST("image", "");
    $link = POST("link", "");
    $embed = POST("embed", "");
    $order_no = POST("order_no", "99999");
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
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp", 1);
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    global $arrAdsPositionOptions, $arrFileExtOptions, $arrMod2Name, $arrMod2NamePosition;
    $tmp = $arrAdsPositionOptions;
    $arrPosition = $arrMod2NamePosition[$mod_sub_act];
    foreach ($tmp as $key => $val) {
        if (!in_array($key, $arrPosition)) unset($tmp[$key]);
    }
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Advertisment"));
    $clsForm->setTextAreaType("SMALL");
    $clsForm->addInputSelect("mod_sub_act", $mod_sub_act, "Needed_Ads_Page?", $arrMod2Name, 0, "style=';' onchange='return changePosition();'");
    $clsForm->addInputSelect("position", $position, "Position?", $tmp, 0, "style=';'");
    $clsForm->addAttachInput("mod_sub_act", "position");
    if ($position == "CN") {
        $clsForm->addInputText("title", $title, "Address", 255, 0, "style='width:99%'");
    } else {
        $clsForm->addInputText("title", $title, "Title", 255, 0, "style='width:99%'");
    }
    if ($position == "CR") {
        $clsForm->addInputText("occupations", $occupations, "Nghề nghiệp", 255, 0, "style='width:300px'");
    }
    $clsForm->addInputFile("image", $image, "Image (jpg, jpeg, gif, png, swf)", "jpg, jpeg, gif, png, swf", 1, "style='width:300px'");
    if ($position != "CN" && $position != "CR") {
        $clsForm->addInputText("link", $link, "Linkto URL", 255, 1, "style='width:99%'");
    }
    if ($position != "CN") {
        $clsForm->addInputTextArea("des", "", "Mô tả", 10000, 10, 5, 1, "style='width:98%; height:300px'");
    }
    if ($position != "CR") {
        $clsForm->addInputTextArea("embed", "", "Hoặc Mã nhúng (Adsense,ID youtube ...) <br>(nếu chọn mã nhúng thì không cần nhập ảnh và link ở trên)", 9999999999, 10, 10, 1, "style='width:99%; height: 250px'", 'none');
    }
    $clsForm->addInputText("hits", "1", "Hits", 6, 0, "style='width:100px'");
    $clsForm->addInputHidden("file_ext", 'Image');
    $clsForm->addInputText("order_no", $order_no, "OrderNo", 6, 0, "style='width:100px'");
    $clsForm->addInputRadio("is_online", 1, "Display?", $arrYesNoOptions, 0, "style=''");
    if ($position != "CN" && $position != "CR") {
        $clsForm->addInputDate("start_date", time(), "Ngày bắt đầu", "%m/%d/%Y %H:%M");
        $clsForm->addInputDate("end_date", time() + 10 * 365 * 24 * 60 * 60, "Ngày kết thúc", "%m/%d/%Y %H:%M");
    }

    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        if ($clsForm->validate()) {
            if ($btnSave != "ChangeP" && $clsForm->saveData($mode)) {
                header("location: ?$return");
            }
        }
    }

    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

/**
 * Clone the selected records
 */
function default_clone()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Adver";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_page_template = $core->getLangArray($_arr_page_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    //################### CAN NOT MODIFY BELOW CODE ###################
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        foreach ($checkList as $key => $val) {
            $clsClassTable->cloneOne($val);
        }
        header("location: ?$return");
        exit();
    }
    unset($clsClassTable);
}

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Adver";
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
        $clsRecycleBin->AddNew($classTable, $pvalTable, "title", "Adver");
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
            $clsRecycleBin->AddNew($classTable, $val, "title", "Adver");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    }
    unset($clsClassTable);
}

?>