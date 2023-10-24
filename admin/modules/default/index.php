<?
$sub = $stdio->GET("sub", "default");
$act = $stdio->GET("act", "default");
$clsModule = new Module("default");
$clsModule->run($sub, $act);	

$assign_list["sub"] = $sub;
$assign_list["act"] = $act;	

$clsCP->expandSection("product");
$clsCP->expandSection("content");
//$clsCP->collapseSection("payment");
$clsCP->collapseSection("setting");
$clsCP->collapseSection("system");
?>