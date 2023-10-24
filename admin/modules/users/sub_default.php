<?
function default_default(){
	function show_is_active($c, $value, $pval, $row){
		if ($value==1) $html = "<img src='".ADMIN_URL_IMAGES."/online.gif' title='Đang hoạt động'>";
		else $html = "<img src='".ADMIN_URL_IMAGES."/offline.gif' title='Không hoạt động'>";
		if ($row->is_ban==1) $html.= "<br><img src='".ADMIN_URL_IMAGES."/blacklist.gif' title='Blacklist'>";
		return $html;
	}
	function show_fullname($c, $value, $pval, $row){
		$html = $value;
		if ($row->is_active==-1) $html.= "<br><small class='red'>Blacklist</small>";
		return $html;
	}
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrGenderOptions, $arrActiveOptions, $arrGroupOptions;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;

	//get _GET, _POST
	$s_user_name = getPOST("s_user_name", "");
	$s_fullname = getPOST("s_fullname", "");
	$s_email = getPOST("s_email", "");
	$s_gender = getPOST("s_gender", "");
	$s_is_active = getPOST("s_is_active", 1);
	$curPage = GET("page", 0);
	$btnSave = POST("btnSave", "");
	$s_user_group_id = getPOST("s_user_group_id", 0);
	$rowsPerPage = 50;	
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);

	//init Button
	//$clsButtonNav->set("Pending", "/icon/cut.png", "Pending", 1, "confirmPending");
	$clsButtonNav->set("Export", "/icon/export.png", "?mod=$mod&act=export&$returnExp&lang_code=$lang_code", 1);
	if ($s_user_group_id==4){
		if ($s_is_ban==1) $clsButtonNav->set("UnBan", "/icon/check.png", "Out of blacklist", 1, "confirmUnBan");
		if ($s_is_ban==0) $clsButtonNav->set("Ban", "/icon/forbidden.png", "Blacklist", 1, "confirmBan");
	}
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");	
	$clsButtonNav->set("New", "/icon/add2.png", "?mod=$mod&act=add&$returnExp",1);
	$clsButtonNav->set("Edit", "/icon/edit2.png", "Edit", 1, "confirmEdit");
	$clsButtonNav->set("Delete", "/icon/delete2.png", "?mod=$mod&act=delete", 1, "confirmDelete");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");

	//################### CHANGE BELOW CODE ###################
	//init Grid
	if ($s_user_group_id==0){
		$cond = "(user_group_id=2 OR user_group_id=4)";
	}else{
		$cond = "user_group_id=$s_user_group_id";		
	}
	$baseURL = "?mod=$mod";
	if ($s_user_name!="") $cond.= " AND user_name LIKE '%$s_user_name%'";
	if ($s_fullname!="") $cond.= " AND fullname LIKE '%$s_fullname%'";
	if ($s_email!="") $cond.= " AND email LIKE '%$s_email%'";
	if ($s_gender!="") $cond.= " AND gender='$s_gender'";
	if ($s_is_active!="") $cond.= " AND is_active='$s_is_active'";
	$x = ($s_user_group_id==2)? 15 : (($s_user_group_id==4)? 10 : 10);
	$clsDataGrid = new DataGrid($curPage, $rowsPerPage);
	$clsDataGrid->setBaseURL($baseURL);
	$clsDataGrid->setDbTable($tableName, $cond);
	$clsDataGrid->setPkey($pkeyTable);
	$clsDataGrid->setFormName("theForm");
	$clsDataGrid->setOrderBy("reg_date DESC");
	$clsDataGrid->setTitle($core->getLang("Học viên"));
	$clsDataGrid->setTableAttrib('cellpadding="0" cellspacing="0" width="100%" border="0" class="girdtable"');
	$clsDataGrid->addColumnLabel("user_name", "Tài khoản", "width='auto' align='left'");
	$clsDataGrid->addColumnLabel("fullname", "FullName", "width='10%' align='center'");
	$clsDataGrid->addColumnImage("avatar", "Avatar", "max-width=200px height=50px border=0", "width='5%' align='center'");
	$clsDataGrid->addColumnLabel("email", "Email", "width='10%' align='left'");
	$clsDataGrid->addColumnLabel("mobile", "ĐT", "width='10%' align='left'");
	if ($s_user_group_id==''){
		$clsDataGrid->addColumnSelect("gender", "Gender", "width='5%' align='center' nowrap", $arrGenderOptions, 0, 1);
		//$clsDataGrid->addColumnSelect("user_group_id", "UserGroup", "width='5%' align='center' nowrap", $arrGroupOptions, 0, 1);
	}else
	$clsDataGrid->addColumnDate("reg_date", "Đăng ký", "width='5%' align='center' nowrap", "%d/%m/%Y");
	$clsDataGrid->addColumnDate("reg_date", "Đăng ký", "width='5%' align='center' nowrap", "%d/%m/%Y");
	$clsDataGrid->addColumnSelect("is_active", "TT", "width='5%' align='center' nowrap", $arrActiveOptions, 0, 1);
	$clsDataGrid->addFilter("is_active", "show_is_active");
	$clsDataGrid->addFilter("fullname", "show_fullname");
	//####################### ENG CHANGE ######################
	if ($btnSave=="Ban"){
		$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
		if (is_array($checkList)){
			foreach ($checkList as $key => $val){
				$clsClassTable->updateOne($val, "is_ban=1");
			}
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query&s_is_ban=1");
			exit();
		}		
	}else
	if ($btnSave=="UnBan"){
		$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
		if (is_array($checkList)){
			foreach ($checkList as $key => $val){
				$clsClassTable->updateOne($val, "is_ban=0");
			}
			$query = $_SERVER['QUERY_STRING'];
			header("location: ?$query&s_is_ban=0");
			exit();
		}		
	}else
	if ($btnSave!=""){			
		$clsDataGrid->saveData();		
		$query = $_SERVER['QUERY_STRING'];
		header("location: ?$query");
		exit();
	}

	$assign_list["clsDataGrid"] = $clsDataGrid;
	$assign_list["s_user_name"] = $s_user_name;
	$assign_list["s_fullname"] = $s_fullname;
	$assign_list["s_email"] = $s_email;
	$assign_list["s_gender"] = $s_gender;
	$assign_list["s_is_active"] = $s_is_active;
	$assign_list["s_user_group_id"] = $s_user_group_id;
	$assign_list["s_is_ban"] = $s_is_ban;
	$assign_list["arrGroupOptions"] = $arrGroupOptions;
	$assign_list["htmlOptionsGroup"] = makeHTMLOptions($arrGroupOptions, $s_user_group_id);
}

function default_add(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav, $arrYesNoOptions, $arrGenderOptions, $arrActiveOptions, $arrGroupOptions;
	$classTable = "Users";
	$clsClassTable = new $classTable; //$clsClassTable->setDebug();
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = GET($pkeyTable, "");
	$btnSave = POST("btnSave", "");
	$return = (isset($_GET["return"]))? base64_decode($_GET["return"]) : "mod=$mod";
	$returnExp = "return=".base64_encode($_SERVER['QUERY_STRING']);
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save", "/icon/disks.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?$return");
	$arrDepartmentOptions = $arrPositionOptions = array();
	
	//makeArrayListCategory(0, 0, 1, $arrDepartmentOptions, "ctype=".CTYPE_PB);//Phòng ban
	//makeArrayListCategory(0, 0, 1, $arrPositionOptions, "ctype=".CTYPE_CV);//Chức vụ
	//################### CHANGE BELOW CODE ###################
	//init Form
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle($core->getLang("Học viên"));
	$clsForm->addInputText("user_name", "", "Tài khoản", 32, 0, "style='width:300px'");
//	$clsForm->addInputRadio("user_group_id", 2, "UserGroup", $arrGroupOptions, 0);
	$clsForm->addInputFile("avatar", "", "Avatar", "jpg, png", 1, "style='width:300px'");
	if ($mode=="Edit"){
		$clsForm->addInputPassword("user_pass", "", "Password", 255, 0,  "style='width:300px'", 1);
		$arrCurrentUser = $clsClassTable->getOne($pvalTable);
	}else{
		$clsForm->addInputPassword("user_pass", "", "Password", 255, 0,  "style='width:300px'", 1);
		$arrCurrentUser = array('user_name'=>'', 'email'=>'');
	}
	$password_hint = ($mode=="Edit")? $core->getLang("Leave_if_no_change") : "";
	$clsForm->addHint("user_pass", $password_hint);
	$clsForm->addInputText("fullname", "", "FullName", 255, 0, "style='width:300px'");
	$clsForm->addInputRadio("gender", 0, "Gender", $arrGenderOptions, 0, "style=''");
	$clsForm->addInputDate("birthday", time(), "Birthday (dd/mm/YYYY)", "%d/%m/%Y");
	$clsForm->addInputEmail("email", "", "Email", 255, 0, "style='width:99%'");
	$clsForm->addInputText("phone", "", "Phone", 255, 1, "style='width:99%'");
	$clsForm->addInputText("mobile", "", "Mobile", 255, 1, "style='width:99%'");
	$clsForm->addInputText("address", "", "Address", 255, 1, "style='width:99%'");	

	$clsForm->addInputRadio("is_active", 1, "Trạng thái", $arrActiveOptions, 0, "style=''");
	if ($mode=="New") $clsForm->addInputHidden("reg_date", time());

	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		global $dbconn;
		if ($clsForm->validate()){
			if ($mode=="Edit"){
				$admin_permiss = $_POST["admin_permiss"];
				if (is_array($admin_permiss)){
					$user_id = $arrCurrentUser['user_id'];
					$dbconn->Execute("DELETE FROM _category_users WHERE user_id=$user_id");
					foreach ($admin_permiss as $key => $cat_id){
						$dbconn->Execute("INSERT INTO _category_users SET cat_id=$cat_id, user_id=$user_id, allow=1");
					}
				}
			}
			
			$ok1 = $clsClassTable->check_user_name($_POST['user_name'], $arrCurrentUser['user_name']);
			$ok2 = $clsClassTable->check_email_exists($_POST['email'], $arrCurrentUser['email']);
			if ($ok1){
				$clsForm->isValid = 0;
				$clsForm->errorStr = "<li>Tên người dùng này đã tồn tại rồi</li>";
			}
			if ($ok2){
				$clsForm->isValid = 0;
				$clsForm->errorStr.= "<li>Email này đã tồn tại rồi</li>";
			}
			if ($clsForm->isValid && $clsForm->saveData($mode)){
				header("location: ?$return");
				exit();
			}
		}
	}
	
	$assign_list["mode"] = $mode;
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
}

function default_delete(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$pval = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pval!=""){
		$clsClassTable->deleteOne($pval);
		header("location: ?mod=$mod");
		exit();
	}
	$checkList = isset($_POST["checkList"])? $_POST["checkList"] : "";
	if (is_array($checkList)){
		foreach ($checkList as $key => $val){
			$clsClassTable->deleteOne($val);
		}
		header("location: ?mod=$mod");
		exit();
	}
}
function default_resendmail(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod;
	global $core, $clsModule, $clsButtonNav;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey ;
	//################### CAN NOT MODIFY BELOW CODE ###################
	$pval = isset($_GET[$pkeyTable])? $_GET[$pkeyTable] : "";
	if ($pval!=""){
		$clsClassTable->resendActivationMail($pval);
		header("location: ?mod=$mod");
		exit();
	}	
}

function default_profile(){
	global $assign_list, $_CONFIG,  $_SITE_ROOT, $mod, $act;
	global $core, $clsModule, $clsButtonNav, $arrTimeZoneOptions;
	$classTable = "Users";
	$clsClassTable = new $classTable;
	$tableName = $clsClassTable->tbl;
	$pkeyTable = $clsClassTable->pkey;
	
	require_once DIR_COMMON."/clsForm.php";
	//get _GET, _POST
	$pvalTable = $core->_USER['user_id'];
	$btnSave = isset($_POST["btnSave"])? $_POST["btnSave"] : "";
	//get Mode
	$mode = ($pvalTable!="")? "Edit" : "New";
	//init Button
	$clsButtonNav->set("Save...", "/icon/disks.png", "Save", 1, "save");
	$clsButtonNav->set("Cancel", "/icon/undo.png", "?");
	//################### CHANGE BELOW CODE ###################
	$clsUserGroup = new UserGroup();
	//$clsUserGroup->setDebug();
	$arrListUserGroup = $clsUserGroup->getAll();
	$arrOptionsUserGroup = array();
	if (is_array($arrListUserGroup))
	foreach ($arrListUserGroup as $key => $val){
		$arrOptionsUserGroup[$val["user_group_id"]] = $val["name"];
	}
	global $arrTimeZone;
	$arrTimeZoneOptions = array();
	if (is_array($arrTimeZone))
	foreach ($arrTimeZone as $key => $val){
		$arrTimeZoneOptions[] = $val[1];
	}
	//init Form
	$arrPositionOptions = array("L"=>"LEFT", "R"=>"RIGHT", "B"=>"BOTTOM", "T"=>"TOP");
	$arrYesNoOptions = array("NO", "YES");
	$arrGenderOptions = array("Male", "Female");
	$clsForm = new Form();
	$clsForm->setDbTable($tableName, $pkeyTable, $pvalTable);
	$clsForm->setTitle("Admin Settings");
	$clsForm->addInputText("user_id", "", "<b>ID</b>", 32, 0, "readonly style='width:300px'");
	$clsForm->addInputText("user_name", "", "<b>UserName</b>", 32, 0, "readonly style='width:300px'");
	$clsForm->addInputPassword("user_pass", "", "Password", 255, 0,  "style='width:300px'");
	$password_hint = ($mode=="Edit")? "Leave if no change password" : "";
	$clsForm->addHint("user_pass", $password_hint);
	$clsForm->addInputText("fullname", "", "FullName", 255, 0, "style='width:300px'");
	$clsForm->addInputText("email", "", "Email", 255, 0, "style='width:300px'");
	$clsForm->addInputSelect("gender", 0, "Gender?", $arrGenderOptions, 0, "style='font-size:12px'");
	$clsForm->addInputDate("birthday", "", "Birthday", "%m/%d/%Y", 1, 1);
	$clsForm->addInputText("homepage", "", "HomePage", 255, 1, "style='width:300px'");
	$clsForm->addInputText("phone", "", "Phone", 255, 1, "style='width:300px'");
	$clsForm->addInputText("mobile", "", "Mobile", 255, 1, "style='width:300px'");
	//####################### ENG CHANGE ######################
	//do Action
	if ($btnSave!=""){
		if ($clsForm->validate()){
			if ($clsForm->saveData($mode)){
				header("location: ?mod=$mod&act=$act");
			}
		}
	}
	
	$assign_list["clsModule"] = $clsModule;
	$assign_list["clsForm"] = $clsForm;
	$assign_list[$pkeyTable] = $pvalTable;
	
}


function default_export()
{

    global $assign_list, $_CONFIG, $_SITE_ROOT, $mod, $act, $dbconn;
    global $core, $clsModule, $clsButtonNav , $arrActiveOptions;
    global $_max_category_level, $lang_code,$_LANG_ID;



    $classTable = "Users";
    $clsClassTable = new $classTable;
    $from_no = POST("from_no", "");
    $to_no = POST("to_no", "");
	$is_active = getPOST("is_active", 1);

    $btnImport = isset($_POST["btnImport"]) ? $_POST["btnImport"] : "";
    if ($btnImport != "") {
        if ($from_no != "" && $to_no != "") {
            $limit = $from_no . "," . $to_no;

            $clsClassTable->exportUser($is_active, $limit);
        } else {
            $clsClassTable->exportUser($is_active);
        }
	
    }

	
	$assign_list["arrActiveOptions"] = $arrActiveOptions;
}


?>