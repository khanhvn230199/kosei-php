<?
$sub = $stdio->GET("sub", "default");
$act = $stdio->GET("act", "default");
$clsModule = new Module("_login");
$clsModule->run($sub, $act);

$assign_list["sub"] = $sub;
$assign_list["act"] = $act;	
$assign_list["core"] = $core;
$assign_list["ADMIN_URL_IMAGES"] = ADMIN_URL_IMAGES;
$assign_list["ADMIN_URL_CSS"] = ADMIN_URL_CSS;
$assign_list["ADMIN_URL_JS"] = ADMIN_URL_JS;
$assign_list["URL_UPLOADS"] = URL_UPLOADS;

$assign_list["VNCMS_DIR"] = VNCMS_DIR;
$assign_list["VNCMS_URL"] = VNCMS_URL;

$smarty->assign($assign_list);
$smarty->display("$mod/index.html");
exit();
?>