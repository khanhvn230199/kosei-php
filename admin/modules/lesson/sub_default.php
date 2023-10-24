<?
function cat_filter($c, $value, $pval, $row)
{
    return str_replace(array('&brvbar;', '-'), '', $c['arrOptions'][$value]);
}

function default_default()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrNewsSource;
    global $_max_category_level, $lang_code;
    $classTable = "Lessons";
    $clsClassTable = new $classTable;
//    $clsClassTable->setDebug();
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    // //Begin
    // $start = isset($_GET["start"])? $_GET["start"] : 0;
    // $limit = isset($_GET["limit"])? $_GET["limit"] : 2;
    // $arr = $clsClassTable->getAll("vimeo_id!='' LIMIT $start, $limit");
    // if (is_array($arr)){
    //     foreach ($arr as $key => $val){
    //         $duration = getVimeoVideoDuration($val['vimeo_id']);
    //         if ($duration>0){
    //             echo $val[$pkeyTable]." => ".$duration."<BR>";
    //             $clsClassTable->updateOne($val[$pkeyTable], "duration=$duration");
    //         }
    //     }
    //     $start += $limit;
    //     $url = "?mod=$mod&start=$start&limit=$limit";
    //     echo "<meta http-equiv = 'refresh' content = '0; url = $url' />";
    // }else{
    //     echo "Done";
    // }
    // exit();
    // //End

    //get _GET, _POST
    $curPage = GET("page", 0);
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    $rowsPerPage = 50;
    $parent_id = GET("parent_id", 0);
    //init Button
    $clsButtonNav->set("Save...", "/icon/disks.png", "Save and Continue", 1, "save");
    $clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&parent_id=$parent_id&$returnExp", 1);
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
    $clsButtonNav->set("Clone", "/icon/copy.png", "Nhân đôi", 1, "confirmClone", "$mod,$returnExp");
    //$clsButtonNav->set("Paste", "/icon/paste.png", "", 0);
    if ($core->hasPermiss("news_default_delete")) {
        $clsButtonNav->set("Delete", "/icon/delete2.png", "Delete", 1, "confirmDelete");
    }
    if ($parent_id != 0) {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    } else {
        $clsButtonNav->set("Cancel", "/icon/undo.png", "?");
    }
    //################### CHANGE BELOW CODE ###################
    $arrOptionCourse = array();
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    $arrOptionStage = array();
    makeArrayListStage(0, 0, MAX_LEVEL_CATEGORY, $arrOptionStage, '');
    makeArrayListAuthor($arrAuthor, 1);
    //init Grid
    $baseUrl = "?mod=$mod";
    if ($parent_id > 0) {
        $baseUrl .= "&parent_id=$parent_id";
    }
    $cond = "lang_code='$lang_code' AND parent_id=$parent_id";
    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }
    //Begin Added 20080704
    $clsCategory = new Category();
    $clsCategory->getParentArray();
    $skeyword = isset($_REQUEST["skeyword"]) ? $_REQUEST["skeyword"] : "";
    $scatid = isset($_REQUEST["scatid"]) ? $_REQUEST["scatid"] : "";
    
    $scatid_options = "";
    if (is_array($arrOptionCourse)) {
        foreach ($arrOptionCourse as $k => $v) {
            $selected = ($k == $scatid) ? "selected" : "";
            $scatid_options .= "<option value='$k' $selected >$v</option>";
        }
    }

    if ($skeyword != "") {
        $cond .= " AND (name LIKE '%$skeyword%')";
        $baseUrl = preg_replace("/\&skeyword=(\w+)/", "", $baseUrl);
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

//    dd($cond);
    //End
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setDbTable($tableName, $cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setOrderBy("reg_date DESC");
    $clsDataGrid->setTitle($core->getLang("Bài giảng"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("name", "Name", "width='10%'");
    $clsDataGrid->addColumnImage("image", "Image", "width='100%' height='auto' border=0", "width='5%' align='center'");
    $clsDataGrid->addColumnSelect("cat_id", "Course", "width='5%' align='center'", $arrOptionCourse, 0, 1);
    $clsDataGrid->addColumnSelect("stage_id", "Stage", "width='5%' align='center'", $arrOptionStage, 0, 1);
    $clsDataGrid->addColumnDate("reg_date", "Posted_at", "width='5%' align='center' nowrap ", "%m/%d/%Y %H:%M");
    $clsDataGrid->addColumnLabel("total_view", "Xem", "width='5%' align='center'");
    $clsDataGrid->addColumnSelect("is_trial", "Học thử?", "width='5%' align='center'", array("<b style='color:red'>Không</b>", "<b style='color:blue'>Có</b>"), 0, 1);
    $clsDataGrid->addColumnSelect("is_online", "Online?", "width='5%' align='center'", array("<b style='color:red'>Không</b>", "<b style='color:blue'>Có</b>"), 0, 1);
//    $clsDataGrid->addColumnSelect("at_home", "Hiện trang chủ", "width='5%' align='center'", array("<b style='color:red'>Không</b>", "<b style='color:blue'>Có</b>"), 0, 1);
    $clsDataGrid->addColumnSelect("user_id", "Người đăng", "width='5%' align='center'", $arrAuthor, 0, 1);
    $clsDataGrid->addFilter("cat_id", "cat_filter");
    if ($parent_id == 0) {
        $clsDataGrid->addColumnUrl($pkeyTable, "Nhóm bài học", "width='3%' align='center' nowrap", "<a href='?mod=$mod&parent_id=%1%&$returnExp' class='abutton1'>" . $core->getLang('Quản lý bài học') . " &raquo;</a>");
    } else {
        $clsDataGrid->addColumnUrl($pkeyTable, "Bài tập", "width='3%' align='center' nowrap", "<a href='?mod=questions&lesson_id=%1%&$returnExp' class='abutton1'>Quản lý bài tập &raquo;</a>");
    }
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        if ($btnSave == "Copy") {

        } else
        if ($clsDataGrid->saveData()) {
            $query = $_SERVER['QUERY_STRING'];
            header("location: ?$query");
            exit();
        }
    }
    $base_url1 = preg_replace("/\&skeyword=(\w*)/i", "", $_SERVER['QUERY_STRING']);
    $base_url1 = preg_replace("/\&scatid=(\w*)/i", "", $base_url1);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["clsDataGrid"] = $clsDataGrid;
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $dbconn;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrNewsSource;
    global $_max_category_level, $lang_code;
    $classTable = "Lessons";
    $clsClassTable = new $classTable;
//    $clsClassTable->setDebug();
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $clsTags = new Tags();

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = GET($pkeyTable, "");
    $parent_id = GET("parent_id", 0);
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    $base_url = "?mod=$mod&act=$act&$returnExp";
    //init Button
    if ($mode == "Edit") {
        $arrOneLessons = $clsClassTable->getOne($pvalTable);
        $clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "savecontinue");
        $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
        $clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete&$pkeyTable=$pvalTable&$returnExp");
    } else {
        $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    }
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $arrParent = array();
    $arrOptionCourse = array();
    $arrOptionStage = array();
    if ($parent_id > 0) {
        $arrParent = $clsClassTable->getOne($parent_id);
    }
    $cat_id = ($arrParent['cat_id'] != 0) ? $arrParent['cat_id'] : 0;
    $stage_id = ($arrParent['stage_id'] != 0) ? $arrParent['stage_id'] : 0;
    makeArrayListCategory(0, 0, $_max_category_level, $arrOptionCourse, "ctype=" . CTYPE_KH);
    makeArrayListStage(0, 0, MAX_LEVEL_CATEGORY, $arrOptionStage, '', 1);
    makeArrayListAuthor($arrAuthor);
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Bài giảng"));
    $clsForm->setTextAreaType("full");
    if ($parent_id == 0) {
        $clsForm->addInputSelect("cat_id", 0, "CoursesCategory", $arrOptionCourse, 0, "style='font-size:12px'");
        $clsForm->addInputSelect("stage_id", 0, "Stage", $arrOptionStage, 0, "style='font-size:12px'");
    } else {
//        $clsForm->addInputSelect("cat_id", 0, "CoursesCategory", $arrOptionCourse, 0, "style='font-size:12px' disabled");
        //        $clsForm->addInputSelect("stage_id", 0, "Stage", $arrOptionStage, 0, "style='font-size:12px' disabled");
        $clsForm->addInputHidden("cat_id", $cat_id);
        $clsForm->addInputHidden("stage_id", $stage_id);
    }
    $clsForm->addAttachInput("cat_id", "stage_id");
    $clsForm->addInputText("name", "", "Name", 255, 0, "style='width:99%'");
    $clsForm->addInputFile("image", "", "Image", "jpg, jpeg, gif, png", 1, "style='width:300px'");

    if ($parent_id > 0) {
        $clsForm->addInputFile("attachment", "", "Tập tin đính kèm<br>Định dạng <b>.mp3 hoặc .mp4.</b>", "mp3,mp4", 1, "style='width:300px'");
        $clsForm->addInputText("video_id", "", "Youtube Video ID<br>vd: https://www.youtube.com/watch?v=<b>ycGfvA1vkR8</b>", 255, 1, "style='width:23%'");
        $clsForm->addInputText("vimeo_id", "", "Vimeo Video ID<br>vd: https://vimeo.com/<b>393111505</b>/7a6a8b27e6", 255, 1, "style='width:23%'");
    } else {
        $clsForm->addInputTextArea("des", "", "Mô tả ngắn gọn", 9999999999, 10, 5, 1, "style='width:100%; height:150px'", "SAPO");
        $clsForm->addInputTextArea("detail", "", "Chi tiết bài giảng", 9999999999, 10, 5, 1, "style='width:100%; height:300px'");
        $clsForm->addInputText("tags", "", "Tags (các tag cách nhau dấu ,)", 255, 1, "style='width:99%'");
    }
    $clsForm->addInputNumber("duration", "", "Thời lượng video (giây)<br>(để trống sẽ tự động lấy từ Vimeo)", 255, 1, "style='width:100px'");
    $clsForm->addInputSelect("user_id", 0, "Người đăng", $arrAuthor, 0, "style='font-size:12px'");
    $clsForm->addInputRadio("is_trial", 1, "Học thử?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputRadio("is_online", 1, "Hiển thị?", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputRadio("at_home", 0, "Hiện trang chủ", $arrYesNoOptions, 0, "style='font-size:12px'");
    $clsForm->addInputText("page_title", "", "[SEOmoz] PageTitle", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_keywords", "", "[SEOmoz] MetaKeywords", 255, 1, "style='width:99%'");
    $clsForm->addInputText("meta_des", "", "[SEOmoz] MetaDescription", 255, 1, "style='width:99%'");
    //####################### ENG CHANGE ######################
    //do Action
    if ($btnSave != "") {
        $vimeoid = ($_POST["vimeo_id"]!="")? $_POST["vimeo_id"] : "";
        $duration = ($_POST["duration"]!="")? $_POST["duration"] : 0;
        if ($vimeoid!="" && ($duration==0 || $duration=="")){
            $_POST["duration"] = getVimeoVideoDuration($vimeoid);
        }

        if ($mode == "New") {
            $clsForm->addInputHidden("parent_id", $parent_id);
            $clsForm->addInputHidden("lang_code", $lang_code);
            $clsForm->addInputHidden("reg_date", time());
        }
        $clsForm->addInputHidden("slug", utf8_nosign_noblank(mb_convert_encoding($_POST["name"], "UTF-8", array('EUC-JP', 'SHIFT-JIS', 'AUTO'))));
        if ($clsForm->validate()) {
            if ($clsForm->saveData($mode)) {
                $clsTags->insertTags($_POST['tags'], 'course_id', $pvalTable);

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
    $assign_list["sampleTags"] = $clsTags->getStrSampleTags('course_id');

    $assign_list["arrParent"] = $arrParent;
    $assign_list["base_url"] = $base_url;
    $assign_list["clsModule"] = $clsModule;
    $assign_list["clsForm"] = $clsForm;
    $assign_list[$pkeyTable] = $pvalTable;
}

function default_delete()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav;
    $classTable = "Lessons";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    $checkList = isset($_POST["checkList"]) ? $_POST["checkList"] : "";
    if (is_array($checkList)) {
        $clsRecycleBin = new RecycleBin();
        foreach ($checkList as $key => $val) {
            //Begin RecycleBin
            $clsRecycleBin->AddNew($classTable, $val, "title", "Lessons");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    } else
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "title", "Lessons");
        //End RecycleBin
        $clsClassTable->deleteOne($pvalTable);
        header("location: ?$return");
    }

    unset($clsTable);
}

//gọi function clone
function default_clone()
{
    global $core;
    $core->_Clone("Lessons");
}
