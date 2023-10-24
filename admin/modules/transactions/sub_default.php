<?
function default_default()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $transactionStatusOptions, $paymentMethodOptions, $shippingMethodOptions;
    global $lang_code;
    require_once DIR_COMMON . "/clsDatePicker.php";
    $classTable = "Transactions";
    $clsClassTable = new $classTable;
    //$clsClassTable->setDebug();
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    //get _GET, _POST
    $curPage = GET("page", 0);
    $s_email = getPOST("s_email", "");
    $s_name = getPOST("s_name", "");
    $s_mobile = getPOST("s_mobile", "");
    $status = POST("status", -1);
    $btnSave = POST("btnSave", "");
    $rowsPerPage = 50;
    $parent_id = GET("parent_id", 0);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($_SERVER['QUERY_STRING']);
    //init Button
    $clsButtonNav->set("Edit", "/icon/edit2.png", "Sửa", 1, "confirmEdit");
   $clsButtonNav->set("Delete", "/icon/delete2.png", "Xóa", 1, "confirmDelete");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?");

    $from_date = isset($_REQUEST["from_date"]) ? strtotime($_REQUEST["from_date"]) : strtotime(date("m/d/Y", time() - 1 * 30 * 24 * 60 * 60));
    $to_date = isset($_REQUEST["to_date"]) ? strtotime($_REQUEST["to_date"]) : strtotime(date("m/d/Y"));
    $clsFromDate = new DatePicker("from_date", $from_date, "%m/%d/%Y", 0);
    $clsToDate = new DatePicker("to_date", $to_date, "%m/%d/%Y", 0);

    //################### CHANGE BELOW CODE ###################
    $arrStatusOptions = array();
    foreach ($transactionStatusOptions as $k => $v) {
        switch ($k) {
            case 0:
                $arrStatusOptions[$k] = "<span class='text-warning'>" . $v . "</span>";
                break;
            case 1:
                $arrStatusOptions[$k] = "<span class='text-danger'>" . $v . "</span>";
                break;
            case 2:
                $arrStatusOptions[$k] = "<span class='text-success'>" . $v . "</span>";
                break;
            default:
                $arrStatusOptions[$k] = "<span>" . $v . "</span>";
                break;
        }
    }

    $paymentOption = array();
    makeArrayListPayment($paymentOption);

    //init Grid
    $baseUrl = "?mod=$mod";
    $cond = "";

    //Begin Added 20080704

    if ($status != "" && $status > -1) {
        //$baseUrl.= "&status=$status";
        $cond .= " AND a.status='$status'";
    }
    // thêm tìm kiếm bằng email phuonghv2/2/2023
    if ($s_email!="")
    {
        $cond.= " AND u.email LIKE '%$s_email%'";
    }
    
    if ($s_name!="")
    {
        $cond.= " AND c.name LIKE '%$s_name%'";
    }
    if ($s_mobile!="")
    {
        $cond.= " AND u.mobile LIKE '%$s_mobile%'";
    }

    // End

    // đóng tìm kiếm theo khoản thời gian
    // if ($from_date != "") {
    //     $cond .= " AND a.reg_date>'$from_date'";
    // }
    // if ($to_date != "") {
    //     $to_date_full = $to_date + 24 * 60 * 60;
    //     if ($cond != "") {
    //         $cond .= " AND ";
    //     }

    //     $cond .= " a.reg_date<'$to_date_full'";
    // }
    // echo $cond;

    // End





    $arrYesNoOptions = array(0 => "Chưa thanh toán", 1 => "<span class='text-success'>Đã thanh toán</span>");

    $query = "SELECT a.*,c.name AS course_name, c.image, u.user_name, u.fullname, u.email, u.phone, u.mobile FROM $tableName AS a INNER JOIN _category AS c ON a.cat_id = c.cat_id INNER JOIN _users AS u ON a.user_id = u.user_id WHERE a.lang_code='$lang_code' $cond";

    $queryC = "SELECT count(*) as totalRows FROM $tableName AS a INNER JOIN _category AS c ON a.cat_id = c.cat_id INNER JOIN _users AS u ON a.user_id = u.user_id WHERE a.lang_code='$lang_code' $cond";

    if ($_GET["return"] != "") {
        $baseUrl .= "&return=" . $_GET["return"];
    }

    //init Grid
    $clsDataGrid = new DataGrid($curPage, $rowsPerPage);
    $clsDataGrid->setReturnExp($returnExp);
    $clsDataGrid->setBaseURL($baseUrl);
    $clsDataGrid->setDbQuery($query, $queryC);
    // $clsDataGrid->setDbTable($cond);
    $clsDataGrid->setPkey($pkeyTable);
    $clsDataGrid->setOrderBy("a.reg_date DESC");
    $clsDataGrid->setFormName("theForm");
    $clsDataGrid->setTitle($core->getLang("Transactions"));
    $clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
    $clsDataGrid->addColumnLabel("course_name", "Course", "width='15%'");
    $clsDataGrid->addColumnImage("image", "Image", "width='150px' border=0", "width='5%' align='center'");
    $clsDataGrid->addColumnMoney("price_vn", "Giá VN", "width='6%' align='center'");
    $clsDataGrid->addColumnMoney("price_jp", "Giá JP", "width='6%' align='center'");
    // $clsDataGrid->addColumnLabel("code", "Level", "width='3%' align='center'");
    $clsDataGrid->addColumnLabel("fullname", "Họ tên", "width='5%' align='center'");
    $clsDataGrid->addColumnLabel("email", "Email", "width='5%' align='center'");
    $clsDataGrid->addColumnLabel("mobile", "Điện thoại", "width='5%' align='center'");
    $clsDataGrid->addColumnDate("reg_date", "Ngày đăng ký", "width='5%' align='center'", "%d/%m/%Y");
    $clsDataGrid->addColumnDate("expired_time", "Ngày kết thúc", "width='5%' align='center'", "%d/%m/%Y");
    $clsDataGrid->addColumnLabel("note", "Note", "width='10%' align='center'");
//    $clsDataGrid->addColumnSelect("shipping_method", "Phương thức vận chuyển?", "width='10%' align='center'", $shippingMethodOptions, 0, 1);
    $clsDataGrid->addColumnSelect("payment_method", "Phương thức thanh toán?", "width='10%' align='center'", $paymentMethodOptions, 0, 1);
    $clsDataGrid->addColumnSelect("payment_id", "Thanh toán qua?", "width='10%' align='center'", $paymentOption, 0, 1);
    $clsDataGrid->addColumnSelect("status", "Trạng thái?", "width='10%' align='center'", $arrStatusOptions, 0, 1);
    //####################### ENG CHANGE ######################
    if ($btnSave != "") {
        $clsDataGrid->saveData();
        $query = $_SERVER['QUERY_STRING'];
        header("location: ?$query");
        exit();
    }
    $base_url1 = preg_replace("/\&status=(\w*)/", "", $_SERVER['QUERY_STRING']);
    $assign_list["base_url1"] = "?" . $base_url1;
    $assign_list["base_url"] = "?" . preg_replace("/\&reset/i", "", $_SERVER['QUERY_STRING']);
    $assign_list["clsDataGrid"] = $clsDataGrid;
    $assign_list["clsFromDate"] = $clsFromDate;
    $assign_list["clsToDate"] = $clsToDate;
    $assign_list["arrStatusOptions"] = $arrStatusOptions;
    $assign_list["status"] = $status;
    $assign_list["s_email"] = $s_email;
    $assign_list["s_name"] = $s_name;
    $assign_list["s_mobile"] = $s_mobile;
    $assign_list["htmlOptionsLang"] = makeListLang($lang_code);
}

function default_add()
{
    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod;
    global $core, $clsModule, $clsButtonNav, $lang_code, $arrYesNoOptions, $transactionStatusOptions, $paymentMethodOptions, $shippingMethodOptions;
    $classTable = "Transactions";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;

    require_once DIR_COMMON . "/clsForm.php";
    //get _GET, _POST
    $pvalTable = GET($pkeyTable, "");
    $btnSave = POST("btnSave", "");
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    $returnExp = "return=" . base64_encode($return);
    //get Mode
    $mode = ($pvalTable != "") ? "Edit" : "New";
    //init Button
    $clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
    $clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
    //################### CHANGE BELOW CODE ###################
    $paymentOption = array();
    makeArrayListPayment($paymentOption);
    //init Form
    $clsForm = new Form();
    $clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
    $clsForm->setTitle($core->getLang("Transactions"));
    $clsForm->setTextAreaType("full");
    $clsForm->addInputTextArea("note", "", "Note", 9999999999, 0, 0, 1, "style='width:100%; height:150px'", "SMALL");
    $clsForm->addInputDate("expired_time", "", "Ngày kết thúc", "%d/%m/%Y", 0, 0);
    $clsForm->addInputRadio("shipping_method", "", "Phương thức vận chuyển", $shippingMethodOptions, 0, "style='font-size:12px' disabled");
    $clsForm->addInputRadio("payment_method", "", "Phương thức thanh toán", $paymentMethodOptions, 0, "style='font-size:12px' disabled");
    $clsForm->addInputRadio("payment_id", "", "Thanh toán qua", $paymentOption, 0, "style='font-size:12px' disabled");
    $clsForm->addInputRadio("status", "", "Trạng thái?", $transactionStatusOptions, 0, "style='font-size:12px'");
    $clsForm->addInputHidden("reg_date", time());
    if ($mode == "New") {
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
    $classTable = "Transactions";
    $clsClassTable = new $classTable;
    $tableName = $clsClassTable->tbl;
    $pkeyTable = $clsClassTable->pkey;
    $_arr_Transactions_template = $core->getLangArray($_arr_Transactions_template);
    $return = (isset($_GET["return"])) ? base64_decode($_GET["return"]) : "";
    if ($return == "") {
        $return = "mod=$mod";
    }

    //################### CAN NOT MODIFY BELOW CODE ###################
    $pvalTable = isset($_GET[$pkeyTable]) ? $_GET[$pkeyTable] : "";
    if ($pvalTable != "") {
        //Begin RecycleBin
        $clsRecycleBin = new RecycleBin();
        $clsRecycleBin->AddNew($classTable, $pvalTable, "name", "Transactions");
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
            $clsRecycleBin->AddNew($classTable, $val, "name", "Transactions");
            //End RecycleBin
            $clsClassTable->deleteOne($val);
        }
        header("location: ?$return");
    }
    unset($clsClassTable);
}
