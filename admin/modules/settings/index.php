<?
$sub = $stdio->GET("sub", "default");
$act = $stdio->GET("act", "default");
if (($act=="default" || $act=="add" || $act=="edit" ) && !$core->isSuper()){
	showErrorWarningBox();
	die();
	exit();
}
$clsModule = new Module("settings");
$clsModule->run($sub, $act);	

$assign_list["sub"] = $sub;
$assign_list["act"] = $act;	
?>