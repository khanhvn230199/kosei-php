<?
function cat_filter($c, $value, $pval, $row)
{
    return str_replace(array('&brvbar;', '-'), '', $c['arrOptions'][$value]);
}

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrNewsSource, $arrTemplateOption;;
    global $_max_category_level, $lang_code;
    $classTable = "Articles";
    $clsClassTable = new $classTable; //$clsClassTable->setDebug();
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsLanguage = new Language();

    if (isset($_GET["reset"])) {
        $arrVars = array("scatid", "skeyword", "sis_hot");
        foreach ($arrVars as $key => $val) {
            getPost_remove($val);
        }
        unset($arrVars);
    }

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $sis_hot = getPOST("sis_hot", -1);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    $rowsPerPage = 20;

    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp", 1);
    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone", "$mod,$returnExp");
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
    if ($core->hasPermiss("news_default_delete")) {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    //################### CHANGE BELOW CODE ###################
    $arrOptionsCategory = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype=" . CTYPE_BV);
    makeArrayListAuthor($arrAuthor, 1);
    //init Grid
    $baseUrl = "?mod=$mod";
    $cond = "lang_code='$lang_code' AND ctype=" . CTYPE_BV;
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = getPOST("skeyword", "");
    $scatid = getPOST("scatid", "");
    $scatid_options = "";
    if (is_array($arrOptionsCategory))
        foreach ($arrOptionsCategory as $k => $v) {
            $selected = ($k == $scatid) ? "selected" : "";
            $scatid_options .= "<option value='$k' $selected >$v</option>";
        }
    if ($skeyword != "") {
        $cond .= " AND (title LIKE '%$skeyword%' OR sapo LIKE '%$skeyword%' OR content LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&skeyword=$skeyword";
    }
    if ($sis_hot >= 0) {
        $cond .= " AND (is_hot=$sis_hot)";
        $baseUrl = preg_replace("/\&is_hot=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&sis_hot=$sis_hot";
    }
    if ($scatid != "" && $scatid != "0") {
        $strcatid = $clsCategory->getAllCatStr($scatid) . "$scatid";
        $cond .= " AND cat_id in ($strcatid)";
        $baseUrl = preg_replace("/\&scatid=(\w+)/e", "", $baseUrl);
        $baseUrl .= "&scatid=$scatid";
    }
    $assign_list["skeyword"] = $skeyword;
    $assign_list["scatid_options"] = $scatid_options;
    //End
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setOrderBy("reg_date DESC");
    $clsDataGrid->setTitle($core->getLang("Articles"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("title", "Title", "width='auto'");
    $clsDataGrid->addColumnImage("image", "Image", "width='100px' border=0", "width='10%' align='center'");
    $clsDataGrid->addColumnSelect("cat_id", "Category", "width='5%' align='center'", $arrOptionsCategory);
    $clsDataGrid->addColumnSelect("is_hot", "Nổi bật?", "width='5%' align='center'", $arrYesNoOptions);
    $clsDataGrid->addColumnDate("reg_date", "Posted_at", "width='5%' align='center' nowrap ", "%d/%m/%Y %H:%M");
    $clsDataGrid->addColumnLabel("view_num", "Xem", "width='5%' align='center'");
    $clsDataGrid->addColumnSelect("is_verify", "Verify?", "width='5%' align='center'", array("<b style='color:red'>Không</b>", "<b style='color:blue'>Có</b>"), 0, 1);
    $clsDataGrid->addColumnSelect("is_online", "Publish?", "width='5%' align='center'", array("<b style='color:red'>Không</b>", "<b style='color:blue'>Có</b>"), 0, 1);
    $clsDataGrid->addColumnSelect("user_id", "Author", "width='5%' align='center'", $arrAuthor, 0, 1);
    $clsDataGrid->addColumnUrl($pkeyTable, ".....", "width='3%' align='center' nowrap ",
        "<a target='_blank' href='?mod=$mod&act=preview&news_id=%1%&$returnExp' title='Xem trước'><img src='" . ADMIN_URL_IMAGES . "/preview_on.gif' align='left'></a>
<a href='?mod=$mod&act=viewlog&news_id=%1%&$returnExp' title='Nhật ký sửa'><img src='" . ADMIN_URL_IMAGES . "/icon/refresh.png'></a>");
    //$clsDataGrid->addFilter("cat_id", "cat_filter");
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        if ($clsDataGrid->saveData()) {
            if ($sis_hot == -1 && $scatid == "0" && $scat_id == "") {
                $query = $_SERVER['QUERY_STRING'];
                header("location: ?$query");
                exit();
            }
        }
    }
    $base_url1 = preg_replace("/\&skeyword=(\w*)/i", "", $_SERVER['QUERY_STRING']);
    $base_url1 = preg_replace("/\&scatid=(\w*)/i", "", $base_url1);
    $assign_list["sis_hot"] = $sis_hot;
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrNewsSource, $arrTemplateOption;;
    global $_max_category_level, $lang_code;
    $classTable = "Articles";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsTags = new Tags();

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = GET($pkeyTable, "");
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod";
    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    $base_url = "?mod=$mod&act=$act&$returnExp";
    //init Button
    if ($mode == "Edit") {
        $arrNews = $clsClassTable->getOne($pvalTable);

        if ($core->hasPermiss("news_default_delete") || $arrNews['user_id'] == $core->_USER['user_id']) {
            $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "savecontinue");
            $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
        }
        $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp", 1);

        if ($core->hasPermiss("news_default_delete") || $arrNews['user_id'] == $core->_USER['user_id']) {
            $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
        }
    } else {
        $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrOptionsCategory = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionsCategory, "ctype=" . CTYPE_BV);
    makeArrayListAuthor($arrAuthor);
    $arrTemplateOption[CTYPE_BV]['default'] = "Mặc định (kế thừa từ nhóm)";
    //init Form
    $clsForm = new Form();
    if ($mode == "New") {
        $arrNewsOrginal = array();
        $arrNewsOrginal['cat_id'] = "";
        $arrNewsOrginal['reg_date'] = time();
        $arrNewsOrginal['author'] = "";
        $arrNewsOrginal['source'] = "";
        $arrNewsOrginal['image'] = "";
        $arrNewsOrginal['is_hot'] = 0;
        $arrNewsOrginal['is_verify'] = 0;
        $arrNewsOrginal['is_online'] = 0;
    }
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Articles"));
    $clsForm->setTextAreaType("full");
    $clsForm->addInputSelect("cat_id", $arrNewsOrginal['cat_id'], "NewsGroup", $arrOptionsCategory, 0, "style='font-size:12px'");
    $clsForm->addInputText("title", "", "Title", 255, 0, "style='width:99%'");
    $clsForm->addInputFile("image", $arrNewsOrginal['image'], "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");
    $clsForm->addInputText("note_img", "", "Chú thích cho ảnh", 255, 1, "style='width:99%'");
    $clsForm->addInputText("name_post", "", "Tên (Name)", 255, 1, "style='width:99%'");
    $clsForm->addInputText("title_post", "", "Chức danh (Name)", 255, 1, "style='width:99%'");
    $clsForm->addInputTextArea("sapo", "", "Introduce (SAPO)", 9999999999, 10, 5, 1, "style='width:100%; height:150px'", "SMALL");
    $clsForm->addInputTextArea("content", "", "Content", 9999999999, 10, 5, 0, "style='width:100%; height:300px'");
    $clsForm->addInputText("event_time", "", "Time (For_Event)", 255, 1, "style='width:99%'");
    $clsForm->addInputText("venue", "", "Venue (For_Event)", 255, 1, "style='width:99%'");
    $clsForm->addInputText("tags", "", "Tags (các tag cách nhau dấu ,)", 255, 1, "style='width:99%'");
    $clsForm->addInputDate("reg_date", $arrNewsOrginal['reg_date'], "Posted_at", "%d/%m/%Y %H:%M");
    $clsForm->addInputText("source", "", "Link nguồn", 255, 1, "style='width:99%'");
    $clsForm->addInputSelect("user_id", 0, "Author", $arrAuthor, 0, "style='font-size:12px'");
    $clsForm->addInputSelect("template", 1, "Giao diện hiển thị", $arrTemplateOption[CTYPE_BV], 0, "style='font-size:12px'");
    $clsForm->addInputRadio("is_hot", $arrNewsOrginal['is_hot'], "Hot_news?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputRadio("is_verify", $arrNewsOrginal['is_verify'], "Verify?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputRadio("is_online", $arrNewsOrginal['is_online'], "Publish?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputHidden("lang_code", $lang_code);

    $clsForm->addInputText("page_title", "", "[SEOmoz] PageTitle", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_keywords", "", "[SEOmoz] MetaKeywords", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_des", "", "[SEOmoz] MetaDescription", 255, 1, "style='width:99%'");
    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        $action_log = "";
        if ($mode == "New") {
            $clsForm->addInputHidden('ctype', CTYPE_BV);
            $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": Created\n";
        } else {
            $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": Updated\n";
            $action_log .= $clsForm->record['action_log'];
        }
        $slug = utf8_nosign_noblank($_POST["title"]);
        $clsForm->addInputHidden("slug", $slug);
        $clsForm->addInputHidden("action_log", $action_log);
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                $clsTags->insertTags($_POST['tags'], 'news_id', $pvalTable);
                if ($btnSave == "SaveContinue") {
                    $return = $_SERVER['QUERY_STRING'];
                }
                header("location: ?$return");
                exit();
            }
        }
    }
    $assign_list["sampleTags"] = $clsTags->getStrSampleTags('news_id');

    $assign_list["base_url"] = $base_url;
    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Articles";
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
        $clsRecycleBin->AddNew($classTable, $pvalTable, "title", "Articles");
        //End RecycleBin
        $clsClassTable->deleteOne($pvalTable);
        header("location: ?$return");
    }
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        $clsRecycleBin = new RecycleBin();
        foreach ($checkList as $key => $val) {
            //Begin RecycleBin
            $clsRecycleBin->AddNew($classTable, $val, "title", "Articles");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    }
    unset($clsTable);
}

function default_preview()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Articles";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    //$clsClassTable->SetDebug();
    //init Button
    $btnSave = isset($_POST["btnSave"]) ? $_POST["btnSave"] : "";
    $btnDelete = isset($_POST["btnDelete"]) ? $_POST["btnDelete"] : "";
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") $return = "mod=$mod&act=publish";
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($btnSave == "Verify") {
        $action_log = "";
        $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": Verified\n";
        $clsClassTable->updateOne($pvalTable, "is_verify='1', action_log = CONCAT('$action_log', action_log)");
    } else
        if ($btnSave == "UnVerify") {
            $action_log = "";
            $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": UnVerified\n";
            $clsClassTable->updateOne($pvalTable, "is_verify='0', action_log = CONCAT('$action_log', action_log)");
        } else
            if ($btnSave == "Publish") {
                $action_log = "";
                $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": Published\n";
                $clsClassTable->updateOne($pvalTable, "is_online='1', action_log = CONCAT('$action_log', action_log)");
            } else
                if ($btnSave == "UnPublish") {
                    $action_log = "";
                    $action_log .= "[" . strftime("%m/%d/%Y %H:%M") . "] " . $core->_USER['user_name'] . ": UnPublished\n";
                    $clsClassTable->updateOne($pvalTable, "is_online='0', action_log = CONCAT('$action_log', action_log)");
                }
    if ($btnDelete == "Delete") {
        $clsClassTable->deleteOne($pvalTable);
        header("location: ?$return");
    }
    $arrOneNews = $clsClassTable->getOne($pvalTable);
    if (!is_array($arrOneNews)) {
        header("location: ?$return");
    }
    if ($core->hasPermiss('news_default_publish')) {
        if ($arrOneNews['is_verify'] == 0) {
            $clsButtonNav->set("Verify", "/icon/checks.png", "Verify News", 1, "confirmVerify");
        } else {
            $clsButtonNav->set("UnVerify", "/icon/forbidden.png", "UnVerify News", 1, "confirmUnVerify");
        }
        if ($arrOneNews['is_online'] == 0) {
            $clsButtonNav->set("Publish", "/icon/export1.png", "Publish News", 1, "confirmPublish");
        } else {
            $clsButtonNav->set("UnPublish", "/icon/import2.png", "UnPublish News", 1, "confirmUnPublish");
        }
    }
    if ($core->hasPermiss('news_default_delete')) {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete2");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrOneNews['content'] = htmlDecode($arrOneNews['content']);
    $assign_list["arrOneNews"] = $arrOneNews;
}

function default_viewlog()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Articles";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    if ($return == "") $return = "mod=$mod";
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    //################### CHANGE BELOW CODE ###################
    $arrOneNews = $clsClassTable->getOne($pvalTable);
    $assign_list["arrOneNews"] = $arrOneNews;
}

//gọi function clone
function default_clone()
{
    global $core;
    $core->_Clone("Articles");
}


?>
